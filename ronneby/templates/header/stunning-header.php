<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $post, $dfd_ronneby;
if (isset($post) && !empty($post->ID)) {
	$thumb_in_header = get_post_meta($post->ID, 'dfd_post_thumb_enable', true);
	if(strcmp($thumb_in_header, 'enabled') === 0 && has_post_thumbnail($post->ID)) {
		$thumb = get_post_thumbnail_id($post->ID);
		$custom_head_img = wp_get_attachment_url($thumb, 'full');
	} else {
		$custom_head_img = get_post_meta($post->ID, 'stunnig_headers_bg_img', true);
	}
	$custom_head_bg_img_position = get_post_meta($post->ID, 'stunnig_headers_bg_img_position', true);
	$custom_head_bg_size = get_post_meta($post->ID, 'stun_header_bg_size', true);
	$custom_head_color = get_post_meta($post->ID, 'stunnig_headers_bg_color', true);
	$custom_head_subtitle = get_post_meta($post->ID, 'stunnig_headers_subtitle', true);
	$custom_head_stan_header_fixed = get_post_meta($post->ID, 'stunnig_headers_stan_header_fixed', true);
	$custom_head_stan_header_bgcheck = get_post_meta($post->ID, 'stunnig_headers_stan_header_bgcheck', true);
	$custom_head_stan_header_text_alignment = get_post_meta($post->ID, 'stunnig_headers_text_alignment', true);
} else {
	$custom_head_img = '';
	$custom_head_bg_img_position = '';
	$custom_head_color = '';
	$custom_head_subtitle = '';
	$custom_head_stan_header_fixed = '';
	$custom_head_stan_header_bgcheck = '';
	$custom_head_stan_header_text_alignment = '';
}

$custom_stunning_header_height_css = '';
if(!empty($post) && is_object($post)) {
	$custom_stunning_header_height = get_post_meta($post->ID, 'stunnig_headers_custom_height', true);
}
if(!empty($custom_stunning_header_height)) {
	$custom_stunning_header_height_css .= 'style="height: '.esc_attr(preg_replace("/[^0-9,.-]/","",$custom_stunning_header_height)).'px; min-height: '.esc_attr(preg_replace("/[^0-9,.-]/","",$custom_stunning_header_height)).'px;"';
}

if (strlen($custom_head_bg_img_position)==0) {
	$custom_head_bg_img_position = isset($dfd_ronneby['stan_header_bg_img_position']) ? $dfd_ronneby['stan_header_bg_img_position'] : 'center center';
}

if (empty($custom_head_bg_size) || $custom_head_bg_size == 'theme-default') {
	$custom_head_bg_size = isset($dfd_ronneby['stun_header_bg_size']) ? $dfd_ronneby['stun_header_bg_size'] : 'contain';
}

if (isset($dfd_ronneby['stan_header_fixed']) && strlen($custom_head_stan_header_fixed)==0) {
	$custom_head_stan_header_fixed = $dfd_ronneby['stan_header_fixed'];
}

if (isset($dfd_ronneby['stan_header_bgcheck']) && strlen($custom_head_stan_header_bgcheck)==0) {
	$custom_head_stan_header_bgcheck = $dfd_ronneby['stan_header_bgcheck'];
}

if (strlen($custom_head_stan_header_text_alignment)==0) {
	$custom_head_stan_header_text_alignment = (isset($dfd_ronneby['stan_header_text_align']) && !empty($dfd_ronneby['stan_header_text_align'])) ? $dfd_ronneby['stan_header_text_align'] : 'text-center';
}

$enable_stun_header_title = true;
if (isset($dfd_ronneby['enable_stun_header_title']) && strcmp($dfd_ronneby['enable_stun_header_title'], '0') === 0) {
	$enable_stun_header_title = false;
}

$custom_head_stan_header_breadcrumbs = DfdMetaBoxSettings::compared('stan_header_breadcrumbs', '1');

if (isset($dfd_ronneby['stan_header']) && $dfd_ronneby['stan_header']):
	$stuning_header_style = '';
	
	if (!empty($custom_head_color) && ($custom_head_color != '#')) {
		$stuning_header_style .= ' background-color: ' . esc_attr($custom_head_color) . '; ';
	} elseif (isset($dfd_ronneby['stan_header_color']) && $dfd_ronneby['stan_header_color']) {
		$stuning_header_style .= ' background-color: ' . esc_attr($dfd_ronneby['stan_header_color']) . '; ';
	}

	if (!empty($custom_head_img)) {
		$stuning_header_style .= 'background-image: url(' . esc_url($custom_head_img) . ');';
	} elseif (
			isset($dfd_ronneby['stan_header_image']['url'])
		&& 
			$dfd_ronneby['stan_header_image']['url']
		&& 
			! (!empty($custom_head_color) && ($custom_head_color != '#'))
	) {
		$stuning_header_style .= 'background-image: url(' . esc_url($dfd_ronneby['stan_header_image']['url']) . ');';
	}

	if (!empty($custom_head_bg_img_position)) {
		$stuning_header_style .= 'background-position: ' . esc_attr($custom_head_bg_img_position) . ';';
	}

	if (!empty($custom_head_bg_size)) {
		$stuning_header_style .= 'background-size: ' . esc_attr($custom_head_bg_size) . ';';
	}
	
	if ($custom_head_stan_header_fixed == '1') {
		$stuning_header_style .= 'background-attachment: fixed;';
	}
	
	if (empty($custom_head_bg_img_position)) {
		$stuning_header_style .= 'background-position: center;';
	}
	
	$page_title_inner_class = '';
	if ($custom_head_stan_header_bgcheck == '1') {
		$page_title_inner_class .= ' page-title-inner-bgcheck';
	}
	
	if ($custom_head_stan_header_text_alignment) {
		$page_title_inner_class .= ' '.$custom_head_stan_header_text_alignment;
	}
