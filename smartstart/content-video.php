<div class="entry-video">

	<?php

	if( ss_framework_get_custom_field( 'ss_video_mp4', $post->ID ) || ss_framework_get_custom_field( 'ss_video_webm', $post->ID ) || ss_framework_get_custom_field( 'ss_video_ogg', $post->ID ) ) {

		$shortcode = '[video';

			if( ss_framework_get_custom_field( 'ss_video_mp4', $post->ID ) && !isset( $GLOBALS['post-carousel'] ) )
				$shortcode .= ' mp4="' . ss_framework_get_custom_field( 'ss_video_mp4', $post->ID ) . '"';

			if( ss_framework_get_custom_field( 'ss_video_webm', $post->ID ) )
				$shortcode .= ' webm="' . ss_framework_get_custom_field( 'ss_video_webm', $post->ID ) . '"';

			if( ss_framework_get_custom_field( 'ss_video_ogg', $post->ID ) )
				$shortcode .= ' ogg="' . ss_framework_get_custom_field( 'ss_video_ogg', $post->ID ) . '"';

			if( ss_framework_get_custom_field( 'ss_video_preview', $post->ID ) )
				$shortcode .= ' poster="' . ss_framework_get_custom_field( 'ss_video_preview', $post->ID ) . '"';

			if( ss_framework_get_custom_field( 'ss_video_aspect_ratio', $post->ID ) )
				$shortcode .= ' aspect_ratio="' . ss_framework_get_custom_field( 'ss_video_aspect_ratio', $post->ID ) . '"';

		$shortcode .= ']';

		echo do_shortcode( $shortcode );

	} elseif( ss_framework_get_custom_field( 'ss_video_external', $post->ID ) ) {

		echo do_shortcode( ss_framework_get_custom_field( 'ss_video_external', $post->ID ) );

	}

	?>
	
</div><!-- end .entry-video -->

<div class="entry-body">

	<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'ss_framework'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
		<h1 class="title"><?php the_title(); ?></h1>
	</a>

	<?php echo ss_framework_post_content(); ?>

</div><!-- end .entry-body -->

<div class="entry-meta">

	<?php echo ss_framework_post_meta(); ?>

</div><!-- end .entry-meta -->