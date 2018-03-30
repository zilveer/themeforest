<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


# WooCommerce Styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


# Page Title optimized for better seo
add_filter('wp_title', 'filter_wp_title');

function filter_wp_title( $title )
{
	global $page, $paged;

	$separator = '-';

	if ( is_feed() )
		return $title;

	$site_description = get_bloginfo( 'description' );

	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' '.$separator.' ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' '.$separator.' ' . sprintf( __( 'Page %s', 'aurum'), max( $paged, $page ) ) : '';

	return $filtered_title;
}


# Add Do-shortcode for text widgets
add_filter('widget_text', 'widget_text_do_shortcodes');

function widget_text_do_shortcodes($text)
{
	return do_shortcode($text);
}



# Date Shortcode
if( ! shortcode_exists('date'))
{
	add_shortcode('date', 'laborator_shortcode_date');
}

function laborator_shortcode_date($atts = array(), $content = '')
{
	return date_i18n(get_option('date_format'));
}




# Shortcode for Social Networks [lab_social_networks]
add_shortcode('lab_social_networks', 'shortcode_lab_social_networks');

function shortcode_lab_social_networks($atts = array(), $content = '')
{
	$social_order = get_data('social_order');

	$social_order_list = array(
		'fb'  => array('title' => __('Facebook', 'aurum'), 		'icon' => 'fa fa-facebook'),
		'tw'  => array('title' => __('Twitter', 'aurum'), 		'icon' => 'fa fa-twitter'),
		'lin' => array('title' => __('LinkedIn', 'aurum'), 		'icon' => 'fa fa-linkedin'),
		'yt'  => array('title' => __('YouTube', 'aurum'), 		'icon' => 'fa fa-youtube'),
		'vm'  => array('title' => __('Vimeo', 'aurum'), 		'icon' => 'fa fa-vimeo'),
		'drb' => array('title' => __('Dribbble', 'aurum'), 		'icon' => 'fa fa-dribbble'),
		'ig'  => array('title' => __('Instagram', 'aurum'), 	'icon' => 'fa fa-instagram'),
		'pi'  => array('title' => __('Pinterest', 'aurum'), 	'icon' => 'fa fa-pinterest'),
		'gp'  => array('title' => __('Google+', 'aurum'), 		'icon' => 'fa fa-google-plus'),
		'vk'  => array('title' => __('VKontakte', 'aurum'), 	'icon' => 'fa fa-vk'),
		'sc'  => array('title' => __('SoundCloud', 'aurum'), 	'icon' => 'fa fa-soundcloud'),
		'tb'  => array('title' => __('Tumblr', 'aurum'), 		'icon' => 'fa fa-tumblr'),
		'rs'  => array('title' => __('RSS', 'aurum'), 			'icon' => 'fa fa-rss'),
		'sn'  => array('title' => __('Snapchat', 'aurum'), 		'icon' => 'fa fa-snapchat-ghost'),
	);


	$html = '<ul class="social-networks">';

	foreach($social_order['visible'] as $key => $title)
	{
		if($key == 'placebo')
			continue;

		$sn = $social_order_list[$key];


		$html .= '<li>';
			$html .= '<a href="'.get_data("social_network_link_{$key}").'" title="'.$title.'" target="_blank">';
				$html .= '<i class="'.$sn['icon'].'"></i>';
			$html .= '</a>';
		$html .= '</li>';
	}

	$html .= '</ul>';


	return $html;

}




# Excerpt Length & More
add_filter('excerpt_length', 'laborator_default_excerpt_length');
add_filter('excerpt_more', 'laborator_default_excerpt_more');

function laborator_default_excerpt_length()
{
	return 75;
}

function laborator_small_excerpt_length()
{
	return 35;
}

function laborator_default_excerpt_more()
{
	return "&hellip;";
}


# Laborator Theme Options Translate
add_filter('admin_menu', 'laborator_add_menu_classes', 100);

function laborator_add_menu_classes($items)
{
	global $submenu;

	foreach($submenu as $menu_id => $sub)
	{
		if($menu_id == 'laborator_options')
		{
			$submenu[$menu_id][0][0] = __('Theme Options', 'aurum');
		}
	}

	return $submenu;
}


# Post Class
add_filter('post_class', 'laborator_post_class');

function laborator_post_class($classes)
{
	if(is_single() && ! get_data('blog_single_thumbnails'))
		$classes[] = 'no-thumbnail';
	elseif( ! is_single() && ! get_data('blog_thumbnails'))
		$classes[] = 'no-thumbnail';

	return $classes;
}



