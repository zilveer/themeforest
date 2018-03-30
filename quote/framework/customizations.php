<?php

function distinctivethemes_quote_customize_css() {
  $overlaybg = dt_hex2rgb(get_option('overlay_colour'));
  $overlayopacitymain = get_theme_mod('overlay_opacity');
  $customcss = get_theme_mod('custom_css');
  $menupos = get_theme_mod('menu_default_position');
  $menustyle = get_theme_mod('menu_style');
	?>

  <style type="text/css">
  .container { 
    max-width <?php echo get_option('body_width'); ?>px;
  }
  .btn-outlined.btn-primary {
    border: 2px solid <?php echo get_option('accent_colour'); ?>;
    color: <?php echo get_option('accent_colour'); ?>;
  }
  .btn-outlined.btn-primary:active, .btn-outlined.btn-primary.active {
    background: <?php echo get_option('accent_colour'); ?>;
  }

  .btn-outlined.btn-primary:hover, .btn-outlined.btn-primary:active, .aq_block_tabs ul.aq-nav li.ui-tabs-active {
    background: <?php echo get_option('accent_colour'); ?>;
  }
  #footer a:hover, #footer-wrapper a:hover, a:hover, a {
    color: <?php echo get_option('accent_colour'); ?>;
  }
  .overlay {
    background: rgba(<?php echo $overlaybg['red']; ?>,<?php echo $overlaybg['green']; ?>,<?php echo $overlaybg['blue']; ?>,0.<?php echo $overlayopacitymain; ?>) !important;
  }
  .portfolio-item:hover h5,.team-member:hover .team-content,.post:hover .content {
      border-bottom: 4px solid <?php echo get_option('accent_colour'); ?>;
  }
  .logo-img, .navbar-brand>img {
    margin-top: <?php echo get_theme_mod('logo_margin'); ?>;
  }
  .divider-wrapper {
    background: <?php echo get_option('divider_bg'); ?>;
  }
  <?php if ($menustyle == 'top') { ?>
    body {
      margin-left: 0;
    }
  <?php } ?>
  <?php echo $customcss; ?>
  </style>
  <?php if ($menupos == 'open' && $menustyle == 'side') { ?>
  <script type="text/javascript">
  jQuery(document).ready(function($){
    var $window = $(window);

      function checkWidth() {
          var windowsize = $window.width();
          if (windowsize > 1024) {
              jQuery('#theMenu').addClass('menu-open');
              jQuery('body').addClass('body-push-toright');
              jQuery('.menu-close').removeClass('fa-bars');
              jQuery('.menu-close').addClass('fa-times');
          }
          else if (windowsize < 1023) {
              jQuery('#theMenu').removeClass('menu-open');
              jQuery('body').removeClass('body-push-toright');
              jQuery('.menu-close').addClass('fa-bars');
              jQuery('.menu-close').removeClass('fa-times');
          }
      }
    // Execute on load
    checkWidth();
    // Bind event listener
    $(window).resize(checkWidth);
  });
  </script>
  <?php } ?>
  <?php if ($menustyle == 'top') {
  add_filter( 'body_class', 'topnav' );
  function topnav( $classes ) {
  $classes[] = 'topnav-active';
  return $classes;
  } ?>
  <script type="text/javascript">
  jQuery(document).ready(function($){
    var headerHeight = jQuery(".navbar-fixed-top").height();
    var headerOuterHeight = jQuery(".navbar-fixed-top").outerHeight();
    jQuery('#search-wrapper, .close-trigger').css( "padding-top", headerHeight / 2 );
    jQuery('#search-wrapper, .close-trigger').css( "padding-bottom", headerHeight / 2 );
    jQuery('.close-trigger').css( "top", "0");
    jQuery('#headerwrap').css('margin-top', '0');
  });
  /*-----------------------------------------------------------------------------------*/
  /*  FANCY NAV
  /*-----------------------------------------------------------------------------------*/
  jQuery(window).scroll(function($) {
  'use strict';
      var scroll_pos = 0;
      jQuery(document).scroll(function() { 
          var windowsHeight = jQuery('#headerwrap').outerHeight();
          scroll_pos = jQuery(this).scrollTop();
          if(scroll_pos > windowsHeight) {              
              jQuery('.navbar-fixed-top').removeClass('opaqued');
          } else {
              jQuery('.navbar-fixed-top').addClass('opaqued');
          }
      });
  });

  jQuery(document).ready(function($){
  'use strict';
    var scroll_pos = 0;
    var windowsHeight = jQuery('#headerwrap').outerHeight();
    scroll_pos = jQuery(this).scrollTop();
    if(scroll_pos > windowsHeight) {              
        jQuery('.navbar-fixed-top').removeClass('opaqued');
    } else {
        jQuery('.navbar-fixed-top').addClass('opaqued');
    }
  });
  </script>
  <?php } ?>

    <?php

}

add_action( 'wp_head', 'distinctivethemes_quote_customize_css');

?>