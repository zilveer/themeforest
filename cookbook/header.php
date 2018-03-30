<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

	<head>

        <!-- GENERAL HEADER -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta content="black" name="apple-mobile-web-app-status-bar-style">
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->

        <!-- THEME OPTIONS -->
        <?php $canon_options = get_option('canon_options'); ?>

        <!-- DYNAMIC HEAD -->
        <?php get_template_part('inc/templates/dynamic_head'); ?>

		<!-- WORDPRESS MAIN HEADER CALL -->
		<?php wp_head(); ?>

	</head>
	
    <body <?php body_class(get_canon_theme_body_classes());?>>
		
        <!-- MAINTENANCE MODE -->
        <?php 

            // DEFAULTS FAILSAFE
            if (!isset($canon_options['use_maintenance_mode'])) { $canon_options['use_maintenance_mode'] = "unchecked"; }
            if (!isset($canon_options['maintenance_title'])) { $canon_options['maintenance_msg'] = __("We are doing maintenance work!", "loc_canon"); }
            if (!isset($canon_options['maintenance_msg'])) { $canon_options['maintenance_msg'] = __("Don't worry we will be back soon -- in the meantime why don't you visit <a href='http://www.google.com'><strong><u>Google</u></strong></a>.", "loc_canon"); }

            if ( ($canon_options['use_maintenance_mode'] == "checked") && (is_user_logged_in() === false) ) {
                $maintenance_mode_markup = sprintf('<div class="maintenance_notice"><h1>%s</h1><p>%s</p></div>', esc_attr($canon_options["maintenance_title"]), do_shortcode(wp_kses_post($canon_options["maintenance_msg"])) );
                exit($maintenance_mode_markup); 
            }

        ?>

        <!-- HEADER -->
        <?php get_template_part('inc/templates/header/template_header'); ?>