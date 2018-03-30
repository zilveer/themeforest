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
    ?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php if( of_get_option('header_favicon') )
	{ ?>
    	<link rel="shortcut icon" href="<?php echo of_get_option('header_favicon'); ?>" />
    <?php
    }
	
	if( of_get_option('rss_feed') ) 
	{ ?>
    	<link rel="alternate" type="application/rss+xml" title="<?php echo of_get_option('rss_title'); ?>" href="<?php echo of_get_option('rss_feed'); ?>" />
    <?php
    }

/* ------------------------------------
:: CUSTOM PAGE DATA
------------------------------------ */

	global $exittext,$exit_classes,$post;
	
	$introtext 		= ( get_post_meta( $post->ID, '_cmb_introtext', true ) !='' ) 	  ? get_post_meta( $post->ID, '_cmb_introtext', true ) : '';
	$intro_classes  = ( get_post_meta( $post->ID, '_cmb_intro_classes', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_intro_classes', true ) : '';
	$exittext  		= ( get_post_meta( $post->ID, '_cmb_exittext', true ) !='' ) 	  ? get_post_meta( $post->ID, '_cmb_exittext', true ) : '';
	$exit_classes  	= ( get_post_meta( $post->ID, '_cmb_exit_classes', true ) !='' )  ? get_post_meta( $post->ID, '_cmb_exit_classes', true ) : '';
	$show_slider  	= ( get_post_meta( $post->ID, '_cmb_gallery', true ) !='' ) 	  ? get_post_meta( $post->ID, '_cmb_gallery', true ) : '';
	$gallerycat  	= ( get_post_meta( $post->ID, '_cmb_gallerycat', true ) !='' ) 	  ? get_post_meta( $post->ID, '_cmb_gallerycat', true ) : '';
	
	
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
		$get_skin_data = maybe_unserialize(get_option('skin_data_'.$preview_skin));
	
		global $NV_frame_footer,$NV_branding_ver,$NV_transparent_branding_ver;
		
		$NV_skin = $preview_skin;
		
		$NV_frame_header = $get_skin_data['skin_id_frame_header'];
		$NV_frame_main   = $get_skin_data['skin_id_frame_main'];
		$NV_frame_footer = $get_skin_data['skin_id_frame_footer'];
		$NV_branding_ver = $get_skin_data['skin_id_branding_ver'];
		$NV_transparent_branding_ver = $get_skin_data['skin_id_transparent_branding_ver'];
	} 
	else
	{
		if( !empty($NV_skin) ) $skin = $NV_skin; elseif(DEFAULT_SKIN) $skin = DEFAULT_SKIN; else $skin = $NV_defaultskin;
		
		$get_skin_data = maybe_unserialize( get_option('skin_data_'.$skin) );
		
		global $NV_frame_footer,$NV_branding_ver,$NV_transparent_branding_ver;
		
		$NV_frame_header = $get_skin_data['skin_id_frame_header'];
		$NV_frame_main   = $get_skin_data['skin_id_frame_main'];
		$NV_frame_footer = $get_skin_data['skin_id_frame_footer'];
		$NV_branding_ver = $get_skin_data['skin_id_branding_ver'];
		$NV_transparent_branding_ver = $get_skin_data['skin_id_transparent_branding_ver'];
		
	} ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
   

	<?php 
	
	require_once NV_DIR.'/style.php';

	// Inner Skin CSS
	$default_inner_skin = ( get_option('inskin') !='' ) ? get_option('inskin') : 'light';
	
	$get_inner_skin = ( $get_skin_data['skin_id_icon_color'] != '' && $get_skin_data['skin_id_icon_color'] != 'default' ) ? $get_skin_data['skin_id_icon_color'] : $default_inner_skin;
	$inner_skin = ( get_post_meta( $post->ID, '_cmb_innerskin', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_innerskin', true ) : $get_inner_skin;
	
	// Set default divider shade
	if( $inner_skin == 'dark' )
	{
		$default_shade = 'divider-dark';
	}
	else
	{
		$default_shade = 'divider-light';
	}
	
	global $NV_footer_divider,$NV_footer_shadow;
	
	$NV_main_divider = ( $get_skin_data['skin_id_main_divider_shade'] != '' ) ? 'divider-'. $get_skin_data['skin_id_main_divider_shade'] : $default_shade;
	$NV_header_divider = ( $get_skin_data['skin_id_header_divider_shade'] != '' ) ? 'divider-'. $get_skin_data['skin_id_header_divider_shade'] : 'divider-medium';
	$NV_footer_divider = ( $get_skin_data['skin_id_footer_divider_shade'] != '' ) ? 'divider-'. $get_skin_data['skin_id_footer_divider_shade'] : 'divider-medium';
	
	
	$NV_header_shadow = $NV_footer_shadow = '';
	
	if( isset( $get_skin_data['skin_id_header_shadow'] ) )
	{
		$NV_header_shadow = ( $get_skin_data['skin_id_header_shadow'] != '' ?  $get_skin_data['skin_id_header_shadow'] : 'enable' );	
		$NV_footer_shadow = $NV_header_shadow;	
	}
	
	// Enqueue Dark CSS
	if ( !is_admin() )
	{	
		if( $get_skin_data['skin_id_icon_color'] == 'dark' || $inner_skin == 'dark' && $inner_skin != 'light' ) :
			
		wp_register_style('style-dark', get_template_directory_uri().'/style.dark.css',array('northvantage-style'));
		wp_enqueue_style('style-dark');
			
		endif;
	}
	
	// Cufon Font Replacement Script 
	require_once NV_FILES ."/inc/cufon-replace.php";
	
	wp_head();
 
/* ------------------------------------
:: BROWSER SUPPORT
------------------------------------ */ ?>

    <!--[if IE 7]>
    <link href="<?php echo get_template_directory_uri(); ?>/stylesheets/ie7.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <!--[if lte IE 8]>	
    <script src="<?php echo get_template_directory_uri(); ?>/js/ie7.js" type="text/javascript"></script>
    <link href="<?php echo get_template_directory_uri(); ?>/stylesheets/ie.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    
    <?php if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) { $i_device=true; } else { $i_device=''; } // detect iPhone / iPad 

	// Tracking Code
	if( of_get_option( 'tracking_code' ) ) echo  of_get_option( 'tracking_code' ); 
	
	$NV_header_float = ( get_post_meta( $post->ID, '_cmb_header_float', true ) !='' ) ? get_post_meta( $post->ID, '_cmb_header_float', true ) : ''; ?>

</head>
<body <?php body_class('skinset-background loaded nv-skin'); ?>>

    <div id="primary-wrapper" <?php echo 'class="nv-'. $inner_skin .'"'; ?>>
    	<div class="site-inwrap clearfix <?php echo $NV_header_float; ?>">
        <a id="top"></a>
        
		<?php
		
		$layerset1 = ( $get_skin_data['skin_id_layer1_type'] != '' ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer1_type'])) : '';
		$layerset2 = ( $get_skin_data['skin_id_layer2_type'] != '' ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer2_type'])) : '';
		$layerset3 = ( $get_skin_data['skin_id_layer3_type'] != '' ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer3_type'])) : '';
		$layerset4 = ( $get_skin_data['skin_id_layer4_type'] != '' ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer4_type'])) : '';
		$layerset5 = ( $get_skin_data['skin_id_layer5_type'] != '' ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer5_type'])) : '';
        
        // Set Fixed Position for specific background layers
        if($layerset1 == 'layer1_imagefull' || $layerset1 == 'layer1_video' || $layerset1 == 'layer1_cycle') $layer1_fixed='fixed'; else $layer1_fixed='';
        if($layerset2 == 'layer2_imagefull' || $layerset2 == 'layer2_video' || $layerset2 == 'layer2_cycle') $layer2_fixed='fixed'; else $layer2_fixed='';
        if($layerset3 == 'layer3_imagefull' || $layerset3 == 'layer3_video' || $layerset3 == 'layer3_cycle') $layer3_fixed='fixed'; else $layer3_fixed='';
        if($layerset4 == 'layer4_imagefull' || $layerset4 == 'layer4_video' || $layerset4 == 'layer4_cycle') $layer4_fixed='fixed'; else $layer4_fixed='';
		if($layerset5 == 'layer5_imagefull' || $layerset5 == 'layer5_video' || $layerset5 == 'layer5_cycle') $layer5_fixed='fixed'; else $layer5_fixed='';

/* ------------------------------------
:: MAIN BACKGROUND
------------------------------------ */
	
	echo "\n". '<div id="custom-layer5-color" class="custom-layer"></div>';
	echo "\n". '<div id="custom-layer5" class="custom-layer '. $layer5_fixed .'">';
	
	if( !empty( $layerset5 ) ) echo setlayer_html( "layer5" ,$layerset5, $skin );
	
	echo "\n". '</div>';

/* ------------------------------------
:: CONFIGURE HEADER
------------------------------------ */

	if( $NV_disableheader != 'yes' )
	{
		require NV_DIR ."/config.header.php";
	}
	else
	{
		echo '<div class="row"></div>';
	}
	
/* ------------------------------------
:: REVOLUTION SLIDER
------------------------------------ */

	if( is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
	{ 
		if( $NV_show_slider == "revslider" && class_exists('RevSlider') )
		{
			$revslider_id = get_post_meta( $post->ID, '_cmb_data-7', true );
			
			if( !empty( $revslider_id ) )
			{
				echo "\n\t". '<div class="revslider-container">';
				echo "\n\t\t". putRevSlider( $revslider_id );
				echo "\n\t". '</div>';
				
			}
		}
		elseif( $NV_show_slider == "revslider" && !class_exists('RevSlider') )
		{
			
				echo "\n\t". '<div class="revslider-container install-plugin">';
				echo "\n\t\t". '<p>'. __( 'Install Revolution Slider Plugin','themeva' ) .'</p>';	
				echo "\n\t". '</div>';
		}		
	}	

/* ------------------------------------
:: STAGE GALLERY, iSLIDER, NIVO
------------------------------------ */

	if( is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
	{ 
		if( $NV_show_slider == "stageslider" || $NV_show_slider == "islider" || $NV_show_slider == "nivo" )
		{
			require NV_FILES ."/inc/gallery-stage.php"; // Stage Gallery
		}
	}

/* ------------------------------------
:: PIECEMAKER
------------------------------------ */
	
	// if iPad or iPhone
	if( $i_device && $NV_show_slider == "gallery3d" )
	{ 
		if(is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
		{ 
			require NV_FILES ."/inc/gallery-stage.php"; // Stage Gallery
		}
	
	}
	else
	{
		if( is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
		{ 
			if( $NV_show_slider == "gallery3d" )
			{
				require NV_FILES .'/inc/gallery-piecemaker.php'; //
			}
		}
	}

	echo '<div class="wrapper main">';


/* ------------------------------------
:: ACCORDION
------------------------------------ */

	if( is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
	{ 
		if( $NV_show_slider == "galleryaccordion" )
		{ 
			require NV_FILES .'/inc/gallery-accordion.php';
		}
	}

/* ------------------------------------
:: GRID
------------------------------------ */
	
	if( is_page() || ( get_post_type( $post ) == 'portfolio' && is_single() ) )
	{ 
		if( $NV_show_slider == "gridgallery" && $NV_groupsliderpos != "below" )
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
		if( $NV_show_slider == "groupslider" && $NV_groupsliderpos != "below" )
		{ 
			require NV_FILES ."/inc/gallery-groupslider.php"; // Group Slider Gallery
		}
	}

/* ------------------------------------
:: TWITTER
------------------------------------ */

	if( $NV_twitter == 'pagetop' )
	{
		echo "\n" . '<div class="row">';
		echo "\n\t" . '<div class="twitter-wrap nv-skin disabled">';
		
		require NV_FILES .'/inc/twitter.php'; // Call Twitter Template
		
		echo "\n\t" . '</div>';
		echo "\n" . '</div>';
	}

/* ------------------------------------
:: INTRO TEXT
------------------------------------ */

	// Content Border
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

	// Hide Main Content
	if( $NV_hidecontent != "yes" )
	{ 
		global $wp_query;
		
		if( $NV_contentborder != 'yes' || is_search() )
		{
			$NV_contentborder = "no";
		}
		
		echo "\n" . '<div class="content-wrap row">';
		echo "\n\t" . '<div class="'. $NV_frame_main .' skinset-main nv-skin columns twelve '. $NV_main_divider .'">';
		
	} 


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
	if( $NV_hidebreadcrumbs == 'yes' && ( empty( $NV_socialicons ) || $NV_socialicons == 'off' ) && empty( $NV_textresize ) ) $NV_disable_subtabs = 'yes'; else $NV_disable_subtabs = '';
	
	if( $NV_disable_subtabs != 'yes' ) { ?>
	
		<div class="sub-header row"> 
		
			<?php 
			if( $NV_socialicons == "yes" || $NV_textresize == "yes" )
			{
				echo '<div class="resize-social-wrap columns">';
					require_once NV_FILES .'/inc/social-icons.php';                   
				echo '</div><!-- / resize-social-wrap -->';
			}
		
			if( $NV_hidebreadcrumbs != 'yes' )
			{ 
				echo '<div id="sub-tabs" class="columns '. ( $NV_socialicons == "yes" || $NV_textresize == "yes" ? 'six' : 'twelve' ) .'">';
					
					if( class_exists('bbPress') && is_bbpress() )
					{
						bbp_breadcrumb();
                  }
					else
					{ ?>
						<ul class="clearfix">
						<?php 										   	
							// Woocommerce Breadcrumb
							if ( function_exists( 'woocommerce_breadcrumb' ) && is_woocommerce() )
							{ 
								woocommerce_breadcrumb('delimiter= / &wrap_before=<div class="breadcrumb">');
							}
							elseif( function_exists('wpsc_has_breadcrumbs') ) // WP e-Commerce Breadcrumb	
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

	// Hide Main Content
	if( $NV_hidecontent != "yes" )
	{ 
		if( !empty($introtext) || $NV_pagetitle != "BLANK" && is_page() )
		{
			if( empty($intro_classes) ) $intro_classes='';
			
			echo "\n" . '<div class="intro-text-wrap row">';
			echo "\n\t" . '<div class="intro-text '. $intro_classes.' columns twelve">';
			echo "\n\t\t" . '<div>';
						
			if( !empty( $NV_postdate ) && !empty( $NV_authorname ) && !empty( $NV_pagesubtitle ) && !empty( $NV_pagetitle ) || $NV_pagetitle !="BLANK")
			{
				echo "\n\t\t\t" . '<div class="post-titles entry-header"><!-- post-titles -->';
				
				if( !empty($NV_pagetitle) )
				{
					if( $NV_pagetitle != "BLANK" )
					{
						echo "\n\t\t\t\t" . '<h1 class="entry-title">'. htmlspecialchars( do_shortcode($NV_pagetitle) ) .'</h1>';
					}
				}
				else
				{
					if( $NV_pagetitle != "BLANK" )
					{
						echo "\n\t\t\t\t" . '<h1 class="entry-title">'. get_the_title() .'</h1>';
					}
				}		
				
				if( !empty($NV_pagesubtitle) )
				{
					echo "\n\t\t\t\t" . '<h2>'. htmlspecialchars( do_shortcode($NV_pagesubtitle) ) .'</h2>';
				}
	
				if( $NV_postdate || $NV_authorname != 'disable' )
				{
					echo "\n\t\t\t\t" . '<div class="post-date">';
					
					if( $NV_postdate )
					{ 
						echo "\n\t\t\t\t\t" . '<small class="date updated">'. get_the_time('F jS  Y') .'</small><span class="break">&nbsp;</span>';
					}
					
					if( $NV_authorname != 'disable' )
					{
						echo "\n\t\t\t\t\t" . '<small>'. __('By', 'themeva') .' <span class="vcard author">'. get_the_author_meta( 'display_name' , $wp_query->post->post_author ) .'</span></small>';
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
	}
	
	echo "\n" . '<div class="row main-row">';