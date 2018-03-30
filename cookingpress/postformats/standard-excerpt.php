  <!-- Post -->
  <?php $format = get_post_format();
  if( false === $format )  $format = 'standard'; ?>
  <article class="post row" id="post-<?php the_ID(); ?>" >
    <?php if(has_post_thumbnail()) { ?>
    <div class="col-md-5"><?php the_post_thumbnail();  ?></div>
      <section class="col-md-7 post-content">
    <?php } else { ?>
      <section class="col-md-12 post-content">
    <?php } ?>
      <header class="meta">
        <?php printf( '<a href="%1$s" class="published-time" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',get_permalink(),esc_attr( get_the_time() ),get_the_date()); ?>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'cookingpress'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      </header>
      <?php the_excerpt(); ?>
      </section>

      <footer>
        <?php  cookingpress_posted_on(); ?>
      </footer>
    </article>




