<?php
/**
 * @KingSize 2011
 **/
####### Theme Setting #########
global $get_options,$data,$tpl_body_id;
$get_options = get_option('wm_theme_settings');
###############################
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
  	<!-- Set the viewport width to device width for mobile -->
  	<meta name="viewport" content="width=device-width, initial-scale=1" />
     
	<?php if ( !empty($data['wm_favicon_upload']) && $data['wm_favicon_enabled'] == "0" ) { ?><link rel="icon" type="<?php if(0 < strrpos($data['wm_favicon_upload'], '.png') ) echo 'image/png'; elseif(0 < strrpos($data['wm_favicon_upload'], '.gif') )  echo 'image/gif'; else 'image/x-icon'; ?>" href="<?php echo $data['wm_favicon_upload'];?>"><?php } ?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> <!-- Style Sheet -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> <!-- Pingback Call -->

	<!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<!-- calling global variables -->
	<?php require(get_template_directory() . '/js/custom.php'); ?>
	<!-- End calling global variables -->

	<!-- Do Not Remove the Below -->
	<?php if(is_singular()) wp_enqueue_script('comment-reply'); ?>
	<?php if ($tpl_body_id!="slideviewer") {  wp_enqueue_script("jquery"); } ?>
	
	<?php wp_enqueue_script( 'foundation' ); ?>

	<?php wp_head(); ?>
	<!-- Do Not Remove the Above -->
	
	<!-- Includedd CSS Files  -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/custom.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/mobile_navigation.css" type="text/css" />
  	
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/font-awesome/css/font-awesome.min.css">
	
	<!-- Theme setting head include wp admin -->
	<?php
	$head_include = "";
	$head_include = $data['wm_head_include'];
	echo $head_include;
	?>
	<!-- End Theme setting head include -->
	
	<!-- Gallery / Portfolio control CSS and JS-->		
	<?php 
	//if gallery Shortcode is being used 
	global $tpl_body_id;
	
	if( preg_match('/type="colorbox"(.*)/', $posts[0]->post_content, $matches) ) 	
	{
		$tpl_body_id = "colorbox";
	}
	elseif( preg_match('/type="fancybox"(.*)/', $posts[0]->post_content, $matches) ) 	
	{
		$tpl_body_id = "fancybox";
	}
	elseif( preg_match('/type="prettyphoto"(.*)/', $posts[0]->post_content, $matches) )
	{
		$tpl_body_id = "prettyphoto";
	}	
	elseif( preg_match('/type="slideviewer"(.*)/', $posts[0]->post_content, $matches) )
	{
		$tpl_body_id = "slideviewer";
	}
	elseif( preg_match('/type="galleria"(.*)/', $posts[0]->post_content, $matches) )
	{
		$tpl_body_id = "galleria";
	}
	// End if gallery shortcode being used
	
	include (get_template_directory() . '/lib/gallery_template_style_js.php'); ?>		
	<!-- END Portfolio control CSS and JS-->
	
	<?php if ( $data['wm_no_rightclick_enabled'] == "1" ) {?>
	<!-- Disable Right-click -->
		<script type="text/javascript" language="javascript">
			jQuery(function($) {
				$(this).bind("contextmenu", function(e) {
					e.preventDefault();
				});
			}); 
		</script>
	<!-- END of Disable Right-click -->
	<?php } ?>

	<!-- scripts for background slider -->	
	<?php
	if( $data['wm_background_type'] != 'Video Background' && is_home()) {			
		include (get_template_directory() . '/lib/background_slider.php'); 
	} 
	?>
    <!-- End scripts for background slider end here -->
    
	<!-- New Opacity/Transparency Options added in v4 -->
	<?php 
	if( $data['wm_enable_opacity'] == "0.9 Opacity") { ?>
	<style>
	/*<!--- .9 --->*/
	.sub-menu { opacity: 0.9; }
	.container { background-image:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/90/content_back.png); }
	</style>
	<?php } elseif( $data['wm_enable_opacity']  == "0.8 Opacity") { ?>
	<style>
	/*<!--- .8 --->*/
	.sub-menu { opacity: 0.8; }
	.container { background-image:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/80/content_back.png); }
	</style>
	<?php } elseif( $data['wm_enable_opacity']  == "0.7 Opacity") { ?>
	<style>
	/*<!--- .7 --->*/
	.sub-menu { opacity: 0.7; }
	.container { background-image:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/70/content_back.png); }
	</style>
	<?php } elseif( $data['wm_enable_opacity']  == "Default") { ?>
	<style>
	/*<!--- Default --->*/
	.sub-menu { opacity: 1; }
	.container { background-image:  url(<?php echo get_template_directory_uri(); ?>/images/content_back.png); }
	</style>
	<?php } ?>
	<!-- End of New Opacity/Tranparency Options -->
	
	<!-- Custom CSS Overrides -->
	<?php if( $data['wm_custom_css'] ) { ?><style><?php echo $data['wm_custom_css'];?></style><?php } ?>

	 <!-- Attach the Table CSS and Javascript -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/responsive-tables.css">
	<script src="<?php echo get_template_directory_uri();?>/js/responsive-tables.js" type="text/javascript" ></script>
	
	<!-- Conditional Meta Data -->
	<?php if( $data['wm_date_enabled'] == '1' ) { //data is enabled ?>
	<style>
		.blog_post { margin-bottom: 60px; }
	</style>
	<?php } ?>	
