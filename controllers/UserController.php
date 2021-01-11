<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 22.10.2020
 * Time: 23:34
 */

namespace controllers;


use core\Session;
use core\WebController;
use models\forms\LoginForm;
use models\User;

class UserController extends WebController
{

    public function actionLogin() : string
    {
        $form = new LoginForm($_POST);

        if($this->request->getType() === 'POST' && $form->login())
        {
            header('Location: /site/index');
        }

        return $this->render('login',[
            'errors' => $form->errors
        ]);
    }

    public function actionLogout() : void
    {
        User::logout();
        header('Location: /site/index');
    }

}