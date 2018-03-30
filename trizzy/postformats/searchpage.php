<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
<?php if(has_post_thumbnail()) { ?>
  <figure class="post-img">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();  ?>
      <div class="hover-icon"></div>
    </a>
  </figure>
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
    <p>
    <?php $excerpt = get_the_excerpt();
    $short_excerpt = strip_shortcodes( $excerpt ); echo $short_excerpt.'..'; ?>
    </p>
    <a href="<?php the_permalink(); ?>" class="button color"><?php _e('Read More','trizzy') ?></a>

  </section>

</article>




