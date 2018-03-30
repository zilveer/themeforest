<?php
if (!defined('ABSPATH')) exit();

/* ---------------------------------------------------------------------- */
/* 	Basic Theme Settings
/* ---------------------------------------------------------------------- */

define('TMM_THEME_URI', get_template_directory_uri());
define('TMM_THEME_PATH', get_template_directory());
define('TMM_THEME_PREFIX', 'thememakers_');
define('TMM_EXT_URI', TMM_THEME_URI . '/extensions');
define('TMM_EXT_PATH', TMM_THEME_PATH . '/extensions');
define('TMM_THEME_NAME', 'Diplomat');
define('TMM_FRAMEWORK_VERSION', '2.1.3');
define('TMM_SITE_LINK', 'http://webtemplatemasters.com/');
define('TMM_THEME_LINK', 'http://diplomat.webtemplatemasters.com/help/');
define('TMM_THEME_FORUM_LINK', 'http://forums.webtemplatemasters.com/');

/* ---------------------------------------------------------------------- */
/* 	Load Classes
/* ---------------------------------------------------------------------- */

include_once TMM_THEME_PATH . '/helper/aq_resizer.php';
include_once TMM_THEME_PATH . '/admin/theme_widgets.php';
include_once TMM_THEME_PATH . '/admin/theme_options/helper.php';
include_once TMM_THEME_PATH . '/helper/helper.php';

include_once TMM_THEME_PATH . '/classes/thememakers.php';

include_once TMM_THEME_PATH . '/classes/testimonial.php';
include_once TMM_THEME_PATH . '/classes/gallery.php';
include_once TMM_THEME_PATH . '/classes/users.php';
include_once TMM_THEME_PATH . '/classes/page.php';
include_once TMM_THEME_PATH . '/classes/contact_form.php';
include_once TMM_THEME_PATH . '/classes/custom_sidebars.php';
include_once TMM_THEME_PATH . '/classes/seo_group.php';
include_once TMM_THEME_PATH . '/classes/font.php';
include_once TMM_THEME_PATH . '/classes/auth.php';

/* Extensions including */
include_once TMM_EXT_PATH . '/sliders/index.php';
include_once TMM_EXT_PATH . '/sliders/items/layerslider/index.php';
include_once TMM_EXT_PATH . '/sliders/items/sequence/index.php';
include_once TMM_EXT_PATH . '/staff/index.php';
include_once TMM_EXT_PATH . '/skin_composer/index.php';
include_once TMM_EXT_PATH . '/advanced_search.php';
include_once TMM_EXT_PATH . '/mega_menu.php';
include_once TMM_EXT_PATH . '/mail_subscription/mail_subscription.php';
include_once TMM_EXT_PATH . '/plugin_activation/class-tgm-plugin-activation.php';
include_once TMM_EXT_PATH . '/plugin_activation/plugin_update_checker.php';

/* bbPress */
if (class_exists('bbPress')) {
	include_once TMM_THEME_PATH . '/bbpress/functions.php';
}

/* WPML */
if (class_exists('SitePress')) {
	include_once TMM_EXT_PATH . '/wpml/functions.php';
}

/* ---------------------------------------------------------------------- */
/* 	Theme First Activation
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_get_social_types') ) {
	function tmm_get_social_types() {
		return array(
			'twitter' => array(
				'name' => 'Twitter',
				'link' => 'https://twitter.com/ThemeMakers',
			),
			'facebook' => array(
				'name' => 'Facebook',
				'link' => 'http://www.facebook.com/wpThemeMakers',
			),
			'linkedin' => array(
				'name' => 'Linkedin',
				'link' => 'http://linkedin.com/',
			),
			'pinterest' => array(
				'name' => 'Pinterest',
				'link' => 'http://pinterest.com/',
			),
			'rss' => array(
				'name' => 'Rss',
				'link' => 'false',
			),
			'gplus' => array(
				'name' => 'Google Plus',
				'link' => 'http://plus.google.com/',
			),
			'instagram' => array(
				'name' => 'Instagram',
				'link' => '',
			),
			'dropbox' => array(
				'name' => 'Dropbox',
				'link' => '',
			),
			'dribbble' => array(
				'name' => 'Dribbble',
				'link' => '',
			),
			'vimeo' => array(
				'name' => 'Vimeo',
				'link' => '',
			),
			'youtube' => array(
				'name' => 'Youtube',
				'link' => '',
			),
			'blogger' => array(
				'name' => 'Blogger',
				'link' => '',
			),
			'evernote' => array(
				'name' => 'Evernote',
				'link' => '',
			),
			'behance' => array(
				'name' => 'Behance',
				'link' => '',
			),
			'skype' => array(
				'name' => 'Skype',
				'link' => '',
			),
			'digg' => array(
				'name' => 'Digg',
				'link' => '',
			),
			'appstore' => array(
				'name' => 'Apple',
				'link' => '',
			),
			'wordpress' => array(
				'name' => 'Wordpress',
				'link' => '',
			),
			'deviantart' => array(
				'name' => 'Deviantart',
				'link' => '',
			),
			'github' => array(
				'name' => 'Github',
				'link' => '',
			),
			'email' => array(
				'name' => 'Email',
				'link' => '',
			),
			'flickr' => array(
				'name' => 'Flickr',
				'link' => '',
			),
		);
	}
}

if ( !function_exists('tmm_theme_first_activation') ) {
	function tmm_theme_first_activation() {
		global $pagenow;
		if (is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {
			/* set default options */
			TMM::init();
			$theme_was_activated = TMM::get_option('theme_was_activated');

			if (!$theme_was_activated) {
				$theme_mods = get_option('theme_mods_' . 'diplomat');
				$menu_id = wp_update_nav_menu_object(0, array('menu-name' => 'Primary Menu'));
				$theme_mods['nav_menu_locations']['primary'] = $menu_id;
				update_option('theme_mods_' . 'diplomat', $theme_mods);

				/* update Permalink Settings after theme activated */
				global $wp_rewrite;
				$wp_rewrite->set_permalink_structure( '/%postname%/' );
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				require_once( ABSPATH . 'wp-admin/includes/misc.php' );
				flush_rewrite_rules();

				TMM::update_option('theme_was_activated', 1);
				TMM::update_option('sidebar_position', 'sbr');
				TMM::update_option('copyright_text', 'Copyright &copy; '.date('Y').'. <a target="_blank" href="http://webtemplatemasters.com">'.__('ThemeMakers', 'diplomat').'</a>. '.__('All rights reserved', 'diplomat'));
			}

			if (is_child_theme()) {
				$child_theme_was_activated = TMM::get_option('child_theme_was_activated');

				if (!$child_theme_was_activated) {
					$current_theme = strtolower( get_option('stylesheet') );
					$parent_theme = strtolower( get_option('template') );
					$theme_mods = get_option('theme_mods_' . $parent_theme);
					update_option('theme_mods_' . $current_theme, $theme_mods);

					TMM::update_option('child_theme_was_activated', 1);
				}
			}

			$social_types = tmm_get_social_types();
			TMM::update_option('social_types', serialize($social_types));
		}
	}
}

