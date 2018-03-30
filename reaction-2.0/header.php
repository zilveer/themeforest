<!DOCTYPE html >
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<meta charset="utf-8">	
	
	<?php $theme_options = get_option('option_tree'); ?>
	
	<!-- Mobile Specific Metas
  	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
	<link rel="shortcut icon" href="<?php echo get_option_tree('favicon'); ?>" type="image/gif" />
	
	<?php if ( ! isset( $content_width ) ) 
	    $content_width = 960;
	?>	
	
	<?php wp_head(); ?>	
	<?php get_template_part( 'element', 'styleloader' ); ?>
	
</head>


<!-- Start the Markup
================================================== -->
<body <?php body_class(); ?> >


<?php if (get_option_tree('top_hat') == 'on') { ?>	
	<?php get_template_part( 'element', 'tophat' ); ?>
<?php } ?>
	
<!-- Super Container for entire site -->
<div class="super-container full-width" id="section-header">

	<!-- 960 Container -->
	<div class="container">			
		
		<!-- Header -->
		<header>
		<div class="sixteen columns">
			 
			<!-- Branding -->
			<div class="five columns alpha">
				<a href="<?php echo home_url(); ?>/" title="<?php echo bloginfo('blog_name'); ?>">
					<h1 id="logo">
						<?php $lightdark = '-lightbg';  if (ot_get_option('default_skin') == 'Dark') { $lightdark = '-darkbg'; } ?>    
						<?php $logopath = (get_option_tree('logo')) ? get_option_tree('logo') : WP_THEME_URL . "/assets/images/theme/logo/logo$lightdark.png"; ?> 
	        			<img id="logotype" src="<?php echo $logopath; ?>" alt="<?php echo bloginfo('blog_name'); ?>" />
	         		</h1>
				</a>
			</div>
			<!-- /End Branding -->
			
			<div class="eleven columns omega">
				<?php get_template_part( 'element', 'navigation' ); ?>
			</div> 
			
			<hr class="remove-bottom"/>
		</div>
		
			
		</header>
		<!-- /End Header -->
	
	</div>
	<!-- End 960 Container -->
	
</div>
<!-- End SuperContainer -->


<!-- ============================================== -->


<!-- Frontpage Conditionals -->
<?php if ( is_home() ) : ?> 

	<?php if(get_option_tree('frontpage_slider') == 'on') { ?>
		<?php get_template_part( 'element', 'flexslider' ); ?>
	<?php } ?>
				
<?php endif; ?>

		
<!-- Page Conditionals -->
<?php if ( is_page() ) : ?>

	<!-- Frontpage Slider Conditional -->		
	<?php if(get_custom_field('frontpage_slider') == 'on') :  				
		get_template_part( 'element', 'flexslider' ); 								
	endif; ?>

	<!-- PageSlider Conditional -->
	<?php if(get_custom_field('image_slider') == 'on') :				
		get_template_part( 'element', 'pageslider' ); 				
	endif; ?>
				
	<!-- Set a global variable for the page ID that we can use in the footer (outside of the loop) -->
	<?php $GLOBALS[ 'isapage' ] = 'on'; 
	global $wp_query;
	$GLOBALS[ 'ourpostid' ] = $wp_query->post->ID; ?>

<?php endif; ?>


<!-- Post Conditionals -->
<?php if ( is_single() ) : ?>

	<!-- PageSlider Conditional -->
	<?php if(get_custom_field('image_slider') == 'on') {				
		get_template_part( 'element', 'postslider' ); 				
	} else {}; ?>
	
	<!-- Set a global variable for the page ID that we can use in the footer (outside of the loop) -->
	<?php $GLOBALS[ 'isapost' ] = 'on'; 
	global $wp_query;
	$GLOBALS[ 'ourpostid' ] = $wp_query->post->ID; ?>

<?php endif; ?>