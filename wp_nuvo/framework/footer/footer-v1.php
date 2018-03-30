<?php global $smof_data;?>
<?php if($smof_data['footer_top_widgets']): ?>
<div id="footer-top">
	<div class="container">
		<div class="row">
			<div class="footer-top">
				<?php cshero_sidebar_footer_top(); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if($smof_data['footer_bottom_widgets']): ?>
<div id="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="footer-bottom">
				<?php cshero_sidebar_footer_bottom(); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>