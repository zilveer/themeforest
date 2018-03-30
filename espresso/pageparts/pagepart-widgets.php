<div id="widget-block">
	<div class="shell clearfix"><?php

	$show_widgets = get_post_meta($post->ID,'_widget_layout',true); $show_widgets = ($show_widgets ? $show_widgets[0] : '');
	$zone_1_widget = (get_post_meta($post->ID, '_widget_block_1',true) ? get_post_meta($post->ID, '_widget_block_1',true) : 1);
	$zone_2_widget = (get_post_meta($post->ID, '_widget_block_2',true) ? get_post_meta($post->ID, '_widget_block_2',true) : 2);
	$zone_3_widget = (get_post_meta($post->ID, '_widget_block_3',true) ? get_post_meta($post->ID, '_widget_block_3',true) : 3);

	switch ($show_widgets) {
	
		case 'one' :
		
			if (is_active_sidebar('page-block-'.$zone_1_widget)){
				
				dynamic_sidebar('page-block-'.$zone_1_widget);
				
			}
		
		break;
		
		case 'two' :
		
			if (is_active_sidebar('page-block-'.$zone_1_widget) || is_active_sidebar('page-block-'.$zone_2_widget)){
				
				echo '<div class="one_half">';
					dynamic_sidebar('page-block-'.$zone_1_widget);
				echo '</div>';
				
				echo '<div class="one_half last">';
					dynamic_sidebar('page-block-'.$zone_2_widget);
				echo '</div>';
				
			}
		
		break;
		
		case 'three' :
		
			if (is_active_sidebar('page-block-'.$zone_1_widget) || is_active_sidebar('page-block-'.$zone_2_widget) || is_active_sidebar('page-block-'.$zone_3_widget)){
				
				echo '<div class="one_third">';
					dynamic_sidebar('page-block-'.$zone_1_widget);
				echo '</div>';
				
				echo '<div class="one_third">';
					dynamic_sidebar('page-block-'.$zone_2_widget);
				echo '</div>';
				
				echo '<div class="one_third last">';
					dynamic_sidebar('page-block-'.$zone_3_widget);
				echo '</div>';
				
			}
		
		break;
		
		case 'onethird_twothird' :
		
			if (is_active_sidebar('page-block-'.$zone_1_widget) || is_active_sidebar('page-block-'.$zone_2_widget)){
				
				echo '<div class="one_third">';
					dynamic_sidebar('page-block-'.$zone_1_widget);
				echo '</div>';
				
				echo '<div class="two_third last">';
					dynamic_sidebar('page-block-'.$zone_2_widget);
				echo '</div>';
				
			}
		
		break;
		
		case 'twothird_onethird' :
		
			if (is_active_sidebar('page-block-'.$zone_1_widget) || is_active_sidebar('page-block-'.$zone_2_widget)){
				
				echo '<div class="two_third">';
					dynamic_sidebar('page-block-'.$zone_1_widget);
				echo '</div>';
				
				echo '<div class="one_third last">';
					dynamic_sidebar('page-block-'.$zone_2_widget);
				echo '</div>';
				
			}
		
		break;
		
	} ?></div>
</div>