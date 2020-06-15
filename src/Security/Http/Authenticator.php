<?php

namespace Sioweb\Oxid\Api\Security\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\IpUtils;


class Authenticator extends AbstractGuardAuthenticator
{
    private $container;

    public function __construct($ScopeMatcher, $container)
    {
        $this->ScopeMatcher = $ScopeMatcher;
        $this->ScopeMatcher->matchAttribute('_scope', 'public');

        $this->container = $container;
    }
    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning false will cause this authenticator
     * to be skipped.
     */
    public function supports(Request $request)
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    /**
     * Called on every request. Return whatever credentials you want to
     * be passed to getUser() as $credentials.
     */
    public function getCredentials(Request $request)
    {
        if($this->ScopeMatcher->matches($request) || $this->supports($request)) {
            return null;
        }

        if (
            $request->server->has('HTTP_CLIENT_IP')
            // || $request->server->has('HTTP_X_FORWARDED_FOR')
            || !IpUtils::checkIp($request->getClientIp(), $this->container->getParameter('whitelisted_ip_addresses')) 
            || PHP_SAPI === 'cli-server'
        ) {
            try {
                $this->getUser(
                    ['user' => $request->getUser(), 'password' => $request->getPassword()],
                    new UserProvider()
                );
            } catch(\Exception $e) {
                header('WWW-Authenticate: Basic realm="Oxid API Login"');
                header('HTTP/1.0 401 Unauthorized');
                die(sprintf('You are not allowed to access this file. Check %s for more information.', basename(__FILE__)));
            }

            if (
                null === $request->getUser() || null === $request->getPassword()
            ) {
                header('WWW-Authenticate: Basic realm="Oxid API Login"');
                header('HTTP/1.0 401 Unauthorized');
                die(sprintf('You are not allowed to access this file. Check %s for more information.', basename(__FILE__)));
            }
        }

        return ['user' => $request->getUser(), 'password' => $request->getPassword()];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (empty($credentials['user'])) {
            return;
        }
        
        return $userProvider->loadUserByUsername($credentials);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // check credentials - e.g. make sure the password is valid
        // no credential check is needed in this case

        // return true to cause authentication success
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            'message' => 'Authentication Required'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}