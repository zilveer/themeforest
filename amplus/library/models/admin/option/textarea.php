<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/text.php');
class BFIAdminOptionTextarea extends BFIAdminOptionText {
    
    public function display() {
        $this->echoOptionHeader();
        printf("<textarea name=\"%s\" placeholder=\"%s\" id=\"%s\" cols=\"%s\" rows=\"%s\" style=\"height: 250px;\" class=\"%s\">%s</textarea>",
            $this->getID(),
            $this->getPlaceholder(),
            $this->getID(),
            $this->getCols(),
            $this->getRows(),
            $this->getClass(),
            $this->getValue());
        $this->echoOptionFooter();
    }
}
