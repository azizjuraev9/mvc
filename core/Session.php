<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 19.10.2020
 * Time: 13:58
 */

namespace core;


class Session
{

    /**
     * @var Session
     */
    private static ?Session $instance = null;

    /**
     * @var array
     */
    private array $session;

    private function __construct()
    {
        session_start();
        $this->session = &$_SESSION;
    }

    public static function getSession() : Session
    {
        if( !self::$instance )
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getSID() : string
    {
        return SID;
    }

    public function get( $key )
    {
        return @$this->session[ $key ];
    }

    public function set( $key, $value ) : void
    {
        $this->session[ $key ] = $value;
    }

    public function unset( $key ) : void
    {
        unset($this->session[ $key ]);
    }

}