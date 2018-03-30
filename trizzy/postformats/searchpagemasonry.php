<div class="one-third column masonry-item">
  <article id="post-<?php the_ID(); ?>" <?php post_class('post from-the-blog'); ?>>
     <section class="from-the-blog-content">

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
</div>



