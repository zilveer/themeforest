<?php

if ( ! empty( $quote ) ) {

	echo '<div class="thb-testimonial-wrapper">';

		if ( $image ) {
			thb_image( $image, 'micro' );
		}

		echo '<div class="thb-testimonial-quote">';
			echo thb_text_format( $quote, true );
		echo '</div>';

		if ( ! empty( $author ) ) {
			echo '<div class="thb-testimonial-author">';
				echo '<span>&mdash; </span>';

				if ( ! empty( $author_url ) ) {
					printf( '<a href="%s" class="thb-testimonial-author-link">', esc_url( $author_url ) );
				}

				printf( '<span class="thb-testimonial-author-name">%s</span>', thb_text_format( $author ) );

				if ( ! empty( $author_url ) ) {
					echo '</a>';
				}
			echo '</div>';
		}

	echo '</div>';
}