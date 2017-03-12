<?php

namespace Eduwiki\Traits;

/**
 * 
 */
trait Base
{
    /**
     * The codeigniter loader instance.
     * 
     * @var CI_Loader 
     */
    protected static $_ci;

    /**
     *
     *
     */
    protected $state = [];

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
    public function setState($newState) {
        $this->state = $newState;
    }
}

