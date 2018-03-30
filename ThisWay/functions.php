<?php
$version = 170;

include "includes/general-settings.php";
include 'includes/post-options.php';
include "includes/shortcodes.php";
include "includes/main-ajax.php";
include "includes/background-manager.php";
include "includes/audio-manager.php";
include "includes/create_portfolio.php";
include "includes/update_notifier.php";


if(!is_admin() && !function_exists('acp_initialise'))
	include "plugins/ajax-comment-posting/ajax-comment-posting.php";
if(!is_admin() && !function_exists('wp_pagenavi'))
	include('plugins/wp-pagenavi/wp-pagenavi.php');
if (!function_exists('wpthumb') )
	require_once 'plugins/wp-thumb/wpthumb.php';
	
if ( ! isset( $content_width ) ) $content_width = 600;

// disabled auto tags such as br, p
//remove_filter ('the_content', 'wpautop');

//use thumbnail with post
add_theme_support( 'post-thumbnails' );

// For use shortcode in widgets
add_filter('widget_text', 'do_shortcode');
add_filter('widget_title', 'do_shortcode');

// menus
register_nav_menu('primary', 'Main Navigation');

// options
$regSettings = array('contentFont', 'contentFontVariant', 'headerFont', 'headerFontVariant', 'copyrighttext', 'logo_url', 'logo_left', 'logo_top', 
'h1FontSize', 'h2FontSize', 'h3FontSize', 'h4FontSize', 'h5FontSize', 'h6FontSize', 'contentFontSize', 'menuFontSize', 'analyticsCode', 'favicon',
'theme_style', 'bgPaused', 'autoPlay', 'loop', 'audioController', 'bgController', 'thController', 'twitter', 'twt_name', 'twt_number', 'shareIcons',
'bgPattern', 'bgNormalFade', 'bgAniTime', 'menuDelay', 'menuOpenText', 'menuCloseText', 'frontPageURL', 'btnSoundURL', 'menuPositionFixed', 'videoPaused',
'menuAlwaysOpen', 'bgStretch', 'twt_consumerkey', 'twt_consumersecret', 'twt_accesstoken', 'twt_accesstokensecret' 
); 

$defValues = array('theme_style'=>'light', 'bgPaused'=>'false', 'autoPlay'=>'false', 'loop'=>'false', 'audioController'=>'none', 'bgController'=>'none',
'thController'=>'none', 'twitter'=>'none', 'shareIcons'=>'none', 'bgPattern'=>'none', 'bgNormalFade'=>'false', 'menuPositionFixed'=>'false', 'videoPaused'=>'false',
'menuAlwaysOpen'=>'false', 'bgStretch'=>'false');

