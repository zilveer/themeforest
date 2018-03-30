<?php
/*
* Template Name: Page Login
*/
?>

<?php add_filter( 'body_class', 'specific_body_class_registration' ); ?>

<?php get_header(); ?>

<?php get_template_part( 'header-panel' ); ?>

<!-- Content -->
<div class="content with-sb buddypress clearfix">

  <!-- Main -->
  <main class="main col-xs-12 col-sm-12 col-md-12 col-lg-8 col-bg-8" role="main">

    <section class="section">

    <header id="masthead" class="site-header" role="banner">
      <div class="site-branding">
        <h1 class="site-title clearfix"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo get_bloginfo( 'description', 'display' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
      </div>
    </header>

    <div id="buddypress">
      <div class="standard-form">
        <p class="text-center">
          <?php esc_html_e( 'Great to have you back!', 'monarch' ); ?>
        </p>
        <?php do_action( 'bp_before_account_details_fields' ); ?>
        <?php wp_login_form(); ?>
        <div class="clearfix"></div>
      </div>
      <br>
        <p class="text-center">
          <?php login_footer_links(); ?>
        </p>
    </div>

    </section>

  </main>

</div>

<?php get_footer(); ?>