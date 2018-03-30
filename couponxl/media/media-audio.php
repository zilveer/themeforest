<?php
	$post_meta = get_post_custom();
	$post_id = get_the_ID();
	$iframe_audio = get_post_meta( $post_id, 'iframe_audio', true );
	$audio_type = get_post_meta( $post_id, 'audio_type', true );
	if( !empty( $iframe_audio ) ){
		if( $audio_type == 'embed' ){
			?>
			<div class="embed-responsive embed-responsive-16by9">
				<iframe src="<?php echo esc_url( $iframe_audio ) ?>" class="embed-responsive-item"></iframe>
			</div>
			<?php
		}
		else{
			if( has_post_thumbnail() ){
				?>
				<div class="embed-responsive embed-responsive-16by9">
				<?php
				the_post_thumbnail( 'post-thumbnail', array( 'class' => 'embed-responsive-item' ) );
				?>
					<div class="post-audio-absolute">
						<?php echo do_shortcode( '[audio mp3="'.$iframe_audio.'"]' ); ?>
					</div>
				</div>
				<?php
			}
			else{
			?>
				<div class="post-audio">
					<?php echo do_shortcode( '[audio mp3="'.$iframe_audio.'"]' ); ?>
				</div>			
			<?php
			}
		}
	}
	else{
		the_post_thumbnail( 'post-thumbnail', array( 'class' => 'embed-responsive-item' ) );
	}
?>