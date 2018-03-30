<div id="sidebar" class="widget-area" role="complementary">
	<?php
	if($GLOBALS['curr_widget_area'] == 'primary-widget-area'){
		$wa_id = 'sidebar-widget-area';		
	}
	elseif($GLOBALS['curr_widget_area'] != ''){
		$wa_id = $GLOBALS['curr_widget_area'];		
	}

	if(is_active_sidebar($wa_id)){
		dynamic_sidebar( $wa_id );
	}
	?>
</div>