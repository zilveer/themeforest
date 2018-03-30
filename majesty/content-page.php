<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog_row">
		<?php if ( has_post_thumbnail() ) { ?>
			<figure class="blog-img">
				<?php sama_single_post_thumbnail(); ?>
			</figure>
		<?php } ?>
		<div class="entery-content">
			<?php 
				the_content();
				
				wp_link_pages( array(
					'before'      => '<div class="page-links"><strong class="page-links-title">' . esc_html__( 'Pages:', 'theme-majesty' ) . '</strong>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				));
			?>
		</div>
			
		<footer class="entry-footer">
			<?php edit_post_link( esc_html__( 'Edit', 'theme-majesty' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>
		
	</div>
</article>