<?php
/*
Template Name: Archives
*/
?>

<?php global $r_option; ?>

<?php get_header(); ?>

<?php 
// Include page header
if (isset($post)) include_once(THEME . '/includes/page_header.php');
?>

<section id="main-content" class="container clearfix">
   <!-- main -->
   <section id="main" class="clearfix">
      <div class="col-1-2">
         <h4><?php _e('Last 30 Posts.', SHORT_NAME); ?></h4>
         <?php
            $args = array(
               'posts_per_page' => 30,
            );
            $wp_query = new WP_Query();
            $wp_query->query($args);
         ?>
         <ol class="archives">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
            <?php endif; ?>
         </ol>
      </div>
      <div class="col-1-2 last">
         <h4><?php _e('Archives by Month.', SHORT_NAME); ?></h4>
         <ul class="archives">
            <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
         </ul>
         <h4 class="line"><?php _e('Archives by Subject.', SHORT_NAME); ?></h4>
            <ul class="archives">
            <?php wp_list_categories('optioncount=1&title_li='); ?>
         </ul>
         <h4 class="line"><?php _e('Archives by Year.', SHORT_NAME); ?></h4>
            <ul class="archives">
            <?php wp_get_archives('type=yearly&show_post_count=true'); ?>
         </ul>
      </div>
   </section>
   <!-- /main -->
   <!-- sidebar -->
   <aside class="sidebar">
   <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('archive-sidebar')) : ?>
   <?php endif; ?> 
   </aside>
</section>

<?php get_footer(); ?>