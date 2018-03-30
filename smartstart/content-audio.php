<div class="entry-body">

	<div class="entry-audio">
	
	<?php

	if( ss_framework_get_custom_field( 'ss_audio_mp3', $post->ID ) || ss_framework_get_custom_field( 'ss_audio_ogg', $post->ID ) ) {

		$shortcode = '[audio';

			if( ss_framework_get_custom_field( 'ss_audio_mp3', $post->ID ) && !isset( $GLOBALS['post-carousel'] ) )
				$shortcode .= ' mp3="' . ss_framework_get_custom_field( 'ss_audio_mp3', $post->ID ) . '"';

			if( ss_framework_get_custom_field( 'ss_audio_ogg', $post->ID ) )
				$shortcode .= ' ogg="' . ss_framework_get_custom_field( 'ss_audio_ogg', $post->ID ) . '"';

		$shortcode .= ']';

		echo do_shortcode( $shortcode );

	} elseif( ss_framework_get_custom_field( 'ss_audio_external', $post->ID ) ) {

		echo do_shortcode( ss_framework_get_custom_field( 'ss_audio_external', $post->ID ) );

	}

	?>
		
	</div><!-- end .entry-audio -->

	<?php echo ss_framework_post_content(); ?>

</div><!-- end .entry-body -->

<div class="entry-meta">

	<?php echo ss_framework_post_meta(); ?>

</div><!-- end .entry-meta -->