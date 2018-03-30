<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"  />
<title><?php wp_title( '|', true, 'right' );?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="robots" content="follow, all" />
<?php $favico = get_option('vulcan_custom_favicon');?>
<link rel="shortcut icon" href="<?php echo ($favico) ? $favico : get_template_directory_uri().'/images/favicon.ico';?>"/>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
<!--[if IE 6]>    
	<link href="<?php echo get_template_directory_uri();?>/css/ie6.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/DD_belatedPNG.js"></script>
	<script type="text/javascript"> 
	   DD_belatedPNG.fix('img'); 
       DD_belatedPNG.fix('#pager a, ul.list-bottom li');
       DD_belatedPNG.fix('#footer-content, .dot-separator');
       DD_belatedPNG.fix('blockquote');   
	</script>    
<![endif]-->
<!--[if IE 7]>    
	<style type="text/css">
    #pager{top:260px;margin-left:0;right:20px;}
    #slideshow {height:298px;}
    #content .front-box-content{padding-bottom:45px;}
    .intouch { margin-top: -40px;}
    </style>
<![endif]-->
<!--[if IE 8]>    
	<style type="text/css">
    #pager{top:260px;}
    </style>
<![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<!-- ////////////////////////////////// -->
<!-- //      Javascript Files        // -->
<!-- ////////////////////////////////// -->
<?php if (is_home()) : 
$slideshowspeed = (get_option('vulcan_slideshow_speed')) ? get_option('vulcan_slideshow_speed') : 5000; 
$slide_transition = (get_option('vulcan_slide_transition')) ? get_option('vulcan_slide_transition') : "fade";
?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
     $('#slideshow ul.slideshow').cycle({
        timeout: <?php echo $slideshowspeed;?>,  // milliseconds between slide transitions (0 to disable auto advance)
        fx:      '<?php echo $slide_transition;?>', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
        pager:   '#pager',  // selector for element to use as pager container
        pause:   0,	  // true to enable "pause on hover"
        pauseOnPagerHover: 0 // true to pause when hovering over pager link
    });
  });
</script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/cufon-yui.js"></script>
<?php $cufon_fonts = get_option('vulcan_cufon_fonts'); if ($cufon_fonts == "") $cufon_fonts = "Vegur_300.font.js";?>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/fonts/<?php echo $cufon_fonts;?>"></script>

<script type="text/javascript">
    Cufon.replace('h1') ('h2') ('h3') ('h4') ('h5') ('h6') ('.slide-more') ('.heading1-slide') ('.heading2-slide') ('ul.navigation li a',{hover:true})('.more-button')('.post-date') ('.post-month');
    Cufon.set('fontWeight', 'Normal');
</script>  
</head>
<body <?php body_class(); ?>>
	<div id="container">
    
    	<!-- BEGIN OF HEADER -->
    	<div <?php if (is_home()) echo 'id="top-container"'; else echo 'id="top-container-inner"';?>>
        
        	<!-- begin of logo and mainmenu -->
        	<div id="header">
            	<div id="logo">
              <?php $logo_url  = get_option('vulcan_logo');?>
								<a href="<?php echo home_url();?>"><img src="<?php if ($logo_url != "") {echo $logo_url;} else { echo get_template_directory_uri().'/images/logo.gif';}?>" alt="<?php bloginfo('blogname');?>" /></a>
              </div>
              <div id="mainmenu">
                <?php 
                if (function_exists('wp_nav_menu')) { 
                  wp_nav_menu( array( 'menu_id'=>'menu','menu_class' => 'navigation', 'theme_location' => 'topnav', 'fallback_cb'=>'vulcan_topmenu_pages','depth' =>4 ) );
                } else {  
                  vulcan_topmenu_pages();
                } ?>
              </div>          
            </div>
            <!-- end of logo and mainmenu -->
            
            <?php if (is_home()) {
              get_template_part('slideshow','Main Slideshow');
            }
            ?>            
            <!-- begin of welcome-slogan -->
            <?php if (is_home()) : ?>
            <div id="slogan">
            <?php $site_slogan = get_option('vulcan_site_slogan');?>
            <h1><?php if ($site_slogan) echo stripslashes($site_slogan); else echo "Modern minimalist design with professional look, great choice for your business site, portfolio site, or personal site";?></h1>
            </div>
            <div class="dot-separator"></div>
            <div id="get-in-touch">
            <?php 
            $contactbox_text = get_option('vulcan_contactbox_text');
            $contactbox_link = get_option('vulcan_contactbox_link');
            $contactbox_image = get_option('vulcan_contactbox_image');
            ?>                        
              <a href="<?php echo ($contactbox_link) ? $contactbox_link : "#";?>"><img src="<?php echo $contactbox_image ? $contactbox_image : get_template_directory_uri().'/images/iMail.png';?>" alt="" class="get-in-touch"/><h4 class="intouch"><?php echo $contactbox_text ? $contactbox_text : __('Get in Touch Now','vulcan');?></h4></a>            
            </div>           
            <?php endif; ?>
            <!-- end of welcome-slogan -->
          <div class="clear"></div>            
        </div>
        <div class="clear"></div>
        <!-- END OF HEADER -->