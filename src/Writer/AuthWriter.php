<?php

namespace Allisa\Regisafe\Writer;

use Allisa\Regisafe\Writer\FileRequest\AuthBuilder as FileRequestBuilder;
use Allisa\Regisafe\Writer\FolderRequest\AuthBuilder as FolderRequestBuilder;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Description of Writer
 * @author Voss <p.voss@charismateam.de>
 */
class AuthWriter implements WriterInterface {


    public function getFolderRequestBuilder(): FolderRequestBuilder {
        return new FolderRequestBuilder();
    }

    public function getDocumentRequestBuilder(): FileRequestBuilder {
        return new FileRequestBuilder();
    }

    /**
     * @param RequestInterface $request
     * @return string
     * @throws \Exception
     */
    public function createFolder(RequestInterface $request): string {
        $client = new Client();

        try {
            $response = $client->request('POST', $request->getUrl(), [RequestOptions::JSON => $request->getParams()]);
            $responseObject = json_decode($response->getBody()->getContents());
            return $responseObject->folderID;
        } catch (\Throwable $guzzleException) {
            throw new \Exception($guzzleException->getMessage(), $guzzleException->getCode(), $guzzleException);
        }
    }

    /**
     * @param RequestInterface $request
     * @return string
     * @throws \Exception
     */
    public function writeDocument(RequestInterface $request): string {
        $client = new Client();
        try {
            $response = $client->request('POST', $request->getUrl(), [RequestOptions::JSON => $request->getParams()]);
            $responseObject = json_decode($response->getBody()->getContents());
            return $responseObject->docID;
        } catch (\Throwable $guzzleException) {
            throw new \Exception($guzzleException->getMessage(), $guzzleException->getCode(), $guzzleException);
        }
    }


}