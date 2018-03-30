<div class="stack stack-feature" id="<?php echo $stack['id']; ?>">
<div class="container">
	<div class="row">

		<?php if( $stack['stack_title'] != '' ): ?><div class="span12"><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div></div><?php endif; ?>

		<?php 
		$counter = 0;
		foreach ($stack['features'] as $feature ) { ?>

				<div class="span4">
					<?php if( $feature['link'] != '' ) echo '<a href="'.$feature['link'].'">'; ?>
					<?php 
						if( $feature['image'] )
						echo gen_responsive_image_block( $feature['image'], array(
								array( 'width' => 300 ),
								array( 'width' => 300*2, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
							)
						);
					?>
					<?php if( $feature['link'] != '' ) echo '</a>'; ?>
					<div class="feature-title">
						<?php if( $feature['link'] != '' ) echo '<a href="'.$feature['link'].'">'; ?>
							<?php echo $feature['stack_title']; ?>
						<?php if( $feature['link'] != '' ) echo '</a>'; ?>
					</div>
					<?php echo apply_filters('the_content', $feature['content_text']); ?>
				</div>

				<?php if( ++$counter % 3 == 0 ) echo '<div class="clear"></div>'; ?>

		<?php } ?>

	</div>
</div>
</div><!-- .stack-container -->