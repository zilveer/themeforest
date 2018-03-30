<div class="stack stack-feature" id="<?php echo $stack['id']; ?>">
<div class="container">
	<div class="row">

		<?php if( $stack['stack_title'] != '' ): ?><div class="span12"><div class="stack-title"><?php _e($stack['stack_title']); ?><span class="spot"></span></div></div><?php endif; ?>

		<?php 
		$counter = 0;
		foreach ($stack['features'] as $feature ) { ?>

				<div class="span<?php echo (12/$stack['layout']); ?>">
					<div class="feature-title">
						<?php if ( $feature['icon'] != '' ): ?><i class="icon <?php echo $feature['icon']; ?>"></i><?php endif; ?> 
						<?php if( $feature['link'] != '' ) echo '<a href="'.$feature['link'].'">'; ?>
							<?php _e($feature['stack_title']); ?>
						<?php if( $feature['link'] != '' ) echo '</a>'; ?>
					</div>

					<?php echo apply_filters('the_content', $feature['content_text']); ?>
				</div>

				<?php if( ++$counter % $stack['layout'] == 0 ) echo '<div class="clear"></div>'; ?>

		<?php } ?>

	</div>
</div>
</div><!-- .stack-feature -->