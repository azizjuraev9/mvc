<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 07.10.2020
 * Time: 13:24
 */

namespace core;

use core\request\IRequest;
use core\response\IResponse;

class Application
{

    /**
     * @var string
     */
    private string $defaultRoute;

    /**
     * @var string
     */
    private string $defaultAction;

    /**
     * @var string
     */
    private string $controllerNamespace;


    /**
     * @var IRequest
     */
    private IRequest $request;

    /**
     * @var IResponse
     */
    private IResponse $response;

    /**
     * @var Route
     */
    private Route $route;

    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        foreach ( $config as $param => $value )
        {
            if( isset( $this->$param ) )
            {
                $this->param = $value;
            }
        }
    }

    public function run()
    {
        $request = $this->getRequest();
        $this->route = new Route($this,$request->getRoute());

    }

    /**
     * @return IRequest
     */
    public function getRequest() : IRequest
    {
        return $this->request;
    }

    /**
     * @return IResponse
     */
    public function getResponse() : IResponse
    {
        return $this->response;
    }

    /**
     * @return Route
     */
    public function getRoute() : Route
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getControllerNamespace()
    {
        return $this->controllerNamespace;
    }

    /**
     * @return string
     */
    public function getDefaultAction()
    {
        return $this->defaultAction;
    }

    /**
     * @return string
     */
    public function getDefaultRoute()
    {
        return $this->defaultRoute;
    }

}