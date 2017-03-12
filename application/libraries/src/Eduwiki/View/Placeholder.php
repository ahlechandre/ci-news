<?php

namespace Eduwiki\View;

use Eduwiki\Services\Singleton;

/**
 * @author Alexandre Thebaldi <ahlechandre@gmail.com>
 */
class Placeholder extends Singleton
{
    /**
     * The single object instance of placeholder.
     * 
     * @var \Eduwiki\View\Placeholder|null
     */
    protected static $_instance = null;
    
    /**
     * All registered placeholders name and content.
     * 
     * @var mixed[]
     */    
    protected $store = [];

    /**
     * 
     * @return void 
     */ 
    function __construct() {}

    /**
     * Search for a placeholder content to prints.
     * 
     * @param string $placeholder The placeholder name. 
     * @param mixed $content The placeholder content. 
     * @return mixed|null
     */ 
    function get($placeholder) {
        // Checks if placeholder exists.
        if ($placeholder && array_key_exists($placeholder, $this->store)) {
            $content = $this->store[$placeholder];
            
            // Checks if placeholder has a content and prints it.
            if ($content) {
                return $content;
            }
        }        
        return null;
    }

    /**
     * Assigns the content to placeholder name and stores it.
     * 
     * @param string $placeholder The placeholder name. 
     * @param mixed $content The placeholder content. 
     * @return void
     */ 
    function set($placeholder, $content = null) {
        $this->store[$placeholder] = $content;
    }
}
