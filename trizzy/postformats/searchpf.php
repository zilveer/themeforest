<article id="post-<?php the_ID(); ?>" <?php post_class('post search-result'); ?>>
<?php if(has_post_thumbnail()) { ?>
   <div class="columns six alpha padding-minus">
    <figure class="post-img">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();  ?>
      <div class="hover-icon"></div>
    </a>
  </figure>
  </div>
<?php } ?>
<div class="columns six omega">
  <section class="post-content no-data">

    <header class="meta">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </header>
 <p>
    <?php  $excerpt = get_the_excerpt();
    $short_excerpt = strip_shortcodes( $excerpt ); echo $short_excerpt.'..'; ?>
    </p>
    <a href="<?php the_permalink(); ?>" class="button color"><?php _e('Check this portfolio item','trizzy') ?></a>

  </section>
</div>
</article>




