<?php
	if( $stack['img_width'] == 'one_third' ) {  
		$img_width = 460;
		$text_col = 'span8';
		$img_col = 'span4';
	} else {  
		$img_width = 460;
		$text_col = 'span6';
		$img_col = 'span6';
	}
	
?>
<div class="stack stack-image-text <?php echo $stack['type']; ?>" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">
	<?php 
	if( $stack['type'] == 'image-right' ): // Image on the Right ?>

		<div class="<?php echo $text_col; ?>">
			<?php if( $stack['stack_title'] != '' ): ?><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div><?php endif; ?>

			<?php echo apply_filters('the_content', $stack['content_text']); ?>

			<?php if( $stack['button_text'] != '' ): ?>
				<p><a href="<?php echo $stack['button_link']; ?>" target="<?php echo $stack['link_target']; ?>" class="button"><?php echo $stack['button_text']; ?></a></p>
			<?php endif; ?>
		</div>
		<div class="<?php echo $img_col; ?>">
			<div class="img-box">
				<?php 
					echo gen_responsive_image_block( $stack['image'], array(
							array( 'width' => $img_width ),
							array( 'width' => $img_width*2, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
						) 
					);
				?>
			</div>
		</div>

	<?php else: // Image on the Left  ?>

		<div class="<?php echo $img_col; ?>">
			<div class="img-box">
				<?php 
					echo gen_responsive_image_block( $stack['image'], array(
							array( 'width' => $img_width ),
							array( 'width' => $img_width*2, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
						) 
					);
				?>
			</div>
		</div>
		<div class="<?php echo $text_col; ?>">
			<?php if( $stack['stack_title'] != '' ): ?><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div><?php endif; ?>

			<?php echo apply_filters('the_content', $stack['content_text']); ?>

			<?php if( $stack['button_text'] != '' ): ?>
				<p><a href="<?php echo $stack['button_link']; ?>" target="<?php echo $stack['link_target']; ?>" class="button"><?php echo $stack['button_text']; ?></a></p>
			<?php endif; ?>
		</div>

	<?php endif; ?>

</div>		
</div>
</div><!-- .stack-image-text -->