<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 11.10.2020
 * Time: 14:46
 */

return [
    'devMode' => true,
    'defaultController' => 'Site',
    'defaultAction' => 'index',
    'controllerNamespace'  => 'controllers\\',
    'errorPage' => 'site/error',
    'request' => \core\request\HTTPRequest::class,
    'response' => \core\response\WebHtmlResponse::class,
    'session' => \core\Session::getSession()
];