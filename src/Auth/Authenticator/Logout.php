<?php

namespace Allisa\Regisafe\Auth\Authenticator;

use Allisa\Regisafe\Auth\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Description of Logout
 * @author Voss <p.voss@charismateam.de>
 */
class Logout implements \Allisa\Regisafe\Auth\AuthenticatorInterface {

    /**
     * @inheritDoc
     */
    public function authenticate(RequestInterface $request) : string {
        $client = new Client();
        try {
            $client->request(
                'POST',
                $request->getUrl(),
                [
                    RequestOptions::JSON => $request->getParams()
                ]
            );
            return '';
        } catch (\Throwable $exception) {
            throw new \Exception('Could not execute logout', $exception->getCode(), $exception);
        }
    }

    public function getAuthRequest() : RequestInterface {
        return new \Allisa\Regisafe\Auth\Request\Logout();
    }

}