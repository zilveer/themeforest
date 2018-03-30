<?php


class bebelEventsBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelEventsBundle';
  }


  public function getAutoload()
  {
    $a = array(
        'bebeleventsbundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelEventsBundleAdminConfig.class.php',
        'bebelevents' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelEvents.class.php',
        'bebeleventsutils' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelEventsUtils.class.php',
        'bebeleventsmailer' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelEventsMailer.class.php',    
        'bebeleventspaypal' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelEventsPayPal.class.php',    

    );

    return $a;
  }


  public function getSettings()
  {
    $s = array(
        'events_enable_mailchimp' => 'off',
        'events_hide_booked_events' => 'off',
        'events_terms_conditions_enable' => 'on',
        'events_terms_conditions' => 'Insert your terms and conditions here.',
        'events_enable_newsletter' => 'on',
        'events_default_formtitle' => 'Join the Guest List',
        'events_default_formtitle_no_event' => 'No Events at the Moment',
        'events_default_formtitle_no_event_text' => 'No Event planned at the moment. Please come back later.',
        'events_default_formtitle_no_event_no_nl_text' => 'But you can sign up for the newsletter!',
        
        'events_mailer_type' => 'mail',
        'events_mailer_smtp_host' => '',
        'events_mailer_smtp_port' => '',
        'events_mailer_smtp_ssl' => 'off',
        'events_mailer_smtp_username' => '',
        'events_mailer_smtp_password' => '',
        'events_mailer_sendmail' => '/usr/sbin/sendmail -bs',
        'events_mailer_send_from' => 'YourNameHere',
        'events_mailer_send_from_mail' => '',
        
        
        // email template - huge html code
        'events_mailer_template_subject' => 'You Successfully Signed Up For The Event: %EVENTNAME%',
        'events_mailer_template_dateformat' => 'F jS Y, H:i',
        'events_mailer_template_var_title' => 'Hey There!',
        'events_mailer_template_var_signedup' => 'You just signed up for the Event &#8220;%EVENTNAME&#8221;',
        'events_mailer_template_var_when' => 'When:',
        'events_mailer_template_var_code' => 'Access Code:',
        'events_mailer_template_price' => 'You Paid:',
        'events_mailer_template_var_address' => 'Address:',
        'events_mailer_template_var_senderinformation' => 'This is an automated message from Your Company Name:<br>John Doe, Some Address , New York, USA<br>Call: 012 345 6789',
        'events_mailer_template' => '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>%TITLE%</title>
</head>
<style type="text/css">
.ReadMsgBody{width:100%;}
.ExternalClass{width:100%;}
</style>
<body style="background:#ede9e3">
<!--Module Start-->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="padding:30px; margin-top:60px;">
        <tr>
          <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;"><a href="%EVENTLINK%">%LOGO%</a></td>
        </tr>
        <tr>
          <td>
            <h1 style="font-family:Arial, Helvetica, sans-serif; font-weight: bold; font-size:24px; color:#000;">%TITLE%</h1>

            
            <p style="color: #999; font-weight: bold; font-size: 14px;">
                %FIRSTNAME% %LASTNAME%
            </p>

            <p style="color: #0099cc; font-weight: bold; font-size: 14px;">
                %SIGNEDUP%
            </p>
            <p style="color: #999; font-weight: bold; font-size: 14px;">
                %EVENTNAME%
            </p>
            
            <p style="color: #0099cc; font-weight: bold; font-size: 14px;">
                %WHEN%
            </p>
            <p style="color: #999; font-weight: bold; font-size: 14px;">
                %EVENTDATE%
            </p>
            
            <p style="color: #0099cc; font-weight: bold; font-size: 14px;">
                %PRICE%
            </p>
            <p style="color: #999; font-weight: bold; font-size: 14px;">
                %EVENTPRICE% %CURRENCY%
            </p>
            
            <p style="color: #0099cc; font-weight: bold; font-size: 14px;">
                %CODE%
            </p>
            <p style="color: #999; font-weight: bold; font-size: 14px;">
                %THECODE%
            </p>
            
            <p style="color: #0099cc; font-weight: bold; font-size: 14px;">
                %ADDRESS%
            </p>
            <p style="color: #999; font-weight: bold; font-size: 14px;">
                %EVENTADDRESS%
            </p>
          </td>
        </tr>
      </table>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td  align="center" height="142" style="color: #858585;  font-size: 12px;">%SENDERINFORMATION%</td>
  </tr>
</table>
<!--Module End-->
</body>
</html>',
        
        'events_mailer_template_txt' => 
"<<<EOF
%TITLE%

%FIRSTNAME% %LASTNAME%,

%SIGNEDUP%       %EVENTNAME%
%WHEN%       %EVENTDATE%
%PRICE%       %EVENTPRICE% %CURRENCY%
%CODE%       %THECODE%
%ADDRESS%        %EVENTADDRESS%


%SENDERINFORMATION%            
EOF;"
        
        );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
    );

    return $w;
  }

  // admin stuff
  public function getAdmin()
  {

    $modules = array(
        'event' => array(
            'title' => 'Events',
            'submenu' => array(
                'general' => array(
                    'title' => 'General',
                    'description' => 'General Event Settings'
                ),
                'mail' => array(
                    'title' => 'Email',
                    'description' => 'Set up the email settings'
                ),
                'mailtemplate' => array(
                    'title' => 'Email Template',
                    'description' => 'Set up the email template. Change everything, from text to the layout.'
                ),
            ),
            'widgets' => array(
                'events_default_formtitle' => array(
                    'title' => 'Default Form Title',
                    'description' => 'Enter the default form title for the signup form next to the event. You can define a specific one for each event in the post options below the textarea while creating a new event.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'events_default_formtitle_no_event' => array(
                    'title' => 'Default Form Title For No Event Form',
                    'description' => 'Enter the default form title for the newsletter signup form that will be displayed if there is no event left to show. <b>Attention</b> The form will only be shown if you activated the newsletter! Otherwise the following text will be displayed',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'events_default_formtitle_no_event_no_nl_text' => array(
                    'title' => 'No Event NL Text',
                    'description' => 'This text will be shown below the form title if the newsletter is enabled',
                    'help' => '',
                    'template' => 'textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'events_default_formtitle_no_event_text' => array(
                    'title' => 'Default Event Text',
                    'description' => 'This text will be shown if the newsletter is off and there is no event left to show.',
                    'help' => '',
                    'template' => 'textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'events_terms_conditions_enable' => array(
                    'title' => 'Enable Terms and Conditions Checkbox',
                    'description' => 'Below the email form will be shown a terms and conditions checkbox users will have to check if they want to sign up for this event. <br /><b>Attention: This option is enabled by default. Please make sure you do not violate any laws in your country by disabling it.</b><br />IMPORTANT: before sending a newsletter make sure to check your legal responsibilities as some jurisdictions require an opt-in process for sign ups or different legal requirements - this template is not automatically conform with all jurisdictions as it is sold world wide.',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'events_terms_conditions' => array(
                    'title' => 'Terms and Conditions Text',
                    'description' => 'Enter the text for the terms and conditions.',
                    'help' => '',
                    'template' => 'textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'events_hide_booked_events' => array(
                    'title' => 'Hide sold out events',
                    'description' => 'You can hide fully booked / sold out events, if you want. If not, the form will disappear and a "sold out" text will be shown.',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'events_enable_newsletter' => array(
                    'title' => 'Enable Newsletter',
                    'description' => 'You can enable the newsletter support. If you do not use mailchimp (see next option), the mails will only be stored in the database. You can grab them from the backend and paste them in your mail service. ',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'events_enable_mailchimp' => array(
                    'title' => 'Enable Mailchimp Support',
                    'description' => 'You can enable the mailchimp support for collecting email addresses from people who want to get signed up for the mailing list. You do need a mailchimp account and an api key (you can get for free once you signed up there) Read more in the help file.',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'events_mailer_send_from' => array(
                    'title' => 'Send From (Name)',
                    'description' => 'Enter the name you want the user to read in the "from" row (YourCompanyNameHere)',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'events_mailer_send_from_mail' => array(
                    'title' => 'Send From (Email)',
                    'description' => 'Enter the email address you want the user to get the mail from. If you use smtp, make sure it is the same email address as the username.<br><b>IMPORTANT</b>If the smtp username is not a valid email address (eg your host only requries the name of the address without @domain.com), enter the full email address here (user@domain.com). If you do not follow this step an error will occur while sending the email.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'events_mailer_type' => array(
                    'title' => 'Mailer Type',
                    'description' => 'Choose between mail(), sendmail and smtp for sending your mails. If you have absolutely no clue what these things mean, just leave it as it is (default is mail()). But we strongly recommend to use smtp, as it is the most secure way to send your mails.',
                    'help' => '',
                    'template' => 'select_custom',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array('options' => array('mail' => "mail()", 'sendmail' => "sendmail", 'smtp' => "SMTP"), 'first' => 'Template')
                ),
                'events_mailer_smtp_host' => array(
                    'title' => 'SMTP Host Name',
                    'description' => 'If you chose SMTP (good choice), enter here the host name. (e.g. smtp.example.org)',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'events_mailer_smtp_port' => array(
                    'title' => 'SMTP Port',
                    'description' => 'Enter the port number (usually web hosts give a declaration like this: smtp.example.org:25 - we want these two things in two forms. above the host name, here the port number , in this case 25)',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'events_mailer_smtp_ssl' => array(
                    'title' => 'Enable SSL Support',
                    'description' => 'If your host requires ssl encryption, select here',
                    'help' => '',
                    'template' => 'select_true_false',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'events_mailer_smtp_username' => array(
                    'title' => 'SMTP Username',
                    'description' => 'Enter the username. This will also be the "sent from" address in the mail.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'events_mailer_smtp_password' => array(
                    'title' => 'SMTP Password',
                    'description' => 'Enter the password',
                    'help' => '',
                    'template' => 'password',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                'events_mailer_sendmail' => array(
                    'title' => 'Sendmail Path',
                    'description' => 'If you chose sendmail and have to adapt the path to sendmail, please enter it here including all parameters. Default is /usr/sbin/sendmail -bs',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mail',
                    'options' => array()
                ),
                
                
                
                // template vars and stuff
                'events_mailer_template_subject' => array(
                    'title' => 'Email Subject',
                    'description' => 'You can change the default subject for the confirmation mails for events. You may use the placeholder variable %EVENTNAME% and %EVENTDATE%, which will render the event name and date the user signed up for.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template_dateformat' => array(
                    'title' => 'Date Format',
                    'description' => 'The reading format for time is different in each country. You may change it here to your local standard. Read <a href="http://www.php.net/manual/en/function.date.php" target="_blank">here</a> on which letter stands for what',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template_var_title' => array(
                    'title' => 'Title',
                    'description' => 'Change the text behind the variable %TITLE%. Read more in the documentation.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template_var_signedup' => array(
                    'title' => 'Signed Up',
                    'description' => 'Change the text behind the variable %SIGNEDUP%.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template_var_when' => array(
                    'title' => 'When',
                    'description' => 'Change the text behind the variable %WHEN%.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template_var_code' => array(
                    'title' => 'Access Code',
                    'description' => 'Change the text behind the variable %CODE%.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template_var_address' => array(
                    'title' => 'Address',
                    'description' => 'Change the text behind the variable %ADDRESS%.',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template_price' => array(
                    'title' => 'Price',
                    'description' => 'Change the text behind the variable %PRICE%. You might want to use the variable %CURRENCY% to display the currency used for this event (will print out the beautified name of the file (dollar.png => Dollar))',
                    'help' => '',
                    'template' => 'input',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template_var_senderinformation' => array(
                    'title' => 'Senders information',
                    'description' => 'Change the text behind the variable %SENDERINFORMATION%.',
                    'help' => '',
                    'template' => 'textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template' => array(
                    'title' => 'Email Template',
                    'description' => 'Enter RAW HTML in here. You can change anything you want. Use the variables above as placeholders.',
                    'help' => '',
                    'template' => 'html_textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
                'events_mailer_template_txt' => array(
                    'title' => 'Email Template (RAW TEXT)',
                    'description' => 'Enter RAW TEXT in here. You can change anything you want. Use the variables above as placeholders.<br>This is an alternative version of the mail for clients that do not support html, such as many phones in Japan.',
                    'help' => '',
                    'template' => 'html_textarea',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'mailtemplate',
                    'options' => array()
                ),
            ),
            'bundle' => $this->bundleDir
          ),
      );

    
    $timeinoneweek = time() + 604800;
    $timeinoneweekandaday = $timeinoneweek+86400;
    

    $post_modules = array(
        'add_scope' => array('event'),
        'widgets' => array(
            'event_subtitle' => array(
                'menu_item' => 'layout',
                'title' => 'Event Subtitle',
                'description' => 'You can and should enter a subtitle for your event. Looks nice and fancy.',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array()
            ),
            'event_formtitle' => array(
                'menu_item' => 'layout',
                'title' => 'Event Signup Form Title',
                'description' => 'You can define a specific title for the form on the left side. If you do not enter a title, the title you defined in the theme options will be displayed.',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array()
            ),
            'event_price' => array(
                'menu_item' => 'layout',
                'title' => 'Event Price',
                'description' => 'Enter the Price for the Event. Like 4,99 or 40 or 5999 if you are using yen... :) (If its a free event, please insert 0, so we can disable the payment stuff. thanks.)',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array()
            ),
            'event_currency' => array(
                'menu_item' => 'layout',
                'title' => 'Event Currency',
                'description' => 'Select a currency. If you want to add your own currency graphic, take a look in the help file in the FAQ section on how to do that.',
                'help' => '',
                'template' => 'select_scan',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array('folder' => TEMPLATEPATH.'/images/event/currency/', 'getTitleFromFunction' => array('simpleUtils', 'renameCurrency'), 'defaultSettingName' => 'paypal_default_currency')
            ),
            'event_slot_count' => array(
                'menu_item' => 'layout',
                'title' => 'Event Slots (Tickets) Available',
                'description' => 'Enter the number of tickets available. If this number is reached the event will, depending on your settings, be hidden or be marked as fully booked. If the number is 0 there will be unlimited slots. ',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array('default' => '0')
            ),
            'event_button_text' => array(
                'menu_item' => 'layout',
                'title' => 'Button Text',
                'description' => 'Enter the text you want to show on the button (default is "Buy Ticket".)<br>If the event is free, you should change the text.',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array('default' => 'Buy Ticket')
            ),
            'event_date' => array(
                'menu_item' => 'layout',
                'title' => 'Event Date',
                'description' => 'Insert the date of the event. Do not forget to specify the time :) Insert the date in this format: <b>YYYY-MM-DD HH:MM</b>, for example 2012-04-22 13:00 (do use the 24h time format)',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array('default' => date('Y-m-d H:i',$timeinoneweekandaday))
            ),
            'event_registration_start' => array(
                'menu_item' => 'layout',
                'title' => 'Event Registration Start Date',
                'description' => 'When should the event be displayed on the mainpage? It will not be displayed before this date. Insert the date in this format: <b>YYYY-MM-DD HH:MM</b>, for example 2012-02-22 22:35 (do use the 24h time format)',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array('default' => date('Y-m-d H:i'))
            ),
            'event_registration_end' => array(
                'menu_item' => 'layout',
                'title' => 'Event Registration Start End',
                'description' => 'When should the event be removed from the mainpage? It will not be displayed anymore after this date. Insert the date in this format: <b>YYYY-MM-DD HH:MM</b>, for example 2012-04-22 13:00 (do use the 24h time format)',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array('default' => date('Y-m-d H:i',$timeinoneweek))
            ),
            'event_location' => array(
                'menu_item' => 'layout',
                'title' => 'Event Location',
                'description' => 'Enter the address to the event. Be as specific as you can. Example: Mystreet 43, 12345 New York, NY, USA. DO NOT ENTER A GOOGLE MAPS LINK!',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array()
            ),
            'event_facebook_url' => array(
                'menu_item' => 'layout',
                'title' => 'Link to Event on Facebok',
                'description' => 'Enter the address to the event on facebook',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array()
            ),
            'event_twitter_url' => array(
                'menu_item' => 'layout',
                'title' => 'Link to Event on Twitter',
                'description' => 'Enter the address to the event on twitter',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array()
            ),
            'event_linkedin_url' => array(
                'menu_item' => 'layout',
                'title' => 'Link to Event on linkedin',
                'description' => 'Enter the address to the event on linkedin',
                'help' => '',
                'template' => 'input',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array()
            ),
        )
    );
    
    
    

    $pages = array(
        
        'bebelEventsGuestlist' =>
          array(
              'title' => 'Manage Guest Lists',
              'page_title' => 'Manage your Guest Lists. Print it out, delete people...',
              'parent' => 'bebelAdminTop',
              'permission' => 'edit_theme_options',
              'class' => $this->bundleDir
          )
      );
    
    return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
  }

  public function getTemplates()
  {
    $t = array(
       
    );

    return $t;
  }

  public function getPostTypes()
  {
    $pt = array(

        'event' => array(
            'type_name' => 'event',
            'name' => 'Events',
            'singular_name' => 'Event',
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'menu_position' => 20,
            'query_var' => true,
            'type_hierarchical' => false,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'attachment', 'custom-fields', 'revisions'),
            'type_rewrite' => array('slug' => 'event', 'with_front' => false),
            'use_taxonomy' => false, // required by our framework
            'taxonomy_hierarchical' => true,
            'taxonomy_name' => 'Collections',
            'taxonomy_name_singular' => 'Collection',
            'taxonomy_rewrite' => true,
            'menu_icon' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/assets/images/post_type_icon.png',
        ),


    );

    return $pt;
  }
  
  public function getTableInstallData()
  {
    $id = array(
        'event_guestlist' => array(
            'table_name' => 'event_guestlist',
            'create_table' => "CREATE TABLE  %s (
              id bigint(20) NOT NULL auto_increment,
              event_id bigint(20) NOT NULL default '0',
              first_name varchar(255) default NULL,
              last_name varchar(255) default NULL,
              email varchar(255) default NULL,
              access_code varchar(255) default NULL,
              created_at timestamp DEFAULT CURRENT_TIMESTAMP,
              mailchimp_list varchar(255) default NULL,
              in_mailchimp tinyint(1) NOT NULL default '0',
              wants_newsletter tinyint(1) NOT NULL default '0',
              PRIMARY KEY  (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
        ),
    );

    return $id;
  }

  public function getBundleSettings()
  {
    
    $bs = array();

    return $bs;
  }

  
  public function getWidgets()
  {
    $w = array();

    return $w;
  }

}