tmm_theme_first_activation();

/* ---------------------------------------------------------------------- */
/* 	Register Sidebars
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_init_sidebars') ) {
	function tmm_init_sidebars() {
		/* Widget attributes */
		$before_widget = '<div id="%1$s" class="widget %2$s">';
		$after_widget = '</div>';
		$before_title = '<h3 class="widget-title">';
		$after_title = '</h3>';


		if (isset($_REQUEST['action'])) {
			if ($_REQUEST['action'] == 'add_sidebar') {
				$_REQUEST = TMM_Helper::db_quotes_shield($_REQUEST);
			}
		}

		register_sidebar(array(
			'name' => 'Thememakers Default Sidebar',
			'id' => 'tmm_default_sidebar',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => 'Footer Sidebar 1',
			'id' => 'footer_sidebar_1',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => 'Footer Sidebar 2',
			'id' => 'footer_sidebar_2',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		register_sidebar(array(
			'name' => 'Footer Sidebar 3',
			'id' => 'footer_sidebar_3',
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title
		));

		/* Custom widget sidebars */
		TMM_Custom_Sidebars::register_custom_sidebars($before_widget, $after_widget, $before_title, $after_title);
	}
}

add_action( 'widgets_init', 'tmm_init_sidebars' );

/* ---------------------------------------------------------------------- */
/* 	Comments Handlers
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_comments_form_defaults') ) {
	function tmm_comments_form_defaults($defaults) {

		$commenter = wp_get_current_commenter();

		$req = get_option('require_name_email');

		$aria_req = ( $req ? " required" : '' );

		$defaults['fields']['author'] = '<div class="row"><div class="large-7 columns"><fieldset class="comment-form-author">' .
			'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' placeholder="' . __('Your Name', 'diplomat') . ' *" /></fieldset>';
		$defaults['fields']['email'] = '<fieldset class="comment-form-email">' .
			'<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' placeholder="' . __('Your Email', 'diplomat') . ' *" /></fieldset>';
		$defaults['fields']['url'] = '<fieldset class="comment-form-url"> ' .
			'<input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" placeholder="' . __('Website', 'diplomat') . '" /></fieldset></div></div>';
		$defaults['comment_field'] = '<fieldset class="comment-form-comment">' .
			'<textarea cols="30" rows="10" required="" id="comment" name="comment" placeholder="' . __('Your Message', 'diplomat') . ' *"></textarea></fieldset>';

		$defaults['comment_notes_before'] = '';
		$defaults['comment_notes_after'] = '';

		$defaults['cancel_reply_link'] = ' - ' . __('Cancel reply', 'diplomat');

		$defaults['title_reply'] = __('Leave a Reply', 'diplomat');

		$defaults['label_submit'] = __('Submit', 'diplomat');

		return $defaults;
	}
}

add_filter('comment_form_defaults', 'tmm_comments_form_defaults');
add_filter('pre_comment_content','wp_kses_data');

if ( !function_exists('tmm_comments') ) {
	function tmm_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		?>

            <li class="comment" id="comment-<?php echo comment_ID() ?>" comment-id="<?php echo comment_ID() ?>">

                <article>

                    <div class="avatar">
                        <?php echo get_avatar($comment, 70); ?>
                    </div><!--/ .gravatar-->

                    <div class="comment-body">

                        <div class="comment-meta">
                            <div class="comment-author">
                                <h6><?php echo get_comment_author_link(); ?></h6>
                            </div>
                            <div class="comment-date"><?php comment_date(); ?> <?php _e('at', 'diplomat'); ?> <?php comment_date('H:i'); ?></div>
                            <?php echo get_comment_reply_link(array_merge(
                                    array('reply_text' => __('Reply', 'diplomat')),
                                    array('depth' => $depth, 'max_depth' => $args['max_depth']))
                            ) ?>
                        </div><!--/ .comment-meta -->

                        <p><?php comment_text(); ?></p>

                    </div><!--/ .comment-body -->

                </article>



		<?php
	}
}

/* ---------------------------------------------------------------------- */
/* 	Page and Post Links Handlers (wp_link_pages)
/* ---------------------------------------------------------------------- */

/* Filter posts title */
add_filter('the_title','wp_kses_data');

/* Add prev and next links to a numbered link list */
if ( !function_exists('tmm_link_pages_add_prevnext') ) {
	function tmm_link_pages_add_prevnext($args) {
		global $page, $numpages, $more;

		if (!$more || $args['next_or_number'] !== 'add_prevnext')
			return $args;

		$args['next_or_number'] = 'number';

		/*  Previous page */
	    if ($page - 1){
			$args['before'] .= str_replace('<a ', '<a class="prev page-numbers" ', _wp_link_page($page - 1))
				. $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
	    }
	    /* Next page */
		if ($page < $numpages){
			$args['after'] = str_replace('<a ', '<a class="next page-numbers" ', _wp_link_page($page + 1))
				. $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
				. $args['after'];
	    }
		return $args;
	}
}

