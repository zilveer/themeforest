<!DOCTYPE html>
<html  xmlns="http<?php echo (is_ssl())? 's' : ''; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<?php
global $mk_settings, $mk_accent_color, $post, $ken_json;
 $post_id = global_get_post_id();
?>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />

        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <![endif]-->

        
        <title>
        <?php
           if ( defined('WPSEO_VERSION') ) {
            wp_title('');
             } else {
             bloginfo('name'); ?> <?php wp_title(' - ', true);
          }
        ?>
        </title>
        <?php if ( $mk_settings['favicon']['url'] ) : ?>
          <link rel="shortcut icon" href="<?php echo $mk_settings['favicon']['url']; ?>"  />
        <?php endif; ?>

        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' );?>">
        <link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?> Atom Feed" href="<?php bloginfo( 'atom_url' );?>">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' );?>">
         <!--[if lte IE 11]>
         <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/stylesheet/css/ie.css' />
         <![endif]-->

         <!--[if lte IE 9]>
         <script src="<?php echo THEME_JS;?>/html5shiv.js" type="text/javascript"></script>
         <![endif]-->

         <!--[if lte IE 8]>
            <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script>
         <![endif]-->

        <script type="text/javascript" src="http<?php echo (is_ssl())? 's' : ''; ?>://www.youtube.com/player_api"></script>
        <script type="text/javascript" src="http<?php echo (is_ssl())? 's' : ''; ?>://a.vimeocdn.com/js/froogaloop2.min.js"></script>

         <script type="text/javascript">

          // Declare theme scripts namespace
          var ken = {};
          var php = {};

          var mk_theme_dir = "<?php echo THEME_DIR_URI; ?>",
          mk_captcha_url = "<?php echo THEME_DIR_URI; ?>/captcha/captcha.php",
          mk_captcha_check_url = "<?php echo THEME_DIR_URI; ?>/captcha/captcha-check.php",
          mk_theme_js_path = "<?php echo THEME_JS;  ?>",
          mk_captcha_placeholder = "<?php echo _e('Enter Captcha', 'mk_framework') ?>",
          mk_captcha_invalid_txt = "<?php echo _e('Invalid. Try again.', 'mk_framework') ?>",
          mk_captcha_correct_txt = "<?php echo _e('Captcha correct.', 'mk_framework') ?>",
          mk_nav_res_width = <?php echo $mk_settings['res-nav-width']; ?>,
          mk_header_sticky = <?php echo $mk_settings['sticky-header']; ?>,
          mk_grid_width = <?php echo $mk_settings['grid-width']; ?>,
          mk_preloader_logo = "<?php echo $mk_settings['preloader-logo']['url']; ?>",
          mk_header_padding = <?php echo $mk_settings['header-padding']; ?>,
          mk_accent_color = "<?php echo $mk_accent_color; ?>",
          mk_squeeze_header = <?php echo isset($mk_settings['squeeze-sticky-header']) ? $mk_settings['squeeze-sticky-header'] : 1; ?>,
          mk_logo_height = <?php echo ($mk_settings['logo']['height']) ? $mk_settings['logo']['height'] : 50; ?>,
          mk_preloader_txt_color = "<?php echo ($mk_settings['preloader-txt-color']) ? $mk_settings['preloader-txt-color'] : '#444'; ?>",
          mk_preloader_bg_color = "<?php echo ($mk_settings['preloader-bg-color']) ? $mk_settings['preloader-bg-color'] : '#fff'; ?>";
          mk_preloader_bar_color = "<?php echo (isset($mk_settings['preloader-bar-color'])) && (!empty($mk_settings['preloader-bar-color'])) ? $mk_settings['preloader-bar-color'] : $mk_accent_color ; ?>",
          mk_no_more_posts = "<?php echo _e('No More Posts', 'mk_framework'); ?>";
          mk_header_structure = "<?php echo ($mk_settings['header-structure']) ?>";
          mk_boxed_header = "<?php echo ($mk_settings['boxed-header']) ?>";

          <?php if($post_id) {
                  $mk_header_trans_offset = get_post_meta($post_id, '_trans_header_offset', true ) ? get_post_meta($post_id, '_trans_header_offset', true ) : 0;
            ?> var mk_header_trans_offset = <?php echo $mk_header_trans_offset; ?>;
          <?php } ?>
         </script>

    <?php wp_head(); ?>
    </head>


