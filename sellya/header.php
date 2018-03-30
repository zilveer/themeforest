<?php
/**
 * @package sellya Sport
 * @subpackage sellya_sport
 */
global $smof_data, $woocommerce;

$prefix =  is_ssl()?'https:':'http:';
 
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />



<script> document.createElement('header'); document.createElement('section'); document.createElement('article'); document.createElement('aside'); document.createElement('nav'); document.createElement('footer'); </script>

<!--[if lt IE 9]> 
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script> 
<![endif]--> 

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
 
<?php if($smof_data['sellya_widgetfb_status'] != '0'):?>
<div class="facebook_right hidden-phone">
<div id="facebook_icon"></div>
<div class="facebook_box">
  <script src="//connect.facebook.net/en_US/all.js#xfbml=1"></script>
  
  <fb:fan profile_id="<?php echo $smof_data['sellya_widgetfb_id']; ?>" stream="0" connections="16" logobar="0" width="237" height="389"></fb:fan>  
</div>
</div>
<?php endif;?>
<?php if($smof_data["sellya_widgetc_status"] != "0"):?>
<div class="custom_box_right hidden-phone">
<div id="custom_box_icon"></div>
<div class="custom_box">
<?php echo $smof_data['sellya_widgetc_content']; ?>
</div>
</div>
<?php endif;?>
<div class="wrapper">
<header id="header">
<div class="container">
<div id="t-header" class="row">
    <div id="logo">
       <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
      <?php $site_logo =  $smof_data['sellya_sitelogo'];
      if($site_logo!="") :
      ?>
      <img src="<?php echo $site_logo ;?>" title="" alt="" />      
      <?php else : ?>
     <img src="<?php echo get_template_directory_uri(); ?>/image/logo_sellya.png" alt="Logo" />
     <?php endif;?>
     </a></div>
    <div class="links hidden-phone"> 
       <?php wp_nav_menu( array('theme_location' => 'topnav', 'fallback_cb' => false)); ?>  
    </div>
    
    <?php	   
	if(isset($woocommerce) 
                and isset($smof_data['sellya_show_cart']) 
                and isset($smof_data['sellya_shop_status']) 
                and $smof_data['sellya_show_cart'] == 1                 
                and $smof_data['sellya_shop_status'] != 0
                ):
	?>    
    <div id="cart">
        <div class="heading">
            
            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'sellya'); ?>"><span id="cart-total"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'sellya'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></span></a>
            
            
        </div>
        <div class="content">            
            <?php show_header_carts();?>
        </div>
    </div><!--#cart -->
    <?php
	endif;
	
	if($smof_data['sellya_top_search_status'] != 0):
	?>    
    <div id="search" class="span4">    
	<?php //get_search_form(); ?>
    <form action="<?php echo home_url( '/' ); ?>" id="searchform" method="get">        
        <input type="text" placeholder="<?php _e('Search','sellya')?>" id="s" name="s" class="field" onkeydown="this.style.color = '#000000';">
        <div class="button-search"><input type="submit" value="Search" id="searchsubmit" name="submit"></div>	
	 </form>
    </div>
    <?php 
	endif;
	?>
     
     
  </div>

<div class="navbar visible-phone">
    <div class="navbar-inner">
      <div class="container">
        <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar brand">
        <?php echo __('MENU','sellya')?> <img alt="MENU" title="MENU" src="<?php echo get_template_directory_uri(); ?>/image/dropdown.png">
        </a>
        
        <div class="nav-collapse">
        	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav','container'=>'ul') ); ?>
        </div>
      </div>
    </div>
  </div>
  
<nav id="menu" class="row hidden-phone">
    <?php 
        wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav', 'walker' => new Main_nav_menu_walker() ) );
    ?>   
             

</nav>
</div> 

<div id="notification"></div>
</header>