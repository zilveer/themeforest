<?php

class BFIAdminOptionBoolean extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        $this->echoOptionHeader();
        printf("<input id=\"%s\" class=\"checkbox\" name=\"%s\" type=\"checkbox\" value=\"1\" %s/>",
            $this->getID(),
            $this->getID(),
            $this->getValue() ? 'checked="checked"' : ''
            );
        $this->echoOptionFooter();
    }
    
    public function saveAsMeta($postID) {
        if (array_key_exists($this->getID(), $_REQUEST)) {
            update_post_meta($postID, $this->getID(), "1");
        } else {
            update_post_meta($postID, $this->getID(), "0");
        }
    }
    
    public function saveAsOption() {
        if (array_key_exists($this->getID(), $_REQUEST)) {
            bfi_update_option($this->getID(), "1");
        } else {
            bfi_update_option($this->getID(), "0");
        }
    }
    
    public function resetAsOption() {
        bfi_update_option($this->getID(), $this->getStd() ? "1" : "0");
    }
}
