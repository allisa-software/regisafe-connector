<?php

namespace Allisa\Regisafe\Auth\Authenticator;

use Allisa\Regisafe\Auth\RequestInterface;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Description of Login
 * @author Voss <p.voss@charismateam.de>
 */
class Login implements \Allisa\Regisafe\Auth\AuthenticatorInterface {

    /**
     * @param RequestInterface $request
     * @return string
     * @throws \Exception
     */
    public function authenticate(RequestInterface $request) : string {
        $client = new Client();
        try {
            $response = $client->request(
                'POST',
                $request->getUrl(),
                [
                    RequestOptions::JSON => [
                        'apiID' => $request->getApiId(),
                        'loginID' => $request->getLoginId(),
                        'password' => $request->getPassword()
                    ]
                ]
            );
        } catch (\Throwable $exception) {
            throw new \Exception('Could not execute authentication', $exception->getCode(), $exception);
        }
        $responseObject = json_decode($response->getBody()->getContents());

        return $responseObject->sessionToken;
    }

    public function getAuthRequest() : RequestInterface {
        return new \Allisa\Regisafe\Auth\Request\Login();
    }
}