add_filter('wp_link_pages_args', 'tmm_link_pages_add_prevnext');

/* Wrap current page by span */
if ( !function_exists('tmm_link_pages_current_link') ) {
	function tmm_link_pages_current_link( $link ) {
		if ( ctype_digit( $link ) ) {
			return '<span class="page-numbers current">' . $link . '</span>';
		}
		return $link;
	}
}

add_filter( 'wp_link_pages_link', 'tmm_link_pages_current_link' );

if ( !function_exists('tmm_link_pages') ) {
	function tmm_link_pages() {
		$args = array(
			'before' =>'<div class="pagenavi">',
	        'after'  =>'</div>',
			'link_before'  =>'',
			'link_after'  =>'',
			'separator' => '',
			'nextpagelink' => '',
			'previouspagelink' => '',
	        'next_or_number' => 'add_prevnext',
			'echo' => 1,
		);
		wp_link_pages($args);
	}
}

/* ---------------------------------------------------------------------- */
/* 	Post Likes Ajax Handlers
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_post_like') ) {
	function tmm_post_like() {
	    // Check for nonce security
	    $nonce = $_POST['nonce'];

	    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
	        die ( 'Busted!');

		if(isset($_POST['post_like']))
		{
			// Retrieve user IP address
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];

			$voted_IP = array();
			// Get voters'IPs for the current post
			$meta_IP = get_post_meta($post_id, "voted_IP");

			if (!empty($meta_IP[0]))
				$voted_IP = $meta_IP[0];

			// Get votes count for the current post
			$meta_count = get_post_meta($post_id, "votes_count", true);

			// Use has already voted ?
			if(!tmm_has_already_voted($post_id))
			{
				$voted_IP[$ip] = time();

				// Save IP and increase votes count
				update_post_meta($post_id, "voted_IP", $voted_IP);
				update_post_meta($post_id, "votes_count", ++$meta_count);

				// Display count (ie jQuery return value)
				echo $meta_count;
			}
			else
				echo "already";
		}
		exit;
	}
}

if ( !function_exists('tmm_has_already_voted') ) {
	function tmm_has_already_voted($post_id){
		// Retrieve post votes IPs
		$meta_IP = get_post_meta($post_id, "voted_IP");

		$voted_IP = array();

		if (!empty($meta_IP[0]))
			$voted_IP = $meta_IP[0];

		// Retrieve current user IP
		$ip = $_SERVER['REMOTE_ADDR'];

		// If user has already voted
		if(in_array($ip, array_keys($voted_IP)))
		{
			return true;
		}
		else{
			return false;
		}
	}
}

add_action('wp_ajax_nopriv_post-like', 'tmm_post_like');
add_action('wp_ajax_post-like', 'tmm_post_like');

/* ---------------------------------------------------------------------- */
/* 	Admin Functions
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_mce_buttons') ) {
	function tmm_mce_buttons($mce_buttons) {
	    $pos = array_search('wp_more', $mce_buttons, true);
	    if ($pos !== false) {
	        $tmp_buttons = array_slice($mce_buttons, 0, $pos + 1);
	        $tmp_buttons[] = 'wp_page';
	        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos + 1));
	    }
	    return $mce_buttons;
	}
}

add_filter('mce_buttons', 'tmm_mce_buttons');

/* Admin Editor Filters */
add_filter( 'tiny_mce_before_init', array('TMM_Helper', 'tiny_mce_before_init'), 10, 2 );
add_filter( 'quicktags_settings', array('TMM_Helper', 'quicktags_settings'), 10, 2 );

/* Add Theme Options Page to Admin Bar */
if ( !function_exists('tmm_admin_bar_menu') ) {
	function tmm_admin_bar_menu() {
	    global $wp_admin_bar;
	    if (!is_super_admin() || !is_admin_bar_showing())
	        return;
	    $wp_admin_bar->add_menu(array(
	        'id' => 'tmm_theme_options_page',
	        'title' => __("Theme Options", 'diplomat'),
	        'href' => admin_url('themes.php?page=tmm_theme_options'),
	    ));
	}
}

add_action('admin_bar_menu', 'tmm_admin_bar_menu', 89);

/* Add Theme Options Page to Admin Menu */
if ( !function_exists('tmm_admin_menu') ) {
	function tmm_admin_menu() {
	    add_theme_page(__("Theme Options", 'diplomat'), __("Theme Options", 'diplomat'), 'manage_options', 'tmm_theme_options', 'tmm_theme_options_page');
	}
}

if ( !function_exists('tmm_theme_options_page') ) {
	function tmm_theme_options_page() {
	    echo TMM::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/theme_options.php');
	}
}

add_action('admin_menu', 'tmm_admin_menu');

