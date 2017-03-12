<?php

namespace Eduwiki\View;

class Page
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
     * @return void
     */
    public function layout($name, $data = null) {
        $newState = array_merge($this->state, [
            'layout' => [
                'name' => $name,
                'data' => $data,
            ],
        ]);
        $this->setState($newState);
        return $this;
    }

    /**
     * 
     * 
     * @return void
     */
    public function render() {
        $layoutNotLoaded = (!isset($this->state['layout']) || empty($this->state['layout']) 
        || !isset($this->state['layout']['name']) || !$this->state['layout']['name']);

        $pageNotLoaded = (!isset($this->state['page']) || empty($this->state['page']) 
        || !isset($this->state['page']['name']) || !$this->state['page']['name']);

        // Ends if either layout and page are not loaded.
        if ($layoutNotLoaded && $pageNotLoaded) 
            return;

        if ($layoutNotLoaded && !$pageNotLoaded) {
            echo $this->getPageViewOnly($this->state['page']);
            return;            
        }

        if (!$layoutNotLoaded && !$pageNotLoaded) {
            echo $this->getView($this->state['layout'], $this->state['page']);
            return;            
        }
    }

    /**
     *
     * @return string
     */ 
     private static function getPageViewOnly($pageState) {
        $pageName = $pageState['name']; 
        $pageData = $pageState['data'];
        return self::ci()->load->view("pages/{$pageName}", $pageData, true);
     }

    /**
     *
     * @return string
     */
     private static function getView($layoutState, $pageState) {
        $layoutName = $layoutState['name'];
        $layoutData = $layoutState['data'];
        $pageName = $pageState['name'];
        $pageData = $pageState['data'];
        $pageView = self::ci()->load->view("pages/{$pageName}", $pageData, true);
        $pageViewData = ['page' => $pageView];
        unset($layoutData['page']);
        $layoutViewData = $layoutData ? 
            array_merge($pageViewData, $layoutData) : $pageViewData;
        return self::ci()->load->view("layouts/{$layoutName}", $layoutViewData, true);
     }
}
