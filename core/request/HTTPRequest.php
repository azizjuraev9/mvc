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

    private array $request;

    public function __construct()
    {
        $this->request = $_SERVER;
    }

    public function getRoute(): string
    {
        return $this->request['REQUEST_URI'];
    }

    public function getData(): array
    {
        //--------
    }

    public function getType(): string
    {
        return $this->request['REQUEST_METHOD'];
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