</head>

<?php
  ####### getting the current page template set from the page custom options #######	 
  $current_page_template = get_option('current_page_template');  

 ####### Overlay handling	#######
 $body_overlay = "body_home";
 $body_overlay_home = "";
    
//BACKGROUND IMAGE GRID OVERLAY
if( $data['wm_grid_hide_enabled'] == "Disable Grid Overlay on All Pages")
	$show_grid = false;
else
	$show_grid = true;

if(get_post_meta($wp_query->post->ID, 'kingsize_post_grid_overlay', true ) == 'grid_disabled')
	$show_grid = false;
elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_grid_overlay', true ) == 'grid_disabled')
	$show_grid = false;
elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_grid_overlay', true ) == 'grid_disabled')
	$show_grid = false;
elseif(get_post_meta($wp_query->post->ID, 'kingsize_post_grid_overlay', true ) == 'grid_enabled')
	$show_grid = true;
elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_grid_overlay', true ) == 'grid_enabled')
	$show_grid = true;
elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_grid_overlay', true ) == 'grid_enabled')
	$show_grid = true;



  if ($data['wm_grid_hide_enabled'] == "Disable Grid Overlay on All Pages" && is_home()) { 	
	$body_overlay = "";
  }
  elseif( $data['wm_grid_hide_enabled'] == "Enable the Grid Overlay on All Pages"  && is_home()){
	  $body_overlay_home = "body_about";
	  $body_overlay = "body_about";
  }
  elseif($show_grid == true  && !is_home()){
	  $body_overlay = "body_about";
  }
  else{
	$body_overlay = "";
  }

#########   Making conditional to hide the body content on page load ######### 
 include (get_template_directory() . '/lib/show_hide_body_menu.php'); 
##############################################################################
?>
<?php if(is_home()) {?>
<!--[if lte IE 7]>				
<style>
.body_home #menu_wrap
{margin: 0;}
</style>
<![endif]-->
	<?php
	if($data['wm_background_type'] == 'Video Background') { ?>
	<body <?php body_class($body_overlay_home." "."body_home video_background slider"); ?>>
	<?php } else { ?>
	<body <?php body_class($body_overlay_home." "."body_home slider"); ?>>
	<?php } ?>
<?php } else {?>
	<body <?php body_class($body_overlay."   ".$current_page_template);?>>
<?php 		
   } ?>


