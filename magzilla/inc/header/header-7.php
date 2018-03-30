<?php
/**
 * Header 7
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/12/15
 * Time: 8:16 PM
 */
global $ft_option, $fave_container;

if( !empty( $ft_option['header_ads_left_320_100'] ) && !empty( $ft_option['header_ads_right_320_100'] ) ) {
	$logo_classes = "col-xs-4 col-sm-4 col-md-4 col-lg-4";
} else {
	$logo_classes = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
}
?>

<div class="header-7 hidden-xs hidden-sm" itemscope itemtype="http://schema.org/WPHeader">

	<nav class="magazilla-top-nav-v2 navbar yamm header-7 navbar-fixed-top">

		<div class="<?php // echo $fave_container; ?> container-fluid">

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

	<div class="header-7-bottom">
		<div class="<?php echo $fave_container; ?>">
			<div class="row">

				<?php if( !empty( $ft_option['header_ads_left_320_100'] ) ): ?>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<div class="banner-left"><?php echo $ft_option['header_ads_left_320_100']; ?></div>
				</div>
				<?php endif; ?>

				<div class="<?php echo $logo_classes; ?>">
					<div class="logo-wrap text-center">
						<?php get_template_part('inc/header/logo'); ?>
					</div>
				</div>

				<?php if( !empty( $ft_option['header_ads_right_320_100'] ) ): ?>
				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<div class="banner-right"><?php echo $ft_option['header_ads_right_320_100']; ?></div>
				</div>
				<?php endif; ?>


			</div>
		</div>
	</div>

</div><!-- header-7 -->