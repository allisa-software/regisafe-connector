<?php

namespace Allisa\Regisafe\Auth;

/**
 * Description of RequestInterface
 * @author Voss <p.voss@charismateam.de>
 */
interface RequestInterface {

    const DEFAULT_LIFETIME = 0;

    public function setApiId(string $apiId): RequestInterface;

    public function setLoginId(string $loginId): RequestInterface;

    public function setPassword(string $password): RequestInterface;

    public function setLoginData(string $loginData): RequestInterface;

    public function setLifetime(int $lifetime = self::DEFAULT_LIFETIME): RequestInterface;

    public function setUrl(string $url): RequestInterface;

    public function getApiId(): string;

    public function getLoginId(): string;

    public function getPassword(): string;

    public function getLoginData(): string;

    public function getLifetime(): int;

    public function getUrl(): string;

}