/* Define Admin Notices */
if ( !function_exists('tmm_admin_notices') ) {
	function tmm_admin_notices() {
	    $notices = "";

		if (!is_writable(TMM_THEME_PATH . "/css/styles.css") && !get_option('tmm_dismiss_style-css-notice')) {
			$notices .= sprintf(__('<div class="notice error style-css-notice is-dismissible"><p>'
				. '<b>' . __('Notice:', 'diplomat') . ' </b>'
				. __('permissions 755 (in some cases 775) for %s/css/styles.css file are required for correct theme work.', 'diplomat') . '<br>'
				. __('Please follow', 'diplomat') . ' <a href="' . TMM_SITE_LINK . 'tutorials/permissions/" target="_blank">'
				. __('this link', 'diplomat') . '</a> ' . __('to read the instructions how to do it properly.', 'diplomat')
				. '</p></div>', 'diplomat'), TMM_THEME_PATH);
		}

		if (!is_writable(TMM_THEME_PATH . "/scss/_tmm_styling_options.scss") && !get_option('tmm_dismiss_styling-options-notice')) {
			$notices .= sprintf(__('<div class="notice error styling-options-notice is-dismissible"><p>'
				. '<b>' . __('Notice:', 'diplomat') . ' </b>'
				. __('permissions 755 (in some cases 775) for %s/scss/_tmm_styling_options.scss file are required for correct theme work.', 'diplomat') . '<br>'
				. __('Please follow', 'diplomat') . ' <a href="' . TMM_SITE_LINK . 'tutorials/permissions/" target="_blank">'
				. __('this link', 'diplomat') . '</a> ' . __('to read the instructions how to do it properly.', 'diplomat')
				. '</p></div>', 'diplomat'), TMM_THEME_PATH);
		}

		if (!is_writable(TMM_THEME_PATH . "/css/custom2.css") && !get_option('tmm_dismiss_custom-css2-notice')) {
			$notices .= sprintf(__('<div class="notice error custom-css2-notice is-dismissible"><p>'
				. '<b>' . __('Notice:', 'diplomat') . ' </b>'
				. __('permissions 755 (in some cases 775) for %s/css/custom2.css file are required for correct theme work.', 'diplomat') . '<br>'
				. __('Please follow', 'diplomat') . ' <a href="'.TMM_SITE_LINK.'tutorials/permissions/" target="_blank">'
				. __('this link', 'diplomat') . '</a> ' . __('to read the instructions how to do it properly.', 'diplomat')
				. '</p></div>', 'diplomat'), TMM_THEME_PATH);
		}

		if ( (!class_exists('TMM_Theme_Features') || !class_exists('TMM_Content_Composer')) && !get_option('tmm_dismiss_required-plugins-notice') ) {
			$notices .= sprintf(__('<div class="error notice required-plugins-notice is-dismissible"><p>'
				. '<b>' . __('Notice:', 'diplomat') . ' </b>'
				. __('For correct theme work you need to install ThemeMakers Required Plugins.', 'diplomat') . '<br>'
				. __('Please follow', 'diplomat') . ' <a href="' . admin_url('themes.php?page=tgmpa-install-plugins') . '">'
				. __('this link', 'diplomat') . '</a> ' . __('to proceed the installation.', 'diplomat')
				.'</a></p></div>', 'diplomat'), TMM_THEME_PATH);
		}

	    echo $notices;
	}
}

add_action('admin_notices', 'tmm_admin_notices');

/* ---------------------------------------------------------------------- */
/* 	Define is the blog archive page
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_is_blog_archive') ) {
	function tmm_is_blog_archive() {

		if (is_category() || is_tag() || is_author() || is_date() || is_tax( 'post_format' ) || ( is_home() && get_option( 'show_on_front') === 'posts' )) {
			return true;
		}

		return false;
	}
}

/* ---------------------------------------------------------------------- */
/* 	Ajax Callbacks
/* ---------------------------------------------------------------------- */

add_action('wp_ajax_change_options', array('TMM', 'change_options'));

add_action('wp_ajax_add_sidebar', array('TMM_Custom_Sidebars', 'add_sidebar'));
add_action('wp_ajax_add_sidebar_page', array('TMM_Custom_Sidebars', 'add_sidebar_page'));
add_action('wp_ajax_add_sidebar_category', array('TMM_Custom_Sidebars', 'add_sidebar_category'));

add_action('wp_ajax_get_post_masonry_piece', array('TMM', 'get_post_masonry_piece'));
add_action('wp_ajax_nopriv_get_post_masonry_piece', array('TMM', 'get_post_masonry_piece'));

