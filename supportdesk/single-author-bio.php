<?php 
if (get_the_author_meta('description') != '' && of_get_option('st_single_authorbox') == 1) { ?>
      <section id="entry-author" class="clearfix">
        <div class="gravatar">
          <?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '70' );   } ?>
        </div>
        <h4><?php the_author_posts_link() ?></h4>
        <div class="entry-author-desc">
          <?php the_author_meta('description') ?>
        </div>
      </section>
<?php }  ?>