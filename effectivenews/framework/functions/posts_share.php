<?php
/*
add_action( 'init', 'mom_ajax_post_share_init' );
function mom_ajax_post_share_init() {
        add_action( 'wp_ajax_mom_ajaxPostShare', 'mom_posts_share' );  
        add_action( 'wp_ajax_nopriv_mom_ajaxPostShare', 'mom_posts_share');
}
*/

function mom_posts_share($id, $url, $style='', $min=false) {
 /*   if (isset($_POST['nonce'])) {
	$nonce = $_POST['nonce'];
	    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
	    die ( '' );

    }
    if (isset($_POST['id'])) {
	$id = $_POST['id'];
    }
    if (isset($_POST['url'])) {
	$url = $_POST['url'];
    }
    if (isset($_POST['style'])) {
	$style = $_POST['style'];
    }
    if (isset($_POST['min'])) {
	$min = $_POST['min'];
    }
    */
    $url = urlencode($url);
    $desc = esc_js(wp_html_excerpt(strip_shortcodes(get_the_content()), 160));
    $img = urlencode(mom_post_image('large'));
    $title = get_the_title();
    $window_title = __('Share This', 'theme');
    $window_width = 600;
    $window_height = 455;

?>
<?php
//twitter
//delete_transient('mom_share_twitter_'.$id);
$twitter = get_transient('mom_share_twitter_'.$id);
if ($twitter == '') {
    $twitter_url = wp_remote_get('http://urls.api.twitter.com/1/urls/count.json?url='.$url);
    if (!is_wp_error($twitter_url)) {
	$twitter = json_decode($twitter_url['body'], true);
	$twitter = $twitter['count'];
    } else {
	$twitter = 0;
    }
    set_transient('mom_share_twitter_'.$id, $twitter, 1800);
}
//facebook
delete_transient('mom_share_facebook_'.$id);
$facebook = get_transient('mom_share_facebook_'.$id);
if ($facebook == '') {
$facebook_url = wp_remote_get('http://api.facebook.com/method/links.getStats?urls='.$url.'&format=json');
    if (!is_wp_error($facebook_url)) {
	$facebook = json_decode($facebook_url['body'], true);
	$share_count = isset($facebook[0]['share_count']) ? $facebook[0]['share_count'] : 0;
	$like_count = isset($facebook[0]['like_count']) ? $facebook[0]['like_count'] : 0;
	if (mom_option('post_share_facebook_count') == 'like') {
	    $facebook = $like_count;
	} elseif (mom_option('post_share_facebook_count') == 'both') {
	    $facebook = $like_count+$share_count;
	} else {
	    $facebook = $share_count;
	}
    } else {
	$facebook = 0;
    }
    set_transient('mom_share_facebook_'.$id, $facebook, 2000);
}

/*
//facebook like
delete_transient('mom_like_facebook_'.$id);
$facebook_like = get_transient('mom_like_facebook_'.$id);
if ($facebook_like == '') {
$facebook_like_url = wp_remote_get('http://api.facebook.com/method/links.getStats?urls='.$url.'&format=json');
    if (!is_wp_error($facebook_like_url)) {
	$facebook_like = json_decode($facebook_like_url['body'], true);
	$facebook_like = isset($facebook_like[0]['like_count']) ? $facebook_like[0]['like_count'] : 0;
	set_transient('mom_like_facebook_'.$id, $facebook_like, 2000);
    } else {
	$facebook_like = 0;
    }
}
*/
if ($style != 'vertical') {
//linkedin
//delete_transient('mom_share_linkedin_'.$id);
$linkedin = get_transient('mom_share_linkedin_'.$id);
if ($linkedin == '') {
$linkedin_url = wp_remote_get('http://www.linkedin.com/countserv/count/share?format=json&url='.$url);
    if (!is_wp_error($linkedin_url)) {
	$linkedin = json_decode($linkedin_url['body'], true);
	$linkedin = $linkedin['count'];
    } else {
	$linkedin = 0;
    }
set_transient('mom_share_linkedin_'.$id, $linkedin, 2200);

}

//pinterest
//delete_transient('mom_share_pinterest_'.$id);
$pinterest = get_transient('mom_share_pinterest_'.$id);
if ($pinterest == '') {
$pinterest_url = wp_remote_get('http://api.pinterest.com/v1/urls/count.json?url='.$url);
    if (!is_wp_error($pinterest_url)) {
	$json = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $pinterest_url['body']);
	$pinterest = json_decode($json, true);
	$pinterest = $pinterest['count'];
    } else {
	$pinterest = 0;
    }
    set_transient('mom_share_pinterest_'.$id, $pinterest, 2400);
}

}

