<?php

class Home extends CI_Controller
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setHelpers();
        $this->setLibraries();
    }

    /**
     * Loads the home view.
     * 
     * @return void
     */ 
    public function index()
    {
        $this->july::view()->layout('default', [
            'title' => 'Home',
        ])->page('home')->render();
    }

    /**
     * Initializes libraries in $this object.
     * 
     * @return void
     */
     private function setHelpers() 
     {
        $this->load->helper('url');
     }

    /**
     * Initializes libraries in $this object.
     * 
     * @return void
     */
     private function setLibraries() 
     {
        $this->load->library('july');
     }
}
