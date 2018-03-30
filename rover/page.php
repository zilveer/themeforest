<?php
/**
 * Page
 * @package by Theme Record
 * @auther: MattMao
 */
get_header(); 
?>
<div id="main" class="right-side clearfix">

<article id="content">

<?php if (have_posts()) : the_post(); ?>

<div class="post post-single post-page-single" id="post-<?php the_ID(); ?>">

	<div class="post-format"><?php the_content(); ?></div>

	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'TR' ), 'after' => '</div>' ) ); ?>
	<?php edit_post_link( __( 'Edit', 'TR' ), '<div class="edit-link">', '</div>' ); ?>

</div>
<!--end post page-->

<?php else : ?>

<!--Begin No Post-->
<div class="no-post">
	<h2><?php _e('Not Found', 'TR'); ?></h2>
	<p><?php _e('Sorry, but you are looking for something that is not here.', 'TR'); ?></p>
</div>
<!--End No Post-->

<?php endif; ?>

</article>
<!--End Content-->

<?php theme_sidebar('page'); ?>

</div>
<!-- #main -->
<?php get_footer(); ?>

