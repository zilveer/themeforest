<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */

// -----------------------------------------------------------------------------

/**
 * Build
 *
 * 0 - 1.0
 * 1 - 1.1
 * 2 - 1.2
 * 3 - 1.3
 * 4 - 1.4
 * 5 - 1.5
 * 6 - 1.6
 * 7 - 1.7
 */
define('FASTBLOG_BUILD', 7);

// -----------------------------------------------------------------------------

/**
 * Developer version
 */
define('FASTBLOG_DEV_VERSION', false);

// -----------------------------------------------------------------------------

/**
 * Update URL
 */
define('FASTBLOG_UPDATE_URL', 'http://themes.kubasto.com/update.php');

// -----------------------------------------------------------------------------

/**
 * Featured image
 */
define('FASTBLOG_THUMB_WIDTH', 678);
define('FASTBLOG_THUMB_TUMBLOG_WIDTH', 528);
define('FASTBLOG_THUMB_TUMBLOG_HEIGHT', 297);

// -----------------------------------------------------------------------------

/**
 * Bit.ly
 */
define('FASTBLOG_BITLY_LOGIN', 'kubasto');
define('FASTBLOG_BITLY_API_KEY', 'R_d87e42d7d90b45d3a1618437ae1fc11e');

// -----------------------------------------------------------------------------

/**
 * Flickr
 */
define('FASTBLOG_FLICKR_API_KEY', '6baa65d21a4e4139d5e2f1b4943dcb2e');

// -----------------------------------------------------------------------------

/**
 * WooTumblog
 */
define('FASTBLOG_TUMBLOG', function_exists('WooTumblogInit'));
define('FASTBLOG_TUMBLOG_DIR', WP_PLUGIN_URL.'/woo-tumblog');
define('FASTBLOG_TUMBLOG_CONTENT_TAXONOMY', get_option('woo_tumblog_content_method') === 'taxonomy');
define('FASTBLOG_TUMBLOG_PLAYER_HEIGHT', 32);

// -----------------------------------------------------------------------------

/**
 * Comment walker
 */
class Fastblog_Walker_Comment extends Walker_Comment
{

	// ---------------------------------------------------------------------------

	function start_lvl(&$output, $depth = 0, $args = array()) { }
	function end_lvl(&$output, $depth = 0, $args = array()) { }
	function end_el(&$output, $comment, $depth = 0, $args = array()) { }

	// ---------------------------------------------------------------------------

	/**
	 * Comment list element start
	 *
	 * @param string $output
	 * @param object $comment
	 * @param int $depth
	 * @param array $args
	 */
	function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0)
	{
		$depth++;
		$GLOBALS['comment'] = $comment;
		$GLOBALS['comment_depth'] = $depth;
		require get_template_directory().'/comment.php';
	}

}

// -----------------------------------------------------------------------------

/**
 * Default options
 */
$fastblog_options_defaults = array(
	'_build'       => FASTBLOG_BUILD,
	'_update_data' => array(),
	'scheme'       => 'dark-azure',
	'favicon'      => '',
	'sidebar'      => 'right',
	'tagline'      => 1,
	'search'       => 1,
	'fancybox'     => 1,
	'custom_css'   => '',
	'custom_js'    => '',
	'footer'       => '',
	'feed'         => '',
	'analytics'    => '',
	'header' => array(
		'height'  => 65,
		'logo'    => array(
			'logo'   => get_bloginfo('name'),
			'center' => false
		),
		'contact' => '<a href="mailto:'.get_option('admin_email').'">'.get_option('admin_email').'</a>'
	),
	'menu' => array(
		'content' => array('main' => 'pages', 'footer' => 'categories')
	),
	'post' => array(
		'hide_title'        => 0,
		'about'             => 0,
		'meta'              => array('date' => 1, 'category' => 0, 'comments' => 1, 'author' => 0, 'short_url' => 1, 'tags' => 1, 'admin_edit' => 1),
		'disable_short_url' => 0
	),
	'page' => array(
		'hide_title' => 0,
		'meta'       => array('date' => 1, 'comments' => 1, 'admin_edit' => 1)
	),
	'typography' => array(
		'fonts' => array(
			'logo'         => 'league_gothic.font.js|League Gothic',
			'tagline'      => '',
			'menu'         => 'myriad_pro.medium.font.js|Myriad Pro (extended glyphs)',
			'post_title'   => 'myriad_pro.medium.font.js|Myriad Pro (extended glyphs)',
			'widget_title' => '',
			'headlines'    => 'myriad_pro.medium.font.js|Myriad Pro (extended glyphs)',
			'shortcode'    => 'myriad_pro.medium.font.js|Myriad Pro (extended glyphs)',
			'other'        => 'myriad_pro.medium.font.js|Myriad Pro (extended glyphs)',
			'custom'       => ''
		),
		'custom_selector' => ''
	),
	'contact_form' => array(
		'email'       => get_option('admin_email'),
		'subject'     => '[%blogname%] %subject%',
		'from_header' => 1
	),
	'fancybox' => array(
		'enabled'    => 1,
		'show_title' => 0
	),
	'bitly' => array(
		'login'   => '',
		'api_key' => ''
	)
);

