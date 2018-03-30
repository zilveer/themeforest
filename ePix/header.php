<?php
/**
 * @package WordPress
 * @subpackage themeva  */ 
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php 

	if( of_get_option('enable_responsive') !== 'disable' )
	{	
		echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
	}
	
	if( of_get_option('header_favicon') )
	{ ?>
    	<link rel="shortcut icon" href="<?php echo of_get_option('header_favicon'); ?>" />
    <?php
    } ?>
    
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    
	<?php if( of_get_option('rss_feed') ) 
	{ ?>
    	<link rel="alternate" type="application/rss+xml" title="<?php echo of_get_option('rss_title'); ?>" href="<?php echo of_get_option('rss_feed'); ?>" />
    <?php
    }

/* ------------------------------------
:: CUSTOM PAGE DATA
------------------------------------ */

	global $post;
	
	$introtext 	= ( get_post_meta( $post->ID, '_cmb_introtext', true ) !='' ) 	  ? get_post_meta( $post->ID, '_cmb_introtext', true ) : '';
	$intro_classes	= ( get_post_meta( $post->ID, '_cmb_intro_classes', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_intro_classes', true ) : '';	
	$show_slider  	= ( get_post_meta( $post->ID, '_cmb_gallery', true ) !='' ) 	  ? get_post_meta( $post->ID, '_cmb_gallery', true ) : '';
	$gallerycat  	= ( get_post_meta( $post->ID, '_cmb_gallerycat', true ) !='' ) 	  ? get_post_meta( $post->ID, '_cmb_gallerycat', true ) : '';
	$preloader		= ( of_get_option( 'preloader' ) == 'disable' ? 'loaded no-preload' : '' );
	
	require_once NV_FILES ."/inc/page-constants.php"; // Page Constants


	/* ------------------------------------
	:: SKIN DATA
	------------------------------------ */

	if( get_option('preview_skin') == '' && get_option('skin_select') == '' )
	{
		update_option('preview_skin', $NV_defaultskin );
		update_option('skin_select', $NV_defaultskin ); 	
	}		

	$preview_skin = ( get_option('preview_skin') !='' && get_option('customize_skin') == 'customizing' ) ? get_option('preview_skin') : '';
	
	if( isset( $_GET['preview_skin'] ) ) 
	{
		if( $_GET['preview_skin'] != '' )
		{
			$preview_skin = $_GET['preview_skin'];
		}
	}
	
	// if preivewing skin
	if( !empty($preview_skin) )
	{
		$get_skin_data = maybe_unserialize( get_option('skin_data_'.$preview_skin) );
	
		global $NV_frame_footer,$NV_branding_ver,$NV_transparent_branding_ver;
		
		$NV_skin = $preview_skin;
		
		$NV_frame_header 	= ( !empty( $get_skin_data['skin_id_frame_header'] ) ) ? $get_skin_data['skin_id_frame_header'] : '';
		$NV_frame_main   	= ( !empty( $get_skin_data['skin_id_frame_main'] ) ) 	? $get_skin_data['skin_id_frame_main'] : '';
		$NV_frame_footer 	= ( !empty( $get_skin_data['skin_id_frame_footer'] ) ) ? $get_skin_data['skin_id_frame_footer'] : '';
		$NV_branding_ver 	= ( !empty( $get_skin_data['skin_id_branding_ver'] ) ) ? $get_skin_data['skin_id_branding_ver'] : '';
		$NV_navalign		= ( !empty( $get_skin_data['skin_id_navalign'] ) ) 		? $get_skin_data['skin_id_navalign'] : '';
		$NV_transparent_branding_ver = ( !empty( $get_skin_data['skin_id_transparent_branding_ver']  ) ) ? $get_skin_data['skin_id_transparent_branding_ver'] : '';
	} 
	else
	{
		if( !empty($NV_skin) ) $skin = $NV_skin; elseif(DEFAULT_SKIN) $skin = DEFAULT_SKIN; else $skin = $NV_defaultskin;
		
		$get_skin_data = maybe_unserialize( get_option('skin_data_'.$skin) );
		
		global $NV_frame_footer,$NV_branding_ver,$NV_transparent_branding_ver;
		
		$NV_frame_header 	= ( !empty( $get_skin_data['skin_id_frame_header'] ) ) 	? $get_skin_data['skin_id_frame_header'] : '';
		$NV_frame_main   	= ( !empty( $get_skin_data['skin_id_frame_main'] ) ) 	? $get_skin_data['skin_id_frame_main'] : '';
		$NV_frame_footer 	= ( !empty( $get_skin_data['skin_id_frame_footer'] ) ) 	? $get_skin_data['skin_id_frame_footer'] : '';
		$NV_branding_ver 	= ( !empty( $get_skin_data['skin_id_branding_ver'] ) ) 	? $get_skin_data['skin_id_branding_ver'] : '';
		$NV_navalign		= ( !empty( $get_skin_data['skin_id_navalign'] ) ) 		? $get_skin_data['skin_id_navalign'] : '';
		$NV_transparent_branding_ver = ( !empty( $get_skin_data['skin_id_transparent_branding_ver']  ) ) ? $get_skin_data['skin_id_transparent_branding_ver'] : '';
	} ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php 
	
	// Load Custom Styles + Fonts
	require_once NV_DIR.'/style.php';
	require_once NV_FILES ."/inc/cufon-replace.php"; 
 
	// Tracking Code
	if( of_get_option( 'tracking_code' ) ) echo  of_get_option( 'tracking_code' );
	
	wp_head(); ?>

</head>
<body <?php body_class('skinset-background nv-skin '. $preloader ); ?>>
        
	<?php
	
	$layerset1 = ( !empty( $get_skin_data['skin_id_layer1_type'] ) ) ? stripslashes( htmlspecialchars( $get_skin_data['skin_id_layer1_type'] ) ) : '';
        
    // Set Fixed Position for specific background layers
        
    if( $layerset1 == 'layer1_imagefull' || $layerset1 == 'layer1_video' || $layerset1 == 'layer1_cycle' ) $layer1_fixed = 'fixed'; else $layer1_fixed = '';
    
	
	if( $layerset1 )
	{
		echo "\n\t". '<div id="custom-layer1-color" class="custom-layer"></div>';
		echo "\n\t". '<div id="custom-layer1" class="custom-layer '. $layer1_fixed .'">';
		echo "\n\t\t". setlayer_html( "layer1", $layerset1, $skin );
		echo "\n\t". '</div>';
	}
	
	// Background Sliders
	$auto_hide_menu_timeout = $fullscreen_slider = '';

	// Auto hide menu	
	$collapse_menu = ( get_post_meta( $post->ID, '_cmb_collapse_menu', true ) != 'disable-callapse-menu' && ( of_get_option('collapse_menu') == 'collapse-menu' || get_post_meta( $post->ID, '_cmb_collapse_menu', true ) == 'collapse-menu' ) ? 'collapse-menu' : ( of_get_option('collapse_menu') == 'collapse-menu-mobile' || get_post_meta( $post->ID, '_cmb_collapse_menu', true ) == 'collapse-menu-mobile' ? 'collapse-menu-mobile' : '' ) );

	// Header Float
	$header_float = ( get_post_meta( $post->ID, '_cmb_header_float', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_header_float', true ) : '';
	
	if ( !empty( $header_float ) )
	{
		$collapse_menu = '';
	}

	// Header layout	
	$header_layout_type = ( preg_match("/^top-/", of_get_option( 'header_layout' ) ) ? 'top' : '' ); 
	$header_layout = of_get_option( 'header_layout' );
			
	// Auto hide menu attribute
	$auto_hide_menu_timeout = ( !empty( $timeout ) ? 'data-menutimeout="'. $timeout . '"' : '' );
	
	if( $NV_show_slider == "fullslider" )
	{	
		$fullscreen_slider = 'yes';

		// Auto hide menu	
		$autohide = ( get_post_meta( $post->ID, '_cmb_autohide_menu', true ) == 'auto-hide' ) ? get_post_meta( $post->ID, '_cmb_autohide_menu', true ) : '';
		
		// Auto hide menu timeout
		$timeout = ( get_post_meta( $post->ID, '_cmb_autohide_menu_timeout', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_autohide_menu_timeout', true ) : '10';
		
		// Auto hide menu attribute
		$auto_hide_menu_timeout = 'data-menutimeout="'. $timeout . '"';
		
		// Hide content
		$NV_hidecontent = 'yes';
		
		echo "\n\t". '<div id="custom-layer2" class="custom-layer '. (  $header_layout_type == 'top' ? 'bottom-nav ' : '' ) . $NV_show_slider .' '. $autohide .'">';		
		
		if( $NV_show_slider == "fullslider" && !post_password_required() ) 
		{		
			$NV_customlayer = 'yes';
			require_once NV_FILES ."/inc/gallery-stage.php"; // Stage Gallery
		}
		
		echo "\n\t". '</div>';
	}	
	
	
	// Site Layout
	if( $NV_wide_layout == 'enable' )
	{
		$site_layout = 'tva-wide-layout';	
	}
	elseif( $NV_wide_layout == 'wide_boxed' )
	{
		$site_layout = 'tva-wide-layout boxed-content';	
	}
	else
	{
		$site_layout = 'boxed';	
	}
	
	echo "\n\t". '<div id="primary-wrapper" class="'. ( !empty( $fullscreen_slider ) ? 'fullslider-active' : ''  ) .' '. ( !empty( $site_layout ) ? $site_layout : ''  ) .' '. $collapse_menu . ( $header_layout_type == 'top' ? ' horizontal-layout '. $header_layout : ' left-layout' ) .' '. $header_float .'">';
	echo "\n\t". '<div class="site-inwrap clearfix '. $header_float .'">';
	echo "\n\t\t". '<a id="top"></a>';


/* ------------------------------------
:: CONFIGURE HEADER
------------------------------------ */

	if( $NV_disableheader != 'yes' )
	{
		require NV_FILES ."/inc/config-header.php";
	}
	else
	{
		echo '<div class="row"></div>';
	}
	

	if( $NV_show_slider == "fullslider" && post_password_required() ) 
	{
		echo "\n\t". '<div class="main-wrap skinset-main nv-skin">';
		echo "\n\t\t\t". '<div class="row">';
		echo "\n\t\t\t\t". get_the_password_form();	
		echo "\n\t\t\t". '</div>';
		echo "\n\t". '</div>';
	}	
	
	if(  ! post_password_required() && ( !empty( $NV_show_slider ) && $NV_show_slider != 'nogallery' && $fullscreen_slider != 'yes' ) )
	{
		echo '<div class="slider-wrap skinset-main nv-skin">';
		echo '<div class="slider-wrap-inner">';

	
		/* ------------------------------------
		:: STAGE GALLERY
		------------------------------------ */
	
		if( is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
		{ 
			if( $NV_show_slider == "stageslider" || $NV_show_slider == "islider" || $NV_show_slider == "nivo" || $NV_show_slider == "galleryaccordion" || $NV_show_slider == "gallery3d" )
			{
				require_once NV_FILES ."/inc/gallery-stage.php";
			}
		}

		/* ------------------------------------
		:: CAROUSEL GALLERY
		------------------------------------ */
	
		if( is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
		{ 
			if( $NV_show_slider == "carousel" )
			{
				require_once NV_FILES ."/inc/gallery-carousel.php";
			}
		}		
	
		/* ------------------------------------
		:: GRID
		------------------------------------ */
		
		if( is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
		{ 
			if( $NV_show_slider == "gridgallery" )
			{
				$masonry 		= ( get_post_meta( $post->ID, '_cmb_gridmasonry', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_gridmasonry', true ) : '';
				$columnpadding  = ( get_post_meta( $post->ID, '_cmb_columnpadding', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_columnpadding', true ) : '';
				
				if( $NV_gridfilter == 'yes' ) $NV_galleryclass = $NV_galleryclass . ' filter';
				
				require_once NV_FILES ."/inc/gallery-grid.php"; // Group Slider Gallery

			} 
		}
	
		/* ------------------------------------
		:: GROUP SLIDER
		------------------------------------ */
	
		if( is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
		{ 
			if( $NV_show_slider == "groupslider" )
			{ 
				$columnpadding  = ( get_post_meta( $post->ID, '_cmb_columnpadding', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_columnpadding', true ) : '';
				require_once NV_FILES ."/inc/gallery-groupslider.php"; // Group Slider Gallery
			}
		}
		
		echo '</div>';
		echo '</div>';
	}

	// Hide Main Content
	if( $NV_hidecontent != "yes" )
	{ 	
		echo '<div class="main-wrap '. $NV_frame_main .' skinset-main nv-skin clearfix">';

		/* ------------------------------------
		:: TWITTER
		------------------------------------ */

		if( $NV_twitter == 'pagetop' && get_post_meta( $post->ID, '_cmb_twitter', true ) != 'disable' )
		{
			echo "\n" . '<div class="row">';
			echo "\n\t" . '<div class="twitter-wrap skinset-main nv-skin '. $NV_frame_header .'">';
			
			require NV_FILES .'/inc/twitter.php'; // Call Twitter Template
			
			echo "\n\t" . '</div>';
			echo "\n" . '</div>';
		}

	/* ------------------------------------
	:: INTRO TEXT
	------------------------------------ */

		if( !empty($introtext) || $NV_pagetitle != "BLANK" && is_page() )
		{
			
			echo "\n" . '<div class="row intro-wrap">';
			echo "\n\t" . '<div class="intro-text '. $intro_classes.'">';
			echo "\n\t\t" . '<div>';
						
			if( !empty( $NV_postdate ) && !empty( $NV_authorname ) && !empty( $NV_pagesubtitle ) && !empty( $NV_pagetitle ) || $NV_pagetitle !="BLANK")
			{
				echo "\n\t\t\t" . '<div class="post-titles"><!-- post-titles -->';
				
				if( !empty($NV_pagetitle) )
				{
					if( $NV_pagetitle != "BLANK" )
					{
						echo "\n\t\t\t\t" . '<h1>'. htmlspecialchars( do_shortcode($NV_pagetitle) ) .'</h1>';
					}
				}
				else
				{
					if( $NV_pagetitle != "BLANK" )
					{
						echo "\n\t\t\t\t" . '<h1>'. get_the_title() .'</h1>';
					}
				}		
				
				if( !empty($NV_pagesubtitle) )
				{
					echo "\n\t\t\t\t" . '<h2>'. htmlspecialchars( do_shortcode($NV_pagesubtitle) ) .'</h2>';
				}
	
				if( !empty( $NV_postdate ) || $NV_authorname != 'disable' )
				{
					echo "\n\t\t\t\t" . '<div class="post-date">';
					
					if( $NV_postdate )
					{ 
						echo "\n\t\t\t\t\t" . '<small>'. get_the_time('F jS  Y') .'</small><span class="break">&nbsp;</span>';
					}
					
					if( $NV_authorname != 'disable' )
					{
						echo "\n\t\t\t\t\t" . '<small>'. __('By', 'NorthVantage') .' <span class="author">'. get_the_author_meta( 'display_name' , $wp_query->post->post_author ) .'</span></small>';
					}
					
					echo "\n\t\t\t\t" . '</div>';
				}           
				
				echo "\n\t\t\t" . '</div><!-- /post-titles -->';
			}  
			
			// Intro Text
			if( !empty($introtext) ) echo do_shortcode($introtext);
	
			echo "\n\t\t" . '</div>';
			echo "\n\t\t" . '<div class="clear"></div>';
			echo "\n\t" . '</div>';
			echo "\n" . '</div>';	
		}

		global $wp_query;
		
		if( $NV_contentborder != 'yes' || is_search() )
		{
			$NV_contentborder = "no";
		}
		
		if( $NV_contentborder == "yes" )
		{
			$NV_frame_main = 'disabled';	
		}

		// Content Border BP
		if( class_exists( 'BP_Core_User' ) )
		{
			if( of_get_option('buddycontentborder') == 'disabled' && !bp_is_blog_page() )
			{
				$NV_frame_main = 'disabled';
			}
		}	
		
		// Content Border bbPress
		if( class_exists( 'bbPress' ) )
		{
			if( of_get_option('buddycontentborder') == 'disabled' && is_bbpress() )
			{
				$NV_frame_main = 'disabled';
			}
		}		
	
		if( of_get_option('buddycontentborder') == 'disabled' &&  ( class_exists( 'BP_Core_User' ) || class_exists( 'bbPress' ) ) )
		{
			$NV_frame_main = 'disabled';	
		}
		
		
		echo "\n" . '<div class="content-wrap row">';

		/* ------------------------------------
		:: BREADCRUMBS
		------------------------------------ */
	
		if ( class_exists( 'BP_Core_User' ) )
		{
			if( !bp_is_blog_page() )
			{
				if( empty( $NV_hidebreadcrumbs ) ) $NV_hidebreadcrumbs = "yes";
			}
		} 
		
		
		if( class_exists('WPSC_Query') )
		{
			if( get_post_type() == 'wpsc-product' || is_products_page() )
			{
				if( !wpsc_has_breadcrumbs() )
				{
					if( empty( $NV_hidebreadcrumbs ) ) $NV_hidebreadcrumbs = "yes";
				}
			}
		}
		
		if( is_front_page() || of_get_option('breadcrumb') == 'disable' ) $NV_hidebreadcrumbs = 'yes'; 
		
		// Sub Header Display	
		if( $NV_hidebreadcrumbs == 'yes' ) $NV_disable_subtabs = 'yes'; else $NV_disable_subtabs = '';
		
		if( $NV_disable_subtabs != 'yes' ) 
		{ ?>
		
			<div class="sub-header row clearfix"> 
			
				<?php 
			
				if( $NV_hidebreadcrumbs != 'yes' )
				{ ?>
					<div id="sub-tabs" class="columns twelve clearfix">
						<?php if(class_exists('bbPress') && is_bbpress())
						{
							bbp_breadcrumb();
						}
						else
						{ ?>
							<ul>
							<?php 										   
								if( function_exists('wpsc_has_breadcrumbs') || function_exists( 'woocommerce_breadcrumb' ) )
								{	
									// Woocommerce Breadcrumb
									if ( function_exists( 'woocommerce_breadcrumb' ) )
									{ 
										woocommerce_breadcrumb('delimiter= / &wrap_before=<div class="breadcrumb">');
									}
									
									// WP e-Commerce Breadcrumb				
									if( function_exists('wpsc_has_breadcrumbs') )
									{  
										if(wpsc_has_breadcrumbs() && !is_page() )
										{ ?>
											<div class='breadcrumb'>
												<li class="home">
													<a href='<?php echo get_option('product_list_url'); ?>'><?php echo get_option('blogname'); ?></a>
													<span class="subbreak">/</span>
												</li>
												<?php 
												while (wpsc_have_breadcrumbs()) : wpsc_the_breadcrumb();
													if(wpsc_breadcrumb_url())
													{ ?> 	   
														<li>
															<a href='<?php echo wpsc_breadcrumb_url(); ?>'><?php echo wpsc_breadcrumb_name(); ?></a>
															<span class="subbreak">/</span>
														</li>
													<?php 
													}
													else
													{ ?> 
														<li><?php echo wpsc_breadcrumb_name(); ?></li>
														<li class="subbreak">/</li>
												<?php 
													} 
												endwhile;
												
												if ($wp_query->is_single === true && get_post_type() == 'wpsc-product') 
												{ ?>
													<li class="current_page_item">
														<?php echo wpsc_the_product_title(); ?>
														<span class="subbreak">/</span>	
													</li>
												<?php 
												} ?>
											</div>
											<?php 
										}
										else
										{
											if (function_exists('DYN_breadcrumbs')) DYN_breadcrumbs(); 	
										}
									}
								}
								else
								{
									if (function_exists('DYN_breadcrumbs')) DYN_breadcrumbs(); 
								} ?>
							</ul>
						<?php 
						} ?>
					</div>
				<?php 
				} ?>
			</div>
		<?php 
		}
		
		echo "\n" . '<div class="row content-inwrap">';

	} 	