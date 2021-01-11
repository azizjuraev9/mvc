<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 20.10.2020
 * Time: 18:01
 */

namespace models;

use core\BaseModel;
use core\Session;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Entity
 * @Table(name="users")
 */
class User extends BaseModel
{

    const SESSION_USER_ID_KEY = 'CURRENT_USER_ID';

    private static ?User $user = null;

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    public ?string $username = null;

    /**
     * @Assert\Email()
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    public ?string $email = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    public ?string $password = null;

    public static function getCurrentUser() : ?User
    {
        if(self::$user)
        {
            return self::$user;
        }

        $id = Session::getSession()->get(self::SESSION_USER_ID_KEY);

        if( !$id )
        {
            return null;
        }

        self::$user = self::findOne($id);

        return self::$user;
    }

    public static function setCurrentUser(User $user) : void
    {
        self::$user = $user;
        Session::getSession()->set(self::SESSION_USER_ID_KEY,$user->id);
    }

    public static function logout() : void
    {
        Session::getSession()->unset(self::SESSION_USER_ID_KEY);
    }

    public function validatePassword(string $password) : bool
    {
        return password_verify($password,$this->password);
    }

    public function setPassword(string $password) : void
    {
        $this->password = self::password_hash($password);
    }

    public static function password_hash(string $password) : string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}