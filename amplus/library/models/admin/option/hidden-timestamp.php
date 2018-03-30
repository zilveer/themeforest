<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/text.php');

/* 
 * this is an option that saves the current time everytime
 * it gets saved or reset. Perfect for detecting admin panel changes
 */
class BFIAdminOptionHiddenTimestamp extends BFIAdminOptionText {
    
    public function display() {
        printf("<input name=\"%s\" id=\"%s\" type=\"hidden\" value=\"%s\"\>",
            $this->getID(),
            $this->getID(),
            date("U"));
    }
    
    // there is no REAL reset. Every reset still increments the version
    public function resetAsOption() {
        bfi_update_option($this->getID(), date("U"));
    }
}
