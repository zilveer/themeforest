<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>


  <h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>">
    <?php the_title(); ?>
    </a></h2>
    
   <?php get_template_part( 'content', 'meta' ); ?>

   
   <?php if(has_post_thumbnail()) { ?>
  <div class="entry-thumb"> 
  <a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail( 'post' ); ?>
    </a>
    </div>
  <?php } ?>

  <div class="entry-content">
    <?php the_excerpt(); ?>
  </div>
  
  <?php get_template_part( 'content', 'readmore' ); ?>
  

</article>