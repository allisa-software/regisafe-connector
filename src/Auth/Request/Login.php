<?php

namespace Allisa\Regisafe\Auth\Request;

use Allisa\Regisafe\Auth\RequestInterface;

/**
 * Description of Login
 * @author Voss <p.voss@charismateam.de>
 */
class Login extends AbstractRequest {


    public function setLoginId(string $loginId): RequestInterface {
        $this->loginId = $loginId;

        return $this;
    }

    public function setPassword(string $password): RequestInterface {
        $this->password = $password;

        return $this;
    }

    public function getLoginId() : string {
        return $this->loginId;
    }

    public function getPassword() : string {
        return $this->password;
    }

    public function getParams() : array {
        return [
            'apiID' => $this->apiId,
            'lifetime' => $this->getLifetime(),
            'loginID' => $this->loginId,
            'password' => $this->password
        ];
    }


}