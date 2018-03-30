<?php



class bebelEvents
{
    /**
     * Contains the bebel Settings object
     *
     * @var BebelSettings 
     */
    protected $settings;
    
    
    /**
     * holds the event id
     *
     * @var integer
     */
    protected $event_id;
    
    
    /**
     * holds the details of the event in an object of wp_query
     *
     * @var WP_Query 
     */
    protected $query;
    
    
    /**
     * contains all the errors
     *
     * @var array
     */
    protected $errors;
    
    
    /**
     * contains all the success messages
     *
     * @var array 
     */
    protected $messages;
    
    
    /**
     * if its an ajax call we handle error messages differently than a
     * normal http call.
     * false by default.
     *
     * @var boolean 
     */
    protected $ajax = false;
    
    /**
     * after validation we will save the validated data in here.
     *
     * @var array 
     */
    protected $validated_data;
    
    
    /**
     * if the validation was not successful, we save the array in here
     * to build the error message and get it back if not ajax request
     *
     * @var array
     */
    protected $invalid_data;
    
    
    /**
     * set flag if newsletter was signed up for
     *
     * @var boolean 
     */
    protected $newsletter_signed = false;
    
    
    /**
     * flag for available free slots
     *
     * @var boolean 
     */
    protected $free_slot_available = true;
    
    
    /**
     * the client only wants a newsletter, don't sign him up for any event
     *
     * @var boolean
     */
    protected $only_wants_newsletter = false;
    
    
    /**
     * Creates a new object of this class and sets the settings up
     *
     * @param integer $event_id 
     */
    public function __construct($event_id)
    {
        $this->event_id = esc_attr($event_id);
        $this->settings = BebelSingleton::getInstance('BebelSettings');
    }
    
    /**
     * Create a new query based on the event id
     */
    public function createQuery()
    {
        $args = array(
            'p' => $this->event_id,
            'post_type' => 'any'

        );
        $this->query = new WP_Query($args);
    }
    
    /**
     * returns the object
     *
     * @return WP_Query_
     */
    public function getQuery()
    {
        return $this->query;
    }
    
    
    /**
     * A simple validation class
     *
     * @param array $required
     * @param array $values 
     */
    public function validateFields($required, $values)
    {
        $errors = array();
        foreach($required as $field => $type)
        {
            switch($type)
            {
                case 'string':
                    if(!isset($values[$field]) || $values[$field] == '')
                    {
                       $errors[] = _x("Please enter a valid first and last name.", $this->settings->getPrefix()); 
                    }
                    break;

                case 'email':
                    if(!isset($values[$field]) || $values[$field] == '' || !is_email($values[$field]))
                    {
                       $errors[] = _x("Please enter a valid email address.", $this->settings->getPrefix()); 
                    }
                    break;
                case 'checkbox':
                    if(!isset($values[$field]) || $values[$field] == "false" || $values[$field] == "off" || $values[$field] == "")
                    {
                       $errors[] = _x("Please accept the terms and conditions.", $this->settings->getPrefix()); 
                    }
                    break;
            }
        }
        
        $this->errors = $errors;
        if(empty($errors))
        {
            $this->validated_data = $values;
        }else {
            $this->invalid_data = $values;
        }
    }
    
    /**
     * Checks if a free slot is available for the user
     */
    public function checkForFreeSlot()
    {
        // number of people registered
        $count_object = bebelEventsUtils::getEventListEntries($this->event_id);
        $registered = count($count_object);
        
        // get event slots number
        $slots = BebelUtils::getCustomMeta('event_slot_count', '', $this->event_id);
        
        
        if($slots != "0")
        {
            
            // limited slots free
            if($slots <= $registered)
            {
        
                // already full
                $this->free_slot_available = false;
                $this->errors[] = _x('We are sorry, there are no more tickets available for this event', $this->settings->getPrefix());
            }
            
        }
        
    }
    
    
    /**
     * Checks if the user is already signed up and sends an error message
     */
    public function checkForSignUp($return = false)
    {
        $is_signed_up = bebelEventsUtils::isSignedUp($this->event_id, $this->validated_data);
        
        if($return)
        {
            return $is_signed_up;
        }
        
        if($is_signed_up)
        {
            $this->errors['signedup'] = _x('You already signed up for this event. If you lost your code, go to the event you signed up for and click on the link below the event text.', $this->settings->getPrefix());
        }
        
    }
    
    
    /**
     * return if the form is valid
     *
     * @return boolean 
     */
    public function isValid()
    {
        return empty($this->errors) ? true : false;
    }
    
    
    /**
     * set ajax call to true
     */
    public function isAjaxCall()
    {
        $this->ajax = true;
    }
    
    
    public function displayErrors()
    {
        if($this->ajax)
        {
            // just die the message, thats all we need for ajax
            die($this->buildErrorHtml());
        }else {
            
            // @TODO: redirect to error page based on location, via setErrorPage()
            $permalink = get_permalink($this->event_id);
            $return_link = BebelUtils::addParameterToPermalink($permalink, array('step' => 'error'));
            
            // save errors in session
            if(isset($this->errors['signedup']))
            {
                $_SESSION[$this->settings->getPrefixUnderscored().'userdata'] = $this->validated_data;
            }else {
                $_SESSION[$this->settings->getPrefixUnderscored().'userdata'] = $this->invalid_data;
            }
            
            $_SESSION[$this->settings->getPrefixUnderscored().'errors'] = $this->buildErrorHtml();
            
            header("Location: $return_link");
            die;
        }
    }
    
    
    public function displaySuccess()
    {
        if($this->ajax)
        {
            // just die the message, thats all we need for ajax
            die($this->buildSuccessHtml());
        }else {
            $permalink = get_permalink($this->event_id);
            $return_link = BebelUtils::addParameterToPermalink($permalink, array('step' => 'done'));
            
            header("Location: $return_link");
        }
    }
    
    
    /**
     * Build an html string for displaying the errors
     *
     * @return string
     */
    public function buildErrorHtml()
    {
        $errors = $this->errors;
        
        $return = '<ul class="error">';
        foreach($errors as $message)
        {
            $return .= '<li>'.$message.'</li>';
        }
        $return .= '</ul>';
        
        return $return;
    }
    
    
    /**
     * Build an html string for displaying the success messages
     *
     * @return string 
     */
    public function buildSuccessHtml()
    {
        $messages = $this->messages;
        $return = '<ul class="success">';
        foreach($messages as $message)
        {
            $return .= '<li>'.$message.'</li>';
        }
        $return .= '</ul>';
        
        return $return;
    }
    
