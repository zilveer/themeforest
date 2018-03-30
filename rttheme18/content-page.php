<?php
/* 
* rt-theme content-page.php 
* display page content
*/ 
?>


<?php if ( have_posts() ) : ?> 

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>		
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>			
		
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>			
	<?php endwhile; ?>		

<?php else : ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>