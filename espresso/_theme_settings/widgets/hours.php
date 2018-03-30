<?php

// Text Widget with Icon
// ----------------------------------------------------
class BoxyWidgetHoursWidget extends BoxyWidgetBase {
	/*
	* Register widget function. Must have the same name as the class
	*/
	function BoxyWidgetHoursWidget() {
		$widget_opts = array(
			'classname' => 'theme-widget-hours-widget', // class of the <li> holder
			'description' => __( 'Displays the "hours" widget.','espresso') );
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		parent::__construct('theme-widget-hours-widget', __('[ESPRESSO] Hours Widget','espresso'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>__('Title','espresso'), 
				'default'=>__('Our Hours','espresso')
			),
			array(
				'name'=>'left-text',
				'type'=>'textarea',
				'title'=>__('Left Text (days)','espresso'), 
				'default'=>"<b>MONDAY-FRIDAY</b><br />\n<b>SATURDAY</b><br />\n<b>SUNDAY</b>"
			),
			array(
				'name'=>'right-text',
				'type'=>'textarea',
				'title'=>__('Right Text (hours)','espresso'), 
				'default'=>"7am-8pm<br />\n8am-8pm<br />\nCLOSED"
			),
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
		extract($args);
		
		$title = $instance['title'];
		$left_text = $instance['left-text'];
		$right_text = $instance['right-text']; ?>
		
		<article class="hours-block clearfix">
						
			<?php echo ($title ? $before_title.$title.$after_title : ''); ?>
			
			<p class="left">
				<?php echo $left_text; ?>
			</p>
			
			<p class="right">
				<?php echo $right_text; ?>
			</p>
			
		</article>
			
	<?php }
}

?>