# Comments list
function laborator_list_comments_open($comment, $args, $depth)
{
	global $post, $wpdb, $comment_index;

	$comment_ID 			= $comment->comment_ID;
	$comment_author 		= $comment->comment_author;
	$comment_author_url		= $comment->comment_author_url;
	$comment_author_email	= $comment->comment_author_email;
	$comment_date 			= $comment->comment_date;
	$comment_parent_ID 		= $comment->comment_parent;

	$avatar					= preg_replace("/\s?(height='[0-9]+'|width='[0-9]+')/", "", get_avatar($comment));

	$comment_time 			= strtotime($comment_date);
	$comment_timespan 		= human_time_diff($comment_time, time());

	$link 					= '<a href="' . $comment_author_url . '" target="_blank">';

	$comment_classes = array();

	if($depth > 3)
		$comment_classes[] = 'col-md-offset-3';
	elseif($depth > 2)
		$comment_classes[] = 'col-md-offset-2';
	elseif($depth > 1)
		$comment_classes[] = 'col-md-offset-1';


	# In reply to Get
	$parent_comment = null;

	if($comment_parent_ID)
	{
		$parent_comment = get_comment($comment_parent_ID);
	}
	?>
	<div <?php comment_class(implode(' ', $comment_classes)); ?> id="comment-<?php echo $comment_ID; ?>"<?php echo $depth > 1 ? " data-replied-to=\"comment-{$comment_parent_ID}\"" : ''; ?>>
		<?php if($depth > 1): ?>
		<?php endif; ?>

		<div class="avatar">
			<?php echo $avatar; ?>
		</div>

		<h4>
			<?php echo $comment_author_url ? ($link . $comment_author . '</a>') : $comment_author; ?>
			<small>
				<?php echo date_i18n("F d, Y - H:i", $comment_time); ?>
				<?php if($parent_comment): ?>
				<span<?php echo $depth <= 4 ? ' class="visible-xs-inline visible-sm-inline"' : ''; ?>>&ndash; <?php echo sprintf(__('In reply to: <span class="replied-to">%s</span>', 'aurum'), $parent_comment->comment_author); ?></span>
				<?php endif; ?>
			</small>
		</h4>

		<div class="comment-content">
			<div class="post-formatting"><?php comment_text(); ?></div>
		</div>

		<?php
			comment_reply_link(
				array_merge(
					$args,
					array(
						'reply_text' => __('<span>Reply</span>', 'aurum'),
						'depth' => $depth,
						'max_depth' => $args['max_depth'],
						'before' => ''
					)
				),
				$comment,
				$post
			);
		?>
	</div>
	<?php
}

function laborator_list_comments_close()
{
}



# Render Comment Fields
function laborator_comment_fields($fields)
{
	foreach($fields as $field_type => $field_html)
	{
		preg_match("/<label(.*?)>(.*?)<\/label>/", $field_html, $html_label);
		preg_match("/<input(.*?)\/>/", $field_html, $html_input);

		$html_label = strip_tags($html_label[2]);
		$html_input = $html_input[0];


		$html_input = str_replace("<input", '<input class="form-control" placeholder="'.esc_attr($html_label).'" ', $html_input);
		$html_label = str_replace('*', '<span class="red">*</span>', $html_label);

		$cols = in_array($field_type, array('author', 'email')) ? 6 : 12;

		$fields[$field_type] = '
		<div class="col-md-' . $cols . '">
			<div class="form-group">' . $html_input . '</div>
		</div>
		';
	}


	return $fields;
}

function laborator_comment_before_fields()
{
	echo '<div class="row">';
}

function laborator_comment_after_fields()
{
	echo '</div>';
}


# Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'laborator_css_classes_for_vc', 10, 2);

function laborator_css_classes_for_vc($class_string, $tag)
{
	global $atts_values;


	if($tag == 'vc_row' || $tag == 'vc_row_inner')
	{
		$class_string = str_replace(array('wpb_row vc_row-fluid'), array('row'), $class_string);
	}
	elseif($tag == 'vc_column' || $tag == 'vc_column_inner')
	{
		if(preg_match("/vc_span(\d+)/", $class_string, $matches))
		{
			$span_columns = $matches[1];

			$col_type = $tag == 'vc_column' ? 'sm' : 'md';

			$class_string = str_replace($matches[0], "col-{$col_type}-{$span_columns}", $class_string);
		}
	}
	elseif($tag == 'vc_tabs')
	{

	}

	return $class_string;
}



# Testimonial Thumbnail
if(function_exists('add_theme_support'))
{
	add_filter('manage_posts_columns', 'laborator_testimonial_featured_image_column', 5);
	add_filter('manage_pages_columns', 'laborator_testimonial_featured_image_column', 5);

	add_action('manage_posts_custom_column', 'laborator_testimonial_featured_image_column_content', 5, 2);
	add_action('manage_pages_custom_column', 'laborator_testimonial_featured_image_column_content', 5, 2);
}
function laborator_testimonial_featured_image_column($columns)
{
	if(lab_get('post_type') == 'testimonial')
	{
		$columns_new = array(
			'cb' => $columns['cb'],
			'testimonial_featured_image' =>  __('Image', 'aurum')
		);

		$columns = array_merge($columns_new, $columns);
	}

	return ($columns);
}

function laborator_testimonial_featured_image_column_content($column_name, $id)
{
	if($column_name === 'testimonial_featured_image')
	{
		if(has_post_thumbnail())
		{
			echo wp_get_attachment_image(get_post_thumbnail_id(), 'thumbnail', false, array('width' => '48'));
		}
		else
		{
			echo "<small>No Image</small>";
		}
	}
}


