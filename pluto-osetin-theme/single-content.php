<article id="post-<?php the_ID(); ?>" <?php post_class('pluto-page-box'); ?>>
  <div class="post-body">
    <div class="single-post-top-features">
      <?php osetin_single_top_social_share(); ?>
      <?php if(is_single()): ?>
        <?php if(get_field('disable_reading_mode', 'option') != TRUE): ?>
        <a href="#" class="single-post-top-qr">
          <i class="fa os-icon-qrcode"></i>
          <span class="caption"><?php _e('Read on Mobile', 'pluto'); ?></span>
        </a>
        <a href="#" class="single-post-top-reading-mode hidden-xs" data-message-on="<?php _e('Enter Reading Mode', 'pluto'); ?>" data-message-off="<?php _e('Exit Reading Mode', 'pluto'); ?>">
          <i class="fa os-icon-eye"></i>
          <span><?php _e('Enter Reading Mode', 'pluto'); ?></span>
        </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <h1 class="post-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <?php edit_post_link( __( 'Edit', 'twentyfourteen' ), '<div class="edit-link">', '</div>' ); ?>
    <div class="post-meta-top entry-meta">
      <div class="row">


        <?php if(is_rtl()): ?>

          <div class="col-md-6">
            <?php echo get_the_category_list(); ?>
            <?php the_tags('<ul class="post-tags"><li>','</li><li>','</li></ul>'); ?>
          </div>
          <div class="col-md-6">
            <div class="post-date"><?php _e('Posted on', 'pluto'); ?> <time class="entry-date updated" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date('M jS, Y'); ?></time></div>
            <div class="post-author"><strong class="author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )) ; ?>" class="url fn n" rel="author"><?php echo get_the_author(); ?></a></strong> <?php _e('by', 'pluto'); ?></div>
          </div>

        <?php else: ?>

          <div class="col-md-6">
            <div class="post-date"><?php _e('Posted on', 'pluto'); ?> <time class="entry-date updated" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date('M jS, Y'); ?></time></div>
            <div class="post-author"><?php _e('by', 'pluto'); ?> <strong class="author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )) ; ?>" class="url fn n" rel="author"><?php echo get_the_author(); ?></a></strong></div>
          </div>
          <div class="col-md-6">
            <?php the_tags('<ul class="post-tags"><li>','</li><li>','</li></ul>'); ?>
            <?php echo get_the_category_list(); ?>
          </div>

        <?php endif; ?>


      </div>
    </div>

    <?php if(is_single()){ ?>
      <?php if(get_field('hide_featured_image_on_single_post', 'option') != true && (get_post_format() != 'quote')){ ?>
        <?php osetin_get_media_content(false, true); ?>
      <?php } ?>
    <?php }else{ ?>
      <?php osetin_get_media_content('pluto-full-width', true); ?>
    <?php } ?>
    <div class="post-content entry-content">
      <?php if(is_attachment()): ?>
        <?php osetin_the_attached_image(); ?>
      <?php endif; ?>

      <?php if(is_single()): ?>
        <?php the_content(); ?>
      <?php else: ?>
        <?php the_excerpt(); ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="post-meta entry-meta">
    <div class="meta-like">
      <?php // if( function_exists('zilla_likes') ) zilla_likes(); ?>
      <?php os_facebook_like(); ?>
    </div>
    <div class="os_social-foot-w hidden-xs"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
  </div>

  <div class="modal fade" id="qrcode-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title"><?php _e('SCAN THIS QR CODE WITH YOUR PHONE', 'pluto') ?></h4>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <div id="qrcode"></div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="text-center">
            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php _e('Close', 'pluto'); ?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>