// -----------------------------------------------------------------------------

/**
 * Schemes
 */
$fastblog_schemes = array(
	'bright-blue',
	'bright-gray',
	'bright-green',
	'bright-orange',
	'bright-pink',
	'bright-red',
	'dark-azure',
	'dark-green',
	'dark-red',
	'dark-violet',
	'dark-white',
	'dark-yellow'
);

// -----------------------------------------------------------------------------

/**
 * Themne setup
 */
function fastblog_after_setup_theme()
{

	// Localization
	load_theme_textdomain('fastblog', get_template_directory().'/languages');

	// Options
	global $fastblog_options, $fastblog_options_defaults;
	$fastblog_options = tb_get_theme_options('fastblog', $fastblog_options_defaults, 'fastblog_compatibility');

	// Theme supports
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails', array('post', 'page'));

	// Post thumbnails
	add_image_size('post-thumbnail',         FASTBLOG_THUMB_WIDTH,         9999);
	add_image_size('post-thumbnail-tumblog', FASTBLOG_THUMB_TUMBLOG_WIDTH, 9999);

	// Theme features
	tb_add_theme_feature('query_vars', 'scheme');
	tb_add_theme_feature('nav_menu_current_item');
	tb_add_theme_feature('img_caption_shortcode_fixed_width');
	tb_add_theme_feature('ogp');

	// Navigation menu
	register_nav_menus(array('nav-menu-main'   => __('Main navigation menu', 'fastblog')));
	register_nav_menus(array('nav-menu-footer' => __('Footer navigation menu', 'fastblog')));

	// Sidebar
	register_sidebar(array(
		'name'          => __('Sidebar', 'fastblog'),
		'id'            => 'sidebar',
		'before_widget' => '<li id="%1$s" class="%2$s">',
		'after_widget'  => '<div class="clear"></div></li>',
		'before_title'  => '<h3 class="title">',
		'after_title'   => '</h3>',
	));

	// Shortcodes
	add_shortcode('box', 'fastblog_shortcode_box');
	add_shortcode('line', 'fastblog_shortcode_line');
	add_shortcode('hr', 'fastblog_shortcode_line');
	add_shortcode('mark', 'fastblog_shortcode_mark');
	add_shortcode('column', 'fastblog_shortcode_column');
	add_shortcode('cufon', 'fastblog_shortcode_cufon');
	add_shortcode('clear', 'fastblog_shortcode_clear');

	// Actions
	add_action('wp', 'fastblog_wp');
	add_action('widgets_init', 'fastblog_widgets_init');
	add_action('admin_menu', 'fastblog_admin_menu');
	add_action('save_post', 'fastblog_save_post');
	add_action('wp_ajax_nopriv_fastblog_contact_form', 'fastblog_wp_ajax_contact_form');
	add_action('wp_ajax_fastblog_contact_form', 'fastblog_wp_ajax_contact_form');

	// Filters
	add_filter('the_password_form', 'fastblog_the_password_form');
	add_filter('widget_text', 'do_shortcode');
	if (fastblog_get_option('feed')) add_filter('feed_link', 'fastblog_feed_link', 10, 2);

}

// -----------------------------------------------------------------------------

/**
 * WordPress
 */
