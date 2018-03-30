<?php

class BFISidebarController {
    
    private $sidebarModels = array();
    
    function __construct() {
        $this->loadSidebars();
        add_action('init', array($this, 'registerStaticSidebars'));
        add_action('init', array($this, 'registerDynamicSidebars'));
    }
       
    // load all sidebars in application/models/sidebar
    private function loadSidebars() {
        $definedClasses = get_declared_classes();
        $this->sidebarModels = array();
        foreach ($definedClasses as $i => $className) {
            if (preg_match('/^BFISidebar[a-zA-Z0-9]+Model$/', $className)) {
                $this->sidebarModels[] = new $className();
            }
        }
        $this->sortSidebars();
    }
    
    // sort admin panel models by their priority property. lower 
    private function sortSidebars() {
        usort($this->sidebarModels, array(__CLASS__, "sidebarCompare"));
    }

    // used by usort in sortAdminPanels()
    static protected function sidebarCompare($a, $b) {
        return $a->priority == $b->priority ? 0 : ($a->priority > $b->priority) ? 1 : -1;
    }
    
    // register all the static sidebars found in the app
    public function registerStaticSidebars() {
        foreach ($this->sidebarModels as $sidebar) {
            $sidebar->registerStaticSidebar();
        }
    }
    
    // loads all the dynamic sidebars created from the admin
    public function registerDynamicSidebars() {
        $sidebars = BFISidebarModel::getDynamicSidebars();
        
        foreach ($sidebars as $sidebar) {
            BFISidebarModel::registerDynamicSidebar($sidebar["name"], $sidebar["id"]);
        }
    }
    
}
