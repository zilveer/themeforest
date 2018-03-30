<div class="stack stack-pricing" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">

	<?php if( $stack['stack_title'] != '' ): ?><div class="span12"><div class="stack-title"><?php echo $stack['stack_title']; ?><span class="spot"></span></div></div><?php endif; ?>

	<?php if( is_array($stack['plans']) ) foreach ($stack['plans'] as $plan ): ?>
	<div class="span<?php echo 12/count($stack['plans']); ?>">
			<?php // var_dump($plan); ?>
			<ul class="price-list">
				<li class="row-title"><?php echo $plan['stack_title']; ?></li>
				<li class="row-price"><?php echo $plan['price']; ?></li>
				<?php 
					if( is_array( $plan['rows'] ) )
					foreach ($plan['rows'] as $row ): ?>
					<li><?php echo $row['stack_title']; ?></li>
				<?php endforeach; ?>
				<?php if( $plan['button_text'] ): ?>
					<li class="row-button"><a href="<?php echo $plan['button_link']; ?>" target="<?php echo $plan['button_target']; ?>" class="button-primary button-large"><?php echo $plan['button_text']; ?></a></li>
				<?php endif; ?>
			</ul>
	</div>
	<?php endforeach; ?>

</div>
</div>
</div><!-- .stack-pricing -->