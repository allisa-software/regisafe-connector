<?php

namespace Allisa\Regisafe\Auth\Request;

use Allisa\Regisafe\Auth\RequestInterface;

/**
 * Description of LoginData
 * @author Voss <p.voss@charismateam.de>
 */
class LoginData extends AbstractRequest {


    public function setLoginData(string $loginData): RequestInterface {
        $this->loginData = $loginData;

        return $this;
    }

    public function getLoginData() : string {
        return $this->loginData;
    }

}