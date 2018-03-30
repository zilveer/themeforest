<?php
/**
 * The Header for our theme.
 */

global $dd_sn;
global $dd_lang_curr;
global $woocommerce;
$body_class = '';

?><!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8 ie-ver-7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9 ie-ver-8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="ie-ver-9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<title><?php

			if ( defined('WPSEO_VERSION') ) {
				wp_title();
			} else {

				if ( is_home() || is_front_page() ) {
					bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
				} else {
					wp_title( '|', true, 'right' ); bloginfo( 'name' );
				}

			}
	
	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php if( ot_get_option( $dd_sn . 'favicon') ) : ?>
		<link rel="shortcut icon" href="<?php echo ot_get_option( $dd_sn . 'favicon'); ?>" type="image/x-icon" />
	<?php endif; ?>

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	<?php wp_head(); ?>

</head>

<?php

	/* Should the slider be shown? */

	$has_slider = false;
	$has_rev_slider = false;

	if ( is_page_template( 'template-homepage.php' ) || is_home() || is_front_page() ) {

		$slider_type = ot_get_option( $dd_sn . 'slider_regrev', 'regular' );

		if ( $slider_type == 'regular' ) {

			$slider = ot_get_option( $dd_sn . 'slider' );
			
			if ( ! empty ( $slider ) ) {
				$has_slider = true;
			}

		} elseif ( $slider_type == 'revolution' ) {

			$rev_slider_id = ot_get_option( $dd_sn . 'slider_revolution', 'disabled' ); 

			if ( $rev_slider_id != 'disabled' ) {
				$has_rev_slider = true;
			}

		}

		if ( $has_slider || $has_rev_slider ) {
			$body_class = 'has-slider ';
		}

	}

	/* Open donation lightbox on load (if needed) */

	if ( isset( $_GET['dd_donate'] ) ) {
		$body_class .= 'init-donate ';
	}

	/* Sticky Header */

	if ( ot_get_option( $dd_sn . 'header_sticky', 'disabled' ) == 'enabled' ) {
		$body_class .= 'sticky-header ';
	}

	/* Responsive */

	if ( ot_get_option( $dd_sn . 'responsive', 'enabled' ) == 'enabled' ) {
		$body_class .= 'dd-responsive ';
	}

	// Donation amount state
	if ( ot_get_option( $dd_sn . 'causes_donation_amount_state', 'enabled' ) == 'disabled' ) {
		$body_class .= 'dd-cause-don-amount-disabled ';
	}

	// Donation percentage state
	if ( ot_get_option( $dd_sn . 'causes_donation_perc_state', 'enabled' ) == 'disabled' ) {
		$body_class .= 'dd-cause-don-perc-disabled ';
	}

	// Donation amount and percentage state
	if ( ot_get_option( $dd_sn . 'causes_donation_amount_state', 'enabled' ) == 'disabled' && ot_get_option( $dd_sn . 'causes_donation_perc_state', 'enabled' ) == 'disabled' ) {
		$body_class .= 'dd-cause-don-info-disabled ';	
	}
	

?>