    /**
     * get the currently used mailing list
     *
     * @return string 
     */
    public function getMailchimpList()
    {
        $mc_list = false;
        
        // if newsletter only is wanted.
        if($this->event_id != 0){
            $mc_list = BebelUtils::getCustomMeta('mailchimp_list', '', $this->event_id);
        }
        
        if(!$mc_list)
        {
            // get default list
            $mc_list = $this->settings->get('mailchimp_default_list');  
        }
        
        return $mc_list;
    }
    
    /**
     * our wrapper method to sign up for the mailchimp newsletter
     */
    public function manageMailchimp()
    {
        $api = new BebelMailchimp();
        if($api->check() == 'valid')
        {

            $mc_list = $this->getMailchimpList();

            $send_to_mailchimp = array(
                'FNAME' => $this->validated_data['first_name'],
                'LNAME' => $this->validated_data['last_name'],
            );

            $mc_result = $api->listSubscribe($mc_list, $this->validated_data['email'], $send_to_mailchimp);

            // everything went fine
            if($mc_result === true)
            {
                $this->newsletter_signed = true;
                $this->messages[] = _x('You successfully signed up for the newsletter.', $this->settings->getPrefix());
            }else {
                $this->messages[] = $mc_result;
            }
            
        }
    }
    
    /**
     * get flag if newsletter was signed up for
     *
     * @return boolean 
     */
    public function signedUpForNewsletter()
    {
        return $this->newsletter_signed;
    }
    
    
    
    /**
     * put the user on the mailing list
     * 
     * @todo what if user only wants a newsletter?
     */
    public function putUserOnList($nomail = false)
    {
        // gather all the userdata
        $userdata = array(
            'first_name' => $this->validated_data['first_name'],
            'last_name' => $this->validated_data['last_name'],
            'email' => $this->validated_data['email']
        );
        
        if($this->signedUpForNewsletter())
        {
            $userdata['mailchimp_list'] = $this->getMailchimpList();
            $userdata['in_mailchimp'] = 1;
        }
        
        // user wants newsletter, just as precaution. if mailchimp is not available, this is our point for getting the valid email adresses from the db
        if(isset($this->validated_data['send_newsletter']) && $this->validated_data['send_newsletter'] == "true") 
        {
            $userdata['wants_newsletter'] = 1;
        }
        
        // generate code
        $code = bebelEventsUtils::generateAccessCode($this->event_id);
        $userdata['access_code'] = $code;
        
        // call external static method
        $result = bebelEventsUtils::putUserOnList($this->event_id, $userdata);
        
        switch($result)
        {
            case 'alreadyon':
                if($nomail)
                {
                    $this->errors[] = _x('You are already signed up for the newsletter.', $this->settings->getPrefix());;
                }else {
                    $this->errors[] = _x('You are already on the guest list.', $this->settings->getPrefix());;
                }
                
                break;
            
            case false:
                $this->errors[] = _x('An error occured while putting you on the guest list. Please try again later or contact the admin.', $this->settings->getPrefix());
                break;
            
            default:
                if($nomail)
                {
                    // this message would be sent twice.
                    if(!$this->newsletter_signed)
                    {
                        $this->messages[] = _x('You successfully signed up for the newsletter', $this->settings->getPrefix());
                    }
                }else {
                    $this->sendEmail($code);
                }
                
                break;
        }
    }
    
    
    public function lostKey()
    {
        // check if user signed up
        if($this->checkForSignUp(true))
        {
            $code = bebelEventsUtils::getUserdetailsByEvent($this->event_id, $this->validated_data);
            
            $message = _x('We just sent you the code to your email address.', $this->settings->getPrefix());
            
            $this->sendEmail($code, $message, true);
        }else {
            $this->errors['signedup'] = _x('This email is not registered for this event.<br>If you forgot your email address, contact us through our contact page.', $this->settings->getPrefix());
        }
        
    }
    
    
    /**
     * sends out the newsletter
     */
    public function sendEmail($code, $message = false, $is_object = false)
    {
        $mail_data = $this->validated_data;
        if(!$is_object)
        {
            $mail_data['code'] = $code;
        }else {
            $mail_data['code'] = $code->access_code;
            $mail_data['first_name'] = $code->first_name;
            $mail_data['last_name'] = $code->last_name;
            $mail_data['email'] = $code->email;
        }
        
        $mailer = new bebelEventsMailer();
        $mailer->setMessage($mail_data, $this->query)->send();
        if(!$message)
        {
            $this->messages[] = _x('We have put your name on the guest list.', $this->settings->getPrefix());
        }else {
            $this->messages[] = $message;
        }
        
    }
    
    
    
}