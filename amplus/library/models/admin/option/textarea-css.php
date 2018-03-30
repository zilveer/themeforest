<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/textarea.php');
class BFIAdminOptionTextareaCSS extends BFIAdminOptionTextarea {
    
    protected function setProperties($args) {
        // this option has a specific id
        $args['id'] = BFI_SHORTNAME . '_' . BFI_OPTIONCSS;
        parent::setProperties($args);
    }
    
}