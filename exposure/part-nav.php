<div id="thb-controls">
	<ul>
		<?php foreach( $controls as $control ) : ?>

			<?php if( $control === 'prev' ) : ?>
				<li class="thb-control-prev <?php echo isset($disabled_controls) && $disabled_controls == true ? 'thb-disabled' : ''; ?>">
					<a href="#" data-icon="<" id="thb-full-background_prev"><?php echo __('Previous', 'thb_text_domain') ?></a>
				</li>
			<?php endif; ?>

			<?php if( $control === 'next' ) : ?>
				<li class="thb-control-next <?php echo isset($total_posts) && $total_posts == 1 ? 'thb-disabled' : ''; ?>">
					<a href="#" data-icon=">" id="thb-full-background_next"><?php echo __('Next', 'thb_text_domain') ?></a>
				</li>
			<?php endif; ?>

			<?php if( $control === 'drawer' ) : ?>
				<li class="thb-control-drawer thb-control-toggle">
					<a href="#" data-icon="1"><?php echo __('Drawer', 'thb_text_domain') ?></a>
				</li>
			<?php endif; ?>

			<?php if( $control === 'fit' ) : ?>
				<li class="thb-control-fit thb-control-toggle">
					<a href="#" data-icon="3"><?php echo __('Fit', 'thb_text_domain') ?></a>
				</li>
			<?php endif; ?>

			<?php if( $control === 'info' ) : ?>
				<li class="thb-control-info thb-control-toggle">
					<a href="#"><?php echo __('Info', 'thb_text_domain') ?></a>
				</li>
			<?php endif; ?>

		<?php endforeach; ?>
	</ul>
</div>