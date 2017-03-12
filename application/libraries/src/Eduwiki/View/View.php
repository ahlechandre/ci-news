<?php 

namespace Eduwiki\View;

use Eduwiki\Services\Singleton;

/**
 * @author Alexandre Thebaldi <ahlechandre@gmail.com>
 */
class View extends Singleton
{
    /**
     * The single object instance of view.
     * 
     * @var \Eduwiki\View\View|null
     */
    protected static $_instance = null;

    /**
     * 
     * @return void
     */
    public function __construct() {}

    /**
     *
     * @return string
     */
    public static function get($view, $data = null) {
        return self::ci()->load->view($view, $data, true);
    }

    /**
     *
     * @return \Eduwiki\View\Layout
     */
    public function layout($name, $data = null) {
        $layout = new Layout;
        $layout->setState(['layout' => [
            'name' => $name,
            'data' => $data,
        ]]);
        return $layout;
    }

    /**
     *
     * @return \Eduwiki\View\Page
     */
     public function page($name, $data = null) {
        $page = new Page;
        $page->setState(['page' => [
            'name' => $name,
            'data' => $data,
        ]]);
        return $page;         
     }

    /**
     * 
     * @return string|null
     */
    public static function partial($name, $arguments = null) {
        return Partial::get($name, $arguments);
    }

    /**
     *
     * @return string|null
     */
     public static function placeholder($name) {
        return Placeholder::instance()->get($name);
     }

    /**
     *
     * @return void
     */
     public static function put($name, $content = null) {
        return Placeholder::instance()->set($name, $content);
     }
}
