<?php 
	
	// Globals
	global $dd_sn;
	global $dd_post_class;
	global $dd_thumb_size;
	global $dd_count;
	global $dd_max_count;
	global $dd_style;
	global $more; $more = 0; // Make the more tag work

	// Default - Post Class
	if ( ! isset( $dd_post_class ) ) {
		$dd_post_class = 'four columns ';
	}

	// Default - Thumb Size
	if ( ! isset( $dd_thumb_size ) ) {
		$dd_thumb_size = 'dd-one-fourth';	
	}

	// Default - Post Style
	if ( ! isset( $dd_style ) ) {
		$dd_style = 1;
	}

	// Post Class - Append - Thumbnail
	if ( has_post_thumbnail() ) {
		$dd_post_class_append = 'has-thumb ';
	} else {
		$dd_post_class_append = '';
	}

	// Post Class - Last (column)
	if ( $dd_count == $dd_max_count ) {
		$last_class = 'last';
		$dd_count = 0;
	} else {
		$last_class = '';
	}

	if ( $dd_count == 1 ) {
		$last_class = 'clear';
	}

	$sponsor_link = get_post_meta( get_the_ID(), $dd_sn . 'sponsor_link', true );


?>

<?php if ( is_single() ) : ?>
		


<?php else : ?>

	<div <?php post_class( 'sponsor ' . $dd_post_class . $dd_post_class_append . $last_class ); ?>>

		<div class="sponsor-inner">

			<div class="sponsor-thumb">
				<?php if ( $sponsor_link ) : ?>
					<a href="<?php echo $sponsor_link; ?>" target="_blank"><?php the_post_thumbnail( $dd_thumb_size ); ?></a>
				<?php else : ?>
					<?php the_post_thumbnail( $dd_thumb_size ); ?>
				<?php endif; ?>
			</div><!-- .sponsor-thumb -->

		</div><!-- .sponsor-inner -->

	</div><!-- .staff-member -->

<?php endif; ?>