add_action('wp_ajax_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));
add_action('wp_ajax_nopriv_contact_form_request', array('TMM_Contact_Form', 'contact_form_request'));

add_action('wp_ajax_subscribe_request', array('TMM_Mail_Subscription', 'subscribe_request'));
add_action('wp_ajax_nopriv_subscribe_request', array('TMM_Mail_Subscription', 'subscribe_request'));

add_action('wp_ajax_unsubscribe_request', array('TMM_Mail_Subscription', 'unsubscribe_request'));
add_action('wp_ajax_nopriv_unsubscribe_request', array('TMM_Mail_Subscription', 'unsubscribe_request'));

add_action('wp_ajax_add_comment', array('TMM_Helper', 'add_comment'));
add_action('wp_ajax_get_resized_image_url', array('TMM_Helper', 'get_resized_image_url'));
add_action('wp_ajax_regeneratethumbnail', array('TMM_Helper', 'regeneratethumbnail'));
add_action('wp_ajax_update_allowed_alias', array('TMM_Helper', 'update_allowed_alias'));
add_action('wp_ajax_setmenu_featured_image', array('TMM_Helper', 'setmenu_featured_image'));

add_action('wp_ajax_nopriv_add_comment', array('TMM_Helper', 'add_comment'));

add_action('wp_ajax_add_seo_group', array('TMM_SEO_Group', 'add_seo_group'));
add_action('wp_ajax_add_seo_group_category', array('TMM_SEO_Group', 'add_seo_group_category'));

/* Advanced search */
add_action('wp_ajax_advanced_search', array('TMM_Advanced_Search', 'advanced_search'));
add_action('wp_ajax_nopriv_advanced_search', array('TMM_Advanced_Search', 'advanced_search'));
add_action('wp_ajax_ajax_search_navi', array('TMM_Advanced_Search', 'ajax_search_navi'));
add_action('wp_ajax_nopriv_ajax_search_navi', array('TMM_Advanced_Search', 'ajax_search_navi'));

add_action('wp_ajax_tmm_dismiss_notice', 'tmm_dismiss_notice');

/* ---------------------------------------------------------------------- */
/* 	Fonts Functions
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_enqueue_fonts') ) {
	function tmm_enqueue_fonts(){
	    $fonts = array(
	        'Roboto Slab' => 1,
	        'Roboto' => 1,
	        'PT + Serif' => 1,
	    );

	    if (TMM::get_option('logo_font')) {
	        $fonts[ TMM::get_option('logo_font') ] = 1;
	    }
	    if (TMM::get_option('general_font_family')) {
	        $fonts[ TMM::get_option('general_font_family') ] = 1;
	    }
	    if (TMM::get_option('main_nav_font')) {
	        $fonts[ TMM::get_option('main_nav_font') ] = 1;
	    }
	    if (TMM::get_option('h1_font_family')) {
	        $fonts[ TMM::get_option('h1_font_family') ] = 1;
	    }
	    if (TMM::get_option('h2_font_family')) {
	        $fonts[ TMM::get_option('h2_font_family') ] = 1;
	    }
	    if (TMM::get_option('h3_font_family')) {
	        $fonts[ TMM::get_option('h3_font_family') ] = 1;
	    }
	    if (TMM::get_option('h4_font_family')) {
	        $fonts[ TMM::get_option('h4_font_family') ] = 1;
	    }
	    if (TMM::get_option('h5_font_family')) {
	        $fonts[ TMM::get_option('h5_font_family') ] = 1;
	    }
	    if (TMM::get_option('h6_font_family')) {
	        $fonts[ TMM::get_option('h6_font_family') ] = 1;
	    }
	    if (TMM::get_option('content_font_family')) {
	        $fonts[ TMM::get_option('content_font_family') ] = 1;
	    }
	    if (TMM::get_option('buttons_font_family')) {
	        $fonts[ TMM::get_option('buttons_font_family') ] = 1;
	    }

	    if (is_single() OR is_page()){
	        $post_fonts = get_post_meta(get_the_ID(), 'tmm_google_fonts', 1);
	        if(!empty($post_fonts) && is_serialized($post_fonts)){
	            $post_fonts = unserialize($post_fonts);
	            foreach($post_fonts as $value){
	                $fonts[$value] = 1;
	            }
	        }
	    }

	    $link = TMM_Font::get_google_fonts_link($fonts);
	    if(!empty($link)){
	        wp_enqueue_style('tmm_google_fonts', $link, null, false);
	    }
	}
}

add_action('wp_enqueue_scripts', 'tmm_enqueue_fonts', 1);

/**
 * Retrieve google fonts link by post id. Default fonts are excluded.
 *
 * @param $post_id Required.
 */
if ( !function_exists('tmm_get_font_link') ) {
	function tmm_get_font_link( $post_id ) {
	    $post_fonts = get_post_meta($post_id, 'tmm_google_fonts', 1);
	    $fonts_link = '';

	    if(!empty($post_fonts) && is_serialized($post_fonts)){
	        $fonts = array();
	        $post_fonts = unserialize($post_fonts);
	        foreach($post_fonts as $value){
	            $fonts[$value] = 1;
	        }
	        $fonts_link = TMM_Font::get_google_fonts_link($fonts);
	    }
	    return $fonts_link;
	}
}

/**
 * Retrieve fonts array.
 *
 */
if ( !function_exists('tmm_get_fonts_array') ) {
	function tmm_get_fonts_array() {
	    return TMM_Font::get_fonts_array();
	}
}

/* ---------------------------------------------------------------------- */
/* 	Read More Link
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_read_more_link') ) {
	function tmm_read_more_link() {
		return '<a class="button default tag_more" href="' . esc_url(get_permalink()) . '">' . __('Read More', 'diplomat') . '</a>';
	}
}

add_filter( 'the_content_more_link', 'tmm_read_more_link' );

/* ---------------------------------------------------------------------- */
/* 	Use wptexturize
/* ---------------------------------------------------------------------- */

if (!TMM::get_option('use_wptexturize')) {
    remove_filter('the_content', 'wptexturize');
}

/* ---------------------------------------------------------------------- */
/* 	Theme Init Hooks
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_after_setup_theme') ) {
	function tmm_after_setup_theme(){
		add_theme_support('post-thumbnails');
		add_theme_support('automatic-feed-links');
		add_theme_support('custom-header', array());
		add_theme_support('custom-background', array());
		add_theme_support('title-tag');
		add_filter('widget_text', 'do_shortcode');

		add_theme_support( 'post-formats', array(
			'quote', 'gallery', 'audio', 'video'
		));

		register_nav_menu('primary', __('Primary Menu', 'diplomat'));
		load_theme_textdomain('diplomat', TMM_THEME_PATH . '/languages');

		TMM::init();
	}
}

add_action('after_setup_theme', 'tmm_after_setup_theme', 1);

if ( !function_exists('tmm_init') ) {
	function tmm_init() {
		tmm_register_scripts();
		tmm_register_styles();

		add_filter( 'wp_edit_nav_menu_walker', array( 'TMM_Helper' , 'editWalker' ) , 2000);
		/* Save menu items */
		add_action( 'wp_update_nav_menu_item', array( 'TMM_Helper' , 'update_nav_menu' ), 10, 3); //, $menu_id, $menu_item_db_id, $args;

		/* Theme custom post types classes */
		$theme_cpt_classes = array(
			'TMM_Testimonial',
            'TMM_Mail_Subscription',
			'TMM_Gallery',
			'TMM_Page',
		);
		/* Init custom post types */
		foreach ($theme_cpt_classes as $class) {
			add_action('init', array($class, 'init'));
			add_action('admin_init', array($class, 'admin_init'));
			add_action('save_post', array($class, 'save_post'));
		}

		 $theme_helper_classes = array(
			'TMM_Users'
		);
		foreach ($theme_helper_classes as $class) {
			new $class;
		}

	}
}

add_action('init', 'tmm_init', 1);

add_action('admin_init', array('TMM_Menu_Walker', 'nav_menu_meta_box'));

/* ---------------------------------------------------------------------- */
/* 	Scripts and Styles Linking Functions
/* ---------------------------------------------------------------------- */

