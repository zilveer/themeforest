<?php $cols = 3; ?>

<div class="mkd-grid-row mkd-footer-top-three-cols">
	<?php for($i = 1; $i <= $cols; $i++) : ?>
		<div class="mkd-grid-col-4">
			<?php if(is_active_sidebar('footer_column_'.$i)) :
				dynamic_sidebar('footer_column_'.$i);
			endif; ?>
		</div>
	<?php endfor; ?>
</div>