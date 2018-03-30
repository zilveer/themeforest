<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title><?php bloginfo('name'); ?></title>
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<!-- Custom CSS -->
		<style type="text/css">
		a {
			color:<?php echo stripslashes(of_get_option('link_color')); ?>;
		}
		</style>

		<?php if (of_get_option('favicon') != '') { ?>
		<!-- The Favicon -->
		<link rel="shortcut icon" href="<?php echo stripslashes(of_get_option('favicon')); ?>" />
		<?php } ?>

		<?php wp_head(); //important, don't touch ?>
	</head>
	<body <?php body_class('scheme_'. stripslashes(of_get_option('color_scheme')) .' button_'. stripslashes(of_get_option('button_color')) .' '. stripslashes(of_get_option('layout')) .''); ?>>
		<div class="wrapper" id="header">
			<div class="container">
				<?php if (of_get_option('logo') != '') { ?>
				<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" class="left the_logo">
					<img src="<?php echo stripslashes(of_get_option('logo')); ?>" alt="<?php bloginfo('name'); ?>" id="logo" />
				</a>
				<?php } else { ?>
				<h1 class="the_logo"><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
				<?php } ?>
				<?php get_search_form(); ?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="wrapper" id="main_menu">
			<div class="container">
				<?php if ( has_nav_menu( 'primary' ) ) { ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				<?php } else { ?>
				<?php _e( 'Set your <strong>Primary Menu</strong> under <strong>Appearance > Menus</strong>', 'designcrumbs' ); ?>
				<?php } ?>
				<div id="cart_links">


				<div>

				<?php if (class_exists('Cart66_Cloud')) : ?>

					
					<ul>
						<li>
							<a href="<?php echo site_url(); ?>/view-cart" id="head_cart"><?php _e('Your Cart', 'designcrumbs'); ?>
								<?php if (dc_cart_total() != '0') { ?>
								<span id="dc_cart_total-wrap"><span id="dc_cart_total"><?php echo dc_cart_total(); ?></span></span>
								<?php } ?>
							</a>
						</li>
					</ul>
			

				<?php else: ?>
					<ul>
						<?php if ((of_get_option('affiliate_mode') == 'no') && (class_exists('Cart66'))) { ?>
						
						<?php if (of_get_option('member_login') != '') { ?>
												
							<?php if(Cart66Common::isLoggedIn()): ?>
							
								<li><a href="<?php echo stripslashes(of_get_option('store_link')); ?>/?cart66-task=logout" title="<?php _e('Log Out', 'designcrumbs'); ?>"><?php _e('Log Out', 'designcrumbs'); ?></a></li>
								
								<?php if (of_get_option('account_link') != '') { ?>
									<li><a href="<?php echo stripslashes(of_get_option('account_link')); ?>/" title="<?php _e('My Account', 'designcrumbs'); ?>"><?php _e('My Account', 'designcrumbs'); ?></a></li>
								<?php } ?>
								
							<?php else: ?>
							
								<li><a href="<?php echo stripslashes(of_get_option('member_login')); ?>" title="<?php _e('Log In', 'designcrumbs'); ?>"><?php _e('Log In', 'designcrumbs'); ?></a></li>
								
							<?php endif; ?>
													
						<?php } if (of_get_option('cart_link') != '') { ?>
						
						<li>
							<a href="<?php echo stripslashes(of_get_option('cart_link')); ?>" title="cart" id="head_cart">
								<?php _e('Your Cart', 'designcrumbs'); ?>
								<?php $items = Cart66Session::get('Cart66Cart')->countItems(); if (($items < 1) || (is_page('receipt'))) {
									echo '';
								} else if($items > 0) { ?>
								<span id="dc_cart_total-wrap"><span id="dc_cart_total"><?php echo $items; ?></span></span>
								<?php } ?>
							</a>
						</li>
							
						<?php } ?>
						
						<?php } //end affiliate_mode ?>
					</ul>

				<?php endif; ?>
				</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php if (is_front_page()) { ?>
		<?php /* START THE SLIDE LOOP */ $loop = new WP_Query( array( 'post_type' => 'slides', 'posts_per_page' => 3, 'order' => 'desc' ) ); ?>
		<?php $count_slides = wp_count_posts('slides')->publish; if ($count_slides != '0') { ?>
		<div class="wrapper" id="slider_wrap">
			<div class="wrapper" id="slider">
				<div class="container">
					<div id="slides">
						<div class="slidearea slides_container">
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class="single_slide">
								<h2 class="slide_title"><?php the_title(); ?></h2>
								<div class="slide_content">
								<?php the_content(); ?>
									<div class="clear"></div>
								<?php if (get_post_meta($post->ID, '_dc_slide_price', true) != '') { ?>
									<span class="slide_price"><?php echo get_post_meta($post->ID, '_dc_slide_price', true);?></span>
								<?php } ?>
								<?php if (get_post_meta($post->ID, '_dc_button_link', true) != '') { ?>
									<a href="<?php echo get_post_meta($post->ID, '_dc_button_link', true);?>" class="button" title="<?php the_title(); ?>">
								<?php if (get_post_meta($post->ID, '_dc_button_text', true) != '') { ?>
									<?php echo get_post_meta($post->ID, '_dc_button_text', true);?>
								<?php } else { ?>
										<?php _e('Learn More', 'designcrumbs'); ?>
								<?php } ?>
									</a>
								<?php } ?>
									<div class="clear"></div>
								</div>
								<div class="slide_image_wrap">
								<?php if (get_post_meta($post->ID, '_dc_button_link', true) != '') { ?>
								<a href="<?php echo get_post_meta($post->ID, '_dc_button_link', true);?>" title="<?php the_title(); ?>"<?php if (of_get_option('slider_box') == 'yes') { ?> class="slide_image_box"<?php } ?>><?php } else { if (of_get_option('slider_box') == 'yes') { ?><div class="slide_image_box"><?php } } ?>
									<?php the_post_thumbnail( 'slide_image', array('alt' => get_the_title()) ); ?>
								<?php if (get_post_meta($post->ID, '_dc_button_link', true) != '') { ?></a><?php } else { if (of_get_option('slider_box') == 'yes') { ?></div><?php } } ?>
								</div>
								<div class="clear"></div>
							</div>
						<?php endwhile; wp_reset_query(); /* END THE SLIDE LOOP */?>
						</div>
						<div class="clear"></div>
						<?php if ($count_slides != '1') { ?>
						<div id="slide_pagination">
						<?php /* START THE SLIDE PAGINATION LOOP */ $loop = new WP_Query( array( 'post_type' => 'slides', 'posts_per_page' => 3, 'order' => 'desc' ) ); ?>
						<?php $count=0; ?>
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<?php $count++; ?>
							<a href="#<?php echo $count; ?>" class="slide_pag_link" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'slide_thumb', array('alt' => get_the_title()) ); ?></a>
						<?php endwhile; wp_reset_query(); /* END THE SLIDE PAGINATION LOOP */?>
							<div class="clear"></div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php } } ?>
		<div class="wrapper" id="content"> <!-- #content ends in footer.php -->
			<div class="container">