<body <?php body_class(); ?> <?php echo get_schema_markup('body'); ?>>
  

<?php


  $boxed_layout = $mk_settings['body-layout'];


  $header_style = $trans_header_skin = $header_padding_class = $trans_header_skin_class = $mk_main_wrapper_class = $boxed_shadow_class = $header_class = '';

  if($mk_settings['header-structure'] == 'margin') {
    $mk_main_wrapper_class = ' add-corner-margin';  
  } else if($mk_settings['header-structure'] == 'vertical') {
    $mk_main_wrapper_class = ' vertical-header vertical-' . $mk_settings['vertical-header-state'] . '-state vertical-header-align-'.$mk_settings['vertical-header-align'];
  }
  
    
  

if($post_id) {
    $preloader = get_post_meta( $post_id, '_preloader', true );
    $boxed_layout = (get_post_meta( $post_id, '_custom_bg', true ) == 'true') ? get_post_meta( $post_id, 'background_selector_orientation', true ) : $mk_settings['body-layout'];

    $header_style = get_post_meta( $post_id, '_header_style', true );
    $trans_header_skin = get_post_meta( $post_id, '_trans_header_skin', true );
    $trans_header_skin_class = ($trans_header_skin != '') ? ($trans_header_skin.'-header-skin') : '';

          if($preloader == 'true') {
              ?><div class="mk-body-loader-overlay">
                  <div style="background-image:url(<?php echo THEME_IMAGES; ?>/empty.png)"></div>
                </div><?php
          }
    }
?>
<?php
  $custom_bg = get_post_meta( $post_id, '_custom_bg', true );
  $boxed_shadow = get_post_meta( $post_id, 'boxed_layout_shadow', true );
  if ($mk_settings['body-layout'] == 'boxed' && $mk_settings['boxed-layout-shadow'] == 'enabled'){
    if ($custom_bg == 'true' && $boxed_shadow == 'false') {
      $boxed_shadow_class = '';
    }
    else {
      $boxed_shadow_class = 'shadow-enabled';
    }
  }
?>

<div class="theme-main-wrapper <?php echo $mk_main_wrapper_class; ?>">

<?php if($mk_settings['header-structure'] == 'margin') { ?>
<div class="mk-top-corner"></div>
<div class="mk-right-corner"></div>
<div class="mk-left-corner"></div>
<div class="mk-bottom-corner"></div>
<?php } ?>
<div id="mk-boxed-layout" class="mk-<?php echo $boxed_layout; ?>-enabled <?php echo $boxed_shadow_class; ?>">

<?php

$layout_template = $post_id ? get_post_meta($post_id, '_template', true ) : '';

if($layout_template == 'no-header-title' || $layout_template == 'no-header-title-footer' || $layout_template == 'no-header-title-only-footer') return;


if($layout_template != 'no-header' && $layout_template !='no-header-footer') :


$logo_height = (!empty($mk_settings['logo']['height'])) ? $mk_settings['logo']['height'] : 50;
if(isset($mk_settings['squeeze-sticky-header'])) {
    $header_sticky_height = $logo_height/1.5 + ($mk_settings['header-padding']/2.4 * 2);
} else {
    $header_sticky_height = $logo_height + ($mk_settings['header-padding'] * 2);
}
$header_height = $logo_height + ($mk_settings['header-padding'] * 2);

// Export settings to json 
$ken_json[] = array(
  'name' => 'theme_header',
  'params' => array(
      'stickyHeight' => $header_sticky_height
    )
);


if($header_style == 'transparent') {
  $header_class .= 'transparent-header ' . $trans_header_skin_class;
} else {
  $header_padding_class .= $mk_settings['sticky-header'] ? ' sticky-header ' : '';
}
  
  $header_class .= $mk_settings['sticky-header'] ? ' sticky-header ' : '';
  


  $header_class .= ($mk_settings['boxed-header']) ? ' boxed-header' : ' full-header';
  $header_class .= ($mk_settings['header-structure'] != 'vertical') ? ($mk_settings['header-align']) ? ' header-align-'.$mk_settings['header-align'] : '' : '';
  $header_class .= ($mk_settings['header-structure']) ? ' header-structure-'.$mk_settings['header-structure'] : '';

  $header_class .= ($mk_settings['header-structure'] == 'standard') ? (' put-header-'.$mk_settings['header-location']) : '';

  $toolbar = (isset($mk_settings['header-toolbar']) && !empty($mk_settings['header-toolbar'])) ? $mk_settings['header-toolbar'] : 0;
  $toolbar_check = get_post_meta( $post_id, '_header_toolbar', true );
  $toolbar_option = !empty($toolbar_check) ? $toolbar_check : 'true';
  $is_toolbar_active = ($toolbar_option == 'true' && $toolbar != 0) ? ' toolbar-is-active ' : '';


