<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 11.10.2020
 * Time: 20:15
 */

namespace core;


use core\request\IRequest;
use core\response\IResponse;

interface IController
{

    public function __construct(
        Application $application,
        IRequest $request,
        IResponse $response
    );

}