<?php
include (get_template_directory() . '/lib/background_video.php'); 
?>

	<!-- Mobile Header and Nav Start -->
    <nav class="top-bar show-for-small">
      	<ul>
          <!-- Logo Area -->
        	<li class="name">
				<?php
				 $theme_mobile_logo = $data['wm_mobile_logo_upload'];
				 $url_logo = get_template_directory_uri();
				 
				if(!empty($theme_mobile_logo))
				{	  
				?>	
        		 <a href="<?php echo home_url(); ?>"><img src="<?php echo $theme_mobile_logo;?>" alt="<?php bloginfo('name'); ?>" /></a>
				<?php
				} else {	
				?>	
				 <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri();?>/images/logo-top-bar.png" alt="<?php bloginfo('name'); ?>" /></a>
				<?php 
				}	
				?>
			</li>
         	<li class="toggle-topbar"><a href="#"></a></li>
        </ul>
        <div id='cssmenu'></div>    
    </nav>  
    <!-- End Mobile Header and Nav -->	

	<!-- New Opacity/Transparency Options added in v4 -->
	<?php 
	if( $data['wm_enable_opacity'] == "0.9 Opacity") { 

		$img_hide_menu_back = get_template_directory_uri()."/images/opacity/90/hide_menu_back.png";
		$img_menu_hide_arrow_top = get_template_directory_uri()."/images/menu_hide_arrow_top.png";
		$menu_back = get_template_directory_uri()."/images/opacity/90/menu_back.png";

	 } elseif( $data['wm_enable_opacity']  == "0.8 Opacity") { 

		$img_hide_menu_back = get_template_directory_uri()."/images/opacity/80/hide_menu_back.png";
		$img_menu_hide_arrow_top = get_template_directory_uri()."/images/menu_hide_arrow_top.png";
		$menu_back = get_template_directory_uri()."/images/opacity/80/menu_back.png";
	 
	 } elseif( $data['wm_enable_opacity']  == "0.7 Opacity") { 
		
		$img_hide_menu_back = get_template_directory_uri()."/images/opacity/70/hide_menu_back.png";
		$img_menu_hide_arrow_top = get_template_directory_uri()."/images/menu_hide_arrow_top.png";
		$menu_back = get_template_directory_uri()."/images/opacity/70/menu_back.png";
	  
	  } elseif( $data['wm_enable_opacity']  == "Default") { 
		
		$img_hide_menu_back = get_template_directory_uri()."/images/hide_menu_back.png";
		$img_menu_hide_arrow_top = get_template_directory_uri()."/images/menu_hide_arrow_top.png";
		$menu_back = get_template_directory_uri()."/images/menu_back.png";
	  }
	?>
	<!-- End of New Opacity/Tranparency Options -->

	<!-- Non-mobile Header and Nav -->
    <div class="row">
	    <div id="navContainer" class="front hide-for-small">
    		<div id="navRepeatPart">
              <div id="bgRepeat"><img src="<?php echo $menu_back;?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>"></div>        
                <div class="logo text-center" id="logo">
                     <?php
					  //get custom logo
					  $theme_custom_logo = $data['wm_logo_upload'];
					  $url_logo = get_template_directory_uri();

					 if(!empty($theme_custom_logo))
					 {
					  ?>
					 <a href="<?php echo home_url(); ?>"><img src="<?php echo $theme_custom_logo ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
					 <?php
					 } else {
					 ?>
					 <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri();?>/images/logo_main.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a>
					 <?php
					  }	 
					 ?>
                </div>
                <div id="mainNavigation">        	
                    <!-- Navbar -->
					<?php 
						wp_nav_menu( array(
						 'sort_column' =>'menu_order',
						 'container' => 'ul',
						 'theme_location' => 'header-nav',
						 'fallback_cb' => 'null',
						 'menu_id' => '',
						 'menu_class' => '',
						 'link_before' => '',
						 'link_after' => '',
						 'depth' => 0,
						 'walker' => new description_walker())
						 );
					?>
					<!-- Navbar ends here -->	
					
	                <!-- BEGIN Menu Social Networks -->
	                <?php if ( $data['wm_show_social_header_icons'] == "" || $data['wm_show_social_header_icons'] == "0" ) { ?>
	                <div class="social-networks-menu hide-for-small">
	                	<?php include (get_template_directory() . "/lib/social-networks-menu.php"); ?>
	                </div>
	                <?php } ?>
	                <!-- END Menu Social Networks -->					
                </div>
            </div>

			<!-- New Opacity/Transparency Options added in v4 -->
			<?php 
			if( $data['wm_enable_opacity'] == "0.9 Opacity") { 

				$img_hide_menu_back = get_template_directory_uri()."/images/opacity/90/hide_menu_back.png";
				$img_menu_hide_arrow_top = get_template_directory_uri()."/images/menu_hide_arrow_top.png";

			 } elseif( $data['wm_enable_opacity']  == "0.8 Opacity") { 

				$img_hide_menu_back = get_template_directory_uri()."/images/opacity/80/hide_menu_back.png";
				$img_menu_hide_arrow_top = get_template_directory_uri()."/images/menu_hide_arrow_top.png";
			 
			 } elseif( $data['wm_enable_opacity']  == "0.7 Opacity") { 
				
				$img_hide_menu_back = get_template_directory_uri()."/images/opacity/70/hide_menu_back.png";
				$img_menu_hide_arrow_top = get_template_directory_uri()."/images/menu_hide_arrow_top.png";
			  
			  } elseif( $data['wm_enable_opacity']  == "Default") { 
				
				$img_hide_menu_back = get_template_directory_uri()."/images/hide_menu_back.png";
				$img_menu_hide_arrow_top = get_template_directory_uri()."/images/menu_hide_arrow_top.png";
			  
			  }
			?>
			<!-- End of New Opacity/Tranparency Options -->
	
            <div id="navArrowPart">
				<?php if ( $data['wm_menu_hide_enabled'] == "1" ) {?>
					<div id="navArrowImg"><img src="<?php echo $img_hide_menu_back;?>" height="130" alt=""></div>
					<div id="arrowLink"><a href="#"><img src="<?php echo $img_menu_hide_arrow_top;?>" width="48" height="48" alt="" <?php if ( $data['wm_menu_tooltip_enabled'] == "1" ) {?>title="<?php _e( 'Hide the navigation', 'kslang' ); ?>"  class="masterTooltip"<?php }?>></a></div>
				<?php } else {?>
					<div id="navArrowImg"><img src="<?php echo $img_hide_menu_back;?>" height="130" alt=""></div>
				<?php } ?>
            </div>    
          </div>
    </div>
    <!-- Non-mobile Header and Nav End -->

