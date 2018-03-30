<?php

class BFITwitter {
    
    public $userID;
    public $consumerKey;
    public $consumerSecret;
    public $oAuthToken;
    public $oAuthTokenSecret;
    
    function __construct($userID, 
                         $consumerKey, 
                         $consumerSecret, 
                         $oAuthToken, 
                         $oAuthTokenSecret) {
        $this->userID           = $userID;
        $this->consumerKey      = $consumerKey;
        $this->consumerSecret   = $consumerSecret;
        $this->oAuthToken       = $oAuthToken;
        $this->oAuthTokenSecret = $oAuthTokenSecret;
    }
    
    private function getConnectionWithAccessToken() {
        require_once(BFI_LIBRARYPATH . "includes/twitteroauth.php");
        $connection = new TwitterOAuth(
            $this->consumerKey, 
            $this->consumerSecret, 
            $this->oAuthToken, 
            $this->oAuthTokenSecret);
        return $connection;
    }
    
    public function getFollowLink() {
        return "
        <a href='https://twitter.com/{$this->userID}' class='twitter-follow-button' data-show-count='false'>Follow @{$this->userID}</a>
        <script src='//platform.twitter.com/widgets.js' type='text/javascript'></script>
        ";
    }
    
    // based on: http://css-tricks.com/snippets/php/get-latest-twitter-status/
    public function getTweets($count = 1) {
        if ($count < 1) $count = 1;
        
        // get the tweet from the database
        $unserializedStatus = bfi_get_option(BFI_SHORTNAME.'_twitter_latest_status_'.$this->userID.'_'.$count);
        $lastUpdate = bfi_get_option(BFI_SHORTNAME.'_twitter_last_update_'.$this->userID.'_'.$count);
        if ($unserializedStatus) $status = unserialize($unserializedStatus);
        else $status = array();
        
        // check if we need to update the tweets
        $updateNow = false;
        if ($lastUpdate) {
            if (round(abs(strtotime(date("Y-m-d H:i:s")) - strtotime($lastUpdate)) / 60,2) > 5) {
                $updateNow = true;
            }
        }
        $updateNow = true;
    
        if (!$status || !$lastUpdate || $updateNow) {
            // Twitter API 1.1
            $conn = $this->getConnectionWithAccessToken();
            $content = $conn->get("statuses/user_timeline", 
                array("screen_name" => $this->userID, 
                      "count"       => $count));
            
            if (!is_array($content)) return $status;
            if (!count($content)) return $status;
            
            $data = array();
            foreach ($content as $tweet) {
                $data[] = array(
                    'text' => $this->formLinks($tweet->text),
                    'date' => $tweet->created_at,
                    'age' => $this->formAge($tweet->created_at),
                    'date_formatted' => date(get_option('date_format'), strtotime($tweet->created_at)) . ' ' . date(get_option('time_format'), strtotime($tweet->created_at)),
                );
            }
            
            /*
            //$url = "http://twitter.com/statuses/user_timeline/$this->userID.xml?count=1";
            // don't use the count param. Twitter sometimes doesn't give the latest status.
            // Just get the latest statuses then get only the first one.
            $xml = $this->loadXML2("api.twitter.com", "/1/statuses/user_timeline.xml?screen_name={$this->userID}"); 
            
            
            if (!$xml) return $status; 
    
            $data = array();
            for ($i=0; $i < count($xml->status); $i++) {
                
                // form the data
                $data[] = array(
                    'text' => $this->formLinks((string)$xml->status[$i]->text),
                    'date' => strtotime((string)$xml->status[$i]->created_at),
                    'age' => $this->formAge((string)$xml->status[$i]->created_at),
                    'date_formatted' => date(get_option('date_format'), strtotime((string)$xml->status[$i]->created_at)) . ' ' .
                                        date(get_option('time_format'), strtotime((string)$xml->status[$i]->created_at)),
                    );
                if ($i+1 == $count) break;
            }
            */
            // update the database
            bfi_update_option(BFI_SHORTNAME.'_twitter_latest_status_'.$this->userID.'_'.$count, serialize($data));
            bfi_update_option(BFI_SHORTNAME.'_twitter_last_update_'.$this->userID.'_'.$count, date("Y-m-d H:i:s"));
            $status = $data;
        }
        
        return $status;
    }


