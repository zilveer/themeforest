<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/text.php');
class BFIAdminOptionRadio extends BFIAdminOptionText {
    
    public function display() {
        $values = $this->getValues();
        
        $this->echoOptionHeader();
        echo "<div class='r'>"; 
        foreach ($this->getOptions() as $key => $option) {
            printf("<input type='radio' name='%s' value='%s' %s><span>%s</span>",
                $this->getID(),
                $values[$key],
                $this->getValue() == $values[$key] ? "checked=\"checked\"" : '',
                $option
                );
        }
        echo "</div>";
        $this->echoOptionFooter();
    }
}
