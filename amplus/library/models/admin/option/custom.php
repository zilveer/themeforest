<?php

class BFIAdminOptionCustom extends BFIAdminOptionModel implements iBFIAdminOption {
    
    public function display() {
        $this->echoOptionHeader();
        echo $this->getCustom();
        $this->echoOptionFooter();
    }
    
    public function saveAsMeta($postID) { }
    public function saveAsOption() { }
    public function resetAsOption() { }
}
