<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( ! post_password_required() ) { ?>
  <div class="embed">
    <?php
      $video = get_post_meta($post->ID, '_format_video_embed', true);
      if(wp_oembed_get($video)) { echo wp_oembed_get($video); } else { echo $video;}
    ?>
  </div>
  <?php } ?>
  <section class="date">
    <span class="day"><?php echo get_the_date( 'j' ); ?></span>
    <span class="month"><?php echo get_the_date( 'M' ); ?></span>
  </section>

  <section class="post-content">

    <header class="meta">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
     <?php trizzy_posted_on(); ?>
    </header>

    <?php the_excerpt(); ?>

    <a href="<?php the_permalink(); ?>" class="button color"><?php _e('Read More','trizzy') ?></a>

  </section>

</article>




