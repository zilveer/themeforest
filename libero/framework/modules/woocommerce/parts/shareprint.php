<div class="mkd-woo-share-print-holder">
	<?php
	echo libero_mikado_execute_shortcode('mkd_social_share',array(
		'type' => 'dropdown'
	));
	?>
	<div class="mkd-print-holder">
		<a href="#" onClick="window.print();return false;" class="mkd-print-page">
			<span class="icon-printer mkd-icon-printer"></span>
			<span class="mkd-printer-title"><?php esc_html_e("Print", "libero") ?></span>
		</a>
	</div>
</div>