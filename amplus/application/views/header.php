<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php echo bfi_title() ?></title>
<?php

/**
 * Charset
 *
 * Specify the char set used in the site.
 */
?>
<meta charset="<?php echo bloginfo('charset'); ?>"/>
<?php

/**
 * Viewport meta tag
 *
 * For proper display in mobile devices
 */
?>
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0"/>
<?php


/**
 * Other WP necessary header tags
 */
?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php


/**
 * Make sure that the main menu doesn't show up before we finalize
 * the menu, since it will look ugly
 */
?>
<style>
    #top-menu, #main-menu {
        visibility: hidden;
    }
    #top-menu.ddsmoothmenu, #main-menu.ddsmoothmenu {
        visibility: visible;
    }
</style>
<!--[if lte IE 9]>
<style>
    #top-menu, #main-menu {
        visibility: visible;
    }
</style>
<![endif]-->
<?php 


/**
 * Include the pagemedia
 */
get_template_part('header', 'pagemedia');
?>
<?php 
      if (bfi_get_option('heading_font_type') == "googlewebfont") {
          $allWebFonts = bfi_get_googlefonts();
          if (preg_match('/^([adObis]:|N;)/', bfi_get_option('style_googlefont'))) {
              $currFont = unserialize(bfi_get_option('style_googlefont'));
          } else {
              $currFont = $allWebFonts[bfi_get_option('style_googlefont')];
          }
          
          // change headings as well as all Cufonized elements found in footer.haml
          echo "<style>
          h1, h2, h3, h4, h5, h6,
          .dropcaps,
          .date_cont,
          .bfi_pricingtable > div > .subtitle, .bfi_pricingtable > div > a,
          #menu-top a,
          #main-menu > ul > li > a,
          .titlebox .button {
              ".$currFont['css']."
          }
          #main-menu > ul > li > a, #main-menu > ul > li > a:visited {
              font-size: 14px !important;
          }
          #top-menu a, #top-menu a:visited {
              font-size: 15px !important;
          }
          </style>";
      } else if (bfi_get_option('heading_font_type') == "disabled") {    
          echo "<style>
          h1, h2, h3, h4, h5, h6,
          .dropcaps,
          .date_cont,
          .bfi_pricingtable > div > .subtitle, .bfi_pricingtable > div > a,
          #menu-top a,
          #main-menu > ul > li > a,
          .titlebox .button {
              font-family: Helvetica, Arial, serif !important;
          }
          #main-menu > ul > li > a, #main-menu > ul > li > a:visited {
              font-size: 12px !important;
          }
          #top-menu a, #top-menu a:visited {
              font-size: 13px !important;
          }
          </style>";
      }
  ?>
<?php

/**
 * WP head stuff
 */
wp_head();


/**
 * END OF HEAD
 */    
?>
</head>
<?php 
    global $pagemedia;
    global $post;
    $pagmediaClass = '';
    if ($pagemedia) {
        $pagemediaClass = 'pagemedia-'.$pagemedia->slug;
    } else {
        $pagemediaClass = 'no-pagemedia';
    }
    if (is_home()) {
        if ('page' == get_option('show_on_front')) {
            $sidebarLocation = bfi_get_post_meta(get_option('page_on_front'), 'sidebar_location');
        } else if (bfi_get_option(BFI_FRONTPAGEOPTION)) {
            $sidebarLocation = bfi_get_post_meta(bfi_get_option(BFI_FRONTPAGEOPTION), 'sidebar_location');
        }
    } elseif (is_archive() || is_search()) {
        $sidebarLocation = "right";
    } else if ($post != null && $post->post_type == 'post') {
        $sidebarLocation = bfi_get_option('sidebar_post_location');
    } else if ($post != null && $post->post_type == BFIPortfolioModel::POST_TYPE) {
        $sidebarLocation = bfi_get_option('portfolio_sidebar_global_location');
    } else if (get_post()) {
        $sidebarLocation = bfi_get_post_meta(get_the_ID(), 'sidebar_location');
    } else {
        $sidebarLocation = "none";
    }
    $bodySidebarClass = $sidebarLocation != "none" && $sidebarLocation ? "has-sidebar-$sidebarLocation" : '';
    $topMenuClass = has_nav_menu('top_menu') ? '' : 'no-topmenu';
?>
<?php 
    if (BFI_LIVEPREVIEWMODE) {
        get_template_part('header', 'livepreview-header');
    }
?>
<body <?php body_class(array($pagemediaClass, $bodySidebarClass, $topMenuClass)); ?>>
<?php 
    if (BFI_LIVEPREVIEWMODE) {
        get_template_part('header', 'livepreview');
    }
?>
<?php 
    $logo = bfi_get_option('logo_url');
    $logo = $logo ? $logo : BFI_IMAGEURL.'logo.png';
?>
<div class='container main'>
<header class='container'>
  <?php echo do_shortcode('[language_switcher]') ?>
  <div class='navbar container'>
    <div class='sixteen columns'>
      <a class="logo-link" href="<?php echo home_url(); ?>/">
      <img id="logo" src="<?php echo $logo; ?>"/>
      </a>
      <?php 
          bfi_wp_nav_menu( array('theme_location' => 'primary_menu', 'container_id' => 'main-menu', 'container_class' => 'pre-hidden'));
      ?>
      <div class='clearfix'></div>
    </div>
  </div>
  <?php 
      get_template_part('header', 'content');
  ?>
</header>
