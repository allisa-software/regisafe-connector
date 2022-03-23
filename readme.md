# Regisafe Connector

## Voraussetzungen

* PHP Version mindestens 7.1
* JSON-Extension aktiviert
* Composer installiert

## Installation

* Codepaket herunterladen und im Zielverzeichnis entpacken
* Abhängigkeiten mit Composer installieren: `composer install`

## Verwendung

Die Regisafe-API kann mit einem SessionToken oder einer Adhoch-Authentifizierung angesprochen werden. Dieses Projekt enthält eine Implementierung, mit der der die Authentifizierungs-Funktion der Regisafe-API angesprochen wird, um einen SessionToken zu erhalten. Dieser SessionToken wird für weitere Requests an die Regisafe-API verwendet.

Unter "Demo" ist ein Beispiel zur Verwendung der einzelnen Komponenten enthalten.

### Initialisierung

Die Bibliothek kann über die `autoload.php` aus dem `vendor` Verzeichnis in ein Projekt eingebunden werden.

```
require_once __DIR__ . '/../vendor/autoload.php';
```

Der Autoloader entspricht der PSR-4 Spezifikation: https://www.php-fig.org/psr/psr-4/

### Authentifizierung

Um einen SessionToken zu erhalten, gibt es zwei Methoden zur Authentifizierung:

* per LoginID und Passwort
* per LoginData

In diesem Projekt wurde die Methode zur Authentifizierung per LoginID und Passwort implementiert.

Im ersten Schritt wird der Authenticator initialisiert. Anhand der getAuthRequest-Methode des Authenticators, erhält man ein Request-Objekt, welches die zur Authentifizierung benötigten Parameter annimmt. Das befüllte Request-Objekt wird an die authenticate-Methode des Authenticators übergeben, um die Authentifizierung durchzuführen.

Der Rückgabewert der Authentifizierung ist der SessionToken als String. Falls die Authentifizierung fehlschlägt, wirft der Authenticator eine Exception.

Beispiel:

```
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
```

### Dokument versenden

Dokumente können über Writer-Klassen an die Regisafe-API versendet werden. Dafür müssen die Klassen das WriterInterface implementieren. Writer-Klassen enthalten die Methoden getDocumentRequestBuilder und getFolderRequestBuilder, welche Objekte zurückgeben, mit denen Anfragen zum Versenden von Dokumenten oder zum Anlegen bzw. Updaten von Foldern befüllt werden können.

Anhand der Methoden writeDocument und createFolder kann das entsprechende Request-Objekt übergeben werden, um die entsprechende Operation durchzuführen.

Die Methode writeDocument gibt die DocID zurück, wenn das Dokument erfolgreich in Regisafe gespeichert werden konnte. Falls das Speichern nicht erfolgreich war, wirft der Writer eine Exception.

Beispiel:

```
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
```

## Erweiterung

Die Authenticator- und Writer-Klassen müssen nicht zwangsläufig verwendet werden. Um eigene Klassen zu schreiben reicht es, die einzelnen Interfaces zu implementieren.

Einsatzszenarien für eigene Klassen wären zum Beispiel die Implementierung eines LoginData-Authenticators, zur Authentifizierung über das LoginData-Feld der Regisafe-API, oder eines Adhoc-Writers, um Dokumente ohne einen vorherigen Authentifizierungsvorgang durchzuführen.

Um einen LoginData-Authenticator zu implementieren, kann eine neue Klasse das AuthenticatorInterface implementieren und anschließend die passenden Werte aus einer Request-Klasse entnehmen.

Zur Implementierung eines Writers zum Adhoc Versand von Dokumenten, kann ein neues Request-Objekt anhand des `Allisa\Regisafe\Writer\RequestInterface` implementiert werden. Das Request-Objekt kann weitere Datenfelder zur Adhoc Authentifizierung enthalten und über die `getParams` Methode eine passende Datenstruktur zum Aufruf der API zurückgeben.
