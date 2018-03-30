<?php

/**
 * our small paypal class. makes it easy for us to control payment via paypal.
 * 
 * 
 * example:
 * 
 * $foo = new bebelPayPal();
 * $foo->setBasicParameter(); // add return and cancel url, if you want
 * $foo->setCurrency("USD"); // add your currency. not all of them are supported. check manual.
 * 
 * 
 */

class bebelPayPal {
    
    
    /**
     * contains the settings of our framework.
     *
     * @var object 
     */
    protected $settings;
    
    
    /**
     * the base url of the installation
     *
     * @var string
     */
    protected $base_url;
    
    
    /**
     * contains the return and cancel url
     *
     * @var array 
     */
    protected $local_url = array();
    
    /**
     * contains all the information for 
     * the api. can be filled with sandbox or live data, depending on settings
     * 
     * @see __construct()
     * @var array 
     */
    protected $api_data;
    
    
    /**
     * contains the url for api connection.
     *
     * @var array 
     */
    protected $endpoint = array(
        'live' => 'https://api-3t.paypal.com/nvp',
        'sandbox' => 'https://api-3t.sandbox.paypal.com/nvp'
    );
    
    
    /**
     * this is the URL that the buyer is
     * first sent to to authorize payment with their paypal account
     * @var array 
     */
    protected $paypal_url = array(
        'live' => 'https://www.paypal.com/webscr?cmd=_express-checkout&token=',
        'sandbox' => 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token='
    );
    
    
    /**
     * currently used paypal version
     *
     * @var string 
     */
    protected $paypal_api_version = '65.1';
    
    
    /**
     * This string will be built up and will contain all the necessary 
     * information for paypal.
     *
     * @var string 
     */
    protected $paypal_string;
    
    
    /**
     * Is responsible to build the object and to set the required api data
     * 
     */
    public function __construct()
    {
        $this->settings = BebelSingleton::getInstance('BebelSettings');
        
        if(!$this->settings->get('paypal_enable'))
        {
            throw new BebelException(__('You cannot use the paypal payment gateway if you do not enable it.'));
        }
        
        switch($this->settings->get('paypal_sandbox_enable'))
        {
            case 'on':
                $username = $this->settings->get('paypal_api_sandbox_username');
                $password = $this->settings->get('paypal_api_sandbox_password');
                $signature = $this->settings->get('paypal_api_sandbox_signature');
                break;
            case 'off':
            default:
                $username = $this->settings->get('paypal_api_username');
                $password = $this->settings->get('paypal_api_password');
                $signature = $this->settings->get('paypal_api_signature');
                break;
        }    
        
        $this->api_data = array(
            'username' => $username,
            'password' => $password,
            'signature' => $signature
        );
        
        // set base url
        $this->base_url = get_bloginfo('stylesheet_directory');
        
        // begin building up paypal_string
        $this->paypal_string = "&PWD=".urlencode($this->api_data['password']).
                               "&USER=".urlencode($this->api_data['username']).
                               "&SIGNATURE=".urlencode($this->api_data['signature']);
        
        // set the version
        $this->paypal_string .= "&VERSION=".urlencode($this->paypal_api_version);	
        
        // set callback timeout to 4, should be a good value
        
        
    }
    
    
    /**
     * @todo: get the button from the local countries paypal server.
     * 
     * @return string
     */
    public function getButton()
    {
        if($this->settings->get('paypal_sandbox_enable')) 
        {
            $base = $this->paypal_url['sandbox'];
        }else {
            $base = $this->paypal_url['live'];
        }
        
        return '';
    }
   
    
    /**
     * Set the currency for this transaction and check for validity
     *
     * @param string $currencyCode
     * @return bebelPayPal 
     */
    public function setCurrency($currencyCode)
    {
        // we first have to check if the code is valid
        $currencies = bebelPayPalUtils::getCurrencies();
        
        if(!isset($currencies[$currencyCode]))
        {
            throw new Exception("Currency not supported by paypal!");
        }
        
        $str = "&CURRENCYCODE=".$currencyCode.
               "&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode;
        
        $this->paypal_string .= $str;
        
        return $this;
        
    }
    
