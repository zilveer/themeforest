<!-- Post -->
<?php $format = get_post_format();
if( false === $format ) { $format = 'standard'; } ?>

<article  <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" >

  <?php if (has_post_thumbnail()) { ?>
  <div class="post-thumbnail">
    <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'cookingpress'), the_title_attribute('echo=0')); ?>" rel="bookmark">
      <?php the_post_thumbnail(); ?>
    </a>
  </div>
  <?php } ?>
  <?php printf( '<a href="%1$s" class="published-time" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',get_permalink(),esc_attr( get_the_time() ),get_the_date()); ?>
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'cookingpress'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

  <?php if (!has_post_thumbnail()) { ?>
  <div class="entry-content">
    <?php
    echo get_the_excerpt();
    ?>
  </div><!-- .entry-content -->
  <?php } ?>
  <footer>
    <?php  cookingpress_posted_on(); ?>
  </footer>
</article>





