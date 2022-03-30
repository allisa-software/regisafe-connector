<?php

namespace Allisa\Regisafe\Auth;

/**
 * Description of RequestInterface
 * @author Voss <p.voss@charismateam.de>
 */
interface RequestInterface {

    const DEFAULT_LIFETIME = 0;

    public function setLifetime(int $lifetime = self::DEFAULT_LIFETIME): RequestInterface;

    public function setUrl(string $url): RequestInterface;

    public function setApiId(string $id): RequestInterface;

    public function setSessionToken(string $sessionToken): RequestInterface;

    public function getUrl(): string;

    public function getParams(): array;

}