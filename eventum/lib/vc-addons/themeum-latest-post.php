<?php
add_shortcode( 'themeum_review', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'category' 						=> '',
		'column' 						=> 'Three',
		'number' 						=> '3',
		'class' 						=> '',
        'order_by'  					=> 'date',          
        'order'   						=> 'DESC',   
        'show_date'   					=> 'yes',       
		), $atts));

 	global $post;

 	$output     = '';



 	$posts= 0;
 	
 	if (isset($category) && $category!='') {
 		$idObj 	= get_category_by_slug( $category );
 		
 		if (isset($idObj) && $idObj!='') {
			$idObj 	= get_category_by_slug( $category );
			$cat_id = $idObj->term_id;

			$args = array( 
		    	'category' => $cat_id,
		        'orderby' => $order_by,
		        'order' => $order,
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
 		}else{
 			echo "Please Enter a valid category name";
 			$args = 0;
 		}
 		}else{
			$args = array( 
		        'orderby' => $order_by,
		        'order' => $order,
		        'posts_per_page' => $number,
		    );
		    $posts = get_posts($args);
	 	}

    if(count($posts)>1){

    	$output .= '<ul class="latest-review '.esc_attr( $class ).'">';
		    foreach ($posts as $post): setup_postdata($post);
		    $output .= '<li class="latest-review-single-item review-' . esc_attr( $column ) . '">';
			    $output .= '<a class="review-item-image"  href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'blog-medium', array('class' => 'img-responsive')).'</a>';
				
				if ( $show_date == 'yes') {
					$output .= '<span class="entry-date">';
					$output .= get_the_date('d M Y');
					$output .= '</span>';	
				}
				$output .= '<h3 class="entry-title"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
			$output .= '</li>';
		    endforeach;
		    wp_reset_postdata();   
	    $output .= '</ul>';
	     
	}

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => esc_html__("Themeum Latest Review", 'eventum'),
		"base" => "themeum_review",
		'icon' => 'icon-thm-review',
		"class" => "",
		"description" => esc_html__("Widget Title Heading", 'eventum'),
		"category" => esc_html__('Themeum', 'eventum'),
		"params" => array(				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Category Name (leave empty for all latest post list)", 'eventum'),
				"param_name" => "category",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Column", 'eventum'),
				"param_name" => "column",
				"value" => array('Two'=>'col-two','Three'=>'col-three','Four'=>'col-four','Five'=>'col-five'),
				),						

			array(
				"type" => "textfield",
				"heading" => esc_html__("Number of items", 'eventum'),
				"param_name" => "number",
				"value" => "",
				),			

			array(
				"type" => "dropdown",
				"heading" => esc_html__("OderBy", 'eventum'),
				"param_name" => "order_by",
				"value" => array('Date'=>'date','Title'=>'title','Modified'=>'modified','Author'=>'author','Random'=>'rand'),
				),				

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Order", 'eventum'),
				"param_name" => "order",
				"value" => array('DESC'=>'DESC','ASC'=>'ASC'),
				),							

			array(
				"type" => "dropdown",
				"heading" => esc_html__("Show Date", 'eventum'),
				"param_name" => "show_date",
				"value" => array('YES'=>'yes','NO'=>'no'),
				),				

			array(
				"type" => "textfield",
				"heading" => esc_html__("Custom Class", 'eventum'),
				"param_name" => "class",
				"value" => "",
				),	


			)

		));
}