<?php
class BFIAdminPanelMailchimpModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 10;
        $this->menuName = 'MailChimp';
        $this->showSaveButtons = true;
        $this->additionalHTML = '';
        parent::__construct();
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "MailChimp (Newsletter) Settings",
            "type" => "heading"
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => BFI_THEMENAME." is integrated with MailChimp for its email newsletter feature.<br><br>What's MailChimp? MailChimp is an easy to use email newsletter service. You can sign up for free from their <a href='http://mailchimp.com/' target='_blank'>website</a>. With a free account, you can have up to 2,000 subscribers and you can send up to 12,000 newsletters per month for free! (This may change as per their terms).<br><br>To use the theme's newsletter feature, all you need is a free MailChimp account. Get one first before proceeding with the configuration below.",
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => "To view your MailChimp API key, login to your MailChimp dashboard then visit this page: <a href='http://admin.mailchimp.com/account/api/' target='_blank'>http://admin.mailchimp.com/account/api/</a>.<br><br>Alternatively, while in your MailChimp dashboard, navigate to <strong>Settings > API Keys & Authorized Apps</strong>.",
            ));
           
        $this->addOption(array(
            "name" => "API Key",
            "desc" => "To view your MailChimp API key, login to your MailChimp dashboard then visit this page: <a href='http://admin.mailchimp.com/account/api/' target='_blank'>http://admin.mailchimp.com/account/api/</a>.<br><br>Alternatively, while in your MailChimp dashboard, navigate to <strong>Settings > API Keys & Authorized Apps</strong>.",
            "id" => BFI_OPTIONMAILCHIMPAPIKEY,
            "type" => "text",
            "std" => "",
            "placeholder" => "Put your MailChimp API Key here",
            ));
            
        $this->addOption(array(
            "type" => "note",
            "desc" => "To view your MailChimp mailing list unique ID, login to your MailChimp dashboard then visit this page: <a href='http://admin.mailchimp.com/lists/' target='_blank'>http://admin.mailchimp.com/lists/</a>.<br><br>Alternatively, while in your MailChimp dashboard, navigate to <strong>Lists</strong>, then on your mailing list, hover over the <strong>settings</strong> link, then click on the <strong>list settings and unique id</strong>. The unique ID for your mailing list is located at the bottom of the page.",
            ));
           
        $this->addOption(array(
            "name" => "Mailing List Unique ID",
            "desc" => "To view your MailChimp mailing list unique ID, login to your MailChimp dashboard then visit this page: <a href='http://admin.mailchimp.com/lists/' target='_blank'>http://admin.mailchimp.com/lists/</a>.<br><br>Alternatively, while in your MailChimp dashboard, navigate to <strong>Lists</strong>, then on your mailing list, hover over the <strong>settings</strong> link, then click on the <strong>list settings and unique id</strong>. The unique ID for your mailing list is located at the bottom of the page.",
            "id" => BFI_OPTIONMAILCHIMPLISTKEY,
            "type" => "text",
            "std" => "",
            "placeholder" => "Put your MailChimp mailing list unique ID here",
            ));
    }
}

?>