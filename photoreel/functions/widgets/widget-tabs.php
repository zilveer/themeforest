<?php
/*---------------------------------------------------------------------------------*/
/* Tabs widget */
/*---------------------------------------------------------------------------------*/
add_action('widgets_init', 'tabs_widget');

function tabs_widget()
{
	register_widget('tabs_widget');
}

class tabs_widget extends WP_Widget {
	
	function tabs_widget()
	{
		$widget_ops = array('classname' => 'tabs_widget', 'description' => 'Featured posts widget.');

		$control_ops = array('id_base' => 'tabs_widget');

		$this->WP_Widget('tabs_widget', 'Themnific - Tabs', $widget_ops, $control_ops);

			if ( is_active_widget( false, false, $this->id_base, true ) ) {
				wp_enqueue_script('tabs', get_template_directory_uri() .'/js/tabs.js','','', true);
			}

    }

   function widget($args, $instance) {  
    extract( $args );
	?>
		<?php echo $before_widget; ?>
        		<?php get_template_part('/includes/uni-tabs');?>
		<?php echo $after_widget; 
   }




} 

register_widget('tabs_widget');
?>