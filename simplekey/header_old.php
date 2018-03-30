<?php 
ob_start();
global $VAN;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8"> 
<?php if(!isset($VAN['isResponsive']) || $VAN['isResponsive']==1):?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
<?php endif;?>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head();?>
</head>

<body <?php body_class();?>>
<div id="ajax-load">
  <div id="close">X</div>
  <div id="ajax-content"></div>
</div>
<header id="top"> 
  <div class="wrapper">
	<?php if(!isset($VAN['top_social']) || $VAN['top_social']==0):?>
    <div class="top_social">
      <?php echo van_social();?>
    </div>
    <?php endif;?>
  </div> 
  <nav id="primary-menu">
    <h1 id="site-logo"><a href="<?php echo home_url();?>/#top" title="<?php echo bloginfo('description');?>"></a></h1>
    
    <div id="primary-menu-container">
         <?php wp_nav_menu(array(
				  'theme_location' => 'primary_navi',
				  'container' => '',
				  'menu_class' => 'sf-menu',
				  'fallback_cb' => 'van_scroll_pagemenu',
				  'echo' => true,
				  'walker'=> new Description_Walker,
                  'depth' => 4) );
		 ?>
    </div>
    <div id="mobileMenu"></div>
  </nav>
  
  <div style="margin-top:-68px;">
  <?php 
    /*
     * Since Simplekey 2.0, we deprecated the default slider 
     * and start to use Revolution Slider.
     */
     
     if(is_home()){
	   echo do_shortcode($VAN['home_revslider']);
     }
     
  ?>
  </div>
  
</header>