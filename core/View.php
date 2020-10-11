<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 11.10.2020
 * Time: 18:15
 */

namespace core;


class View
{

    const LAYOUT_PATH = 'layouts/';

    /**
     * @var string
     */
    private string $viewPath;

    /**
     * @var Application
     */
    private Application $application;
    /**
     * @var WebController
     */
    private WebController $controller;

    public function __construct( Application $application, WebController $controller )
    {
        $this->application = $application;
        $this->controller = $controller;
    }

    public function render( string $viewPath, string $view, array $params = [] ) : string
    {
        $viewFile = $this->getFileName( $view, $viewPath );
        $layoutFile = $this->getFileName( $this->controller->layout, self::LAYOUT_PATH );

        $content = $this->renderFile( $viewFile, $params );
        $layout = $this->renderFile( $layoutFile, [
            'content' => $content,
        ] );
        return $layout;
    }

    public function renderFile( string $file, array $params = [] ) : string
    {
        ob_start();
        extract( $params, EXTR_OVERWRITE );
        require $file;
        return ob_get_clean();
    }

    private function getFileName( $file, $path ) : string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . $this->application->viewPath . $path . $file . '.php';
    }

}