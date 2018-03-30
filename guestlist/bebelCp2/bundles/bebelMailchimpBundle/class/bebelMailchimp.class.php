<?php

class BebelMailchimp
{
    
    /**
     * Contains the object of the mailchimp api
     *
     * @var object 
     */
    protected $mcapi;
    
    
    /**
     * Holds the settings object
     * 
     * @var object 
     */
    protected $settings;
    
    
    
    
    /**
     * Creates object of mailchimp api class and gets the api key from the database, if exists.
     */
    public function __construct($api_key = false) 
    {
        if(!$api_key) 
        {
            $this->settings = BebelSingleton::getInstance('BebelSettings');
            $api_key = $this->settings->get('mailchimp_apikey');
        }
        
        if($api_key != '') 
        {
            $this->mcapi = new MCAPI($api_key);
        }else {
            throw new BebelException("You do not have any mailchimp api key defined. Please fix that asap.");
        }
        
        
    }
    
    
    
    /**
     * 
     *
     * @return boolean or error message 
     */
    public function check() 
    {
        $lists = $this->mcapi->lists();
        
        if($this->mcapi->errorCode) 
        {
            return "invalid";
        }
        return "valid";
    }
    
    
    public function returnError($errorCode)
    {
        switch($errorCode)
        {
            case 104:
                $message = _x("API key is invalid", $this->settings->getPrefix());
                break;
            case 200:
                $message = _x("The List does not exist. Please send a mail to the admin.", $this->settings->getPrefix());
                break;
            case 214:
                $message = _x("Yoy already signed up for the newsletter. You will <b>not</b> get another activation mail.", $this->settings->getPrefix());
                break;
            default:
                $message = _x("An unknown error occured. Try again later or try contacting the admin.", $this->settings->getPrefix());
                break;

        }
        
        return $message;
    }
    
    
    /**
     * Gets an array of all the lists we have on mailchimp
     * 
     * @return array or string 
     */
    public function getLists()
    {
        
        $lists = $this->mcapi->lists();
        
       
        
        if ($this->mcapi->errorCode){
            return $this->returnError($this->mcapi->errorCode);
        } else {
            return $lists;
        }

        
    }
    
    
    public function listSubscribe($list, $email, $param) 
    {
        $result = $this->mcapi->listSubscribe($list, $email, $param);
        
        if ($this->mcapi->errorCode){
            return $this->returnError($this->mcapi->errorCode);
        } else {
            return true;
        }
        
    }
}