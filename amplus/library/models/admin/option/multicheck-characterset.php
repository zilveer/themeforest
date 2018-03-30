<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/multicheck.php');
class BFIAdminOptionMulticheckCharacterSet extends BFIAdminOptionMulticheck {
    
    protected function setProperties($args) {
        // this option has a specific id
        $args['id'] = BFI_SHORTNAME . '_' . BFI_CHARACTERSETOPTION;
        $args['std'] = array("latin");
        parent::setProperties($args);
    }
    
    public function display() {
        $this->properties["options"] = array(
            "Latin (latin)", 
            "Cyrillic Extended (cyrillic-ext)", 
            "Greek Extended (greek-ext)", 
            "Greek (greek)", 
            "Latin Extended (latin-ext)", 
            "Vietnamese (vietnamese)", 
            "Cyrillic (cyrillic)"
        );
        $this->properties["values"] = array(
            "latin", 
            "cyrillic-ext", 
            "greek-ext", 
            "greek", 
            "latin-ext", 
            "vietnamese", 
            "cyrillic"
        );
        
        parent::display();
    }
}