<?php 
	global $data, $cnt_slider;

	//background slider options validate	

	//whether video / image slider / default
		$show_slider = false;
	if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_video_background', true ) == 'image' && $cnt_slider > 0 )
		$show_slider = true;
	elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_video_background', true ) == 'image' && $cnt_slider > 0 )
		$show_slider = true;
	elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_video_background', true ) == 'image' && $cnt_slider > 0 )
		$show_slider = true;
	elseif($data['wm_background_type'] != 'Video Background' && $cnt_slider > 0 )
		$show_slider = true;
	
	//slider controller
	   $slider_controllers = false;
	if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_controllers', true ) == 'Enable Slider Controls')
		$slider_controllers = true;
	elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_controllers', true ) == 'Enable Slider Controls')
		$slider_controllers = true;
	elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_controllers', true ) == 'Enable Slider Controls')
		$slider_controllers = true;
	elseif($data['wm_slider_controllers']=="Enable Slider Controls" && is_home())	
		$slider_controllers = true;
	

if($show_slider == true) {	


if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_controller_position', true ) == 'display_controls_bottom')
	$slider_controller_position = 'Display Controls on Bottom of Slider Content';
elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_controller_position', true ) == 'display_controls_bottom')
	$slider_controller_position = 'Display Controls on Bottom of Slider Content';
elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_controller_position', true ) == 'display_controls_bottom')
	$slider_controller_position = 'Display Controls on Bottom of Slider Content';
elseif( $data['wm_slider_controller_position'] == "Display Controls on Bottom of Slider Content" )
	$slider_controller_position = 'Display Controls on Bottom of Slider Content';
else
   $slider_controller_position = '';

?>
<!--=============  Main Content Start =============-->    
   <div class="sliderInfoContainer">
      	<div class="slider-info <?php if ( $data['wm_slider_placement'] == "" || $data['wm_slider_placement'] == "0" ) { ?><?php } else { ?>slider-top<?php } ?>">    
		<?php if($slider_controllers==true && $slider_controller_position != "Display Controls on Bottom of Slider Content") { ?>
		<!--Slider Info Start-->
        <div class="slider-info-row">
            <div class="right">
                <ul class="link-list inline right">
                    <!-- Play button -->
                    <li><a id="play-button"><img id="pauseplay" src="<?php echo get_template_directory_uri();?>/images/slider_pause.png" alt="pause"></a></li>
                    <li><a id="prevslide" class="load-item"><img src="<?php echo get_template_directory_uri();?>/images/thumb-backward.png" alt="backward"></a></li>
                    <li><a id="nextslide" class="load-item"><img src="<?php echo get_template_directory_uri();?>/images/thumb-forward.png" alt="forward"></a></li>
                    <li>
                        <!--Slide counter-->
                        <div id="slidecounter">
                            <h4><span class="slidenumber"></span> / <span class="totalslides"></span></h4>
                        </div>                        
                    </li>
                </ul>
            </div>       
        </div>         
		<?php } ?>	
	
	<!--Slide captions displayed here-->
	<?php
	//show_title_description
	if(get_post_meta($wp_query->post->ID, 'kingsize_post_slider_contents', true ) != '' && !is_home())
		$show_title_description = get_post_meta($wp_query->post->ID, 'kingsize_post_slider_contents', true );
	elseif(get_post_meta($wp_query->post->ID, 'kingsize_page_slider_contents', true ) != '' && !is_home())
		$show_title_description = get_post_meta($wp_query->post->ID, 'kingsize_page_slider_contents', true );
	elseif(get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_contents', true ) != '' && !is_home())
		$show_title_description = get_post_meta($wp_query->post->ID, 'kingsize_portfolio_slider_contents', true );
	elseif($data['wm_slider_contents'] != ''  && is_home())
		$show_title_description = $data['wm_slider_contents'];

	if($show_title_description == 'Display Title & Description' || $show_title_description == 'Display Title' || $show_title_description == 'Display Description'){
	?>	
        <div class="slider-info-row">
            <div class="right text-right">
            	<!--Slide captions displayed here-->	
                <h2><span class="highlight-black" id="slidecaption"></span></h2>
            </div>        
        </div>        
        <div class="slider-info-row">
	        <div class="right text-right">        
                    <div class="slider-desc text-right">
	                    <!--Slide descriptions displayed here-->	
                        <p class="highlight-black" id="slidedescriptiontext"><i id="slidedescription"></i></p>
                    </div>
        	</div>       
        </div>        
        <div class="slider-info-row hide-for-small">
            <div class="right text-right">
                <p><a href="#" id="slidebutton"><span class="highlight-black" id="buttontext"></span></a></p>            
            </div>       
        </div>
	<?php } ?>
	<!--END Slide captions displayed here-->
	
		<?php if($slider_controllers==true && $slider_controller_position == "Display Controls on Bottom of Slider Content") { ?>
		<!--Slider Info Start-->
        <div class="slider-info-row">
            <div class="right">
                <ul class="link-list inline right">
                    <!-- Play button -->
                    <li><a id="play-button"><img id="pauseplay" src="<?php echo get_template_directory_uri();?>/images/slider_pause.png" alt="pause"/></a></li>
                    <li><a id="prevslide" class="load-item"><img src="<?php echo get_template_directory_uri();?>/images/thumb-backward.png" alt="backward"></a></li>
                    <li><a id="nextslide" class="load-item"><img src="<?php echo get_template_directory_uri();?>/images/thumb-forward.png" alt="forward"></a></li>
                    <li>
                        <!--Slide counter-->
                        <div id="slidecounter">
                            <h4><span class="slidenumber"></span> / <span class="totalslides"></span></h4>
                        </div>                        
                    </li>
                </ul>
            </div>       
        </div>         
		<?php } ?>	
    <!--Slider Info Ends-->  
		
	</div>
   </div>
<!--=============  Main Content Ends =============-->
<?php
}
?>


<!-- KingSize Website Start -->    
<?php
if(!is_home()) {
?>
<div class="row" id="mainContainer">
	<!--=============  Main Content Start =============-->    
	<div class="nine columns container back right">
<?php } ?>
