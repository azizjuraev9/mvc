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
     * @var bool
     */
    public bool $devMode = true;

    /**
     * @var string
     */
    public string $viewPath = 'views/';

    /**
     * @var Session
     */
    public Session $session;

    /**
     * @var string
     */
    private string $errorPage;

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
     * @var string
     */
    private string $request;

    /**
     * @var IRequest
     */
    private ?IRequest $_request = null;

    /**
     * @var string
     */
    private string $response;

    /**
     * @var IResponse
     */
    private ?IResponse $_response = null;

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
            if( property_exists($this, $param ) )
            {
                $this->$param = $value;
            }
        }
    }

    public function run()
    {
        try
        {

            $request = $this->getRequest();
            $route = $request->getRoute();
            $route = $route === '/' ? '/'.$this->defaultController . '/' . $this->defaultAction : $route;
//            var_dump($route);die;
            $this->route = new Route($this,$route);

            $controller = $this->route->getController();
            $controller = new $controller( $this, $this->getRequest(), $this->getResponse() );

            $action = $this->route->getAction();


            $result = $controller->$action();

            $this->getResponse()->send($result);
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

                $controller = $this->route->getController();
                $controller = new $controller( $this, $this->getRequest(), $this->getResponse() );

                $action = $this->route->getAction();

                $result = $controller->$action();

                $this->getResponse()->send($result);
                // --------------- LOG
            }
        }
    }

    /**
     * @return IRequest
     */
    public function getRequest() : IRequest
    {
        if ( !is_null( $this->_request ) )
        {
            return $this->_request;
        }
        elseif ( !empty( $this->request ) )
        {
            $this->_request = new $this->request;
            return $this->getRequest();
        }
        throw new \ErrorException('Request must be instance of ' . IRequest::class,500);
    }

    /**
     * @return IResponse
     */
    public function getResponse() : IResponse
    {
        if ( !is_null( $this->_response ) )
        {
            return $this->_response;
        }
        elseif ( !empty( $this->response ) )
        {
            $this->_response = new $this->response;
            return $this->getResponse();
        }
        throw new \ErrorException('Request must be instance of ' . IRequest::class,500);
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