?>


<header id="mk-header" class="<?php echo $header_class; echo $is_toolbar_active; ?> theme-main-header mk-header-module" data-header-style="<?php echo $header_style; ?>" data-header-structure="<?php echo $mk_settings['header-structure']; ?>" data-transparent-skin="<?php echo $trans_header_skin; ?>" data-height="<?php echo intval($header_height); ?>" data-sticky-height="<?php echo intval($header_sticky_height); ?>" <?php echo get_schema_markup('header'); ?>>

<?php
  if($mk_settings['header-structure'] != 'vertical') {
      if($toolbar){
        if($toolbar_option == 'true'){
          echo '<div class="mk-header-toolbar">';
          echo $mk_settings['boxed-header'] && $mk_settings['header-structure'] != 'vertical' ? '<div class="mk-grid">' : '';
          do_action('header_toolbar_contact');
          echo '<ul class="mk-header-toolbar-social">';
          if($mk_settings['header-social-select'] == 'header_toolbar') {
            do_action('header_toolbar_social');
          }
          echo '</ul>';
          do_action('header_toolbar_menu');
          echo $mk_settings['boxed-header'] && $mk_settings['header-structure'] != 'vertical' ? '</div>' : '' ;
          echo '</div>';
          echo '<div class="mk-responsive-header-toolbar"><a href="#" class="mk-toolbar-responsive-icon"><i class="mk-icon-chevron-down"></i></a></div>';
        }
      }
  }
  if($mk_settings['boxed-header'] && $mk_settings['header-structure'] != 'vertical') {
    echo '<div class="mk-grid">';
  }


      $mk_menu_location = 'primary-menu';

      if(is_user_logged_in() && !empty($mk_settings['loggedin_menu'])) {
         $mk_menu_location = $mk_settings['loggedin_menu'];
      }

      if(!empty($post_id)) {
        $mk_menu_location_meta = get_post_meta( $post_id, '_menu_location', true );
        $mk_menu_location = !empty($mk_menu_location_meta) ? $mk_menu_location_meta : $mk_menu_location;
      }

      do_action( 'vertical_navigation', $mk_menu_location );
      do_action( 'main_navigation', $mk_menu_location );


  if($mk_settings['boxed-header'] && $mk_settings['header-structure'] != 'vertical') {
    echo '</div>';
  }


    if(!empty($mk_settings['side-dashboard-icon'])){
      $dashboard_icon = $mk_settings['side-dashboard-icon'];
    }else{
      $dashboard_icon = 'mk-theme-icon-dashboard2';
    }
    if($mk_settings['header-social-select'] == 'header_section') {
      do_action('header_social', 'outside-grid');
    }
   if($mk_settings['side-dashboard'] && $mk_settings['header-structure'] != 'vertical') :
    
      echo '<div class="dashboard-trigger desktop-mode"><i class="'.$dashboard_icon.'"></i></div>';

   endif; ?>


</header>


<?php /* Resposnive navigation container. will be appended via JS */ ?>
<div class="responsive-nav-container"></div>
<?php /*******/ ?>


<?php if($mk_settings['header-location'] != 'bottom' ) : ?>
<div class="sticky-header-padding <?php echo $header_padding_class; ?>"></div>
<?php endif; ?>

<?php endif; ?>

<?php
if($post_id && $layout_template != 'no-title') {
  if($layout_template != 'no-footer-title' && $layout_template != 'no-sub-footer-title' && $layout_template != 'no-title-footer' && $layout_template != 'no-title-sub-footer' && $layout_template != 'no-title-footer-sub-footer') {
      do_action('page_title');
  }
} else {
  do_action('page_title');
}
?>

