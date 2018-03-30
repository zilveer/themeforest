<?php
/** Header
  *
  * Loads the header of the website including impotant
  * meta data and the actual header of the website.
  *
  * @package The Beauty Salon
  *
  */

global $framework;
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<!--[if IE 8]>
<style type='text/css'>
.image, .hoverlink, .image-container, .image .image {
	display:block !important;
}
</style>
<![endif]-->


<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | Page ' . max( $paged, $page ) ;

	?></title>

	<meta property="og:title" content="<?php echo $framework->page_title() ?>"/>
	<meta property="og:url" content="<?php echo $framework->canonical_url() ?>"/>
	<meta property="og:site_name" content="<?php bloginfo( 'name' ) ?>"/>
	<meta property="og:image" content="<?php echo $framework->page_image() ?>"/>


	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />


	<?php
		$favicon = $framework->options['favicon'];
		$image = wp_get_attachment_image_src( $favicon );
		if( !empty( $image ) ) :
	?>
	<link rel="icon" type="image/png" href="<?php echo $image[0] ?>">
	<?php endif ?>

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>

	<!--[if gte IE 9]>
	  <style type="text/css">
	    .gradient {
	       filter: none;
	    }
	  </style>
	<![endif]-->

	<style type='text/css'>
		<?php include( 'css/style.php' ) ?>
	</style>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . '/style-custom.css' ?>" />

</head>

<body <?php body_class(); ?>>

	<div class='container'>
		<div class='row'>
			<div class='indent left right'>
				<div id='site-header'>

					<div class='site-logo'>
						<?php
							$logo = $framework->options['logo'];
							if( !empty( $logo ) ) :
							$size = ( !empty($framework->options['resize_logo'] ) AND $framework->options['resize_logo'] == 'no' ) ? 'full' : 'thumbnail';
							$image = ( is_numeric( $logo ) )
								? wp_get_attachment_image_src( $logo, $size )
								: array( $logo );
							$alt_text = $framework->options['logo_alt_text'];
						?>
							<a href='<?php bloginfo( 'url' ) ?>'><img alt='<?php echo $alt_text ?>' src='<?php echo $image[0] ?>'></a>
						<?php else : ?>
							<h1><a href='<?php get_template_directory_uri() ?>'><?php bloginfo( 'title' ) ?></a></h1>
						<?php endif ?>
					</div>

					<div class='navigation navigation-menu' data-collapse='<?php echo $framework->options['header_menu_change_width'] ?>'>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'site_header',
							));

						?>
					</div>
					<div class='navigation navigation-select'>
						<?php
							wp_nav_menu(array(
							  'theme_location' => 'site_header',
							  'walker'         => new Walker_Nav_Menu_Dropdown(),
							  'items_wrap'     => '<select>%3$s</select>',
							  'fallback_cb'    => 'tvr_dropdown_pages',
							));
						?>
					</div>

					<div class='clear'></div>

				</div>
			</div>
		</div>
	</div>

	<div class='container'>
		<div class='row'>
			<div id='site-content'>