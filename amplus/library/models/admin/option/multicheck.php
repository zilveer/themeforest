<?php

class BFIAdminOptionMulticheck extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        $values = $this->getValues();

        // for options, we need to directly get the value since
        // the option will automatically jumble up the serialized data
        // for meta, this isn't needed since the option will behave properly
        if ($this->optionType == self::TYPE_PANEL_OPTION) {
            $val = $this->getStd();
            if (bfi_get_option($this->getID())) {
                $val = bfi_get_option($this->getID());
            }

            // unserialize the data if applicable before returning it
            // regex came from http://stackoverflow.com/questions/1369936/check-to-see-if-a-string-is-serialized
            if (is_string($val)) {
                $val = preg_match('/^([adObis]:|N;)/', $val) ? unserialize($val) : $val;
            }
        } else {
            $val = $this->getValue();
        }
        
        $this->echoOptionHeader();
        echo "<div class='mul'>"; 
        foreach ($this->getOptions() as $key => $option) {
            printf("<input type='checkbox' name='%s[]' value='%s' %s><span>%s</span>",
                $this->getID(),
                $values[$key],
                is_array($val) && in_array($values[$key], $val) ? "checked=\"checked\"" : '',
                $option
                );
        }
        echo "</div>";
        $this->echoOptionFooter();
    }

    public function saveAsMeta($postID) {
        if (!array_key_exists($this->getID(), $_REQUEST)) {
            delete_post_meta($postID, $this->getID());
        } else {
            update_post_meta($postID, $this->getID(), serialize($_REQUEST[$this->getID()]));
        }
    }
    
    public function saveAsOption() {
        if (!array_key_exists($this->getID(), $_REQUEST)) {
            bfi_delete_option($this->getID());
        } else {
            bfi_update_option($this->getID(), serialize($_REQUEST[$this->getID()]));
        }
    }
    
    public function resetAsOption() {
        bfi_update_option($this->getID(), serialize($this->getStd()));
    }
}
