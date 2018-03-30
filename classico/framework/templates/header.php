<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="<?php if(etheme_get_option('responsive')): ?>width=device-width, initial-scale=1, maximum-scale=2.0<?php else: ?>width=1200<?php endif; ?>"/>

	<link rel="shortcut icon" href="<?php echo et_get_favicon(); ?>" />
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
			echo ' | ' . sprintf( __( 'Page %s', ET_DOMAIN ), max( $paged, $page ) );

		?></title>
		<?php
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'et_after_body' ); ?>

<?php 
	$ht = $class = ''; 
	$ht = apply_filters('custom_header_filter',$ht);  
	$page_slider = etheme_get_custom_field('page_slider');

	$hstrucutre = etheme_get_header_structure($ht); 

	if(in_array($ht, array(7, 8, 10))){
		$class .= " header-vertical-enable";
	}

	if($ht == 8) {
		$class .= " vertical-right";
	}
	
?>

<div class="template-container<?php echo $class; ?>">
	<div class="template-content">
	<div class="page-wrapper">

		<?php get_template_part('headers/structure', $hstrucutre); ?>