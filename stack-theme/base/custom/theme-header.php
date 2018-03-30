<?php
// Content in this file will be included in "wp_head"
?>

<!-- Theme Dynamic CSS -->
<style type="text/css">
	/* Logo */
	#branding { margin-top: <?php echo theme_options('header', 'logo_margin_top'); ?>px; }

	/* Font */
	body { font-family: <?php echo theme_options('font', 'general_family'); ?>; font-size: <?php echo theme_options('font', 'general_font_size'); ?>px; line-height: 1.5em; }
	h1 { font-size: <?php echo theme_options('font', 'general_font_size')+12; ?>px; line-height: 1.5em; }
	h2 { font-size: <?php echo theme_options('font', 'general_font_size')+10; ?>px; line-height: 1.5em; }
	h3 { font-size: <?php echo theme_options('font', 'general_font_size')+8; ?>px; line-height: 1.5em; }
	h4 { font-size: <?php echo theme_options('font', 'general_font_size')+6; ?>px; line-height: 1.5em; }
	h5 { font-size: <?php echo theme_options('font', 'general_font_size')+4; ?>px; line-height: 1.5em; }
	h6 { font-size: <?php echo theme_options('font', 'general_font_size')+2; ?>px; line-height: 1.5em; }
	#primary-nav { font-size: <?php echo theme_options('font', 'nav_font_size'); ?>px; }

	/* RevSlider */
	.tp-caption.heading, .tp-caption.balloon-big, .tp-caption.balloon-medium, .tp-caption.balloon-small {
		background-color: <?php echo hex2rgb( theme_options('appearance', 'site_color'), 'rgba(%d, %d, %d, 0.8)' ); ?>;
	}
	.tp-caption.balloon-big:after, .tp-caption.balloon-medium:after, .tp-caption.balloon-small:after { border-color: <?php echo hex2rgb( theme_options('appearance', 'site_color'), 'rgba(%d, %d, %d, 0.8)' ); ?> transparent; }

	/* BG Color */
	header.dark, .skill-score, ul.filter-button-list li a, .slide-control:hover a.has-sub, .button-primary, .stack-callout.bg-dark, .stack-section-title.bg-dark,	ul.price-list li.row-title, .stack-callout.bg-light .callout-icon, .post-content .slide-control a:hover, .button:hover, .button.active, .post-content .img-box .overlay .overlay-mask, #comments .comment-reply-link:hover, #comments .comment-edit-link:hover, .theme-form input[type="submit"], .theme-form input[type="submit"]:hover, .wpcf7-form input[type="submit"] { background-color: <?php echo theme_options('appearance', 'site_color'); ?>; }

	/* Color */
	a, .color-scheme, .dropcap, header.dark #social-box a, header.dark #social-box form input, .stack-callout em, .stack-callout.bg-dark .button-primary, ul.price-list li.row-price sup, ul.price-list li.row-price em, header.light #primary-nav a:hover, header.dark #primary-nav ul li a:hover, .stack-callout.bg-dark .callout-icon, .feature-title i, .widget-title .word1, .stack-section-title h1 em { color: <?php echo theme_options('appearance', 'site_color'); ?>; }

	/* Border */
	header.light, aside .widget_pages ul li.current_page_item > a, .img-box:hover .overlay-always, aside .widget_sub_nav ul li.current_page_item > a, aside .widget_nav_menu ul li.current_page_item > a, aside .widget_pages ul li.current_page_item > a { border-color: <?php echo theme_options('appearance', 'site_color'); ?>; }
	
	/* Header */
	<?php if( theme_options('header', 'bg_color') ): ?>
		header.dark { background-color: <?php echo theme_options('header', 'bg_color'); ?>; }
		header.dark #social-box a,
		header.dark #social-box form input { color: <?php echo theme_options('header', 'bg_color'); ?>; }
	<?php endif; ?>

	/* Background */
	body { 
		<?php if( theme_options('appearance', 'site_layout') == 'boxed' ): ?>
			<?php if( theme_options('appearance', 'site_bg_image') ): ?>
				background-color: <?php echo theme_options('appearance', 'site_bg_color'); ?>;
				background-image: url( <?php echo get_attachment_src_from_id( theme_options('appearance', 'site_bg_image') ); ?> );
				<?php if( theme_options('appearance', 'site_bg_repeat') != 'stretch' ): ?>
					background-repeat: <?php echo theme_options('appearance', 'site_bg_repeat'); ?>;
				<?php else: ?>
					background-size: cover;
				<?php endif; ?>
			<?php elseif( theme_options('appearance', 'site_bg_pattern') ): ?>
				background-image: url( <?php echo THEME_URI . '/images/patterns/' . theme_options('appearance', 'site_bg_pattern'); ?> );
				background-repeat: repeat;
				background-color: <?php echo theme_options('appearance', 'site_bg_color'); ?>;
			<?php else: ?>
				background-color: <?php echo theme_options('appearance', 'site_bg_color'); ?>;
			<?php endif; ?>
		<?php endif; ?>
	}

</style>
<!-- End Theme Dynamic CSS -->

<!-- Theme Custom CSS -->
<style type="text/css">
<?php echo theme_options('advance', 'custom_css'); ?>
</style>
<!-- End Theme Custom CSS -->

<!-- Theme Custom JS -->
<script type="text/javascript">
jQuery(document).ready(function($) {
<?php echo theme_options('advance', 'custom_js'); ?>
});	
</script>
<!-- End Theme Custom JS -->

<!-- Google Web Font -->
<?php 
// Font to Apply
$google_font = theme_options('font', 'google_web_font');
if( $google_font != '' ): 
	// Apply List
	$apply_lists = array( 'h1, h2, h3, h4, h5, h6, .widget-title, .callout-text, #primary-nav, .feature-title, .stack-title, .slide-title, .row-title' );
	$site_wide_active_selector = '';
	$site_wide_loading_selector = '';
	$site_wide_inactive_selector = '';
	foreach( $apply_lists as $apply_list ) {
		$site_wide_active_selector .= '.wf-active ' . $apply_list . ',';
		$site_wide_loading_selector .= '.wf-loading ' . $apply_list . ', ';
		$site_wide_inactive_selector .= '.wf-inactive ' . $apply_list . ', ';
	}
	$site_wide_active_selector = rtrim( $site_wide_active_selector, ',' );
	$site_wide_loading_selector = rtrim( $site_wide_loading_selector, ',' );
	$site_wide_inactive_selector = rtrim( $site_wide_loading_selector, ',' );
?>

<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ '<?php echo str_replace( ' ', '+', $google_font ); ?>' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();
</script>

<style type="text/css">
	/* Google Web Font */
	<?php echo $site_wide_active_selector; ?> {
	  font-family: "<?php echo $google_font; ?>";
	  visibility: visible;
	}
	<?php echo $site_wide_loading_selector; ?> { visibility: hidden; }
	<?php echo $site_wide_inactive_selector; ?> { visibility: hidden; }
</style>

<?php endif; ?>
<!-- End Google Web Font -->