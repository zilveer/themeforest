<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns/fb#" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:addthis="http://www.addthis.com/help/api-spec">
<head profile="http://gmpg.org/xfn/11">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
	<?php
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'ocmx' ), max( $paged, $page ) );
	?>
</title>
<!--Set Viewport for Mobile Devices -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<!-- Setup OpenGraph support-->
<?php ocmx_open_graph(); ?>


<?php if(get_option("ocmx_custom_favicon") != "") : ?>
    <link href="<?php echo get_option("ocmx_custom_favicon"); ?>" rel="icon" type="image/png" />
<?php endif; ?>

<?php if(get_option("ocmx_rss_url")) : ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo get_option("ocmx_rss_url"); ?>" />
<?php else : ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if(get_option("ocmx_typekit") != "") :
	echo get_option("ocmx_typekit");
endif; ?>

<!--[if lt IE 8]>
	   <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/ie.css" media="screen" />
<![endif]-->

<?php wp_head();

get_template_part( 'functions/post-styles' ); ?>

</head>

<body <?php body_class(''); ?>>
		<div id="header-container">
			<div id="header" class="clearfix">

				<div class="logo">
					<?php if( get_option("ocmx_custom_logo") ) { ?>
						<a href="<?php echo home_url(); ?>"><img src="<?php echo get_option("ocmx_custom_logo"); ?>" alt="<?php bloginfo('name'); ?>" /></a>
					<?php } else {
						if( get_option("ocmx_display_site_title") != "no" ) { ?>
							<h3>
								<a href="<?php echo home_url(); ?>">
									<?php echo strip_tags(bloginfo('name')); ?>
								</a>
							</h3>
						<?php } // If ocmx_display_site_title == yes
						if( is_singular() ) { ?>
							<small class="no_display"><?php the_title(); ?></small>
						<?php }
						if(get_option("ocmx_display_site_tagline") != "no") { ?>
							<span class="tagline"><?php echo strip_tags(bloginfo('description')); ?></span>
						<?php } // If ocmx_display_site_tagline == yes
					} // If ocmx_custom_logo ?>
				</div>

				<?php $menustyle = get_option("ocmx_menu_style"); ?>
				<div class="<?php echo $menustyle; ?>">
					<?php if($menustyle == "expanded") : ?>
						<a id="menu-drop-button" class="no-label" href="#"></a>
					<?php else : ?>
						<a id="menu-drop-button" href="#">
							<?php if( '' != get_option( 'ocmx_menu_button_label' ) ) {
								echo get_option( 'ocmx_menu_button_label' );
							} else {
								_e( 'Menu' , 'ocmx' );
							} ?>
						</a>
					<?php endif; ?>
					<?php if ($menustyle == "expanded" && function_exists("wp_nav_menu")) :
						wp_nav_menu(array(
							'menu' => 'Obox Nav',
							'menu_id' => 'nav',
							'menu_class' => 'expanded clearfix',
							'sort_column' 	=> 'menu_order',
							'theme_location' => 'primary',
							'container' => 'ul',
							'fallback_cb' => FALSE )
						);
					endif; ?>
				</div>

			</div><!--End header -->


		</div><!--End header-container -->

	<?php get_sidebar(); ?>
	<div id="wrapper">

		<!--Begin Content -->
		<div id="content-container" <?php if( is_single() ) { post_class("clearfix"); } else { echo 'class="clearfix"'; } ?>>