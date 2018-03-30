<?php
class BFIAdminPanelSupportModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 100;
        $this->menuName = 'Support';
        $this->showSaveButtons = false;
        $this->additionalHTML = '';
        parent::__construct();
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "Support",
            "type" => "heading"
            ));
            
        $this->addOption(array(
            "name" => "Where can I get support?",
            "desc" => "We have a support forum in our website at <a href='http://gambit.ph' target='_blank'>Gambit.ph</a>. Head over to our forums, your question might already be answered! Before asking something in our fourms, be sure that you have read the documentation provided with the theme.",
            "type" => "note",
            ));
            
        $this->addOption(array(
            "name" => "What kind of support can you give me?",
            "desc" => "We welcome bug reports, feature suggestions and help requests for small changes. We do not however entertain theme customizations.",
            "type" => "note",
            ));
            
        $this->addOption(array(
            "name" => "A friendly reminder",
            "desc" => "Don't forget to sign up to our newsletter! Be notified when we release design and code freebies, and when we release new themes.",
            "type" => "note",
            ));
    }
}
?>