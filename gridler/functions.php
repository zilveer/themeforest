<?php

/*-----------------------------------------------------------------------------------

	Gridler
	by Swish Themes (http://swishthemes.com)

	Please be careful when editing this file, errors will break the theme.

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Add Theme Support
/*-----------------------------------------------------------------------------------*/

//Add Feed Support
add_theme_support('automatic-feed-links'); 
// post Thumbnail Support
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 56, 56, true ); // Normal post thumbnails
	add_image_size( 'large', 643, '', true ); // Large thumbnails
	add_image_size( 'medium', 250, '', true ); // Medium thumbnails
	add_image_size( 'small', 125, '', true ); // Small thumbnails
	add_image_size( 'post', 643, '', false ); // Blog thumbnail
	add_image_size( 'post-thumb', 311, 0, false ); // Blog thumbnail
}
// post Formats Support
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );


/*-----------------------------------------------------------------------------------*/
/*	Set Max Content Width
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 643;

/*-----------------------------------------------------------------------------------*/
/*	Load Translation Text Domain
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain('framework'. TEMPLATEPATH . '/framework/language');

/*-----------------------------------------------------------------------------------*/
/*	Add Scripts
/*-----------------------------------------------------------------------------------*/
 
include("framework/scripts.php");

/*-----------------------------------------------------------------------------------*/
/*	Add CSS
/*-----------------------------------------------------------------------------------*/

include("framework/styles.php");

/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

include("framework/register-sidebars.php");

/*-----------------------------------------------------------------------------------*/
/*	Register Menus
/*-----------------------------------------------------------------------------------*/
 
include("framework/register-menus.php");

/*-----------------------------------------------------------------------------------*/
/*	Theme Functions
/*-----------------------------------------------------------------------------------*/
 
include("framework/theme-functions.php");

/*-----------------------------------------------------------------------------------*/
/*	Add Admin
/*-----------------------------------------------------------------------------------*/

define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/framework/admin/');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/framework/admin/');
require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

/*-----------------------------------------------------------------------------------*/
/*	Update Notifier
/*-----------------------------------------------------------------------------------*/

require("framework/update-notifier.php");

/*-----------------------------------------------------------------------------------*/
/*	Shortcodes
/*-----------------------------------------------------------------------------------*/

include("framework/shortcodes/shortcodes.php");

/*-----------------------------------------------------------------------------------*/
/*	Shortcode Manager
/*-----------------------------------------------------------------------------------*/

include("framework/wysiwyg/wysiwyg.php");

/*-----------------------------------------------------------------------------------*/
/*	Post Meta
/*-----------------------------------------------------------------------------------*/

include("framework/post-meta.php");

/*-----------------------------------------------------------------------------------*/
/*	Post Types
/*-----------------------------------------------------------------------------------*/

include("framework/post-types.php");

/*-----------------------------------------------------------------------------------*/
/*	Contact Form
/*-----------------------------------------------------------------------------------*/

if (of_get_option('form_builder') == "0") : 
require_once("framework/grunion-contact-form/grunion-contact-form.php");
endif;

/*-----------------------------------------------------------------------------------*/
/*	Widgets
/*-----------------------------------------------------------------------------------*/


// Add the Latest Tweets Custom Widget
include("framework/widgets/widget-tweets.php");

// Add the Flickr Photos Custom Widget
include("framework/widgets/widget-flickr.php");

// Add the Custom Video Widget
include("framework/widgets/widget-video.php");


/*-----------------------------------------------------------------------------------*/
/*	Excerpt Functions
/*-----------------------------------------------------------------------------------*/
 
include("framework/excerpt.php");


/*-----------------------------------------------------------------------------------*/
/*	Custom Login Logo Support
/*-----------------------------------------------------------------------------------*/

function theme_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/images/logo.png) !important; display:none; }
    </style>';
}
function theme_wp_login_url() {
echo home_url();
}
function theme_wp_login_title() {
echo get_option('blogname');
}

add_action('login_head', 'theme_custom_login_logo');
add_filter('login_headerurl', 'theme_wp_login_url');
add_filter('login_headertitle', 'theme_wp_login_title');

/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

function theme_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     
     <div class="comment-wrap" id="comment-<?php comment_ID(); ?>">
      <div class="avatar-wrap"><?php echo get_avatar($comment,$size='50'); ?></div>
      <div class="comment-author vcard">
         <?php printf(__('<cite class="author">%s</cite>'), get_comment_author_link()) ?>
         <span class="comment-meta"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
      </div>

      <?php if ($comment->comment_approved == '0') : ?>
         <em class="moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>
	  
      <div class="comment-body">
      <?php comment_text() ?>
	  </div>
      
     </div>

<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Removes Trackbacks from the comment cout
/*-----------------------------------------------------------------------------------*/

add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}
/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

function theme_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Remove WordPress version in source
/*-----------------------------------------------------------------------------------*/
remove_action('wp_head', 'wp_generator');

/*-----------------------------------------------------------------------------------*/
/* Hide unwanted profile fields.
/*-----------------------------------------------------------------------------------*/

