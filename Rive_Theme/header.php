<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" <?php language_attributes(); ?>>
	<head>
		<meta content="True" name="HandheldFriendly">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php
			global $ch_class;

			// Which payment gateway to use?
			$payment_gateway = get_option('ch_payment_gateway') ? get_option('ch_payment_gateway') : 'paypal';

			// Paypal IPN payment verification
			$post_input       = file_get_contents('php://input');
			$post_input_array = explode('&', $post_input);

			if ( $payment_gateway == 'paypal' && !empty($post_input) && $post_input_array[0] != 'wp_customize=on' ) {
				require_once(CH_HOME . '/ipn.php');
			}

			if ( $payment_gateway == 'authorizenet' && !empty($_REQUEST['x_response_code']) ) {
				require_once(CH_HOME . '/authorize_relay.php');
			}

			// Get theme logo
			$logo = get_option('ch_sitelogo');
			if($logo == false) {
				$logo = get_template_directory_uri() . '/images/logo.png';
			}

			// Get header bg image
			$favicon = get_option('ch_favicon');
			if ($favicon == false) {
				$favicon = get_template_directory_uri() . '/images/favicon.ico';
			}

			// Load google fonts
			if (file_exists(TEMPLATEPATH . '/css/gfonts.css')) {
				$fonts_url = get_template_directory_uri() . '/css/gfonts.css';
				echo '
		<link href="' . $fonts_url . '" rel="stylesheet" type="text/css" />
';
			}
		?>
		<!--[if IE 9]>
			<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie9.css" media="all" />
		<![endif]-->
		<!--[if IE 8]>
			<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" media="all" />
		<![endif]-->
		<!--[if IE 7]>
			<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" media="all" />
		<![endif]-->
		<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
		<?php
			wp_head();
		?>
	</head>
	<body <?php body_class($ch_class); ?>>
		<?php if ( $_SERVER['SERVER_NAME'] == 'cohhe.com' ) { ?>
			<a href="http://themeforest.net/item/rive-responsive-charity-wordpress-theme/4238530" target="_blank" id="buy-now-ribbon"></a>
		<?php } ?>
		<?php

			// Layout (layout-boxed, layout-wide)
			if ( get_option( 'ch_site_layout_style') == false || get_option( 'ch_site_layout_style') == 'boxed' ) {
				$container_class = '';
			} else {
				$container_class = 'container';
			}
		?>
		<div class="header-line"></div>
		<div class="wrapper">
			<div class="top-line">&nbsp;</div>
			<div class="header">
				<div class="<?php echo $container_class; ?>" id="header_container_class">
					<div class="row-fluid">
						<div class="span6">
							<div class="logo">
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
							</div>
						</div>
						<div class="span18 pull-right">
							<nav>
								<div class="menu-container visible-desktop visible-tablet">
									<?php
										wp_nav_menu(
											array(
												'theme_location' => 'primary-menu',
												'menu_class'     => 'main-menu',
												'depth'          => 2,
												'link_before'    => '<span>',
												'link_after'     => '</span>'
											)
										);
									?>
								</div>
								<?php
								if( has_nav_menu( 'primary-menu' ) ) {
									wp_nav_menu( array(
									'show_description' => false,
									'menu'			   => 'primary-menu',
									'items_wrap'	   => '<select id="drop-nav" class="responsiveMenuSelect">
															<option value="">Select a page...</option>%3$s
															</select>',
									'container'		   => false,
									'walker'		   => new Walker_Nav_Menu_Dropdown(),
									'theme_location'   => 'primary-menu'));
								} ?>
							</nav>

						</div>
					</div>
				</div>
				<div class="clearer"></div>
			</div><!--end of header-->
			<?php
				$layout_type = get_post_meta(get_the_id(), 'layouts', true);

				if ( is_archive() || is_search() || is_404() ) {
					$layout_type = 'full';
				} elseif (empty($layout_type)) {
					$layout_type = get_option('ch_layout_style') ? get_option('ch_layout_style') : 'full';
				}

				switch ($layout_type) {
					case 'right':
						define('LAYOUT', 'sidebar-right');
						break;
					case 'full':
						define('LAYOUT', 'sidebar-no');
						break;
					case 'left':
						define('LAYOUT', 'sidebar-left');
						break;
				}

				// Show tiled images
				if ( is_page_template('template-with-tiled-header.php') ) {

					// Slider options
					$select_projects_from = get_option('ch_select_projects_from') ? get_option('ch_select_projects_from') : 'parent page';
					$project_ids          = get_option('ch_project_ids') ? get_option('ch_project_ids') : '';
					$tiled_hover_effect   = get_option('ch_tiled_hover_effect') ? get_option('ch_tiled_hover_effect') : 'normal';
					$tiled_hover_speed    = get_option('ch_tiled_hover_speed') ? get_option('ch_tiled_hover_speed') : '300';

					$tiled_slider_ids = array_filter(explode(';', $project_ids));

					if ( $select_projects_from == 'parent page' && !empty($tiled_slider_ids[0]) ) {
						$args = array(
							'post_type'      => array( 'post', 'page', 'ch_cause', 'ch_staff'),
							'posts_per_page' => '100',
							'post_parent'    => $tiled_slider_ids[0]);
						$query = new WP_Query( $args );
					} elseif ( stripslashes($select_projects_from) == "exact id's" || $select_projects_from == "exact id\'s" ) {
						$args = array(
							'post_type'      => array( 'post', 'page', 'ch_cause', 'ch_staff'),
							'posts_per_page' => '100',
							'post__in'       => $tiled_slider_ids);
						$query = new WP_Query( $args );
					}
				} elseif ( is_page_template('template-with-content-slider.php') ) {

					// Slider options
					$slider_category      = get_option('ch_coin_slider_category') ? get_option('ch_coin_slider_category') : '';
					$slider_category_id   = get_cat_id($slider_category);
					$content_slider_title = get_option('ch_content_slider_title') ? get_option('ch_content_slider_title') : '<span>Latest</span> News';

					$args = array(
						'posts_per_page' => '100',
						'cat'            => $slider_category_id);
					$query = new WP_Query( $args );
				} else {
					$query = new WP_Query();
				}
			?>
			<div class="container">
				<div class="row">
					<div class="span24">
						<div class="main-container-wrapper">
							<div class="page-<?php echo LAYOUT; ?> page-wrapper">
								<div class="content">
									<?php
									if ( isset( $query ) && is_page_template('template-with-tiled-header.php') && $query->have_posts()) {
									?>
									<div class="row-fluid">
										<div class="span24 visible-desktop">
											<div class="tiles-slider">
												<div class="tiles">
													<ul id="tiles-ul" class="tiles-ul">
														<?php
															while ($query->have_posts()) {
																$query->the_post();

																// Get slide image
																$slider_image = get_the_image(array('size' => 'tiled-slider', 'echo' => false, 'link_to_post' => false, 'width' => 256, 'height' => 189));

																// Slide with image and text
																if(!empty($slider_image)) {
																	$current_fundrainers = (get_post_meta( get_the_ID(), '_fundraisers', true )) ? get_post_meta( get_the_ID(), '_fundraisers', true ) : '0';
																	$current_donations   = (get_post_meta( get_the_ID(), '_donations_so_far', true )) ? get_post_meta( get_the_ID(), '_donations_so_far', true ) : '0';
														?>
														<li>
															<a href="<?php echo get_permalink(); ?>" class="no_thickbox">
																<?php echo $slider_image; ?>
																<div <?php if ( get_post_type() != 'ch_cause' ) { echo 'class="no_bottom_border"'; } ?>>
																	<span class="title"><?php echo get_the_title(); ?></span>
																	<?php if ( get_post_type() == 'ch_cause' ) { ?>
																	<span class="bottom-text"><?php echo $current_fundrainers . __( ' supporters', 'ch' ); ?></span>
																	<?php $currency_sign = get_option('ch_currency_sign') ? get_option('ch_currency_sign') : '$'; ?>
																	<span><?php echo __( 'raised', 'ch' ) . " " . $currency_sign . number_format($current_donations, 2, '.', ' '); ?></span>
																	<?php } ?>
																</div>
															</a>
														</li>
														<?php
																}
															}
														?>
													</ul>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="transparent-bg"></div>
										</div>
									</div>
									<script type="text/javascript">
										jQuery(function() {
											jQuery('#tiles-ul > li').each(function() {
												jQuery(this).hoverdir({
													hoverDelay : 0.75,
													easing : '<?php echo $tiled_hover_effect; ?>',
													speed : <?php echo $tiled_hover_speed; ?>
												});
											});
										});
									</script>
									<?php } elseif (is_page_template('template-with-content-slider.php') && $query->have_posts()) { ?>
										<div class="">
											<div class="">
												<div class="slider-container">
													<div class="featured-slides">
														<?php
														$i = 0;
														while ($query->have_posts()) {
															$query->the_post();

															// Get slide image
															$slider_image = get_the_image(array('size' => 'content-slider', 'echo' => false, 'link_to_post' => true, 'width' => 675, 'height' => 385));

															// Slide with image and text
															if(!empty($slider_image)) {

																// Slide title
																$slider_title = the_title( '', '', false );
																$slider_title = str_replace( 'Private: ', '', $slider_title );

																$my_excerpt = strip_tags( get_the_excerpt() );
																/*if ( $my_excerpt != '' ) {
																	$my_excerpt = substr($my_excerpt, 0, 300);
																}*/
														?>
														<div class="featured-slide"<?php if ( $i == 0 ) echo ' style="top: 0;"'; ?>>
															<div class="featured-slide-img">
																<?php echo $slider_image; ?>
																<div class="featured-slide-text-container">
																	<div class="featured-slide-title"><a href="<?php echo get_permalink(); ?>"><?php echo $slider_title; ?></a></div>
																	<div class="featured-slide-text"><a href="<?php echo get_permalink(); ?>"><?php echo $my_excerpt; ?></a></div>
																</div>
															</div>
														</div>
														<?php
															}
															$i++;
														} ?>
													</div>
													<div class="span8 pull-right">
														<div class="slides-head">
															<h2><?php echo $content_slider_title; ?></h2>
															<div class="slider-navigation">
																<div class="slider-prev disabled"><a href="javascript:void(0);" class="no_thickbox"><img src="<?php echo get_template_directory_uri(); ?>/images/prev-icon.png" alt=""></a></div>
																<div class="slider-next"><a href="javascript:void(0);" class="no_thickbox"><img src="<?php echo get_template_directory_uri(); ?>/images/next-icon.png" alt=""></a></div>
															</div>
														</div>
													</div>
													<div class="clearfix"></div>
													<div class="slides span8 pull-right">
														<?php
														$p = 0;
														while ($query->have_posts()) {
															$query->the_post();

															// Get slide image
															$slider_image = get_the_image(array('size' => 'content-slider', 'echo' => false, 'link_to_post' => false, 'width' => 680, 'height' => 385));

															// Slide with image and text
															if( !empty( $slider_image ) ) {

																// Slide title
																$slider_title = the_title('', '', false);
																$slider_title = str_replace("Private: ", "", $slider_title);

																$my_excerpt = strip_tags( get_the_excerpt() );
																/*if ( $my_excerpt != '' ) {
																	$my_excerpt = substr($my_excerpt, 0, 100) . '...';
																}*/

																if ( $p == 0 ) {
																	echo '<div class="slider-page" style="display: block;">';
																} elseif ( $p != 0 && $p % 4 == 0 ) {
																	echo '</div><!--end of slider page-->
																	<div class="slider-page">';
																}
															?>
																<div class="right-slide-content span7<?php if ( $p == 0 ) echo ' active'; ?>">
																	<a href="javascript:void(0);">
																		<span class="right-slide-title"><?php echo $slider_title; ?></span>
																		<span class="right-slide-text"><?php echo $my_excerpt; ?></span>
																	</a>
																</div>
															<?php
																if ( $p != 0 && $query->post_count == ( $p + 1 ) ) {
																	echo '</div><!--end of slider page-->';
																}
															}
															$p++;
														} ?>
													</div><!--end of slides-->
												</div>
											</div>
										</div>
										<div class="transparent-bg"></div>
									<?php } elseif (!is_page_template('template-with-content-slider.php') && !is_page_template('template-with-tiled-header.php')) {
											  dynamic_sidebar( 'slider-position' );
										  }
									wp_reset_postdata();