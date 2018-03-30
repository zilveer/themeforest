<?php
global $source_name;
global $source_url;


if( get_post_format() == 'gallery'): 

	echo '<div class="single-featured-image half">';
	get_template_part( 'single/post', 'gallery' );
	echo '</div>';

elseif( get_post_format() == 'video' ):
	
	$fave_video_embed = get_post_meta( get_the_ID(), 'fave_video_embed', true );
	
	if( isset( $fave_video_embed ) && $fave_video_embed != '' ):
		echo '<div class="magazilla_video_wrapper single-featured-image half">'.get_post_meta( get_the_ID(), 'fave_video_embed', true ).'</div>';
	else:
		$embed_code = wp_oembed_get( get_post_meta( get_the_ID(), 'fave_video_post', true ) );
		echo '<div class="magazilla_video_wrapper single-featured-image half">'.$embed_code.'</div>';
	endif;


elseif( get_post_format() == 'audio' ):
	
	$embed_code = wp_oembed_get( get_post_meta( get_the_ID(), 'fave_audio_post', true ) );
	echo '<div class="single-featured-image half">';
	echo $embed_code;
	echo '</div>';

else:
?>
	<div class="single-featured-image half">
		<figure class="wp-caption">
			<?php $fave_image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full'); ?>
			<a class="magzilla-popup" href="<?php echo $fave_image_full[0]; ?>">
				<?php the_post_thumbnail('single-big-size', array( "itemprop", "image" ) ); ?>
			</a>

			<?php if( !empty( $source_name ) ): ?>
			<span class="image-credits"><a href="<?php echo esc_url( $source_url ); ?>" target="_blank"><?php echo esc_attr( $source_name ); ?></a></span>
			<?php endif; ?>

		</figure>
		<figcaption class="wp-caption-text"><?php fave_post_thumbnail_caption(); ?></figcaption> 
	</div>
<?php
endif; 
?>