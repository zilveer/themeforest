<?php
$output = $title = $number = $show_date = $el_class = $color = $icon = '';
extract( shortcode_atts( array(
	'title' => esc_html__( 'Recent Posts', 'homeshop' ),
	'number' => 5,
	'icon' => '',
	'color' => 'default',
	'show_date' => false,
	'el_class' => ''
), $atts ) );
$atts['show_date'] = $show_date;

$el_class = $this->getExtraClass( $el_class );


$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

if ($r->have_posts()) :
	echo '<div class="row sidebar-box '. esc_attr($color) .'">
					
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="sidebar-box-heading">
				<i class="icons '. esc_attr($icon) .'"></i>
				<h4>'. esc_html($title) .'</h4>
			</div>
			<div class="sidebar-box-content" style="" ><ul>';	

		while ( $r->have_posts() ) : $r->the_post();

		echo '<li><a href="'. esc_url( get_permalink() ) .'">';
		get_the_title() ? the_title() : the_ID();
		if ( $show_date ) {
			echo '<span class="post-date">('. get_the_date() .')</span>';
		}
		echo '</a></li>';
		
		endwhile;

	echo '</ul></div></div></div>';


	// Reset the global $the_post as this query will have stomped on it
	wp_reset_postdata();
		
endif;		
