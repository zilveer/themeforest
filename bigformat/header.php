<?php
/**
 * The Theme Header
 * @package WordPress
 * @subpackage BigFormat
 * @since BigFormat 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="<?php language_attributes(); ?>"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<!-- Basic Page Needs
  ================================================== -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php if ( $favicon = of_get_option('of_custom_favicon') ) { echo '<link rel="shortcut icon" href="'. $favicon.'"/>'; } ?>

<!-- Embed Google Web Fonts Via API -->
<script type="text/javascript">
      WebFontConfig = {
        google: { families: [ 
            '<?php if ( $slide_header = of_get_option('of_slide_header') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($slide_header['face']) : $slide_header['face'];
            } else { 
                echo 'PT Sans Narrow';
            } ?>',
			'<?php if ( $slide_subtitle = of_get_option('of_slide_subtitle') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($slide_subtitle['face']) : $slide_subtitle['face']; 
            } else { 
                echo 'Droid Serif';
            } ?>',										
			'<?php if ( $sf_font = of_get_option('of_sf_font') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($sf_font['face']) : $sf_font['face'];
            } else { 
                echo 'PT Sans Narrow';
            } ?>',										
			'<?php if ( $h1font = of_get_option('of_heading_font') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($h1font['face']) : $h1font['face'];
            } else { 
                echo 'Open Sans';
            } ?>', 
			'<?php if ( $h2font = of_get_option('of_heading_font2') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($h2font['face']) : $h2font['face'];
            } else { 
                echo 'Open Sans';
            } ?>', 
			'<?php if ( $pfont = of_get_option('of_p_font') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($pfont['face']) : $pfont['face'];
            } else { 
                echo 'Open Sans';
            } ?>', 
			'<?php if ( $tinyfont = of_get_option('of_tiny_font') ) { 
                echo (function_exists('ag_is_default')) ? ag_is_default($tinyfont['face']) : $tinyfont['face'];
            } else { 
                echo 'Droid Serif'; 
            } ?>'] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();
</script>

<!-- Mobile Specific Metas
  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

<!-- Skin-->
<link href="<?php echo get_template_directory_uri(); ?>/css/light.css" rel="stylesheet" type="text/css" media="all" />

<!--Site Layout -->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> <?php echo ( $lightbox_skin = of_get_option('of_prettyphoto_skin') ) ? 'data-lightbox="' . $lightbox_skin . '"' : '';?>>

<noscript>
<div class="alert">
    <p>
        <?php _e('Please enable javascript to view this site.', 'framework'); ?>
    </p>
</div>
</noscript>
<!-- Preload Images
	================================================== -->
<div id="preloaded-images"><img src="<?php echo get_template_directory_uri();?>/images/downarrow.png" width="1" height="1" alt="Image" /> 
<img src="<?php echo get_template_directory_uri();?>/images/loading.gif" width="1" height="1" alt="Image" /> 
<img src="<?php echo get_template_directory_uri();?>/images/uparrow.png" width="1" height="1" alt="Image" />
<img src="<?php echo get_template_directory_uri();?>/images/loading-dark.gif" width="1" height="1" alt="Image" /> 
<img src="<?php echo get_template_directory_uri();?>/images/minus.png" width="1" height="1" alt="Image" /> </div>
<!-- Primary Page Layout
	================================================== -->
<div class="navcontainer" id="navscroll">
    <div class="logo">
        <h1> <a href="<?php echo home_url(); ?>" class="fulllogo">
            <?php if ( $logo = of_get_option('of_logo') ) { ?>
            <img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" class="scale-with-grid" />
            <?php } else { bloginfo( 'name' );} ?>
            </a> </h1>
    </div>
    <div class="navigation">
        <!--Start Navigation-->
        <div class="nav">
            <?php if ( has_nav_menu( 'top_nav_menu' ) ) { /* if menu location 'Top Navigation Menu' exists then use custom menu */ ?>
                <?php wp_nav_menu( array('menu' => 'Top Navigation Menu', 'theme_location' => 'top_nav_menu', 'menu_class' => 'sf-menu sf-vertical')); ?>
            <?php } else { /* else use wp_list_pages */?>
                <ul class="sf-menu sf-vertical">
                    <?php wp_list_pages( array('title_li' => '','sort_column' => 'menu_order')); ?>
                </ul>
            <?php } ?>
        </div>
        
    </div>
    <div class="clear"></div>
    
    <?php 
    	/* #If Full Projects Page
    	======================================================*/
    	if( is_page_template('template-home.php') || is_singular('portfolio') || is_page_template('template-home-video.php')) :     	
    	$video_url = get_post_meta(get_the_ID(), 'ag_video_url', true) ? get_post_meta(get_the_ID(), 'ag_video_url', true) : false;	
    	$video_home_url = get_post_meta(get_the_ID(), 'ag_video_url_home', true) ? get_post_meta(get_the_ID(), 'ag_video_url_home', true) : false;
    	
    	/* #If there's no video URL
    	======================================================*/
        if ( ! isset( $video_url ) || ! $video_url ) :
	?>
     
    <!--Control Bar-->
    <div id="controls-wrapper" class="load-item full">
        <div id="controls">
            <!--Slide counter-->
            <div id="slidecounter"> <span class="slidenumber"></span> / <span class="totalslides"></span> </div>
            <div class="clear"></div>
            <!--Arrow Navigation-->
            <div class="playcontrols"> <a id="prevslide" class="load-item"></a> <a id="play-button" class="tooltip-top" title="<?php _e('Play/Pause Slideshow', 'framework'); ?>"><img id="pauseplay" src="<?php echo get_template_directory_uri();?>/images/pause-button.png"/></a> <a id="nextslide" class="load-item"></a> </div>
            <div class="clear"></div>
            <!--Thumb Tray button-->
            <a id="tray-button" class="tooltip-top" title="<?php _e('See All Slides', 'framework'); ?>"><img id="tray-arrow" src="<?php echo get_template_directory_uri();?>/images/thumbsbutton.png"/></a>
            <div class="clear"></div>
            <!--Navigation-->
            <!-- <ul id="slide-list"></ul>-->
        </div>
    </div>
    
    <!--Slide Buttons in Upper Right Corner-->
    <ul id="slide-list"></ul>
    
    <div id="prevthumb"></div>
	<div id="nextthumb"></div>
    
    <?php 
	/* #If There is a Video
	======================================================*/
	else: ?>
    
    <!-- Video Controls-->
    <div class="playvideocontrols"><a href="#" id="play-video" class="tooltip-top play" title="<?php _e('Play/Pause Video', 'framework'); ?>"><?php _e('Play/Pause Video', 'framework'); ?></a> </div>
	
	<?php endif; ?>
    
    <?php 
	/* #If There is a Homepage Video
	======================================================*/
	if ($video_home_url && is_page_template('template-home-video.php')): ?>
        <div class="playvideocontrols"><a href="#" id="play-video" class="tooltip-top play" title="<?php _e('Play/Pause Video', 'framework'); ?>"><?php _e('Play/Pause Video', 'framework'); ?></a> </div>
    <?php endif; ?>
    
    <!-- Navigation Panel Open/Close Button -->
    <a href="#" class="navhandle"></a>
