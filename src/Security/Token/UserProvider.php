<?php

namespace Sioweb\Oxid\Api\Security\Token;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Sioweb\Oxid\Api\Connector\Firewall;

class UserProvider implements UserProviderInterface
{

    private static $user = null;

    public function supports(Request $request)
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    public function loadUserByUsername($username)
    {
        if(!empty(static::$user)) {
            return static::$user;
        }
        return $this->fetchUser($username);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        $username = $user->getUsername();

        return $this->fetchUser($username);
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }

    private function fetchUser($token)
    {
        $Firewall = new Firewall;
        $User = $Firewall('oxid.user');

        try {
            $User->tokenLogin($token);
            
            static::$user = new User(
                $User->oxuser__oxusername->value,
                $User->oxuser__oxpassword->value,
                $User->oxuser__oxpasssalt->value,
                []
            );
            return static::$user;
        } catch(\Exception $e) {}

        // // make a call to your webservice here
        // $userData = 'lorem';
        // // pretend it returns an array on success, false if there is no user


        // if ($userData) {
        //     $password = 'ipsum';
        //     return new User($username, $password, '123', ['ADMIN']);
        // }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }
}