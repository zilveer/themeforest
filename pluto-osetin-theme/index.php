<?php
/**
 * The main template file.
 *
 * @package Pluto
 */
?>
<?php get_header(); ?>
<div class="main-content-w">

  <?php os_the_primary_sidebar(true); ?>

  <div class="main-content-i">
    <?php require_once(get_template_directory() . '/inc/set-layout-vars.php') ?>
    <?php require_once(get_template_directory() . '/inc/partials/featured-slider.php') ?>
    <div class="content side-padded-content">
      <?php require_once(get_template_directory() . '/inc/partials/top-ad-sidebar.php') ?>
        <div class="index-isotope <?php echo $isotope_class; ?>" data-layout-mode="<?php echo $layout_mode; ?>">
        <?php $os_current_box_counter = 1; $os_ad_block_counter = 0; ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( $template_part, get_post_format() ); ?>
          <?php os_ad_between_posts(); ?>
        <?php endwhile; endif; ?>
      </div>
      <?php require_once(get_template_directory() . '/inc/isotope-navigation.php') ?>
    </div>


    <?php os_footer(); ?>
  </div>
</div>
<?php get_footer(); ?>