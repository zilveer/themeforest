<?php global $majesty_options; ?>
<header id="vertical-header" class="header-transparent">
	<div class="container">
		<div class="row">
			<div class="vertical-menu">
				<nav id="vertical-menu" class="dark cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" >
					<button id="menu-button"><i class="fa fa-bars"></i></button>
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo esc_url( $majesty_options['vertical-logo'] ); ?>" class="img-responsive" alt="<?php bloginfo('name'); ?>"></a>
				  <?php
					$menu_location 	= 'top-menu';
					$menu_class 	= '';
					if( ! empty( $majesty_options['pages_second_menu'] ) && in_array( sama_get_current_page_id(), $majesty_options['pages_second_menu'])  ) {
						$menu_location 	= 'top-menu-2';
					}
					if( ! empty( $majesty_options['pages_scroll_menu'] ) && in_array( sama_get_current_page_id(), $majesty_options['pages_scroll_menu'])  ) {
						$menu_location 	= 'top-menu-2';
						$menu_class = 'top-menu-scroll';
					}
					if ( function_exists( 'has_nav_menu' ) ) {
						wp_nav_menu( array( 'theme_location' => $menu_location, 'depth' => 1, 'container' => 'ul', 'menu_class' => $menu_class, 'menu_id' => 'vert-menu') );
					}
				?>
				</nav>
			</div>
		</div>
	</div>        
</header>