<?php


include_once dirname(__FILE__).'/../vendor/swiftmailer/lib/swift_required.php';

class bebelEventsMailer 
{
    
    protected $mailer,
        $message;
    
    protected $settings;
    
    
    public function __construct() 
    {
        $this->settings = BebelSingleton::getInstance('BebelSettings');
        
        
        // get the mailer type
        switch($this->settings->get('events_mailer_type'))
        {
            case 'mail':
                $transport = Swift_MailTransport::newInstance();
                break;
            
            case 'sendmail':
                $transport = Swift_SendmailTransport::newInstance($this->settings->get('events_mailer_sendmail'));
                break;
                
            case 'smtp':
                $ssl = $this->settings->get('events_mailer_smtp_ssl') == "on" ? 'ssl' : '';
                //google exception
                if($this->settings->get('events_mailer_smtp_host') == "smtp.gmail.com") {
                    $ssl = "tls";
                }
                $transport = Swift_SmtpTransport::newInstance($this->settings->get('events_mailer_smtp_host'),$this->settings->get('events_mailer_smtp_port'), $ssl)
                          ->setUsername($this->settings->get('events_mailer_smtp_username'))
                          ->setPassword($this->settings->get('events_mailer_smtp_password'));    
                break;
            default:
                $transport = Swift_MailTransport::newInstance();
                break;
        }
        
        // set up the mailer
        $this->mailer = Swift_Mailer::newInstance($transport);

        
    }
    
    
    public function setMessage($sendTo,  $event)
    {
        
        
        $event->the_post();
        $eventdate  = strtotime(BebelUtils::getCustomMeta('event_date', '', get_the_ID()));
        $eventdate = date($this->settings->get('events_mailer_template_dateformat'), $eventdate);
        $eventlocation = BebelUtils::getCustomMeta('event_location', '', get_the_ID());
        $eventprice = BebelUtils::getCustomMeta('event_price', '', get_the_ID());
        $eventcurrency = BebelUtils::getCustomMeta('event_currency', '', get_the_ID());
        
        // get the code
        $eventcode = $sendTo['code'];
        
        $replace = array('.jpg', '.png', '.gif', '.jpeg');
        $eventcurrency = ucfirst(str_replace($replace, '', strtolower($eventcurrency)));
        
        
        $title = $this->settings->get('events_mailer_template_subject');
        $title = str_replace("%EVENTNAME%", get_the_title(), $title);
        
        
            $this->message = Swift_Message::newInstance($title)
              ->setFrom(array($this->settings->get('events_mailer_send_from_mail') => $this->settings->get('events_mailer_send_from')))
              ->setTo(array($sendTo['email'] => $sendTo['first_name']." ".$sendTo['last_name']));
        
        // check if allow_url_fopen is on
        
        if(ini_get('allow_url_fopen') == 1) 
        {
            $image = $this->message->embed(Swift_Image::fromPath($this->settings->get('logo_mail')));
        }else {
            $image = $this->settings->get('logo_mail');
        }
         
        
        // get html template from database
        $template = html_entity_decode($this->settings->get('events_mailer_template'));
        
        // replace placeholders with defined text
        $template = str_replace("%TITLE%", $this->settings->get('events_mailer_template_var_title'), $template);
        $template = str_replace("%SIGNEDUP%", $this->settings->get('events_mailer_template_var_signedup'), $template);
        $template = str_replace("%PRICE%", $this->settings->get('events_mailer_template_price'), $template);
        $template = str_replace("%EVENTPRICE%", $eventprice, $template);
        $template = str_replace("%CURRENCY%", $eventcurrency, $template);
        $template = str_replace("%EVENTNAME%", get_the_title(), $template);
        $template = str_replace("%WHEN%", $this->settings->get('events_mailer_template_var_when'), $template);
        $template = str_replace("%ADDRESS%", $this->settings->get('events_mailer_template_var_address'), $template);
        $template = str_replace("%SENDERINFORMATION%", html_entity_decode($this->settings->get('events_mailer_template_var_senderinformation')), $template);
        $template = str_replace("%CODE%", $this->settings->get('events_mailer_template_var_code'), $template);
        $template = str_replace("%THECODE%", $eventcode, $template);
        
        
        // replace logo, link and so on
        $template = str_replace("%LOGO%", '<img src="'.$image.'"  alt="'.get_the_title().'" style="border:none; outline:none;" />', $template);
        $template = str_replace("%EVENTDATE%", $eventdate, $template);
        $template = str_replace("%EVENTADDRESS%", $eventlocation, $template);
        $template = str_replace("%FIRSTNAME%", $sendTo['first_name'], $template);
        $template = str_replace("%LASTNAME%", $sendTo['last_name'], $template);
        
        
        // get raw text template from database
        $template_raw = $this->settings->get('events_mailer_template_txt');
        
        $template_raw = str_replace("%TITLE%", $this->settings->get('events_mailer_template_var_title'), $template_raw);
        $template_raw = str_replace("%SIGNEDUP%", $this->settings->get('events_mailer_template_var_signedup'), $template_raw);
        $template_raw = str_replace("%PRICE%", $this->settings->get('events_mailer_template_price'), $template_raw);
        $template_raw = str_replace("%EVENTPRICE%", $eventprice, $template_raw);
        $template_raw = str_replace("%CURRENCY%", $eventcurrency, $template_raw);
        $template_raw = str_replace("%EVENTNAME%", get_the_title(), $template_raw);
        $template_raw = str_replace("%WHEN%", $this->settings->get('events_mailer_template_var_when'), $template_raw);
        $template_raw = str_replace("%ADDRESS%", $this->settings->get('events_mailer_template_var_address'), $template_raw);
        $template_raw = str_replace("%SENDERINFORMATION%", html_entity_decode($this->settings->get('events_mailer_template_var_senderinformation')), $template_raw);
        $template_raw = str_replace("%CODE%", $this->settings->get('events_mailer_template_var_code'), $template_raw);
        $template_raw = str_replace("%THECODE%", $eventcode, $template_raw);
        
        
        // replace logo, link and so on
        $template_raw = str_replace("%EVENTDATE%", $eventdate, $template_raw);
        $template_raw = str_replace("%EVENTADDRESS%", $eventlocation, $template_raw);
        $template_raw = str_replace("%FIRSTNAME%", $sendTo['first_name'], $template_raw);
        $template_raw = str_replace("%LASTNAME%", $sendTo['last_name'], $template_raw);
        
        $template_raw = BebelUtils::br2nl($template_raw);
        
        
        $this->message->setBody($template,'text/html');
        $this->message->addPart($template_raw, 'text/plain');
        
        return $this;
    }
    
    public function send()
    {
        return $this->mailer->send($this->message);
    }
    
}



