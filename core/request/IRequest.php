<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 07.10.2020
 * Time: 13:26
 */
namespace core\request;

interface IRequest
{

    public function getRoute() : string;

    public function getData() : array;

    public function getType() : string;

    public function getController() : string;

    public function getAction() : string;

}