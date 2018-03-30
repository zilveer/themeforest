<?php
/**
* The template for displaying Search Results pages.
*
*/
?>

<?php 
// Get position of sidebar
$st_forum_sidebar_position = of_get_option('st_forum_sidebar');
?>

<?php if(!empty($_GET['ajax']) ? $_GET['ajax'] : null) { // Is Live Search ?>

<?php if ( bbp_has_search_results() ) { ?>

<ul id="search-result">
	<?php while ( bbp_search_results() ) : bbp_the_search_result(); ?>
		<li class="sr-<?php echo get_post_type( get_the_ID() ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        
	<?php endwhile; ?>
</ul>

<?php } else { ?>

<ul id="search-result">
  <li class="nothing-here"><?php _e( "Sorry, no posts were found.", "framework" ); ?></li>
</ul>

<?php } ?>

<?php } else { // Is Normal Search ?>

<?php get_header(); ?>


<?php get_template_part( 'page-header', 'forums' ); ?>

<!-- #primary -->
<div id="primary" class="sidebar-<?php echo $st_forum_sidebar_position; ?> clearfix"> 
<div class="ht-container">
<!-- #content -->
  <section id="content" role="main">

<div id="bbpress-forums">

<?php do_action( 'bbp_template_before_search' ); ?>

	<?php if ( bbp_has_search_results() ) : ?>

		 <?php bbp_get_template_part( 'loop',       'search' ); ?>

		 <?php bbp_get_template_part( 'pagination', 'search' ); ?>

	<?php elseif ( bbp_get_search_terms() ) : ?>

		 <?php bbp_get_template_part( 'feedback',   'no-search' ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'form', 'search' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_search_results' ); ?>
    
</div>
    
</section>
<!-- /#content -->


<?php if ($st_forum_sidebar_position != 'off') {
  get_sidebar('bbpress');
  } ?>

</div>
</div>
<!-- /#primary -->

<?php get_footer(); ?>

<?php } ?>