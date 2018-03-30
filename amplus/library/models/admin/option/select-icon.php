<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/select.php');
class BFIAdminOptionSelectIcon extends BFIAdminOptionSelect {
    
    public function display() {
        $options = bfi_get_icon_names();
        array_unshift($options, 'No icon');
        $values = bfi_get_icon_values();
        array_unshift($values, 'none');
        
        $this->properties['options'] = $options;
        $this->properties['values'] = $values;
        
        $this->echoOptionHeader();
        ?><select name="<?php echo $this->getID(); ?>" id="<?php echo $this->getID(); ?>"><?php 
        foreach ($this->getOptions() as $key => $option) {
            printf("<option value=\"%s\" data-imagesrc='%s' %s>%s</option>",
                $values[$key],
                $values[$key],
                $this->getValue() == $values[$key] ? 'selected="selected"' : '',
                $option
                );
        } 
        ?></select>
        <?php
        $this->echoOptionFooter();
    }
}