# Body Class
add_filter('body_class', 'laborator_body_class');

function laborator_body_class($classes)
{
	if(function_exists('get_field'))
	{
		if(get_field('remove_top_margin'))
			$classes[] = 'content-ntm';

		if(get_field('remove_bottom_margin'))
			$classes[] = 'content-nbm';
	}

	if(get_data('shop_gallery_lazyload'))
		$classes[] = 'product-images-lazyload';


	# Transparent Header
	if(has_transparent_header())
	{
		$classes[] = 'transparent-header';

		if(get_data('header_top_links'))
		{
			$classes[] = 'header-top-menu';
		}
	}
	
	# Disabled Nivo on Mobile
	if ( get_data( 'shop_lightbox_disable_mobile' ) ) {
		$classes[] = 'nivo-disabled-product';
	}

	return $classes;
}



# The Content Filter
add_filter('the_content', 'laborator_the_content');
add_filter('comment_text', 'laborator_the_content');

function laborator_the_content($content)
{
	$content = preg_replace('/\<table\>/', '<table class="table">', $content);

	return $content;
}



# Handle Empty Titles (post)
add_filter('the_title', 'laborator_the_title');

function laborator_the_title($title)
{
	if(trim($title) == '')
		return __("(No title)", 'aurum');

	return $title;
}



# Fixing "Posts" page highlight in the menu when in search page or 404
function dtbaker_wp_nav_menu_objects($sorted_menu_items, $args){
	// check if the current page is really a blog post.
	global $wp_query;
	if(!empty($wp_query->queried_object_id)){
		$current_page = get_post($wp_query->queried_object_id);
		if($current_page && $current_page->post_type=='post'){
			//yes!
		}else{
			$current_page = false;
		}
	}else{
		$current_page = false;
	}

	$home_page_id = (int) get_option( 'page_for_posts' );
	foreach($sorted_menu_items as $id => $menu_item){
		if ( ! empty( $home_page_id ) && 'post_type' == $menu_item->type && empty( $wp_query->is_page ) && $home_page_id == $menu_item->object_id ){
			if(!$current_page){
				foreach($sorted_menu_items[$id]->classes as $classid=>$classname){
					if($classname=='current_page_parent'){
						unset($sorted_menu_items[$id]->classes[$classid]);
					}
				}
			}
		}
	}
	return $sorted_menu_items;
}

add_filter('wp_nav_menu_objects','dtbaker_wp_nav_menu_objects', 10, 2);


# Skin Compiler
add_filter('of_options_before_save', 'laborator_custom_skin_generate');

function laborator_custom_skin_generate($data)
{
	if( ! defined("DOING_AJAX"))
	{
		return $data;
	}
	elseif( $_REQUEST['action'] != 'of_ajax_post_action' )
	{
		return $data;
	}
	
	if(isset($data['use_custom_skin']) && $data['use_custom_skin'])
	{
		update_option('aurum_skin_custom_css', '');
	
		$colors = array();
		
		$custom_skin_bg_color             = $data['custom_skin_bg_color'];
		$custom_skin_link_color           = $data['custom_skin_link_color'];
		$custom_skin_secondary_link_color = $data['custom_skin_secondary_link_color'];
		$custom_skin_footer_bg_color      = $data['custom_skin_footer_bg_color'];
		$custom_skin_border_color         = $data['custom_skin_border_color'];
		$custom_skin_button_color         = $data['custom_skin_button_color'];
		$custom_skin_text_color           = $data['custom_skin_text_color'];
		
		$files = array(
			THEMEDIR . "assets/less/other-less/lesshat.less" => "include",
			THEMEDIR . "assets/less/skin-generator.less"     => "parse",
		);
		
		$vars = array(
			'background'     => $custom_skin_bg_color,
			'link-color'     => $custom_skin_link_color,
			'secondary-link' => $custom_skin_secondary_link_color,
			'footer'         => $custom_skin_footer_bg_color,
			'border-color'   => $custom_skin_border_color,
			'button-color'   => $custom_skin_button_color,
			'text-color'     => $custom_skin_text_color,
		);
		
		$css_stype = aurum_generate_less_style($files, $vars);
		
		update_option('aurum_skin_custom_css', $css_stype);
		
	}
	
	return $data;
}


// Remove Plugin Notices
if ( defined( 'LS_PLUGIN_BASE' ) ) {
	remove_action( 'after_plugin_row_' . LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3 );
}


// Single Blog Post Content
add_filter( 'body_class', 'body_class_blog_post_single_lightbox' );

function body_class_blog_post_single_lightbox( $classes ) {
	
	if( is_single() && get_data( 'blog_post_single_lightbox' ) ) {
		$classes[] = 'single-post-lightbox-on';
	}
	
	return $classes;
}


// Hide Purchase Notice
if ( defined( 'LS_PLUGIN_BASE' ) ) {
	remove_action( 'after_plugin_row_' . LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3 );
}

// LayerSlider hide Notice
add_filter( 'option_layerslider-authorized-site', '__return_true', 1000 );

// Remove Plugin Notices
add_filter( 'pre_option_revslider-valid', '__return_true' );