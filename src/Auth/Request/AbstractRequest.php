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
    protected $sessionToken;
    protected $lifetime;
    protected $url;

    /**
     * @param string $sessionToken
     * @return Logout
     */
    public function setSessionToken(string $sessionToken): RequestInterface {
        $this->sessionToken = $sessionToken;

        return $this;
    }

    final public function setLifetime(int $lifetime = self::DEFAULT_LIFETIME) : RequestInterface {
        if ($lifetime < 0) {
            $this->lifetime = -1;
            return $this;
        }
        $this->lifetime = $lifetime;

        return $this;
    }

    final public function getLifetime() : int {
        if ($this->lifetime !== null) {
            return $this->lifetime;
        }
        return RequestInterface::DEFAULT_LIFETIME;
    }

    public function setApiId(string $apiId) : RequestInterface {
        $this->apiId = $apiId;

        return $this;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function setUrl(string $url) : RequestInterface {
        $this->url = $url;

        return $this;
    }

}