<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 19.10.2020
 * Time: 14:25
 */

namespace models\forms;

use core\BaseModel;
use Doctrine\ORM\Mapping as ORM;
use models\User;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

/**
 * Class UserForm
 * @package models
 */

class LoginForm extends BaseModel
{

    /**
     * @Assert\Email()
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    public $username;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    public $password;

    public function login() : bool
    {
        $user = User::getCurrentUser();
        if($user !== null)
        {
            return false;
        }

        if( !$this->validate() )
        {
            return false;
        }

        /**
         * @var User $user
         */
        $user = User::find()->findOneBy(['email' => $this->username]);

        if(!$user)
        {
            $this->errors['email'] = 'No user found by this email';
            return false;
        }

        if(!$user->validatePassword($this->password))
        {
            $this->errors['password'] = 'Incorrect password';
            return false;
        }

        User::setCurrentUser($user);

        return true;
    }

}