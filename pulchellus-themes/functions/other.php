<?php

/* -------------------------------------------------------------------------*
 * 								CONTENT WIDTH								*
 * -------------------------------------------------------------------------*/
 
 if ( ! isset( $content_width ) ) 
    $content_width = 900;
	
/* -------------------------------------------------------------------------*
 * 									MAIN MENU								*
 * -------------------------------------------------------------------------*/
 
function add_menu_arrows($menu) {
	$c=0;
	$pos = strpos($menu,"</i>");
	while($pos !== false) {
		$pos_next_a = strpos($menu,"</i>",$pos + 1);
		$pos_next_ul = strpos($menu,"<ul",$pos + 1);

			
		if($pos_next_a > $pos_next_ul && $pos_next_ul > 0) {
			$insert_end = $pos + strlen("<span>");
			$insert_start = strrpos($menu,"<i",$insert_end-strlen($menu));
			$insert_start = strpos($menu,">",$insert_start) + strlen(">");
			
			$start = substr($menu,0,$insert_start);
			$end = substr($menu,$insert_start);
			$menu = $start."<span>".$end;
			
			$start = substr($menu,0,$insert_end);
			$end = substr($menu,$insert_end);
			$menu = $start."</span>".$end;
			
			$pos = $pos + strlen("<span></span>");
		}
		
		$pos = strpos($menu,"</i>",$pos + 1);
	}
	return $menu;
}

/* -------------------------------------------------------------------------*
 * 						MAIN MENU DESCRIPTION								*
 * -------------------------------------------------------------------------*/
 
function description_in_nav_el($item_output, $item, $depth, $args)
{
	if(isset($item->attr_title) && $item->attr_title!="") {
		$menu = preg_replace('/(<a.*?>)([^<]*?)<\/a>/', '$1$2<font>'.$item->attr_title.'</font></a>', $item_output);
	} else {
		$menu = $item_output;
	}
	
	return $menu;
}

function remove_br($subject) {
	$subject = str_replace("<p></p>", " ", $subject );
	$subject = str_replace("<br/>", " ", $subject );
	$subject = str_replace("<br>", " ", $subject );
	$subject = str_replace("<br />", " ", $subject );
	return $subject;
}

function get_query_string_paged() {
	global $query_string;
	$pos = strpos($query_string,"paged=");
	if($pos !== false ) {
		$sub = substr($query_string,$pos);
		$posand = strpos($sub,"&");
		if ($posand == 0) {$paged = substr($sub,6);}
		else { $paged = substr($sub,6,$posand-6);}
		return $paged;
	}
	return 0;
}

function get_contact_page() {
	$pages = get_pages();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-contact.php") {
			return $p->ID;
		}
	}
	return false;
}

function get_portfolio_page1() {
	$pages = get_pages();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-portfolio-3.php") {
			return $p->ID;
		}
	}
	return false;
}
function get_portfolio_page2() {
	$pages = get_pages();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-portfolio-4.php") {
			return $p->ID;
		}
	}
	return false;
}
function get_fullwidth_page() {
	$pages = get_pages();
	$pageID = array();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-full-width.php") {
			$pageID[]=$p->ID;
		}
	}
	return $pageID;
}




function get_home_page() {
	$pages = get_pages();
	$pageID = array();
	foreach($pages as $p) {
		$meta = get_post_custom_values("_wp_page_template",$p->ID);
		if($meta[0] == "template-homepage.php") {
			$pageID[]=$p->ID;
		}
	}
	return $pageID;

}


/* -------------------------------------------------------------------------*
 * 								WIDGET COUNTER								*
 * -------------------------------------------------------------------------*/
 
function widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}

function different_themes_info_message($content) {
	?>
	<a href="javascript:{}" class="help"><img src="<?php echo THEME_IMAGE_CPANEL_URL; ?>ico-help-1.png" /></a>
	<i class="popup-help popup-help-hidden trans-1">
		<a href="javascript:{}" class="close"></a>
		<?php echo $content; ?>
	</i>
	<?php
}
	
$uploadsdir=wp_upload_dir();
define("THEME_UPLOADS_URL", $uploadsdir['url']);





/* -------------------------------------------------------------------------*
 * 							GRAVATAR SETTUP									*
 * -------------------------------------------------------------------------*/
 
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5(strtolower(trim($email)));
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}


/* -------------------------------------------------------------------------*
 * 								NEWS PAGE TITLE								*
 * -------------------------------------------------------------------------*/
 
