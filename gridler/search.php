<?php get_header(); ?>

<!--BEGIN #content-wrap-->
<div id="content-wrap" class="search masonry-On">

<!--BEGIN #content-->
  <section id="content">
  <div id="masonry-wrap">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/post-blog'); ?>
    <?php endwhile; else: ?>
    <div class="no-results">
      <h2><?php _e('No Results', 'framework'); ?></h2>
    </div>
    <!--no-results-->
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

<br class="clear"></br>
  </div>
<?php get_footer(); ?>
