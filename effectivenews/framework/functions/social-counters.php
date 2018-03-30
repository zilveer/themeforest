<?php
//Twitter followers count
function mom_sc_twitter ($user, $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
$count =  get_transient('mom_twitter_followers');
if ($count != false) return $count;
$count = 0;
if (mom_option('twitter_ck') != '' && mom_option('twitter_cs') != '' && mom_option('twitter_at') != '' && mom_option('twitter_ats') != '') {
require_once( MOM_FW .'/inc/twitterAPi/TwitterAPIExchange.php'); 

$settings = array(
'consumer_key' => mom_option('twitter_ck'),
'consumer_secret' => mom_option('twitter_cs'),
'oauth_access_token' => mom_option('twitter_at'),
'oauth_access_token_secret' => mom_option('twitter_ats'),
);

$ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$getfield = '?screen_name='.$user;
$requestMethod = 'GET';
$twittern = new TwitterAPIExchange($settings);
$follow_count=$twittern->setGetfield($getfield)
->buildOauth($ta_url, $requestMethod)
->performRequest();
$data = json_decode($follow_count, true);
$count = isset($data[0]['user']['followers_count']) ? $data[0]['user']['followers_count']: '';
}
set_transient('mom_twitter_followers', $count, $cache_timeout);
if ($count == '') { $count = 0; }
return $count;
}

//facebook fans count
function mom_sc_facebook ($page_id, $return = 'count', $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
$count =  get_transient('mom_facebook_followers');
$link =  get_transient('mom_facebook_page_url');
if ($return == 'link') {
if ($link !== false) return $link;
} else {
if ($count !== false) return $count;
}
$count = 0;
$link = '';
$facebook_access_token = mom_option('facebook_access_token');
$data = wp_remote_get('https://graph.facebook.com/' . $page_id .'?access_token='.$facebook_access_token);
    if (!is_wp_error($data)) {
        $json = json_decode( $data['body'], true );
        $count = intval($json['likes']);
        $link = $json['link'];
                set_transient('mom_facebook_followers', $count, $cache_timeout);
                set_transient('mom_facebook_page_url', $link, $cache_timeout);
    }
    if ($return == 'link') {
        return $link;
    } else {
        return $count;
    }
}

//googleplus fans count
function mom_sc_googleplus ($page_id, $return = 'count', $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
   // delete_transient('mom_googleplus_followers');
   // delete_transient('mom_googleplus_page_url');
$count =  get_transient('mom_googleplus_followers');
$link =  get_transient('mom_googleplus_page_url');
if ($return == 'link') {
if ($link !== false) return $link;
} else {
if ($count !== false) return $count;
}
$count = 0;
$link = '';
$api_key = mom_option('googlep_api_key');
$data = wp_remote_get('https://www.googleapis.com/plus/v1/people/'.$page_id.'?key='.$api_key);
    if (!is_wp_error($data)) {
        $json = json_decode( $data['body'], true );
        $count = isset($json['circledByCount']) ? intval($json['circledByCount']) : intval($json['plusOneCount']);
        $link = $json['url'];
                set_transient('mom_googleplus_followers', $count, $cache_timeout);
                set_transient('mom_googleplus_page_url', $link, $cache_timeout);
    }
    if ($return == 'link') {
        return $link;
    } else {
        return $count;
    }
}

//dribbble fans count
function mom_sc_dribbble ($dribbble, $return = 'count', $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
   // delete_transient('mom_dribbble_followers');
    //delete_transient('mom_dribbble_page_url');
$count =  get_transient('mom_dribbble_followers');
$link =  get_transient('mom_dribbble_page_url');
if ($return == 'link') {
if ($link !== false) return $link;
} else {
if ($count !== false) return $count;
}
$count = 0;
$link = '';
$data = wp_remote_get('http://api.dribbble.com/players/'.$dribbble);
    if (!is_wp_error($data)) {
        $json = json_decode( $data['body'], true );
        $count = intval($json['followers_count']);
        $link = $json['url'];
                set_transient('mom_dribbble_followers', $count, $cache_timeout);
                set_transient('mom_dribbble_page_url', $link, $cache_timeout);
    }
    if ($return == 'link') {
        return $link;
    } else {
        return $count;
    }
}

