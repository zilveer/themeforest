
<!-- THIS FILE LOADS ALL THE CUSTOMIZATIONS FROM THE THEME OPTIONS PANEL  -->
<!-- Load the font stack from the Options Panel -->
<?php if (get_option_tree('default_fontstack') == 'Serif') { ?>
<link rel="stylesheet" href="<?php echo WP_THEME_URL; ?>/assets/stylesheets/typography-serif.css" />
<?php } else { ?>
<link rel="stylesheet" href="<?php echo WP_THEME_URL; ?>/assets/stylesheets/typography-sans.css" />
<?php } ?>


<!--[if IE 8]>
<style type="text/css">
     .module-img img{width: 100%;}
     .isotope-item {
       z-index: 2;
     }
    
     .isotope-hidden.isotope-item {
       pointer-events: none;
       z-index: 1;
     }
</style>
<![endif]-->

<!--[if IE 7]>
<style type="text/css">
.sf-menu ul{
z-index: 999;
}

ul.social li {
    display: inline !important;
}
</style>
<![endif]-->


    
<!-- Load the default skin from the Options Panel -->
<?php $lightdark = '';
 
if (get_option_tree('default_skin') == 'Dark') { ?>
	<link rel="stylesheet" href="<?php echo WP_THEME_URL; ?>/assets/stylesheets/skin-dark.css" />
	<?php $lightdark = '-footer'; ?>
<?php } else if (get_option_tree('default_skin') == 'Clean') { ?>
	<link rel="stylesheet" href="<?php echo WP_THEME_URL; ?>/assets/stylesheets/skin-clean.css" />
		
<?php } else {} ?>

<link rel="stylesheet" type="text/css" media="all" href="<?php get_stylesheet_directory_uri(); ?>/style.css" />


<!-- Custom CSS Modifications from the Admin Panel -->
<style type="text/css">

/* Insert the rest of the custom CSS from the admin panel */ 
<?php echo ot_get_option('customcss'); ?> 
	 
	 
	/* Add a custom bg if it exists */
	<?php $homepage_bg = ot_get_option("default_bg");
			
	if(get_custom_field('custom_background_image')) { ?>
		body, body:after {background: url('<?php echo get_custom_field('custom_background_image',true); ?>') top left fixed repeat;}
		h2.title span, ul.tabs li a.active {background: none;}
	<?php } elseif (isset($homepage_bg[0])) { ?>
	 		body, body:after {background: url('<?php echo ot_get_option("default_bg"); ?>') top left fixed repeat;}
	 		h2.title span, ul.tabs li a.active {background: none;}
	<?php } else {} ?>
	 
	<?php global $theme_options; ?>
	
	
	body, #section-tophat,
	#section-footer,
	#section-sub-footer{
		background-repeat: repeat;
	 	background-position: top center;
	 	background-attachment: fixed;
	}
	
	/* CUSTOM BG INSERTER FOR TOPHAT, FOOTER, SUBFOOTER */
	<?php $tophat_bg = ot_get_option("tophat_background_image");
		  $tophat_color = ot_get_option("tophat_background_color");
		  $footer_bg = ot_get_option("footer_background_image");
		  $footer_color = ot_get_option("footer_background_color");
		  $subfooter_bg = ot_get_option("subfooter_background_image");
		  $subfooter_color = ot_get_option("subfooter_background_color");
	?>
	
	<?php if (isset($tophat_color[0])) { ?>
	 		#section-tophat, #section-tophat:after {
	 			background-image: url('');
	 			background-color: <?php echo ot_get_option("tophat_background_color"); ?>;
 			}
	<?php } ?>
	<?php if (isset($tophat_bg[0])) { ?>
	 		#section-tophat, #section-tophat:after {
	 			background-image: url('<?php echo ot_get_option("tophat_background_image"); ?>');
 			}
	<?php } ?>
	
	<?php if (isset($footer_color[0])) { ?>
	 		#section-footer, #section-footer:after {
	 			background-image: url('');
	 			background-color: <?php echo ot_get_option("footer_background_color"); ?>;
 			}
	<?php } ?>
	<?php if (isset($footer_bg[0])) { ?>
	 		#section-footer, #section-footer:after {
	 			background-image: url('<?php echo ot_get_option("footer_background_image"); ?>');
 			}
	<?php } ?>
	
	<?php if (isset($subfooter_color[0])) { ?>
	 		#section-sub-footer, #section-sub-footer:after {
	 			background-image: url('');
	 			background-color: <?php echo ot_get_option("subfooter_background_color"); ?>;
 			}
	<?php } ?>
	<?php if (isset($subfooter_bg[0])) { ?>
	 		#section-sub-footer, #section-sub-footer:after {
	 			background-image: url('<?php echo ot_get_option("subfooter_background_image"); ?>');
 			}
	<?php } ?>
	
	 
	 
	/* This is your link hover color */
	<?php $link_hover_color = ot_get_option("link_hover_color"); if (isset($link_hover_color[0])) { ?>		
		#section-header li a:hover, a:hover {color: <?php echo ot_get_option('link_hover_color');?>;}
	<?php } else {} ?>	
	
	/* This is your link color */
	<?php $link_color = ot_get_option("link_color"); if (isset($link_color[0])) { ?>		
		#section-header li a, a {color: <?php echo ot_get_option('link_color'); ?>;}
	<?php } else {} ?>
	
	/* This is your visited link color */
	<?php $link_visited_color = ot_get_option("link_visited_color"); if (isset($link_visited_color[0])) { ?>
		a:visited {color: <?php echo ot_get_option('link_visited_color'); ?>;}
	<?php } else {} ?>		
	
	
	
	
		
	
</style>



<!-- ALTERNATIVE HEADLINE FONT OVERRIDE - For TypeKit Insertion -->	
<?php $altfont = ot_get_option("alt_fontreplace"); if (isset($altfont[0])) { 	
	echo ot_get_option("alt_fontreplace");
	} else {} ?>
<!-- // END HEADLINE FONT OVERRIDE -->	



<!-- Hide the top bar / optional -->
<?php if (ot_get_option('top_hat') == 'off') { ?>	
	<style type="text/css">
	#section-tophat{display: none; height: 0px !important; margin: 0; padding: 0;}
	/* html{margin-top: -40px !important;} */
	</style>
<?php } ?> 



<!-- Check for Column Flipping -->
<?php if(get_custom_field('column_flip') == 'on') : ?>
	<style type="text/css">
	.main-content-area .eleven.columns{float: right !important;}
	</style>
<?php endif; ?>

<!-- Check for Force-Hiding of the Breakout Row -->
<?php if(get_custom_field('breakout_hide') == 'on') : ?>

<style type="text/css">
	#breakout-row{display: none;}
</style>

<?php endif; ?>

<!-- Force the Breakout Row on just the homepage -->
<?php if(ot_get_option('homepage_breakout_section') == 'on') { ?>

<style type="text/css">
	.home #breakout-row{display: inherit;}
</style>

<?php } ?>