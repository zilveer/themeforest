<?php
/*
* Template Name: Blog Full Width
*/
get_header(); ?>
<div class="main-content-w">
  <?php os_the_primary_sidebar(); ?>
  <div class="main-content-i">
    <?php require_once(get_template_directory() . '/inc/partials/featured-slider.php') ?>
    <div class="content side-padded-content">
      <?php require_once(get_template_directory() . '/inc/partials/top-ad-sidebar.php') ?>
      <?php
      if(get_query_var('page')){
        $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
      }else{
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
      }
      $args = array( 'paged' => $paged, 'posts_per_page' => get_option('posts_per_page'), 'post_status' => 'publish' );
      $osetin_query = new WP_Query( $args );
      while ($osetin_query->have_posts()) : $osetin_query->the_post(); ?>
          <?php get_template_part( 'single-content', get_post_format() ); ?>
      <?php endwhile; ?>

      <div class="pagination-w">
        <?php if(function_exists('wp_pagenavi')): ?>
          <?php wp_pagenavi(array( 'query' => $osetin_query )); ?>
        <?php else: ?>
          <?php posts_nav_link(); ?>
        <?php endif; ?>
      </div>

      <?php wp_reset_postdata(); ?>
    </div>
    <?php os_footer(); ?>
  </div>
</div>
<?php
get_footer();
?>