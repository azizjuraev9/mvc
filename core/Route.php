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
    private $route;

    /**
     * @var Application
     */
    private $application;

    /**
     * Route constructor.
     * @param Application $application
     * @param string $route
     */
    public function __construct(Application $application, string $route)
    {
        $this->route = $route;
        $this->application = $application;
    }

    public function getController() : string
    {

    }

    public function getAction() : string
    {

    }

    private function getRoute() : string
    {

    }
}