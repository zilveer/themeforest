<!-- Post -->
<?php $format = get_post_format();
if( false === $format ) { $format = 'standard'; } ?>

 <article class="post row quotepost" id="post-<?php the_ID(); ?>" >


  <?php if (!has_post_thumbnail()) { ?>
  <div class="">
    <blockquote>
    <?php
    echo get_the_excerpt();
    ?>
    </blockquote>
  </div><!-- .entry-content -->
  <?php } ?>
  <footer>
    <?php  cookingpress_posted_on(); ?>
  </footer>
</article>





