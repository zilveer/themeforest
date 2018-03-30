<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function solopine_customizer_css() {
    ?>
    <style type="text/css">
	
		#logo { padding:<?php echo get_theme_mod( 'sp_header_padding' ); ?>px 0; }
		
		#navigation, .slicknav_menu { background:<?php echo get_theme_mod( 'sp_topbar_bg' ); ?>; }
		#navigation .menu li a, .slicknav_nav a { color:<?php echo get_theme_mod( 'sp_topbar_nav_color' ); ?>; }
		#navigation .menu li a:hover {  color:<?php echo get_theme_mod( 'sp_topbar_nav_color_active' ); ?>; }
		.slicknav_nav a:hover { color:<?php echo get_theme_mod( 'sp_topbar_nav_color_active' ); ?>; background:none; }
		
		#navigation .menu .sub-menu, #navigation .menu .children { background: <?php echo get_theme_mod( 'sp_drop_bg' ); ?>; }
		#navigation ul.menu ul a, #navigation .menu ul ul a { border-color: <?php echo get_theme_mod( 'sp_drop_border' ); ?>; color:<?php echo get_theme_mod( 'sp_drop_text_color' ); ?>; }
		#navigation ul.menu ul a:hover, #navigation .menu ul ul a:hover { color: <?php echo get_theme_mod( 'sp_drop_text_hover_color' ); ?>; background:<?php echo get_theme_mod( 'sp_drop_text_hover_bg' ); ?>; }
		
		#top-social a i { color:<?php echo get_theme_mod( 'sp_topbar_social_color' ); ?>; }
		#top-social a:hover i { color:<?php echo get_theme_mod( 'sp_topbar_social_color_hover' ); ?> }
		
		#top-search a { background:<?php echo get_theme_mod( 'sp_topbar_search_bg' ); ?> }
		#top-search a { color:<?php echo get_theme_mod( 'sp_topbar_search_magnify' ); ?> }
		#top-search a:hover { background:<?php echo get_theme_mod( 'sp_topbar_search_bg_hover' ); ?>; }
		#top-search a:hover { color:<?php echo get_theme_mod( 'sp_topbar_search_magnify_hover' ); ?>; }
		
		.widget-title { background:<?php echo get_theme_mod( 'sp_footer_widget_bg' ); ?>; color:<?php echo get_theme_mod( 'sp_footer_widget_color' ); ?>; }
		#sidebar .widget-title { background:<?php echo get_theme_mod( 'sp_sidebar_bg' ); ?>; color:<?php echo get_theme_mod( 'sp_sidebar_color' ); ?>; }
		<?php if(get_theme_mod( 'sp_sidebar_social_bg' )) : ?>.widget-social a i { background:<?php echo get_theme_mod( 'sp_sidebar_social_bg' ); ?> }<?php endif; ?>
		<?php if(get_theme_mod( 'sp_sidebar_social_color' )) : ?>.widget-social a i { color:<?php echo get_theme_mod( 'sp_sidebar_social_color' ); ?> }<?php endif; ?>
		<?php if(get_theme_mod( 'sp_sidebar_social_bg_hover' )) : ?>.widget-social a:hover > i { background:<?php echo get_theme_mod( 'sp_sidebar_social_bg_hover' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sp_sidebar_social_color_hover' )) : ?>.widget-social a:hover > i { color:<?php echo get_theme_mod( 'sp_sidebar_social_color_hover' ); ?>; }<?php endif; ?>
		
		#footer-social  { background:<?php echo get_theme_mod( 'sp_footer_social_bg' ); ?>; }
		
		#footer-logo { background:<?php echo get_theme_mod( 'sp_footer_logo_bg' ); ?>; }
		#footer-logo p { color:<?php echo get_theme_mod( 'sp_footer_logo_color' ); ?>; }
		
		#footer-copyright { background:<?php echo get_theme_mod( 'sp_footer_copyright_bg' ); ?>; }
		#footer-copyright p { color:<?php echo get_theme_mod( 'sp_footer_copyright_color' ); ?>; }
		
		a, #footer-logo p i { color:<?php echo get_theme_mod( 'sp_color_accent' ); ?>; }
		.post-entry blockquote p { border-left:3px solid <?php echo get_theme_mod( 'sp_color_accent' ); ?>; }
		
		.post-header h1 a, .post-header h2 a, .post-header h1 { color:<?php echo get_theme_mod( 'sp_posts_title_color' ); ?> }
		
		.share-box { background:<?php echo get_theme_mod( 'sp_posts_share_box_bg' ); ?>; border-color:<?php echo get_theme_mod( 'sp_posts_share_box_border' ); ?>; }
		.share-box i { color:<?php echo get_theme_mod( 'sp_posts_share_box_color' ); ?>; }
		.share-box:hover { background:<?php echo get_theme_mod( 'sp_posts_share_box_bg_hover' ); ?>; border-color:<?php echo get_theme_mod( 'sp_posts_share_box_border_hover' ); ?>; }
		.share-box:hover > i { color:<?php echo get_theme_mod( 'sp_posts_share_box_color_hover' ); ?>; }
		
		<?php if(get_theme_mod( 'sp_post_title_lowercase' )) : ?>
		.post-header h1 a, .post-header h2 a, .post-header h1 {
			text-transform:none;
			letter-spacing:1px;
		}
		<?php endif; ?>
		
		<?php if(get_theme_mod( 'sp_custom_css' )) : ?>
		<?php echo get_theme_mod( 'sp_custom_css' ); ?>
		<?php endif; ?>
		
    </style>
    <?php
}
add_action( 'wp_head', 'solopine_customizer_css' );

?>