function news_page_title($postID) {
	global $wp_query;
	if(!is_archive() && !is_category() && !is_single() && !is_search()) {
		$title = get_the_title(DF_page_id());
	} else if(is_search()) {	
		$title =  __("Search Results For:", THEME_NAME)." \"".remove_html($_GET['s'])."\"";
	}  else if(is_category()) {
		$category = get_category( get_query_var( 'cat' ) );
		$cat_id = $category->cat_ID;
		$catName = get_category($cat_id )->name;
		
		$title =  __("Category", THEME_NAME)." \"".$catName."\"";
	} else if (is_author()) {
		$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		$title = __("Posts From", THEME_NAME). " ".$curauth->display_name;
	} else if(is_archive()) {
		$term =	$wp_query->queried_object;
		$title = $term->name;
		if(!$title) {
			$title = __("Archive", THEME_NAME);
		}

	} else if(is_single()) {
		if(get_post_type()=="post" && get_option('page_for_posts')) {
			$title =  get_the_title(get_option('page_for_posts'));
		} else {
			$title =  get_the_title();
		}
	}
	echo $title;
}

/* -------------------------------------------------------------------------*
 * 							CONTENT CLASS							*
 * -------------------------------------------------------------------------*/
 
function OT_content_class($id) {
	$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
	$sidebarPositionCustom = get_post_meta ( $id, THEME_NAME."_sidebar_position", true ); 
	
	if( $sidebarPosition == "left" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "left") ) { 
		$contentClass = " right";
	} else if( $sidebarPosition == "right" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "right") ) { 
		$contentClass = " left";
	} else if ( $sidebarPosition == "custom" && !$sidebarPositionCustom ) { 
		$contentClass = " left";
	} else {
		$contentClass = " left";
	}
	echo $contentClass;
}
/* -------------------------------------------------------------------------*
 * 							SPLIT CLASS							*
 * -------------------------------------------------------------------------*/
 
function OT_split_class($id) {
	$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
	$sidebarPositionCustom = get_post_meta ( $id, THEME_NAME."_sidebar_position", true ); 
	
	if( $sidebarPosition == "left" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "left") ) { 
		$contentClass = "left";
	} else if( $sidebarPosition == "right" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "right") ) { 
		$contentClass = "right";
	} else if ( $sidebarPosition == "custom" && !$sidebarPositionCustom ) { 
		$contentClass = "right";
	} else {
		$contentClass = "right";
	}
	echo $contentClass;
}

/* -------------------------------------------------------------------------*
 * 							GET PAGE ID										*
 * -------------------------------------------------------------------------*/
 
function df_page_id() {
	global $wp_query;
	if(is_home()) {
		$page_id = $wp_query->post->ID;
		if('page' == get_option('show_on_front')) {
			if(is_front_page() && get_option('page_on_front')) {
				$page_id = get_option('page_on_front');
			} else if(get_option('page_for_posts')) {
				$page_id = get_option('page_for_posts');
			}
		}
	} else {
		if(isset($wp_query->post->ID)) { 
			$page_id = $wp_query->post->ID;
		}
	}
	
	if(isset($page_id)) { 
		return $page_id;
	}
}

/* -------------------------------------------------------------------------*
 * 							UPDATE POST VIEW COUNT							*
 * -------------------------------------------------------------------------*/
 
function OT_setPostViews() {
	global $post;
	if(isset($post)) {
		$postID = $post->ID;
		$count_key = THEME_NAME.'_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		
		if ( !is_admin() ) {
			if ( $count=='' ) {
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
			} elseif ( $count==0 ) {
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '1');
			} elseif (isset($_COOKIE[THEME_NAME."_post_views_count_".$postID]) ) {
				if($_COOKIE[THEME_NAME."_post_views_count_".$postID] != "1") {
					$count++;
					update_post_meta($postID, $count_key, $count);
				}
			}
		
			setcookie(THEME_NAME."_post_views_count_".$postID, "1", time()+2678400); 
		}
	}
}

/* -------------------------------------------------------------------------*
 * 							GET POST VIEW COUNT								*
 * -------------------------------------------------------------------------*/
 
