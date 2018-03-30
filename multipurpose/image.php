<?php get_header(); ?>
<section class="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article class="page">
		<h1><?php the_title(); ?> <?php edit_post_link(esc_attr__('Edit this entry', 'multipurpose'), '', ''); ?></h1>
		<p><?php printf( esc_attr__( '<a href="%1$s">%2$s</a>', 'multipurpose' ), get_permalink( $post->post_parent ), get_the_title( $post->post_parent ));?></p>
		<p><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
		<?php if ( !empty($post->post_excerpt) ) the_excerpt(); ?>
		<?php wp_link_pages(array('before' => '<p><strong>'.esc_attr__('Pages', 'multipurpose').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<p class="pagination">
			<span class="alignleft"><?php previous_image_link() ?></span>
			<span class="alignright"><?php next_image_link() ?></span>
		</p>
	</article>

	<?php comments_template(); ?>
	
	<?php endwhile; endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
