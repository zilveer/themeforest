<div class="qodef-social-share-holder qodef-list <?php echo esc_attr($icon_type) ?> qodef-social-col-<?php echo esc_attr($number) ?>">
	<ul class="clearfix">
		<?php foreach ($networks as $net) {
			print $net;
		} ?>
	</ul>
</div>