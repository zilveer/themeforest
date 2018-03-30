<?php
class BFIAdminPanelContactModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 5;
        $this->menuName = 'Contact';
        $this->showSaveButtons = true;
        $this->additionalHTML = '';
        parent::__construct();
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "Contact Page Settings",
            "type" => "heading"
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => "Use the shortcode <strong>[contactform]</strong> in your page to display the contact form. The settings you put here will be used by the shortcode.",
            ));
            
        $this->addOption(array(
            "name" => "Email",
            "type" => "text",
            "desc" => "The email address that receives the message",
            "id" => "contact_email",
            "std" => get_bloginfo("admin_email"),
            ));
            
        $this->addOption(array(
            "name" => "Email subject",
            "type" => "text",
            "desc" => "The subject of the email that gets sent",
            "id" => "contact_subject",
            "std" => "A message from your website",
            "placeholder" => "Enter an email subject",
            ));
            
        $this->addOption(array(
            "name" => "Additional input fields",
            "type" => "translatabletext",
            "desc" => "Put the names of your additional fields separated by commas (,). To make your additional field mandatory, put an asterisk (*) at the end of the field name.<br><br><strong>Please use only letters, numbers, and spaces.</strong><br><em>E.g. \"Website, Company Name *\"</em>",
            "id" => "contact_additional_fields",
            "std" => "",
            ));
    }
}
/*
function bfi_contact($onlyGetOptions = false)
{
    global $options;
    
    // page logic
    if (array_key_exists('page', $_GET) && $_GET['page'] == __function__) {
    }
    

    if ($onlyGetOptions) return $options;
    bfi_add_admin(__FUNCTION__);
}
*/
?>