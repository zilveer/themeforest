<div class="stack stack-map" id="<?php echo $stack['id']; ?>">

		<?php if( isset($stack['marker_full_info_list']) ) if( is_array($stack['marker_full_info_list']) ): ?>
		<div class="contact-pane">
			<?php foreach ($stack['marker_full_info_list'] as $marker ): ?>
			
			<?php if(isset($marker['stack_title'])): ?>
				<p class="title"><strong><?php echo $marker['stack_title']; ?></strong></p>
			<?php endif; ?>

			<?php if(isset($marker['content'])): ?>
				<div class="content"><?php echo apply_filters('the_content', $marker['content']); ?></div>
			<?php endif; ?>
			
			<?php break; endforeach; ?>
		</div><!-- .contact-pane -->
		<?php endif; ?>

		<div class="map-wrap" data-marker="true" data-lat="<?php echo $stack['lat']; ?>" data-lng="<?php echo $stack['lng']; ?>" data-zoom="<?php echo $stack['map_zoom']; ?>" style="height: <?php echo $stack['map_height']; ?>px;">
			<?php if( isset($stack['marker_full_info_list']) ) if( is_array($stack['marker_full_info_list']) ): ?>
				<?php foreach ($stack['marker_full_info_list'] as $marker ): ?>
					<div data-lat="<?php echo $marker['lat']; ?>" data-lng="<?php echo $marker['lng']; ?>" <?php if(isset($marker['stack_title'])): ?>data-title="<?php echo $marker['stack_title']; ?>"<?php endif; ?> <?php if(isset($marker['content'])): ?>data-content='<?php echo apply_filters('the_content', $marker['content']); ?>'<?php endif; ?>></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	
</div>