<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
 
    <meta charset="<?php bloginfo('charset'); ?>"> 
	    
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="author" content="Wedding">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--meta responsive-->
    
    <!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/main/html5.js"></script>
	<![endif]-->

    <?php global $redux_demo; ?>
    
    <?php include( get_template_directory() . '/include/header/favicons.php'); ?>


	
<?php wp_head(); ?>	  
</head>  
<body style="" id="start_nicdark_framework" <?php body_class(); ?>>



<?php if ($redux_demo['general_preloader'] == 1) { ?>
	<!--start preloader-->
	<div class="nicdark_preloader"><i class="<?php echo esc_attr($redux_demo['general_preloader_icon']); ?> nicdark_preloader_color"></i></div>
	<!--end preloader-->
<?php } ?>


<div style="" class="nicdark_site <?php if ( is_front_page() ) { echo "nicdark_front_page"; } ?> ">
	

	<?php if ($redux_demo['general_boxed'] == 0) { ?> <div class="nicdark_site_fullwidth_boxed nicdark_site_fullwidth nicdark_clearfix"> <?php } else { ?> <div class="nicdark_site_fullwidth_boxed nicdark_site_boxed nicdark_clearfix"> <?php }; ?>
    
    	<div class="nicdark_overlay"></div>

		<!--start left right sidebar open-->
		<?php if ($redux_demo['header_left_sidebar'] == 1) { include "include/sidebars/left-sidebar-open.php"; } else {}; ?>
		<?php if ($redux_demo['header_right_sidebar'] == 1) { include "include//sidebars/right-sidebar-open.php"; } else {}; ?>
		<!--end left right sidebar open-->    	

		<div class="nicdark_section nicdark_navigation nicdark_upper_level2">
		    
		    <!--decide fullwidth or boxed header-->
			<?php if ($redux_demo['header_boxed'] == 1) { ?> <div class='nicdark_menu_fullwidth_boxed nicdark_menu_boxed'> <?php }else{ ?> <div class='nicdark_menu_fullwidth_boxed nicdark_menu_fullwidth'> <?php } ?>
		        
				<!--start top header-->
				<?php if ($redux_demo['topheader_display'] == 1) { include "include/header/top-header.php"; } else {}; ?>
				<!--end top header-->

		    <!--decide gradient or not-->
		    <?php if ($redux_demo['header_gradient'] == 1) { ?> <div class="nicdark_space3 nicdark_bg_gradient"></div> <?php }else{} ?>

		    	<!--start middle header-->
				<?php if ($redux_demo['middleheader_display'] == 1 And $redux_demo['header_navigation_type'] == 'navigation-2') { include "include/header/middle-header.php"; } else {}; ?>
				<!--end middle header-->
   
				<!--decide navigation-->
   				<?php if ($redux_demo['header_navigation_type'] == 'navigation-1') { include "include/header/navigation-1.php"; } ?>
   				<?php if ($redux_demo['header_navigation_type'] == 'navigation-2') { include "include/header/navigation-2.php"; } ?>
   				<?php if ($redux_demo['header_navigation_type'] == 'navigation-3') { include "include/header/navigation-3.php"; } ?>
   				<!--decide navigation-->

		    </div>

		</div>



		<!--start menu responsive pop up-->
		<div id="nicdark_window_popup_menu_responsive" class="nicdark_window_popup zoom-anim-dialog mfp-hide">
		   
		   <div class="nicdark_textevidence nicdark_bg_<?php echo $redux_demo['btn_menu_responsive_color']; ?>">
		        <div class="nicdark_margin20">
		            <h4 class="white"><?php _e('MENU','weddingindustry'); ?></h4>
		        </div>
		    </div>

		    <div class="nicdark_padding20 nicdark_display_inlineblock nicdark_width_percentage100 nicdark_sizing widget widget_nav_menu nicdark_bg_white">
		        <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>    
		    </div>  

		</div>
		<!--end menu responsive pop up-->
						


