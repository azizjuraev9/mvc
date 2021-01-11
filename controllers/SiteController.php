<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 11.10.2020
 * Time: 16:57
 */

namespace controllers;

use core\WebController;
use models\forms\LoginForm;
use models\User;

class SiteController extends WebController
{

    public function actionIndex() : string
    {
        $user = User::getCurrentUser();

        return $this->render('index',[
            'user' => $user
        ]);
    }

}