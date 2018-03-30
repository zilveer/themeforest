<?php 
	add_action('wp_head','ebor_custom_colours', 100);
	function ebor_custom_colours(){
	
	$heading_font = get_option('heading_font', 'Montserrat');
	$body_font = get_option('body_font', 'Roboto Slab');
	$page_wrapper = get_option('footer_colour','#ffffff');
	$text_colour = get_option('text_colour','#666666');
	$heading_colour = get_option('heading_text_colour','#444444');
	$heading_link = get_option('heading_link_colour','#222222');
	$heading_link_rgb = hex2rgb( get_option('heading_link_colour','#222222') );
	$meta = get_option('meta_colour','#d9d9d9');
	$animation_speed = get_option('animation_speed','600');
	$lightbox_background = hex2rgb( get_option('lightbox_background','#000000') );
	$border_style = get_option('border_style','dashed');
	$header_width = get_option('menu_width','210');
	$sidebar_width = get_option('sidebar_width','210');
	$menu_margin = get_option('menu_margin','35');
?>
	
<style type="text/css">
	
	body, input[type="text"], input[type="submit"], textarea, .portfolio-index-title, .date-title, h4 span.meta, .resp-easy-accordion h2.resp-accordion {
		font-family: '<?php echo $body_font; ?>', sans-serif;
	}
	
	h1, h2, h3, h4, h5, h6, .widget-title {
		font-family: '<?php echo $heading_font; ?>', sans-serif;
		color: <?php echo $heading_colour; ?>;
	}
	
	body, .scrollbar .handle, pre {
		color: <?php echo $text_colour; ?>;
	}
	
	#top-header #main-nav ul ul li {
		background-color: #<?php echo get_background_color(); ?>;
	}
	
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, a {
		color: <?php echo $heading_link; ?>;
	}
	
	#menu-button {
		background: <?php echo $heading_link; ?>;
		color: #fff;
	}
	
	.current-menu-item > a, .current-menu-parent > a {
		color: rgba(<?php echo $heading_link_rgb; ?>,0.4);
	}
	
	.wrapper.boxed {
		background: <?php echo $page_wrapper; ?>;
		padding: 30px;
	}
	
	input[type="text"], input[type="email"], input[type="submit"], textarea, input[type="password"], pre, hr, blockquote, #sub-header, #main-nav a, .menu-link, .blog article.post, .single article.post, article.page, .search article, .pagination, .pagination a, #comments > ol > li, .feed-wrapper article .feed-details, #main-footer, img.wpcf7-form-control.wpcf7-captchac, table, table th, table td, #main-header #main-nav a, #top-header, #top-header #main-nav ul ul li, .mobile-dropdown #top-header #main-nav a, .page-template-page_sidebar-php article.page {
		border-color: <?php echo $meta; ?>;
	}
	
	.ebor-tabs *, .resp-vtabs li.resp-tab-active, .resp-vtabs div.resp-tab-content.resp-tab-content-active {
		border-color: <?php echo $meta; ?> !important;
	}
	
	.scrollbar {
		background: <?php echo $meta; ?>;
	}
	
	.wrapper > aside, #content > aside {
		width: <?php echo $sidebar_width; ?>px;
	}
	
	#main-header {
		width: <?php echo $header_width; ?>px;
	}
	
	#top-header #main-nav, #menu-button {
		margin-top: <?php echo $menu_margin; ?>px;
	}
	
	<?php if( get_option('lightbox_animations', '0') == 1 ) : ?>
		.viewer li{
			-webkit-transition: width <?php echo $animation_speed; ?>ms cubic-bezier(0.075, 0.820, 0.165, 1.000);
			-moz-transition: width <?php echo $animation_speed; ?>ms cubic-bezier(0.075, 0.820, 0.165, 1.000);
			transition: width <?php echo $animation_speed; ?>ms cubic-bezier(0.075, 0.820, 0.165, 1.000);
		}
		.viewer .caption{
			visibility: hidden;
			opacity: 0;
			-webkit-transition: opacity 1.5s ease-in-out;
			-moz-transition: opacity 1.5s ease-in-out;
			transition: opacity 1.5s ease-in-out;
		}
		.viewer .current .caption{
			opacity: 100;
			visibility: visible;
		}
	<?php endif; ?>
	
	.viewer {
		background-color: rgba(<?php echo $lightbox_background; ?>,0.8);
	}
	
	<?php echo get_option('custom_css'); ?>
	
</style>
	
<?php }

add_action('login_head','ebor_custom_admin');
function ebor_custom_admin(){
	if( get_option('custom_login_logo') )
		echo '<style type="text/css">
				.login h1 a { 
					background-image: url("'.get_option('custom_login_logo').'"); 
					background-size: auto 80px;
					width: 100%; 
				} 
			</style>';
}