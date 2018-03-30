<?php global $ft_option; ?>
<?php $mobile_sticky_nav = isset( $ft_option['mobile_sticky_nav'] ) ? $ft_option['mobile_sticky_nav'] : 0; ?>

<nav class="navbar mobile-menu hidden-lg visible-xs visible-sm" data-sticky="<?php echo $mobile_sticky_nav; ?>">
	<div class="container-fluid">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle mobile-menu-btn collapsed" data-toggle="collapse" data-target="#mobile-menu" aria-expanded="false">
				<span class="sr-only"><?php _e("Toggle navigation","magzilla"); ?></span>
				<i class="fa fa-bars"></i>
			</button>

			<a class="navbar-brand mobile_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php if( !empty($ft_option['site_mobile_logo'])) { ?>
					<img src="<?php echo esc_url( $ft_option['site_mobile_logo'] ); ?>" alt="<?php bloginfo( 'name' );?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>"/>
				<?php } ?>
			</a>

			<button type="button" class="navbar-toggle collapsed mobile-search-btn" data-toggle="collapse" data-target="#mobile-search" aria-expanded="false">
				<span class="sr-only"><?php _e("Toggle navigation","magzilla"); ?></span>
				<i class="fa fa-search"></i>
			</button>
		</div>

		<div class="navbar-collapse collapse mobile-menu-collapse" id="mobile-menu" style="height: 0px;">

			<?php
			// Pages Menu
			if ( has_nav_menu( 'mobile-menu' ) ) :
				wp_nav_menu( array (
					'theme_location' => 'mobile-menu',
					'container' => '',
					'container_class' => '',
					'menu_class' => 'nav navbar-nav',
					'menu_id' => 'favethemes_mobile_nav',
					'depth' => 3,
					'walker' => new favethemes_mobile_nav()
				));
			endif;
			?>

		</div>

		<div class="collapse navbar-collapse" id="mobile-search">
			<form class="navbar-form navbar-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="text" name="s" id="s_mobile" class="form-control" placeholder="<?php _e("Search","magzilla"); ?>">
			</form>
		</div>

	</div> <!-- end container-fluid -->
	<!-- mobile-menu-layer -->
	<div class="mobile-menu-layer"></div>
</nav>