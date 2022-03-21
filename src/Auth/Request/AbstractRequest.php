<?php

namespace Allisa\Regisafe\Auth\Request;

use Allisa\Regisafe\Auth\RequestInterface;

/**
 * Description of AbstractRequest
 * @author Voss <p.voss@charismateam.de>
 */
abstract class AbstractRequest implements \Allisa\Regisafe\Auth\RequestInterface {

    protected $apiId;
    protected $loginId;
    protected $password;
    protected $loginData;
    protected $lifetime;
    protected $url;

    public function setLifetime(int $lifetime = self::DEFAULT_LIFETIME) : RequestInterface {
        if ($lifetime < 0) {
            $this->lifetime = -1;
            return $this;
        }
        $this->lifetime = $lifetime;

        return $this;
    }

    public function getLifetime() : int {
        if ($this->lifetime !== null) {
            return $this->lifetime;
        }
        return RequestInterface::DEFAULT_LIFETIME;
    }

    public function setApiId(string $apiId) : RequestInterface {
        $this->apiId = $apiId;

        return $this;
    }

    public function getApiId() : string {
        return $this->apiId;
    }

    public function setLoginId(string $loginId) : RequestInterface {
        throw new \Exception('Does not support parameter loginId');
    }

    public function getLoginId() : string {
        throw new \Exception('Does not support parameter loginId');
    }

    public function setPassword(string $password) : RequestInterface {
        throw new \Exception('Does not support parameter password');
    }

    public function getPassword() : string {
        throw new \Exception('Does not support parameter password');
    }

    public function setLoginData(string $loginData) : RequestInterface {
        throw new \Exception('Does not support parameter loginData');
    }

    public function getLoginData() : string {
        throw new \Exception('Does not support parameter loginData');
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function setUrl(string $url) : RequestInterface {
        $this->url = $url;

        return $this;
    }

}