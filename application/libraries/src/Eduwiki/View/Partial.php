<?php

namespace Eduwiki\View;

use Eduwiki\Services\Singleton;

class Partial extends Singleton
{
    use \Eduwiki\Traits\Base;

    /**
     * The single object instance of partial.
     * 
     * @var \Eduwiki\View\Partial|null
     */
    protected static $_instance = null;

    /**
     * 
     * @return void
     */
    public function __construct() {}

    /**
     * Loads and prints a partial view. 
     * 
     * @param string $partial The partial filename.
     * @param mixed[]|null $arguments The arguments passed to the partial view.
     * @return mixed|null
     */
    public static function get($partial, $arguments = null) {
        $content = self::ci()->load->view("partials/{$partial}", $arguments, true);
        return $content ? $content : null;
    }
}
