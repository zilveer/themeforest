<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/select.php');
class BFIAdminOptionSelectSocialIcon extends BFIAdminOptionSelect {
    
    public function display() {
        // Get all the supported (mono)social icons
        $icons = bfi_get_social_icons();
        $options = array();
        $values = array();
        foreach ($icons as $key => $icon) {
            $options[] = $icon['name'];
            $values[] = $key;
        }
        array_unshift($options, "Choose a social network");
        array_unshift($values, "");
        
        $this->properties['options'] = $options;
        $this->properties['values'] = $values;
        
        $this->echoOptionHeader();
        ?><select name="<?php echo $this->getID(); ?>" id="<?php echo $this->getID(); ?>"><?php 
        foreach ($this->getOptions() as $key => $option) {
            printf("<option value=\"%s\" %s>%s</option>",
                $values[$key],
                $this->getValue() == $values[$key] ? 'selected="selected"' : '',
                $option
                );
        } 
        ?></select><?php
        $this->echoOptionFooter();
    }
}