function fastblog_wp()
{
	global $fastblog_options, $fastblog_schemes;
	if ((!is_admin()) && is_active_widget(false, false, 'fastblog_schemeswitcher')) {
		$cookie_name = tb_get_cookie_name('fastblog_scheme');
		$cookie_time = 30;
		if ($query_var_scheme = get_query_var('scheme')) {
			$scheme = $query_var_scheme;
		} else if (isset($_COOKIE[$cookie_name])) {
			$scheme = $_COOKIE[$cookie_name];
		} else {
			$scheme = fastblog_get_option('scheme');
		}
		if (in_array($scheme, $fastblog_schemes)) {
			$fastblog_options['scheme'] = $scheme;
			setcookie($cookie_name, $scheme, time()+$cookie_time*86400, COOKIEPATH, COOKIE_DOMAIN);
		}
	}
}

// -----------------------------------------------------------------------------

/**
 * Widget init
 */
function fastblog_widgets_init()
{
	unregister_widget('WP_Widget_Search');
	register_widget('FastBlog_Twitter');
	register_widget('FastBlog_Flickr');
	register_widget('FastBlog_Socialmedia');
	register_widget('FastBlog_SchemeSwitcher');
}

// -----------------------------------------------------------------------------

/**
 * Admin menu
 */
function fastblog_admin_menu()
{

	// Theme options menu
	$theme_page = add_theme_page(__('Fast Blog Options', 'fastblog'), __('Theme Options', 'fastblog'), 'edit_theme_options', 'fastblog-options', 'fastblog_options');
	tb_add_theme_feature('admin_styles_and_scripts', $theme_page);

	// Settings
	register_setting('fastblog_options',         'fastblog',         'fastblog_validate');
	register_setting('fastblog_widgets_options', 'fastblog_widgets', 'fastblog_widgets_validate');

}

// -----------------------------------------------------------------------------

/**
 * Save post
 *
 * @param integer $post_id
 * @return integer
 */
function fastblog_save_post($post_id)
{
	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
	if (
		(get_post_type($post_id) == 'post') && ini_get('allow_url_fopen') &&
		(fastblog_get_option('post/meta/short_url') || (!fastblog_get_option('post/disable_short_url')))
	)
	{
		$last_permalink = get_post_meta($post_id, '_fastblog_last_permalink', true);
		$permalink = get_permalink($post_id);
		if ($permalink != $last_permalink) {
			if (!preg_match('#^https?://(localhost|127\.0\.0\.1|192\.168\.)#i', $permalink)) {
				$login   = fastblog_get_option('bitly/login');
				$api_key = fastblog_get_option('bitly/api_key');
				if (empty($login) || empty($api_key)) {
					$login   = FASTBLOG_BITLY_LOGIN;
					$api_key = FASTBLOG_BITLY_API_KEY;
				}
				$bitly_url =
					'http://api.bit.ly/v3/shorten?'.
					'login='.$login.'&'.
					'apiKey='.$api_key.'&'.
					'longUrl='.urlencode($permalink).'&'.
					'format=txt';
				$short_url = @file_get_contents($bitly_url);
			} else {
				$short_url = false;
			}
			tb_update_post_meta($post_id, array(
				'last_permalink' => $short_url === false ? '' : $permalink,
				'short_url'      => $short_url === false ? '' : trim($short_url)
			), '_fastblog_');
		}
	}
	return $post_id;
}

// -----------------------------------------------------------------------------

/**
 * Protected post password form
 *
 * @param string $output
 * @return string
 */
function fastblog_the_password_form($output)
{
	global $post;
	$label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
	$output =
		'<form action="'.get_option('siteurl').'/wp-login.php?action=postpass" method="post">'.
			'<p>'.__('This post is password protected. To view it please enter your password below:').'</p>'.
			'<p class="input" style="position: relative; float: left; top: 1px;"><input name="post_password" id="'.$label.'" type="password" /></p>'.
			'<p class="submit"><a title="'.esc_attr__('Submit').'">'.esc_attr__('Submit').'</a></p>'.
		'</form>';
	return $output;
}

// -----------------------------------------------------------------------------

/**
 * Contact form AJAX request
 */
