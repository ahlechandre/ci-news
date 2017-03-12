<?php

namespace Eduwiki\View;

use Eduwiki\View\Page;

class Layout
{
    use \Eduwiki\Traits\Base;

    /**
     * 
     * @return void
     */
    public function __construct() {}

    /**
     *
     *
     */
    public function page($name, $data = null) {
        $page = new Page;
        $pageState = [
            'page' => [
                'name' => $name,
                'data' => $data,
            ]
        ];
        $page->setState(array_merge($this->state, $pageState));
        return $page;
    }

    /**
     * 
     * 
     * @return void
     */
    public function render() {
        $layoutNotLoaded = (!isset($this->state['layout']) || empty($this->state['layout']) 
        || !isset($this->state['layout']['name']) || !$this->state['layout']['name']);

        // Checks if some layout is loaded.
        if ($layoutNotLoaded) return;

        $layoutName = $this->state['layout']['name']; 
        $layoutData = $this->state['layout']['data'];
        echo self::ci()->load->view("layouts/{$layoutName}", $layoutData, true);
    }
}
