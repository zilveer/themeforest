<?php
global $source_name;
global $source_url;
global $post_layout;
global $fave_container;

if( get_post_format() == 'gallery'): 
	
	get_template_part( 'single/post', 'gallery' );

elseif( get_post_format() == 'video' ):
	
	$fave_video_embed = get_post_meta( get_the_ID(), 'fave_video_embed', true );
	
	if( isset( $fave_video_embed ) && $fave_video_embed != '' ):
		echo '<div class="magazilla_video_wrapper">'.get_post_meta( get_the_ID(), 'fave_video_embed', true ).'</div>';
	else:
		$embed_code = wp_oembed_get( get_post_meta( get_the_ID(), 'fave_video_post', true ) );
		echo '<div class="magazilla_video_wrapper">'.$embed_code.'</div>';
	endif;


elseif( get_post_format() == 'audio' ):
	
	$embed_code = wp_oembed_get( get_post_meta( get_the_ID(), 'fave_audio_post', true ) );  echo $embed_code;

else:
	if( has_post_thumbnail() ) {
		?>
		<div class="single-featured-image">
			<figure class="wp-caption">
				<?php $fave_image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
				<a class="magzilla-popup" href="<?php echo $fave_image_full[0]; ?>">
					<?php the_post_thumbnail( 'single-big-size', array( "itemprop" => "image" ) ); ?>
				</a>

				<?php if ( ! empty( $source_name ) ): ?>
					<span class="image-credits"><a href="<?php echo esc_url( $source_url ); ?>"
					                               target="_blank"><?php echo esc_attr( $source_name ); ?></a></span>
				<?php endif; ?>

			</figure>
			<?php if ( $post_layout == 'f' ) {
				echo '<div class="' . $fave_container . '">';
			} ?>
			<figcaption class="wp-caption-text"><?php fave_post_thumbnail_caption(); ?></figcaption>
			<?php if ( $post_layout == 'f' ) {
				echo '</div>';
			} ?>
		</div>
		<?php
	}
endif; 
?>