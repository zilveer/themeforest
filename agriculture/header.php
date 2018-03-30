<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.6.3
 * 
 * Website Header Template
 * Created by CMSMasters
 * 
 */


$cmsms_option = cmsms_get_global_options();

global $woocommerce;


if (class_exists('woocommerce') && is_shop()) {
	$cmsms_page_id = wc_get_page_id('shop');
} else {
	$cmsms_page_id = get_the_ID();
}


if ( 
	!is_404() && 
	!is_archive() && 
	!is_search() && 
	!is_home() || 
	(class_exists('woocommerce') && is_shop())
) {
	$cmsms_breadcrumbs = get_post_meta($cmsms_page_id, 'cmsms_breadcrumbs', true);

	$cmsms_layout = get_post_meta($cmsms_page_id, 'cmsms_layout', true);

	$cmsms_top_sidebar = get_post_meta($cmsms_page_id, 'cmsms_top_sidebar', true);

	$cmsms_heading = get_post_meta($cmsms_page_id, 'cmsms_heading', true);
	$cmsms_heading_bg_col = get_post_meta($cmsms_page_id, 'cmsms_heading_bg_col', true);
	$cmsms_heading_bg_col_opac = (int)(get_post_meta($cmsms_page_id, 'cmsms_heading_bg_col_opac', true)) / 100;
	$cmsms_heading_bg_img = get_post_meta($cmsms_page_id, 'cmsms_heading_bg_img', true);
	$cmsms_heading_title = get_post_meta($cmsms_page_id, 'cmsms_heading_title', true);
	$cmsms_heading_subtitle = get_post_meta($cmsms_page_id, 'cmsms_heading_subtitle', true);

	$cmsms_slider = get_post_meta($cmsms_page_id, 'cmsms_slider', true);
	$cmsms_slider_rev_shortcode = get_post_meta($cmsms_page_id, 'cmsms_slider_rev_shortcode', true);
	$cmsms_slider_lay_shortcode = get_post_meta($cmsms_page_id, 'cmsms_slider_lay_shortcode', true);

	$cmsms_seo_title = get_post_meta($cmsms_page_id, 'cmsms_seo_title', true);
	$cmsms_seo_description = get_post_meta($cmsms_page_id, 'cmsms_seo_description', true);
	$cmsms_seo_keywords = get_post_meta($cmsms_page_id, 'cmsms_seo_keywords', true);
} else if (is_archive()) {
	$cmsms_layout = $cmsms_option[CMSMS_SHORTNAME . '_archive_layout'];
	$cmsms_top_sidebar = $cmsms_option[CMSMS_SHORTNAME . '_archive_top_sidebar'];
} else if (is_search()) {
	$cmsms_layout = $cmsms_option[CMSMS_SHORTNAME . '_search_layout'];
	$cmsms_top_sidebar = $cmsms_option[CMSMS_SHORTNAME . '_search_top_sidebar'];
}

if (class_exists('woocommerce')) {
	$cmsms_woocommerce_top_widgets_columns = $cmsms_option[CMSMS_SHORTNAME . '_woocommerce_top_widgets_columns'];
}


?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="<?php 
if ($cmsms_option[CMSMS_SHORTNAME . '_seo']) {
	if ( 
		!is_home() && 
		!is_404() && 
		!is_archive() && 
		!is_search() && 
		$cmsms_seo_description !== '' 
	) {
		echo $cmsms_seo_description;
	} else {
		if ($cmsms_option[CMSMS_SHORTNAME . '_seo_description'] !== '') {
			echo $cmsms_option[CMSMS_SHORTNAME . '_seo_description'];
		} else {
			bloginfo('description');
		}
	}
} else {
	bloginfo('description');
} 
?>" />
<meta name="keywords" content="<?php 
if ($cmsms_option[CMSMS_SHORTNAME . '_seo']) {
	if ( 
		!is_home() && 
		!is_404() && 
		!is_archive() && 
		!is_search() && 
		$cmsms_seo_keywords !== '' 
	) {
		echo $cmsms_seo_keywords;
	} else {
		if ($cmsms_option[CMSMS_SHORTNAME . '_seo_keywords'] !== '') {
			echo $cmsms_option[CMSMS_SHORTNAME . '_seo_keywords'];
		} else {
			bloginfo('name');
		}
	}
} else {
	bloginfo('name');
} 
?>" />
<title><?php
if ($cmsms_option[CMSMS_SHORTNAME . '_seo']) {
	if ( 
		!is_home() && 
		!is_404() && 
		!is_archive() && 
		!is_search() && 
		$cmsms_seo_title != '' 
	) {
		echo $cmsms_seo_title;
	} else {
		if ($cmsms_option[CMSMS_SHORTNAME . '_seo_title'] !== '') {
			echo $cmsms_option[CMSMS_SHORTNAME . '_seo_title'];
		} else {
			wp_title('|', true, 'right');
			
			bloginfo('name');
		}
	}
} else {
	wp_title('|', true, 'right');
	
	bloginfo('name');
} 
?></title>

