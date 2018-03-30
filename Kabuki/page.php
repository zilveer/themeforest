<?php /* Template name: Page: right sidebar */ ?> 

<?php get_header(); ?>

<div id="content">
	<div id="page-wrapper">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
			<article>
				<h1><?php the_title(); ?></h1>
				<div class="clearleft"></div>
				<?php if ( has_post_thumbnail() ) { /* loads the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>'; } ?>
				<div class="post-edit"><?php edit_post_link(); ?></div>
				<div class="post-content page-content">
					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
				<div class="clearboth"></div></div><!--.post-content .page-content -->
			</article>
			</div><!--#post-# .post-->
	<?php endwhile; ?>
</div><!--#page-wrapper-->
</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>