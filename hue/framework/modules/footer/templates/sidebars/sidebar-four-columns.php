<?php $cols = 4; ?>

<div class="mkd-grid-row mkd-footer-top-four-cols">
	<?php for($i = 1; $i <= $cols; $i++) : ?>
		<div class="mkd-grid-col-3 mkd-grid-col-ipad-landscape-6 mkd-grid-col-ipad-portrait-12">
			<?php if(is_active_sidebar('footer_column_'.$i)) :
				dynamic_sidebar('footer_column_'.$i);
			endif; ?>
		</div>
	<?php endfor; ?>
</div>