function fastblog_wp_ajax_contact_form()
{
	function output($result, $message)
	{
		echo json_encode(array('result' => $result, 'message' => $message));
		exit;
	}
	foreach (array('author', 'email', 'subject', 'message') as $field) {
		${$field} = isset($_POST[$field]) ? trim(strip_tags($_POST[$field])) : '';
	}
	if (empty($author)) {
		output(false, __('Please enter your name.', 'fastblog'));
	} else if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/i', $email)) {
		output(false, __('Invalid email address.', 'fastblog'));
	} else if (strlen($message) < 3) {
		output(false, __('Please write your comment.', 'fastblog'));
	}
	$admin_email = get_option('admin_email');
	$author = wp_specialchars_decode($author, ENT_QUOTES);
	$subject = trim(str_replace(array("\r", "\n"), ' ', $subject));
	$subject = wp_specialchars_decode(str_replace(array(
		'%blogname%',
		'%blogurl%',
		'%name%',
		'%email%',
		'%subject%'
	), array(
		get_bloginfo('name'),
		home_url(),
		$author,
		$email,
		$subject
	), fastblog_get_option('contact_form/subject')));
	$message .= "\r\n\r\n---\r\n{$author}\r\n{$email}";
	$result = @wp_mail
	(
		fastblog_get_option('contact_form/email'),
		$subject,
		$message,
		(fastblog_get_option('contact_form/from_header') ? "From: \"{$author}\" <{$admin_email}>\r\n" : '').
		"Reply-to: {$email}\r\n".
		"Content-type: text/plain; charset=\"".get_bloginfo('charset')."\"\r\n"
	);
	if ($result) {
		output(true, __('Message sent.', 'fastblog'));
	} else {
		output(false, __("Error occured. Message couldn't be sent.", 'fastblog'));
	}
	exit;
}

// -----------------------------------------------------------------------------

/**
 * Admin panel's form
 */
function fastblog_options()
{
	require get_template_directory().'/options.php';
}

// -----------------------------------------------------------------------------

/**
 * Settings data validation
 *
 * @param array $data
 * @return array
 */
function fastblog_validate($data)
{
	global $fastblog_options, $fastblog_options_defaults;
	$data = tb_array_map('tb_trim_string', $data);
	$data['_build'] = FASTBLOG_BUILD;
	$data['_update_data'] = $fastblog_options['_update_data'];
	$data['header']['height'] = tb_range($data['header']['height'], 20);
	$data['header']['logo']['center'] = (integer)(isset($data['header']['logo']['center']) && $data['header']['logo']['center']);
	$data['tagline'] = (integer)(isset($data['tagline']) && $data['tagline']);
	$data['search'] = (integer)(isset($data['search']) && $data['search']);
	$data['post']['hide_title'] = (integer)(isset($data['post']['hide_title']) && $data['post']['hide_title']);
	$data['post']['about'] = (integer)(isset($data['post']['about']) && $data['post']['about']);
	$data['post']['meta'] = tb_set_default($data['post']['meta'], $fastblog_options_defaults['post']['meta']);
	$data['post']['disable_short_url'] = (integer)(isset($data['post']['disable_short_url']) && $data['post']['disable_short_url']);
	$data['page']['hide_title'] = (integer)(isset($data['page']['hide_title']) && $data['page']['hide_title']);
	$data['page']['meta'] = tb_set_default($data['page']['meta'], $fastblog_options_defaults['page']['meta']);
	$data['contact_form']['from_header'] = (integer)(isset($data['contact_form']['from_header']) && $data['contact_form']['from_header']);
	$data['fancybox']['enabled'] = (integer)(isset($data['fancybox']['enabled']) && $data['fancybox']['enabled']);
	$data['fancybox']['show_title'] = (integer)(isset($data['fancybox']['show_title']) && $data['fancybox']['show_title']);
	return $data;
}

// -----------------------------------------------------------------------------

/**
 * Widgets settings data validation
 *
 * @param array $data
 * @return array
 */
function fastblog_widgets_validate($data)
{
	return $data;
}

// -----------------------------------------------------------------------------

/**
 * Options compatibility check
 *
 * @param array $options
 * @return array
 */
