<?php

namespace Eduwiki\Services;

class Singleton
{
    /**
     * The instance of child class since it does not defines 
     * his proper {$_instance} variable.
     * 
     * @var mixed
     */
    protected static $_instance = null;

    /**
     * The codeigniter loader instance.
     * 
     * @var CI_Loader 
     */
    protected static $_ci;

    /**
     * Never called.
     * 
     * @return void
     */
    private function __construct() {}

    /**
     * Returns the codeigniter instance.
     * 
     * @return CI_Loader
     */
    protected static function ci() {
        if (!isset(self::$_ci)) {
            self::$_ci =& get_instance();
        }

        return self::$_ci;
    }

    /**
     *
     *
     */
    protected function setState($newState) {
        $this->state = $newState;
    }

    /**
     * Creates a unique instance of called child class if it does not
     * already exists.
     *
     * @return mixed|null
     */
    public static function instance() {

        // Checks if called class already has his instance been created.
        if (!isset(static::$_instance)) {
            static::$_instance = new static;
        } 

        return static::$_instance;
    }
}