function redirectWithEscapeFragment(){
	$preHTTP = 'http://';
	if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")
		$preHTTP = 'https://';
	if(isset($_SERVER['REDIRECT_URL'])){
		$script_url = $preHTTP.$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI'].((!empty($_SERVER["QUERY_STRING"]))?addionalCharacter($script_url):'').$_SERVER["QUERY_STRING"];
	}else{
		$script_url = $preHTTP.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$script_url = str_replace(home_url().'/','', $script_url);
	header('location:'.home_url().'/?_escaped_fragment_='.$script_url);
	exit;
}

function addionalCharacter($URL){
	if(strpos($URL, '/')===false){
		$pageName = $URL;
	}else{
		$pageName = end(explode('/',$URL));
	}
	if(strpos($URL, '?')===false)
		return '?';
	else
		return '&';
}

function thematic_enqueue_scripts(){
	$tmpurl = get_template_directory_uri();
	
	wp_enqueue_script("jquery", $tmpurl."/js/jquery-1.7.min.js", false, null, false); 
	wp_enqueue_script("easing",$tmpurl."/js/jquery.easing.1.3.js", false, null, true);
	wp_enqueue_script("prettyPhoto",$tmpurl."/js/prettyPhoto/js/jquery.prettyPhoto.js", false, null, true);
	wp_enqueue_script("quicksand", $tmpurl."/js/jquery.quicksand.js", false, null, true); 
	wp_enqueue_script("googlemap", "http://maps.googleapis.com/maps/api/js?sensor=true", false, null, true); 
	wp_enqueue_script("validate", $tmpurl."/js/jquery.validate.min.js", false, null, true); 
	wp_enqueue_script("history", $tmpurl."/js/jquery.history.js", false, null, true); 
	wp_enqueue_script("main", $tmpurl."/main.js", false, null, true); 
	wp_enqueue_style('prettyPhotoStyle', $tmpurl."/js/prettyPhoto/css/prettyPhoto.css", false, null, 'all');
	wp_enqueue_style('generalStyle', $tmpurl."/style.css", false, null, 'all');
	wp_enqueue_script("queryform", $tmpurl."/js/jquery.form.js", false, null, true);
	wp_enqueue_script("froogaloop2", 'http://f.vimeocdn.com/js/froogaloop2.min.js', false, null, false);
}

if(!is_admin())
{
   	add_action('wp_enqueue_scripts', 'thematic_enqueue_scripts');
}

function getFont($name, $type='url', $opt='')
{
	$fonts = json_decode(get_option('fonts'));
	$font;
	for($i=0; $i<sizeof($fonts->items); $i++)
	{
		if($fonts->items[$i]->family==$name)
		{
			$font = $fonts->items[$i];
			break;
		}
	}
	
	if($type=='url' && isset($font))
	{
		$url = 'http://fonts.googleapis.com/css?family='.urlencode($font->family);
		
		if(sizeof($font->variants)==1)
		{
			$url .= ':'.$font->variants[0];
		}
		else{
			$url .= ':'.opt($opt.'Variant','');
		}
			
		$url .= '&subset='.implode(',',$font->subsets);
		return $url;
	}
	
	if($type=='variants' && isset($font))
	{
		return $font->variants;
	}
}

function opt($v, $def)
{
	global $prevID;
	if($prevID==0)
	{
		if($v=='contentFontFull' || $v=='headerFontFull')
		{
			$v = str_replace('Full','', $v);
			return getFont(opt($v,''),'url',$v);
		}
		elseif(get_option($v)=='')
			return $def;
		else
			return get_option($v);
	}else{
		global $wpdb;
		$select_query = "SELECT s.*
							FROM {$wpdb->prefix}settings s
							WHERE s.ID='".$prevID."'";
		$query = $wpdb->get_results($select_query);
		if(sizeof($query)==1)
		{
			$datajson = json_decode($query[0]->SETTINGS);
			if($v=='contentFontFull' || $v=='headerFontFull')
			{
				$v = str_replace('Full','', $v);
				return getFont(opt($v,''),'url',$v);
			}
			elseif(!isset($datajson->{$v}))
				$data = get_option($v);
			else
				$data = $datajson->{$v};
				
			return $data;
		}else
			$data = get_option($v);
	}
}
function eopt($v, $def)
{
	echo opt($v, $def);
}

function createItemForImageList($name, $id, $orginal, $ext)
{
$upload_dir = wp_upload_dir();
$thumbnail_src = $upload_dir['url'].'/'.$name;
$ret ='
	<tr id="imgitem'.$id.'" rel="'.$thumbnail_src.'">
		<td>';
	if($ext=='jpg' || $ext=='gif' || $ext=='png'){
		if(function_exists('wpthumb'))
			$ret .= '<img id="img'.$id.'" rel="selectable" src="'. wpthumb($thumbnail_src,'width=35&height=35&resize=true&crop=1&crop_from_position=center,center') .'" />';
		else
			$ret .= '<img id="img'.$id.'" width="35" height="35" rel="selectable" src="'. $thumbnail_src.'" />';
	}else
		$ret .= '<div id="img'.$id.'" rel="selectable" style="width:35px; height:35px">'.$ext.' File</div>';
$ret .= '</td>
		<td>'.$orginal.'<br />
			<a href="javascript:void(0);" onclick="imageDelete('.$id.',\''.$name.'\')">[Delete]</a>
		</td>
	</tr>
';
return $ret;
}

// clear page navi style
function wp_pagenavi_clear(){
	wp_deregister_style('wp-pagenavi');
}
add_action( 'wp_print_styles', 'wp_pagenavi_clear');

function wp_title_modification( $title, $separator ) {
	global $paged;

	if(is_search())
	{
		$title = __('Results for ', 'ThisWay').get_search_query();
		$title .= " $separator ".get_bloginfo('name');
		return $title;
	}else{
	
		if($paged>1) 
			$title .= ' '.__('Page ','ThisWay').$paged." $separator ";
			
		$title .= get_bloginfo('name');

		$description = get_bloginfo('description');

		if((is_home() || is_front_page()) && $description) 
			$title .= " $separator ".$description;
		return $title;
	}
} 
add_filter( 'wp_title', 'wp_title_modification', 10, 2 );

add_filter( 'the_permalink', 'the_permalink_modification');
function the_permalink_modification($link){
	$link = str_replace(home_url(),'', $link);
	return $link;
}

class My_Walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth=0, $args=array(), $current_object_id=0) 
	{
		global $wp_query;
		$incount=($depth)?str_repeat( "\t",$depth):'';
		$li_class_name='';
		$val='';
 
		if(empty( $item->classes ))
			$classes=array();
		else
			$classes=(array)$item->classes;
 
		$li_class_name=join(' ',apply_filters( 'nav_menu_css_class', array_filter($classes),$item));
		$li_class_name=' class="'.esc_attr($li_class_name).'"';
 
		$output.=$incount.'<li id="menu-item-'.$item->ID.'"'.$val.$li_class_name.'>';
 
		$attributes= !empty($item->attr_title)?' title="'  .esc_attr($item->attr_title).'"':'';
		$attributes.=!empty($item->target)?' target="' .esc_attr( $item->target) .'"':'';
		$attributes.= !empty($item->xfn)?' rel="'    .esc_attr( $item->xfn).'"':'';
		$itemURL = esc_attr($item->url);
		$itemURL = str_replace(home_url().'/','', $itemURL);
		$attributes.= !empty($item->url)?' href="'. (($item->target=='_blank')?'':'#!')   .$itemURL.'"':'';
 
		$out  = '';
		$out .= $args->before;
		$out .= '<a'. $attributes .'><span class="title">';
		$out .= $args->link_before.apply_filters('the_title',$item->title,$item->ID).$args->link_after.'</span>';
		$out .= '<span class="description">'.$item->description.'</span>';
		$out .= '</a>';
		$out .= $args->after;
 
		$output.=apply_filters('walker_nav_menu_start_el',$out,$item,$depth,$args);
	}
}