function fastblog_compatibility($options)
{
	if ($options['_build'] < 1) {
		if (isset($options['logo'])) {
			$options['header']['logo'] = $options['logo'];
		}
		if (isset($options['contact'])) {
			$options['header']['contact'] = $options['contact'];
		}
	}
	if ($options['_build'] < 2) {
		if (isset($options['cufon']) && is_string($options['cufon'])) {
			$options['cufon'] = array('font' => "myriad_pro.{$options['cufon']}.font.js");
		}
	}
	if ($options['_build'] < 3) {
		if (isset($options['cufon']['font']) && ($fontfamily = tb_cufon_font_get_name(get_template_directory().'/js/fonts/'.$options['cufon']['font']))) {
			$font = $options['cufon']['font'].'|'.$fontfamily;
			$options['typography']['fonts'] = array(
				'logo'         => 'league_gothic.font.js|League Gothic',
				'tagline'      => '',
				'menu'         => $font,
				'post_title'   => $font,
				'widget_title' => '',
				'headlines'    => $font,
				'shortcode'    => $font,
				'other'        => $font,
				'custom'       => ''
			);
		}
		if (isset($options['cufon']['selector'])) {
			$options['typography']['custom_selector'] = $options['cufon']['selector'];
		}
	}
	if ($options['_build'] < 4) {
		if (isset($options['fancybox'])) {
			$options['fancybox'] = array('enabled' => $options['fancybox']);
		}
	}
	if ($options['_build'] < 6) {
		if (isset($options['header']['logo']) && is_string($options['header']['logo'])) {
			$options['header']['logo'] = array('logo' => $options['header']['logo']);
		}
	}
	return $options;
}

// -----------------------------------------------------------------------------

/**
 * Save theme update data
 *
 * @param array $update_data
 * @return boolean
 */
function fastblog_theme_update($update_data)
{
	global $fastblog_options;
	$fastblog_options['_update_data'] = $update_data;
	return update_option('fastblog', $fastblog_options);
}

// -----------------------------------------------------------------------------

/**
 * Navigation menu
 *
 * @param string $content
 * @param integer $depth
 */
function fastblog_nav_menu($content, $depth = 0)
{
	if ($content) {
		echo '<ul>';
		call_user_func('wp_list_'.$content, array('title_li' => '', 'depth' => $depth));
		echo '</ul>';
	}
}

// -----------------------------------------------------------------------------

/**
 * Alternative feed URL
 *
 * @param string $output
 * @param string $feed
 * @return string
 */
function fastblog_feed_link($output, $feed)
{
	return stripos($output, 'comments') === false ? fastblog_get_option('feed') : $output;
}

// -----------------------------------------------------------------------------

/**
 * Box shortcode
 *
 * @param array $atts
 * @param string $content
 * @param string $code
 * @return string
 */
function fastblog_shortcode_box($atts, $content = null, $code = '')
{
	extract(shortcode_atts(array(
		'icon'  => 'none',
		'align' => 'left',
	), $atts));
	$style = $icon == 'none' ? '' : ' style="background-image: url('.get_template_directory_uri().'/images/icons/'.$icon.'.png);"';
	return
		'<div class="box">'.
			'<div class="icon icon-'.$icon.' '.$align.'"'.$style.'>'.
				tb_shortcode_content(do_shortcode($content)).
			'</div>'.
		'</div>';
}

// -----------------------------------------------------------------------------

/**
 * Line shortcode
 *
 * @param array $atts
 * @param string $content
 * @param string $code
 * @return string
 */
function fastblog_shortcode_line($atts, $content = null, $code = '')
{
	return '<div class="line"><div></div></div>';
}

// -----------------------------------------------------------------------------

/**
 * Mark shortcode
 *
 * @param array $atts
 * @param string $content
 * @param string $code
 * @return string
 */
function fastblog_shortcode_mark($atts, $content = null, $code = '')
{
	extract(shortcode_atts(array(
		'color' => '#ffed58'
	), $atts));
	return
		"<span class=\"mark\" style=\"background: {$color};\">".
			tb_shortcode_content(do_shortcode($content)).
		'</span>';
}

// -----------------------------------------------------------------------------

/**
 * Column shortcode
 *
 * @param array $atts
 * @param string $content
 * @param string $code
 * @return string
 */
function fastblog_shortcode_column($atts, $content = null, $code = '')
{
	extract(shortcode_atts(array(
		'type'    => '',
		'count'   => 2,
		'colspan' => 1,
		'last'    => ''
	), $atts));
	if (preg_match('|^([0-9]+)/([0-9]+)$|', $type, $matches)) {
		list(, $colspan, $count) = $matches;
	}
	$width = (100-($count-1)*2) * ($colspan / $count) + ($colspan-1)*2;
	$output =
		'<div class="column'.($last ? ' last' : '').'" style="width: '.$width.'%;">'.
			tb_shortcode_content(do_shortcode($content)).
		'</div>';
	if ($last) {
		$output .= '<div class="clear"></div>';
	}
	return $output;
}

