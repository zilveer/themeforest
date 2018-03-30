<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>

	<div class="site-wrapper">

		<header class="site-header">

			<?php
			$responsive_breakpoint = Youxi()->option->get( 'responsive_breakpoint' );

			/* Make sure responsive breakpoint is either 768 or 992 */
			if( 768 != $responsive_breakpoint || 992 != $responsive_breakpoint ) {
				$responsive_breakpoint = 992;
			}

			if( $show_top_bar = Youxi()->option->get( 'show_top_bar' ) ):

			?><div class="site-header-top">

				<div class="container">

					<div class="row">

						<?php if( 768 == $responsive_breakpoint ): 

						?><div class="site-header-top-left col-sm-6 visible-sm visible-md visible-lg">
						<?php else: 

						?><div class="site-header-top-left col-md-6 visible-md visible-lg">
						<?php endif;

							wp_nav_menu(array(
								'theme_location' => 'secondary-menu', 
								'container' => 'nav', 
								'container_class' => 'secondary-nav', 
								'fallback_cb' => 'shiroi_fallback_menu_secondary', 
								'depth' => 2
							)) ?>
						</div>

						<?php if( 768 == $responsive_breakpoint ): 

						?><div class="site-header-top-right col-sm-6">
						<?php else: 

						?><div class="site-header-top-right col-md-6">
						<?php endif;

							if( $social_profiles = Youxi()->option->get( 'social_profiles' ) ):

							?><div class="site-header-social">
								<ul class="plain-list">
									<?php foreach( $social_profiles as $profile ):
										echo '<li>';
											echo '<a href="' . esc_url( $profile['url'] ) . '" title="' . esc_attr( $profile['title'] ) . '">';
												echo '<span class="' . esc_attr( $profile['icon'] ) . '"></span>';
											echo '</a>';
										echo '</li>';
									endforeach; ?>
								</ul>
							</div><?php
							endif;

							?><div class="site-header-search"><?php 
									get_search_form();
								?><a href="#" title="<?php esc_attr_e( 'Search', 'shiroi' ) ?>" class="search-toggle" data-toggle="dropdown">
									<span class="fa fa-search"></span>
								</a>
							</div>

						</div>

					</div>

				</div>

			</div>
			<?php endif; ?>

			<div class="affix-wrap">

				<div class="affix-container" data-affix="(max-width: <?php echo esc_attr( $responsive_breakpoint - 1 ) ?>px)">

					<div class="site-header-middle">

						<div class="container">

							<div class="row">

								<div class="col-md-12">

									<?php if( 768 == $responsive_breakpoint ): 

									?><div class="mobile-nav-toggle hidden-sm hidden-md hidden-lg">
									<?php else: 

									?><div class="mobile-nav-toggle hidden-md hidden-lg">
									<?php endif; ?>

										<a href="#" title="<?php esc_attr_e( 'Menu', 'shiroi' ) ?>">
											<span><span></span><span></span></span>
										</a>

									</div>

									<div class="brand">

										<a href="<?php echo esc_url( home_url() ); ?>">
											<?php shiroi_site_logo(); ?>
										</a>

									</div>

								</div>

							</div>

						</div>

					</div>

					<div class="site-header-bottom">

						<div class="affix-wrap">

							<div class="affix-container" data-affix="(min-width: <?php echo esc_attr( $responsive_breakpoint ) ?>px)">

								<div class="container">

									<div class="row">

										<nav class="primary-nav">

											<?php wp_nav_menu(array(
												'theme_location'  => 'primary-menu',  
												'container_class' => 'primary-nav-wrap', 
												'fallback_cb'     => 'shiroi_fallback_menu_primary', 
												'walker'          => class_exists( 'Shiroi_Walker_Nav_Menu' ) ? new Shiroi_Walker_Nav_Menu() : ''
											)) ?>

										</nav>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</header>