// Disabling dgx_donate Plugins Stylesheet
add_action( 'wp_print_styles', 'dgx_donate_deregister_stylesheet', 100 );

function dgx_donate_deregister_stylesheet() {
	wp_deregister_style('seamless_donations_css');
}

if ( !function_exists('tmm_register_scripts') ) {
	function tmm_register_scripts() {
		/* Head scripts */
		wp_register_script('tmm_modernizr', TMM_THEME_URI . '/js/modernizr.min.js', array('jquery'));
		wp_register_script('tmm_selectivizr', TMM_THEME_URI . '/js/selectivizr.min.js', array('jquery'));

		/* Footer scripts */
		wp_register_script('tmm_vendor', TMM_THEME_URI . '/js/vendor-min.js', array('jquery'), false, true);

	}
}

if ( !function_exists('tmm_register_styles') ) {
	function tmm_register_styles() {
		wp_register_style('tmm_theme_style', TMM_THEME_URI . '/css/styles.css', null, false);
		wp_register_style('tmm_custom2', TMM_THEME_URI . '/css/custom2.css', null, false);

	}
}

if ( !function_exists('tmm_wp_enqueue_scripts') ) {
	function tmm_wp_enqueue_scripts() {
		/* Head scripts */

		tmm_enqueue_style('theme_style');

		if (is_rtl()) {
			wp_enqueue_style("tmm_rtl", TMM_THEME_URI . '/css/rtl.css');
		}

		if (is_child_theme()) {
			wp_enqueue_style( 'theme_child_style', get_stylesheet_uri() );
		}

		tmm_enqueue_style('custom2');

		wp_enqueue_script('jquery');
		tmm_enqueue_script('modernizr');

		global $is_IE;
		if ($is_IE) {
			tmm_enqueue_script('selectivizr');
		}

		?>
		<style type="text/css" media="print">#wpadminbar { display: none; }</style>
		<script type="text/javascript">
			<?php if (is_single() || is_page()) { ?>
			var is_single_page = true;//for breadcumbs definitions it theme.js
			<?php } ?>
			var site_url = "<?php echo esc_js(home_url()); ?>";
			var capcha_image_url = "<?php echo esc_js(TMM_THEME_URI) ?>/helper/capcha/image.php/";
			var template_directory = "<?php echo esc_js(TMM_THEME_URI); ?>/";
			var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
			var ajax_nonce = "<?php echo  esc_js(wp_create_nonce('ajax-nonce')); ?>";
			var lang_enter_correctly = "<?php echo esc_js(__('Please enter correct', 'diplomat')); ?>";
			var lang_sended_succsessfully = "<?php echo esc_js(__('Your message has been sent successfully!', 'diplomat')); ?>";
			var lang_server_failed = "<?php echo esc_js(__('Server failed. Send later', 'diplomat')); ?>";
			var lang_any = "<?php echo esc_js(__('Any', 'diplomat')); ?>";
			var lang_home = "<?php echo esc_js(__('Home', 'diplomat')); ?>";
			var lang_attach_more_else = "<?php echo esc_js(__('You cant add more else attachments!', 'diplomat')); ?>";
			var lang_loading = "<?php echo esc_js(__('Loading ...', 'diplomat')); ?>";
			var lang_mail_sending = "<?php echo esc_js(__('Mail sending ...', 'diplomat')); ?>";
			var charcount = "<?php echo esc_js(TMM::get_option('character_count')) ?>";
			var widget_advanced_search = "<?php echo esc_js(TMM::get_option('widget_advanced_search')); ?>";
			var menu_advanced_search = "<?php echo esc_js(TMM::get_option('menu_advanced_search')); ?>";
			var fixed_menu = "<?php echo esc_js(TMM::get_option('fixed_menu')) ?>";
			var appearing_speed = "<?php echo esc_js(TMM::get_option('appearing_speed')) ?>";
		</script>
		<?php

		/* Footer scripts */

		tmm_enqueue_script('vendor');

		/* Open Graphs */
		if ( (get_post_type() === 'post' && TMM::get_option("blog_single_show_social_share") !== '0') ||
			(get_post_type() === TMM_Gallery::$slug && TMM::get_option("gall_single_show_social_share") !== '0') ) {

			global $post;
			$post_pod_type = get_post_format();
			$thumb_src = TMM_Helper::get_post_featured_image($post->ID, '745*450');

			if ($post_pod_type === 'video_test') { //todo: share video on facebook in testing mode
				$post_type_values = get_post_meta( get_the_ID(), 'post_type_values', true );
				$source_url = $post_type_values['video'];

				if (!has_post_thumbnail()) {
					if (strpos($source_url, "youtube.com") !== false || strpos($source_url, "youtu.be") !== false) {

						if (strpos($source_url, "youtube.com") !== false || strpos($source_url, "youtu.be") !== false) {
							$video_youtube = explode("?v=", $source_url);
						} else {
							$video_youtube = explode("youtu.be/", $source_url);
						}

						if (!empty($video_youtube[1])) {
							$thumb_src = 'http://img.youtube.com/vi/'. $video_youtube[1] .'/default.jpg';
						}

					} else if (strpos($source_url, "vimeo.com") !== false) {
						$arr = parse_url($source_url);

						if (!empty($arr['path'])) {
							$xml = simplexml_load_file('http://vimeo.com/api/v2/video' . $arr['path'] . '.xml');

							if ($xml) {
								$thumb_src = (string) $xml->video->thumbnail_medium;
							}
						}

					}
				}

				if (!empty($source_url)) {
					?>
					<meta property="og:url"                content="<?php the_permalink() ?>" />
					<meta property="og:type"               content="article" />
					<meta property="og:video"              content="<?php echo $source_url ?>" />
					<meta property="og:video:secure_url"   content="<?php echo $source_url ?>" />
					<meta property="og:image"              content="<?php echo $thumb_src ?>" />
				<?php
				}

			} else {

				if (!has_post_thumbnail()) {
					if ($post_pod_type === 'gallery') {
						$post_type_values = get_post_meta( get_the_ID(), 'post_type_values', true );
						$gall = $post_type_values['gallery'];
						$thumb_src = $gall[0];

						if (is_multisite()) {
							$path = wp_upload_dir();
							$temp = explode('wp-content/uploads', $thumb_src);
							$thumb_src = $path['baseurl'] . $temp[1];
						}
					} else if (get_post_type() === TMM_Gallery::$slug) {
						$meta = get_post_custom($post->ID);
						if (!empty($meta["thememakers_gallery"][0]) AND is_serialized($meta["thememakers_gallery"][0])) {
							$pictures = unserialize($meta["thememakers_gallery"][0]);
							if (!empty($pictures)) {
								$pictures = array_values($pictures);
								$thumb_src = $pictures[0]['imgurl'];
							}
						}
					}
				}

				?>
				<meta property="og:url"                content="<?php the_permalink() ?>" />
				<meta property="og:type"               content="article" />
				<meta property="og:image"              content="<?php echo $thumb_src ?>" />
				<meta property="og:image:width"        content="745" />
				<meta property="og:image:height"       content="450" />
			<?php
			}
		}

	}
}

