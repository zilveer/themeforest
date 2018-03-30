<div class="stack stack-callout bg-<?php echo $stack['style']; ?>" id="<?php echo $stack['id']; ?>">
<div class="container">
	<div class="row">
		<?php if( $stack['element'] == 'button' ): ?>

			<div class="span12">
				<a href="<?php echo $stack['button_link']; ?>" target="<?php echo $stack['link_target']; ?>" class="button-primary <?php if(!$stack['button_sub_text']) echo 'button-primary-no-sub'; ?>">
					<?php if( $stack['button_icon'] != '' ): ?> <i class="icon <?php echo $stack['button_icon']; ?> "></i> <?php endif; ?>
					<?php echo $stack['button_text']; ?> 
					<small><?php echo $stack['button_sub_text']; ?></small>
				</a>
				<div class="callout-text"><?php echo __($stack['stack_title']); ?></div>
			</div>

		<?php elseif( $stack['element'] == 'icon' ): ?>

			<div class="span12">
				<i class="icon <?php echo $stack['icon']; ?> callout-icon"></i>
				<div class="callout-text"><?php echo __($stack['stack_title']); ?></div>
			</div>

		<?php elseif( $stack['element'] == '' ): ?>

			<div class="span12">
				<div class="callout-text"><?php echo __($stack['stack_title']); ?></div>
			</div>
		
		<?php endif; ?>

	</div>
</div>
</div>