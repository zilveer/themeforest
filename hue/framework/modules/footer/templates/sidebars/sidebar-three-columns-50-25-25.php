<div class="mkd-grid-row mkd-footer-top-50-25-25">
	<div class="mkd-grid-col-6">
		<?php if(is_active_sidebar('footer_column_1')) : ?>
			<?php dynamic_sidebar('footer_column_1'); ?>
		<?php endif; ?>
	</div>
	<div class="mkd-grid-col-6">
		<div class="mkd-grid-row">
			<div class="mkd-grid-col-6">
				<?php if(is_active_sidebar('footer_column_2')) : ?>
					<?php dynamic_sidebar('footer_column_2'); ?>
				<?php endif; ?>
			</div>
			<div class="mkd-grid-col-6">
				<?php if(is_active_sidebar('footer_column_3')) : ?>
					<?php dynamic_sidebar('footer_column_3'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>