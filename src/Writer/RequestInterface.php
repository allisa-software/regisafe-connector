<?php

namespace Allisa\Regisafe\Writer;

/**
 * Description of RequestInterface
 * @author Voss <p.voss@charismateam.de>
 */
interface RequestInterface {

    public function getUrl(): string;

    public function getParams(): array;

}