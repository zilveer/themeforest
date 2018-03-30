<article id="post-carousel-<?php the_ID(); ?>" <?php post_class('featured-carousel-post'); ?>>
  <?php osetin_top_social_share_index(); ?>
  <?php osetin_get_media_content('pluto-carousel-post'); ?>
  <div class="post-content-body">
    <a href="<?php echo esc_url( get_permalink() ); ?>" class="post-title entry-title"><?php the_title(); ?></a>
    <?php echo get_the_category_list(); ?>
  </div>
</article>