function OT_getPostViews($postID){
    $count_key = THEME_NAME.'_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
   
   if( $count=='' ){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
	
    return $count;
}
/* -------------------------------------------------------------------------*
 * 								SIDEBAR CLASS								*
 * -------------------------------------------------------------------------*/
 
function OT_sidebarClass(){
	wp_reset_query();
	$sidebarPosition = get_option ( THEME_NAME."_sidebar_position" ); 
	$sidebarPositionCustom = get_post_meta ( OT_page_id(), THEME_NAME."_sidebar_position", true ); 
	if($sidebarPosition=="left" || ( $sidebarPosition == "custom" &&  $sidebarPositionCustom == "left") ) { $pageBlock = ' reversed-sidebar'; } 
    echo $pageBlock;
}


/* -------------------------------------------------------------------------*
 * 								POST TYPE								*
 * -------------------------------------------------------------------------*/
 
	function OT_post_type($post_type) {
		switch ($post_type) {
			case "blog":
				$post_type="post";
				break;
			case "gallery":
				$post_type="gallery";
				break;
			case "all":
				$post_type=array("post","gallery");
				break;
			default:
				$post_type="post";
		}
		return $post_type;
	}

 /* -------------------------------------------------------------------------*
 * 						ADD CUSTOM TEXT FORMATTING BUTTONS					*
 * -------------------------------------------------------------------------*/
global $orangethemes_buttons;
$orangethemes_buttons=array("differentthemesheading","differentthemesdropcaps","differentthemespreformated","differentthemesmarker","differentthemesmiscellaneous","differentthemeslist","differentthemestables","differentthemesbutton", "differentthemesspacer", "differentthemesquote", "|",
			"differentthemessocial", "differentthemesicon", "differentthemespricing", "differentthemestabs", "differentthemestoggles", "differentthemesalert", "differentthemesattention", "|", "differentthemescolumns", "differentthemestooltip", "differentthemesskillbar", "differentthemesteam", "differentthemesvideo");

function add_orangethemes_buttons() {
   if ( get_user_option('rich_editing') == 'true') {
     add_filter('mce_external_plugins', 'add_orangethemes_btn_tinymce_plugin');
     add_filter('mce_buttons_3', 'register_orangethemes_buttons');
   }
}

function register_orangethemes_buttons($buttons) {
	global $orangethemes_buttons;
		
   array_push($buttons, implode(",",$orangethemes_buttons));
   return $buttons;
}

function add_orangethemes_btn_tinymce_plugin($plugin_array) {
	global $orangethemes_buttons;
	
	foreach($orangethemes_buttons as $btn){
		$plugin_array[$btn] = THEME_ADMIN_URL.'buttons-formatting/editor-plugin.js';
	}
	return $plugin_array;

}
 
 
 /* ------------------------------------------------------------------------*
 * 							OTHER THEMES									*
 * -------------------------------------------------------------------------*/
 
 function other_themes () {
?>
		<!-- BEGIN more-orange-themes -->
		<div class="more-orange-themes">

			<div class="header">
				<img src="<?php echo THEME_IMAGE_MTHEMES_URL; ?>title-more-themes.png" alt="" width="447" height="23" />
				<p>
					<a href="http://www.themeforest.net/user/orange-themes/portfolio?ref=orange-themes" class="btn-1" target="_blank"><span><u class="themeforest">Check our portfolio at themeforest.net</u></span></a>
					<a href="http://www.twitter.com/#!/orangethemes" class="btn-1" target="_blank"><span><u class="twitter">Follow us on twitter</u></span></a>
					<a href="http://www.orange-themes.com" class="btn-1" target="_blank"><span><u class="orangethemes">Orange-themes.com</u></span></a>
				</p>
			</div>

			<?php 
				$xml = theme_get_latest_theme_version(THEME_NOTIFIER_CACHE_INTERVAL); 
				foreach ( $xml->item as $entry ) {
				$title = explode("Private: ", $entry->title);
			?>
			
			<!-- BEGIN .item -->
			<div class="item">
				<div class="image">
					<a href="<?php echo $entry->purchase; ?>"><img src="<?php echo $entry->image; ?>" /></a>
				</div>
				<div class="text">
					<h2><a href="<?php echo $entry->purchase; ?>"><?php echo $title[1]; ?></a></h2>
					<p><?php echo $entry->content; ?></p>
					<p class="link"><a href="<?php echo $entry->demo; ?>" target="_blank">Demo website</a></p>
					<p class="link"><a href="<?php echo $entry->purchase; ?>" target="_blank">Purchase at ThemeForest.net</a></p>
					<?php if ( $entry->html ) { ?>
						<p class="link"><a href="<?php echo $entry->html; ?>" target="_blank">HTML version</a></p>
					<?php } ?>
				</div>
			<!-- END .item -->
			</div>
			<?php } ?> 
			
		<!-- END more-orange-themes -->
		</div>
<?php
	
}

/* -------------------------------------------------------------------------*
 * 							COUNT ATTACHMENTS								*
 * -------------------------------------------------------------------------*/
 
function OT_attachment_count($post_id = false) {
	global $post;
    //Get all attachments
    $attachments = get_posts( array(
        'post_type' => 'attachment',
        'posts_per_page' => -1
    ) );

    $att_count = 0;
    if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
            // Check for the post type based on individual attachment's parent
            if ( 'gallery' == get_post_type($attachment->post_parent) && $post_id == $attachment->post_parent ) {
                $att_count = $att_count + 1;
            } else if ('gallery' == get_post_type($attachment->post_parent) && $post_id == false) {
				$att_count = $att_count + 1;
			}
        }
    }
	 return $att_count;
}

