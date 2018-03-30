<?php

/**
 * Custom Head
 *
 * Functions for adding custom styles on front page and admin panel.
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 *
 */

function mpcth_add_custom_styles() {
	global $mpcth_options_name;
	global $ID;

	$mpcth_options = get_option($mpcth_options_name);
	$post_meta = get_post_custom($ID);

	$page_align;
	$page_size;
	$page_sidebar;
	$page_type;
	$addition = 330;


	if(isset($post_meta) && isset($post_meta['page_align']) && $post_meta['page_align'][0] != 'default')
		$page_align = $post_meta['page_align'][0];
	elseif(isset($mpcth_options['mpcth_page_align']))
		$page_align = $mpcth_options['mpcth_page_align'];
	else
		$page_align = 'right';

	//if($page_sidebar != 'none')
	//	$addition += 15;

	if(isset($post_meta) && isset($post_meta['custom_page_size']) && $post_meta['custom_page_size'][0] == 'on' && isset($post_meta['page_size'])) {
		$page_size = $addition + (int)$post_meta['page_size'][0]."px";
	} elseif(isset($mpcth_options['mpcth_page_align'])) {
		$page_size = $addition + (int)$mpcth_options['mpcth_page_size']."px";
	} else {
		$page_size = '1260px';
	}

	if($page_align == 'left')
		$swapToggler = true;
	else
		$swapToggler = false;
?>

<!--[if lte IE 10]>
	<link rel="stylesheet" href="<?php echo MPC_THEME_ROOT ?>/mpc-wp-boilerplate/css/ie.css"/>
<![endif]-->

<!--[if lt IE 9]>
	<script src="<?php echo MPC_THEME_ROOT ?>/mpc-wp-boilerplate/js/html5.js" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo MPC_THEME_ROOT ?>/mpc-wp-boilerplate/css/ie8.css"/>
<![endif]-->

<?php if(isset($mpcth_options['mpcth_content_font']) && is_array($mpcth_options['mpcth_content_font']))
	if($mpcth_options['mpcth_content_font']['type'] == 'google') {
		$name = str_replace(' ', '+', $mpcth_options['mpcth_content_font']['family']); ?>
		<link href="http://fonts.googleapis.com/css?family=<?php echo $name . ($mpcth_options['mpcth_content_font']['style'] != '' && $mpcth_options['mpcth_content_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_content_font']['style'] : ''); ?>" rel="stylesheet" type="text/css">
<?php } elseif($mpcth_options['mpcth_content_font']['type'] == 'cufon') { ?>
		<script type="text/javascript" src="<?php echo $mpcth_options['mpcth_content_font']['font-source']; ?>"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				Cufon.replace('#mpcth_page_wrap', { fontFamily: '<?php echo $mpcth_options['mpcth_content_font']['family']; ?>', hover: true });
			})
		</script>
<?php } ?>

<?php if(isset($mpcth_options['mpcth_menu_font']) && is_array($mpcth_options['mpcth_menu_font']))
	if($mpcth_options['mpcth_menu_font']['type'] == 'google') {
		$name = str_replace(' ', '+', $mpcth_options['mpcth_menu_font']['family']); ?>
		<link href="http://fonts.googleapis.com/css?family=<?php echo $name . ($mpcth_options['mpcth_menu_font']['style'] != '' && $mpcth_options['mpcth_menu_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_menu_font']['style'] : ''); ?>" rel="stylesheet" type="text/css">
<?php } elseif($mpcth_options['mpcth_menu_font']['type'] == 'cufon') { ?>
		<script type="text/javascript" src="<?php echo $mpcth_options['mpcth_menu_font']['font-source']; ?>"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				Cufon.replace('#mpcth_page_wrap #mpcth_nav #mpcth_menu', { fontFamily: '<?php echo $mpcth_options['mpcth_menu_font']['family']; ?>', hover: true });
			})
		</script>
<?php } ?>

<?php if(isset($mpcth_options['mpcth_heading_font']) && is_array($mpcth_options['mpcth_heading_font']))
	if($mpcth_options['mpcth_heading_font']['type'] == 'google') {
		$name = str_replace(' ', '+', $mpcth_options['mpcth_heading_font']['family']); ?>
		<link href="http://fonts.googleapis.com/css?family=<?php echo $name . ($mpcth_options['mpcth_heading_font']['style'] != '' && $mpcth_options['mpcth_heading_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_heading_font']['style'] : ''); ?>" rel="stylesheet" type="text/css">
<?php } elseif($mpcth_options['mpcth_heading_font']['type'] == 'cufon') { ?>
		<script type="text/javascript" src="<?php echo $mpcth_options['mpcth_heading_font']['font-source']; ?>"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				Cufon.replace('#mpcth_page_wrap h1, #mpcth_page_wrap h2, #mpcth_page_wrap h3, #mpcth_page_wrap h4, #mpcth_page_wrap h5, #mpcth_page_wrap h6', { fontFamily: '<?php echo $mpcth_options['mpcth_heading_font']['family']; ?>', hover: true });
			})
		</script>
<?php } ?>

<?php if(isset($mpcth_options['mpcth_small_font']) && is_array($mpcth_options['mpcth_small_font']))
	if($mpcth_options['mpcth_small_font']['type'] == 'google') {
		$name = str_replace(' ', '+', $mpcth_options['mpcth_small_font']['family']); ?>
		<link href="http://fonts.googleapis.com/css?family=<?php echo $name . ($mpcth_options['mpcth_small_font']['style'] != '' && $mpcth_options['mpcth_small_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_small_font']['style'] : ''); ?>" rel="stylesheet" type="text/css">
<?php } elseif($mpcth_options['mpcth_small_font']['type'] == 'cufon') { ?>
		<script type="text/javascript" src="<?php echo $mpcth_options['mpcth_small_font']['font-source']; ?>"></script>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				Cufon.replace('#mpcth_page_wrap small', { fontFamily: '<?php echo $mpcth_options['mpcth_small_font']['family']; ?>', hover: true });
			})
		</script>
<?php } ?>

<style type="text/css">
	
