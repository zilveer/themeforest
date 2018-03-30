<?php $cols = 2; ?>

<div class="mkd-grid-row">
	<?php for($i = 1; $i <= $cols; $i++) : ?>
		<div class="mkd-grid-col-6">
			<?php if(is_active_sidebar('footer_column_'.$i)) :
				dynamic_sidebar('footer_column_'.$i);
			endif; ?>
		</div>
	<?php endfor; ?>
</div>