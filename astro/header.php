<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
  <?php
    $count = wp_count_posts('post'); 
    if ($count->publish > 0) 
    {
      echo "\n\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"". get_bloginfo('name') ." Feed\" href=\"". home_url() ."/feed/\">\n";
    } 
  global $prk_astro_options;
  global $retina_device;
  global $prk_translations;
  prk_astro_header();
  if ($prk_astro_options['prk_responsive']=="1") {
    echo '<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />';
  }
  if (!isset($prk_astro_options['logo_bar_position']) || $prk_astro_options['logo_bar_position']=="")
  {
    $prk_astro_options['logo_bar_position']='astro_nav_left';
  }
  //OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
  if (INJECT_STYLE)
  {
      include(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');  
  }
  if (isset($prk_astro_options['always_menu']) && $prk_astro_options['always_menu']=="1") 
  {
    $body_extra="always_menu";
  }
  else
  {
    $body_extra="";
  }
  ?>
    <link rel="shortcut icon" href="<?php echo $prk_astro_options['favicon']['url']; ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('astro_theme '.$prk_astro_options['logo_bar_position'].' '.$body_extra); ?>>
  <?php
      global $prk_back_css;
      echo $prk_back_css;
    ?>
    <div class="prk_meta">
        <div class="prk_page_ttl"><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></div>
        <div id="prk_body_classes" <?php body_class('astro_theme '.$prk_astro_options['logo_bar_position'].' '.$body_extra); ?>></div>
    </div>
    <div id="dump"></div>
    <div id="prk_pint" data-media="" data-desc=""></div>
    <div id="prk_mega_wrap" class="ultra_wrapper">
    <div id="wrap" class="container columns extra_pad boxed_lay centered" role="document">
      <?php if ($prk_astro_options['show_on_hover']=="1") { echo '<div id="menu_hover_trigger"></div>'; } ?>
      <div id="prk_responsive_menu">
        <div id="prk_menu_els">
            <?php
              if ($prk_astro_options['menu_image']['url']!="")
              {
                echo '<div id="nav-collapsed-icon" class="prk_with_image">';
                echo '<div class="prk_menu_image">';
                echo '<img src="'.$prk_astro_options['menu_image']['url'] .'" alt="" />';
                echo '</div></div>';
              }
              else
              {
                echo '<div id="nav-collapsed-icon">';
                echo '<div class="prk_menu_block prk_bl1"></div>';
                echo '<div class="prk_menu_block prk_bl2"></div>';
                echo '<div class="prk_menu_block prk_bl3"></div>';
                echo '<div class="prk_menu_block prk_bl4"></div>';
                echo '</div>';
              }
            ?>
          <a href="<?php if (isset($prk_astro_options['custom_home']) && $prk_astro_options['custom_home']!="") {echo $prk_astro_options['custom_home'];}else {echo home_url('/');} ?>" class="fade_anchor">
          <div id="responsive_logo_holder">
            <?php
              echo prk_output_small_logo($retina_device);
            ?>
          </div>
          </a>
          <a href="<?php if (isset($prk_astro_options['custom_home']) && $prk_astro_options['custom_home']!="") {echo $prk_astro_options['custom_home'];}else {echo home_url('/');} ?>" class="fade_anchor_menu">
            <div id="alt_logo_holder">
              <?php
                echo prk_output_alt_logo($retina_device);
              ?>
            </div>
          </a>
          <div id="copy">
            <div id="back_to_top-collapsed">
            <div class="navicon-arrow-up-2"></div>
          </div>
            <div id="prk_fullscreen_wrapper" class="hide_later">
              <div class="navicon-expand-2"></div>
              <div class="navicon-contract-2"></div>
            </div>
            <div class="hide_later">
              <?php echo $prk_astro_options['footer_text']; ?>
            </div>
          </div>
        </div>
      </div>
      <div id="body_hider" class="hider_flag"></div>
  <div id="st-container" class="no-csstransforms3d" data-width="<?php echo $prk_astro_options['menu_width']; ?>">
    <div class="st-pusher">
      <div id="menu_section" data-close="<?php echo esc_attr($prk_translations['menu_back_text']); ?>">
        <div class="opened_menu twelve"> 
            <nav id="nav-main" class="nav-collapse collapse" role="navigation">
                <div class="nav-wrap">
                      <?php 
                          if ( has_nav_menu( 'prk_main_navigation' ) ) 
                          {
                            wp_nav_menu(array('theme_location' => 'prk_main_navigation', 'menu_class' => 'sf-menu sf-vertical','link_after' => '','walker' => new rc_scm_walker)); 
                          }
                      ?>
               </div>
            </nav>
            <div class="clearfix"></div>
        </div>
        <div id="height_helper"></div>
          <div id="astro_footer" class="footer">
            <footer id="content-info" role="contentinfo">
                <div id="footer_bk">
                  <?php 
                    if ($prk_astro_options['bottom_sidebar']=="1")
                    {
                        ?>
                          <div id="footer_in">
                              <?php
                                  if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-footer')) : 
                                  endif;
                              ?>
                              <div class="clearfix"></div>
                          </div>
                        <?php
                    }
                  ?>
                </div>
            </footer>
        </div>
  </div>
</div>
</div>
<?php
  if ($prk_astro_options['auto_panel_portfolio']=="1")
  {
      $open_class="auto_open";
  }
  else
  {
      $open_class="";
  }
  if ($prk_astro_options['logo_bar_width']=="")
  {
      $offset="30";
  }
  else
  {
      $offset=intval($prk_astro_options['logo_bar_width'])/2-22;
  }
  if ($prk_astro_options['logo_bar_position']=="astro_nav_right")
  {
    $offset+=14;
  }
?>
<div id="left_bar_wrapper" class="<?php echo $open_class; ?>" data-offset_tip="<?php echo $offset;?>">
    <div class="fifty_button left_floated">
        <div id="astro_close" class="left_bar_colored">
          <div class="navicon-arrow-up-left"></div>
        </div>
    </div>
    <div id="astro_left_wrp" class="fifty_button left_floated fade_anchor">
        <div id="astro_left" class="left_floated left_bar_colored">
          <div class="mover">
            <div id="prk_left_1" class="left_floated navicon-backward-2"></div>
          </div>
        </div>
    </div>
    <div id="astro_right_wrp" class="fifty_button left_floated fade_anchor">
        <div id="astro_right" class="left_floated left_bar_colored">
          <div class="mover">
            <div id="prk_right_1" class="left_floated navicon-forward-2"></div>
          </div>
        </div>
    </div>
    <div class="fifty_button left_floated">
      <div id="prj_naver_info" class="left_bar_colored" data-pir_title="<?php echo esc_attr($prk_translations['prj_info_text']); ?>" data-pir_close="<?php echo esc_attr($prk_translations['prj_close_info_text']); ?>">
        <div class="navicon-info-2"></div>
      </div>
    </div>
    <div id="prj_ttl" class="header_font prk_uppercased">
    </div>
    <div id="prk_lower_nav" data-pir_title="<?php echo esc_attr($prk_translations['of_text']); ?>">
      <div id="prj_naver_wrap">
        <div class="fifty_button left_floated fade_anchor">
          <div id="prj_naver_right" class="left_floated left_bar_colored" data-pir_title="<?php echo esc_attr($prk_translations['next_text']); ?>">
              <div class="left_floated navicon-forward-2"></div>
          </div>
        </div>
        <div id="prj_naver_left_wp" class="fifty_button left_floated fade_anchor">
          <div id="prj_naver_left" class="left_floated left_bar_colored" data-pir_title="<?php echo esc_attr($prk_translations['previous_text']); ?>">
              <div class="left_floated navicon-backward-2"></div>
          </div>
        </div>
      </div>
      <div id="prj_naver">
      </div>
  </div>
</div>
<div id="prk_ajax_container" data-ajax_path="<?php echo get_template_directory_uri() ?>/inc/ajax-handler.php" data-retina="<?php echo $retina_device; ?>">