function theme_hide_profile_fields( $contactmethods ) {
unset($contactmethods['aim']);
unset($contactmethods['jabber']);
unset($contactmethods['yim']);
return $contactmethods;
}
add_filter('user_contactmethods','theme_hide_profile_fields',10,1);

/*-----------------------------------------------------------------------------------*/
/* Use the correct link if lightbox is on/off and include video if needed
/*-----------------------------------------------------------------------------------*/

function theme_lightbox($postid, $thumb_size) {
	
	$lightbox = of_get_option('lightbox');
	$thumb = the_post_thumbnail($thumb_size);
	//Get the featured image url
	$imageArray = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_name' );
    $imageURL = $imageArray[0]; // here's the image url
	$video = get_post_meta($postid, 'theme_video_url', true);
	$embeded_code = get_post_meta(get_the_ID(), 'theme_video_m4v', true);
	
	if($lightbox == '1')
	{

		if($embeded_code != '')
		{
			$output = '<a title="'.get_the_title($postid).'" href="'.get_permalink($postid).'">'.$thumb.'</a>';
		}
		elseif($video != '') 
		{
			$output = '<a title="'.get_the_title($postid).'" href="'.get_permalink($postid).'">'.$thumb.'</a>';
		}
		else
		{
			$output = '<a rel="prettyPhoto[gallery]" title="'.get_the_title($postid).'" href="'.$imageURL.'"><span class="overlay"></span>'.$thumb.'</a>';
		}
		
	}
	else
	{	
		$output = '<a title="'.get_the_title($postid).'" href="'.get_permalink($postid).'">'.$thumb.'</a>';
	}
	
	echo $output;
}



/*-----------------------------------------------------------------------------------*/
/* Check video url functions - Posts
/*-----------------------------------------------------------------------------------*/

function theme_video($postid) {
	
	$video_url = get_post_meta($postid, 'theme_video_url', true);
	$height_thumb = get_post_meta($postid, 'theme_video_height_thumb', true);
	$height = get_post_meta($postid, 'theme_video_height', true);
	
if(is_single()) { 
$width = '643';
$height_print = $height;
} else { 
$width = '311'; 
$height_print = $height_thumb;
}
		
		if(preg_match('/youtube/', $video_url)) 
		{
			
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches))
			{
				$output = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="'.$width.'" height="'.$height_print.'" src="http://www.youtube.com/embed/'.$matches[1].'" frameborder="0" allowFullScreen></iframe>';
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>YouTube</strong> URL. Please check it again.', 'framework');
			}
			
		}
		elseif(preg_match('/vimeo/', $video_url)) 
		{
			
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches))
			{
				$output = '<iframe src="http://player.vimeo.com/video/'.$matches[1].'" width="'.$width.'" height="'.$height_print.'" frameborder="0"></iframe>';
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'framework');
			}
			
		}
		else 
		{
			$output = __('Sorry that is an invalid YouTube or Vimeo URL.', 'framework');
		}
		
		echo $output;
		
}

/*-----------------------------------------------------------------------------------*/
/* Check video url functions - Portfolio
/*-----------------------------------------------------------------------------------*/

function theme_video_portfolio($postid) {
	
	$video_url_portfolio = get_post_meta($postid, 'theme_video_url_portfolio', true);
	$height_thumb_portfolio = get_post_meta($postid, 'theme_video_height_thumb_portfolio', true);
	$height_portfolio = get_post_meta($postid, 'theme_video_height_portfolio', true);
	
if(is_single()) { 
$width_portfolio = '643';
$height_print_portfolio = $height_portfolio;
} else { 
$width_portfolio = '311'; 
$height_print_portfolio = $height_thumb_portfolio;
}
		
		if(preg_match('/youtube/', $video_url_portfolio)) 
		{
			
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url_portfolio, $matches))
			{
				$output = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="'.$width_portfolio.'" height="'.$height_print_portfolio.'" src="http://www.youtube.com/embed/'.$matches[1].'?wmode=transparent" frameborder="0" allowFullScreen></iframe>';
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>YouTube</strong> URL. Please check it again.', 'framework');
			}
			
		}
		elseif(preg_match('/vimeo/', $video_url_portfolio)) 
		{
			
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url_portfolio, $matches))
			{
				$output = '<iframe src="http://player.vimeo.com/video/'.$matches[1].'" width="'.$width.'" height="'.$height_print_portfolio.'" frameborder="0"></iframe>';
			}
			else 
			{
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please check it again. Make sure there is a string of numbers at the end.', 'framework');
			}
			
		}
		else 
		{
			$output = __('Sorry that is an invalid YouTube or Vimeo URL.', 'framework');
		}
		
		echo $output;
		
}

/*-----------------------------------------------------------------------------------*/
/*	Gallery JS
/*-----------------------------------------------------------------------------------*/