//POSTED ON META INFO TEMPLATE 
function posted_on_template () {
	echo __('Posted by ', 'ThisWay').get_the_author();
}

function getSource($sourceType, $sourceData, $sourceOpen, $imageW, $imageH)
{
	if(!empty($sourceData))
	{
		$sourceLink = '';
		$embedCode = '';
		if(empty($sourceType))
			return '';
		if($sourceOpen=='m')
		{
			if($sourceType=='videolink')
				$sourceLink = $sourceData;
			elseif($sourceType=='vimeo')
				$sourceLink = 'http://vimeo.com/'.$sourceData;
			elseif($sourceType=='youtube')
				$sourceLink = 'http://www.youtube.com/watch?v='.$sourceData;
			elseif($sourceType=='swf')
				$sourceLink = $sourceData;
			
			return $sourceLink;
		}
		elseif($sourceOpen=='e')
		{
			if($sourceType=='videolink')
				$embedCode = '<iframe src="'.$sourceData.'" width="'.$imageW.'" height="'.$imageH.'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
			elseif($sourceType=='vimeo')
				$embedCode = '<iframe src="http://player.vimeo.com/video/'.$sourceData.'?title=0&amp;byline=0&amp;portrait=0" width="'.$imageW.'" height="'.$imageH.'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
			elseif($sourceType=='youtube')
				$embedCode = '<iframe width="'.$imageW.'" height="'.$imageH.'" src="http://www.youtube.com/embed/'.$sourceData.'?wmode=transparent&rel=0" frameborder="0" allowfullscreen></iframe>';
			elseif($sourceType=='flowplayer')
			{
				$rand = createRandomKey(5);
				$embedCode = '<div id="flashContent'.$rand.'" style="width:'.$imageW.'px; height:'.$imageH.'px;"></div>
							<script type="text/javascript" src="'.get_template_directory_uri().'/js/flowplayer-3.2.6.min.js"></script>
							<script>
							flowplayer("flashContent'.$rand.'", {
								src: "'.get_template_directory_uri().'/js/flowplayer-3.2.7.swf",
								onFail: function()  {
									document.getElementById("info").innerHTML =
										"You need the latest Flash version." +
										"Your version is " + this.getVersion();
								}
							}, {
								clip: {
									autoPlay: false,
									scaling: "fit",
									url:"'.$sourceData.'"
								}
							});
							</script>';
			}
			elseif($sourceType=='swf')
			{
				$rand = createRandomKey(5);
				$embedCode = '<div id="flashContent'.$rand.'">
								<p>You need to <a href="http://www.adobe.com/products/flashplayer/" target="_blank">upgrade your Flash Player</a> to version 10 or newer.</p>  
							</div>
							<script type="text/javascript" src="'.get_template_directory_uri().'/js/swfobject.js"></script>
							<script type="text/javascript">  
									var flashvars = {};  
									var attributes = {};  
									attributes.wmode = "transparent";
									attributes.play = "true";
									attributes.menu = "false";
									attributes.scale = "showall";
									attributes.wmode = "transparent";
									attributes.allowfullscreen = "true";
									attributes.allowscriptaccess = "always";
									attributes.allownetworking = "all";					
									swfobject.embedSWF("'.$sourceData.'", "flashContent'.$rand.'", "'.$imageW.'", "'.$imageH.'", "10", "'.get_template_directory_uri().'/js/expressInstall.swf", flashvars, attributes);  
							</script>';
			}
			return $embedCode;
		}
	}
}