<?php 
if ($cmsms_option[CMSMS_SHORTNAME . '_favicon']) {
	if ($cmsms_option[CMSMS_SHORTNAME . '_favicon_url'] !== '') { 
		echo '<link rel="shortcut icon" href="' . ((is_numeric($cmsms_option[CMSMS_SHORTNAME . '_favicon_url'])) ? array_shift(wp_get_attachment_image_src($cmsms_option[CMSMS_SHORTNAME . '_favicon_url'], 'full')) : $cmsms_option[CMSMS_SHORTNAME . '_favicon_url']) . '" type="image/x-icon" />';
	} else {
		echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/img/favicon.ico" type="image/x-icon" />';
	}
}
?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php 
$ua = $_SERVER['HTTP_USER_AGENT'];

$checker = array( 
	'ios'=>preg_match('/iPhone|iPod|iPad/', $ua), 
	'blackberry'=>preg_match('/BlackBerry/', $ua), 
	'android'=>preg_match('/Android/', $ua), 
	'mac'=>preg_match('/Macintosh/', $ua) 
);

if (is_singular() && get_option('thread_comments')) {
	wp_enqueue_script('comment-reply');
}

wp_head();

?>
</head>
<body <?php body_class(); ?>>

<?php 
	if (class_exists('woocommerce')) {
		cmsms_woocommerce_cart_dropdown(); 
	}
?>

<div class="wrap_head">
	<?php
	if (class_exists('woocommerce')) { ?>
		<div class="fr">
			<div class="cmsms_wrap_basket">
				<a class="cmsms_cart_items cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a>
				<?php echo $woocommerce->cart->get_cart_total(); ?>
			</div>
			<div class="cmsms_header_search">
				<?php get_product_search_form(); ?>
			</div>
		</div>
	<?php }
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_header_custom_html']) {
		echo '<!-- _________________________ Start Custom HTML _________________________ -->' . 
		'<div class="header_html">' . "\n" .  
			stripslashes($cmsms_option[CMSMS_SHORTNAME . '_header_html']) . "\n" . 
			'<div class="cl"></div>' . 
		'</div>' . "\n" . 
		'<!-- _________________________ Finish Custom HTML _________________________ -->';
	} 
	?>
</div>

<!-- _________________________ Start Page _________________________ -->
<section id="page" class="<?php 
if ( 
	!$checker['ios'] && 
	!$checker['blackberry'] && 
	!$checker['android'] && 
	!$checker['mac'] 
) { 
	echo 'csstransition '; 
}
?>hfeed site">

<!-- _________________________ Start Container _________________________ -->
<div class="container">
	
