<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 11.10.2020
 * Time: 18:10
 */

namespace core;



use core\request\IRequest;
use core\response\IResponse;

class WebController implements IController
{

    /**
     * @var Application
     */
    public Application $application;

    /**
     * @var IRequest
     */
    public IRequest $request;

    /**
     * @var IResponse
     */
    public IResponse $response;

    /**
     * @var string
     */
    public string $layout = 'main';

    /**
     * @var View
     */
    public View $view;

    /**
     * @var string
     */
    public ?string $viewPath = '';

    public function __construct(
        Application $application,
        IRequest $request,
        IResponse $response
    )
    {

        $this->application = $application;
        $this->request = $request;
        $this->response = $response;
        $this->view = new View( $this->application, $this );
    }

    public function render( $view, $params = [] ) : string
    {
        $viewPath = $this->getViewPath();
        return $this->view->render($viewPath,$view,$params);
    }

    private function getViewPath()
    {

        if( !empty($this->viewPath) )
        {
            return $this->viewPath;
        }

        $path = basename(static::class);
        $path = str_replace('Controller','', $path);
        $path = strtolower( $path );
        return $path . '/';
    }

}