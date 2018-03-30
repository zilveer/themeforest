<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */
?>

<!DOCTYPE html>
<!-- InTouch theme. A ZERGE design (http://www.color-theme.com - http://themeforest.net/user/ZERGE) - Proudly powered by WordPress (http://wordpress.org) -->

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 10]>
<html class="ie ie10" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<?php global $ct_options ?>
<?php $responsive_layout = $ct_options['ct_responsive_layout']; ?>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<?php if ( $responsive_layout ) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php if ( is_single() ) : ?>
	<?php $post_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large'); ?>
	<?php $post_description = ct_get_excerpt_by_id( $post->ID ); ?>
	<meta property="og:url" content="<?php echo get_permalink( $post->ID ); ?>" />
	<meta property="og:title" content="<?php echo get_the_title( $post->ID ); ?>" />
	<meta property="og:image" content="<?php echo $post_image_url[0]; ?>" />
	<meta property="og:description" content="<?php echo $post_description; ?>" />
<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	// Load custom background image from Theme Options
	global $wp_query;
		if( is_home() ) {
			$postid = get_option('page_for_posts');
		} elseif( is_search() || is_404() || is_category() || is_tag() || is_author() ) {
			$postid = 0;
		} else {
			$postid = $wp_query->post->ID;
		}

		// Get the unique background image for page
		$bg_img = get_post_meta($postid, 'ct_mb_background_image', true);
		$src = wp_get_attachment_image_src( $bg_img, 'full' );
		$bg_img = $src[0];

		if( empty($bg_img) ) { 
			// Background image not defined, fallback to default background
			$bg_pos = stripslashes ( $ct_options['ct_default_bg_position'] );
			$bg_type = stripslashes ( $ct_options['ct_default_bg_type'] );
			if ( $bg_pos == 'Full Screen' ) {
				$bg_pos = 'full';
			}

			// Get the fullscreen background image for page
			if( ($bg_pos == 'full') && ( $bg_type != 'Color' )) {
				$bg_img = stripslashes ( $ct_options['ct_default_bg_image'] );
				if( !empty($bg_img) ) {
					$ct_page_title = $wp_query->post->post_title;

					echo '<img id="bg-stretch" src="' . $bg_img . '" alt="' . $ct_page_title . '" />';
				}
			}
		} else {
			// else get the unique background image for page
			$bg_pos = get_post_meta($postid, 'ct_mb_background_position', true);

			if( $bg_pos == 'full' ) {
				$ct_page_title = $wp_query->post->post_title;

				echo '<img id="bg-stretch" src="' . $bg_img . '" alt="' . $ct_page_title . '" />';
			}
		}
	?>

	<?php
	//error_reporting(-1);
	$logo_type = $ct_options['ct_type_logo'];
	$show_search = $ct_options['ct_show_search'];
	$logo_width = $ct_options['ct_logo_width'];
	$header_blocks = $ct_options['ct_header_blocks'];
	if ( isset( $ct_options['ct_logo_block_width'] ) ) $logo_block_width = $ct_options['ct_logo_block_width']; else $logo_block_width = 'col-lg-3';
	if ( isset( $ct_options['ct_banner_block_width'] ) ) $banner_block_width = $ct_options['ct_banner_block_width']; else $banner_block_width = 'col-lg-9';

	if ( $logo_width == 'wide' ) : $logo_block_width = 'col-lg-12'; endif;
	?>

	<!-- START HEADER -->
	<header id="masthead" class="site-header" role="banner">

		<?php
		if ( is_home() || is_page_template('template-home.php') ) :
			if ( is_active_sidebar( 'ct_homepage_header' ) ) : ?>
				<!-- START HOMEPAGE HEADER SIDEBAR -->
				<div class="container">
					<div class="row">
						<div class="col-lg-12 page_header_sidebar">
							<?php dynamic_sidebar( 'ct_homepage_header' ); ?>
						</div><!-- .col-lg-12 -->
					</div><!-- .row -->
				</div><!-- .container -->
				<!-- END HOMEPAGE HEADER SIDEBAR -->
			<?php endif;
		elseif ( is_category() ) :
			if ( is_active_sidebar( 'ct_category_header' ) ) : ?>
				<!-- START CATEGORY HEADER SIDEBAR -->
				<div class="container">
					<div class="row">
						<div class="col-lg-12 page_header_sidebar">
							<?php dynamic_sidebar( 'ct_category_header' ); ?>
						</div><!-- .col-lg-12 -->
					</div><!-- .row -->
				</div><!-- .container -->
				<!-- END CATEGORY HEADER SIDEBAR -->
			<?php endif;
		elseif ( is_page() ) :
			if ( is_active_sidebar( 'ct_page_header' ) ) : ?>
				<!-- START PAGE HEADER SIDEBAR -->
				<div class="container">
					<div class="row">
						<div class="col-lg-12 page_header_sidebar">
							<?php dynamic_sidebar( 'ct_page_header' ); ?>
						</div><!-- .col-lg-12 -->
					</div><!-- .row -->
				</div><!-- .container -->
				<!-- END PAGE HEADER SIDEBAR -->
			<?php endif;
		elseif ( is_single() ) :
			if ( is_active_sidebar( 'ct_single_header' ) ) : ?>
				<!-- START SINGLE HEADER SIDEBAR -->
				<div class="container">
					<div class="row">
						<div class="col-lg-12 page_header_sidebar">
							<?php dynamic_sidebar( 'ct_single_header' ); ?>
						</div><!-- .col-lg-12 -->
					</div><!-- .row -->
				</div><!-- .container -->
				<!-- END SINGLE HEADER SIDEBAR -->
			<?php endif;
		endif; ?>

		<div class="ct-top-entry">
			<div class="container">
				<div class="row">
					<div class="<?php echo $logo_block_width; ?> entry-logo">
						<div id="logo">
			  			 	<?php if ( $logo_type == "image" ) { ?>
			  			 		<?php if ( is_home() or is_front_page() ) { ?>
									<h1>
										<a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $ct_options['ct_logo_upload'] ) ?>" alt="<?php bloginfo('name'); ?>" /></a>
										<span class="alt-logo"><?php bloginfo('name'); ?></span>
									</h1>
								<?php } else { ?>
									<a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $ct_options['ct_logo_upload'] ) ?>" alt="<?php bloginfo('name'); ?>" /></a>
								<?php }	?>
							<?php }	?>

							<?php if ( $logo_type == "text" ) { ?>
								<h1><a href="<?php echo home_url(); ?>"><?php echo stripslashes( $ct_options['ct_logo_text'] ); ?></a></h1>
								<span class="logo-slogan"><?php echo stripslashes( $ct_options['ct_logo_slogan'] ); ?></span>
							<?php } ?>
						</div> <!-- #logo -->
					</div><!-- .col-lg- -->

					<?php if ( $logo_width == 'standard' ) : ?>
					<div class="<?php echo $banner_block_width; ?> entry-banner">

						<?php if ( $header_blocks == 'searchsocial' ) : ?>
							<?php
								$sc_block = $ct_options['ct_sc_block'];
								$show_search = $ct_options['ct_show_search'];
								if ( !$show_search ) { $ct_social_col = 'col-lg-12'; } else { $ct_social_col = 'col-lg-4'; }
							?>

							<div class="row">
								<?php if ( $show_search ) : ?>
									<div class="col-lg-8 ct-entry-search">
										<div id="ct-search-block">
											<?php get_search_form(); ?>
										</div><!-- #ct-search-block -->
									</div><!-- .col-lg-6 -->
								<?php endif; ?>

								<div class="<?php echo $ct_social_col; ?> ct-entry-social">
									<?php if ( $sc_block ) :
										echo ct_get_social_icons();
									endif; ?>
								</div><!-- .col-lg-6 -->
							</div><!-- .row -->
						<?php else :
							$banner_upload = stripslashes( $ct_options['ct_banner_upload'] );
							$banner_code = stripslashes( $ct_options['ct_banner_code'] );
							$show_top_banner = stripslashes( $ct_options['ct_top_banner'] ); ?>
							<div id="ct-banner-block" class="clearfix" role="banner">
								<?php if ( $banner_upload != '' && $show_top_banner == 'Upload' ) :	?>
									<a href="<?php echo stripslashes( $ct_options['ct_banner_link'] ); ?>" target="_blank"><img src="<?php echo stripslashes( $ct_options['ct_banner_upload'] ) ?>" alt="banner" /></a>
								<?php elseif ( $banner_code != '' && $show_top_banner == 'Code' ) :
									echo $banner_code;
								endif; ?>
							</div><!-- #ct-banner-block -->
						<?php endif;  //end $header_blocks ?>
					</div><!-- .col-lg- banner -->
					<?php endif;  //end $logo_width ?>
				</div><!-- .row -->
			</div><!-- .container -->

			<div class="ct-menu-container">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 clearfix">
							<nav class="navigation clearfix" role="navigation">
								<?php 
								if ( has_nav_menu('main_menu') ) wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'sf-menu'));
								?>
							</nav>  <!-- .navigation -->
						</div><!-- .col-lg-12 -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .ct-menu-container -->

		</div><!-- .ct-top-entry -->
	</header> <!-- #header -->
	<!-- END HEADER -->