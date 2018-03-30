<?php
require_once('twitteroauth.php');

//convert links to clickable format
    function convert_links($status,$targetBlank=true,$linkMaxLen=250){

        // the target
            $target=$targetBlank ? " target=\"_blank\" " : "";

        // convert link to url
        $status = preg_replace_callback("/((http:\/\/|https:\/\/)[^ )]+)/",

            function($matches){
                return '<a href="'.$matches[0].'" title="'.$matches[0].'" $target >'. ((strlen($matches[0])>=250 ? substr($matches[0],0,250).'...':$matches[0])).'</a>';
            },
            $status);


        // convert @ to follow
            $status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);

        // convert # to search
            $status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);

        // return the status
            return $status;
    }

    //convert dates to readable format
    function relative_time($a) {
        //get current timestampt
        $b = strtotime("now");
        //get timestamp when tweet created
        $c = strtotime($a);
        //get difference
        $d = $b - $c;
        //calculate different time values
        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;

        if(is_numeric($d) && $d > 0) {
            //if less then 3 seconds
            if($d < 3) return "right now";
            //if less then minute
            if($d < $minute) return floor($d) . " seconds ago";
            //if less then 2 minutes
            if($d < $minute * 2) return "about 1 minute ago";
            //if less then hour
            if($d < $hour) return floor($d / $minute) . " minutes ago";
            //if less then 2 hours
            if($d < $hour * 2) return "about 1 hour ago";
            //if less then day
            if($d < $day) return floor($d / $hour) . " hours ago";
            //if more then day, but less then 2 days
            if($d > $day && $d < $day * 2) return "yesterday";
            //if less then year
            if($d < $day * 365) return floor($d / $day) . " days ago";
            //else return more than a year
            return "over a year ago";
        }
    }

    function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret)
    {
        $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
        return $connection;
    }

    function pkb_tweets($username, $count, $consumerkey, $consumersecret, $accesstoken, $accesstokensecret)
    {
        $connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
        $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$username."&count=".$count) or die('Couldn\'t retrieve tweets! Wrong username?');
        $timeline = '';
        if(!empty($tweets->errors)){
            if($tweets->errors[0]->message == 'Invalid or expired token'){
                echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
            }else{
                //echo $consumerkey . '<br>'. $consumersecret . '<br>'. $accesstoken . '<br>'. $accesstokensecret . '<br>';
                echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
            }
            return;
        }

        for($i = 0;$i <= count($tweets); $i++){
            if(!empty($tweets[$i])){
                $tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
                $tweets_array[$i]['text'] = $tweets[$i]->text;
                $tweets_array[$i]['status_id'] = $tweets[$i]->id_str;
            }
        }

        foreach($tweets_array as $tweet)
        {
            $timeline .= '<li>';
            $timeline .= '<span class="tweet_text">'.convert_links($tweet['text']).'</span>';
            $timeline .= '<span class="tweet_time"><a target="_blank" href="http://twitter.com/'.$username.'/statuses/'.$tweet['status_id'].'">'.relative_time($tweet['created_at']).'</a></span>';
            $timeline .= '</li>';
        }

        echo '<ul class="tweet_list">' . $timeline . '</ul>';
    }

?>