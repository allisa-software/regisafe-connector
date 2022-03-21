<?php

namespace Allisa\Regisafe\Writer;

use Allisa\Regisafe\Auth\AuthenticatorInterface;

/**
 * Description of FactoryInterface
 * @author Voss <p.voss@charismateam.de>
 */
interface WriterInterface {

    public function getDocumentRequestBuilder();

    public function getFolderRequestBuilder();

    /**
     * @param RequestInterface $request
     * @return string
     * @throws \Exception
     */
    public function writeDocument(RequestInterface $request): string;

    /**
     * @param RequestInterface $request
     * @return string
     * @throws \Exception
     */
    public function createFolder(RequestInterface $request): string;

}