<!DOCTYPE html>
<!--[if lt IE 7]>      <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
    
	<!-- BEGIN head -->
	<head>        
		<!-- Title -->
		<title><?php wp_title('|', true, 'right'); ?></title>
        
        <!-- Meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php if(plsh_gs('favicon')) : ?>
        <link rel="shortcut icon" href="<?php echo esc_url(plsh_gs('favicon')); ?>" />
        <?php endif; ?>
		<?php
			if ( is_singular() && get_option( 'thread_comments' ) )
            {
                wp_enqueue_script( 'comment-reply' );
            }
		?>
        
        <?php if (have_posts()):while(have_posts()):the_post(); endwhile; endif;?>
        
		
		<?php if(plsh_gs('display_theme_og_tags') == 'on') : ?>
		
			<!-- if page is content page -->
			<?php if (is_single()) { ?>
			<meta property="og:url" content="<?php the_permalink() ?>"/>
			<meta property="og:title" content="<?php esc_attr(single_post_title('')); ?>" />
			<meta property="og:description" content="<?php echo esc_attr(htmlentities(strip_tags(strip_shortcodes(get_the_excerpt())))); ?>" />
			<meta property="og:type" content="article" />
			<?php
				$img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog_thumb_single_small');
				if($img)
				{
					echo '<meta property="og:image" content="' . $img[0] . '" />';
				}
			?>
			<!-- if page is others -->
			<?php } else { ?>
			<meta property="og:site_name" content="<?php esc_attr(bloginfo('name')); ?>" />
			<meta property="og:description" content="<?php esc_attr(bloginfo('description')); ?>" />
			<meta property="og:type" content="website" />
			<meta property="og:image" content="<?php echo esc_url(plsh_gs('logo_image')); ?>" /> 
			<?php } ?>
        
		<?php endif; ?>
		
        <?php wp_head(); ?>
	</head>
    <?php $body_class = 'preload'; ?>
	<body <?php body_class($body_class); ?>>
            <?php get_template_part('theme/templates/header'); ?>
