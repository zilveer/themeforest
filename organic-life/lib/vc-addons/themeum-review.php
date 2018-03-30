<?php
add_shortcode( 'themeum_review', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'category' 						=> '',
		'column' 						=> 'col-three',
		'number' 						=> '6',
		'class' 						=> '',
        'order_by'  					=> 'date',          
        'order'   						=> 'DESC',   
        'show_category'   				=> 'yes',
        'duration' 						=> '1000',  
        'delay' 						=> '100', 
        'show_date'   					=> 'yes',   
        'show_comment'   				=> 'yes',   
        'text_lenght'   				=> '140',   
		), $atts));

 	global $post;

 	$output     = '';

 	$dur = '';
 	$entry_dur = '';

 	$item_del = '';
 	$entry_del = ''; 	

 	$title_dur = '';
 	$title_del = '';

 	$text_dur = '';
 	$text_del = '';

 	if ($duration) $dur .= (int) $duration .'ms'; 
 	if ($delay) $item_del .= (int) $delay .'ms'; 

 	$entry_dur .= $dur - 200; 
 	$entry_del .= $item_del + 100; 

 	$title_dur .= $dur - 300; 
 	$title_del .= $item_del + 200; 

 	$text_dur .= $dur - 400; 
 	$text_del .= $item_del + 300; 


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

    	$output .= '<ul class="latest-review '.$class.'">';

	    foreach ($posts as $post): setup_postdata($post);

	    $output .= '<li class="latest-review-single-item review-' . $column . ' wow fadeInUp" data-wow-duration="'.$dur.'" data-wow-delay="'.$item_del.'">';

	    $output .= '<div class="review-image-wrapper">';

	    if($column=='col-two'){
	    	$output .= '<a class="review-item-image"  href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'portfolio-thumb2', array('class' => 'img-responsive')).'</a>';
	    }else {
	    	$output .= '<a class="review-item-image"  href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'sm-blog-thumb', array('class' => 'img-responsive')).'</a>';
	    }

	    
	    if ( $show_comment == 'yes') {
		    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : 
	 			//$output .= '<span class="comments">' . comments_popup_link( '0',  '1' , '%'  ) . '</span>';
	 			$output .= '<span class="comments"> <a href="'.get_permalink().'#comments" >' . get_comments_number(). '</a></span>';
	 		endif;
	 	}	
			$output .= '</div>';


		$output .= '<div class="review-item-text">';
		if ( $show_category == 'yes') {
			$output .= '<span class="entry-category wow fadeInUp" data-wow-duration="'.$entry_dur.'ms" data-wow-delay="'.$entry_del.'ms">';
			$output .= get_the_category_list(', ');
			$output .= '</span>';
		}

		if ( $show_date == 'yes') {
			$output .= '<span class="entry-date wow fadeInUp" data-wow-duration="'.$entry_dur.'ms" data-wow-delay="'.$entry_del.'ms">';
			$output .= get_the_date('d M Y');
			$output .= '</span>';	
		}

		$output .= '<h3 class="entry-title wow fadeInUp" data-wow-duration="'.$title_dur.'ms" data-wow-delay="'.$title_del.'ms"><a href="'.get_permalink().'">'. get_the_title() .'</a></h3>';
		$output .= '<div class="wow fadeInUp" data-wow-duration="'.$text_dur.'ms" data-wow-delay="'.$text_del.'ms">'.the_excerpt_max_charlength($text_lenght).'</div>';
		$output .= '</div>';	

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
		"name" => __("Themeum Latest Review", "themeum"),
		"base" => "themeum_review",
		'icon' => 'icon-thm-review',
		"class" => "",
		"description" => __("Widget Title Heading", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(				

			array(
				"type" => "textfield",
				"heading" => __("Category Name (leave empty for all latest post list)", "themeum"),
				"param_name" => "category",
				"value" => "",
				),	

			array(
				"type" => "dropdown",
				"heading" => __("Column", "themeum"),
				"param_name" => "column",
				"value" => array('Two'=>'col-two','Three'=>'col-three','Four'=>'col-four','Five'=>'col-five'),
				),						

			array(
				"type" => "textfield",
				"heading" => __("Number of items", "themeum"),
				"param_name" => "number",
				"value" => "",
				),			

			array(
				"type" => "textfield",
				"heading" => __("Text length (number of caracters)", "themeum"),
				"param_name" => "text_lenght",
				"value" => "",
				),

			array(
				"type" => "dropdown",
				"heading" => __("OderBy", "themeum"),
				"param_name" => "order_by",
				"value" => array('Date'=>'date','Title'=>'title','Modified'=>'modified','Author'=>'author','Random'=>'rand'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Order", "themeum"),
				"param_name" => "order",
				"value" => array('DESC'=>'DESC','ASC'=>'ASC'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Show Category", "themeum"),
				"param_name" => "show_category",
				"value" => array('YES'=>'yes','NO'=>'no'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Show Date", "themeum"),
				"param_name" => "show_date",
				"value" => array('YES'=>'yes','NO'=>'no'),
				),				

			array(
				"type" => "dropdown",
				"heading" => __("Show Comment", "themeum"),
				"param_name" => "show_comment",
				"value" => array('YES'=>'yes','NO'=>'no'),
				),	

			array(
				"type" => "textfield",
				"heading" => __("Animation Duration", "themeum"),
				"param_name" => "duration",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Animation Delay", "themeum"),
				"param_name" => "delay",
				"value" => "",
				),								

			array(
				"type" => "textfield",
				"heading" => __("Custom Class", "themeum"),
				"param_name" => "class",
				"value" => "",
				),	


			)

		));
}