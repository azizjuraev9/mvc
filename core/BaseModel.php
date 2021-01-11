<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 20.10.2020
 * Time: 17:35
 */

namespace core;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

class BaseModel
{

    public array $errors = [];

    private static EntityManagerInterface $entityManager;

    public function __construct(array $params)
    {
        $this->load($params);
    }

    public function validate() : bool
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $violations = $validator->validate($this);

        $this->setErrors($violations);

        return count($this->errors) === 0;
    }

    public function load(array $params) : void
    {
        foreach ( $params as $param => $value )
        {
            if( property_exists($this, $param ) )
            {
                $this->$param = $value;
            }
        }
    }

    public static function findOne($id) : ?BaseModel
    {
        return self::$entityManager->find(static::class, $id);
    }

    public static function find() : ObjectRepository
    {
        return self::$entityManager->getRepository(static::class);
    }

    protected function setErrors(ConstraintViolationListInterface $violations) : void
    {
        foreach ($violations as $violation)
        {
            /**
             * @var ConstraintViolationInterface $violation
             */
            $this->errors[$violation->getPropertyPath()] = $violation->getMessage();
        }
    }

    public static function setEntityManager(EntityManagerInterface $entityManager) : void
    {
        self::$entityManager = $entityManager;
    }

    public static function getEntityManager() : EntityManagerInterface
    {
        return self::$entityManager;
    }
}