<?php

namespace Sioweb\Oxid\Api\Security\Http;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Sioweb\Oxid\Api\Connector\Firewall;

class UserProvider implements UserProviderInterface
{

    private static $user = null;

    public function loadUserByUsername($UserData)
    {
        if(!empty(static::$user)) {
            return static::$user;
        }
        return $this->fetchUser($UserData);
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->fetchUser([
            'user' => $user->getUsername(),
            'password' => $user->getPassword()
        ]);
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }

    private function fetchUser($UserData)
    {
        $Firewall = new Firewall;
        $User = $Firewall('oxid.user');

        try {
            $User->login($UserData['user'], $UserData['password']);
            static::$user = new User(
                $User->oxuser__oxusername->value,
                $User->oxuser__oxpassword->value,
                $User->oxuser__oxpasssalt->value,
                []
            );

            return static::$user;
        } catch(\Exception $e) {
            // header('WWW-Authenticate: Basic realm="Oxid API Login"');
            // header('HTTP/1.0 401 Unauthorized');
            // die();
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $UserData['username'])
        );
    }
}