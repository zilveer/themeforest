<!-- Post #1 -->
<div class="one-third column masonry-item">
  <article id="post-<?php the_ID(); ?>" <?php post_class('from-the-blog'); ?>>
    <?php if(has_post_thumbnail()) { ?>
    <figure class="from-the-blog-image">
      <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();  ?></a>
      <div class="hover-icon"></div>
    </figure>
    <?php } ?>
    <section class="from-the-blog-content">
      <?php $link = get_permalink();  ?>
      <a href="<?php echo $link; ?>"><h5><?php the_title(); ?></h5></a>
      <span>
      <?php

        $excerpt = get_the_excerpt();
        $limit = ot_get_option('pp_masonry_excerpt',20);
        $short_excerpt = string_limit_words($excerpt,$limit);
        echo $short_excerpt.'..';
      ?>
      </span>
       <a href="<?php the_permalink(); ?>" class="button color"><?php _e('Check this portfolio item','trizzy') ?></a>
    </section>

  </article>
</div>




