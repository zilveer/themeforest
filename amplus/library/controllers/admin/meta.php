<?php

class BFIAdminMetaController {
    
    private $metaModels = array();
    
    function __construct() {
        $this->loadMetaModels();
        $this->registerMetaModels();
    }
       
    // load all meta boxes in application/models/admin/meta
    private function loadMetaModels() {
        $definedClasses = get_declared_classes();
        $this->metaModels = array();
        foreach ($definedClasses as $i => $className) {
            if (preg_match('/^BFIAdminMeta[a-zA-Z0-9]+Model$/', $className)) {
                if ($className == 'BFIAdminMetaOptionModel') continue;
                $this->metaModels[] = new $className();
            }
        }
        $this->sortMetaBoxes();
    }    
    
    private function registerMetaModels() {
        foreach ($this->metaModels as $metaModel)
            $metaModel->register();
    }
    
    private function sortMetaBoxes() {
        usort($this->metaModels, array(__CLASS__, "adminPanelCompare"));
    }
    
    // used by usort in sortAdminPanels()
    static protected function adminPanelCompare($a, $b) {
        return $a->priority == $b->priority ? 0 : ($a->priority > $b->priority) ? 1 : -1;
    }
}