<body <?php body_class( $body_class ); ?>>

	<div id="page-container">

		<header id="header">

			<?php dd_multicol_colors(); ?>

			<div id="header-inner" class="container clearfix">

				<div id="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">						
						<img src="<?php echo ot_get_option( $dd_sn . 'logo', get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					</a>
				</div><!-- #logo -->

				<nav id="nav" class="clearfix">
					<?php if( has_nav_menu('primary_1') ) { wp_nav_menu( array( 'theme_location' => 'primary_1', 'menu_class' => 'primary-1 sf-menu' ) ); } ?>
					<?php if( has_nav_menu('primary_2') ) { wp_nav_menu( array( 'theme_location' => 'primary_2', 'menu_class' => 'primary-2 sf-menu' ) ); } ?>
					<?php if( has_nav_menu('primary_3') ) { wp_nav_menu( array( 'theme_location' => 'primary_3', 'menu_class' => 'primary-3 sf-menu' ) ); } ?>
				</nav><!-- #nav -->

				<nav id="mobile-nav">
					
					<?php
						if( has_nav_menu('primary_1') ) {

							$mobile_nav_output = '';
							$mobile_nav_output .= '<select>';
							
							if ( has_nav_menu( 'primary_1' ) ) {

								$locations = get_nav_menu_locations();
								$menu = wp_get_nav_menu_object($locations['primary_1']);
								$menu_items = wp_get_nav_menu_items($menu->term_id);
									
								foreach ( $menu_items as $key => $menu_item ) {
									$title = $menu_item->title;
									$url = $menu_item->url;
									$nav_selected = '';
									// if($menu_item->object_id == get_the_ID()){ $nav_selected = 'selected="selected"'; } //
									if($menu_item->post_parent !== 0){
										$mobile_nav_output .= '<option value="'.$url.'" '.$nav_selected.'> - '.$title.'</option>';
									}else{
										$mobile_nav_output .= '<option value="'.$url.'" '.$nav_selected.'>'.$title.'</option>';
									}
								}

							}

							if ( has_nav_menu( 'primary_2' ) ) {

								$locations = get_nav_menu_locations();
								$menu = wp_get_nav_menu_object($locations['primary_2']);
								$menu_items = wp_get_nav_menu_items($menu->term_id);
									
								foreach ( $menu_items as $key => $menu_item ) {
									$title = $menu_item->title;
									$url = $menu_item->url;
									$nav_selected = '';
									//if($menu_item->object_id == get_the_ID()){ $nav_selected = 'selected="selected"'; }
									if($menu_item->post_parent !== 0){
										$mobile_nav_output .= '<option value="'.$url.'" '.$nav_selected.'> - '.$title.'</option>';
									}else{
										$mobile_nav_output .= '<option value="'.$url.'" '.$nav_selected.'>'.$title.'</option>';
									}
								}

							}

							if ( has_nav_menu( 'primary_3' ) ) {

								$locations = get_nav_menu_locations();
								$menu = wp_get_nav_menu_object($locations['primary_3']);
								$menu_items = wp_get_nav_menu_items($menu->term_id);
									
								foreach ( $menu_items as $key => $menu_item ) {
									$title = $menu_item->title;
									$url = $menu_item->url;
									$nav_selected = '';
									//if($menu_item->object_id == get_the_ID()){ $nav_selected = 'selected="selected"'; }
									if($menu_item->post_parent !== 0){
										$mobile_nav_output .= '<option value="'.$url.'" '.$nav_selected.'> - '.$title.'</option>';
									}else{
										$mobile_nav_output .= '<option value="'.$url.'" '.$nav_selected.'>'.$title.'</option>';
									}
								}

							}

							$mobile_nav_output .= '</select>';
							echo $mobile_nav_output;
						}
					?>
					<div id="mobile-nav-hook"><?php _e( 'GO TO...', 'dd_string' ); ?></div>

				</nav>

				<div id="header-extra">

					<div id="header-extra-primary">

						<?php if ( ot_get_option( $dd_sn . 'header_bt_donate', 'enabled' ) == 'enabled' && dd_get_post_id( 'template', 'template-donate.php' ) != '' ) : ?>
							<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-donate.php' ) ); ?>" class="dd-button green has-icon"><?php _e( 'MAKE A DONATION', 'dd_string' ); ?><span class="dd-button-icon"><span class="icon-plus"></span></span></a>
						<?php endif; ?>

						<?php if ( defined( 'ICL_SITEPRESS_VERSION' ) && ot_get_option( $dd_sn . 'header_bt_language', 'enabled' ) == 'enabled' ) : ?>

							<?php 
								if ( is_singular( 'dd_events' ) ) {
									$langs = dd_wpml_get_event_translations( get_the_ID() );
								} else {
									$langs = icl_get_languages('skip_missing=1&orderby=id&order=asc'); 
								}
							?>	

							<?php if ( count( $langs ) > 1 ) : ?>

								<div class="dd-button-dropdown">
									<div class="dd-button-dropdown-content">
										<ul>
											<?php foreach ( $langs as $lang ) : ?>
												<?php if ( $lang['language_code'] != $dd_lang_curr ) : ?>
													<li><a href="<?php echo $lang['url']; ?>"><?php echo $lang['native_name']; ?></a></li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</div><!-- .dd-button-content -->
									<a href="#" class="dd-button orange-light has-icon"><?php _e( 'CHANGE LANGUAGE', 'dd_string' ); ?><span class="dd-button-icon"><span class="icon-chevron-down"></span></span></a>
								</div><!-- .dd-button -->

							<?php endif; ?>

						<?php endif; ?>

						<?php if ( class_exists( 'woocommerce' ) && ot_get_option( $dd_sn . 'header_bt_cart', 'enabled' ) == 'enabled' ) : ?>
							<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="dd-button purple has-text"><?php _e( 'SHOPPING CART', 'dd_string' ); ?><span class="dd-button-text"><?php echo $woocommerce->cart->get_cart_total(); ?></span></a>
						<?php endif; ?>

					</div><!-- #header-extra-primary -->

					<div id="header-extra-secondary" class="clearfix">

						<div id="header-social">
							<ul class="social-icons clearfix">

								<?php if ( ot_get_option( $dd_sn . 'social_twitter', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_twitter' ); ?>"><span class="icon-social-twitter"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_facebook', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_facebook' ); ?>"><span class="icon-social-facebook"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_vimeo', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_vimeo' ); ?>"><span class="icon-social-vimeo"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_googleplus', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_googleplus' ); ?>"><span class="icon-social-gplus"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_flickr', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_flickr' ); ?>"><span class="icon-social-flickr"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_pinterest', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_pinterest' ); ?>"><span class="icon-social-pinterest"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_linkedin', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_linkedin' ); ?>"><span class="icon-social-linkedin"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_dribbble', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_dribbble' ); ?>"><span class="icon-social-dribbble"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_instagram', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_instagram' ); ?>"><span class="icon-social-instagram"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_behance', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_behance' ); ?>"><span class="icon-social-behance"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_youtube', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_youtube' ); ?>"><span class="icon-social-youtube"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'social_email', '' ) != '' ) : ?>
									<li><a href="<?php echo ot_get_option( $dd_sn . 'social_email' ); ?>"><span class="icon-mail"></span></a></li>
								<?php endif; ?>

								<?php if ( ot_get_option( $dd_sn . 'header_search', 'enabled' ) == 'enabled' ) : ?>
									<li class="header-search">
										<a href="#"><span class="icon-search"></span></a>
										<div class="header-search-container">
											<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
												<input type="text" name="s" class="header-search-input" placeholder="<?php _e( 'SEARCH THE SITE', 'dd_string' ); ?>" />
											</form>
										</div><!-- .header-search-container -->
									</li>
								<?php endif; ?>
								
							</ul><!-- .social-icons -->
						</div><!-- #header-social -->

						<?php if ( ot_get_option( $dd_sn . 'header_user_links', 'enabled' ) == 'enabled' ) : ?>

							<div id="header-user-links">

								<?php if ( is_user_logged_in() ) : ?>

									<a href="<?php if ( function_exists('bp_loggedin_user_domain') ) { echo bp_loggedin_user_domain(); } else { echo admin_url(); } ?>"><span class="icon-user"></span><?php _e( 'MY ACCOUNT', 'dd_string' ); ?></a>
									<a href="<?php echo wp_logout_url( esc_url( home_url( '/' ) ) ); ?>"><span class="icon-lock-open"></span><?php _e( 'LOG OUT', 'dd_string' ); ?></a>

								<?php else : ?>	

									<a href="#" class="sign-in"><span class="icon-lock"></span><?php _e( 'SIGN IN', 'dd_string' ); ?></a>
									<a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=register"><span class="icon-user"></span><?php _e( 'REGISTER', 'dd_string' ); ?></a>

								<?php endif; ?>

							</div><!-- #header-user-links -->

						<?php endif; ?>

					</div><!-- #header-extra-secondary -->

				</div><!-- #header-extra -->

			</div><!-- #header-inner -->

		</header><!-- #header -->

		<?php

			$show_sub_header = false;

			if ( function_exists( 'bp_is_blog_page' ) && ! bp_is_blog_page() ) {

				$show_sub_header = true;

			} else if ( is_singular( 'dd_causes' ) ) {

				$prev_post = get_previous_post();
				$next_post = get_next_post();

				$show_sub_header = true;

			} elseif ( is_singular( 'post' ) ) {

				$prev_post = get_previous_post();
				$next_post = get_next_post();
				$show_sub_header = true;

			} elseif ( is_singular( 'dd_events' ) ) {

				$prev_post = dd_get_adjacent_post( false, '', true );
				$next_post = dd_get_adjacent_post( false, '', false );
				$show_sub_header = true;	

			} else if ( is_archive() && ! is_category() && ! is_tax( 'dd_causes_cats' ) && ! is_tax( 'dd_staff_cats' ) ) {

				$show_sub_header = true;

			} elseif ( is_page_template( 'template-dd_events.php' ) ) {

				$show_sub_header = true;

			} elseif ( is_page_template( 'template-dd_causes.php' ) ) {

				$show_sub_header = true;

				$cats = get_terms( 'dd_causes_cats' );

			} elseif ( is_page_template( 'template-blog.php' ) || is_category() ) {

				$show_sub_header = true;

				//$cats = get_categories( array( 'parent' => 0 ) ); 
				$cats = get_categories(); 

			} elseif ( is_page_template( 'template-dd_staff.php' ) ) {

				$show_sub_header = true;
				$cats = get_terms( 'dd_staff_cats' );

			} elseif ( is_archive() && is_tax( 'dd_staff_cats' ) ) {

				$show_sub_header = true;

				$cats = get_terms( 'dd_staff_cats' );
				$curr_queried_object = get_queried_object();
				$curr_term_id = $curr_queried_object->term_id;
 
			} elseif ( is_archive() && is_tax( 'dd_causes_cats' ) ) {

				$show_sub_header = true;

				$cats = get_terms( 'dd_causes_cats' );
				$curr_queried_object = get_queried_object();
				$curr_term_id = $curr_queried_object->term_id;

			} elseif ( is_page() || dd_is_subpage() ) {

				$page_id = dd_is_subpage();

				if ( ! $page_id ) {
					$page_id = get_the_ID();
				}

				$args = array(
					'child_of' => $page_id,
					'sort_column' => 'menu_order'
				); 
				$child_pages = get_pages( $args ); 

				if ( $child_pages ) {
					$show_sub_header = true;
				}

			}

			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$show_sub_header = false;
			}

		?>

		<?php if ( $show_sub_header ) : ?>

			<div id="sub-header">

				<div id="sub-header-inner" class="container clearfix">

					<?php if ( function_exists( 'bp_is_blog_page' ) && ! bp_is_blog_page() ) : ?>

						<div id="sub-header-bp">
							<div class="fl"></div>
							<div class="fr"></div>
						</div>

					<?php elseif ( is_singular( 'dd_causes' ) ) : ?>

						<div class="sub-header" id="sub-header-cause">

							<div class="fl"><a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_causes.php' ) ); ?>"><span class="icon-list"></span><?php _e( 'VIEW ALL CAUSES', 'dd_string' ); ?></a></div>
							
							<div class="fr clearfix">

								<?php if ( ! empty( $prev_post ) && ! empty( $next_post ) ) : ?>
									<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="fl no-border-right"><span class="icon-chevron-left"></span><?php _e( 'PREVIOUS CAUSE', 'dd_string' ); ?></a>
								<?php elseif ( ! empty( $prev_post ) ) : ?>
									<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="fl"><span class="icon-chevron-left"></span><?php _e( 'PREVIOUS CAUSE', 'dd_string' ); ?></a>
								<?php endif; ?>

								<?php if ( ! empty( $next_post ) ) : ?>
									<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="fr"><?php _e( 'NEXT CAUSE', 'dd_string' ); ?><span class="icon-chevron-right"></span></a>
								<?php endif; ?>

							</div>

						</div><!-- #sub-header-cause -->

					<?php elseif ( is_singular( 'post' ) ) : ?>

						<div class="sub-header" id="sub-header-post">

							<div class="fl"><a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-blog.php' ) ); ?>"><span class="icon-list"></span><?php _e( 'VIEW ALL POSTS', 'dd_string' ); ?></a></div>
							
							<div class="fr clearfix">

								<?php if ( ! empty( $prev_post ) ) : ?>
									<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="fl"><span class="icon-chevron-left"></span><?php _e( 'PREVIOUS POST', 'dd_string' ); ?></a>
								<?php endif; ?>

								<?php if ( ! empty( $next_post ) ) : ?>
									<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="fr no-border-left"><?php _e( 'NEXT POST', 'dd_string' ); ?><span class="icon-chevron-right"></span></a>
								<?php endif; ?>

							</div>

						</div><!-- #sub-header-post -->

					<?php elseif ( is_singular( 'dd_events' ) ) : ?>

						<div class="sub-header" id="sub-header-event">

							<div class="fl"><a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_events.php' ) ); ?>"><span class="icon-list"></span><?php _e( 'VIEW ALL EVENTS', 'dd_string' ); ?></a></div>
							
							<div class="fr clearfix">

								<?php if ( ! empty( $prev_post ) ) : ?>
									<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="fl"><span class="icon-chevron-left"></span><?php _e( 'PREVIOUS EVENT', 'dd_string' ); ?></a>
								<?php endif; ?>

								<?php if ( ! empty( $next_post ) ) : ?>
									<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="fr no-border-left"><?php _e( 'NEXT EVENT', 'dd_string' ); ?><span class="icon-chevron-right"></span></a>
								<?php endif; ?>

							</div>

						</div><!-- #sub-header-event -->

					<?php elseif ( is_archive() && ! is_category() && ! is_tax( 'dd_causes_cats' ) && ! is_tax( 'dd_staff_cats' ) ) : ?>

						<div class="sub-header" id="sub-header-archive">

							<?php if ( get_post_type() == 'dd_causes' ) : ?>
								<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_causes.php' ) ); ?>" class="fl"><?php _e( 'ALL', 'dd_string' ); ?></a>
							<?php else : ?>
								<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-blog.php' ) ); ?>" class="fl"><?php _e( 'ALL', 'dd_string' ); ?></a>
							<?php endif; ?>

							<a href="#" class="fl active"><?php
									
									if ( is_category() ) {
										printf( __( 'Category Archives: <span>%s</span>', 'dd_string' ), single_cat_title( '', false ) );
									} elseif ( is_tag() ) {
										printf( __( 'Tag Archives: <span>%s</span>', 'dd_string' ), single_tag_title( '', false ) );
									} elseif ( is_author() ) {

										the_post();
										printf( __( 'Author Archives: <span>%s</span>', 'dd_string' ), get_the_author() );
										rewind_posts();

									} elseif ( is_day() ) {
										printf( __( 'Daily Archives: <span>%s</span>', 'dd_string' ), get_the_date() );
									} elseif ( is_month() ) {
										printf( __( 'Monthly Archives: <span>%s</span>', 'dd_string' ), get_the_date( 'F Y' ) );
									} elseif ( is_year() ) {
										printf( __( 'Yearly Archives: <span>%s</span>', 'dd_string' ), get_the_date( 'Y' ) );
									} else {
										_e( 'Archives', 'dd_string' );
									}
							
							?></a>

						</div><!-- #sub-header-archive -->

					<?php elseif ( is_page_template( 'template-dd_events.php' ) ) : ?>

						<?php

							$all_months = array(
								array(
									'order' => '1',
									'name' => __( 'JAN', 'dd_string' )
								),
								array(
									'order' => '2',
									'name' => __( 'FEB', 'dd_string' )
								),
								array(
									'order' => '3',
									'name' => __( 'MAR', 'dd_string' )
								),
								array(
									'order' => '4',
									'name' => __( 'APR', 'dd_string' )
								),
								array(
									'order' => '5',
									'name' => __( 'MAY', 'dd_string' )
								),
								array(
									'order' => '6',
									'name' => __( 'JUN', 'dd_string' )
								),
								array(
									'order' => '7',
									'name' => __( 'JULY', 'dd_string' )
								),
								array(
									'order' => '8',
									'name' => __( 'AUG', 'dd_string' )
								),
								array(
									'order' => '9',
									'name' => __( 'SEPT', 'dd_string' )
								),
								array(
									'order' => '10',
									'name' => __( 'OCT', 'dd_string' )
								),
								array(
									'order' => '11',
									'name' => __( 'NOV', 'dd_string' )
								),
								array(
									'order' => '12',
									'name' => __( 'DEC', 'dd_string' )
								),
							);

							if ( isset( $_GET['dd_get'] ) ) {
								$what_to_show = $_GET['dd_get'];
							} else {
								$what_to_show = 'upcoming';
							}

							if ( isset( $_GET['dd_month'] ) ) {
								$month_query_arg = $_GET['dd_month'];
							} else {
								$month_query_arg = false;
							}

							if ( isset ( $_GET['dd_year'] ) ) {
								$current_year = $_GET['dd_year'];
							} else {
								$current_year = gmdate('Y');
							}

						?>

						<div class="sub-header" id="sub-header-events">

							<!-- Past Events -->

							<a href="<?php echo add_query_arg( 'dd_get', 'past', get_permalink( get_the_ID() ) ); ?>" class="fl <?php if ( $what_to_show == 'past' ) { echo 'active'; } ?>"><span class="icon-back-in-time"></span><?php _e( 'VIEW PAST EVENTS', 'dd_string' ); ?></a>

							<!-- All (Upcoming Events) -->

							<a href="<?php echo add_query_arg( 'dd_year', $current_year, get_permalink( get_the_ID() ) ); ?>" class="fl <?php if ( $what_to_show == 'upcoming' && $month_query_arg == false ) { echo 'active'; } ?>"><?php _e( 'ALL UPCOMING', 'dd_string' ); ?></a>

							<?php
							/**
							 * Months Listing
							 */
							?>

							<?php 
								if ( isset( $_GET['dd_year'] ) ) {
									
									if ( date('Y') == $_GET['dd_year'] ) {

										$curr_month_order_min = date('n'); 
										$curr_month_order_max = 12;

									} else {

										$curr_month_order_min = 1; 
										$curr_month_order_max = 12;

									}

								} else {

									if ( $what_to_show == 'past' ) {

										$curr_month_order_min = 1;
										$curr_month_order_max = date('n');

									} else {

										$curr_month_order_min = date('n'); 
										$curr_month_order_max = 12;

									}

								}

								if ( $what_to_show != 'past' ) {

									$months_with_events = dd_months_with_events();

									foreach ( $all_months as $month ) {
										
										if ( $month['order'] >= $curr_month_order_min && $month['order'] <= $curr_month_order_max ) {

											if ( in_array( $month['order'], $months_with_events ) ) {

												if ( $month['order'] == $month_query_arg ) {
													echo '<a href="' . add_query_arg( array( 'dd_month' => $month['order'], 'dd_year' => $current_year ), get_permalink() ) . '" class="fl has-posts active">' . $month['name'] . '</a>';
												} else {
													echo '<a href="' . add_query_arg( array( 'dd_month' => $month['order'], 'dd_year' => $current_year ), get_permalink() ) . '" class="fl has-posts">' . $month['name'] . '</a>';
												}

											} else {

												echo '<a href="#" class="fl no-posts">' . $month['name'] . '</a>';

											}

										}

									}

								}
							?>

							<?php
							/**
							 * Years Listing
							 */
							?>

							<?php if ( $what_to_show != 'past' ) : ?>

								<?php $years_with_events = dd_years_with_events(); ?>

								<div class="dd-button-dropdown fr active sub-header-year-selection">
									<div class="dd-button-dropdown-content">
										<ul>
											<?php foreach ( $years_with_events as $year_with_events ) : ?>
												<?php if ( $year_with_events >= gmdate( 'Y' , current_time( 'timestamp' ) ) ) : ?>
													<li><a href="<?php echo add_query_arg( array( 'dd_year' => $year_with_events, 'dd_get' => 'upcoming' ), get_permalink( get_the_ID() ) ) ?>"><?php echo $year_with_events; ?></a></li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</div><!-- .dd-button-content -->
									<a href="#" class=""><?php echo $current_year; ?><span class="dd-button-icon"><span class="icon-chevron-down"></span></span></a>
								</div><!-- .dd-button -->

							<?php endif; ?>

						</div><!-- #sub-header-events -->

					<?php elseif ( is_page_template( 'template-dd_causes.php' ) ) : ?>

						<?php

							if ( isset ( $_GET['show'] ) ) {
								$what_to_show = $_GET['show'];
							} else {
								$what_to_show = 'all';
							}

						?>

						<div class="sub-header" id="sub-header-causes">

							<a href="<?php the_permalink(); ?>" class="fl <?php if ( $what_to_show == 'all' ) { echo 'active'; } ?>"><?php _e( 'ALL', 'dd_string' ); ?></a>

							<?php if ( ! empty( $cats ) ) : ?>

								<?php foreach ( $cats as $cat ) : ?>

									<a href="<?php echo get_term_link( $cat->slug, 'dd_causes_cats' ); ?>" class="fl"><?php echo $cat->name; ?></a>

								<?php endforeach; ?>

							<?php endif; ?>

							<?php if ( ot_get_option( $dd_sn . 'causes_filter_featured', 'enabled' ) == 'enabled' ) : ?>
								<a href="<?php echo add_query_arg( 'show', 'featured', get_permalink( get_the_ID() ) ); ?>" class="fl <?php if ( $what_to_show == 'featured' ) { echo 'active'; } ?>"><span class="icon-heart"></span><?php _e( 'STAFF\'S PICK', 'dd_string' ); ?></a>
							<?php endif; ?>

							<?php if ( ot_get_option( $dd_sn . 'causes_filter_finished', 'enabled' ) == 'enabled' ) : ?>
								<a href="<?php echo add_query_arg( 'show', 'finished', get_permalink( get_the_ID() ) ); ?>" class="fl <?php if ( $what_to_show == 'finished' ) { echo 'active'; } ?>"><span class="icon-trophy"></span><?php _e( 'SUCCESFULLY FUNDED', 'dd_string' ); ?></a>
							<?php endif; ?>

							<?php if ( ot_get_option( $dd_sn . 'causes_filter_lastmiles', 'enabled' ) == 'enabled' ) : ?>
								<a href="<?php echo add_query_arg( 'show', 'lastmiles', get_permalink( get_the_ID() ) ); ?>" class="fl <?php if ( $what_to_show == 'lastmiles' ) { echo 'active'; } ?>"><span class="icon-gauge"></span><?php _e( 'LAST MILES', 'dd_string' ); ?></a>
							<?php endif; ?>

						</div><!-- #sub-header-causes -->

					<?php elseif ( is_archive() && is_tax( 'dd_causes_cats' ) ) : ?>

						<div class="sub-header" id="sub-header-causes">

							<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_causes.php' ) ); ?>" class="fl <?php if ( $what_to_show == 'all' ) { echo 'active'; } ?>"><?php _e( 'ALL', 'dd_string' ); ?></a>

							<?php if ( ! empty( $cats ) ) : ?>

								<?php foreach ( $cats as $cat ) : ?>

									<a href="<?php echo get_term_link( $cat->slug, 'dd_causes_cats' ); ?>" class="fl <?php if ( $curr_term_id == $cat->term_id ) echo 'active'; ?>"><?php echo $cat->name; ?></a>

								<?php endforeach; ?>

							<?php endif; ?>

							<?php if ( ot_get_option( $dd_sn . 'causes_filter_featured', 'enabled' ) == 'enabled' ) : ?>
								<a href="<?php echo add_query_arg( 'show', 'featured', get_permalink( dd_get_post_id( 'template', 'template-dd_causes.php' ) ) ); ?>" class="fl <?php if ( $what_to_show == 'featured' ) { echo 'active'; } ?>"><span class="icon-heart"></span><?php _e( 'STAFF\'S PICK', 'dd_string' ); ?></a>
							<?php endif; ?>

							<?php if ( ot_get_option( $dd_sn . 'causes_filter_finished', 'enabled' ) == 'enabled' ) : ?>
								<a href="<?php echo add_query_arg( 'show', 'finished', get_permalink( dd_get_post_id( 'template', 'template-dd_causes.php' ) ) ); ?>" class="fl <?php if ( $what_to_show == 'finished' ) { echo 'active'; } ?>"><span class="icon-trophy"></span><?php _e( 'SUCCESFULLY FUNDED', 'dd_string' ); ?></a>
							<?php endif; ?>

							<?php if ( ot_get_option( $dd_sn . 'causes_filter_lastmiles', 'enabled' ) == 'enabled' ) : ?>
								<a href="<?php echo add_query_arg( 'show', 'lastmiles', get_permalink( dd_get_post_id( 'template', 'template-dd_causes.php' ) ) ); ?>" class="fl <?php if ( $what_to_show == 'lastmiles' ) { echo 'active'; } ?>"><span class="icon-gauge"></span><?php _e( 'LAST MILES', 'dd_string' ); ?></a>
							<?php endif; ?>

						</div><!-- #sub-header-causes -->

					<?php elseif ( is_archive() && is_tax( 'dd_staff_cats' ) ) : ?>

						<div class="sub-header" id="sub-header-staff">

							<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_staff.php' ) ); ?>" class="fl <?php if ( $what_to_show == 'all' ) { echo 'active'; } ?>"><?php _e( 'ALL', 'dd_string' ); ?></a>

							<?php if ( ! empty( $cats ) ) : ?>

								<?php foreach ( $cats as $cat ) : ?>

									<a href="<?php echo get_term_link( $cat->slug, 'dd_staff_cats' ); ?>" class="fl <?php if ( $curr_term_id == $cat->term_id ) echo 'active'; ?>"><?php echo $cat->name; ?></a>

								<?php endforeach; ?>

							<?php endif; ?>

						</div><!-- #sub-header-staff -->

					<?php elseif ( is_page_template( 'template-blog.php' ) ) : ?>

						<div class="sub-header" id="sub-header-blog">

							<a href="<?php echo get_permalink ( dd_get_post_id( 'template', 'template-blog.php' ) ); ?>" class="fl active"><?php _e( 'ALL', 'dd_string' ); ?></a>

							<ul class="sub-header-cats-listing fl">
								<?php wp_list_categories( array( 'title_li' => '' ) ); ?>
							</ul>

						</div><!-- #sub-header-blog -->

					<?php elseif ( is_page_template( 'template-dd_staff.php' ) ) : ?>

						<?php if ( ! empty( $cats ) ) : ?>

							<div class="sub-header" id="sub-header-staff">

								<a href="<?php echo get_permalink ( dd_get_post_id( 'template', 'template-dd_staff.php' ) ); ?>" class="fl active"><?php _e( 'ALL', 'dd_string' ); ?></a>

								<?php foreach ( $cats as $cat ) : ?>

									<a href="<?php echo get_term_link( $cat->slug, 'dd_staff_cats' ); ?>" class="fl"><?php echo $cat->name; ?></a>

								<?php endforeach; ?>

							</div><!-- #sub-header-staff -->

						<?php endif; ?>

					<?php elseif ( is_category() ) : ?>

						<div class="sub-header">

							<a href="<?php echo get_permalink ( dd_get_post_id( 'template', 'template-blog.php' ) ); ?>" class="fl"><?php _e( 'ALL', 'dd_string' ); ?></a>

							<ul class="sub-header-cats-listing fl">
								<?php wp_list_categories( array( 'title_li' => '' ) ); ?>
							</ul>

						</div>

					<?php elseif ( is_page() ) : ?>

						<div class="sub-header" id="sub-header-page">

							<?php foreach ( $child_pages as $child_page ) : ?>
								
								<a href="<?php echo get_permalink( $child_page->ID ); ?>" class="fl <?php if ( get_the_ID() == $child_page->ID ) { echo 'active'; } ?>"><?php echo get_the_title( $child_page->ID ); ?></a>

							<?php endforeach; ?>

						</div><!-- #sub-header-page -->

					<?php endif; ?>

				</div><!-- #sub-header-inner -->

			</div><!-- #sub-header -->

		<?php endif; ?>

		<?php 
			if ( $has_slider ) { dd_slider(); }
			if ( $has_rev_slider ) {
				?><div id="rev-slider"><?php echo do_shortcode( '[rev_slider ' . $rev_slider_id . ']' ); ?></div><?php
			}

		?>

		<section id="main">