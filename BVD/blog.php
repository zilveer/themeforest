<?php
/*
	Template Name: Blog
*/

get_header();

?>

<div id="main_content">
  <div class="center1 padding" id="top_light4">
    <div class="center_box">
      <?php get_sidebar(); ?>
      <div class="center_right">
        <!-- to exclude a category add the cat=-page id - the example below it is excluding category 10 -->
        <?php $recent = new WP_Query('cat=-'.get_theme_mod('featured_portfolio').'&showposts='); while($recent->have_posts()) : $recent->the_post();?>
        <div id="post-<?php the_ID(); ?>">
          <h2 class="blog"><a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
            </a></h2>
          <div class="publish">published on
            <?php the_time('d.m.Y'); ?>
            in
            <?php the_category(', '); ?>
            Tagged
            <?php the_tags('') ?>
          </div>
          <div class="blog_p">
            <?php the_excerpt(); ?>
          </div>
        </div>
        <div class="blog_line"></div>
        <?php endwhile; ?>
      </div>
      <!-- end center_right-->
    </div>
    <!-- end center_box-->
  </div>
  <!--end center 1 -->
</div>
<!-- end main content-->
<?php get_footer(); ?>
