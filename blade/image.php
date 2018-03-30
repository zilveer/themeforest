<?php get_header(); ?>
<div id="grve-main-content">
	<div class="grve-container">
		<div id="grve-content-area">
			<?php the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="attachment">
					<a class="grve-image grve-image-popup" href="<?php echo wp_get_attachment_url( $post->ID ); ?>"><?php echo wp_get_attachment_image( $post->ID, 'large' ); ?></a>
					<?php if ( has_excerpt() ) { ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div>
					<?php } ?>
					<div class="grve-pagination">
						<ul>
							<li><?php previous_image_link( false, '<i class="grve-icon-left"></i>') ?></li>
							<li><?php next_image_link( false, '<i class="grve-icon-right"></i>') ?></li>
						</ul>
					</div>
				</div>
			</article>
		</div>
	</div>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
