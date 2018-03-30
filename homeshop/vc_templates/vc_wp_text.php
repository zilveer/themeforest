<?php
$output = $title = $el_class = $text = $filter = $color = $icon = '';
extract( shortcode_atts( array(
	'title' => '',
	'icon' => '',
	'text' => '',
	'color' => 'default',
	'filter' => true,
	'el_class' => ''
), $atts ) );


$atts['filter'] = true; //Hack to make sure that <p> added

$el_class = $this->getExtraClass( $el_class );


echo '<div class="row ' . $el_class . ' sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content" style="padding:15px;" >';	
		?>
			<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		
		echo '</div></div></div>';
		