function getTweets($username,$number) 
{
	$html = '';
	if(function_exists('curl_init')){
		require_once("includes/twitteroauth/twitteroauth/twitteroauth.php"); 
		 
		$twitteruser = $username;
		$notweets = $number;
		$consumerkey = opt('twt_consumerkey','');
		$consumersecret = opt('twt_consumersecret','');
		$accesstoken = opt('twt_accesstoken','');
		$accesstokensecret = opt('twt_accesstokensecret','');
		
		function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
		  return $connection;
		}
		 
		$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
		 
		$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
		$tweetsArr = json_decode(json_encode($tweets), true);

		for($t=0; $t<sizeof($tweetsArr); $t++){
			$html .= '<li>'.$tweetsArr[$t]['text']."<li>\n";
		}
	}
	return $html;
}
 
add_filter('avatar_defaults','custom_gravatar');
function custom_gravatar($avatar_defaults) 
{
	$myavatar = get_template_directory_uri().'/images/avatar.jpg';
	$avatar_defaults[$myavatar] = 'ThisWay Default Avatar'; 
	return $avatar_defaults;
}

if(!function_exists('fb_addgravatar')) 
{
	function fb_addgravatar( $avatar_defaults ) 
	{
		$myavatar = get_template_directory_uri().'/images/avatar.jpg';
		$avatar_defaults[$myavatar] = 'ThisWay Default Avatar';
		return $avatar_defaults;
	}
	add_filter('avatar_defaults','fb_addgravatar');
}

function comment_callback($comments, $args, $depth ) {
	$GLOBALS['comment'] = $comments;
	switch($comments->comment_type)
	{
		case '':
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<div class="comment-wrapper clearfix">
				<div class="comment-avatar">
					<?php echo get_avatar($comments, 80); ?>
				</div>
				<div class="comment-text">
					<div class="comment-author">
						<span class="author-link"><?php echo get_comment_author_link(); ?></span> 
						<span class="author-date"><?php echo get_comment_date(); ?></span> 
						<span class="author-time"><?php echo get_comment_time(); ?></span>
					</div> 
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					<?php comment_text(); ?>
				</div>
			</div>
  <?php
			break;
		case 'pingback'  :
		case 'trackback' :
  ?>
        <li class="post pingback">
          <p>
            <?php __('Pingback:', 'ThisWay' ); ?>
            <?php comment_author_link(); ?>
            <?php edit_comment_link( __('Edit','ThisWay'),''); ?>
          </p>
          <?php
			break;
	}
}

?>