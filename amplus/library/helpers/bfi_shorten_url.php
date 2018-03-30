<?php
/**
 */

/**
 * Shortens a URL using http://goo.gl Use this conservatively since
 * this performs a call to an online service and might be slow if
 * performed multiple times.
 *
 * @package API\Links
 * @see http://goo.gl/
 * @param string $url the url to shorten
 * @return string the shortened url
 */
function bfi_shorten_url($url) {
    return BFIGoogleUrl::shorten($url);
}

 
/**
 * @ignore
 */
class BFIGoogleUrl {
    public static function shorten($url) {
        if (!function_exists('curl_init')) 
            return $url;
            
        // before proceeding, check whether we have an old short URL and return that instead
        $option = 'shorturl_'.md5($url);
        if (bfi_get_option($option)) {
            return bfi_get_option($option);
        }
            
        $api = 'https://www.googleapis.com/urlshortener/v1/url?';
        $data_string = '{"longUrl":"'.$url.'"}';
        
        # Initialize cURL
        $ch = curl_init();
        # Set our default target URL
        curl_setopt($ch, CURLOPT_URL, $api);
        # We don't want the return data to be directly outputted, so set RETURNTRANSFER to true
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        # Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.122 Safari/534.30"); // from timthumb
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        // get the shortened url
        $ret = json_decode(curl_exec($ch))->id;
        
        # Close the curl handle
        curl_close($ch);
        $ch = null;
        
        // save the short URL for future use
        bfi_update_option($option, $ret);
        
        return $ret;
    }
}