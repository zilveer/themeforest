<?php
/*
* Template Name: Masonry Condensed Hearts
*/
get_header(); ?>
<div class="main-content-w">
  <?php os_the_primary_sidebar(true); ?>
  <div class="main-content-i">
    <?php require_once(get_template_directory() . '/inc/partials/hero-image.php') ?>
    <?php require_once(get_template_directory() . '/inc/partials/featured-slider.php') ?>
    <div class="content side-padded-content">
      <?php require_once(get_template_directory() . '/inc/partials/top-ad-sidebar.php') ?>
      <div id="primary-content" class="index-isotope v3" data-layout-mode="<?php echo (os_get_use_fixed_height_index_posts() == true) ? 'fitRows' : 'masonry'; ?>">
        <?php
        require_once(get_template_directory() . '/inc/osetin-custom-index-query.php');

        $os_current_box_counter = 1; $os_ad_block_counter = 0;
        while ($osetin_query->have_posts()) : $osetin_query->the_post(); ?>
            <?php get_template_part( 'v3-content', get_post_format() ); ?>
            <?php os_ad_between_posts(); ?>
        <?php endwhile; ?>

      </div>
      <?php if(os_get_next_posts_link($osetin_query)): ?>
        <div class="isotope-next-params" data-params="<?php echo os_get_next_posts_link($osetin_query); ?>" data-layout-type="v3"></div>
        <?php if(os_get_current_navigation_type() == 'infinite_button'): ?>
        <div class="load-more-posts-button-w">
          <a href="#"><i class="os-icon-plus"></i> <span><?php _e('Load More Posts', 'pluto'); ?></span></a>
        </div>
        <?php endif; ?>
      <?php endif; ?>
      <?php
      $temp_query = $wp_query;
      $wp_query = $osetin_query; ?>

      <div class="pagination-w hide-for-isotope">
        <?php if(function_exists('wp_pagenavi') && os_get_current_navigation_type() != 'default'): ?>
          <?php wp_pagenavi(); ?>
        <?php else: ?>
          <?php posts_nav_link(); ?>
        <?php endif; ?>
      </div>
      <?php $wp_query = $temp_query; ?>
      <?php wp_reset_postdata(); ?>
    </div>
    <?php os_footer(); ?>
  </div>
</div>
<?php
get_footer();
?>