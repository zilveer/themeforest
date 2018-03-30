<?php

// Load common theme actions, functions, and filters
require ( AIR_THEME .'/theme-common.php');

// Custom TinyMCE button
require ( AIR_THEME . '/theme-tinymce.php');

/*---------------------------------------------------------------------------*/
/* Theme :: Setup + Actions
/*---------------------------------------------------------------------------*/

// Add admin actions
add_action( 'air_validate_theme_options', 'wpbandit_advanced_css', 10, 2 );
add_action( 'after_switch_theme', 'wpbandit_upgrade' );

// Add theme actions
add_action( 'after_setup_theme', 'wpbandit_setup_theme' );
add_action( 'widgets_init', 'wpbandit_widgets_init' );
add_action( 'wp_enqueue_scripts', 'wpbandit_styles' );
add_action( 'wp_enqueue_scripts', 'wpbandit_fancybox1_stylesheet');
add_action( 'wp_enqueue_scripts', 'wpbandit_scripts' );

// Add custom wpbandit actions
add_action( 'wpb_portfolio_javascript', 'wpb_portfolio_javascript', 10, 3);


/*---------------------------------------------------------------------------*/
/* Theme :: Functions
/*---------------------------------------------------------------------------*/

/**
	Upgrade theme
**/
function wpbandit_upgrade() {
	// Define page templates
	$templates = array(
		'template-menu-left.php' => 'page-templates/child-menu-left.php',
		'template-menu-right.php' => 'page-templates/child-menu-right.php',
		'template-front-boxed.php' => 'page-templates/frontpage-boxed.php',
		'template-front-wide.php' => 'page-templates/frontpage-wide.php',
		'template-front.php' => 'page-templates/frontpage.php',
		'template-full-nobox.php' => 'page-templates/full-width-no-box.php',
		'template-full.php' => 'page-templates/full-width.php',
		'template-gallery.php' => 'page-templates/fullscreen-gallery.php',
		'template-portfolio.php' => 'page-templates/portfolio.php',
		'template-sidebar-left.php' => 'page-templates/sidebar-left.php',
		'template-sidebar-right.php' => 'page-templates/sidebar-right.php',
		'template-sitemap.php' => 'page-templates/sitemap.php'
	);
	
	// Get all pages (id only)
	$pages = get_all_page_ids();
	
	// Loop through pages
	foreach ($pages as $page_id) {
		// Get page template
		$template = get_post_meta($page_id,'_wp_page_template',true);
		// Check if template needs to be renamed
		if (array_key_exists($template,$templates)) {
			// Update page template
			update_post_meta($page_id,'_wp_page_template',$templates[$template]);
		}
	}
}

/**
	Setup theme
**/
function wpbandit_setup_theme() {
	// Set default options, if necessary
	Air::set_default_options();

	// Create wpbandit_images table
	wpbandit_create_images_table();

	// Load theme shortcodes
	require ( AIR_THEME . '/theme-shortcodes.php' );
}

/**
	Widgets init
	- register additional sidebars and widget areas
**/
function wpbandit_widgets_init() {
	// Footer widgets
	if ( Air::get_option('footer-widgets') ) {
		register_sidebar(array(
			'id'			=> 'widget-footer-1',
			'name'			=> 'Footer Column 1',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-footer-2',
			'name'			=> 'Footer Column 2',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-footer-3',
			'name'			=> 'Footer Column 3',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-footer-4',
			'name'			=> 'Footer Column 4',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title"><span>',
			'after_title'	=> '</span></h3>',
		));
	}
}

/**
	Enqueue stylesheets
**/
function wpbandit_styles() {
	// responsive.css
	if ( !wpb_option('disable-responsive') ) {
		wp_enqueue_style('style-responsive');
	}
	// theme style
	if ( Air::get_option('style') )
		wp_enqueue_style('wpbandit-style',
			get_template_directory_uri().'/styles/'.Air::get_option('style'));
	// style-advanced.css
	if ( Air::get_option('advanced-css') )
		wp_enqueue_style('wpbandit-style-advanced',
			get_template_directory_uri().'/style-advanced.css');
	// custom.css
	if ( Air::get_option('custom-css') )
		wp_enqueue_style('wpbandit-custom');
}