/* ---------------------------------------------------------------- */
/*	FONTS
/* ---------------------------------------------------------------- */

	/* Menu Font */
	#mpcth_page_wrap #mpcth_nav #mpcth_menu {
		<?php if(isset($mpcth_options['mpcth_menu_font']) && isset($mpcth_options['mpcth_menu_font']['type']) && $mpcth_options['mpcth_menu_font']['type'] == 'google') { ?>
			<?php echo 'font-family: \'' . $mpcth_options['mpcth_menu_font']['family'] . '\';' . PHP_EOL; ?>
			<?php echo isset($mpcth_options['mpcth_menu_font']['font-weight']) && $mpcth_options['mpcth_menu_font']['font-weight'] != '' && $mpcth_options['mpcth_menu_font']['font-weight'] != 'regular' ? 'font-weight: '. $mpcth_options['mpcth_menu_font']['font-weight'] . ';' . PHP_EOL : ''; ?>
			<?php echo isset($mpcth_options['mpcth_menu_font']['font-style']) && $mpcth_options['mpcth_menu_font']['font-style'] != '' ? 'font-style: '. $mpcth_options['mpcth_menu_font']['font-style'] . ';' . PHP_EOL : ''; ?>
		<?php } ?>
	}

	/* Heading Font */
	#mpcth_page_wrap h1, #mpcth_page_wrap h2, #mpcth_page_wrap h3, #mpcth_page_wrap h4, #mpcth_page_wrap h5, #mpcth_page_wrap h6 {
		<?php if(isset($mpcth_options['mpcth_heading_font']) && isset($mpcth_options['mpcth_heading_font']['type']) && $mpcth_options['mpcth_heading_font']['type'] == 'google') { ?>
			<?php echo 'font-family: \'' . $mpcth_options['mpcth_heading_font']['family'] . '\';' . PHP_EOL; ?>
			<?php echo isset($mpcth_options['mpcth_heading_font']['font-weight']) && $mpcth_options['mpcth_heading_font']['font-weight'] != '' && $mpcth_options['mpcth_heading_font']['font-weight'] != 'regular' ? 'font-weight: '. $mpcth_options['mpcth_heading_font']['font-weight'] . ';' . PHP_EOL : ''; ?>
			<?php echo isset($mpcth_options['mpcth_heading_font']['font-style']) && $mpcth_options['mpcth_heading_font']['font-style'] != '' ? 'font-style: '. $mpcth_options['mpcth_heading_font']['font-style'] . ';' . PHP_EOL : ''; ?>
		<?php } ?>
	}

	/* Content Font */
	#mpcth_content_toggler,
	#mpcth_page_wrap {
		<?php if(isset($mpcth_options['mpcth_content_font']) && isset($mpcth_options['mpcth_content_font']['type']) && $mpcth_options['mpcth_content_font']['type'] == 'google') { ?>
			<?php echo 'font-family: \'' . $mpcth_options['mpcth_content_font']['family'] . '\';' . PHP_EOL; ?>
			<?php echo isset($mpcth_options['mpcth_content_font']['font-weight']) && $mpcth_options['mpcth_content_font']['font-weight'] != '' && $mpcth_options['mpcth_content_font']['font-weight'] != 'regular' ? 'font-weight: '. $mpcth_options['mpcth_content_font']['font-weight'] . ';' . PHP_EOL : ''; ?>
			<?php echo isset($mpcth_options['mpcth_content_font']['font-style']) && $mpcth_options['mpcth_content_font']['font-style'] != '' ? 'font-style: '. $mpcth_options['mpcth_content_font']['font-style'] . ';' . PHP_EOL : ''; ?>
		<?php } ?>
	}

	/* Small Font */
	#mpcth_page_wrap small {
		<?php if(isset($mpcth_options['mpcth_small_font']) && isset($mpcth_options['mpcth_small_font']['type']) && $mpcth_options['mpcth_small_font']['type'] == 'google') { ?>
			<?php echo 'font-family: \'' . $mpcth_options['mpcth_small_font']['family'] . '\';' . PHP_EOL; ?>
			<?php echo isset($mpcth_options['mpcth_small_font']['font-weight']) && $mpcth_options['mpcth_small_font']['font-weight'] != '' && $mpcth_options['mpcth_small_font']['font-weight'] != 'regular' ? 'font-weight: '. $mpcth_options['mpcth_small_font']['font-weight'] . ';' . PHP_EOL : ''; ?>
			<?php echo isset($mpcth_options['mpcth_small_font']['font-style']) && $mpcth_options['mpcth_small_font']['font-style'] != '' ? 'font-style: '. $mpcth_options['mpcth_small_font']['font-style'] . ';' . PHP_EOL : ''; ?>
		<?php } ?>
	}

	/* Content */
	#mpcth_page_wrap #mpcth_page_articles article {
		<?php echo isset($mpcth_options['mpcth_content_font_size']) ? 'font-size: '. $mpcth_options['mpcth_content_font_size'] . ';' . PHP_EOL : ''; ?>
		/*line-height: 1.5em;*/
	}

	/* Menu */
	#mpcth_page_wrap #mpcth_nav #mpcth_menu .menu-item a {
		<?php echo isset($mpcth_options['mpcth_menu_font_size']) ? 'font-size: '. $mpcth_options['mpcth_menu_font_size'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_nav #mpcth_menu .sub-menu .menu-item a {
		<?php echo isset($mpcth_options['mpcth_menu_drop_font_size']) ? 'font-size: '. $mpcth_options['mpcth_menu_drop_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Category Filter */
	#mpcth_page_wrap .mpcth-filterable-categories a {
		<?php echo isset($mpcth_options['mpcth_cat_filter_font_size']) ? 'font-size: '. $mpcth_options['mpcth_cat_filter_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Read More */
	#mpcth_page_wrap .mpcth-post-audio-note,
	#mpcth_page_wrap .mpcth-portfolio-read-more,
	#mpcth_page_wrap .mpcth-gallery-read-more,
	#mpcth_page_wrap .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_more_font_size']) ? 'font-size: '. $mpcth_options['mpcth_more_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Search/Archive */
	#mpcth-archive-header-info,
	#mpcth-search-header-info {
		<?php echo isset($mpcth_options['mpcth_loadmore_font_size']) ? 'font-size: '. $mpcth_options['mpcth_loadmore_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Load More */
	#mpcth_page_wrap #mpcth_lm,
	#mpcth_page_wrap #mpcth_lm .mpcth-lm-button {
		<?php echo isset($mpcth_options['mpcth_loadmore_font_size']) ? 'font-size: '. $mpcth_options['mpcth_loadmore_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Form Text */
	#mpcth_page_wrap #mpcth_contact_form input,
	#mpcth_page_wrap #comments #respond #commentform input,
	#mpcth_page_wrap #mpcth_contact_form textarea,
	#mpcth_page_wrap #comments #respond #commentform .comment-form-comment textarea {
		<?php echo isset($mpcth_options['mpcth_form_font_size']) ? 'font-size: '. $mpcth_options['mpcth_form_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Form Button */
	#mpcth_page_wrap #mpcth_contact_form #submit,
	#mpcth_page_wrap #comments #respond #commentform #submit,
	#mpcth_page_wrap .mpcth-prev-post,
	#mpcth_page_wrap .mpcth-next-post {
		<?php echo isset($mpcth_options['mpcth_button_font_size']) ? 'font-size: '. $mpcth_options['mpcth_button_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* TODO */
	/* Toggler Button */
	#mpcth_content_toggler,
	#mpcth_content_toggler a {
		<?php echo isset($mpcth_options['mpcth_button_font_size']) ? 'font-size: '. $mpcth_options['mpcth_button_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Footer */
	#mpcth_page_wrap #mpcth_footer #mpcth_footer_content,
	#mpcth_page_wrap #mpcth_footer #mpcth_bottom_footer {
		<?php echo isset($mpcth_options['mpcth_footer_font_size']) ? 'font-size: '. $mpcth_options['mpcth_footer_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Footer Heading */
	#mpcth_page_wrap #mpcth_footer #mpcth_footer_content ul > li .widget_title {
		<?php echo isset($mpcth_options['mpcth_footer_heading_font_size']) ? 'font-size: '. $mpcth_options['mpcth_footer_heading_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Sidebar */
	#mpcth_page_wrap #mpcth_sidebar > ul > li {
		<?php echo isset($mpcth_options['mpcth_sidebar_font_size']) ? 'font-size: '. $mpcth_options['mpcth_sidebar_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Sidebar Heading  */
	#mpcth_page_wrap #mpcth_sidebar li .widget_title {
		<?php echo isset($mpcth_options['mpcth_sidebar_heading_font_size']) ? 'font-size: '. $mpcth_options['mpcth_sidebar_heading_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Top Widget */
	#mpcth_page_wrap #mpcth_top_widget_area_content > ul > li {
		<?php echo isset($mpcth_options['mpcth_top_widget_font_size']) ? 'font-size: '. $mpcth_options['mpcth_top_widget_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Top Widget Heading  */
	#mpcth_page_wrap #mpcth_top_widget_area_content li .widget_title {
		<?php echo isset($mpcth_options['mpcth_top_widget_heading_font_size']) ? 'font-size: '. $mpcth_options['mpcth_top_widget_heading_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Small Font Size */
	#mpcth_page_wrap #mpcth_contact_form .form-allowed-tags,
	#mpcth_page_wrap #commentform .form-allowed-tags,
	#mpcth_page_wrap #mpcth_contact_form .mpcth-cf-response,
	#mpcth_page_wrap #mpcth_contact_form label.error,
	#mpcth_page_wrap #commentform label.error,
	#mpcth_page_wrap #mpcth_page_articles .mpcth-folio-cat,
	#mpcth_page_wrap #mpcth_page_articles .mpcth-folio-cat a,
	#mpcth_page_wrap #comments header.comment-meta,
	#mpcth_page_wrap small,
	#mpcth_page_wrap meta {
		<?php echo isset($mpcth_options['mpcth_small_font_size']) ? 'font-size: '. $mpcth_options['mpcth_small_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #comments header.comment-meta,
	#mpcth_page_wrap #mpcth_bottom_footer .mpcth-footer-copyright,
	#mpcth_page_wrap #mpcth_bottom_footer #s {
		<?php echo isset($mpcth_options['mpcth_small_font_size']) ? 'font-size: '. $mpcth_options['mpcth_small_font_size'] . '!important;' . PHP_EOL : ''; ?>
	}

	/* Headings */
	#mpcth_page_wrap h1 {
		<?php echo isset($mpcth_options['mpcth_h1_font_size']) ? 'font-size: '. $mpcth_options['mpcth_h1_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap h2,
	#mpcth_page_articles article.portfolio .mpcth-post-content header h3 a {
		<?php echo isset($mpcth_options['mpcth_h2_font_size']) ? 'font-size: '. $mpcth_options['mpcth_h2_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap h3,
	#mpcth_page_articles .mpcth-post-title a {
		<?php echo isset($mpcth_options['mpcth_h3_font_size']) ? 'font-size: '. $mpcth_options['mpcth_h3_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap h4 {
		<?php echo isset($mpcth_options['mpcth_h4_font_size']) ? 'font-size: '. $mpcth_options['mpcth_h4_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap h5 {
		<?php echo isset($mpcth_options['mpcth_h5_font_size']) ? 'font-size: '. $mpcth_options['mpcth_h5_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap h6 {
		<?php echo isset($mpcth_options['mpcth_h6_font_size']) ? 'font-size: '. $mpcth_options['mpcth_h6_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Comments */
	#mpcth_page_articles #comments .commentlist article.comment header.comment-meta {
		<?php echo isset($mpcth_options['mpcth_form_font_size']) ? 'font-size: '. $mpcth_options['mpcth_form_font_size'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles #comments .commentlist article.comment header.comment-meta cite {
		<?php echo isset($mpcth_options['mpcth_h2_font_size']) ? 'font-size: '. $mpcth_options['mpcth_h4_font_size'] . ';' . PHP_EOL : ''; ?>
	}

/* ---------------------------------------------------------------- */
/*	COLORS
/* ---------------------------------------------------------------- */

	/* Global */
	#mpcth_page_wrap h1, #mpcth_page_wrap h2, #mpcth_page_wrap h3, #mpcth_page_wrap h4, #mpcth_page_wrap h5, #mpcth_page_wrap h6,
	#mpcth_page_wrap h1 a, #mpcth_page_wrap h2 a, #mpcth_page_wrap h3 a, #mpcth_page_wrap h4 a, #mpcth_page_wrap h5 a, #mpcth_page_wrap h6 a {
		<?php echo isset($mpcth_options['mpcth_color_global_heading']) ? 'color: '. $mpcth_options['mpcth_color_global_heading'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap,
	#mpcth_page_wrap #mpcth_page_articles .wpb_accordion_wrapper .ui-accordion-content, 
	#mpcth_page_wrap #mpcth_page_articles .wpb_tour_tabs_wrapper .wpb_tab {
		<?php echo isset($mpcth_options['mpcth_color_global_body']) ? 'color: '. $mpcth_options['mpcth_color_global_body'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap a {
		<?php echo isset($mpcth_options['mpcth_color_global_link']) ? 'color: '. $mpcth_options['mpcth_color_global_link'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap a:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_linkhover']) ? 'color: '. $mpcth_options['mpcth_color_global_linkhover'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_sidebar a {
		<?php echo isset($mpcth_options['mpcth_color_global_linkhover']) ? 'color: '. $mpcth_options['mpcth_color_global_linkhover'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_sidebar a:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_link']) ? 'color: '. $mpcth_options['mpcth_color_global_link'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_wrap a.mpcth-alt-link {
		<?php echo isset($mpcth_options['mpcth_color_global_alt_link']) ? 'color: '. $mpcth_options['mpcth_color_global_alt_link'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap a.mpcth-alt-link:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_alt_linkhover']) ? 'color: '. $mpcth_options['mpcth_color_global_alt_linkhover'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap h1 a:hover, #mpcth_page_wrap h2 a:hover, #mpcth_page_wrap h3 a:hover, #mpcth_page_wrap h4 a:hover, #mpcth_page_wrap h5 a:hover, #mpcth_page_wrap h6 a:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_link']) ? 'color: '. $mpcth_options['mpcth_color_global_link'] . ';' . PHP_EOL : ''; ?>
	}

	/* Backgrounds */
	#mpcth_page_header_wrap,
	#mpcth_aside_menu_section {
		<?php echo isset($mpcth_options['mpcth_color_bg_header']) ? 'background: '. $mpcth_options['mpcth_color_bg_header'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap {
		<?php echo isset($mpcth_options['mpcth_color_bg_main']) ? 'background-color: '. $mpcth_options['mpcth_color_bg_main'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_footer {
		<?php echo isset($mpcth_options['mpcth_color_bg_footer']) ? 'background: '. $mpcth_options['mpcth_color_bg_footer'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_sidebar > ul > li.widget {
		<?php echo isset($mpcth_options['mpcth_color_bg_sidebar']) ? 'background: '. $mpcth_options['mpcth_color_bg_sidebar'] . ';' . PHP_EOL : ''; ?>
	}
	.page-template-default .mpcth-layout-fluid #mpcth_page_container #mpcth_page_content #mpcth_page_articles article,
	#mpcth_page_articles.mpcth-single-post .portfolio .mpcth-post-content {
		<?php echo isset($mpcth_options['mpcth_color_bg_container']) ? 'background: '. $mpcth_options['mpcth_color_bg_container'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_menu {
		<?php echo isset($mpcth_options['mpcth_mainmenu_bg']) ? 'background: '. $mpcth_options['mpcth_mainmenu_bg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_menu ul,
	#mpcth_nav #mpcth_menu ul.sub-menu {
		<?php echo isset($mpcth_options['mpcth_mainmenu_drop_bg']) ? 'background: '. $mpcth_options['mpcth_mainmenu_drop_bg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap .mpcth-post-share-wrap .zilla-share,
	#mpcth_mobile_nav .mpcth-nav-select-mockup,
	#mpcth_page_articles .post,
	#mpcth_page_articles.mpcth-single-post .post .mpcth-post-thumbnail,
	#mpcth_page_articles.mpcth-single-post .post .mpcth-post-content {
		<?php echo isset($mpcth_options['mpcth_color_bg_post']) ? 'background: '. $mpcth_options['mpcth_color_bg_post'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles #comments .comments-title,
	#mpcth_page_wrap #mpcth_page_articles #comments,
	#mpcth_page_articles #comments .commentlist article.comment {
		<?php echo isset($mpcth_options['mpcth_color_bg_comment']) ? 'background: '. $mpcth_options['mpcth_color_bg_comment'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_top_widget_area {
		<?php echo isset($mpcth_options['mpcth_top_widget_bg']) ? 'background: '. $mpcth_options['mpcth_top_widget_bg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth-archive-header-info,
	#mpcth_page_wrap #mpcth-search-header-info,
	#mpcth_aside_menu_section #mpcth_bottom_footer #searchform #s {
		<?php echo isset($mpcth_options['mpcth_search_bg']) ? 'background: '. $mpcth_options['mpcth_search_bg'] . ';' . PHP_EOL : ''; ?>
	}

	/* Post Format */
	#mpcth_page_articles .post.format-standard a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .post.format-standard .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_standard']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_standard'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .post.format-standard .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_standard_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_standard_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .post.format-image a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .post.format-image .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_image']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_image'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .post.format-image .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_image_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_image_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .post.format-gallery a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .post.format-gallery .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_gallery']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_gallery'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .post.format-gallery .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_gallery_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_gallery_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .post.format-video a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .post.format-video .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_video']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_video'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .post.format-video .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_video_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_video_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .post.format-audio a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .post.format-audio .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_audio']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_audio'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .post.format-audio .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_audio_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_audio_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .post.format-quote .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_quote']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_quote'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .post.format-quote .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_quote_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_quote_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .post.format-aside .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_aside']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_aside'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .post.format-aside .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_aside_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_aside_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .post.format-status .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_status']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_status'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .post.format-status .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_status_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_status_hover'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_articles .post.format-link .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_link']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_link'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .post.format-link .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_format_link_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_format_link_hover'] . ';' . PHP_EOL : ''; ?>
	}

	/* Portfolio Format */
	#mpcth_page_articles .portfolio.format-standard a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .portfolio.format-standard .mpcth-portfolio-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_standard']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_standard'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .portfolio.format-standard .mpcth-portfolio-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_standard_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_standard_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .portfolio.format-image a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .portfolio.format-image .mpcth-portfolio-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_image']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_image'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .portfolio.format-image .mpcth-portfolio-read-more:hoverr {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_image_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_image_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .portfolio.format-gallery a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .portfolio.format-gallery .mpcth-portfolio-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_gallery']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_gallery'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .portfolio.format-gallery .mpcth-portfolio-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_gallery_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_gallery_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .portfolio.format-video a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .portfolio.format-video .mpcth-portfolio-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_video']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_video'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .portfolio.format-video .mpcth-portfolio-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_video_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_video_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_articles .portfolio.format-audio a.mpcth-fancybox .mpcth-fancybox-background,
	#mpcth_page_articles .portfolio.format-audio .mpcth-portfolio-read-more {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_audio']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_audio'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles .portfolio.format-audio .mpcth-portfolio-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_portfolio_format_audio_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_portfolio_format_audio_hover'] . ';' . PHP_EOL : ''; ?>
	}

	/* Gallery Format */
	#mpcth_page_articles article.gallery.format-audio .mpcth-post-thumbnail .mpcth-post-audio-note {
		<?php echo isset($mpcth_options['mpcth_color_bg_gallery_format_audio']) ? 'background: '. $mpcth_options['mpcth_color_bg_gallery_format_audio'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles article.gallery.format-audio .mpcth-post-thumbnail .mpcth-post-audio-note:hover {
		<?php echo isset($mpcth_options['mpcth_color_bg_gallery_format_audio_hover']) ? 'background: '. $mpcth_options['mpcth_color_bg_gallery_format_audio_hover'] . ';' . PHP_EOL : ''; ?>
	}

	/* Main Menu */
	#mpcth_nav #mpcth_menu .menu-item a {
		<?php echo isset($mpcth_options['mpcth_color_mm_menu']) ? 'color: '. $mpcth_options['mpcth_color_mm_menu'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_mm_bg_menu']) ? 'background: '. $mpcth_options['mpcth_color_mm_bg_menu'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_nav #mpcth_menu .menu-item.current-menu-item a,
	#mpcth_nav #mpcth_menu .menu-item.current-menu-ancestor a {
		<?php echo isset($mpcth_options['mpcth_color_mm_menu_hover']) ? 'color: '. $mpcth_options['mpcth_color_mm_menu_hover'] . ';' . PHP_EOL : ''; ?>
		/*<?php echo isset($mpcth_options['mpcth_color_mm_bg_menu_hover']) ? 'background: '. $mpcth_options['mpcth_color_mm_bg_menu_hover'] . ';' . PHP_EOL : ''; ?>*/
	}


	#mpcth_aside_menu_section #mpcth_nav #mpcth_menu li .mpcth-menu-ribbon {
		<?php echo isset($mpcth_options['mpcth_color_mm_bg_menu_hover']) ? 'background: '. $mpcth_options['mpcth_color_mm_bg_menu_hover'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_aside_menu_section #mpcth_nav #mpcth_menu ul.sub-menu li .mpcth-menu-ribbon {
		<?php echo isset($mpcth_options['mpcth_color_mm_bg_drop_hover']) ? 'background: '. $mpcth_options['mpcth_color_mm_bg_drop_hover'] . ';' . PHP_EOL : ''; ?>
	}


	#mpcth_nav #mpcth_menu .menu-item .sub-menu li,
	#mpcth_nav #mpcth_menu .menu-item .sub-menu a {
		<?php echo isset($mpcth_options['mpcth_color_mm_drop']) ? 'color: '. $mpcth_options['mpcth_color_mm_drop'] . ';' . PHP_EOL : ''; ?>
		/*<?php echo isset($mpcth_options['mpcth_color_mm_bg_drop']) ? 'background: '. $mpcth_options['mpcth_color_mm_bg_drop'] . ';' . PHP_EOL : ''; ?>*/
	}
	#mpcth_nav #mpcth_menu > li > ul.sub-menu:before {
		<?php echo isset($mpcth_options['mpcth_color_mm_bg_drop']) ? 'border-bottom-color: '. $mpcth_options['mpcth_color_mm_bg_drop'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_nav #mpcth_menu .menu-item .sub-menu .current-menu-item a {
		<?php echo isset($mpcth_options['mpcth_color_mm_drop_hover']) ? 'color: '. $mpcth_options['mpcth_color_mm_drop_hover'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_mm_bg_drop_hover']) ? 'background: '. $mpcth_options['mpcth_color_mm_bg_drop_hover'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_aside_menu_section #mpcth_menu .menu-item:hover > a,
	#mpcth_page_wrap #mpcth_aside_menu_section #mpcth_menu .menu-item.current-menu-item > a,
	#mpcth_page_wrap #mpcth_aside_menu_section #mpcth_menu .menu-item.current-menu-ancestor > a {
		<?php echo isset($mpcth_options['mpcth_color_mm_menu_hover']) ? 'color: '. $mpcth_options['mpcth_color_mm_menu_hover'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_aside_menu_section #mpcth_menu .menu-item .sub-menu li:hover > a,
	#mpcth_page_wrap #mpcth_aside_menu_section #mpcth_menu .menu-item .sub-menu .current-menu-item > a,
	#mpcth_page_wrap #mpcth_aside_menu_section #mpcth_menu .menu-item .sub-menu .current-menu-ancestor > a {
		<?php echo isset($mpcth_options['mpcth_color_mm_drop_hover']) ? 'color: '. $mpcth_options['mpcth_color_mm_drop_hover'] . '!important;' . PHP_EOL : ''; ?>
	}

	/* Top Menu */
	#mpcth_page_header_content #mpcth_secondary_nav #mpcth_secondary_menu .menu-item a {
		<?php echo isset($mpcth_options['mpcth_color_tm_menu']) ? 'color: '. $mpcth_options['mpcth_color_tm_menu'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_tm_itembg']) ? 'background: '. $mpcth_options['mpcth_color_tm_itembg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_header_content #mpcth_secondary_nav #mpcth_secondary_menu .menu-item a:hover,
	#mpcth_page_header_content #mpcth_secondary_nav #mpcth_secondary_menu .menu-item.current-menu-item a:hover {
		<?php echo isset($mpcth_options['mpcth_color_tm_menu_hover']) ? 'color: '. $mpcth_options['mpcth_color_tm_menu_hover'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_tm_itembg_hover']) ? 'background: '. $mpcth_options['mpcth_color_tm_itembg_hover'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_header_content #mpcth_secondary_nav #mpcth_secondary_menu .menu-item.current-menu-item a {
		<?php echo isset($mpcth_options['mpcth_color_tm_menu_hover']) ? 'color: '. $mpcth_options['mpcth_color_tm_menu_hover'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_tm_itembg_hover']) ? 'background: '. $mpcth_options['mpcth_color_tm_itembg_hover'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_header_content #mpcth_secondary_nav {
		<?php echo isset($mpcth_options['mpcth_color_tm_bg']) ? 'background: '. $mpcth_options['mpcth_color_tm_bg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_header_content #mpcth_top_ribbon {
		<?php echo isset($mpcth_options['mpcth_color_tr_bg']) ? 'background: '. $mpcth_options['mpcth_color_tr_bg'] . ';' . PHP_EOL : ''; ?>
	}

	/* Comment Form */
	/*#mpcth_page_articles #comments #respond #reply-title,*/
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-url input,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-email input,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-author input,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-comment textarea {
		<?php echo isset($mpcth_options['mpcth_color_cf_color']) ? 'color: ' . $mpcth_options['mpcth_color_cf_color'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_cf_bg']) ? 'background: ' . $mpcth_options['mpcth_color_cf_bg'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-url input:hover,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-email input:hover,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-author input:hover,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-comment textarea:hover {
		<?php echo isset($mpcth_options['mpcth_color_cf_color_hover']) ? 'color: ' . $mpcth_options['mpcth_color_cf_color_hover'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_cf_bg_hover']) ? 'background: ' . $mpcth_options['mpcth_color_cf_bg_hover'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-url input:focus,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-email input:focus,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-author input:focus,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-comment textarea:focus {
		<?php echo isset($mpcth_options['mpcth_color_cf_color_hover']) ? 'color: ' . $mpcth_options['mpcth_color_cf_color_hover'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_cf_bg_hover']) ? 'background: ' . $mpcth_options['mpcth_color_cf_bg_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-url input.error,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-email input.error,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-author input.error,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .comment-form-comment textarea.error {
		<?php echo isset($mpcth_options['mpcth_color_cf_color_error']) ? 'color: ' . $mpcth_options['mpcth_color_cf_color_error'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_cf_bg_error']) ? 'background: ' . $mpcth_options['mpcth_color_cf_bg_error'] . ';' . PHP_EOL : ''; ?>
	}

	/*#mpcth_page_articles #comments .commentlist article.comment header.comment-meta span {*/
	#mpcth_page_articles #comments .commentlist article.comment.mpcth-post-author header,
	#mpcth_page_articles #comments .commentlist article.comment.mpcth-post-author header a {
		<?php echo isset($mpcth_options['mpcth_color_cf_author_text']) ? 'color: ' . $mpcth_options['mpcth_color_cf_author_text'] . ';' . PHP_EOL : ''; ?>
		<?php //echo isset($mpcth_options['mpcth_color_cf_author_bg']) ? 'background: ' . $mpcth_options['mpcth_color_cf_author_bg'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform label.error {
		<?php echo isset($mpcth_options['mpcth_color_cf_label_error']) ? 'color: ' . $mpcth_options['mpcth_color_cf_label_error'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_articles #comments .commentlist article.comment .mpcth-comment-color-stripe,
	#mpcth_page_articles #comments .commentlist article.comment.mpcth-post-author header.comment-meta {
		<?php echo isset($mpcth_options['mpcth_color_cf_first_stripe']) ? 'background: ' . $mpcth_options['mpcth_color_cf_first_stripe'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles #comments .commentlist .children article.comment .mpcth-comment-color-stripe,
	#mpcth_page_articles #comments .commentlist .children article.comment.mpcth-post-author header.comment-meta {
		<?php echo isset($mpcth_options['mpcth_color_cf_second_stripe']) ? 'background: ' . $mpcth_options['mpcth_color_cf_second_stripe'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles #comments .commentlist .children .children article.comment .mpcth-comment-color-stripe,
	#mpcth_page_articles #comments .commentlist .children .children article.comment.mpcth-post-author header.comment-meta {
		<?php echo isset($mpcth_options['mpcth_color_cf_third_stripe']) ? 'background: ' . $mpcth_options['mpcth_color_cf_third_stripe'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_articles #comments .commentlist .children .children .children article.comment .mpcth-comment-color-stripe,
	#mpcth_page_articles #comments .commentlist .children .children .children article.comment.mpcth-post-author header.comment-meta {
		<?php echo isset($mpcth_options['mpcth_color_cf_forth_stripe']) ? 'background: ' . $mpcth_options['mpcth_color_cf_forth_stripe'] . ';' . PHP_EOL : ''; ?>
	}

	/* Contact Form */
	#mpcth_contact_form .mpcth-cf-form-author input,
	#mpcth_contact_form .mpcth-cf-form-email input,
	#mpcth_contact_form .mpcth-cf-form-message textarea {
		<?php echo isset($mpcth_options['mpcth_color_cu_color']) ? 'color: ' . $mpcth_options['mpcth_color_cu_color'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_cu_bg']) ? 'background: ' . $mpcth_options['mpcth_color_cu_bg'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_contact_form .mpcth-cf-form-author input:hover,
	#mpcth_contact_form .mpcth-cf-form-email input:hover,
	#mpcth_contact_form .mpcth-cf-form-message textarea:hover {
		<?php echo isset($mpcth_options['mpcth_color_cu_color_hover']) ? 'color: ' . $mpcth_options['mpcth_color_cu_color_hover'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_cu_bg_hover']) ? 'background: ' . $mpcth_options['mpcth_color_cu_bg_hover'] . ';' . PHP_EOL : ''; ?>
	}
	
	#mpcth_contact_form .mpcth-cf-form-author input:focus,
	#mpcth_contact_form .mpcth-cf-form-email input:focus,
	#mpcth_contact_form .mpcth-cf-form-message textarea:focus {
		<?php echo isset($mpcth_options['mpcth_color_cu_color_hover']) ? 'color: ' . $mpcth_options['mpcth_color_cu_color_hover'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_cu_bg_hover']) ? 'background: ' . $mpcth_options['mpcth_color_cu_bg_hover'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_contact_form .mpcth-cf-form-author input.error,
	#mpcth_contact_form .mpcth-cf-form-email input.error,
	#mpcth_contact_form .mpcth-cf-form-message textarea.error {
		<?php echo isset($mpcth_options['mpcth_color_cu_color_error']) ? 'color: ' . $mpcth_options['mpcth_color_cu_color_error'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_cu_bg_error']) ? 'background: ' . $mpcth_options['mpcth_color_cu_bg_error'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_contact_form label.error {
		<?php echo isset($mpcth_options['mpcth_color_cu_label_error']) ? 'color: ' . $mpcth_options['mpcth_color_cu_label_error'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_contact_form .mpcth-cf-success {
		<?php echo isset($mpcth_options['mpcth_color_cu_label_success']) ? 'color: ' . $mpcth_options['mpcth_color_cu_label_success'] . ';' . PHP_EOL : ''; ?>
	}

	/* Logo */
	#mpcth_page_wrap #mpcth_logo {
		<?php echo isset($mpcth_options['mpcth_logo_top']) ? 'margin-top: ' . $mpcth_options['mpcth_logo_top'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_logo_right']) ? 'margin-right: ' . $mpcth_options['mpcth_logo_right'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_logo_bottom']) ? 'margin-bottom: ' . $mpcth_options['mpcth_logo_bottom'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_logo_left']) ? 'margin-left: ' . $mpcth_options['mpcth_logo_left'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_logo h1 {
		<?php echo isset($mpcth_options['mpcth_text_logo_color']) ? 'color: ' . $mpcth_options['mpcth_text_logo_color'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_text_logo_bg']) ? 'background: ' . $mpcth_options['mpcth_text_logo_bg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_logo small {
		<?php echo isset($mpcth_options['mpcth_text_logo_description_color']) ? 'color: ' . $mpcth_options['mpcth_text_logo_description_color'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_text_logo_description_bg']) ? 'background: ' . $mpcth_options['mpcth_text_logo_description_bg'] . ';' . PHP_EOL : ''; ?>
	}

	/* Hidder Button */
	#mpcth_content_toggler {
		<?php echo isset($mpcth_options['mpcth_color_toggler_bg']) ? 'background: ' . $mpcth_options['mpcth_color_toggler_bg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_content_toggler a {
		<?php echo isset($mpcth_options['mpcth_color_toggler_text']) ? 'color: ' . $mpcth_options['mpcth_color_toggler_text'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_content_toggler:hover {
		<?php echo isset($mpcth_options['mpcth_color_toggler_bg_hover']) ? 'background: ' . $mpcth_options['mpcth_color_toggler_bg_hover'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_content_toggler a:hover {
		<?php echo isset($mpcth_options['mpcth_color_toggler_text_hover']) ? 'color: ' . $mpcth_options['mpcth_color_toggler_text_hover'] . ';' . PHP_EOL : ''; ?>
	}

	/* Submit Button */
	#mpcth_page_wrap #mpcth_contact_form #submit,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .form-submit #submit {
		<?php echo isset($mpcth_options['mpcth_color_submit_text']) ? 'color: ' . $mpcth_options['mpcth_color_submit_text'] . ';' . PHP_EOL : ''; ?>
		/*<?php echo isset($mpcth_options['mpcth_color_submit_bg']) ? 'background: ' . $mpcth_options['mpcth_color_submit_bg'] . ';' . PHP_EOL : ''; ?>*/
	}

	#mpcth_page_wrap #mpcth_contact_form #submit:hover,
	#mpcth_page_wrap #mpcth_page_articles #comments #respond #commentform .form-submit #submit:hover {
		<?php echo isset($mpcth_options['mpcth_color_submit_text_hover']) ? 'color: ' . $mpcth_options['mpcth_color_submit_text_hover'] . ';' . PHP_EOL : ''; ?>
		/*<?php echo isset($mpcth_options['mpcth_color_submit_bg_hover']) ? 'background: ' . $mpcth_options['mpcth_color_submit_bg_hover'] . ';' . PHP_EOL : ''; ?>*/
	}

	/* Tabs & Accordions */
	#mpcth_page_wrap .wpb_tour_tabs_wrapper .ui-tabs-anchor,
	#mpcth_page_wrap .wpb_accordion_wrapper .ui-accordion-header a,
	#mpcth_page_wrap .wpb_accordion_wrapper .ui-accordion-header {
		<?php echo isset($mpcth_options['mpcth_color_tabs_heading']) ? 'color: ' . $mpcth_options['mpcth_color_tabs_heading'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_tabs_heading_bg']) ? 'background: ' . $mpcth_options['mpcth_color_tabs_heading_bg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap .wpb_tour_tabs_wrapper .ui-tabs-anchor:hover,
	#mpcth_page_wrap .wpb_accordion_wrapper .ui-accordion-header.ui-accordion-header-active a,
	#mpcth_page_wrap .wpb_accordion_wrapper .ui-accordion-header.ui-accordion-header-active,
	#mpcth_page_wrap .wpb_accordion_wrapper .ui-accordion-header a:hover,
	#mpcth_page_wrap .wpb_accordion_wrapper .ui-accordion-header:hover {
		<?php echo isset($mpcth_options['mpcth_color_tabs_heading_hover']) ? 'color: ' . $mpcth_options['mpcth_color_tabs_heading_hover'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_tabs_heading_bg_hover']) ? 'background: ' . $mpcth_options['mpcth_color_tabs_heading_bg_hover'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap .wpb_accordion_wrapper .ui-accordion-content,
	#mpcth_page_wrap .wpb_tour_tabs_wrapper .wpb_tab {
		<?php echo isset($mpcth_options['mpcth_color_tabs_content']) ? 'color: ' . $mpcth_options['mpcth_color_tabs_content'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_tabs_content_bg']) ? 'background: ' . $mpcth_options['mpcth_color_tabs_content_bg'] . ';' . PHP_EOL : ''; ?>
	}

	/* Blog & Portfolio */
	#mpcth_page_wrap article .mpcth-post-thumbnail {
		<?php echo isset($mpcth_options['mpcth_color_thumb']) ? 'background: ' . $mpcth_options['mpcth_color_thumb'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap article.post small .zilla-likes:before,
	#mpcth_page_wrap article.portfolio small,
	#mpcth_page_wrap article.post small,
	#mpcth_page_wrap #comments header.vcard {
		<?php echo isset($mpcth_options['mpcth_color_meta']) ? 'color: ' . $mpcth_options['mpcth_color_meta'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #comments header.vcard {
		<?php echo isset($mpcth_options['mpcth_color_global_linkhover']) ? 'color: ' . $mpcth_options['mpcth_color_global_linkhover'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap article.post small a,
	#mpcth_page_wrap article.portfolio small a,
	#mpcth_page_wrap #comments header.vcard > a {
		<?php echo isset($mpcth_options['mpcth_color_global_linkhover']) ? 'color: ' . $mpcth_options['mpcth_color_global_linkhover'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap article.post small a:hover,
	#mpcth_page_wrap article.portfolio small a:hover,
	#mpcth_page_wrap #comments header.vcard a:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_link']) ? 'color: ' . $mpcth_options['mpcth_color_global_link'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap article.post .mpcth-portfolio-read-more,
	#mpcth_page_wrap article.post .mpcth-gallery-read-more,
	#mpcth_page_wrap article.post.format-audio .mpcth-post-thumbnail .mpcth-post-audio-note,
	#mpcth_page_wrap article.post .mpcth-blog-read-more {
		<?php echo isset($mpcth_options['mpcth_color_more']) ? 'color: ' . $mpcth_options['mpcth_color_more'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap article.post .mpcth-portfolio-read-more:hover,
	#mpcth_page_wrap article.post .mpcth-gallery-read-more:hover,
	#mpcth_page_wrap article.post.format-audio .mpcth-post-thumbnail .mpcth-post-audio-note:hover,
	#mpcth_page_wrap article.post .mpcth-blog-read-more:hover {
		<?php echo isset($mpcth_options['mpcth_color_more_hover']) ? 'color: ' . $mpcth_options['mpcth_color_more_hover'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap .mpcth-lm-button {
		/*<?php echo isset($mpcth_options['mpcth_color_loadmore']) ? 'color: ' . $mpcth_options['mpcth_color_loadmore'] . ';' . PHP_EOL : ''; ?>*/
		/*<?php echo isset($mpcth_options['mpcth_color_loadmore_bg']) ? 'background: ' . $mpcth_options['mpcth_color_loadmore_bg'] . ';' . PHP_EOL : ''; ?>*/
	}
	#mpcth_page_wrap .mpcth-lm-button:hover {
		/*<?php echo isset($mpcth_options['mpcth_color_loadmore_hover']) ? 'color: ' . $mpcth_options['mpcth_color_loadmore_hover'] . ';' . PHP_EOL : ''; ?>*/
		/*<?php echo isset($mpcth_options['mpcth_color_loadmore_bg_hover']) ? 'background: ' . $mpcth_options['mpcth_color_loadmore_bg_hover'] . ';' . PHP_EOL : ''; ?>*/
	}

	#mpcth_page_wrap article.portfolio a.mpcth-fancybox,
	#mpcth_page_wrap article.post a.mpcth-fancybox {
		<?php echo isset($mpcth_options['mpcth_color_lb']) ? 'color: ' . $mpcth_options['mpcth_color_lb'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap article.portfolio a.mpcth-fancybox:hover,
	#mpcth_page_wrap article.post a.mpcth-fancybox:hover {
		<?php echo isset($mpcth_options['mpcth_color_lb_hover']) ? 'color: ' . $mpcth_options['mpcth_color_lb_hover'] . ';' . PHP_EOL : ''; ?>	
	}

	#mpcth_page_wrap .mpcth-filterable-categories ul li {
		<?php echo isset($mpcth_options['mpcth_color_cat_bg']) ? 'background-color: ' . $mpcth_options['mpcth_color_cat_bg'] . ';' . PHP_EOL : ''; ?>
	}	
	#mpcth_page_wrap .mpcth-filterable-categories ul li a {
		<?php echo isset($mpcth_options['mpcth_color_cat_text']) ? 'color: ' . $mpcth_options['mpcth_color_cat_text'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap .mpcth-filterable-categories ul li.active,
	#mpcth_page_wrap .mpcth-filterable-categories ul li:hover {
		<?php echo isset($mpcth_options['mpcth_color_cat_bg_hover']) ? 'background-color: ' . $mpcth_options['mpcth_color_cat_bg_hover'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap .mpcth-filterable-categories ul li.active a,
	#mpcth_page_wrap .mpcth-filterable-categories ul li:hover a {
		<?php echo isset($mpcth_options['mpcth_color_cat_text_hover']) ? 'color: ' . $mpcth_options['mpcth_color_cat_text_hover'] . ';' . PHP_EOL : ''; ?>
	}

	/* Other */
	#mpcth_page_wrap hr {
		<?php echo isset($mpcth_options['mpcth_color_hr_color']) ? 'background-color: ' . $mpcth_options['mpcth_color_hr_color'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap .wpb_separator,
	#mpcth_page_wrap .vc_text_separator {
		<?php echo isset($mpcth_options['mpcth_color_hr_color']) ? 'border-bottom-color: ' . $mpcth_options['mpcth_color_hr_color'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap .vc_text_separator div {
		<?php echo isset($mpcth_options['mpcth_color_hr_label_color']) ? 'background: ' . $mpcth_options['mpcth_color_hr_label_color'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_hr_font_color']) ? 'color: ' . $mpcth_options['mpcth_color_hr_font_color'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_sidebar ul.parent_menu_item > li .widget_title {
		<?php echo isset($mpcth_options['mpcth_color_sidebar_heading']) ? 'color: ' . $mpcth_options['mpcth_color_sidebar_heading'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_sidebar ul.parent_menu_item > li,
	#mpcth_page_wrap #mpcth_sidebar ul.parent_menu_item > li a {
		<?php echo isset($mpcth_options['mpcth_color_sidebar_text']) ? 'color: ' . $mpcth_options['mpcth_color_sidebar_text'] . ';' . PHP_EOL : ''; ?>	
	}

	#mpcth_page_wrap #mpcth_sidebar ul.parent_menu_item > li a:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_linkhover']) ? 'color: ' . $mpcth_options['mpcth_color_global_linkhover'] . ';' . PHP_EOL : ''; ?>	
	}


	#mpcth_page_wrap .mpcth-footer-copyright {
		<?php echo isset($mpcth_options['mpcth_color_copyright_text']) ? 'color: ' . $mpcth_options['mpcth_color_copyright_text'] . '!important;' . PHP_EOL : ''; ?>
	}


	#mpcth_page_wrap .mpcth-sc-tooltip-wrap .mpcth-sc-tooltip {
		<?php echo isset($mpcth_options['mpcth_color_tooltip_text']) ? 'color: ' . $mpcth_options['mpcth_color_tooltip_text'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_color_tooltip_bg']) ? 'background: ' . $mpcth_options['mpcth_color_tooltip_bg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap .mpcth-sc-tooltip-wrap .mpcth-sc-tooltip:after {
		<?php echo isset($mpcth_options['mpcth_color_tooltip_bg']) ? 'border-color: ' . $mpcth_options['mpcth_color_tooltip_bg'] . ';' . PHP_EOL : ''; ?>
	}


	#mpcth_aside_menu_section #mpcth_bottom_footer #searchform #s {
		<?php echo isset($mpcth_options['mpcth_color_search_form_text']) ? 'color: ' . $mpcth_options['mpcth_color_search_form_text'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_aside_menu_section #mpcth_bottom_footer #searchform #s {
		<?php echo isset($mpcth_options['mpcth_color_search_form_bg']) ? 'background: ' . $mpcth_options['mpcth_color_search_form_bg'] . ';' . PHP_EOL : ''; ?>
	}


	#mpcth_page_wrap #mpcth_top_widget_area_content > ul > li .widget_title {
		<?php echo isset($mpcth_options['mpcth_color_top_widget_area_heading']) ? 'color: ' . $mpcth_options['mpcth_color_top_widget_area_heading'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_top_widget_area_content > ul > li,
	#mpcth_page_wrap #mpcth_top_widget_area_content > ul > li p,
	#mpcth_page_wrap #mpcth_top_widget_area_content > ul > li a {
		<?php echo isset($mpcth_options['mpcth_color_top_widget_area_text']) ? 'color: ' . $mpcth_options['mpcth_color_top_widget_area_text'] . ' !important;' . PHP_EOL : ''; ?>	
	}

	#mpcth_page_wrap #mpcth_top_widget_area_content > ul > li a:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_linkhover']) ? 'color: ' . $mpcth_options['mpcth_color_global_linkhover'] . ' !important;' . PHP_EOL : ''; ?>	
	}


	#mpcth_page_wrap #mpcth_footer > #mpcth_footer_content > ul > li .widget_title {
		<?php echo isset($mpcth_options['mpcth_color_footer_heading']) ? 'color: ' . $mpcth_options['mpcth_color_footer_heading'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_footer > #mpcth_footer_content > ul > li
	#mpcth_page_wrap #mpcth_footer > #mpcth_footer_content > ul > li a {
		<?php echo isset($mpcth_options['mpcth_color_footer_text']) ? 'color: ' . $mpcth_options['mpcth_color_footer_text'] . ';' . PHP_EOL : ''; ?>	
	}

	#mpcth_page_wrap #mpcth_footer > #mpcth_footer_content > ul > li a:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_linkhover']) ? 'color: ' . $mpcth_options['mpcth_color_global_linkhover'] . ';' . PHP_EOL : ''; ?>	
	}

	#mpcth_page_wrap .mpcth-social-bg {
		<?php echo isset($mpcth_options['mpcth_social_bg_color']) ? 'background-color: ' . $mpcth_options['mpcth_social_bg_color'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_page_container #mpcth_page_content
	/* .page-template-default #mpcth_page_articles,
	 #mpcth_page_articles.mpcth-single-post */ {
		<?php echo 'width: 100%;' . PHP_EOL; ?>
		<?php echo 'max-width: ' . $page_size . ';' . PHP_EOL; ?>
		<?php
			if($page_align == 'center') {
				echo 'float: none;' . PHP_EOL;
				echo 'margin-left: auto !important;' . PHP_EOL;
				echo 'margin-right: auto !important;' . PHP_EOL;
			} else {
				echo 'float: ' . $page_align . ';' . PHP_EOL;
			}
		?>
	}

	<?php if($swapToggler) { ?>
	#mpcth_content_toggler {
		right: 20px !important;
		left: auto !important;
	}
	<?php } ?>

	#mpcth_sidebar .quick-flickr-item {
		<?php echo isset($mpcth_options['mpcth_color_global_link']) ? 'background: '. $mpcth_options['mpcth_color_global_link'] . ' !important;' . PHP_EOL : ''; ?>
	}

	/* Twitter Widget */
	#mpcth_page_wrap #mpcth_top_widget_area .mpcth-twitter-widget .twtr-tweet-text a.twtr-timestamp,
	#mpcth_page_wrap #mpcth_top_widget_area .mpcth-twitter-widget .twtr-tweet-text a.twtr-user {
		<?php echo isset($mpcth_options['mpcth_color_top_widget_area_text']) ? 'color: '. $mpcth_options['mpcth_color_top_widget_area_text'] . ' !important;' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_top_widget_area .mpcth-twitter-widget .twtr-tweet-text a {
		<?php echo isset($mpcth_options['mpcth_color_meta']) ? 'color: '. $mpcth_options['mpcth_color_meta'] . ' !important;' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_top_widget_area .mpcth-twitter-widget .twtr-tweet-text a:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_linkhover']) ? 'color: '. $mpcth_options['mpcth_color_global_linkhover'] . ' !important;' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_sidebar .mpcth-twitter-widget .twtr-tweet-text a.twtr-timestamp,
	#mpcth_page_wrap #mpcth_sidebar .mpcth-twitter-widget .twtr-tweet-text a.twtr-user {
		<?php echo isset($mpcth_options['mpcth_color_sidebar_text']) ? 'color: '. $mpcth_options['mpcth_color_sidebar_text'] . ' !important;' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_sidebar .mpcth-twitter-widget .twtr-tweet-text a {
		<?php echo isset($mpcth_options['mpcth_color_meta']) ? 'color: '. $mpcth_options['mpcth_color_meta'] . ' !important;' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_sidebar .mpcth-twitter-widget .twtr-tweet-text a:hover {
		<?php echo isset($mpcth_options['mpcth_color_global_linkhover']) ? 'color: '. $mpcth_options['mpcth_color_global_linkhover'] . ' !important;' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_sidebar .mpcth-twitter-widget .twtr-tweet,
	#mpcth_page_wrap #mpcth_sidebar .mpcth-twitter-widget .twtr-tweet p,
	#mpcth_page_wrap #mpcth_sidebar .mpcth-twitter-widget .twtr-tweet em {
		<?php echo isset($mpcth_options['mpcth_sidebar_font_size']) ? 'font-size: '. $mpcth_options['mpcth_sidebar_font_size'] . ' !important;' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_sidebar .mpcth-twitter-widget .twtr-tweet .twtr-user {
		<?php //echo isset($mpcth_options['mpcth_sidebar_heading_font_size']) ? 'font-size: '. $mpcth_options['mpcth_sidebar_heading_font_size'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_sidebar_font_size']) ? 'font-size: '. $mpcth_options['mpcth_sidebar_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_top_widget_area .mpcth-twitter-widget .twtr-tweet,
	#mpcth_page_wrap #mpcth_top_widget_area .mpcth-twitter-widget .twtr-tweet p,
	#mpcth_page_wrap #mpcth_top_widget_area .mpcth-twitter-widget .twtr-tweet em {
		<?php echo isset($mpcth_options['mpcth_top_widget_font_size']) ? 'font-size: '. $mpcth_options['mpcth_top_widget_font_size'] . ' !important;' . PHP_EOL : ''; ?>
	}
	#mpcth_page_wrap #mpcth_top_widget_area .mpcth-twitter-widget .twtr-tweet .twtr-user {
		<?php //echo isset($mpcth_options['mpcth_top_widget_heading_font_size']) ? 'font-size: '. $mpcth_options['mpcth_top_widget_heading_font_size'] . ';' . PHP_EOL : ''; ?>
		<?php echo isset($mpcth_options['mpcth_top_widget_font_size']) ? 'font-size: '. $mpcth_options['mpcth_top_widget_font_size'] . ';' . PHP_EOL : ''; ?>
	}

	/* Top WIdget Area */
	#mpcth_top_widget_area #mpcth_top_widget_area_handle:after {
		<?php echo isset($mpcth_options['mpcth_top_widget_bg']) ? 'border-color: '. $mpcth_options['mpcth_top_widget_bg'] . ';' . PHP_EOL : ''; ?>
	}
	#mpcth_top_widget_area .mpcth-recent-posts-list .mpcth-recent-posts-data {
		<?php echo isset($mpcth_options['mpcth_color_meta']) ? 'color: ' . $mpcth_options['mpcth_color_meta'] . ';' . PHP_EOL : ''; ?>
	}

	/* Borders */
	.page-template-default .mpcth-layout-fluid #mpcth_page_container #mpcth_page_content #mpcth_page_articles article,
	#mpcth_page_wrap #mpcth_page_articles #comments,
	#mpcth_page_wrap #mpcth_page_articles > article,
	#mpcth_page_wrap #mpcth_page_articles > article .mpcth-post-thumbnail,
	#mpcth_page_wrap #mpcth_page_articles > article .mpcth-post-content,
	#mpcth_page_wrap #mpcth_sidebar > ul > li,
	.page-template-blog-template-php #mpcth_page_wrap #mpcth_lm {
		<?php echo isset($mpcth_options['mpcth_color_border_color']) ? 'border-color: '. $mpcth_options['mpcth_color_border_color'] . ';' . PHP_EOL : ''; ?>
	}

	#mpcth_page_wrap #mpcth_page_articles > article .mpcth-corner-tl,
	#mpcth_page_wrap #mpcth_page_articles > article .mpcth-corner-tr,
	#mpcth_page_wrap #mpcth_page_articles > article .mpcth-corner-bl,
	#mpcth_page_wrap #mpcth_page_articles > article .mpcth-corner-br,
	.page-template-blog-template-php #mpcth_page_wrap #mpcth_lm .mpcth-corner-tl,
	.page-template-blog-template-php #mpcth_page_wrap #mpcth_lm .mpcth-corner-tr,
	.page-template-blog-template-php #mpcth_page_wrap #mpcth_lm .mpcth-corner-bl,
	.page-template-blog-template-php #mpcth_page_wrap #mpcth_lm .mpcth-corner-br,
	#mpcth_page_wrap #mpcth_page_articles #comments .mpcth-corner-tl,
	#mpcth_page_wrap #mpcth_page_articles #comments .mpcth-corner-tr,
	#mpcth_page_wrap #mpcth_page_articles #comments .mpcth-corner-bl,
	#mpcth_page_wrap #mpcth_page_articles #comments .mpcth-corner-br,
	#mpcth_page_wrap #mpcth_sidebar > ul > li .mpcth-corner-tl,
	#mpcth_page_wrap #mpcth_sidebar > ul > li .mpcth-corner-tr,
	#mpcth_page_wrap #mpcth_sidebar > ul > li .mpcth-corner-bl,
	#mpcth_page_wrap #mpcth_sidebar > ul > li .mpcth-corner-br {
		<?php echo isset($mpcth_options['mpcth_color_border_corner_color']) ? 'border-color: '. $mpcth_options['mpcth_color_border_corner_color'] . ';' . PHP_EOL : ''; ?>
	}
	
</style>
<?php }

function mpcth_admin_alternative_styles() { ?>
	
	<!--[if lte IE 10]>
		<link rel="stylesheet" href="<?php echo MPC_THEME_ROOT ?>/mpc-wp-boilerplate/massive-panel/css/ie.css"/>
	<![endif]-->

<?php } ?>