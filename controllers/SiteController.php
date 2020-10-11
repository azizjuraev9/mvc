<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 11.10.2020
 * Time: 16:57
 */

namespace controllers;

use core\WebController;

class SiteController extends WebController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}