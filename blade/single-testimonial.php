<?php get_header(); ?>

	<div id="grve-main-content">
		<?php
			the_post();
			$name =  blade_grve_post_meta( 'grve_testimonial_name' );
			$identity =  blade_grve_post_meta( 'grve_testimonial_identity' );
			if ( !empty( $name ) && !empty( $identity ) ) {
				$identity = ', ' . $identity;
			}
		?>
		<div class="grve-container">

			<div id="grve-post-area">
				<div class="grve-element grve-testimonial">
					<div class="grve-testimonial-element">
						<?php the_content(); ?>
						<?php if ( !empty( $name ) || !empty( $identity ) ) { ?>
						<div class="grve-testimonial-name"><?php echo esc_html( $name . $identity ); ?></div>
						<?php } ?>
					</div>
				</div>

				<?php wp_link_pages(); ?>

			</div>
		</div>
	</div>

<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
