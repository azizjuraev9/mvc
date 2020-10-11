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
    private string $errorPage;
    /**
     * @var bool
     */
    public bool $devMode = true;

    /**
     * @var string
     */
    private string $defaultController;

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
        try
        {

            $request = $this->getRequest();
            $this->route = new Route($this,$request->getRoute());

            call_user_func([ $this->route->getController(), $this->route->getAction() ]);

        }
        catch (\Throwable $e)
        {
            if($this->devMode)
            {
                throw $e;
            }
            else
            {
                $this->route = new Route($this,$this->errorPage);
                call_user_func([ $this->route->getController(), $this->route->getAction() ]);
                // --------------- LOG
            }
        }
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
    public function getControllerNamespace() : string
    {
        return $this->controllerNamespace;
    }

    /**
     * @return string
     */
    public function getDefaultAction() : string
    {
        return $this->defaultAction;
    }

    /**
     * @return string
     */
    public function getDefaultController()
    {
        return $this->defaultController;
    }

}