    /**
     * Set the rest of required parameters via array
     *
     * @param array $args 
     */
    public function setFromArray($args)
    {
        $str = http_build_query($args);
        $this->paypal_string .= "&".$str;
    }
    
    
    public function setToken($token)
    {
        $this->paypal_string .= "&TOKEN=".urlencode($token);
    }
    
    
    
    public function hashCall($methodName, $nvpstr = false)
    {
	
        if($this->settings->get('paypal_sandbox_enable') == "on") 
        {
            $endpoint = $this->endpoint['sandbox'];
        }else {
            $endpoint = $this->endpoint['live'];
        }
        
    
        //setting the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        //turning off the server and peer verification(TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POST, 1);
	

        // set method and get paypal string, and add custom string, if needed
        $nvpreq = "METHOD=".urlencode($methodName).$this->paypal_string;
        
//        print_r($_SESSION);
        // Decomment for debuggin
//        echo $nvpreq."<br><br><br>";
//        echo "<br><br><br>".urldecode($nvpreq)."<br><br><br>";
//        die();
        
        if($nvpstr)
        {
            $nvpreq .= $nvpstr;
        }
	
        //setting the nvpreq as POST FIELD to curl
        curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);

        //getting response from server
        $response = curl_exec($ch);

        //convrting NVPResponse to an Associative Array
        $nvpResArray = $this->deformatNVP($response);
        $nvpReqArray = $this->deformatNVP($nvpreq);
        $_SESSION['nvpReqArray'] = $nvpReqArray;

        if (curl_errno($ch)) {
            // moving to display page to display curl errors
            $_SESSION['curl_error_no']=curl_errno($ch) ;
            $_SESSION['curl_error_msg']=curl_error($ch);
            echo "Report this to the websites admin. Thanks";
            print_r($_SESSION['curl_error_no']);            
            print_r($_SESSION['curl_error_msg']);
            die();
        } else {
             //closing the curl
			curl_close($ch);
        }

        return $nvpResArray;
    }

    /** This function will take NVPString and convert it to an Associative Array and it will decode the response.
      * It is usefull to search for a particular key and displaying arrays.
      * @nvpstr is NVPString.
      * @nvpArray is Associative Array.
      */

    public function deformatNVP($nvpstr)
    {

        $intial=0;
        $nvpArray = array();


        while(strlen($nvpstr)){
            //postion of Key
            $keypos= strpos($nvpstr,'=');
            //position of value
            $valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

            /*getting the Key and Value values and storing in a Associative Array*/
            $keyval=substr($nvpstr,$intial,$keypos);
            $valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
            //decoding the respose
            $nvpArray[urldecode($keyval)] =urldecode( $valval);
            $nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
        }
        
        return $nvpArray;
    }
    
    
    public function setReturnUrl($returnURL = false)
    {
        if(!$returnURL)
        {
            $returnURL = $this->base_url.'/bebelCp2/bundles/bebelPaymentGatewaysBundle/templates/paypal.php';
        }
        $str = "&RETURNURL=".urlencode($returnURL);
        
        $this->local_url['return_url'] = $returnURL;
        $this->paypal_string .= $str;        
        
        return $this;
    }
    
    
    public function setCancelUrl($cancelURL = false)
    {
        if(!$cancelURL)
        {
            $cancelURL = $this->base_url.'/bebelCp2/bundles/bebelPaymentGatewaysBundle/templates/paypal_cancel.php';
        }
        $str = "&CANCELURL=".urlencode($cancelURL);
        
        $this->local_url['cancel_url'] = $cancelURL;
        $this->paypal_string .= $str;
        
        return $this;
    }
    
    /**
     * Returns the return url
     *
     * @return string 
     */
    public function getReturnUrl()
    {
        return urldecode($this->local_url['return_url']);
    }
    
    /**
     * Returns the cancel url
     *
     * @return string 
     */
    public function getCancelUrl()
    {
        return urldecode($this->local_url['cancel_url']);
    }
    
    
    public function getPaypalUrl()
    {
        if($this->settings->get('paypal_sandbox_enable') == "on") 
        {
            return $this->paypal_url['sandbox'];
        }else {
            return $this->paypal_url['live'];
        }
    }
    
}