    private function formAge($date) {
        // age of the tweet
        $diff = abs(strtotime(date("Y-m-d H:i:s")) - strtotime($date));
        if ($diff < 60) {
            $diff = (int)$diff == 1 ? 
                sprintf(__('%s second ago', BFI_I18NDOMAIN), (int)$diff) : 
                sprintf(__('%s seconds ago', BFI_I18NDOMAIN), (int)$diff);
        } else {
            $diff = $diff / 60;
            if ($diff < 60) {
                $diff = (int)floor($diff) == 1 ? 
                    sprintf(__('%s minute ago', BFI_I18NDOMAIN), (int)floor($diff)) : 
                    sprintf(__('%s minutes ago', BFI_I18NDOMAIN), (int)floor($diff));
            } else {
                $diff = $diff / 60;
                if ($diff < 24) {
                    $diff = (int)floor($diff) == 1 ?
                        sprintf(__('%s hour ago', BFI_I18NDOMAIN), (int)floor($diff)) :
                        sprintf(__('%s hours ago', BFI_I18NDOMAIN), (int)floor($diff));
                } else {
                    $diff = $diff / 24; // just a rough estimate, no need to be accurate
                    if ($diff < 30) {
                        $diff = (int)floor($diff) == 1 ?
                            sprintf(__('%s day ago', BFI_I18NDOMAIN), (int)floor($diff)) :
                            sprintf(__('%s days ago', BFI_I18NDOMAIN), (int)floor($diff));
                    } else {
                        $diff = $diff / 30;
                        if ($diff < 12) {
                            $diff = (int)floor($diff) == 1 ?
                                sprintf(__('%s month ago', BFI_I18NDOMAIN), (int)floor($diff)) :
                                sprintf(__('%s months ago', BFI_I18NDOMAIN), (int)floor($diff));
                        } else {
                            $diff = $diff / 12;
                            $diff = (int)floor($diff) == 1 ?
                                sprintf(__('%s year ago', BFI_I18NDOMAIN), (int)floor($diff)) :
                                sprintf(__('%s years ago', BFI_I18NDOMAIN), (int)floor($diff));
                        }
                    }
                }
            }
        }
        return $diff;
    }


    private function formLinks($status) {
        // make urls links
        $status = trim(preg_replace('/(http|https|ftp|file)\:\/\/[^\s]+/', '<a href="\0" target="_blank">\0</a>', $status));
        // make mentions links
        $status = trim(preg_replace('/(\@(\w+))/i', '<a href="http://twitter.com/#!/\2" target="_blank">\1</a>', " $status "));
        // make hash tags links
        while (preg_match('/\s(\#([^\s]+))\s/i', " $status ")) // somehow multiple instances aren't replaced if not in a while statement
            $status = trim(preg_replace('/\s(\#([^\s]+))\s/i', ' <a href="http://twitter.com/#!/search/%23\2" target="_blank">\1</a> ', " $status "));
        
        return $status; 
    }
    
    // From a comment on: http://php.net/manual/en/function.simplexml-load-file.php
    // hides the error message thrown by simplexml_load_file
    private function loadXML2($domain, $path, $timeout = 30) { 
    
        /* 
            Usage: 
            
            $xml = loadXML2("127.0.0.1", "/path/to/xml/server.php?code=do_something"); 
            if($xml) { 
                // xml doc loaded 
            } else { 
                // failed. show friendly error message. 
            } 
        */ 
    
        $fp = fsockopen($domain, 80, $errno, $errstr, $timeout); 
        if($fp) { 
            // make request 
            $out = "GET $path HTTP/1.1\r\n"; 
            $out .= "Host: $domain\r\n"; 
            $out .= "Connection: Close\r\n\r\n"; 
            fwrite($fp, $out); 
            
            // get response 
            $resp = ""; 
            while (!feof($fp)) { 
                $resp .= fgets($fp, 128); 
            } 
            fclose($fp); 
            // check status is 200 
            $status_regex = "/HTTP\/1\.\d\s(\d+)/"; 
            if(preg_match($status_regex, $resp, $matches) && $matches[1] == 200) {    
                // load xml as object 
                $parts = explode("\r\n\r\n", $resp);    
                return simplexml_load_string($parts[1]);                
            } 
        } 
        return false; 
        
    }   
}

?>