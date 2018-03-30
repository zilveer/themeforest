<?php
/**
 * Feast custom functions
 *
 *
 */

 
 
 
class Encryption {
	var $skey 	= "YwP7VpocqfZ3iw"; // you can change it
 
    public  function safe_b64encode($string) {
 
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
 
    public  function encode($value){ 
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
 
    public function decode($value){
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
}
 

 
 
function lets_get_dwnl($Ifile) {
	
	$output = get_template_directory_uri() . '/download.php?';
	
	$template_dir = TEMPLATEPATH; 
								
	$upload_dir = wp_upload_dir();
													
	$upload_substr =substr($upload_dir['basedir'],strpos($upload_dir['basedir'],'wp-content', (strlen($upload_dir['basedir'])-strpos($upload_dir['basedir'],'wp-content'))));
								
	$template_substr =substr($template_dir,strpos($template_dir,'wp-content', (strlen($template_dir)-strpos($template_dir,'wp-content'))));
								
	$explod = explode('/', $template_substr);
								
	$e_count = count($explod) - 1;
	
	$code = new Encryption;
	
	$ecode = $code->encode($Ifile);
	
	$output .= 'type=' . $ecode . '&amp;option=' . $e_count;
	
	return $output;
	
	
}
 	
 
/******************************************************************
 * add additional attachement fields
 ******************************************************************/

 
 
function lets_get_mp3file($ID, $Ifield) {
	$upload_dir = wp_upload_dir();
	
	$val = get_post_meta($ID, '_' .$Ifield, true);
	
	$output = '<select class="' . $val . '" name="attachments[' .  $ID  .  '][' .  $Ifield  .']" id="attachments[' .  $ID  .  '][' .  $Ifield  .']">';
		
	if ($val == 0 ) {$isselect = 'selected="selected"';} else {$isselect = '';}	
	$output .= '<option value="0" ' .  $isselect . '>No Link</option>';
	
	$dir = $upload_dir[basedir] . '/audio';
	
	if (is_dir($dir)) {
	
	if ($handle = opendir($dir)) {		
		while (false !== ($entry = readdir($handle))) {
			$extension = substr(strrchr($entry, "."), 1);					
			if ($entry != '..' && $entry != '.'){
				if ($extension == 'mp3') {
					if ($val == $entry) {$isselect = 'selected="selected"';} else {$isselect = '';}	
					$output .= '<option value="' .  $entry . '" ' .  $isselect . '>' . $entry  . '</option>';	
				}		
			}		
		}				
	}
	
	}
	$output .= '</select>';	
	return $output;		
}

function lets_get_lyrlist($ID, $Ifield){
	$val = get_post_meta($ID, '_' .$Ifield, true);
	$output = '<select name="attachments[' .  $ID  .  '][' .  $Ifield  .']" id="attachments[' .  $ID  .  '][' .  $Ifield  .']">';
	
	if ($val == 0 || !$val) {$isselect = 'selected="selected"';} else {$isselect = '';}	
	
	$output .= '<option value="0" ' .  $isselect . '>' .  __('No Lyrics', 'localize') . '</option>';
	
	$tolinkto = array('lyrics');
	foreach ($tolinkto as $linksopt) {
		$args = array( 'numberposts' => 10000, 'post_type'=> $linksopt );
		$myposts = get_posts( $args );
		foreach( $myposts as $post ) :	setup_postdata($post); 
			if ($val == $post->ID) {$isselect = 'selected="selected"';} else {$isselect = '';}
			$output .= '<option value="'  .  $post->ID  .   '" ' .  $isselect . '>'  .  $post->post_title   . '</option>';
		endforeach;
	}
	
	
	$output .= '</select>';
	
	return $output;
	
	
}
 
 
function nets_attachment_edit($form_fields, $post) {
	
	if( substr($post->post_mime_type, 0, 5) == 'audio' ){  
	
		$form_fields["nets_musname"] = array(
			"label" => __("Artist Name", 'localize'),
			"input" => "text", // this is default if "input" is omitted
			"value" => get_post_meta($post->ID, "_nets_musname", true),
			"helps" => __('Artist name if different from The main artist.', 'localize')
		);
	
		$form_fields["nets_muslink"] = array(
			"label" => __("Link to buy", 'localize'),
			"input" => "text", // this is default if "input" is omitted
			"value" => get_post_meta($post->ID, "_nets_muslink", true),
			"helps" => __('Add a link to buy this track.', 'localize')
		);
	
		$form_fields["nets_musdownl"] = array(
			"label" => __("Link to download", 'localize'),
			"input" => "html",
			"html"  => lets_get_mp3file($post->ID, "nets_musdownl"),  
			"helps" => __('Add a link to the track download.', 'localize')
		);
	
		$form_fields["nets_lyrlist"] = array(
			"label" => __("Link to lyrics", 'localize'),
			"input" => "html", // this is default if "input" is omitted
			"html"  => lets_get_lyrlist($post->ID, "nets_lyrlist"),  
			"helps" => __('Add a link to the lyrics for this music.', 'localize')
		);
	
		$form_fields["nets_altlink"] = array(
			"label" => __("Alternative link", 'localize'),
			"input" => "html",
			"html"  => lets_get_mp3file($post->ID, "nets_altlink"),  
			"helps" => __('Upload mp3 via ftp and paste the link here. See helpfile for details', 'localize')
		);
	
	}

	return $form_fields;
}

add_filter("attachment_fields_to_edit", "nets_attachment_edit", null, 2);




function ntl_attachment_save($post, $attachment) {
	
	
	$updatables = array("nets_musname", "nets_muslink", "nets_musdownl", "nets_lyrlist", "nets_altlink" );
	
	foreach ($updatables as $updatetag) {
	
		if (isset($attachment[$updatetag])) {
	
			if (empty($attachment[$updatetag])) {
	    		delete_post_meta($post['ID'], '_' . $updatetag);
			} else {
				update_post_meta($post['ID'], '_' . $updatetag , $attachment[$updatetag]);
			}
		}
	
	}

	return $post;
}

add_filter('attachment_fields_to_save', 'ntl_attachment_save', 10, 2);



/******************************************************************
 * custom background functions
 ******************************************************************/


/**
 * ver 1.0
 * Test for a large background image and insert it for the jquery function that will stretch it.
 **********************************/
function cp_get_bgimg() {
	
	$image = '';	
	$thememod = get_theme_mod('background_repeat');
	$image = get_background_image();
	$output = '';
	if ($thememod == 'no-repeat' && $image) {
	$output = '<img src="' . $image .'" id="bgimg" class="bgwidth" >';
	}
	return $output;
} // cp_get_bgimg



/**
 * ver 1.0
 * Adds our own custom functionality ot the background callbacks
 **********************************/
function cp_cust_bg_callback() {
	
	$image = '';
	$image = get_background_image();	
	$thememod = get_theme_mod('background_repeat');

	// if there is an image and it is not set to "no-repeat" generate the custom callback.
	if ( !empty( $image ) && $thememod != 'no-repeat' ) {
		_custom_background_cb();
		return;
	}

	$color = get_background_color();


	if ( empty( $color ) )
		return;

		
	// Add the color setting for the background.

	$style = "background: #{$color};";

?>
<style type="text/css">body { <?php echo trim( $style ); ?> }</style>
<?php

} // cp_cust_bg_callback



/******************************************************************
 * carousel function
 ******************************************************************/

function lets_make_carousel(){
	
		$settings = get_option( "ntl_theme_settings" );
		
		$output = '';
		
		if ($settings['ntl_show_carousel'] != 'off') {
		$output .= '<div class="container clear carouter">';
		$linkposts = get_posts('numberposts=10000&post_type=albums');
		
		$ttt =  count($linkposts);
		
		if ($ttt >= 5) {
			$output .= '<div class="carousel">';
		} else {
			$output .= '<div class="carousels">';
		}

		$output .= '<ul class="clear">';
		foreach($linkposts as $linkentry) :
		$output .= '<li>' . get_the_post_thumbnail($linkentry->ID, 'albmlink') . '<a href="' . get_permalink($linkentry->ID) .  '" class="imgoverlink">
					<span class="imgblockover imgoverlink3" >&nbsp;</span></a></li>';
		endforeach;	
		$output .= '</ul></div>';
		if ($ttt >= 5) {
		$output .= '<a class="ntlcc_prev">previous</a>
					<a class="ntlcc_next">next</a>';
		}
		$output .= '</div>';
		
		} else {
			$output .= '<div class="altfooter container" style="height: 20px;"></div>';
		}
		echo $output;
}


/******************************************************************
 * custom page titles
 ******************************************************************/


add_filter('wp_title', 'adminace_title' , 10, 2);

function adminace_title( $the_title, $sep = '', $sep_location = '', $postid = '' ){
global $post, $wp_query;

//if we are on a single post or page show the title and page name
if ( is_singular() ) {
   $the_title =  $post->post_title.' - '.get_bloginfo('name');
 
//if we are on a category, taxonomy page or tag show the term name blog name and description
} else if ( is_category() || is_tag() || is_tax()) {

  $term = $wp_query->get_queried_object();
  $the_title = ucfirst($term->name) . ' - ' . get_bloginfo('name') .' - '.get_bloginfo('description');
 
//if we are on the frontpage or index page show the site name and description
   } elseif  ( is_home() || is_front_page() ) {
  $the_title = get_bloginfo('name').' - '.get_bloginfo('description');

  
//if we are on a search page show a search message and sitename;
   } elseif ( is_search() ) { 
    $the_title = __('Search results for', 'localize') . ' ' .  get_search_query() . ' - ' . $blog_name;

	
//if we are on a page not found show a message and sitename;
   } elseif ( is_404() ) {
  $the_title = __('Not Found', 'localize') . ' '.get_bloginfo('name'); 
   } else { 

   
//none of the above show the page title and the sitename
   $the_title =  get_bloginfo('name') .' - '.get_bloginfo('description');
}
return esc_html( stripslashes( trim( $the_title ) ) );
}


/******************************************************************
 *
 * social function
 *
 ******************************************************************/
 
function netstudio_get_social() {
 
global $post;
$settings = get_option( "ntl_theme_settings" );
$netstudio_social_permlink = get_permalink($post->ID);
$netstudio_social_enclink = urlencode($netstudio_social_permlink);
$netstudio_social_title = urlencode(get_the_title($post->ID) );
$socontent = '<div class="netstudiosoc">';



if ($settings['ntl_googleplus_post'] == 'on') {
$socontent .= '
	<div class="google-plus-one-button">
      <g:plusone size="medium" href="' . $netstudio_social_permlink  . '"></g:plusone>
      <script type="text/javascript">
  			(function() {
    		var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
    		po.src = "https://apis.google.com/js/plusone.js";
    		var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
  			})();
	  </script>
    </div>';
}

if ($settings['ntl_twitter_post'] == 'on') {
	
	
$socontent .= '<div class="twitter-tweet-button">

	<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

	</div>
	';
 
}

if ($settings['ntl_facebook_post'] == 'on') {
$socontent .= '
	<div class="facebook-like-button">
	<div class="fb-like" data-href="' . $netstudio_social_permlink  . '" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-action="recommend" data-font="arial"></div>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
 	 var js, fjs = d.getElementsByTagName(s)[0];
  	if (d.getElementById(id)) return;
  	js = d.createElement(s); js.id = id;
  	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=230692803654688";
  	fjs.parentNode.insertBefore(js, fjs);
	}(document, "script", "facebook-jssdk"));
	</script>
	</div>
	';
	
}

$socontent .= '<span class="clear"></span>';
			
if ($settings['ntl_stumbleupon_post'] == 'on') {
$socontent .= '<a rel="nofollow"  target="_blank"  href="http://www.stumbleupon.com/submit?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/styles/social/stumbleupon.png"></a>';
}
			
if ($settings['ntl_rss_post'] == 'on') {
$socontent .= '<a rel="nofollow"  target="_blank"  href="'.get_settings('home').'/?feed=rss2"><img src="' . get_template_directory_uri() . '/styles/social/rss.png"></a>';
}

if ($settings['ntl_digg_post'] == 'on') {
$socontent .= '<a rel="nofollow"  target="_blank"  href="http://digg.com/submit?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/styles/social/digg.png"></a>';
}
			
if ($settings['ntl_delicious_post'] == 'on') {
$socontent .= '<a rel="nofollow"  target="_blank"  href="http://del.icio.us/post?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/styles/social/delicious.png"></a>';
}
			

if ($settings['ntl_linkedin_post'] == 'on') {
$socontent .= '<a rel="nofollow"  target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$netstudio_social_enclink.'&amp;title='.$netstudio_social_title.'" class="sociable-hovers" /><img src="' . get_template_directory_uri() . '/styles/social/linkedin.png"></a></li>';
}

if ($settings['ntl_reddit_post'] == 'on') {
$socontent .= '
		<a href="http://www.reddit.com/submit" onclick="window.location = "http://www.reddit.com/submit?url='.$netstudio_social_enclink.'"> <img src="' . get_template_directory_uri() . '/styles/social/reddit.png"></a>';
}	
 	
 
echo $socontent . '</div>';
 
}

 
/******************************************************************
 *
 * wp-ajax functions (newsletter & message center)
 *
 ******************************************************************/

add_action('wp_ajax_netlabs_get_ajaxdata', 'netlabs_ajax_callback');
add_action('wp_ajax_nopriv_netlabs_get_ajaxdata', 'netlabs_ajax_callback');


function netlabs_ajax_callback() {
global $wpdb, $wp_locale;

	if(isset($_POST['type'])){$action_identifier = $_POST['type'];}
	if(isset($_POST['mail'])){$signup_email = $_POST['mail'];}
	if(isset($_POST['name'])){$signup_name = $_POST['name'];}
	if(isset($_POST['location'])){$location = $_POST['location'];}
	if(isset($_POST['mstring'])){$mstring = $_POST['mstring'];}	
	if(isset($_POST['senddata'])){$thedata = $_POST['senddata'];}
	if(isset($_POST['bookdates'])){$bookingdate = $_POST['bookdates'];}
	if(isset($_POST['bookhours'])){$bookinghour = $_POST['bookhours'];}
	if(isset($_POST['booknums'])){$bookingnumber = $_POST['booknums'];}
	if(isset($_POST['booknames'])){$bookingname = $_POST['booknames'];}
	if(isset($_POST['booktels'])){$bookingtel = $_POST['booktels'];}
	if(isset($_POST['bookmails'])){$bookingmail = $_POST['bookmails'];}
	if(isset($_POST['bookinfos'])){$bookinginfo = $_POST['bookinfos'];}
	if(isset($_POST['bookloc'])){$bookingloc = $_POST['bookloc'];}
	if(isset($_POST['gallery'])){$gallery = $_POST['gallery'];}
	if(isset($_POST['datedata'])){$datedata = $_POST['datedata'];}
	if(isset($_POST['startdata'])){$startdata = $_POST['startdata'];}
	if(isset($_POST['startid'])){$startid = $_POST['startid'];}
	
	
	$output = '';
	
	
	if($action_identifier == 'get_photogal'){
		$gall_id 		= get_post($gallery);
		$gall_content 	= $gall_id->post_content;
		$output 		= get_gallery_data($gallery, $gall_content);
	}

	
	
	if($action_identifier == 'get_newssignup'){
		if (!is_email($signup_email)) {
		$output .= 'mailerr';
		} 
		if (!$signup_email) {
		$output .= 'nameerr';
		}
		if ($location) {
		$output .= 'boterr';
		}
		if (!$output) {
		$output .= 'success';
		lets_make_bookingemail($signup_email, '' , $signup_name , '',  'newssignup_customer' , 'yes');
		}
	}
	
		
	
	if($action_identifier == 'get_reminder'){
		$tnow = time();
		$datedff = $startdata - $tnow;
		$datedff = round($datedff / 86400);
		$tcounter = 1;
		$output .= '
			<form id="nets_freminder" name="nets_freminder">
			<div class="valmess"></div>
			<p class="smallfont">' . __('Set a reminder for this show', 'localize') . '</p>
			<p class="frinput"><label>' . __('Name', 'localize') . '</label><br/>
				<input type="text" id="nets_frname" name="nets_frname" size="40" />
			</p>
			<p class="frinput2"><label>' . __('Email', 'localize') . '</label><br/>
				<input type="text" id="nets_frmail" name="nets_frmail" size="28" />
			</p>
			<p class="frinput3"><label>' . __('Timespan', 'localize') . '</label><br/>
				<select type="text" id="nets_frwhen" name="nets_frwhen">
				<option value="0">' . __('Remind me ....', 'localize') . '</option>';
		
		while ($tcounter <= ($datedff - 1) && $tcounter <= 7) {
			if ($tcounter <= 1) {
				$output .= '<option value="' . $tcounter  .  '">' . $tcounter  .  ' ' . __('day before ', 'localize') . '</option>';
			} else {
				$output .= '<option value="' . $tcounter  .  '">' . $tcounter  .  ' ' . __('days before ', 'localize') . '</option>';
			}
			$tcounter++;
		}
		$output .= '					
				</select>
			</p>
			<p class="frinput4">
				<input type="hidden" name="nets_frtime" id="nets_frtime" value="' . $startdata . '" />
				<input type="hidden" name="nets_frid"  id="nets_frid" value="' . $startid . '" />
				<input type="submit" name="nets_frsubmit" class="nets_frsubmit smallfont" id="nets_frsubmit" value="' . __('Submit', 'localize') . '" />
			</p>
			<div class="clear"></div>
			</form>';

	}

	if($action_identifier == 'set_reminder'){
		if (!is_email($signup_email)) {
		$output .= 'mailerr';
		} elseif ($datedata == 0) {
			$output .= 'dateerr';
		} else {
			lets_make_booking($datedata, $startdata, $startid, $signup_name, $signup_email);
		}

	}
	
	if($action_identifier == 'get_cal'){
		$monthdata = explode('/', $thedata);
		$month = $monthdata[0];
		$year = $monthdata[1];
		$content = '<div id="post" class="page">';
		$content .= '<div class="calmonth clear darkbox">';
		$content .= prevlink($month , $year);
		$content .= '</div>';
		$content .= '</div><div class="calentries">';
		$content .= get_the_calendar($month,$year) . '</div>';	
		$output = $content; 

	}
	
	if($action_identifier == 'tweets'){
		if (!class_exists('Codebird')) {
			require ('twitterlib/codebird.php');
		}

		$settings 				= get_option( "ntl_theme_settings" );
		
		$accountname 			= $settings['ntl_twitter_name'];
		$consumer_key 			= $settings['ntl_twitter_conskey'];
		$consumer_secret 		= $settings['ntl_twitter_consecret'];
		$access_token 			= $settings['ntl_twitter_acctoken'];
		$access_token_secret 	= $settings['ntl_twitter_accsecret'];	

		$accountname = trim( urlencode( $accountname ) );
		
		$params = array(
			'screen_name'			=> $username, 
			'trim_user'				=> true, 
			'count'					=> 10,
			'consumer_key' 			=> $consumer_key ,
			'consumer_secret' 		=> $consumer_secret,
				'access_token' 		=> $access_token,
			'access_token_secret' 	=> $access_token_secret
		);
	
		Codebird::setConsumerKey($params['consumer_key'], $params['consumer_secret']); 
		$cb = Codebird::getInstance();
		$cb->setToken($params['access_token'], $params['access_token_secret']);		
		$cb->setReturnFormat(CODEBIRD_RETURNFORMAT_ARRAY);


		try {
			$twitter_data =  $cb->statuses_userTimeline(array(
				'screen_name'=>$params['screen_name'], 
				'count'=>10
			));
		} catch (Exception $e) { return __('Error retrieving tweets','localize'); }


		if (isset($twitter_data['errors'])) {
			$cb->debug($options, __('Twitter data error:','localize').' '.$twitter_data['errors'][0]['message'].'<br />');
		}

		if (!isset($twitter_data['errors'])) {
			update_option( 'nets_tweetsave', $twitter_data );
		}


	}	
	echo $output;
	exit;
}






/* 
* -03- FETCH GALLERY DATA
 * 
 * */

function get_gallery_data($id, $content){

	$imgarr 		= '';
	$scrp 			= '';
	$regex_pattern 	= get_shortcode_regex();
	preg_match ('/'.$regex_pattern.'/s', $content, $regex_matches);


	if (isset($regex_matches[2]) && $regex_matches[2] == 'gallery' && isset($regex_matches[3]) && $regex_matches[3]) {
		$result = str_replace('ids="', '', $regex_matches[3]);
		$result = str_replace('"', '', $result);
		$imgarr = explode(',', $result);

		$scrp = '';
		foreach ( $imgarr as $cro_v ) {
			$tid = wp_get_attachment_image( $cro_v, 'thumbnail');
            $fid = wp_get_attachment_image_src( $cro_v, 'full');
            $scrp .=  '<div class="gallerysmallframe" rel="' .  $fid[0]   . '" title="' . get_the_title($cro_v)  . '">' .  $tid  . '</div>'; 
		}

	} else {
		
    	$images = get_children( array( 'post_parent' => $id , 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
        foreach ( $images as $attachment_id => $attachment ) {
            $tid = wp_get_attachment_image( $attachment_id, 'thumbnail');
            $fid = wp_get_attachment_image_src( $attachment_id, 'full');        
            $scrp .=  '<div class="gallerysmallframe" rel="' .  $fid[0]   . '" title="' . get_the_title($cro_v)  . '">' .  $tid  . '</div>'; 

        }
	}
	return $scrp;
}



add_action('wp_head', 'netlabs_jquery_header');


function netlabs_jquery_header() {
	
	$settings = get_option( "ntl_theme_settings" );
	
	$thevfont = str_replace(' ','+', $settings['ntl_font_primary']);
	$thesfont = str_replace(' ','+', $settings['ntl_font_secondary']);	
	$familycode = $settings['ntl_font_primary'];
	$familycode2 = $settings['ntl_font_secondary']; 
	
	?>
	<link href="http://fonts.googleapis.com/css?family=<?php echo $thevfont; ?>&v2" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=<?php echo $thesfont; ?>&v2" rel="stylesheet" type="text/css">

	<style>
		.vfont, .lasthead, blockquote, #reply-title, #comments-title,li.dir-label, span.cdayname 
		{ font-family: '<?php echo $familycode; ?>', arial, serif; font-weight: bold; }
		
 		#access a, #access ul ul a, .jqminner p, span.songname, span.songartist, .widget_netlabs_fpnews_widget h4, .smallfont, #respond input#submit, .artname, .trackname,
 		.lightblock1, .menu-footer a, .announce, .dateslip, a.prevlink, a.nxtlink, a.more-link, .nets_bookingformsub, ul.UL-MI_mp3j li
 		{font-family: '<?php echo $familycode2; ?>', sans-serif;font-weight: bold;}
 		
		#access li.current_page_item a, #access a:hover, .widget_netlabs_fpnews_widget a.more-link, span.cdayname, .loadalbm h1, .page-title h1, .taglinein h1, 
		.latestnews_widget h6 a, .gotocal a:hover, .fbs p a, a, span.counter,
		.taglinein h2, .taglinein h3, .taglinein h4, .taglinein h5, .taglinein h6, .taglinein a, div.jp-play-time, h3.excpts, a.more-link, h3.widget-title
		{color: <?php echo $settings['ntl_theme_color']; ?>;}	 
		
		.ctime, form#newslettersignup input.newssubmit, #respond input#submit, .pagination span, .pagination a, input#driveclick, form#nets_freminder input[type="submit"], .btitle
		 {background: <?php echo $settings['ntl_theme_color']; ?>;} 
		 
		 ul.showslide li a{
		 	background-color: <?php echo $settings['ntl_theme_color']; ?>;
		 }
		 
		span.loadB_mp3j, span.load_mp3j { background:<?php echo $settings['ntl_theme_color']; ?>; opacity:0.7; filter:alpha(opacity=70); } 
	
	</style>
	
	<!--[if IE 7.0]>
	<style>
		.timeshow .timernames{height: 14px; line-height: 14px;}
		.coverinner{margin-top: -76px;}
		.fbcover {height: 158px;margin-bottom: 20px;}
		span.cbuttons a{height: 21px; line-height: 21px;}
	</style>
 	<![endif]-->


	<script type="text/javascript">
	jQuery(document).ready(function($) {
		var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
		$('.reset').val('');
		<?php if ($settings['ntl_twitter_name']) {?>
		var data = { action: 'netlabs_get_ajaxdata', type: 'tweets'};
		$.post(ajax_url, data);
		<?php } ?>
		$('input.newssubmit').click(function(event) {
			event.preventDefault();
			$('.imgloader').show();
			$('#valmess').removeClass('newslError').removeClass('newslSuccess').html('');
			var newslname = $('.netlabs_newsname').val();
			var newslmail = $('.netlabs_newsmail').val();
			var newslloc = $('.netlabs_newsloc').val();
			if (!newslname || !newslmail) {
				$('#valmess').addClass('newslError').html('<?php _e( 'Please fill all the fields', 'localize' ); ?>');
				$('.imgloader').hide();
				return;		
			} else {
				var data = { action: 'netlabs_get_ajaxdata', type: 'get_newssignup', mail: newslmail, name: newslname, location: newslloc};
				$.post(ajax_url, data, function(response) {	
					$('.imgloader').hide();
					if (response == 'mailerr') {
						$('#valmess').addClass('newslError').html('<?php _e( 'Invalid email supplied', 'localize' ); ?>');
					}
					if (response == 'nameerr') {
						$('#valmess').addClass('newslError').html('<?php _e( 'No name supplied', 'localize' ); ?>');
					}
					if (response == 'boterr') {
						$('#valmess').addClass('newslError').html('<?php _e( 'Please leave the location field open. It is only there to fight spam', 'localize' ); ?>');
					} else {
						$('#valmess').addClass('newslSuccess').html('<?php _e( 'Thank you for submitting. Your first newsletter will arrive shortly.', 'localize' ); ?>');
						$('form#newslettersignup').fadeOut(2000);
					}
				});					
			}
		});
		
		
		$('a.creminds').live('click', function() {
			$('.imgloader').show();
			$('span.cremind').each(function() {
				$(this).html('').fadeOut('slow');
			});
			var thisspan = $(this).closest('.calsingleentry').find('span.cremind');
			var thisdata = $(this).attr('rel');
			var thisid = $(this).attr('title');
			var data = { action: 'netlabs_get_ajaxdata', type: 'get_reminder', startdata: thisdata, startid: thisid};
			$.post(ajax_url, data, function(response) {	
				$('.imgloader').hide();
				$(thisspan).html(response);
				$(thisspan).fadeIn('slow').css('display','block');
				$('.nets_frsubmit').unbind('click').bind('click', handleSubmit);
				return false;
			});
			return false;
		});
			
		
		function handleSubmit() {
			$('.valmess').html('').removeClass('newslSuccess').removeClass('newslError');
			$('.imgloader').show();
			var aval = $('#nets_frname').val();
			var bval = $('#nets_frmail').val();
			var cval = $('#nets_frwhen').val();
			var dval = $('#nets_frid').val();
			var eval = $('#nets_frtime').val();
			if (!aval || !bval) {
				$('.valmess').html('<?php _e( 'Please enter a name and email address', 'localize' ); ?>').addClass('newslError');
				$('.imgloader').hide();
				return false;
			} else {
				var data = { action: 'netlabs_get_ajaxdata', type: 'set_reminder', mail: bval, name: aval, datedata: cval, startdata: eval, startid: dval};
				$.post(ajax_url, data, function(response) {	
					if (response == 'mailerr') {
						$('.valmess').html('<?php _e( 'Invalid email supplied', 'localize' ); ?>').addClass('newslError');
					} else if(response == 'dateerr') {
						$('.valmess').html('<?php _e( 'Please select a timespan to be reminded', 'localize' ); ?>').addClass('newslError');
					} else {
						$('.valmess').html('<?php _e( 'Thank you for submitting, We will send your reminder', 'localize' ); ?>').addClass('newslSuccess');
					}
					$('.imgloader').hide();
					return false;
				});
			}
			return false;
		};
		
	});
	</script>	
<?php
}


/******************************************************************
 *
 * paging function
 *
 ******************************************************************/



if ( ! function_exists( 'adminace_paging' ) ) {

	function adminace_paging( $args = array(), $query = '' ) {
		global $wp_rewrite, $wp_query;
		
		do_action( 'nets_pagination_start' );
				
		if ( $query ) {$wp_query = $query;} 
	
		if ( 1 >= $wp_query->max_num_pages ) return;
	
		$current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
	
		$max_num_pages = intval( $wp_query->max_num_pages );
	
		$defaults = array(
			'base' => add_query_arg( 'paged', '%#%' ),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $current,
			'prev_next' => true,
			'prev_text' => __( '&laquo;', 'localize' ), 
			'next_text' => __( '&raquo;', 'localize' ), 
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 1,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="pagination">', 
			'after' => '</div>',
			'echo' => true,
		);
	
		if( $wp_rewrite->using_permalinks() )
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );
	
		if ( is_search() ) {
			if ( class_exists( 'BP_Core_User' ) ) {
				
				$search_query = get_query_var( 's' );
				$paged = get_query_var( 'paged' );				
				$base = user_trailingslashit( home_url() ) . '?s=' . $search_query . '&paged=%#%';
				
				$defaults['base'] = $base;
			} else {
				$search_permastruct = $wp_rewrite->get_search_permastruct();
				if ( !empty( $search_permastruct ) )
					$defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
			}
		}
	
		$args = wp_parse_args( $args, $defaults );
	
		if ( 'array' == $args['type'] )
			$args['type'] = 'plain';
	
		$page_links = paginate_links( $args );	
		$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );	
		$page_links = $args['before'] . $page_links . $args['after'];		
		do_action( 'nets_pagination_end' );
		
		if ( $args['echo'] )
			echo $page_links;
		else
			return $page_links;
			
	} 

} 


/**
 * ************************************************************
 * Inputbox function
 **************************************************************/

function randomizer() {
    $length = 5;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = "";    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}



/******************************************************************
 * music player
 ******************************************************************/

function lets_get_musicplayer() {
	
 $ntl_mplay = '';
		
 $settings = get_option( "ntl_theme_settings" );

 $playcol = $settings['ntl_theme_bg'];
 
 if ($_COOKIE['ntl_playalbum']){
 	$nl_mplay = $_COOKIE['ntl_playalbum'];
	$testforalbum = get_the_title($nl_mplay);
	if ($testforalbum){
		$nl_mplay = $_COOKIE['ntl_playalbum'];
	} else {
		$nl_mplay = $settings['ntl_default_album'];
	}
 } else {
 	$nl_mplay = $settings['ntl_default_album'];
 }
 
 if ($settings['ntl_auto_play'] == 'off'){
 	$tautoplay = 'false';
 } else {
 	$tautoplay = 'true';
 }

 $timg = get_the_post_thumbnail( $nl_mplay, 'albmlink');

	
 if ($settings['ntl_disable_audio'] != 'off'){	
	
 
 $arrargs = array(
	'post_mime_type' => 'audio/mpeg',
	'orderby' => 'menu_order',
	'order'=> 'desc',
	'post_parent' => $nl_mplay,
	'post_type' => 'attachment'
	);
	
					
 $arrImages =get_children($arrargs);
 $arrCount = count($arrImages);
 $songart = get_post_meta($nl_mplay, 'netlabs_artname', true);
 if ($arrCount >= 1){
 	
	$output =  '
    <div style="position:relative;"><div id="cromaplay" class="croma-jplayer"></div></div>
 	<script type="text/javascript">
	var CromaMultiplay = [
 	';
	
	$countr = 1;
	foreach ( $arrImages as $attachment ) {
		$songarts = '';
		$songarts = get_post_meta($attachment->ID, '_nets_musname', true);
		$songlink = get_post_meta($attachment->ID, '_nets_altlink', true);
		$upload_dir = wp_upload_dir(); 
		$a_link = '';
		
		if ($songlink && $songlink != 'No Link') {
			$a_link = $upload_dir[baseurl] . '/audio/' . $songlink;
		} else {
			$a_link = wp_get_attachment_url( $attachment->ID );
		}
		
		$image_attributes = wp_get_attachment_url( $attachment->ID );
		if ($countr == 1) {
			$output .= '{';
		} else {
			$output .= ',{';
		}
		
		$ptitle = htmlspecialchars($attachment->post_title);
		$ptitle = str_replace("'","&#039;",$ptitle);
			
		$output .= 'name: "' . $ptitle . '", ';
		
		$output .= '
		mp3: "' . $a_link . '", ';
		
		if ($songarts) {
			$songarts = htmlspecialchars($songarts);
			$songarts  = str_replace("'","&#039;",$songarts );
			$output .= 'artist: "' . $songarts . '"';
		} else {
			$songart = htmlspecialchars($songart);
			$songart  = str_replace("'","&#039;",$songart );
			$output .= 'artist: "' . $songart . '"';
		}
			
		$output .= '}';
		
		
		$countr++;
	}

    
	
	$output .= '
 ];
 </script


	<!-- start player interface-->
	<div id="cromaplay_composite" class="croma-audio playercol-' .  $playcol   . '">
			
		<!-- player class -->
		<div class="cromaplay_playlist">
				
			
			<!-- player main interface -->
			<div class="croma-playerinterface">
 ';
 
 if ($timg){
 $output .= '
		<div class="croma-cover">
			' . $timg . '<a href="' .  get_permalink($nl_mplay)   . '"><span class="albmover"></span></a>
		</div>
 ';
 }
 
 $mi = "''";
 $output .= '<ul class="croma-controls">
					<li><a href="javascript:;" class="croma-previous" tabindex="1">previous</a></li>
					<li><a href="javascript:;" class="croma-play" tabindex="1">play</a></li>
					<li><a href="javascript:;" class="croma-pause" tabindex="1">pause</a></li>
					<li><a href="javascript:;" class="croma-next" tabindex="1">next</a></li>
					<li><a href="javascript:;" class="croma-stop" tabindex="1">stop</a></li>
				</ul>

				<!-- progress bar -->
				<div class="croma-progress">
					<div class="croma-seek">
						<div class="croma-playbar"></div>
					</div>
				</div>


				<!-- volume bar -->
				<div class="croma-volume-back">
					<div class="croma-volume-bar"></div>
				</div>

				<!-- artist & track info -->
				<div class="croma-currentplay">
					<div class="croma-track smallfont"></div>
					<div class="croma-artist smallfont"></div>
				</div>

				<!-- time info -->
				<div class="croma-time-holder">
					<div class="croma-current-time"></div>
				</div>
			</div>

			<!-- playlist info -->
			<div id="croma-playlist">
				<ul>
					<li></li>
				</ul>
			</div>
		</div>
	</div>
 ';

 if ($settings['ntl_auto_play'] == 'off'){
 	$output .= '<script type="text/javascript"> var Cromaplayauto = {autoplay : "no"};</script>';
 } else {
 	$output .= '<script type="text/javascript"> var Cromaplayauto = {autoplay : "yes"};</script>';
 }
 

 } else {
 	$output .= '<p style="color: #fff; padding-top: 10px; padding-right: 20px; width: 200px;position: absolute; top: 0; right: 0px;">No music detected in player</p>';
 }
 
 
 }
 
 return $output;
 
}


function drawgallery() {
?>
<div class="galleryover">
	<div class="goverlay">
		<div class="gloading">&nbsp;</div>
	</div>
	<img src="<?php echo get_template_directory_uri(); ?>/images/goright.png" class="goleft">
	<img src="<?php echo get_template_directory_uri(); ?>/images/goleft.png" class="goright">
	<p class="gallerytitle"></p>
	<a href="#" class="galclose">&nbsp;</a>
	<div class="galleryframe">&nbsp;</div>
</div>
<?php 
}




function getVimeoInfo($id, $info = 'thumbnail_medium') {
	if (!function_exists('curl_init')) die('CURL is not installed!');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	$output = unserialize(curl_exec($ch));
	$output = $output[0][$info];
	curl_close($ch);
	return $output;
}


function lets_get_albumselector() {
	$output = '';
	$linkposts = get_posts('numberposts=10000&post_type=albums');		
	$ttt =  count($linkposts);
		
	if ($ttt >= 2) {
		$output .= '<div class="loadalbm"><h1 class="vfont">' . __('Select album to play', 'localize') . '</h1>';
		$output .= '<div class="albmloader">';

		$output .= '<ul class="clear" style="margin: 0pt; padding: 0pt; position: relative; list-style-type: none; z-index: 1; width: 3276px; left: 0px;">';
		foreach($linkposts as $linkentry) :
			$output .= '<li>' . get_the_post_thumbnail($linkentry->ID, 'albmlink') . '<a href="#"  class="albmoverlink" rel="' . $linkentry->ID  . '">
						<span class="albmover" rel="' . $linkentry->ID  . '">&nbsp;</span></a></li>
			';
		endforeach;	
		$output .= '</ul></div>';
		if ($ttt >= 4) {
			$output .= '<a class="ntlca_prev">previous</a>
					<a class="ntlca_next">next</a>
			';
		}
		$output .= '</div>';
	}
	return $output;
}



/******************************************************************
 * slideshow functions
 ******************************************************************/

function nets_randomizer() {
    $length = 5;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = "";    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}

?>