<!-- _________________________ Start Header _________________________ -->
<header id="header">
	<div class="header_inner">
	<?php 
		if ($cmsms_option[CMSMS_SHORTNAME . '_text_logo']) {
			if ($cmsms_option[CMSMS_SHORTNAME . '_text_logo_title'] !== '') {
				$blog_title = $cmsms_option[CMSMS_SHORTNAME . '_text_logo_title'];
			} else {
				$blog_title = (get_bloginfo('name')) ? get_bloginfo('name') : 'Agriculture';
			}
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_text_logo_subtitle_text'] !== '') {
				$blog_descr = $cmsms_option[CMSMS_SHORTNAME . '_text_logo_subtitle_text'];
			} else {
				$blog_descr = (get_bloginfo('description')) ? get_bloginfo('description') : 'Portfolio &amp; Photography';
			}
			
			echo '<a href="' . home_url() . '/" title="' . $blog_title . '" class="logo">' . "\n\t" . 
				'<span class="title">' . $blog_title . '</span>' . "\n";
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_text_logo_subtitle']) { 
				echo '<br />' . "\n" . 
				'<span class="title_text">' . $blog_descr . '</span>' . "\r"; 
			}
			
			echo '</a>';
		} else {
			if ($cmsms_option[CMSMS_SHORTNAME . '_logo_url'] === '') {
				echo '<a href="' . home_url() . '/" title="' . get_bloginfo('name') . '" class="logo">' . "\n\t" . 
					'<img src="' . get_template_directory_uri() . '/img/logo.png" alt="' . get_bloginfo('name') . '" />' . "\r" . 
				'</a>' . "\n";
			} else {
				echo '<a href="' . home_url() . '/" title="' . get_bloginfo('name') . '" class="logo">' . "\n\t" . 
					'<img src="' . ((is_numeric($cmsms_option[CMSMS_SHORTNAME . '_logo_url'])) ? array_shift(wp_get_attachment_image_src($cmsms_option[CMSMS_SHORTNAME . '_logo_url'], 'full')) : $cmsms_option[CMSMS_SHORTNAME . '_logo_url']) . '" alt="' . get_bloginfo('name') . '" />' . "\r" . 
				'</a>' . "\n";
			}
		}
	?>
		<a class="responsive_nav" href="javascript:void(0);"><span></span></a>
		<!-- _________________________ Start Navigation _________________________ -->
		<nav role="navigation">
		<?php
			echo "\t";
			
			if (has_nav_menu('primary')) {
				wp_nav_menu(array( 
					'theme_location' => 'primary', 
					'container' => false, 
					'menu_id' => 'navigation', 
					'menu_class' => 'navigation', 
					'link_before' => '<span><span>', 
					'link_after' => '</span></span>'
				));
			} else {
				echo '<ul id="navigation">';
				
				wp_list_pages(array( 
					'title_li' => '', 
					'link_before' => '<span><span>', 
					'link_after' => '</span></span>' 
				));
				
				echo '</ul>';
			}
			
			echo "\r";
		?>
			<div class="cl"></div>
		</nav>
		<div class="cl"></div>
		<!-- _________________________ Finish Navigation _________________________ -->
	</div>
</header>
<!-- _________________________ Finish Header _________________________ -->

	
<!-- _________________________ Start Middle _________________________ -->
<section id="middle"<?php 
	if (is_page_template('portfolio.php') || is_singular('project')) {
		echo ' class="portfolio_page"';
	} else if (is_404()) {
		echo ' class="error_page"';
	}
?>>
<?php 
if (!isset($cmsms_slider)) {
	$cmsms_slider = 'disabled';
} 

if ($cmsms_slider == 'rev_slider' && $cmsms_slider_rev_shortcode != '') {
	echo '<!-- _________________________ Start Top _________________________ -->' . "\n" . 
		'<section id="top">' . "\n" . 
			'<div class="wrap_rev_slider">' . "\n" . 
				do_shortcode(stripslashes($cmsms_slider_rev_shortcode)) . "\n" . 
				'<div class="cl"></div>' . "\n" .
			'</div>' . "\n" . 
		'</section>' . "\n" . 
	'<!-- _________________________ Finish Top _________________________ -->';
} else if ($cmsms_slider == 'lay_slider' && $cmsms_slider_lay_shortcode != '') {	
	echo '<!-- _________________________ Start Top _________________________ -->' . "\n" . 
		'<section id="top">' . "\n" . 
			'<div class="wrap_lay_slider">' . "\n" . 
				do_shortcode(stripslashes($cmsms_slider_lay_shortcode)) . "\n" . 
			'</div>' . "\n" . 
		'</section>' . "\n" . 
	'<!-- _________________________ Finish Top _________________________ -->';
}
 
if ( 
	is_home() || 
	!isset($cmsms_layout) 
) {
	$cmsms_layout = 'r_sidebar';
}

if ( 
	is_404() || 
	is_attachment() || 
	is_singular('project') || 
	is_page_template('portfolio.php') 
) {
	$cmsms_layout = 'fullwidth';
}


if (!isset($cmsms_heading)) {
	$cmsms_heading = 'default';
}


