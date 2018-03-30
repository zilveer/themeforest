<?php



class bebelPayPalUtils 
{
    protected static $button_url = "https://www.paypal.com/en_GB/GB/i/btn/btn_xpressCheckout.gif";
    
    public static function getButton()
    {
        // create link
        
        return '<a href="'.get_bloginfo('stylesheet_directory').'/bebelCp2/bundles/bebelPaymentGatewaysBundle/templates/paypal.php"><img src="'.self::$button_url.'" alt="paypal"></a>';
    }

    /**
     * a list of all the supported currencies (we do only support express
     * checkout, that is why we only support these.
     * 
     * @see https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_currency_codes
     * @var currencies 
     * 
     * @return array
     */
    public static function getCurrencies() 
    {
        return array(
            'AUD' => 'Australian Dollar',
            'CAD' => 'Canadian Dollar',
            'CZK' => 'Czech Koruna',
            'DKK' => 'Danish Krone',
            'EUR' => 'Euro',
            'HUF' => 'Hungarian Forint',
            'JPY' => 'Japanese Yen',
            'NOK' => 'Norwegian Krone',
            'NZD' => 'New Zealand Dollar',
            'PLN' => 'Polish Zloty',
            'GBP' => 'Pound Sterling',
            'SGD' => 'Singapore Dollar',
            'SEK' => 'Swedish Krona',
            'CHF' => 'Swiss Franc',
            'USD' => 'U.S. Dollar'
        );
    }

}