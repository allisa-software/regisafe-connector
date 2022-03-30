<?php

namespace Allisa\Regisafe\Auth\Request;

use Allisa\Regisafe\Auth\RequestInterface;

/**
 * Description of Logout
 * @author Voss <p.voss@charismateam.de>
 */
class Logout extends AbstractRequest {

    public function getParams() : array {
        return [
            'apiID' => $this->apiId,
            'sessionToken' => $this->sessionToken,
        ];
    }
}