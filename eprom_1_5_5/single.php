<?php global $r_option; ?>

<?php get_header(); ?>

<?php 
   global $wp_query, $post; 
   $page_layout = get_post_meta($wp_query->post->ID, '_page_layout', true);
   $custom_sidebar = get_post_meta($wp_query->post->ID, '_custom_sidebar', true);
   $page_layout = isset($page_layout) && $page_layout != '' ? $page_layout = $page_layout : $page_layout = 'sidebar_right';
?>
<?php 
// Include page header
if (isset($post)) include_once(THEME . '/includes/page_header.php');
?>

<section id="main-content" class="container clearfix">
   <!-- main -->
   <section <?php if ($page_layout != 'wide') echo 'id="main"'; ?> class="clearfix">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
         <?php the_content();?>
         <div id="page-link"><?php wp_link_pages('page-link=%'); ?></div> 
      </article>
      <?php endwhile; ?>
      <?php if ('open' == $post->comment_status) comments_template(); ?>
      <?php endif; ?>
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

<?php get_footer(); ?>