//youtube fans count
function mom_sc_youtube ($youtube, $return = 'count', $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
   // delete_transient('mom_youtube_followers');
   //delete_transient('mom_youtube_page_url');
$count =  get_transient('mom_youtube_followers');
$link =  get_transient('mom_youtube_page_url');
if ($return == 'link') {
if ($link !== false) return $link;
} else {
if ($count !== false) return $count;
}
$count = 0;
$link ='https://www.youtube.com/channel/'.$youtube;

$key = mom_option('youtube_api_key');

if ($key != '') {
$data = wp_remote_get('https://www.googleapis.com/youtube/v3/channels?part=statistics&id='.$youtube.'&key='.$key);
    if (!is_wp_error($data)) {
        $json = json_decode( $data['body'], true );
        $count = intval($json['items'][0]['statistics']['subscriberCount']);
        set_transient('mom_youtube_followers'.$youtube, $count, 3600);
    }
}
    if ($return == 'link') {
        return $link;
    } else {
        return $count;
    }
}

//vimeo fans count
function mom_sc_vimeo ($vimeo, $return = 'count', $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
   //delete_transient('mom_vimeo_followers');
   //delete_transient('mom_vimeo_page_url');
$count =  get_transient('mom_vimeo_followers');
$link =  get_transient('mom_vimeo_page_url');
if ($return == 'link') {
if ($link !== false) return $link;
} else {
if ($count !== false) return $count;
}
$count = 0;
$link = '';
$data = wp_remote_get('http://vimeo.com/api/v2/channel/'.$vimeo.'/info.json');
    if (!is_wp_error($data)) {
        $json = json_decode( $data['body'], true );
        $count = intval($json['total_subscribers']);
        $link = $json['url'];
                set_transient('mom_vimeo_followers', $count, $cache_timeout);
                set_transient('mom_vimeo_page_url', $link, $cache_timeout);
    }
    if ($return == 'link') {
        return $link;
    } else {
        return $count;
    }
}


//soundcloud fans count
function mom_sc_soundcloud ($soundcloud, $return = 'count', $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
   // delete_transient('mom_soundcloud_followers');
   //delete_transient('mom_soundcloud_page_url');
$count =  get_transient('mom_soundcloud_followers');
$link =  get_transient('mom_soundcloud_page_url');
if ($return == 'link') {
if ($link !== false) return $link;
} else {
if ($count !== false) return $count;
}
$count = 0;
$link = '';
$client_id = mom_option('soundcloud_client_id');
if ($client_id != '') {
$data = wp_remote_get('http://api.soundcloud.com/users/'.$soundcloud.'.json?client_id='.$client_id);
    if (!is_wp_error($data)) {
        $json = json_decode( $data['body'], true );
        $count = intval($json['followers_count']);
        $link = $json['permalink_url'];
                set_transient('mom_soundcloud_followers', $count, $cache_timeout);
                set_transient('mom_soundcloud_page_url', $link, $cache_timeout);
    }
}
    if ($return == 'link') {
        return $link;
    } else {
        return $count;
    }
}

//behance fans count
function mom_sc_behance ($behance, $return = 'count', $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
   // delete_transient('mom_behance_followers');
   //delete_transient('mom_behance_page_url');
$count =  get_transient('mom_behance_followers');
$link =  get_transient('mom_behance_page_url');
if ($return == 'link') {
if ($link !== false) return $link;
} else {
if ($count !== false) return $count;
}
$count = 0;
$link = '';
$api_key = mom_option('behance_api_key');
if ($api_key != '') {
$data = wp_remote_get('https://www.behance.net/v2/users/'.$behance.'?api_key='.$api_key);
    if (!is_wp_error($data)) {
        $json = json_decode( $data['body'], true );
        $count = intval($json['user']['stats']['followers']);
        $link = $json['user']['url'];
                set_transient('mom_behance_followers', $count, $cache_timeout);
                set_transient('mom_behance_page_url', $link, $cache_timeout);
    }
}
    if ($return == 'link') {
        return $link;
    } else {
        return $count;
    }
}

