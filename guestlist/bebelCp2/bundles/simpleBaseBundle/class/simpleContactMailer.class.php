<?php


include_once dirname(__FILE__).'/../../bebelEventsBundle/vendor/swiftmailer/lib/swift_required.php';

class simpleContactMailer 
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
                $ssl = $this->settings->get('events_mailer_smtp_ssl') == "on" ? 'sslv2' : '';
                $transport = Swift_SmtpTransport::newInstance($this->settings->get('events_mailer_smtp_host'),$this->settings->get('events_mailer_smtp_port'), $ssl)
                          ->setUsername($this->settings->get('events_mailer_smtp_username'))
                          ->setPassword($this->settings->get('events_mailer_smtp_password'));
                          
                break;
        }
        
        // set up the mailer
        $this->mailer = Swift_Mailer::newInstance($transport);
        
    }
    
    
    public function setMessage($details)
    {
        $sendTo = $this->settings->get('contact_email');
        
        if($sendTo == '')
        {
            $sendTo = $this->settings->get('admin_email', false);
        }
        
        $title = _x(sprintf('Request from Contact Form on %s', get_bloginfo('name')), $this->settings->getPrefix());
        
        $this->message = Swift_Message::newInstance($title)
          ->setFrom(array($this->settings->get('events_mailer_send_from_mail') => $this->settings->get('events_mailer_send_from')))
          ->setTo($sendTo);
        
        
        $title_hi = _x('Hi Admin,', $this->settings->getPrefix());
        $title_intro = _x(sprintf('Somebody sent you a mail through the contact form on your blog %s', get_bloginfo('name')), $this->settings->getPrefix());
        $title_name = _x('His / her Name:', $this->settings->getPrefix());
        $title_email = _x('His / her Email:', $this->settings->getPrefix());
        $title_message = _x('His / her Message:', $this->settings->getPrefix());
        
        $message = <<<EOF
   
{$title_hi}
   
{$title_intro}

{$title_name}
{$details['name']}
        
{$title_email}
{$details['email']}
    
{$title_message}

{$details['message']}

        
EOF;
        
        $this->message->setBody($message, 'text/plain');
        
        
        return $this;
    }
    
    public function send()
    {
        return $this->mailer->send($this->message);
    }
    
}