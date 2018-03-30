<?php
/*
Template Name: Blog
*/
?>

<?php global $r_option; ?>

<?php get_header(); ?>

<?php 
   global $wp_query, $post;

   // Copy query
   $temp_post = $post;
   $query_temp = $wp_query;

   // Get data
   $page_layout = get_post_meta($wp_query->post->ID, '_page_layout', true);
   $custom_sidebar = get_post_meta($wp_query->post->ID, '_custom_sidebar', true);
   $blog_category = get_post_meta($wp_query->post->ID, '_blog_category', true);
   $page_layout = isset($page_layout) && $page_layout != '' ? $page_layout = $page_layout : $page_layout = 'sidebar_right';

   /* Pagination Limit */
   $limit = (int)get_post_meta($wp_query->post->ID, '_limit', true);
   $limit = $limit && $limit == '' ? $limit = 6 : $limit = $limit;

   // Date format
   $date_format = 'd/m/y';
   if (isset($r_option['custom_date'])) $date_format = $r_option['custom_date'];
?>
<?php 
// Include page header
if (isset($post)) include_once(THEME . '/includes/page_header.php');
?>

<section id="main-content" class="container clearfix">
   <!-- main -->
   <section <?php if ($page_layout != 'wide') echo 'id="main"'; ?> class="clearfix">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
         <?php if (get_the_content() != '') : ?>
            <article id="post-<?php the_ID(); ?>" class="entry">
               <?php the_content();?>
            </article>
         <?php endif; ?>
      <?php endwhile; ?>
      <?php endif; ?>
      <?php
      if (get_query_var('paged')) $paged = get_query_var('paged');
      elseif (get_query_var('page')) $paged = get_query_var('page');
      else $paged = 1;
      $more = 0;
      $args = array(
                 'cat' => $blog_category,
                 'showposts'=> $limit,
                 'paged' => $paged
                 );
      $wp_query = new WP_Query();
      $wp_query->query($args);
      ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
         <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
            <h2 class="entry-heading"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <?php 
               // Get short description
               $desc = get_post_meta($wp_query->post->ID, '_short_desc', true);

               // Display content
               if (isset($desc) && $desc != '') {
                  echo do_content($desc);
               } else if (has_excerpt()) {
                  the_excerpt();
               } else {
                  the_content();
               }
            ?>
            <ul class="entry-meta none">
               <li class="entry-date"><?php the_time($date_format); ?></li>
               <li class="entry-comments"><?php _e('Comments', SHORT_NAME); ?> <?php comments_number('0','1','%'); ?></li>
               <li class="entry-more"><a href="<?php the_permalink(); ?>"><?php _e('Read more', SHORT_NAME); ?></a></li>
            </ul>
         </article>
      <?php endwhile; ?>
      <?php endif; ?>
      <?php if (function_exists('wp_pagenavi')) {wp_pagenavi();} ?>
   </section>
   <!-- /main -->

   <?php if ($page_layout == 'sidebar_right') : ?>
   <!-- sidebar -->
   <aside class="sidebar">
      <?php if ($custom_sidebar == '' || $custom_sidebar == '_default') : ?>
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('default-sidebar')) ?>
      <?php else : ?>
      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($custom_sidebar)) ?> 
      <?php endif; ?>
   </aside>
   <?php endif; ?>
   
</section>

<?php
   // Get orginal query
   $post = $temp_post;
   $wp_query = $query_temp;
?>

<?php get_footer(); ?>