//instagram fans count
function mom_sc_instagram ($instagram, $return = 'count', $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
   // delete_transient('mom_instagram_followers');
   //delete_transient('mom_instagram_page_url');
$count =  get_transient('mom_instagram_followers');
$link =  get_transient('mom_instagram_page_url');
if ($return == 'link') {
if ($link !== false) return $link;
} else {
if ($count !== false) return $count;
}
$count = 0;
$link = '';
$access_token = mom_option('instagram_access_token');
$instID = '';
if ($access_token != '') {
//instagram
$instID_url = wp_remote_get('https://api.instagram.com/v1/users/search?q='.$instagram.'&access_token='.$access_token);
    if (!is_wp_error($instID_url)) {
$instID_json = json_decode( $instID_url['body'], true );
$instID = $instID_json['data'][0]['id'];
    }
$data = wp_remote_get('https://api.instagram.com/v1/users/'.$instID.'/?access_token='.$access_token);
    if (!is_wp_error($data)) {
        $json = json_decode( $data['body'], true );
        $count = intval($json['data']['counts']['followed_by']);
        $link = 'http://instagram.com/'.$instagram;
        set_transient('mom_instagram_followers', $count, $cache_timeout);
        set_transient('mom_instagram_page_url', $link, $cache_timeout);
    } 
}
    if ($return == 'link') {
        return $link;
    } else {
        return $count;
    }
}


//delicious fans count
function mom_sc_delicious ($delicious, $return = 'count', $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
   // delete_transient('mom_delicious_followers');
   //delete_transient('mom_delicious_page_url');
$count =  get_transient('mom_delicious_followers');
$link =  get_transient('mom_delicious_page_url');
if ($return == 'link') {
if ($link !== false) return $link;
} else {
if ($count !== false) return $count;
}
$count = 0;
$link = '';
$data = wp_remote_get('http://feeds.delicious.com/v2/json/userinfo/'.$delicious);
    if (!is_wp_error($data)) {
        $json = json_decode( $data['body'], true );
        $count = intval($json[2]['n']);
        $link = 'https://delicious.com/'.$delicious;
                set_transient('mom_delicious_followers', $count, $cache_timeout);
                set_transient('mom_delicious_page_url', $link, $cache_timeout);
    }
    if ($return == 'link') {
        return $link;
    } else {
        return $count;
    }
}

// pinterest
function mom_sc_pinterest ($pinterest, $cache_timeout = '') {
    if ($cache_timeout == '') {
        $cache_timeout = mom_option('social_counter_cache_time_out');
    }
    if ($cache_timeout == '') {
        $cache_timeout = 3600;
    }
    //delete_transient('mom_pinterest_followers');
        $count =  get_transient('mom_pinterest_followers');
        if ($count !== false) return $count;
        
    $pin_metas = get_meta_tags($pinterest);
    if (isset($pin_metas['pinterestapp:followers'])) {
        $count = $pin_metas['pinterestapp:followers'];
    } else {
        $count = $pin_metas['followers'];
    }
        set_transient('mom_pinterest_followers', $count, $cache_timeout);
        return $count;        

}
if ('widgets.php' == basename($_SERVER['PHP_SELF'])) {
        add_action( 'admin_enqueue_scripts', 'mom_scw_admin_script');
}
function mom_scw_admin_script(){
        wp_enqueue_script( 'social-counter-widget', get_template_directory_uri() . '/framework/widgets/js/social-counter.js', array('jquery'));
        wp_localize_script( 'social-counter-widget', 'MomSCW', array(
        'url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'ajax-nonce' ),
        )
    );
}
    // ajax Action
        add_action( 'wp_ajax_mom_scwdc', 'mom_social_counter_delete_cache' );  

function mom_social_counter_delete_cache () {
// stay away from bad guys 
$nonce = $_POST['nonce'];
if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
die ( 'Nope!' );
        
        delete_transient('mom_twitter_followers');
        delete_transient('mom_facebook_followers');
        delete_transient('mom_facebook_page_url');
        delete_transient('mom_googleplus_followers');
        delete_transient('mom_googleplus_page_url');
        delete_transient('mom_dribbble_followers');
        delete_transient('mom_dribbble_page_url');
         delete_transient('mom_youtube_followers');
        delete_transient('mom_youtube_page_url');
        delete_transient('mom_vimeo_followers');
        delete_transient('mom_vimeo_page_url');
        delete_transient('mom_soundcloud_followers');
        delete_transient('mom_soundcloud_page_url');
        delete_transient('mom_behance_followers');
        delete_transient('mom_behance_page_url');
        delete_transient('mom_instagram_followers');
        delete_transient('mom_instagram_page_url');
        delete_transient('mom_delicious_followers');
        delete_transient('mom_delicious_page_url');
        delete_transient('mom_pinterest_followers');
        echo 'success';
        exit();
}