if (!is_404() && !is_home() && $cmsms_heading != 'disabled') {
	echo '<!-- _________________________ Start Headline _________________________ -->';
	if (
		(
			(
				class_exists('woocommerce') && 
				!is_shop()
			) || 
			!class_exists('woocommerce')
		) && 
		is_archive() || 
		is_search()
	) {
		echo '<div class="headline" style="background-color:' . $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_color'] . ';' . (($cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'] != '' && $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'] != get_template_directory_uri() . '/framework/admin/inc/img/image.png') ? ' background-image:url(' . ((is_numeric($cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'])) ? array_shift(wp_get_attachment_image_src($cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'], 'full')) : $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image']) . ');' : '') . '">' . "\n";
	} elseif ($cmsms_heading == 'parallax' && has_post_thumbnail()) {
		$thumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($cmsms_page_id), 'full');
		
		echo '<div class="headline cmsms_headline_parallax" style="background-image:url(' . $thumb_src[0] . ');">' . "\n" . 
			'<div class="headline_inner" style="background-color:' . (($cmsms_heading_bg_col != '') ? $cmsms_heading_bg_col : $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_color']) . '; opacity:' . (($cmsms_heading_bg_col_opac != '') ? $cmsms_heading_bg_col_opac : '0') . ';"></div>' . "\n";
	} else {
		echo '<div class="headline" style="background-color:' . (($cmsms_heading_bg_col != '') ? $cmsms_heading_bg_col : $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_color']) . ';' . (($cmsms_heading_bg_img != '' && $cmsms_heading_bg_img != get_template_directory_uri() . '/framework/admin/inc/img/image.png') ? ' background-image:url(' . ((is_numeric($cmsms_heading_bg_img)) ? array_shift(wp_get_attachment_image_src($cmsms_heading_bg_img, 'full')) : $cmsms_heading_bg_img) . ');' : (($cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'] != '' && $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'] != get_template_directory_uri() . '/framework/admin/inc/img/image.png') ? ' background-image:url(' . ((is_numeric($cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'])) ? array_shift(wp_get_attachment_image_src($cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image'], 'full')) : $cmsms_option[CMSMS_SHORTNAME . '_heading_bg_image']) . ');' : '')) . '">' . "\n";
	}
	
	if (
		(
			(
				class_exists('woocommerce') && 
				!is_shop()
			) || 
			!class_exists('woocommerce')
		) && 
		is_archive() || 
		is_search()
	) {
		echo '<h1>';
		
		if (is_search()) {
			echo __('Search Results for', 'cmsmasters') . ': &laquo;' . get_search_query() . '&raquo;';
		} elseif (is_archive()) {
			if (is_day()) {
				echo __('Daily Archives', 'cmsmasters') . ': &laquo;' . get_the_date() . '&raquo;';
			} elseif (is_month()) {
				echo __('Monthly Archives', 'cmsmasters') . ': &laquo;' . get_the_date('F Y') . '&raquo;';
			} elseif (is_year()) {
				echo __('Yearly Archives', 'cmsmasters') . ': &laquo;' . get_the_date('Y') . '&raquo;';
			} elseif (is_category()) {
				echo __('Category Archives', 'cmsmasters') . ': &laquo;' . single_cat_title('', false) . '&raquo;';
			} elseif (is_tag()) {
				echo __('Tag Archives', 'cmsmasters') . ': &laquo;' . single_tag_title('', false) . '&raquo;';
			} elseif (is_author()) {
				the_post();
				
				echo __('Author Archives', 'cmsmasters') . ': &laquo;' . get_the_author() . '&raquo;';
				
				rewind_posts();
			} elseif (is_tax('pj-sort-categs') || is_tax('pj-tags')) {
				_e('Portfolio Archives', 'cmsmasters');
			} elseif (class_exists('woocommerce')) {
				if (is_product_category()) {
					echo __('Product Categories', 'cmsmasters') . ': &laquo;' . single_cat_title('', false) . '&raquo;';
				} elseif (is_product_tag()) {
					echo __('Product Tags', 'cmsmasters') . ': &laquo;' . single_tag_title('', false) . '&raquo;';
				}
			} else {
				_e('Website Archives', 'cmsmasters');
			}
		}
		
		echo '</h1>' . "\r";
	} elseif ($cmsms_heading == 'default') {
		echo '<h1>';
		
		if (class_exists('woocommerce') && is_shop()) {
			woocommerce_page_title();
		} else {
			the_title();
		}
		
		echo '</h1>' . "\r";
	} elseif ($cmsms_heading == 'custom') {
		if ($cmsms_heading_subtitle == '') {
			echo '<h1>' . (($cmsms_heading_title != '') ? $cmsms_heading_title : get_the_title()) . '</h1>' . "\n";
		} else {
			echo '<h1 class="heading_title">' . (($cmsms_heading_title != '') ? $cmsms_heading_title : get_the_title()) . '</h1>' . "\n\t\t" . 
			'<h5 class="heading_subtitle">' . str_replace("\n", "<br />", $cmsms_heading_subtitle) . '</h5>' . "\n\t";
		}
	} elseif ($cmsms_heading == 'parallax') {
		if ($cmsms_heading_subtitle == '') {
			echo (($cmsms_heading_title != '') ? '<h1>' . $cmsms_heading_title . '</h1>' . "\n" : '');
		} else {
			echo (($cmsms_heading_title != '') ? '<h1 class="heading_title">' . $cmsms_heading_title . '</h1>' . "\n\t\t" : '') . 
			'<h5 class="heading_subtitle">' . str_replace("\n", "<br />", $cmsms_heading_subtitle) . '</h5>' . "\n\t";
		}
	}
	
	echo '</div>' . "\r" . 
	'<!-- _________________________ Finish Headline _________________________ -->';
}