add_action('wp_enqueue_scripts', 'tmm_wp_enqueue_scripts', 1);

if ( !function_exists('tmm_admin_enqueue_scripts') ) {
	function tmm_admin_enqueue_scripts() {
		/* Head scripts */
		wp_enqueue_style('thickbox');
		wp_enqueue_style("tmm_colorpicker", TMM_THEME_URI . '/admin/js/colorpicker/colorpicker.css');
		wp_enqueue_style("tmm_admin_styles_css", TMM_THEME_URI . '/admin/css/styles.css');

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('tmm_theme_admin', TMM_THEME_URI . '/admin/js/general.js', array('jquery'));
		wp_enqueue_script('tmm_colorpicker', TMM_THEME_URI . '/admin/js/colorpicker/colorpicker.js', array('jquery'));
		wp_enqueue_media();

		global $is_IE;

		$translation_array = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'edit' => __('Edit', 'diplomat'),
			'delete' => __('Delete', 'diplomat'),
			'loading' => __("Loading", 'diplomat'),
			'sure' => __("Sure?", 'diplomat'),
			'title_slide_posts' => __("Posts", 'diplomat'),
			'tmm_theme_options_url' =>  admin_url('themes.php?page=tmm_theme_options&tmm_action=save_options'),
			'tmm_enter_new_color_scheme_name' =>  __("Please enter new color scheme name!", 'diplomat'),
			'tmm_enter_new_color' =>  __("Please enter color of new scheme!", 'diplomat'),
			'tmm_creating_new_color_scheme' =>  __("Creating new color scheme, please wait...", 'diplomat'),
			'tmm_new_color_scheme_added' =>  __("New color scheme added!", 'diplomat'),
			'is_IE' => (int) $is_IE
		);
		wp_localize_script( 'jquery', 'tmm_l10n', $translation_array );

		/* If Theme Options page */
		if (isset($_GET['page']) && $_GET['page'] == 'tmm_theme_options') {
			wp_enqueue_style('tmm_theme_options', TMM_THEME_URI . '/admin/theme_options/css/styles.css');

			wp_enqueue_script('tmm_theme_options', TMM_THEME_URI . '/admin/theme_options/js/options.js', array('jquery'));
			wp_enqueue_script('tmm_theme_cache', TMM_THEME_URI . '/admin/js/js.cookie.js', array('jquery'));
			wp_enqueue_script('tmm_theme_custom_sidebars', TMM_THEME_URI . '/admin/theme_options/js/custom_sidebars.js', array('jquery'));
			wp_enqueue_script('tmm_theme_seo_groups', TMM_THEME_URI . '/admin/theme_options/js/seo_groups.js', array('jquery'));
			wp_enqueue_script('tmm_theme_form_constructor', TMM_THEME_URI . '/admin/theme_options/js/form_constructor.js', array('jquery'));
			wp_enqueue_script('tmm_theme_selectivizr', TMM_THEME_URI . '/admin/theme_options/js/selectivizr-and-extra-selectors.min.js', array('jquery'));
		}

		if (is_rtl()) {
			wp_enqueue_style("tmm_admin_rtl", TMM_THEME_URI . '/admin/css/rtl.css');
		}

		global $pagenow;

		if($pagenow == 'widgets.php'){

			wp_enqueue_script('tmm_editor_widget', TMM_THEME_URI . '/admin/js/editorWidget.js', array('jquery'), false, true);
			add_action( 'widgets_admin_page','output_wp_editor_widget_html', 100 );

		}

	}
}

if (!function_exists('output_wp_editor_widget_html')){
	function output_wp_editor_widget_html() {

		?>
		<div id="tmm-editor-widget-container"  class="" style="display: none;">

			<div class="tmm-popup-header">
				<h3 class="tmm-popup-title"><?php esc_attr_e( 'Widget Editor', 'diplomat' ); ?></h3>
				<a class="tmm-popup-close" href="javascript:TMM_EDITOR_WIDGET.hideEditor();">X</a>
			</div>

			<div class="editor">
				<?php
				$settings = array(
					'textarea_rows' => 60,
					'editor_height'    => 360,
				);
				wp_editor( '', 'tmm_editorwidget', $settings );
				?>

			</div>
			<div class="tmm-popup-footer">
				<a href="javascript:TMM_EDITOR_WIDGET.updateWidgetAndCloseEditor(true);" class="button button-primary tmm-save"><?php _e( 'Apply', 'diplomat' ); ?></a>
				<a href="javascript:TMM_EDITOR_WIDGET.hideEditor();" class="button button-primary tmm-close"><?php _e( 'Close', 'diplomat' ); ?></a>
			</div>
		</div>
		<div id="tmm-editor-widget-backdrop" style="display: none;"></div>
	<?php

	}
}