/* -------------------------------------------------------------------------*
 * 							CHECK PAGE TEMPLATE								*
 * -------------------------------------------------------------------------*/
 
function is_pagetemplate_active($pagetemplate = '') {
	global $wpdb;
	$sql = "select meta_key from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
	$result = $wpdb->query($sql);
	if ($result) {
		return TRUE;
	} else {
		return FALSE;
	}
}


/* -------------------------------------------------------------------------*
 * 								GET GOOGLE FONTS							*
 * -------------------------------------------------------------------------*/
 
function OT_get_google_fonts($sort = "alpha") {

	$font_list = get_option(THEME_NAME."_google_font_list");
	$font_list_time = get_option(THEME_NAME."_google_font_list_update");
	$now = time();
	$interval = 41600;
	
	if($font_list) {
		$font_list = $font_list;
	} else if(!$font_list || (( $now - $font_list_time ) > $interval)) {
		$url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCpatq_HIaUbw1XUxVAellP4M1Uoa6oibU&sort=" . $sort;
		$result = json_response( $url );
		if($result!=false) {
			$font_list = array();
			foreach ( $result->items as $font ) {

				$font_list[] .= $font->family;
				
			}
		update_option(THEME_NAME."_google_font_list",$font_list);
		update_option(THEME_NAME."_google_font_list_update",time());
		} else {
			$font_list = false;
		}

	} else {
		$font_list = false;
	}
		
	return $font_list;
	
}
/* -------------------------------------------------------------------------*
 * 								JSON RESPONSE								*
 * -------------------------------------------------------------------------*/
 
if ( ! function_exists( 'json_response' ) )	{

	function json_response( $url )	{
			$args = array(
				 'timeout' => '10',
				 'redirection' => '10',
				 'sslverify' => false // for localhost
			);
			
			# Parse the given url
			$raw = wp_remote_get( $url, $args );
			if ($raw && $raw['body']) {	
				$decoded = json_decode( $raw['body'] );
				
				return $decoded;
			}
	}

}
/* -------------------------------------------------------------------------*
 * 								USER COMMENT COUNT							*
 * -------------------------------------------------------------------------*/
 
function OT_user_comment_count( $user_id )	{
	global $wpdb;
	$where = 'WHERE comment_approved = 1 AND user_id = ' . $user_id ;
	$comment_count = $wpdb->get_var(
		"SELECT COUNT( * ) AS total
			FROM {$wpdb->comments}
			{$where}
		");

	return $comment_count;
}
/* -------------------------------------------------------------------------*
 * 								MENU NAME						*
 * -------------------------------------------------------------------------*/
 
function DF_et_theme_menu_name( $theme_location ) {
	if( ! $theme_location ) return false;
 
	$theme_locations = get_nav_menu_locations();
	if( ! isset( $theme_locations[$theme_location] ) ) return false;
 
	$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
	if( ! $menu_obj ) $menu_obj = false;
	if( ! isset( $menu_obj->name ) ) return false;
 
	return $menu_obj->name;
}


/* -------------------------------------------------------------------------*
 * 							COMMENT FORMATION								*
 * -------------------------------------------------------------------------*/
 
 
function orangethemes_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
   ?>
	<li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="avatar">
            <img src="<?php echo df_get_avatar_url(get_avatar( $comment, 45));?>" alt="<?php _e( 'Avatar' , THEME_NAME );?>">
        </div>
        <div class="comment-content" id="comment-<?php comment_ID() ?>">
			<div class="comment-meta">
                <div class="comment-author"><a href="<?php if(comment_author_url()) { echo comment_author_url();} else { echo "#"; } ?>"><?php printf(__('%1$s', THEME_NAME), get_comment_author_link());?></a></div>
                <div class="comment-date"><?php echo get_comment_date("F d, Y");?></div>
            </div>
			<?php if ($comment->comment_approved == '0') : ?>
				<em style="padding-left:0px; margin-bottom:5px; display:block"><strong><?php _e( 'Your comment is awaiting moderation.' , THEME_NAME );?></strong></em>
				<br />
			<?php endif; ?>
           <?php comment_text(); ?>
		   <p class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => ''.( __( 'Reply' , THEME_NAME )).''))) ?></p>
        </div>



<?php
       }
	   
add_action('init', 'add_orangethemes_buttons');


add_filter('dynamic_sidebar_params','widget_first_last_classes');
add_theme_support('automatic-feed-links' ); 
add_filter('wp', 'OT_setPostViews');
//add_filter('walker_nav_menu_start_el', 'description_in_nav_el', 10, 4);

?>