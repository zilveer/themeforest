<?php
/**
* The template for displaying Search Results pages.
*
*/
?>

<?php 
// get the id of the posts page
$st_index_id = get_option('page_for_posts');
$st_page_sidebar_pos = get_post_meta( $st_index_id, '_st_page_sidebar', true );
?>

<?php if(!empty($_GET['ajax']) ? $_GET['ajax'] : null) { // Is Live Search ?>

<?php if ( have_posts() ) { ?>

<ul id="search-result">
	<?php while (have_posts()) : the_post(); ?>
    
		<li class="sr-<?php echo get_post_type( $post->ID ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        
	<?php endwhile; ?>
</ul>

<?php } else { ?>

<ul id="search-result">
  <li class="nothing-here"><?php _e( "Sorry, no posts were found.", "framework" ); ?></li>
</ul>

<?php } ?>

<?php } else { // Is Normal Search ?>

<?php get_header(); ?>

<?php get_template_part( 'page-header' ); ?>

<!-- #primary -->
<div id="primary" class="sidebar-<?php echo $st_page_sidebar_pos; ?> clearfix"> 
<div class="ht-container">
<!-- #content -->
  <section id="content" role="main">
  

<?php if ( have_posts() ) { ?>

	<?php /* Start the Loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

	<?php 	get_template_part( 'content', get_post_format() ); ?>
         			
	<?php endwhile;  ?>

	<?php st_content_nav( 'nav-below' );?>

<?php } else { ?>

	<?php get_template_part( 'content', 'none' ); ?>

<?php } ?>
    
</section>
<!-- /#content -->

<?php if ($st_page_sidebar_pos != 'off') {
  get_sidebar();
  } ?>

</div>
</div>
<!-- /#primary -->

<?php get_footer(); ?>

<?php } ?>