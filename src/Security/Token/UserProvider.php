<?php

namespace Sioweb\Oxid\Api\Security\Token;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function supports(Request $request)
    {
        die('<pre>' . print_r('supports', true));
        return $request->headers->has('X-AUTH-TOKEN');
    }
    public function loadUserByUsername($username)
    {
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
        die('<pre>' . print_r('supportsClass', true));
        return User::class === $class;
    }

    private function fetchUser($username)
    {
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