/**
	Enqueue fancyBox1 stylesheet
**/
function wpbandit_fancybox1_stylesheet() {
	if ( 'fancybox1' == Air::get_option('js-fancybox') )
		wp_enqueue_style('fancybox1');
}

/**
	Enqueue scripts
**/
function wpbandit_scripts() {
	$supersized_templates = array(
		'page-templates/frontpage.php',
		'page-templates/fullscreen-gallery.php'
	);

	// Page template scripts
	if ( is_page() ) {
		// Get template
		$template = get_post_meta(get_the_ID(),'_wp_page_template',TRUE);
		
		// frontpage.php, fullscreen-gallery.php 
		if ( in_array($template, $supersized_templates) ) {
			wp_enqueue_script('supersized');
			// supersized.shutter.min.js
			wp_enqueue_script('supersized-shutter');
			// jquery.theme.js
			wp_enqueue_script('theme');
			// Exclude remaining scripts from loading
			return;
		}
	} 

	// comment-reply.js
	if ( is_singular() )
		wp_enqueue_script('comment-reply');

	// jquery.jplayer.min.js
	if ( !Air::get_option('js-disable-jplayer') )
		wp_enqueue_script('jplayer');

	// jquery.flexslider.min.js
	wp_enqueue_script('flexslider');
	
	// jquery.isotope.min.js
	wp_enqueue_script('isotope');

	// jquery.fancybox-1.3.4.pack.js
	if ( 'fancybox1' == Air::get_option('js-fancybox','fancybox2') ) {
		wp_enqueue_script('fancybox1');
	}
	
	// jquery.fancybox.pack.js
	if ( 'fancybox2' == Air::get_option('js-fancybox','fancybox2') ) {
		wp_enqueue_script('fancybox2');
		wp_enqueue_script('fancybox2-media-helper');
	}
	
	// jquery.mousewheel-3.0.6.pack.js
	wp_enqueue_script('mousewheel');

	// jquery.theme.js
	wp_enqueue_script('theme');

	// Translatable strings
	wp_localize_script('theme', 'objectL10n',
		array(
			'navigate' => __('Navigate to...','feather'),
		)
	);
}

