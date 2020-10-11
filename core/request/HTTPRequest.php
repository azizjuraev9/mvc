<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 11.10.2020
 * Time: 17:02
 */

namespace core\request;


class HTTPRequest implements IRequest
{

    public function getRoute(): string
    {
        return 'sdfsdf';
    }

    public function getData(): array
    {
        // TODO: Implement getData() method.
    }

    public function getType(): string
    {
        // TODO: Implement getType() method.
    }

    public function getController(): string
    {
        // TODO: Implement getController() method.
    }

    public function getAction(): string
    {
        // TODO: Implement getAction() method.
    }
}