<!DOCTYPE html>
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
  <title><?php wp_title('|', true, 'right'); ?></title>

  <!-- Meta Tags -->
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <?php stag_meta_head(); ?>

  <!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.1/html5shiv.js"></script>
  <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <![endif]-->

  <?php stag_head(); ?>
  <?php wp_head(); ?>
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

  <?php stag_body_start(); ?>

  <?php stag_header_before(); ?>

  <!-- BEGIN .header -->
  <header class="header" role="banner">

    <?php stag_header_start(); ?>

      <div class="header-inner clearfix">

        <!-- BEGIN #logo -->
        <div id="logo">
          <?php
          if( stag_get_option('general_text_logo') == 'on' ){ ?>
              <h1><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
          <?php } elseif( stag_get_option('general_custom_logo') ) { ?>
            <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo stag_get_option('general_custom_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
          <?php } else{ ?>
            <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
          <?php }
          ?>
          <!-- END #logo -->
        </div>

        <!-- BEGIN #navigation -->
        <nav id="navigation" role="navigation" class="clearfix">

          <?php
            if(has_nav_menu('primary-menu')){
              wp_nav_menu(array(
                'theme_location'  => 'primary-menu',
                'container'       => '',
                'items_wrap'      => '<ul id="primary-menu" class="%2$s">%3$s</ul>'
                ));
            }
          ?>

          <!-- END #navigation -->
        </nav>

      </div>

    <?php stag_header_end(); ?>

    <!-- END .header -->
  </header>

  <?php stag_header_after(); ?>

  <?php get_template_part('helpers/helper', 'background'); ?>

  <!-- BEGIN .container -->
  <div class="container">
    <?php stag_content_start(); ?>
