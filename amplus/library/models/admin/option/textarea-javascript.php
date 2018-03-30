<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/textarea.php');
class BFIAdminOptionTextareaJavascript extends BFIAdminOptionTextarea {
    
    protected function setProperties($args) {
        // this option has a specific id
        $args['id'] = BFI_SHORTNAME . '_' . BFI_OPTIONJAVASCRIPT;
        parent::setProperties($args);
    }
    
}

