<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 11.10.2020
 * Time: 17:03
 */

namespace core\response;


class WebHtmlResponse implements IResponse
{

    public function send($data): void
    {
        echo $data;
    }
}