<?php
	if( isset($stack['random_order']) && $stack['random_order'] == 'on' ) {
		if( isset($stack['clients']) ) shuffle($stack['clients']);
		if( isset($stack['images']) ) shuffle($stack['images']);
	}
?>
<div class="stack stack-client" id="<?php echo $stack['id']; ?>">
<div class="container">
	<div class="row">
		<div class="span12">
			
			<?php if( $stack['stack_title'] != '' ): ?><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div><?php endif; ?>

			<div class="m-carousel client-list" data-slide-per-page="6">
				<div class="m-carousel-inner">
					<?php if( isset($stack['clients']) && is_array( $stack['clients'] ) ): ?>
						
						<?php foreach( $stack['clients'] as $client ): ?>
							<div class="span2 m-item">
							<?php if($client['link']): ?><a href="<?php echo $client['link']; ?>" target="<?php echo $client['target']; ?>"><?php endif; ?>
								<?php 
									echo gen_responsive_image_block( $client['image'], array(
											array( 'width' => 140 ),
											array( 'width' => 140*2, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
										) 
									);
								?>
							<?php if($client['link']): ?></a><?php endif; ?>
							</div>
						<?php endforeach; ?>

					<?php 
					elseif( isset($stack['images']) && is_array( $stack['images'] ) ):
						foreach( $stack['images'] as $image ): 
					?>
						<div class="span2 m-item">
							<?php 
								echo gen_responsive_image_block( $image, array(
										array( 'width' => 140 ),
										array( 'width' => 140*2, 'media' => '(-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
									) 
								);
							?>
						</div>
					<?php endforeach; endif; ?>
				</div>
			</div>

			<?php if( ( isset($stack['clients']) && count( $stack['clients'] ) > 6 ) || ( isset($stack['images']) && count( $stack['images'] ) > 6 ) ): ?>
			<div class="m-carousel-control slide-control top-right-slide-control">
				<a href="#" class="m-carousel-prev"><i class="icon icon-angle-left"></i></a><a href="#" class="m-carousel-next"><i class="icon icon-angle-right"></i></a>
			</div>
			<?php endif; ?>

		</div>
	</div>
</div>
</div><!-- .stack-client -->