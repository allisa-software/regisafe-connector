<?php

namespace Allisa\Regisafe\Auth;

/**
 * Description of AuthenticatorInterface
 * @author Voss <p.voss@charismateam.de>
 */
interface AuthenticatorInterface {

    /**
     * @param RequestInterface $request
     * @return string
     * @throws \Exception
     */
    public function authenticate(RequestInterface $request): string;

    public function getAuthRequest(): RequestInterface;

}