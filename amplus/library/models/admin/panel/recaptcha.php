<?php
class BFIAdminPanelRecaptchaModel extends BFIAdminPanelModel implements iBFIAdminPanel {
    function __construct() {
        $this->priority = 10;
        $this->menuName = 'reCaptcha';
        $this->showSaveButtons = true;
        $this->additionalHTML = '';
        parent::__construct();
        
        add_action('admin_init', array(__CLASS__, 'addReCaptchaNotifications'));
    }
    
    public function addReCaptchaNotifications() {
        if (!bfi_get_option(BFI_OPTIONRECAPTCHAPUBLICKEY) 
            || !bfi_get_option(BFI_OPTIONRECAPTCHAPRIVATEKEY)) {
            BFIAdminNotificationController::addNotification("Protect your contact form and comments from spammers! Head over to <a href='".get_admin_url()."admin.php?page=bfi_recaptcha'><strong>".BFI_THEMENAME." > reCaptcha</strong></a> and enable reCaptcha in your forms.");
        }
    }
    
    public function createOptions() {
        $this->addOption(array(
            "name" => "reCAPTCHA (spam checker captcha) Settings",
            "type" => "heading"
            ));;
            
        $this->addOption(array(
            "type" => "note",
            "desc" => BFI_THEMENAME." is integrated with reCAPTCHA for protection against spam in your <strong>comments</strong> and <strong>contact page</strong>.<br><br>What's reCAPTCHA? reCAPTCHA is a free service that helps tell whether your visitor is a human or a computer (spam bots) to prevent automated abuse of your site. You can sign up for free from their <a href='http://www.google.com/recaptcha' target='_blank'>website</a>.",
            ));
           
        $this->addOption(array(
            "type" => "note",
            "desc" => "To get your <a href='http://www.google.com/recaptcha' target='_blank'>reCAPTCHA</a> keys, go to their <a href='https://www.google.com/recaptcha/admin/create' target='_blank'>sign up page</a> then enter your domain in their form, tick the box that says 'Enable this key on all domains', then click on the 'Create key' button. Copy and paste the <strong>public</strong> and <strong>private keys</strong> on the appropriate fields below.<br><br><em>(If you are testing the theme in an intranet site, you can use the keys for your actual domain.)</em>",
            ));
           
        $this->addOption(array(
            "type" => "note",
            "desc" => "<em>(If you leave this area blank, no captcha will be supplied in your comments area and contact form.)</em>",
            ));
        
        $this->addOption(array(
            "name" => "Public Key",
            "desc" => "To get your <a href='http://www.google.com/recaptcha' target='_blank'>reCAPTCHA</a> public key, go to their <a href='https://www.google.com/recaptcha/admin/create' target='_blank'>sign up page</a> then enter your domain in their form, tick the box that says 'Enable this key on all domains', then click on the 'Create key' button. Copy and paste the <strong>public key</strong> in this field.",
            "id" => BFI_OPTIONRECAPTCHAPUBLICKEY,
            "type" => "text",
            "std" => "",
            "placeholder" => "Put your reCAPTCHA public key here",
            ));
        
        $this->addOption(array(
            "name" => "Private Key",
            "desc" => "To get your <a href='http://www.google.com/recaptcha' target='_blank'>reCAPTCHA</a> private key, go to their <a href='https://www.google.com/recaptcha/admin/create' target='_blank'>sign up page</a> then enter your domain in their form, tick the box that says 'Enable this key on all domains', then click on the 'Create key' button. Copy and paste the <strong>private key</strong> in this field.",
            "id" => BFI_OPTIONRECAPTCHAPRIVATEKEY,
            "type" => "text",
            "std" => "",
            "placeholder" => "Put your reCAPTCHA public key here",
            ));
        
		$this->addOption(array(
			// "name" => "Color Theme",
			// "desc" => "The color theme to use for the display of the reCAPTCHA field.",
			"id" => "recaptcha_theme",
			"type" => "hidden",
			// "options" => array("Red (default)", "White", "Blackglass"),
			// "values" => array("red", "white", "blackglass"),
			"std" => "red",
			));
    }
}

?>