</div>

<?php endif;?>


<?php if(is_front_page() || is_singular('portfolio')) : ?>
	<?php 
	/* #If there's no Video URL or not set
	======================================================*/
    if ( ! isset( $video_url) || ! $video_url) :
    ?>
        <div id="thumb-tray" class="load-item">
            <div id="thumb-back"></div>
            <div id="thumb-forward"></div>
        </div>
        
        <!--Time Bar-->
        <div id="progress-back" class="load-item">
            <div id="progress-bar"></div>
        </div>
        
<?php endif; endif; ?>

<!-- Scroll to Top Function -->
<div class="top"> <a href="#"><img src="<?php echo get_template_directory_uri();?>/images/scroll-top.gif" alt="Scroll to Top"/></a>
    <div class="scroll">
        <p><?php _e('To Top', 'framework'); ?></p>
    </div>
</div>
<!-- Scroll to Top Function -->

<div id="top_panel" class="mobilenavcontainer">
    <div id="top_panel_content">
        <div class="mobilelogo">
            <h1 class="aligncenter">
            	<a href="<?php echo home_url(); ?>">
					<?php if ( $logo = of_get_option('of_logo') ) { ?>
                    <img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" class="scale-with-grid" />
                    <?php } else { bloginfo( 'name' );} ?>
                </a> 
             </h1>
        </div>
          <div class="clear"></div>
               <?php $menutext = of_get_option('of_menu_text');
			   if ($menutext == ''){ $menutext = 'Select a Page'; } ?>
       <a id="jump" href="#mobilenav"><?php echo  $menutext; ?></a>
       <div class="clear"></div>
        <div class="mobilenavigation">
        <?php if ( has_nav_menu( 'top_nav_menu' ) ) { /* if menu location 'Top Navigation Menu' exists then use custom menu */ ?>
                <?php wp_nav_menu( array('menu' => 'Top Navigation Menu', 'theme_location' => 'top_nav_menu', 'items_wrap' => '<ul id="mobilenav"><li id="back"><a href="#top">'. __('Hide Navigation', 'framework') . '</a></li>%3$s</ul>')); ?>
            <?php } else { /* else use wp_list_pages */?>
                <ul class="sf-menu sf-vertical">
                    <?php wp_list_pages( array('title_li' => '','sort_column' => 'menu_order', )); ?>
                </ul>
            <?php } ?>
        </div> 

        <div class="clear"></div>
    </div>
    
    <!--Toggle Button -->
    <div id="top_panel_button">
        <div id="toggle_button" class="uparrow"></div>
    </div>
    <!--Toggle Button -->
    
    <div class="clear"></div>
</div> 
</div>

<!-- Start Mainbody
  ================================================== -->
<div class="mainbody" id="wrapper">