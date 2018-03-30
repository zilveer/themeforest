<?php
$output = $title = $el_class = $nav_menu = $color = $icon = '';
extract( shortcode_atts( array(
	'title' => '',
	'nav_menu' => '',
	'nav_menu' => '',
	'icon' => '',
	'color' => 'default',
	'depth' => 0,
	'el_class' => ''
), $atts ) );
$el_class = $this->getExtraClass( $el_class );


$type = 'WP_Nav_Menu_Widget';




 $nav_menu = ! empty( $atts['nav_menu'] ) ? wp_get_nav_menu_object( $atts['nav_menu'] ) : false;
 
        if ( !$nav_menu ) {
			return;
		}
            

			
			
			
	 echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content">';	
		
	wp_nav_menu( array( 'fallback_cb' => '', 'container' => false, 'menu' => $nav_menu, 'depth'           => 3, 'walker' => new widget_walker_nav_menu ) );

	
	echo "</div></div></div>\n";			
			
			
			
			


