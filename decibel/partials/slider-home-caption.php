<?php
$post_id = get_the_ID();
$post_type = get_post_type();
?>
<span class="wolf-slide-caption-container">
	<span class="wolf-slide-caption">
		<span class="wrap">
			<span data-max-font-size="48" class="fittext wolf-slide-title"><?php the_title(); ?></span>
			<span class="wolf-slide-subtitle"><?php echo sanitize_text_field( wolf_sample( wolf_excerpt( false ), 140 ) ); ?></span>
			<span class="wolf-slide-button-container">
				<a href="<?php the_permalink(); ?>" class="wolf-button border-button medium square in-site"><?php echo sanitize_text_field( wolf_more_text() ); ?></a>
			</span>
			<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
		</span><!-- .wrap -->
	</span><!-- .wolf-slide-caption -->
</span><!-- .wolf-slide-caption-container -->