<?php get_header(); ?>

<?php 
// get the id of the posts page
$st_index_id = get_option('page_for_posts');
$st_page_sidebar_pos = get_post_meta( $st_index_id, '_st_page_sidebar', true );
?>

<?php get_template_part( 'page-header' ); 	?>

<!-- #primary -->
<div id="primary" class="sidebar-<?php echo $st_page_sidebar_pos; ?> clearfix"> 
<div class="ht-container">
  <!-- #content -->
  <section id="content" role="main">
  
<?php if ( have_posts() ) : ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'content', get_post_format() ); ?>

<?php endwhile; ?>

<?php st_content_nav( 'nav-below' ); ?>

<?php else : ?>

<?php get_template_part( 'content', 'none' ); ?>

<?php endif; ?>
    
    
</section>
<!-- /#content -->

<?php if ($st_page_sidebar_pos != 'off') {
  get_sidebar();
  } ?>

</div>
</div>
<!-- /#primary -->

<?php get_footer(); ?>