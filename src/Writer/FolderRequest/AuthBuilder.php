<?php

namespace Allisa\Regisafe\Writer\FolderRequest;

use Allisa\Regisafe\Writer\RequestInterface;

/**
 * Description of AuthBuilderBuilder
 * @AuthBuilderor Voss <p.voss@charismateam.de>
 */
class AuthBuilder implements RequestInterface {

    protected $url;

    protected $apiId;

    protected $sessionToken;

    protected $folderId;

    protected $type;

    protected $metaData = [];


    public function getUrl() : string {
        return $this->url;
    }

    public function setUrl(string $url) : AuthBuilder {
        $this->url = $url;

        return $this;
    }

    public function setApiId(string $apiId) : AuthBuilder {
        $this->apiId = $apiId;

        return $this;
    }

    public function setSessionToken(string $sessionToken) : AuthBuilder {
        $this->sessionToken = $sessionToken;

        return $this;
    }

    public function addMetadata(string $key, string $value) : AuthBuilder {
        if (isset($this->metaData[$key])) {
            throw new \Exception('Metadata ' . $key . ' already exists in datastack.');
        }
        $this->metaData[$key] = $value;

        return $this;
    }



    public function getParams() : array {
        $params = [
            'apiId' => $this->apiId,
            'sessionToken' => $this->sessionToken,
            'type' => $this->type,
        ];

        if ($this->folderId) {
            $params['folderId'] = $this->folderId;
        }

        foreach ($this->metaData as $key => $value) {
            $params['metaData'][$key] = $value;
        }

        return $params;
    }

}