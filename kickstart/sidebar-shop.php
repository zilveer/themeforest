<?php 
if(ot_get_option('woo_layout') == 'content_right'){
	echo '<div id="sidebar_left">'; 
} else {
	echo '<div id="sidebar_right">'; 
} ?>

	<div id="default-widget-area" class="widget-area">
		<ul class="xoxo">
			<?php dynamic_sidebar( 'shop-widget-area' ); ?>
		</ul>
	</div>
</div>
