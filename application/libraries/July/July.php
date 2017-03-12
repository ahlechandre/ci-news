<?php

use Eduwiki\View\View as View;

/**
 * @author Alexandre Thebaldi <ahlechandre@gmail.com>
 */
class July
{
    /** 
     * 
     * @return void
     */ 
    public function __construct() {}

    /**
     * Returns the View instance.
     * 
     * @return Eduwiki\View\View
     */ 
    public static function view() {
        return View::instance();
    }

    /**
     * 
     * @return string|null
     */
    public static function partial($name, $arguments = null) {
        return View::partial($name, $arguments);
    }

    /**
     * 
     * @return void
     */
    public static function put($name, $content = null) {
        return View::put($name, $content);
    }

    /**
     * 
     * @return string|null
     */
    public static function placeholder($name) {
        return View::placeholder($name);
    }

    /**
     * @return string
     */
    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
