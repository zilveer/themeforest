<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <?php global $clapat_bg_theme_options; ?>
    
    <link rel="shortcut icon" href="<?php if( $clapat_bg_theme_options['clapat_bg_favicon'] ){ echo esc_url( $clapat_bg_theme_options['clapat_bg_favicon']['url'] ); } else { echo get_template_directory_uri()."/images/favicon.ico"; } ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(""); ?>>

    <?php
    if( $clapat_bg_theme_options['clapat_bg_loading_color'] ){

        $bknd_color_style = '';
        if( !empty( $clapat_bg_theme_options['clapat_bg_loading_mask_color'] ) ){

            $bknd_color_style = 'style="background-color: ' . esc_attr( $clapat_bg_theme_options['clapat_bg_loading_mask_color'] ) . ';"';
        }
    ?>
    <!-- Preloader -->
    <div class="clapat-mask" <?php echo $bknd_color_style; ?>><div id="clapatloader" style="background-color:<?php echo esc_attr( $clapat_bg_theme_options['clapat_bg_loading_color'] ); ?>"></div></div>
    <!--/Preloader -->
    <?php
    }
    ?>
	
	 <!-- Header -->
    <header class="first-load">
                                
        <!-- Header Wrapper -->                    
        <div id="header-wrapper">
	
		<?php get_template_part('sections/menu_section'); ?>
	
		</div>
        <!--/Header Wrapper -->
    
    </header>
    <!--/Header -->
	