if (class_exists('woocommerce') && is_woocommerce()) {
	echo '<!-- _________________________ Start Breadcrumbs _________________________ -->';

	woocommerce_breadcrumb();
	
	echo '<!-- _________________________ Finish Breadcrumbs _________________________ -->';
} elseif (
	!is_404() && 
	!is_home() && 
	!is_front_page() && 
	$cmsms_breadcrumbs != 'disabled'
) {
	echo '<!-- _________________________ Start Breadcrumbs _________________________ -->';

	breadcrumbs();
	
	echo '<!-- _________________________ Finish Breadcrumbs _________________________ -->';
}


if (
	!is_home() && 
	!is_404() && 
	$cmsms_top_sidebar != 'false' && 
	$cmsms_top_sidebar != ''
) {
	echo '<!-- _________________________ Start Top Sidebar _________________________ -->' . "\n" . 
		'<section class="top_sidebar">' . "\n" .
			'<div class="top_sidebar_inner' . ((class_exists('woocommerce') && $cmsms_woocommerce_top_widgets_columns != '') ? ' ' . $cmsms_woocommerce_top_widgets_columns : '') . '">' . "\n";
				
				get_sidebar('top');
	
				echo '<div class="cl"></div>' . "\r" . 
			'</div>' . "\n" .
		'</section>' . "\n" .
	'<!-- _________________________ Finish Top Sidebar _________________________ -->' . "\n";
}


if (is_page_template('portfolio.php')) {
	wp_enqueue_script('isotope');
	wp_enqueue_script('isotopeRun');
	
	
	$cmsms_page_sort = get_post_meta($cmsms_page_id, 'cmsms_page_sort', true);
	$cmsms_page_order = get_post_meta($cmsms_page_id, 'cmsms_page_order', true);
	$cmsms_page_order_type = get_post_meta($cmsms_page_id, 'cmsms_page_order_type', true);
	
	
	if ($cmsms_page_sort == 'true') {
?>
<div class="pj_sort_block">
	<div class="pj_options_loader"></div>
	<div class="pj_options_block">
		<div class="pj_sort">
			<a name="pj_name" title="<?php _e('Name', 'cmsmasters'); ?>" href="#" <?php 
				if ($cmsms_page_order_type == 'name') {
					echo 'class="current' . (($cmsms_page_order == 'DESC') ? ' reversed"' : '"');
				}
			?>>
				<span><?php _e('Name', 'cmsmasters'); ?></span>
			</a>
			<a name="pj_date" title="<?php _e('Date', 'cmsmasters'); ?>" href="#" <?php 
				if ($cmsms_page_order_type == 'date') {
					echo 'class="current' . (($cmsms_page_order == 'DESC') ? ' reversed"' : '"');
				}
			?>>
				<span><?php _e('Date', 'cmsmasters'); ?></span>
			</a>
		</div>
		<div class="pj_filter">
			<div class="pj_filter_container">
				<a class="pj_cat_filter" data-filter="article.project" title="<?php _e('All Categories', 'cmsmasters'); ?>" href="#">
					<span><?php _e('All Categories', 'cmsmasters'); ?></span>
				</a>
				<ul class="pj_filter_list">
					<li class="current">
						<a data-filter="article.project" title="<?php _e('All Categories', 'cmsmasters'); ?>" href="#" class="current"><?php _e('All Categories', 'cmsmasters'); ?></a>
					</li>
			<?php 
					$pj_categs = get_terms('pj-sort-categs', array( 
						'orderby' => 'name' 
					));
					
					if (is_array($pj_categs) && !empty($pj_categs)) {
						foreach ($pj_categs as $pj_categ) {
							echo '<li>' . "\n\t" . 
								'<a href="#" data-filter="article.project[data-category~=\'' . $pj_categ->slug . '\']" title="' . $pj_categ->name . '">' . $pj_categ->name . '</a>' . "\r" . 
							'</li>' . "\n";
						}
					}
			?>
				</ul>
			</div>
		</div>
		<div class="cl"></div>
	</div>
</div>
<?php 
	}
}


echo '<div class="content_wrap ' . $cmsms_layout . ((is_singular('project')) ? ' project_page' : '') . '">' . "\n\n";