// -----------------------------------------------------------------------------

/**
 * Cufon shortcode
 *
 * @param array $atts
 * @param string $content
 * @param string $code
 * @return string
 */
function fastblog_shortcode_cufon($atts, $content = null, $code = '')
{
	extract(shortcode_atts(array(
		'size'  => '',
		'class' => '',
		'style' => ''
	), $atts));
	if ($size) {
		if (!preg_match('/[0-9] *(em|ex|px|in|cm|mm|pt|pc|%)$/i', $size)) {
			$size .= 'px';
		}
		$style .= " font-size: {$size};";
	}
	$class = 'cufon-shortcode '.$class;
	return '<span class="'.trim($class).'" style="'.trim($style).'">'.$content.'</span>';
}

// -----------------------------------------------------------------------------

/**
 * Clear shortcode
 *
 * @param array $atts
 * @param string $content
 * @param string $code
 * @return string
 */
function fastblog_shortcode_clear($atts, $content = null, $code = '')
{
	extract(shortcode_atts(array(
		'tag' => 'span'
	), $atts));
	if ($tag == 'pre') {
		$content = preg_replace('#<br ?/?>#i', '', $content);
		$content = str_ireplace('<p>', "\n", $content);
		$content = str_ireplace('</p>', '', $content);
	}
	$content = str_replace(array('{', '}'), array('[', ']'), $content);
	$content = tb_shortcode_content($content);
	return "<{$tag}>{$content}</{$tag}>";
}

// -----------------------------------------------------------------------------

/**
 * Get theme option
 *
 * @param string|array $name
 * @param string $separator
 * @return mixed
 */
function fastblog_get_option($name, $separator = '/')
{
	global $fastblog_options;
	return tb_array_option($fastblog_options, $name, $separator);
}

// -----------------------------------------------------------------------------

/**
 * Print theme option
 *
 * @param string $name
 */
function fastblog_option($name)
{
	echo fastblog_get_option($name);
}

// -----------------------------------------------------------------------------

/**
 * Delete tumblog stylesheet
 *
 * @param string $html
 * @return string
 */
function fastblog_delete_tumblog_styles($html)
{
	return preg_replace('|<link.*tumblog_frontend_styles\.css.*/>|iu', '', $html);
}

// -----------------------------------------------------------------------------

/**
 * Post featured image
 */
function fastblog_post_thumbnail()
{
	if (!has_post_thumbnail()) return;
	list($src) = wp_get_attachment_image_src( get_post_thumbnail_id(), 'orginal');
	echo
		'<p>'.
			'<a href="'.$src.'">'.
				get_the_post_thumbnail(null, 'post-thumbnail'.(FASTBLOG_TUMBLOG ? '-tumblog' : ''), '').
			'</a>'.
		'</p>';
}

// -----------------------------------------------------------------------------

/**
 * Prepare tumblog content
 *
 * @param string $html
 * @param integer $width
 * @return string
 */
