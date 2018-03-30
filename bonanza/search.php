<?php get_header(); ?>
<?php
$cat_title = __('Search results ','Bonanza');
$cat_desc = get_search_query();
?>
<div id="index-page">
    <div id="left">
		<?php if($cat_title <> '') { ?><h1 class="title"><?php echo $cat_title;  ?></h1><?php } ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_type()  ); ?>

			<?php endwhile; ?>

			<?php get_template_part( 'navigation', 'index' ); ?>
				 
		<?php  else : ?>
	
			<?php get_template_part( 'no-results', 'index' ); ?>
	
		<?php endif; ?>

	</div><!-- #left -->
	<?php get_sidebar(); ?>
</div><!-- #index-page -->
<?php get_footer(); ?>