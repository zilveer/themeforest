<?php
//////////////////////////////////////////////////////////////////
// Customizer - Add CSS
//////////////////////////////////////////////////////////////////
function solopine_customizer_css() {
    ?>
    <style type="text/css">
	
		#logo { padding:<?php echo get_theme_mod( 'sp_header_padding_top' ); ?>px 0 <?php echo get_theme_mod( 'sp_header_padding_bottom' ); ?>px; }
		
		<?php if(get_theme_mod( 'sp_topbar_bg' )) : ?>#top-bar, .slicknav_menu { background:<?php echo get_theme_mod( 'sp_topbar_bg' ); ?>; }<?php endif; ?>
		<?php if(get_theme_mod( 'sp_topbar_nav_color' )) : ?>.menu li a, .slicknav_nav a { color:<?php echo get_theme_mod( 'sp_topbar_nav_color' ); ?>; }<?php endif; ?>
		.menu li.current-menu-item a, .menu li.current_page_item a, .menu li a:hover {  color:<?php echo get_theme_mod( 'sp_topbar_nav_color_active' ); ?>; }
		.slicknav_nav a:hover { color:<?php echo get_theme_mod( 'sp_topbar_nav_color_active' ); ?>; background:none; }
		
		.menu .sub-menu, .menu .children { background: <?php echo get_theme_mod( 'sp_drop_bg' ); ?>; }
		ul.menu ul a, .menu ul ul a { <?php if(get_theme_mod( 'sp_drop_border' )) : ?>border-top: 1px solid <?php echo get_theme_mod( 'sp_drop_border' ); ?>;<?php endif; ?> color:<?php echo get_theme_mod( 'sp_drop_text_color' ); ?>; }
		ul.menu ul a:hover, .menu ul ul a:hover { color: <?php echo get_theme_mod( 'sp_drop_text_hover_color' ); ?>; background:<?php echo get_theme_mod( 'sp_drop_text_hover_bg' ); ?>; }
		
		#top-social a i { color:<?php echo get_theme_mod( 'sp_topbar_social_color' ); ?>; }
		#top-social a:hover i { color:<?php echo get_theme_mod( 'sp_topbar_social_color_hover' ); ?> }
		
		#top-search a { background:<?php echo get_theme_mod( 'sp_topbar_search_bg' ); ?> }
		#top-search a { color:<?php echo get_theme_mod( 'sp_topbar_search_magnify' ); ?> }
		
		#footer-instagram { background:<?php echo get_theme_mod( 'sp_footer_insta_bg' ); ?>; }
		#footer-instagram h4.block-heading { color:<?php echo get_theme_mod( 'sp_footer_insta_text' ); ?>; }
		
		#footer-social { background:<?php echo get_theme_mod( 'sp_footer_social_bg' ); ?>; }
		#footer-social a i { color:<?php echo get_theme_mod( 'sp_footer_social_bg' ); ?>; background:<?php echo get_theme_mod( 'sp_footer_social_icon' ); ?>; }
		#footer-social a { color:<?php echo get_theme_mod( 'sp_footer_social_icon' ); ?>; }
		
		#footer-copyright { color:<?php echo get_theme_mod( 'sp_footer_copyright_text' ); ?>; background:<?php echo get_theme_mod( 'sp_footer_copyright_bg' ); ?>;  }
		
		.widget-heading { color:<?php echo get_theme_mod( 'sp_sidebar_heading' ); ?>; }
		.widget-heading > span:before, .widget-heading > span:after { border-color: <?php echo get_theme_mod( 'sp_sidebar_heading_line' ); ?>; }
		
		.widget-social a i { color:<?php echo get_theme_mod( 'sp_sidebar_social_icon' ); ?>; background:<?php echo get_theme_mod( 'sp_sidebar_social_bg' ); ?>; }
		
		a, .author-content a.author-social:hover { color:<?php echo get_theme_mod( 'sp_color_accent' ); ?>; }
		.more-button:hover, .post-share a i:hover, .post-pagination a:hover, .pagination a:hover, .widget .tagcloud a { background:<?php echo get_theme_mod( 'sp_color_accent' ); ?>; }
		.more-button:hover, .post-share a i:hover { border-color:<?php echo get_theme_mod( 'sp_color_accent' ); ?>;  }
		<?php if(get_theme_mod( 'sp_color_accent' )) : ?>.post-entry blockquote { border-color:<?php echo get_theme_mod( 'sp_color_accent' ); ?>; }<?php endif; ?>
		
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