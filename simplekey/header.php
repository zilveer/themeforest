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
 <div id="sticky-top">  
  <?php if(isset($VAN['sticky_top']) && $VAN['sticky_top']<>''):?>
  <div id="extra-top"><?php echo convert_smilies(stripslashes($VAN['sticky_top']));?></div>
  <?php endif;?>
  <nav id="primary-menu">
    <h1 id="site-logo"><a href="<?php echo home_url();?>/#top" title="<?php echo bloginfo('description');?>"><span><?php bloginfo('name');?></span></a></h1>
    
    <?php if(!isset($VAN['top_social']) || $VAN['top_social']==0):?>
    <div class="top_social">
      <?php echo van_social();?>
    </div>
    <?php endif;?>
    
    <div id="primary-menu-container">
         <?php 
         //$menu_slug = get_post_meta( get_the_ID(), 'page_menu_value', true );
         wp_nav_menu(array(
				  'theme_location' => 'primary_navi',
         // 'menu' => $menu_slug,
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
 </div>
  
  <?php 
    /*
     * Since Simplekey 2.0, we deprecated the default slider 
     * and start to use Revolution Slider.
     */
     
     if(is_home()){
	   echo do_shortcode($VAN['home_revslider']);
     }
     
  ?>
  
</header>