?>
<div id="stuning-header">
	<div class="dfd-stuning-header-bg-container" style="<?php echo $stuning_header_style; ?>">
		<?php include(locate_template('templates/header/stun-header-video.php')); ?>
	</div>
	<div class="stuning-header-inner">
		<div class="row">
			<div class="twelve columns">
				<div class="page-title-inner <?php echo esc_attr($page_title_inner_class); ?>" <?php echo $custom_stunning_header_height_css; ?>>
					<div class="page-title-inner-wrap">
						<?php if(is_singular('post') && isset($dfd_ronneby['blog_single_stun_header_cat']) && $dfd_ronneby['blog_single_stun_header_cat'] == 'on'): ?>
							<div class="dfd-news-categories">
								<?php get_template_part('templates/entry-meta/mini', 'category-highlighted'); ?>
							</div>
						<?php endif; ?>
						<?php if($enable_stun_header_title): ?>
							<h1 class="page-title">
								<?php
								switch ( true ) {
									# Home page
									case ( is_home() ):
										$page_for_posts = get_option('page_for_posts', true);
										if ($page_for_posts) {
											echo get_the_title($page_for_posts);
										} else {
											_e('Latest Posts', 'dfd');
										}
										break;

									# Archive
									case ( is_archive() ):
										$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

										if ($term && isset($term->name)) {
											echo $term->name;
										} elseif (is_post_type_archive()) {
											$queried_object = get_queried_object();

											if (isset($queried_object->labels) && isset($queried_object->labels->name)) {
												echo $queried_object->labels->name;
											}
										} elseif (is_day()) {
											printf(__('Daily Archives: %s', 'dfd'), get_the_date());
										} elseif (is_month()) {
											printf(__('Monthly Archives: %s', 'dfd'), get_the_date('F Y'));
										} elseif (is_year()) {
											printf(__('Yearly Archives: %s', 'dfd'), get_the_date('Y'));
										} elseif (is_author()) {
											global $post;
											$author_id = $post->post_author;

											$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
											$google_profile = get_the_author_meta('google_profile', $curauth->ID);
											if ($google_profile) {
												printf(__('Author Archives:', 'dfd'));
												echo '<a href="' . esc_url($google_profile) . '" rel="me">' . $curauth->display_name . '</a>';
											} else {
												printf(__('Author Archives: %s', 'dfd'), get_the_author_meta('display_name', $author_id));
											}
										} else {
											single_cat_title();
										}
										break;

									# Search
									case ( is_search() ):
										printf(__('Search Results for %s', 'dfd'), get_search_query());
										break;

									# 404 black hole o_O
									case ( is_404() ):
										_e('File Not Found', 'dfd');
										break;

									# Default
									default:
										the_title();

								}
								?>
							</h1>
						<?php endif; ?>
						<?php if (!empty($custom_head_subtitle)): ?>
							<div class="page-subtitle">
								<?php echo $custom_head_subtitle; ?>
							</div>
						<?php endif; ?>
						<?php if (is_singular('post') && isset($dfd_ronneby['blog_single_stun_header_meta']) && $dfd_ronneby['blog_single_stun_header_meta'] == 'on'): ?>
							<div class="dfd-meta-wrap clearfix">
								<?php get_template_part('templates/entry-meta', 'stun-header'); ?>
							</div>
						<?php endif; ?>
						<?php if (isset($full_screen_video_html) && !empty($full_screen_video_html)): ?>
							<?php echo $full_screen_video_html; ?>
						<?php endif; ?>
					</div>
					<?php if ($custom_head_stan_header_breadcrumbs != 'off') {
						$stan_header_breadcrumbs_style = DfdMetaBoxSettings::compared('stan_header_breadcrumbs_style', '');
						if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb('<div id="breadcrumbs '.esc_attr($stan_header_breadcrumbs_style).'" class="breadcrumbs">','</div>');
						} else { ?>
							<div class="breadcrumbs <?php echo esc_attr($stan_header_breadcrumbs_style) ?>">
							<?php
								# Woocommerce: product or product taxonomy
								if (
										function_exists('is_product_taxonomy') && is_product_taxonomy()
									||
										function_exists('is_product') && is_product()
									)
								{
									woocommerce_breadcrumb();
								}
								# Portfolio
								elseif ( is_singular( array( 'my-product' ) ) && function_exists( 'dfd_portfolio_breadcrumbs' ) ) {
									dfd_portfolio_breadcrumbs();
								}
								# BBpress || ByddyPress
								elseif (
									function_exists('bbp_breadcrumb')
									&&
									(
										( function_exists('is_bbpress') && is_bbpress() )
										||
										( function_exists('is_buddypress') && is_buddypress() )
									)
								)
								{
									bbp_breadcrumb();
								}
								# Default breadcrumbs
								elseif (function_exists('dfd_breadcrumbs')) {
									dfd_breadcrumbs();
								}
							?>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php endif; ?>