function fastblog_prepare_tumblog_content($html, $width)
{
	if (stripos($html, '<div class="quote">') === 0) {
		if (!preg_match('/<blockquote> *<p.*>.*<\/p> *<\/blockquote>/iu', str_replace(array("\r", "\n"), '', $html))) {
			return preg_replace('/(<blockquote>)(.*)(<\/blockquote>)/is', '\1<p>\2</p>\3', $html);
		}
	} else if (stripos($html, '<div class="audio">') === 0) {
		return preg_replace(array(
			'/" *, *"/',
			'/(SWFObject\(".*",".*",").*(",".*",".*"\))/iu',
			'/(addVariable\("(backcolor|frontcolor)",)"[a-f0-9]{6}"(\))/i'
		), array(
			'","',
			"\${1}{$width}\${2}",
			"\${1}scheme.mediaplayer.\${2}\${3}"
		), $html);
	} else if (stripos($html, '<div class="video">') === 0) {
		if (preg_match('/<div class="video">\s*(https?:\/\/.+\.(flv|mp4))\s*<\/div>/iu', $html, $matches)) {
			$id = get_the_ID();
			$video_file = $matches[1];
			if (($featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'post-thumbnail-tumblog')) !== false) {
				list($video_image, $video_width, $video_height) = $featured_image;
			} else {
				$video_image  = get_template_directory_uri().'/schemes/'.fastblog_get_option('scheme').'/images/player.png';
				$video_width  = FASTBLOG_THUMB_TUMBLOG_WIDTH;
				$video_height = FASTBLOG_THUMB_TUMBLOG_HEIGHT;
			}
			$jwplayer =
				'<div id="mediaspace'.$id.'"></div>'.
				'<script type="text/javascript">'.
					"var so = new SWFObject('".FASTBLOG_TUMBLOG_DIR."/functions/player.swf', 'mpl{$id}', '{$video_width}', '".($video_height+FASTBLOG_TUMBLOG_PLAYER_HEIGHT)."', '9');".
					"so.addParam('allowfullscreen', 'true');".
					"so.addParam('allowscriptaccess', 'always');".
					"so.addParam('wmode', 'opaque');".
					"so.addVariable('skin', '".FASTBLOG_TUMBLOG_DIR."/functions/stylish_slim.swf');".
					"so.addVariable('file', '{$video_file}');".
					"so.addVariable('image', '{$video_image}');".
					"so.addVariable('backcolor', scheme.mediaplayer.backcolor);".
					"so.addVariable('frontcolor', scheme.mediaplayer.frontcolor);".
					"so.write('mediaspace{$id}');".
				'</script>';
			return str_replace($matches[0], $jwplayer, $html);
		} else {
			/*
			if (preg_match_all('/(width|height)=["\']([0-9]+)["\']/i', $html, $matches) >= 2) {
				for ($i = 0; $i < 2; $i++) {
					$embed[$matches[1][$i]] = intval($matches[2][$i]);
				}
				if (count($embed) == 2) {
					$ratio = $embed['height'] / $embed['width'];
					$height = round($width*$ratio);
					$html = str_replace($matches[0], array('width="'.$width.'"', 'height="'.$height.'"'), $html);
				}
			}
			*/
			if (is_single() && preg_match('#http://www\.youtube\.com/(v|embed)/([a-z0-9]+)#i', $html, $matches)) {
				$html .= '<div class="youtube-thumbnails">';
				for ($i = 3; $i >= 1; $i--) {
					$html .= '<img src="http://img.youtube.com/vi/'.$matches[2].'/'.$i.'.jpg" alt="" />';
				}
				$html .= '</div>';
			}
			return $html;
		}
	}
	return $html;
}

// -----------------------------------------------------------------------------

/**
 * WordPress header
 */
function fastblog_wp_head()
{
	if ($custom_js = fastblog_get_option('custom_js')) {
		$custom_js = "<script type=\"text/javascript\">\n/* <![CDATA[ */\n{$custom_js}\n/* ]]> */\n</script>\n";
	}
	ob_start();
	wp_head();
	$wp_head = ob_get_clean();
	echo
		fastblog_delete_tumblog_styles($wp_head)."\n".
		$custom_js.
		fastblog_get_option('analytics');
}


// -----------------------------------------------------------------------------

/**
 * Display HTML list of WooTumblog tumblogs
 *
 * @param string|array $args
 */
function wp_list_tumblog($args = '')
{
	if (!(FASTBLOG_TUMBLOG && FASTBLOG_TUMBLOG_CONTENT_TAXONOMY && is_array($terms = get_terms('tumblog')))) {
		return wp_list_categories($args);
	}
	global $wp_query;
	$current_object_id = $wp_query->get_queried_object_id();
	$output = '';
	foreach ($terms as $term) {
		echo
			'<li class="tumblog-item tumblog-item-'.$term->term_id.($term->term_id == $current_object_id ? ' current' : '').'">'.
				'<a href="'.get_term_link($term, 'tumblog').'" title="'.$term->name.'">'.$term->name.'</a>'.
			"</li>\n";
	}
}

// -----------------------------------------------------------------------------

require_once get_template_directory().'/toolbox.php';
require_once get_template_directory().'/widgets.php';

// -----------------------------------------------------------------------------

add_action('after_setup_theme', 'fastblog_after_setup_theme');