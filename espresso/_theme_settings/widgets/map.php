<?php

// Text Widget with Icon
// ----------------------------------------------------
class BoxyWidgetMapWidget extends BoxyWidgetBase {
	/*
	* Register widget function. Must have the same name as the class
	*/
	function BoxyWidgetMapWidget() {
		$widget_opts = array(
			'classname' => 'theme-widget-map-widget', // class of the <li> holder
			'description' => __( 'Displays a Google Map.','espresso') );
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		parent::__construct('theme-widget-map-widget', __('[ESPRESSO] Google Map Widget','espresso'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>__('Title (optional)','espresso'), 
				'default'=> ''
			),
			array(
				'name'=>'map_code',
				'type'=>'textarea',
				'title'=>__('Map &lt;iframe&gt; Code','espresso'), 
				'default'=>'<iframe width="273" height="151" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=one+infinite+loop&amp;aq=&amp;sll=42.633959,28.88855&amp;sspn=3.321876,7.13562&amp;ie=UTF8&amp;hq=&amp;t=m&amp;ll=37.352283,-122.027721&amp;spn=0.020605,0.046692&amp;z=13&amp;output=embed"></iframe>'
			),
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
		extract($args);
		
		$title = $instance['title'];
		$map_code = $instance['map_code']; ?>
		
		<div class="map-widget">
			<?php echo ($title ? $before_title.$title.$after_title : ''); ?>
			<?php echo $map_code; ?>
		</div>
			
	<?php }
}

?>