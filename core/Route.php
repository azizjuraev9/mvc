<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 07.10.2020
 * Time: 17:15
 */

namespace core;


class Route
{

    /**
     * @var string
     */
    private string $route;

    /**
     * @var Application
     */
    private Application $application;

    /**
     * @var string
     */
    private string $controller;

    /**
     * @var string
     */
    private string $_controller;

    /**
     * @var string
     */
    private string $action;

    /**
     * @var string
     */
    private string $_action;

    /**
     * Route constructor.
     * @param Application $application
     * @param string $route
     */
    public function __construct(Application $application, string $route)
    {
        $this->route = $route;
        $this->application = $application;

        $_route = explode($route);
        $this->_controller = $_route[0] ?? '';
        $this->_action = $_route[1] ?? '';

    }

    public function getController() : string
    {
        if( !empty( $this->controller ) )
        {
            return $this->controller;
        }


        $controller = $this->application->getControllerNamespace() . ucfirst($this->_controller);
        if( class_exists( $controller ) )
        {
            $this->controller = $controller;
            return $controller;
        }
        elseif ($this->application->devMode)
        {
            throw new \HttpException("Controller {$controller} not found",404);
        }


        $controller = $this->application->getControllerNamespace() . ucfirst($this->application->getDefaultController());
        if( class_exists( $controller ) )
        {
            $this->controller = $controller;
            return $controller;
        }

        throw new \HttpException('Route not found',404);
    }

    public function getAction() : string
    {
        if( !empty( $this->action ) )
        {
            return $this->action;
        }


        $action = 'action' . ucfirst($this->_action);
        if( is_callable([ $this->getController() , $action ]) )
        {
            $this->action = $action;
            return $this->action;
        }
        elseif ($this->application->devMode)
        {
            throw new \HttpException("Action {$action} does not exists in {$controller}",404);
        }


        $action = 'action' . ucfirst($this->application->getDefaultAction());
        if( is_callable([ $this->getController() , $action ]) )
        {
            $this->action = $action;
            return $this->action;
        }


        throw new \HttpException('Route not found',404);
    }

    private function getRoute() : string
    {
        return $this->route;
    }
}