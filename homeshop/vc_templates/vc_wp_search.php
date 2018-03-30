<?php
$output = $title = $el_class = $color = $icon = '';
extract( shortcode_atts( array(
	'title' => '',
	'icon' => '',
	'color' => 'default',
	'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );


echo '<div class="row ' . $el_class . ' sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content">';	
		
		
		// Use current theme search form if it exists
		get_search_form();

		echo '</div>
                </div>		
				</div>';	