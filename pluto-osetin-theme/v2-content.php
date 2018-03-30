<div class="item-isotope">
  <article id="post-<?php the_ID(); ?>" <?php post_class('pluto-post-box'); ?>>
    <div class="post-body">
      <?php osetin_top_social_share_index(); ?>
      <?php osetin_get_media_content(); ?>

      <?php if(os_is_post_element_active('title') || os_is_post_element_active('category') || os_is_post_element_active('excerpt')){ ?>
        <div class="post-content-body">
          <?php if(os_is_post_element_active('title')): ?>
            <h4 class="post-title entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
          <?php endif; ?>
          <?php if(os_is_post_element_active('excerpt')): ?>
            <div class="post-content entry-summary"><?php echo os_excerpt(12, false); ?></div>
          <?php endif; ?>
        </div>
      <?php } ?>
    </div>
  </article>
</div>