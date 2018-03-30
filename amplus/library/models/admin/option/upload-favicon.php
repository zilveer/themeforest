<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/upload.php');
class BFIAdminOptionUploadFavicon extends BFIAdminOptionUpload {
    
    protected function setProperties($args) {
        // this option has a specific id
        $args['id'] = BFI_SHORTNAME . '_' . BFI_OPTIONFAVICON;
        $args['placeholder'] = site_url()."/favicon.ico";
        parent::setProperties($args);
    }
    
}
