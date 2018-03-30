<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

<div id="page" class="border-top clearfix">

	<div class="color-hr2"></div>
	
	<div id="subtitle">
		
		<h2><span><?php the_title(); ?>.</span> <?php echo get_post_meta( get_the_ID( ), 'minti_subtitle', true ); ?></h2>
	</div>
	
	<div id="content-full">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
			<div id="post-<?php the_ID(); ?>" class="post">
	
				<div class="entry">
	
					<?php the_content(); ?>
	
					<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
	
				</div>
	
				<?php edit_post_link('Edit this entry.', '<p class="hidden">', '</p>'); ?>
	
			</div>
			
			<?php comments_template(); ?>
	
		<?php endwhile; endif; ?>
	
	</div>
	
	

</div>

<?php get_footer(); ?>