function theme_gallery($postid){
	 
	 if(has_post_format('gallery', $postid) || get_post_type($postid) == 'portfolio') {
	?>
		<script type="text/javascript">
		
			jQuery(document).ready(function(){
				jQuery("#slider-<?php echo $postid; ?>").slides({
					generatePagination: true,
					effect: 'fade',
					crossfade: true,
					bigTarget: true,
					autoHeight: true
				});
			});
			

		</script>
	<?php }
	
}

/*-----------------------------------------------------------------------------------*/
/*	Audio JS
/*-----------------------------------------------------------------------------------*/

function theme_audio($postid) {
	
	$mp3 = get_post_meta($postid, 'theme_audio_mp3', TRUE);
	$ogg = get_post_meta($postid, 'theme_audio_ogg', TRUE);
	
	if(has_post_format('audio', $postid)) {
	 ?>
		<script type="text/javascript">
		
			jQuery(document).ready(function(){
	
				if(jQuery().jPlayer) {
					jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
						ready: function () {
							jQuery(this).jPlayer("setMedia", {
								<?php if($mp3 != '') : ?>
								mp3: "<?php echo $mp3; ?>",
								<?php endif; ?>
								<?php if($ogg != '') : ?>
								oga: "<?php echo $ogg; ?>",
								<?php endif; ?>
								end: ""
							});
						},
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
					});
					
				}
			});
		</script>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/*	Video JS - Posts
/*-----------------------------------------------------------------------------------*/

function theme_video_embed($postid) {
	
	$m4v = get_post_meta($postid, 'theme_video_m4v', TRUE);
	$ogv = get_post_meta($postid, 'theme_video_ogv', TRUE);
	$poster = get_post_meta($postid, 'theme_video_poster', TRUE);
	
	if(has_post_format('video', $postid) || get_post_type($postid) == 'theme_portfolio') {
	 ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				
				if(jQuery().jPlayer) {
					jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
						ready: function () {
							jQuery(this).jPlayer("setMedia", {
								<?php if($m4v != '') : ?>
								m4v: "<?php echo $m4v; ?>",
								<?php endif; ?>
								<?php if($ogv != '') : ?>
								ogv: "<?php echo $ogv; ?>",
								<?php endif; ?>
								<?php if ($poster != '') : ?>
								poster: "<?php echo $poster; ?>"
								<?php endif; ?>
								
							});
						},
						<?php if (is_single()) { ?> 
						size: {
  						width: "643px",
   						height: "360px"
						<?php } else {?> 
						size: {
  						width: "311px",
   						height: "175px"
						<?php } ?>
  						},
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
						supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
					});
					
				}
			});
		</script>
	<?php }
}

/*-----------------------------------------------------------------------------------*/
/*	Video JS - Portfolio
/*-----------------------------------------------------------------------------------*/

function theme_video_embed_portfolio($postid) {
	
	$m4v_portfolio = get_post_meta($postid, 'theme_video_m4v_portfolio', TRUE);
	$ogv_portfolio = get_post_meta($postid, 'theme_video_ogv_portfolio', TRUE);
	$poster_portfolio = get_post_meta($postid, 'theme_video_poster_portfolio', TRUE);
	
	 ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				
				if(jQuery().jPlayer) {
					jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
						ready: function () {
							jQuery(this).jPlayer("setMedia", {
								<?php if($m4v_portfolio != '') : ?>
								m4v: "<?php echo $m4v_portfolio; ?>",
								<?php endif; ?>
								<?php if($ogv_portfolio != '') : ?>
								ogv: "<?php echo $ogv_portfolio; ?>",
								<?php endif; ?>
								<?php if ($poster_portfolio != '') : ?>
								poster: "<?php echo $poster_portfolio; ?>"
								<?php endif; ?>
								
							});
						},
						<?php if (is_single()) { ?> 
						size: {
  						width: "643px",
   						height: "360px"
						<?php } else {?> 
						size: {
  						width: "311px",
   						height: "175px"
						<?php } ?>
  						},
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
						supplied: "<?php if($m4v_portfolio != '') : ?>m4v, <?php endif; ?><?php if($ogv_portfolio != '') : ?>ogv, <?php endif; ?> all"
					});
					
				}
			});
		</script>
	<?php } 
	
/*-----------------------------------------------------------------------------------*/
/* Make images in posts into lightbox gallery
/*-----------------------------------------------------------------------------------*/
add_filter('the_content', 'add_prettyphoto_postcontent');
function add_prettyphoto_postcontent($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto[post_content]" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}
	
/*-----------------------------------------------------------------------------------*/
/* Modify password protect template
/*-----------------------------------------------------------------------------------*/
function st_the_password_form() {
    global $post;
    $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
    $output = '[raw]<form action="' . get_option('siteurl') . '/wp-pass.php" method="post">
    <p>' . __("My post is password protected. Please ask me for a password:") . '</p>
    <p><label for="' . $label . '">' . __("Password:", "framework") . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" name="Submit" value="' . esc_attr__("Submit") . '" /></p>
    </form>[/raw]';
    return $output;
}
add_filter('the_password_form', 'st_the_password_form');    