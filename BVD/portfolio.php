<?php
/*
	Template Name: Portfolio
*/

get_header();

?>

<div id="main_content">
  <div class="center1 padding" id="top_light4">
    <div class="center_box">
      <?php get_sidebar(); ?>
      <div class="center_right portofolio">
        <h2>Portfolio</h2>
        <div class="subtitle2">We only create quality works</div>
        <div class="featured2"></div>
        <?php $recent = new WP_Query('cat='.get_theme_mod('featured_portfolio').'&showposts=1'); while($recent->have_posts()) : $recent->the_post();?>
        <div class="portofolio_main">
          <?php if( get_post_meta($post->ID, "thumb", true) ): ?>
          <div class="div_image"> <a href="<?php the_permalink() ?>" rel="bookmark"><img class="thumb" src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo get_post_meta($post->ID, "thumb", $single = true); ?>&amp;h=220&amp;w=280&amp;zc=1" alt="<?php the_title(); ?>" align="left"/></a> </div>
          <?php else: ?>
          <?php endif; ?>
          <h3>
            <?php the_title(); ?>
          </h3>
          <div class="publish">published on
            <?php the_time('d.m.Y'); ?>
            in
            <?php the_category(', '); ?> Tagged  <?php the_tags('') ?>
          </div>
          <?php the_content_limit(550,  "More"); ?>
        </div>
        <?php endwhile; ?>
        <?php $recent = new WP_Query('cat='.get_theme_mod('featured_portfolio').'&offset=-1'); while($recent->have_posts()) : $recent->the_post();?>
        <div class="blog_thumb">
          <?php if( get_post_meta($post->ID, "thumb", true) ): ?>
          <a href="<?php the_permalink() ?>" rel="bookmark"><img class="thumb" src="<?php bloginfo('template_directory'); ?>/tools/timthumb.php?src=<?php echo get_post_meta($post->ID, "thumb", $single = true); ?>&amp;h=98&amp;w=98&amp;zc=1" alt="<?php the_title(); ?>" align="left" /></a>
          <?php else: ?>
          <?php endif; ?>
          <h2>
            <?php the_title(); ?>
          </h2>
          <?php the_content_limit(350,  "More"); ?>
        </div>
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
