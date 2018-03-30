<?php
$output = $title = $el_class = $count = $taxonomy = $color = $icon = '';


extract( shortcode_atts( array(
	'title' => esc_html__( 'Tags', 'homeshop' ),
	'taxonomy' => 'post_tag',
	'icon' => '',
	'color' => 'default',
	'el_class' => ''
), $atts ) );



$el_class = $this->getExtraClass( $el_class );
$current_taxonomy = $taxonomy;


if ( !empty($atts['title']) ) {
            $title = $atts['title'];
        } else {
            if ( 'post_tag' == $current_taxonomy ) {
                $title = esc_html__('Tags', 'homeshop');
            } else {
                $tax = get_taxonomy($current_taxonomy);
                $title = $tax->labels->name;
            }
        }


		
		
echo '<div class="row sidebar-box '. esc_attr($color) .'">
						
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<div class="sidebar-box-heading">
					<i class="icons '. esc_attr($icon) .'"></i>
					<h4>'. esc_html($title) .'</h4>
				</div>
				<div class="sidebar-box-content sidebar-padding-box">';	
				
		

		/**
		 * Filter the taxonomy used in the Tag Cloud widget.
		 *
		 * @since 2.8.0
		 * @since 3.0.0 Added taxonomy drop-down.
		 *
		 * @see wp_tag_cloud()
		 *
		 * @param array $current_taxonomy The taxonomy to use in the tag cloud. Default 'tags'.
		 */
		wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', array(
			'taxonomy' => $current_taxonomy
		) ) );

		echo "</div></div></div>\n";		
		
		
