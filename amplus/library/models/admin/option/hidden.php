<?php

class BFIAdminOptionHidden extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        $this->echoOptionHeader();
        printf("<input class=\"%s\" name=\"%s\" id=\"%s\" type=\"hidden\" value=\"%s\"\>",
            $this->getType(),
            $this->getID(),
            $this->getPlaceholder(),
            $this->getID(),
            $this->getValue());
        $this->echoOptionFooter();
    }
    
    public function saveAsMeta($postID) {
        if (!array_key_exists($this->getID(), $_REQUEST)) {
            delete_post_meta($postID, $this->getID());
        } else {
            update_post_meta($postID, $this->getID(), $_REQUEST[$this->getID()]);
        }
    }
    
    public function saveAsOption() {
        if (!array_key_exists($this->getID(), $_REQUEST)) {
            bfi_delete_option($this->getID());
        } else {
            bfi_update_option($this->getID(), stripslashes($_REQUEST[$this->getID()]));
        }
    }
    
    public function resetAsOption() {
        bfi_update_option($this->getID(), stripslashes($this->getStd()));
    }
}
