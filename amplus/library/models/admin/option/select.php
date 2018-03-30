<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/text.php');
class BFIAdminOptionSelect extends BFIAdminOptionText {
    
    public function display() {
        $values = $this->getValues();
        
        $this->echoOptionHeader();
        ?><select name="<?php echo $this->getID(); ?>" id="<?php echo $this->getID(); ?>"><?php 
        foreach ($this->getOptions() as $key => $option) {
             
            // this is if we have option groupings
            if (is_array($option)) {
                ?><optgroup label="<?php echo $key?>"><?php
                foreach ($option as $key2 => $subOption) {
                    printf("<option value=\"%s\" %s>%s</option>",
                        $values[$key][$key2],
                        $this->getValue() == $values[$key][$key2] ? 'selected="selected"' : '',
                        $subOption
                        );
                }
                ?></optgroup><?php
                
            // this is for normal list of options
            } else {
                printf("<option value=\"%s\" %s>%s</option>",
                    $values[$key],
                    $this->getValue() == $values[$key] ? 'selected="selected"' : '',
                    $option
                    );
            }
        } 
        ?></select><?php
        $this->echoOptionFooter();
    }
}