//google
//delete_transient('mom_share_plusone_'.$id);
$plusone = get_transient('mom_share_plusonee_'.$id);
if ($plusone == '') {
	$plusone = 0;
	//$plusone = mom_get_plusones($url);
	set_transient('mom_share_plusone_'.$id, $plusone, 2600);
    } else {
    $plusone = 0;
}

?>
<?php if ($style == 'vertical') { ?>
	       <div class="mom-social-share ss-vertical border-box">
	    <?php if (mom_option('post_share_facebook') != false) { ?>
            <div class="ss-icon facebook">
                <a href="#" onclick="window.open('http://www.facebook.com/sharer/sharer.php?m2w&s=100&p&#91;url&#93;=<?php echo $url; ?>&p&#91;images&#93;&#91;0&#93;=<?php echo $img; ?>&p&#91;title&#93;=<?php $title; ?>&p&#91;summary&#93;=<?php echo $desc; ?>', '<?php echo $window_title; ?>', 'menubar=no,toolbar=no,resizable=no,scrollbars=no, width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');"><span class="icon"><i class="fa-icon-facebook"></i><?php _e('Share', 'theme'); ?></span></a>
                <span class="count"><?php echo $facebook; ?></span>
            </div> <!--icon-->
	    <?php } ?>

	    <?php if (mom_option('post_share_twitter') != false) { ?>
            <div class="ss-icon twitter">
                <a href="#" onclick="window.open('http://twitter.com/share?text=<?php echo $title; ?>&url=<?php echo $url; ?>', '<?php _e('Post this On twitter', 'theme'); ?>', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');"><span class="icon"><i class="fa-icon-twitter"></i><?php _e('Tweet', 'theme'); ?></span></a>
                <span class="count"><?php echo $twitter; ?></span>
            </div> <!--icon-->
	    <?php } ?>

	    <?php if (mom_option('post_share_google') != false) { ?>
            <div class="ss-icon googleplus">
                <a href="https://plus.google.com/share?url=<?php echo $url;?>"
onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=<?php echo $window_height; ?>,width=<?php echo $window_width; ?>');return false"><span class="icon"><i class="fa-icon-google-plus"></i><?php _e('Share', 'theme'); ?></span></a>
                <span class="count"><?php echo $plusone; ?></span>
            </div> <!--icon-->
	    <?php } ?>
	<?php if ($min == false) { ?>
	    <?php if (mom_option('post_share_linkedin') != false) { ?>
	            <div class="ss-icon linkedin">
                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url;?>&title=<?php echo strip_tags($title); ?>&source=<?php echo urlencode(home_url());?>"
onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=<?php echo $window_height; ?>,width=<?php echo $window_width; ?>');return false;"><span class="icon"><i class="fa-icon-linkedin"></i><?php _e('Share', 'theme'); ?></span></a>
                <span class="count"><?php echo $linkedin; ?></span>
            </div> <!--icon-->
	    <?php } ?>
	    <?php if (mom_option('post_share_pin') != false) { ?>
            <div class="ss-icon pinterest">
                <a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $img;?>&amp;
url=<?php echo $url;?>&amp;
is_video=false&amp;description=<?php echo $title;?>"
onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=<?php echo $window_height; ?>,width=<?php echo $window_width; ?>');return false;"><span class="icon"><i class="fa-icon-pinterest"></i><?php _e('Share', 'theme'); ?></span></a>
                <span class="count"><?php echo $pinterest; ?></span>
            </div> <!--icon-->
	    <?php } ?>
	<?php } ?>
        </div> <!--social share-->
	<div class="clear"></div>

<?php } else { // horizontal here ?>
       <div class="mom-social-share ss-horizontal border-box">
	    <?php if (mom_option('post_share_facebook') != false) { ?>
            <div class="ss-icon facebook">
                <a href="#" onclick="window.open('http://www.facebook.com/sharer/sharer.php?m2w&s=100&p&#91;url&#93;=<?php echo $url; ?>&p&#91;images&#93;&#91;0&#93;=<?php echo $img; ?>&p&#91;title&#93;=<?php $title; ?>&p&#91;summary&#93;=<?php echo $desc; ?>', '<?php echo $window_title; ?>', 'menubar=no,toolbar=no,resizable=no,scrollbars=no, width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');"><span class="icon"><i class="fa-icon-facebook"></i><?php _e('Share', 'theme'); ?></span></a>
                <span class="count"><?php echo $facebook; ?></span>
            </div> <!--icon-->
	    <?php } ?>

	    <?php if (mom_option('post_share_twitter') != false) { ?>
            <div class="ss-icon twitter">
                <a href="#" onclick="window.open('http://twitter.com/share?text=<?php echo $title; ?>&url=<?php echo $url; ?>', '<?php _e('Post this On twitter', 'theme'); ?>', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,width=<?php echo $window_width; ?>,height=<?php echo $window_height; ?>');"><span class="icon"><i class="fa-icon-twitter"></i><?php _e('Tweet', 'theme'); ?></span></a>
                <span class="count"><?php echo $twitter; ?></span>
            </div> <!--icon-->
	    <?php } ?>

	    <?php if (mom_option('post_share_google') != false) { ?>
            <div class="ss-icon googleplus">
                <a href="#"
onclick="window.open('https://plus.google.com/share?url=<?php echo $url;?>', '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=<?php echo $window_height; ?>,width=<?php echo $window_width; ?>');return false"><span class="icon"><i class="fa-icon-google-plus"></i><?php _e('Share', 'theme'); ?></span></a>
                <span class="count"><?php echo $plusone; ?></span>
            </div> <!--icon-->
	    <?php } ?>
	<?php if ($min == false) { ?>
	    <?php if (mom_option('post_share_linkedin') != false) { ?>
	            <div class="ss-icon linkedin">
                <a href="#"
onclick="javascript:window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url;?>&title=<?php echo strip_tags($title); ?>&source=<?php echo urlencode(home_url());?>', '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=<?php echo $window_height; ?>,width=<?php echo $window_width; ?>');return false;"><span class="icon"><i class="fa-icon-linkedin"></i><?php _e('Share', 'theme'); ?></span></a>
                <span class="count"><?php echo $linkedin; ?></span>
            </div> <!--icon-->
	    <?php } ?>
	    <?php if (mom_option('post_share_pin') != false) { ?>
            <div class="ss-icon pinterest">
                <a href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $img;?>&amp;
url=<?php echo $url;?>&amp;
is_video=false&amp;description=<?php echo $title;?>"
onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=<?php echo $window_height; ?>,width=<?php echo $window_width; ?>');return false;"><span class="icon"><i class="fa-icon-pinterest"></i><?php _e('Share', 'theme'); ?></span></a>
                <span class="count"><?php echo $pinterest; ?></span>
            </div> <!--icon-->
	    <?php } ?>
	<?php } ?>
	    <div class="clear"></div>
        </div> <!--social share-->

<?php

}
}
function mom_get_plusones($url)  {
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
$curl_results = curl_exec ($curl);
curl_close ($curl);
$json = json_decode($curl_results, true);
return isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
}

/*
function mom_getGoogleCount($url) {
    $googleURL = wp_remote_get('https://plusone.google.com/_/+1/fastbutton?url=' .  $url );
    if (!is_wp_error($googleURL)) {
    preg_match('/window\.__SSR = {c: ([\d]+)/', $googleURL['body'], $results);
    if( isset($results[0]))
        return (int) str_replace('window.__SSR = {c: ', '', $results[0]);
    return "0";
    } else {
	return '0';
    }
}
*/