add_action('admin_enqueue_scripts', 'tmm_admin_enqueue_scripts', 1);

if ( !function_exists('tmm_enqueue_script') ) {
	function tmm_enqueue_script($key) {
		wp_enqueue_script('tmm_' . $key);
	}
}

if ( !function_exists('tmm_enqueue_style') ) {
	function tmm_enqueue_style($key) {
		wp_enqueue_style('tmm_' . $key);
	}
}

/* ---------------------------------------------------------------------- */
/* 	Display Layout Content
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_layout_content') ) {
	function tmm_layout_content($post_id, $row_type = 'default') {
		if (class_exists('TMM_Content_Composer')) {
			TMM_Content_Composer::the_layout_content($post_id, $row_type);
		}
	}
}

/* ---------------------------------------------------------------------- */
/* 	Filter Hooks for Categories List and Archives Link
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_modify_list_categories') ) {
	function tmm_modify_list_categories($output) {
		$output = str_replace('</a> (','</a><span>',$output);
		$output = str_replace(')','</span>',$output);
		return $output;
	}
}
add_filter('wp_list_categories', 'tmm_modify_list_categories');

if ( !function_exists('tmm_modify_archives_link') ) {
	function tmm_modify_archives_link($output) {
		$output = str_replace('</a>&nbsp;(','</a><span>',$output);
		$output = str_replace(')','</span>',$output);
		return $output;
	}
}
add_filter('get_archives_link', 'tmm_modify_archives_link');

/* ---------------------------------------------------------------------- */
/* 	Install and Activate Required Plugins
/* ---------------------------------------------------------------------- */

if ( !function_exists('tmm_get_plugins') ) {
	function tmm_get_plugins() {
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		return array(

			/* This is an example of how to include a plugin pre-packaged with a theme.
			array(
				'name'               => 'TGM Example Plugin', // The plugin name.
				'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
				'source'             => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			),
			*/

			array(
				'name'               => 'ThemeMakers '.TMM_THEME_NAME.' Features',
				'slug'               => 'tmm_theme_features',
				'source'             => 'https://github.com/ThemeMakers/tmm_theme_features/archive/diplomat_v1.0.3.zip',
				'required'           => true,
				'force_activation'   => true,
				'force_deactivation' => true,
				'version'           => '1.0.3',
			),
			array(
				'name'               => 'ThemeMakers DB Migrate',
				'slug'               => 'tmm_db_migrate',
				'source'             => 'https://github.com/ThemeMakers/tmm_db_migrate/archive/diplomat_v2.0.4.zip',
				'required'           => false,
				'version'           => '2.0.4',
			),
			array(
				'name'               => 'ThemeMakers Visual Content Composer',
				'slug'               => 'tmm_content_composer',
				'source'             => 'https://github.com/ThemeMakers/tmm_content_composer/archive/diplomat_v1.1.0.zip',
				'required'           => true,
				'version'           => '1.1.0',
			),
			array(
				'name'               => 'ThemeMakers Events',
				'slug'               => 'tmm_events_calendar',
				'source'             => 'https://github.com/ThemeMakers/tmm_events_calendar/archive/diplomat_v1.0.8.zip',
				'required'           => false,
				'version'           => '1.0.8',
			),
			array(
				'name'               => 'Seamless Donations',
				'slug'               => 'seamless-donations',
				'source'             => 'https://downloads.wordpress.org/plugin/seamless-donations.4.0.19.zip',
				'required'           => false,
				'version'           => '4.0.19',
			),
			array(
				'name'               => 'Envato WordPress Toolkit',
				'slug'               => 'envato-wordpress-toolkit-master',
				'source'             => 'https://github.com/envato/envato-wordpress-toolkit/archive/master.zip',
				'required'           => false,
				'version'           => '1.7.3',
			),
			array(
				'name'               => 'Arqam',
				'slug'               => 'arqam',
				'source'             => 'http://plugins.webtemplatemasters.com/plugins/diplomat/arqam.zip',
				'required'           => false,
				'version'           => '2.0.3',
			),
			array(
				'name'               => 'bbPress',
				'slug'               => 'bbpress',
				'source'             => 'https://downloads.wordpress.org/plugin/bbpress.2.5.10.zip',
				'required'           => false,
				'version'           => '2.5.10',
			),
			array(
				'name'               => 'LayerSlider',
				'slug'               => 'LayerSlider',
				'source'             => 'http://plugins.webtemplatemasters.com/plugins/diplomat/ls-diplomat_v5.6.9.zip',
				'required'           => false,
				'version'           => '5.6.9',
			),

		);

	}
}

if ( !function_exists('tmm_register_required_plugins') ) {
	function tmm_register_required_plugins() {

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'default_path' => '', // Default absolute path to pre-packaged plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => true,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			'strings'      => array(
//				'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
//				'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
//				'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
//				'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
//				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
//				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
//				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
//				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
//				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
//				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
//				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
//				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
//				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
//				'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
//				'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
//				'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
//				'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
				'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
		);

		$plugins = tmm_get_plugins();
		tgmpa( $plugins, $config );
	}
}

if ( !function_exists('tmm_check_plugin_updates') ) {
	function tmm_check_plugin_updates() {
		$plugins = tmm_get_plugins();
		TMM_Plugin_Update_Checker::init($plugins);
	}
}

add_action( 'tgmpa_register', 'tmm_register_required_plugins', 10 );
add_action( 'admin_init', 'tmm_check_plugin_updates', 10 );

/**
 * Dismiss admin notices (by ajax)
 */
function tmm_dismiss_notice() {
	if (isset($_POST['type'])) {
		$type = explode(' ', $_POST['type']);
		$notice = '';

		foreach ($type as $v) {
			if (strpos($v, '-notice') !== false) {
				$notice = trim($v);
				break;
			}
		}

		if ($notice) {
			update_option('tmm_dismiss_'.$notice, 1);
		}
		exit;

	}
}
