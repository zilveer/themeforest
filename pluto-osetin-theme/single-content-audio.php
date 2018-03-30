<article id="post-<?php the_ID(); ?>" <?php post_class('pluto-page-box'); ?>>
  <div class="post-body">
    <div class="single-post-top-features">

      <?php osetin_single_top_social_share(); ?>
    </div>
    <?php echo do_shortcode(get_field('audio_shortcode')); ?>

    <h1 class="post-title entry-title"><?php the_title(); ?></h1>
    <div class="post-meta-top entry-meta">
      <div class="post-date"><?php _e('Posted on', 'pluto'); ?> <time class="entry-date updated" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date('M jS, Y'); ?></time></div>
      <div class="post-author"><?php _e('by', 'pluto'); ?> <strong class="author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )) ; ?>" class="url fn n" rel="author"><?php echo get_the_author(); ?></a></strong></div>
      <?php echo get_the_category_list(); ?>
      <?php the_tags('<ul class="post-tags"><li>','</li><li>','</li></ul>'); ?>
    </div>
    <?php edit_post_link( __( 'Edit', 'twentyfourteen' ), '<div class="edit-link">', '</div>' ); ?>
    <div class="post-content entry-content">
      <?php if(get_field('audio_shortcode')): ?>
        <?php the_content(); ?>
      <?php else: ?>
        <?php osetin_get_media_content(); ?>
        <?php the_content(); ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="post-meta">
    <div class="meta-like">
      <?php // if( function_exists('zilla_likes') ) zilla_likes(); ?>
      <?php os_facebook_like(); ?>
    </div>
    <div class="os_social-foot-w"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
  </div>
</article>