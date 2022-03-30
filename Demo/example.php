<?php

require_once __DIR__ . '/../vendor/autoload.php';

const API_ID = '';
const AUTH_URL = '';
const LOGOUT_URL = '';
const WRITE_URL = '';

const LOGIN_ID = '';
const PASSWORD = '';

const FOLDER_ID = '';
const TYPE = '';
const DOCUMENT_ID = '';
const DOCUMENT_NAME = 'Testdokument';


$file = file_get_contents(__DIR__ . '/files/Testdokument.pdf');

try {
    $auth = new Allisa\Regisafe\Auth\Authenticator\Login();
    $authRequest = $auth->getAuthRequest();
    $authRequest->setUrl(AUTH_URL)
        ->setLoginId(LOGIN_ID)
        ->setApiId(API_ID)
        ->setPassword(PASSWORD);
    $sessionToken = $auth->authenticate($authRequest);
} catch (Exception $exception) {
    error_log('Loginfehler am Regisafe Server: ' . $exception->getMessage());
    exit;
}


try {
    $writer = new Allisa\Regisafe\Writer\AuthWriter();
    $fileRequest = $writer->getDocumentRequestBuilder();
    $fileRequest->setApiId(API_ID)
        ->setDocId(DOCUMENT_ID)
        ->setFolderId(FOLDER_ID)
        ->setType(TYPE)
        ->setSessionToken($sessionToken)
        ->setUrl(WRITE_URL)
        ->addFilenameBinaryPair(DOCUMENT_NAME, base64_encode($file));

    $response = $writer->writeDocument($fileRequest);
} catch (Exception $exception) {
    error_log('Dokument konnte nicht an Regisafe übertragen werden: ' . $exception->getMessage());
    exit;
}

try {
    $logoutAuthenticator = new \Allisa\Regisafe\Auth\Authenticator\Logout();
    $request = $logoutAuthenticator->getAuthRequest();
    $request->setUrl(LOGOUT_URL)
        ->setApiId(API_ID)
        ->setSessionToken($sessionToken);
    $logoutAuthenticator->authenticate($request);
} catch (Exception $exception) {
    error_log('Logoutfehler am Regisafe Server: ' . $exception->getMessage());
    exit;
}
