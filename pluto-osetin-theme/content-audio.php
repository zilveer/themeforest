<div class="item-isotope">
<article id="post-<?php the_ID(); ?>" <?php post_class('post-color-highlight pluto-post-box'); ?>>
  <div class="post-body">
    <?php osetin_top_social_share_index(); ?>

    <?php if(get_field('audio_shortcode')){ ?>


      <div class="post-media-body">
        <?php echo do_shortcode(get_field('audio_shortcode')); ?>
      </div>

      <?php if(os_is_post_element_active('title') || os_is_post_element_active('excerpt')){ ?>
        <div class="post-content-body">
          <?php if(os_is_post_element_active('title')): ?>
            <h4 class="post-title entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
          <?php endif; ?>

          <?php if(os_is_post_element_active('excerpt')): ?>
            <div class="post-content entry-summary"><?php echo os_excerpt(18, FALSE); ?></div>
          <?php endif; ?>
        </div>
      <?php } ?>


    <?php }else{ ?>


      <?php osetin_get_media_content(); ?>
      <?php if(os_is_post_element_active('title') || os_is_post_element_active('excerpt')){ ?>
        <div class="post-content-body">
          <?php if(os_is_post_element_active('title')): ?>
            <h4 class="post-title entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
          <?php endif; ?>

          <?php if(os_is_post_element_active('excerpt')): ?>
            <div class="post-content entry-summary"><?php echo the_content(); ?></div>
          <?php endif; ?>
        </div>
      <?php } ?>



    <?php } ?>
  </div>
  <?php if(os_is_post_element_active('date') || os_is_post_element_active('author') || os_is_post_element_active('like')): ?>
    <div class="post-meta">

        <?php if(os_is_post_element_active('date')): ?>
          <div class="meta-date">
            <i class="fa os-icon-clock-o"></i>
            <time class="entry-date updated" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date('M j'); ?></time>
          </div>
        <?php endif; ?>

        <?php if(os_is_post_element_active('like') && function_exists('zilla_likes')): ?>
          <div class="meta-like">
            <?php zilla_likes(); ?>
          </div>
        <?php endif; ?>

        <?php if(os_is_post_element_active('author')): ?>
          <div class="meta-author hide">
            <?php _e('by', 'pluto') ?> <strong class="author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )) ; ?>" class="url fn n" rel="author"><?php echo get_the_author(); ?></a></strong>
          </div>
        <?php endif; ?>

    </div>
  <?php endif; ?>
</article>
</div>