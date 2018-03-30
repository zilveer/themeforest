<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/boolean.php');
class BFIAdminOptionBooleanCdn extends BFIAdminOptionBoolean implements iBFIAdminOption {
    
    protected function setProperties($args) {
        // this option has a specific id
        $args['id'] = BFI_SHORTNAME . '_' . BFI_CDNOPTION;
        parent::setProperties($args);
    }
    
}
