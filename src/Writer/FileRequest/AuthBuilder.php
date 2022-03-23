<?php

namespace Allisa\Regisafe\Writer\FileRequest;

use Allisa\Regisafe\Writer\RequestInterface;

/**
 * Description of AuthBuilderBuilder
 * @AuthBuilderor Voss <p.voss@charismateam.de>
 */
class AuthBuilder implements RequestInterface {

    protected $url;

    protected $apiId;

    protected $sessionToken;

    protected $docId;

    protected $folderId;

    protected $type;

    protected $metaData = [];

    protected $binaries = [];

    protected $filePath;

    protected $binaryFile;


    public function getUrl() : string {
        return $this->url;
    }

    public function setUrl(string $url) : AuthBuilder {
        $this->url = $url;

        return $this;
    }

    public function setFolderId(string $folderId): AuthBuilder {
        $this->folderId = $folderId;

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

    public function setDocId(string $docId) : AuthBuilder {
        $this->docId = $docId;

        return $this;
    }

    public function setFilePath(string $filePath) : AuthBuilder {
        $this->filePath = $filePath;

        return $this;
    }

    public function setBinaryFile(string $binaryFile) : AuthBuilder {
        $this->binaryFile = $binaryFile;

        return $this;
    }

    public function setType(string $type): AuthBuilder {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     * @throws \Exception
     */
    public function addMetadata(string $key, string $value) : AuthBuilder {
        if (isset($this->metaData[$key])) {
            throw new \Exception('Metadata ' . $key . ' already exists in datastack.');
        }
        $this->metaData[$key] = $value;

        return $this;
    }

    /**
     * @param string $filename
     * @param string $binary
     * @return $this
     * @throws \Exception
     */
    public function addFilenameBinaryPair(string $filename, string $binary) : AuthBuilder {
        if (isset($this->binaries[$filename])) {
            throw new \Exception('File ' . $filename . ' already exists in filestack.');
        }
        $this->binaries[$filename] = $binary;

        return $this;
    }


    public function getParams() : array {
        $params = [
            'apiId' => $this->apiId,
            'sessionToken' => $this->sessionToken,
            'folderID' => $this->folderId,
            'type' => $this->type
        ];

        if ($this->docId) {
            $params['docId'] = $this->docId;
        }

        foreach ($this->metaData as $key => $value) {
            $params['metaData'][$key] = $value;
        }

        if ($this->filePath) {
            $params['fileName'] = $this->filePath;
        }
        if ($this->binaryFile) {
            $params['binary'] = $this->binaryFile;
        }
        foreach ($this->binaries as $filename => $binary) {
            $params['binary'][$filename] = $binary;
        }

        return $params;
    }

}