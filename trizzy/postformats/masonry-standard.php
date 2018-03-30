<!-- Post #1 -->
<div class="one-third column masonry-item">
  <article id="post-<?php the_ID(); ?>" <?php post_class('from-the-blog'); ?>>
    <?php if ( ! post_password_required() ) { ?>
      <?php if(has_post_thumbnail()) { ?>
      <figure class="from-the-blog-image">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();  ?></a>
        <div class="hover-icon"></div>
      </figure>
      <?php } ?>
    <?php } ?>
    <section class="from-the-blog-content">
      <?php $link = get_permalink();  ?>
      <a href="<?php echo $link; ?>"><h5><?php the_title(); ?></h5></a>
    <i>
    <?php 
    $metas = ot_get_option('pp_meta_blog',array());
    if (in_array("author", $metas)) { 
      echo __('By','trizzy'). ' <a class="author-link" itemprop="url" rel="author" href="'.get_author_posts_url(get_the_author_meta('ID' )).'">'; the_author_meta('display_name'); echo'</a>'; echo ' '; 
    }
    if (in_array("date", $metas)) {
      _e('on','trizzy');  echo ' '; echo get_the_date();
    } ?>
    </i>
      <span>
      <?php

        $excerpt = get_the_excerpt();
        $limit = ot_get_option('pp_masonry_excerpt',20);
        $short_excerpt = string_limit_words($excerpt,$limit);
        echo $short_excerpt.'..';
      ?>
      </span>
      <a href="<?php echo $link; ?>" class="button gray"><?php _e('Read More','trizzy') ?></a>
    </section>

  </article>
</div>