/**
	Write advanced styles to style-advanced.css
**/
function wpbandit_advanced_css($section,$valid) {
	// Are we in styling section ?
	if ( 'styling' != $section ) { return; }
	
	// Advanced stylesheet enabled ?
	if ( '1' != $valid['advanced-css'] ) { return; }

	// Set filename
	$file = get_template_directory().'/style-advanced.css';

	// Cannot write to style-advanced.css
	if ( !is_writable($file) ) {
		// Add error if cannot write to file
		add_settings_error('air-settings-errors','air-updated',
			__('Cannot write to style-advanced.css. Please check permissions'.
			' and try saving settings again.','air'),'error');
		// Do not proceed further
		return;
	}

	// Get options
	$body_bg_color = $valid['styling-body-bg-color'];
	$body_bg_image = $valid['styling-body-bg-image'];
	$body_bg_image_repeat = $valid['styling-body-bg-image-repeat'];
	$color_1 = $valid['styling-color-1'];
	$color_2 = $valid['styling-color-2'];
	$color_3 = $valid['styling-color-3'];
	$color_quote = $valid['styling-color-quote'];
	$misc_paper = $valid['styling-misc-paper'];
	$misc_box_shadow = $valid['styling-misc-box-shadow'];
	$misc_glass_effect = $valid['styling-misc-glass-effect'];
	$misc_stick_header = $valid['styling-misc-stick-header'];
	$misc_vertical_image = $valid['styling-misc-vertical-image'];

	// Build style-advanced.css
	$styles = '/* Note : Do not place custom styles in this stylesheet */'."\n\n";
	
	// body
	$styles .= 'body { ';
		// body background color
		if ( $body_bg_color ) {
			$styles .= 'background-color: #'.$body_bg_color.'; background-image: none; ';
		}
		// body background image
		if ( $body_bg_image ) {
			$styles .= 'background-image: url('.$body_bg_image.'); ';
		}
		// body background repeat
		if ( $body_bg_image_repeat) {
			$styles .= 'background-repeat: '.$body_bg_image_repeat.'; ';
		}	
	
	$styles .= '}'."\n";		

	// theme color 2
	if ( $color_2 ) {
		$styles .= '.entry-format.quote, div.jp-play-bar, div.jp-volume-bar-value { background-color: #'.$color_2.'; }'."\n";
	}
	// theme color 3
	if ( $color_3 ) {
		$styles .= '#logo { background-color: #'.$color_3.'!important; }'."\n";
	}
	
	// quote color text
	if ( $color_quote ) {
		$styles .= '.entry-format.quote { color: #fff; } .entry-format.quote a { color: #fff; opacity: 0.6; } .entry-format.quote a:hover { color: #fff; opacity: 1; } .format-quote .icon-32 { background-position: -32px 0; }'."\n";
	}
	
	// misc paper effect
	if ( $misc_paper ) {
		$styles .= '.entry, #sidebar .widget { background-image: none; }'."\n";
	}
	// misc box shadow
	if ( $misc_box_shadow ) {
		$styles .= '.entry, #sidebar .widget, .portfolio-item { -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none; }'."\n";
	}
	// misc glass effect
	if ( $misc_glass_effect ) {
		$styles .= '.glass { display: none!important; }'."\n";
	}
	// misc stick header
	if ( $misc_stick_header ) {
		$styles .= '
body { padding-top: 100px; }
#header { position: fixed; top: 0; width: 100%; margin-bottom: 0; }
/* unstick for mobile */	
@media only screen and (max-width: 767px) {
body { padding-top: 0; }
#header { position: relative; margin-bottom: 40px; }
}
/* move admin bar to bottom */	
* html body { margin-top: 0 !important; }
body.admin-bar { margin-top: -28px; padding-bottom: 28px; }
body.wp-admin #footer { padding-bottom: 28px; }
#wpadminbar { top: auto !important; bottom: 0; }
#wpadminbar .quicklinks .ab-sub-wrapper { bottom: 28px; }
#wpadminbar .quicklinks .ab-sub-wrapper ul .ab-sub-wrapper { bottom: -7px; }	
		'."\n";
	}
	// misc vertical image height (gallery)
	if ( $misc_vertical_image ) {
		$styles .= '.flexslider .slides img { max-height: 700px; } .single .flexslider .slides > li, .blog .flexslider .slides > li { background-color: #111; }'."\n";
	}
	
	
	// theme color
	if ( $color_1 ) {
		$rgb = wpb_hex2rgb($color_1);
		$styles .= '
a,
label .required,
.comment-awaiting-moderation,
#nav li.current_page_item a, 
#nav li.current-menu-ancestor a, 
#nav li.current-menu-item a,
.entry-title a:hover,
.widget a:hover,
.widget_archive ul li,
.widget_categories ul li,
.widget_links ul li,
.widget_rss ul li a,
.widget_tag_cloud .tagcloud a:hover,
.widget_calendar a,
.sitemap a:hover,
#child-menu li li li.current_page_item a,
#child-menu li li li.current-menu-item a,
#child-menu li li li.current_page_item a:hover,
#child-menu li li li.current-menu-item a:hover,
.accordion .title a:hover,
.accordion .title.active a,
.toggle .title:hover,
.toggle .title.active,
ul.tabs-nav li a.active { color: #'.$color_1.'; }

.color { color: #'.$color_1.'!important; }

#logo,
.entry-tags a:hover,
.entry-format.link p a,
.widget_calendar caption,
.commentlist .reply a:hover,
.front #slidecaption a.more,
#child-menu li li.current_page_item a, 
#child-menu li li.current-menu-item a,
#child-menu li li.current_page_parent a, 
#child-menu li li.current_page_item a:hover, 
#child-menu li li.current-menu-item a:hover,
#child-menu li li.current_page_parent a:hover,
input[type="submit"],
button[type="submit"],
a.button,
.plan.featured .plan-head,
.accordion .title.active .icon,
.toggle .title.active .icon { background-color: #'.$color_1.'; }

::selection { background-color: #'.$color_1.'; }
::-moz-selection { background-color: #'.$color_1.'; }

.plan.featured { border-color: #'.$color_1.'; }

ul.tabs-nav li a.active { border-top-color: #'.$color_1.'; }

.front #slidecaption a.more:hover { -moz-box-shadow: 0 0 40px #'.$color_1.'; -webkit-box-shadow: 0 0 40px #'.$color_1.'; box-shadow: 0 0 40px #'.$color_1.'; }
.front #slidecaption a.more:active { -moz-box-shadow: 0 0 20px #'.$color_1.'; -webkit-box-shadow: 0 0 20px #'.$color_1.'; box-shadow: 0 0 20px #'.$color_1.'; }

.wp-pagenavi a { color: #'.$color_1.'!important; border: 1px solid rgba('.$rgb.', 0.3)!important; }
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current { background: #'.$color_1.'!important; border: 1px solid #'.$color_1.'!important; }
			'."\n";
		}

	// open file for writing
	$fh = fopen($file, 'w');
	// write styles
	fwrite($fh, $styles);
	// close file
	fclose($fh);

	return TRUE;
}


/*---------------------------------------------------------------------------*/
/* Theme :: Template Functions
/*---------------------------------------------------------------------------*/

/**
	Page Title
**/
function wpb_page_title() {
	global $post;

	$heading = get_post_meta($post->ID,'_heading',TRUE);
	$subheading = get_post_meta($post->ID,'_subheading',TRUE);
	$title = $heading?$heading:the_title();
	if($subheading) {
		$title = $title.' <span>'.$subheading.'</span>';
	}

	return $title;
}

/**
	Blog Heading
**/
function wpb_blog_heading() {
	global $post;

	$heading = Air::get_option('blog-heading');
	$subheading = Air::get_option('blog-subheading');
	$title = $heading;
	if($subheading) {
		$title = $title.' <span>'.$subheading.'</span>';
	}

	return $title;
}

/**
	Page Background Image
**/
function wpb_page_background_image() {
	// Skip meta check on 404, search, and archive pages
	if ( is_404() || is_search() || is_archive() )
		$skip = TRUE;

	// Global $post variable
	global $post;

	// Static front page ?
	$static = (get_option('show_on_front')==='page')?TRUE:FALSE;

	// Check for post/blog image
	if ( !is_home() && !isset($skip) ) {
		$post_image = get_post_meta($post->ID,'_bg-image',TRUE);
		$post_image_settings = get_post_meta($post->ID,'_bg-image-settings',TRUE);
	} elseif( is_home() && $static ) {
		$blog_page_id = get_option('page_for_posts');
		$post_image = get_post_meta($blog_page_id,'_bg-image',TRUE);
		$post_image_settings = get_post_meta($blog_page_id,'_bg-image-settings',TRUE);
	} else {
		$post_image = NULL;
	}

	// Background Image?
	if( !$post_image && Air::get_option('global-bg-image') ) {
		$background = '<img id="background" class="'.Air::get_option('global-bg-image-settings').'" src="'.Air::get_option('global-bg-image').'">';
	} elseif ( $post_image ) {
		$background = '<img id="background" class="'.$post_image_settings.'" src="'.$post_image.'">';
	} else {
		$background = '';
	}
	return $background;
}

/**
	Page Featured Image Caption
**/
function wpb_post_thumbnail_caption() {
	global $post;
	$output = '';

	$thumbnail_id    = get_post_thumbnail_id($post->ID);
	$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

	if ($thumbnail_image && isset($thumbnail_image[0])) {
		if($thumbnail_image[0]->post_excerpt) {
			$output .= '<span class="caption">'.$thumbnail_image[0]->post_excerpt.'</span>';
		}
		if($thumbnail_image[0]->post_content) {
			$output .= '<span class="description"><i>'.$thumbnail_image[0]->post_content.'</i></span>';
		}
	}

	return isset($output)?$output:'';
}

/**
	Archive heading
**/
function wpb_archive_heading() {
	// Author archive page
	if ( is_author() ) {
		if(get_query_var('author_name'))
			$author = get_user_by('login',get_query_var('author_name'));
		else
			$author=get_userdata(get_query_var('author'));
		$heading = __('Author:','feather').' ';
		$heading .= '<span>'.$author->display_name.'</span>';
	}
	// Category archive page
	if ( is_category() ) {
		$heading = __('Category:','feather').' ';
		$heading .= '<span>'.single_cat_title('', false).'</span>';
	}
	// Tag archive page
	if ( is_tag() ) {
		$heading = __('Tagged:','feather').' ';
		$heading .= '<span>'.single_tag_title('', false).'</span>';
	}
	// Daily archive
	if ( is_day() ) {
		$heading = __('Daily Archive:','feather').' ';
		$heading .= '<span>'.get_the_time('F j, Y').'</span>';
	}
	// Monthly archive
	if ( is_month() ) {
		$heading = __('Monthly Archive:','feather').' ';
		$heading .= '<span>'.get_the_time('F Y').'</span>';
	}
	// Yearly archive page
	if ( is_year() ) {
		$heading = __('Yearly Archive:','feather').' ';
		$heading .= '<span>'.get_the_time('Y').'</span>';
	}
	return isset($heading)?$heading:'';
}

/**
	Social Media Links
**/
function wpb_social_media_links($attrs = NULL) {
	// Set attributes
	$attrs = isset($attrs)?air_attrs($attrs):'';

	// Get links
	$links = air_social::get_items();

	// Create links
	if ( $links ) {
		// Start output
		$output = '<ul'.$attrs.'>';

		// Loop through links
		foreach($links as $link) {
			$target = ('1'==$link['new-window'])?' target="_blank"':'';
			$output .= '<li><a href="'.$link['url'].'"'.$target.'><span class="icon"><img src="'.
				$link['icon'].'" alt="'.$link['name'].'" /></span><span class="icon-title"><i class="icon-pike"></i>'.$link['name'].'</span></a></li>';
		}
		$output .= '</ul>';

		// Return links
		return $output;
	}
}

/**
	Portfolio item link
**/
function wpb_portfolio_link($lightbox=FALSE) {
	// Return link, if lightbox is not enabled
	if (is_post_type_archive('portfolio') && !air_portfolio::get_option('archive_enable_lightbox'))
		return wpb_meta('_link', get_permalink());

	if (is_tax('portfolio_category') && !air_portfolio::get_option('taxonomy_enable_lightbox'))
		return wpb_meta('_link', get_permalink());

	if (is_page() && !$lightbox)
		return wpb_meta('_link', get_permalink());

	// Get lightbox type
	$type = wpb_meta('_portfolio_video')?'video':'image';

	// Switch to lightbox type					
	switch ( $type ) {
		case 'image':
			// Get post images
			$post_images = wpb_post_images();
			// Set $img_id to first post image, else set to post thumbnail
			if ( $post_images ) {
				$img_id = $post_images[0]->ID;
			} else {
				$img_id = get_post_thumbnail_id();
			}
			// Get large image
			$img_large = wp_get_attachment_image_src($img_id,'large');
			// Set link to image URL
			$link = $img_large[0];
			// Set link to placeholder if image does not exist
			if ( !$link )
				$link = get_template_directory_uri() . '/img/placeholder.png';
			break;

		case 'video':
			// Get video meta fields
			$video_url = wpb_meta('_portfolio_video_url');
			$video_embed_code = wpb_meta('_portfolio_video_embed_code');
			// Set lightbox link to video div
			$link = '#video-'.get_the_ID();
			// Print video div
			echo wpb_portfolio_video_div($video_url,$video_embed_code);
			break;
	}

	// Return link
	return $link;
}

/**
	Portfolio lightbox video div
**/
function wpb_portfolio_video_div($video_url,$video_embed_code) {
	// Set empty $div, $div_content
	$div = $div_content = '';

	// Check that we have URL or embed code
	if ( !$video_url && !$video_embed_code )
		return $div;

	// Get fancybox version
	$fancybox = Air::get_option('js-fancybox','fancybox2');

	// Set div content
	if ( $video_url ) {
		global $wp_embed;
		$div_content .= $wp_embed->run_shortcode('[embed]'.$video_url.'[/embed]');
	}

	// Video Embed Code
	if ( $video_embed_code && !$video_url ) {
		$div_content .= $video_embed_code;
	}

	// Switch to fancybox version
	switch ( $fancybox ) {

		// Fancybox 1
		case 'fancybox1':
			$div .= '<div style="display:none;"><div id="video-'.get_the_ID().
				'" class="video-container fancybox-video fancybox1">';
			$div .= $div_content.'</div></div>';
			break;

		// Fancybox 2
		case 'fancybox2':
			$div .= '<div id="video-'.get_the_ID().'" class="video-container fancybox-video">';
			$div .= $div_content.'</div>';
			break;

	}

	// Return video div
	return $div;
}

/**
	Portfolio classes ( Archive / Taxonomy Templates )
**/
function wpb_portfolio_classes($classes='') {
	// Portfolio archive classes
	if (is_post_type_archive('portfolio')) {
		// Layout
		$classes = air_portfolio::get_option('archive_layout','grid one-third');
	}

	// Portfolio taxonomy classes
	if (is_tax('portfolio_category')) {
		// Layout
		$classes = air_portfolio::get_option('taxonomy_layout','grid one-third');
	}

	// Category slugs
	$classes .= ' ' . air_portfolio::get_category_slugs(' ');

	// Return classes
	return $classes;
}

/**
	Portfolio classes ( Single Template )
**/
function wpb_portfolio_class($layout='') {
	// Layout
	$classes  = $layout;
	// Category slugs
	$classes .= ' ' . air_portfolio::get_category_slugs(' ');

	// Return classes
	return $classes;
}

/**
	Portfolio javascript
**/
function wpb_portfolio_javascript($disable_categories,$disable_switcher,$lightbox) {
?>

<script type="text/javascript">
jQuery(document).ready(function() {
	
	<?php if ( !$disable_categories || !$disable_switcher ): // isotope ?>
	
	// Isotope
	jQuery('.isotope').isotope({
		animationEngine : 'best-available',
		itemSelector : '.isotope-item',
		layoutMode : 'fitRows'
	});

	<?php endif; ?>

	// Category Filter
	jQuery('#portfolio-filter.iso').wpbandit('portfolio_category_filter');	
	
	// Size Switcher
	jQuery('#portfolio-size').wpbandit('portfolio_size_switcher');

	<?php if ( $lightbox && ('fancybox2' == Air::get_option('js-fancybox','fancybox2')) ): ?>

	// Portfolio lightbox - fancybox2
	jQuery('a.portfolio-thumbnail').fancybox({
		nextSpeed: 500,
		prevSpeed: 500
	});

	<?php elseif ( $lightbox ): ?>

	var tmp;
	var src;
	
	// Portfolio lightbox - fancybox1
	jQuery('a.portfolio-thumbnail').fancybox({
		nextSpeed: 500,
		prevSpeed: 500,
		onComplete : function()
		{
			tmp = jQuery(this.href);
			if ( tmp.hasClass('fancybox-video') ) {
				src = tmp.find('iframe').attr('src');
			}
		},
		onClosed : function()
		{
			if ( tmp.hasClass('fancybox-video') ) {
				tmp.find('iframe').attr('src',src);
			}
		}
	});

	<?php endif; ?>

});
jQuery(window).load(function() {
	jQuery('.isotope').isotope('reLayout');
});
</script>
<?php
}


/*---------------------------------------------------------------------------*/
/* Theme :: Filters
/*---------------------------------------------------------------------------*/

/**
	Body Class
**/
function wpbandit_body_class($classes) {
	if ( Air::get_option('sidebar-mobile-disable') )
		$classes[] = 'mobile-sidebar-disable';
	return $classes;
}
add_filter('body_class','wpbandit_body_class');
