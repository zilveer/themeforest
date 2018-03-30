<?php // Top Panel
	/* Top panel bg options */
	function pt_output_top_panel_bg() {
		if ( handy_get_option( 'top_panel_bg' ) && handy_get_option( 'top_panel_bg_color' ) != '' ) {
			echo ' style="background-color: '.esc_attr(handy_get_option( 'top_panel_bg_color' )).';"';
		} else {
			return null;
		}
	} ?>
	<div class="header-top"<?php pt_output_top_panel_bg(); ?>><!-- Header top section -->
		<div class="container">
			<div class="row">
				<div class="top-nav-container col-md-4 col-sm-4 col-xs-12">
					<?php if (has_nav_menu( 'header-top-nav' )) : ?>
						<nav class="header-top-nav" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
							<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'plumtree' ); ?></a>
							<?php wp_nav_menu( array('theme_location'  => 'header-top-nav', 'depth' => 1,) ); ?>
						</nav>
					<?php endif;?>
				</div>
				<div class="info-container col-md-4 col-sm-4 col-xs-12">
					<?php if ( handy_get_option('top_panel_info') !='' ) echo ( handy_get_option('top_panel_info') ); ?>
				</div>
				<div class="top-widgets col-md-4 col-sm-4 col-xs-12">
					<?php if ( is_active_sidebar('top-sidebar') ) dynamic_sidebar( 'top-sidebar' ); ?>
				</div>
			</div>
		</div>
	</div><!-- end of Header top section -->
