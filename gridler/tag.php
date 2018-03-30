<?php get_header(); ?>

<!--BEGIN #content-wrap-->

<div id="content-wrap" class="tag-archive sidebar-Off masonry-On"> 
  <!--BEGIN #content-->
  <section id="content">
    <div id="masonry-wrap">
      <article class="post masonry_item">
        <?php if ( function_exists('wp_tag_cloud') ) : ?>
          <h2 class="entry-title cat">
            <?php _e('Blog Tags', 'framework'); ?>
          </h2>
          <ul>
            <?php wp_tag_cloud('smallest=8&largest=22'); ?>
          </ul>
        <?php endif; ?>
      </article>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/post-blog'); ?>
      <?php endwhile; else: ?>
      <!--noesults-->
      <?php get_template_part('templates/post-noresults'); ?>
      <!--/noesults-->
      <?php endif; ?>
    </div>
    <?php if (  $wp_query->max_num_pages > 1 ) : ?>
    <div id="nav-below" class="navigation">
      <div class="nav-new">
        <?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer Posts', 'framework' ) ); ?>
      </div>
      <div class="nav-old">
        <?php next_posts_link( __( ' Older Posts <span class="meta-nav">&rarr;</span>', 'framework' ) ); ?>
      </div>
      <div class="clear"></div>
    </div>
    <!-- #nav-below -->
    <?php endif; ?>
  </section>
  <!--END #content-wrap-->
  <div class="clear"></div>
</div>
<?php get_footer(); ?>
