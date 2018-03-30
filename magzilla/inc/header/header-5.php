<?php
/**
 * Created by PhpStorm.
 * Since 1.3.0
 * User: waqasriaz
 * Date: 17/11/15
 * Time: 11:56 AM
 */
global $ft_option, $fave_container; ?>

<div class="header-5 hidden-xs hidden-sm" itemscope itemtype="http://schema.org/WPHeader">

	<nav class="magazilla-top-nav-v2 navbar yamm header-5 navbar-fixed-top">

		<div class="<?php // echo $fave_container; ?> container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand <?php if( $ft_option['logo_type'] == 'text_logo' ) { ?> fave_text_logo_nav_v2 <?php } ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">

					<?php if( $ft_option['logo_type'] == 'text_logo' ) {
						if( !empty($ft_option['site_text_logo'])) {
							echo esc_attr( $ft_option['site_text_logo'] );
						}
					} else { ?>

						<?php if( !empty($ft_option['site_logo'])) { ?>
							<img src="<?php echo esc_url( $ft_option['site_logo'] ); ?>" width="250" height="42" alt="<?php bloginfo( 'name' );?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>"/>
						<?php } ?>
						<?php
					}?>

				</a>
			</div>

			<div class="top-menu clearfix">
				<!-- navbar-left -->

				<?php
				// Pages Menu
				if ( has_nav_menu( 'main-menu' ) ) :
					wp_nav_menu( array (
						'theme_location' => 'main-menu',
						'container' => '',
						'container_class' => '',
						'menu_class' => 'nav navbar-nav',
						'menu_id' => 'main-nav',
						'depth' => 4,
						'walker' => new favethemes_Walker()
					));
				endif;
				?>

				<!-- navbar-right -->
				<ul class="nav navbar-nav navbar-right">

					<?php if( $ft_option['top_social_profiles'] != 0 ) { ?>
					<li class="dropdown social-links-dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-share-square"></i></a>
						<ul class="dropdown-menu">
							<?php get_template_part('inc/nav-social-2'); ?>
						</ul>
					</li>
					<?php } ?>

					<?php if ( function_exists('login_with_ajax') ) { ?>

						<?php if ( !is_user_logged_in()) { ?>
							<li><a data-toggle="modal" data-target="#modal-login-form" data-dismiss="modal" href="#"><?php _e( 'Login', 'magzilla' )?></a></li>
						<?php } ?>

						<li><?php if ( function_exists('login_with_ajax')) {  login_with_ajax();  } ?></li>
					<?php } ?>

					<li class="search-wrapper">
						<?php if( $ft_option['header_search'] != 0 ){ ?>
							<?php get_template_part('inc/header/search', 'form' ); ?>
						<?php } ?>
					</li>
				</ul><!-- navbar-right -->
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

</div><!-- header-1 -->