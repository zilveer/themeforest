<?php get_header(); ?>

  <!--BEGIN #content-wrap-->
  <div id="content-wrap" class="masonry-On"> 
    <!--BEGIN #content-->
    <section id="content">
    <div id="masonry-wrap">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/post-blog'); ?>
      <?php endwhile; else: ?>

      <!--noresults-->
      <?php get_template_part('templates/post-noresults'); ?>
      <!--/noresults-->
      <?php endif; ?>
       </div>

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-new"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer Posts', 'framework' ) ); ?></div>
                    <div class="nav-old"><?php next_posts_link( __( ' Older Posts <span class="meta-nav">&rarr;</span>', 'framework' ) ); ?></div>
                    <div class="clear"></div>
				</div><!-- #nav-below -->
<?php endif; ?>
    </section>
    <!--END #content-wrap--> 
    <div class="clear"></div>
  </div>
  <!--END #page--> 
<?php get_footer(); ?>
