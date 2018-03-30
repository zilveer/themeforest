<?php

/*-----------------------------------------------------------------------------------*/
/*	Additional theme functions
/*-----------------------------------------------------------------------------------*/

// Main menu style
function th_theme_nav(){

	$theme_menu_style = th_theme_data('theme_menu_style');
	$menu_style       = get_post_meta(get_the_ID(), '_cmb_menu_style', true);
	if ($menu_style != 'default') {;

		if (is_page_template('template-onepager.php')) {
			if ($menu_style == 'top' || $menu_style == 'canvas') {
				?>

				<!-- Navbar -->
				<?php
				echo get_template_part('menu');
				?>
				<!-- Navbar -->

			<?php
			} else {
				global $th_nav_position;
				$th_nav_position = 'bottom';
			}
		} else {
			get_template_part('menu');
		}

	} else {

		$menu_style = $theme_menu_style;

		if (is_page_template('template-onepager.php')) {
			if ($menu_style == 'top' || $menu_style == 'canvas') {
				?>

				<!-- Navbar -->
				<?php
				echo get_template_part('menu');
				?>
				<!-- Navbar -->

			<?php
			} else {
				global $th_nav_position;
				$th_nav_position = 'bottom';
			}

		} else {
			get_template_part('menu');
		}

	}

}

// Theme Options page data helper function
if(!function_exists('th_theme_data'))
{
    function th_theme_data($key,$default=false)
    {
        global $th_theme_data;
        if(isset($th_theme_data[$key]))
        {
            return $th_theme_data[$key];
        }else{
            return $default;
        }
    }
}

if(!function_exists('th_theme_data_media')){
    function th_theme_data_media($key,$default=false)
    {
        global $th_theme_data;
        if(isset($th_theme_data[$key]['url']))
        {
            return $th_theme_data[$key]['url'];
        }else{
            return $default;
        }
    }
}

// Custom Wordpress Login Logo
if( !function_exists( 'th_custom_login_logo' ) ) {
    function th_custom_login_logo() {
        $login_logo=th_theme_data('login_logo');
        if($login_logo and isset($login_logo['url']) and $login_logo['url'] ){
            echo '<style type="text/css">
			h1 a {
				background-image: url('.$login_logo['url'].') !important;
				background-position: center center !important;
			}
		</style>';
        }
    }
}
add_action('login_head', 'th_custom_login_logo');

// Add extra fields to user profile
if(!function_exists('th_my_show_extra_profile_fields'))
{
    function th_my_show_extra_profile_fields( $user ) {
        ?>
        <h3><?php echo esc_html_e('Extra profile information','larx') ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="twitter"><?php echo esc_html_e('Job','larx') ?></label></th>
                <td>
                    <input type="text" name="job" id="job" value="<?php echo esc_attr( get_the_author_meta( 'job', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php echo esc_html_e('Job will be show under your post','larx') ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="twitter"><?php echo esc_html_e('Facebook Url','larx') ?></label></th>
                <td>
                    <input type="text" name="facebook_url" id="facebook_url" value="<?php echo esc_attr( get_the_author_meta( 'facebook_url', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php echo esc_html_e('Facebook url with show under your description','larx') ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="twitter"><?php echo esc_html_e('Twitter Url','larx') ?></label></th>
                <td>
                    <input type="text" name="twitter_url" id="twitter_url" value="<?php echo esc_attr( get_the_author_meta( 'twitter_url', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php echo esc_html_e('Twitter url will be show under your post','larx') ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="twitter"><?php echo esc_html_e('Google Plus url','larx') ?></label></th>
                <td>
                    <input type="text" name="google_plus_url" id="google_plus_url" value="<?php echo esc_attr( get_the_author_meta( 'google_plus_url', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php echo esc_html_e('Google Plus url will be show under your post','larx') ?></span>
                </td>
            </tr>
        </table>
    <?php }
}

if(!function_exists('th_my_save_extra_profile_fields'))
{
    function th_my_save_extra_profile_fields( $user_id ) {
        if ( !current_user_can( 'edit_user', $user_id ) )
            return false;
        /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
        update_user_meta($user_id, 'job', $_POST['job']);
        update_user_meta($user_id, 'google_plus_url', $_POST['google_plus_url']);
        update_user_meta($user_id, 'twitter_url', $_POST['twitter_url']);
        update_user_meta($user_id, 'facebook_url', $_POST['facebook_url']);
    }
}
add_action( 'show_user_profile', 'th_my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'th_my_show_extra_profile_fields' );

add_action( 'personal_options_update', 'th_my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'th_my_save_extra_profile_fields' );

//Custom function to limit the content
if ( !function_exists( 'content' ) ) {
    function content($contenttype,$limit) {
        global $post;

        if ($contenttype == 'content') { $content = get_the_content(); }
        if ($contenttype == 'excerpt') { $content = get_the_excerpt(); }
        $content = preg_replace('/<img[^>]+./','', $content);
        $content = preg_replace( '/<blockquote>.*<\/blockquote>/', '', $content );

        $content = explode(' ', $content, $limit);
        if (count($content)>=$limit) {
            array_pop($content);
            $content = implode(" ",$content).'... ';
        } else {
            $content = implode(" ",$content);
        }
        $content = preg_replace('/\[.+\]/','', $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        return $content;
    }
}

// Tracking code from THEME OPTIONS page
if ( function_exists('th_footer_tracking_code') ) {
    add_action('wp_footer', 'th_footer_tracking_code');
}

function th_footer_tracking_code() {
    $footer_tracking_code=th_theme_data('footer_tracking_code');
    if($footer_tracking_code) {
        echo $footer_tracking_code;
    }
}

// Custom wp_list_comments function
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
            <div class="comment-author vcard">			
                <?php echo get_avatar($comment,$default='<path_to_url>' ); ?>                
            </div>
            <div class="comment-text">

                <div class="reply">
                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div> 

                <div class="comment-name">
                    <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>         
                </div>

                <small class="comment-date"><?php printf(__('%1$s at %2$s', "larx"), get_comment_date(),  get_comment_time()) ?></small>

    			<?php if ($comment->comment_approved == '0') : ?>
    			<em><?php _e('Your comment is awaiting moderation.', "larx") ?></em>
    			<br />
    			<?php endif; ?>

    			<div class="comment-meta commentmetadata">							  	            
    			  <?php edit_comment_link(esc_html_e('(Edit)', "larx"),'  ','') ?>
    			</div>

    			<?php comment_text() ?>		
            </div>         	
		</div>
<?php
}

// Custom post tags function
function th_blog_post_tags(){
	if(has_tag()){
	?>
		<p class="post-tags"><?php the_tags('<span>'.esc_html('Tags', 'larx').': </span>', ', ', '<br />'); ?></p>
	<?php
	}
}

// Image cropping functions
function th_thumb($w,$h = null){
	require_once dirname(__FILE__).'/../plugins/aq_resizer.php';
	global $post;
	$imgurl = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	return aq_resize($imgurl[0],$w,$h,true);
}