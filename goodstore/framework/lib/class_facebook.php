<?php

/**
 * Class for printing fecbook commnents
 * 
 * @authors Alexmoss, Pleer 
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwFacebook')) {
class jwFacebook {

    public static $options;

    public static function get_fb_comment() {

	self::$options['language'] = jwOpt::get_option('social_comments_language', "en_GB");
	self::$options['num'] = jwOpt::get_option('fbcomments_nuberofcomments');
	self::$options['fbcomments_commsg'] = __('comments','jawtemplates');
	self::$options['fbcomments_title'] = __('Comments', 'jawtemplates');
	self::$options['fbcomments_appid'] = jwOpt::get_option('fbcomments_appid');

	
	add_action('wp_footer', array('jwFacebook', 'fbmlsetup'));


        echo self::fbcommentbox();


    }

    public static function fbcommentbox() {

	$content = '';
	if (is_single() || is_page() || (is_home() || is_front_page())) {

              
            global $content_width;
	    $commentcount = "<p>";

	    $commentcount .= "<fb:comments-count href=" . get_permalink() . "></fb:comments-count> " . self::$options['fbcomments_commsg'] . "</p>";

	    $commenttitle = "<h3>";

	    $commenttitle .= self::$options['fbcomments_title'] . "</h3>";

	    $content .= $commenttitle . $commentcount;

  
	    $content .= "<div class=\"fb-comments\" data-href=\"" . get_permalink() . "\" data-num-posts=\"" . self::$options['num'] . "\" data-width=\"".$content_width."\" ></div>";
	}
	return $content;
    }

    public static function fbcommentshortcode() {
	$fbcommentbox = '';
	$commentcount = "<p>";

	$commentcount .= "<fb:comments-count href=" . get_permalink() . "></fb:comments-count> " . self::$options['fbcomments_commsg'] . "</p>";

	$commenttitle = "<h3 class=\"" . self::$options['fbcomments_title'] . "\">";

	$commenttitle .= self::$options['fbcomments_title'] . "</h3>";

	$fbcommentbox .= "<div class=\"fb-comments\" data-href=\"" . get_permalink() . "\" data-num-posts=\"" . self::$options['num'] . "\" data-width=\"500\" data-show-faces=\"false\" ></div>";

	return $fbcommentbox;
    }

    public static function fbmlsetup() {
	?>
	<!-- Facebook Comments for WordPress -->

	<div id="fb-root"></div>

	<script>
	    window.fbAsyncInit = function() {
		FB.init({appId: '<?php echo(self::$options['fbcomments_appid']); ?>', status: true, cookie: true,
		    xfbml: true});
	    };

	    (function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id))
		    return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/<?php echo self::$options['language'] ?>/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	    }(document, 'script', 'facebook-jssdk'));
	</script>
	<?php
    }

    
    //COUNTER OF FB COMMENT for popular
   public static function get_fb_comments_count($id){
       
       preg_match('@(http://)(.*)@',get_permalink( $id ), $permalink);
      
       
       $reponse = wp_remote_retrieve_body(wp_remote_request('https://graph.facebook.com/comments/?ids=http%3A%2F%2F'.$permalink[2], array('method' => 'GET')));
        if ($reponse instanceof WP_Error)
            return null;

        $data = json_decode($reponse);

        if ($data === null)
            return null;
        
        $number_of_comments = sizeof($data->$permalink[0]->comments->data);
        
        if ($number_of_comments == 0){
            return null;
        }
        
        return ($number_of_comments);
     
       
   }
}
}

