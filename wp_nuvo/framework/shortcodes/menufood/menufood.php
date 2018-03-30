<?php
add_shortcode('cs-menufood', 'cs_shortcode_menufood_render');
$menufood_id = 0;
function cs_shortcode_menufood_render($params, $content = NULL) {
    global $menufood_id, $smof_data;
    extract(shortcode_atts(array(
                'category' => '',
                'category_heading'=>'h1',
                'category_padding' => '60px 0 40px 0',
                'num_post' => '',
                'post_heading'=>'h3',
                'layout' => '1',
                'layout_colunm' => '1',
                'excerpt_length' => '',
                'orderby' => 'ID',
                'show_price' => '',
                'show_link' => '',
                'image' => '',
                'crop_image' => '',
                'width_image' => '160',
                'height_image' => '160',
                'order' => 'DESC',
                'show_hidden_category_heading' => '1',
                'r' => '0',
                'class' => ''
                    ), $params));
    $id = 'cs-menufood-'.$menufood_id;

    wp_enqueue_script('jquery-colorbox');

    $col = 'col-xs-12 col-sm-6 col-md-6 col-lg-6 menu_food_2_col';
    switch ($layout_colunm){
    	case 1:
    		$col = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 menu_food_1_col';
    		break;
    	case 2:
    		$col = 'col-xs-12 col-sm-6 col-md-6 col-lg-6 menu_food_2_col';
    		break;
    	case 3:
    		$col = 'col-xs-12 col-sm-6 col-md-4 col-lg-4 menu_food_3_col';
    		break;
    	case 4:
    		$col = 'col-xs-12 col-sm-6 col-md-3 col-lg-3 menu_food_4_col';
    		break;
    }
    $image_layout = new stdClass();
    $image_layout->image = '';
    $image_layout->content = ' col-xs-12 col-sm-12 col-md-12 col-lg-12';
    if($image == '1'){
        $image_layout->image = ' col-xs-12 col-sm-6 col-md-4 col-lg-4';
        $image_layout->content = ' col-xs-12 col-sm-6 col-md-8 col-lg-8';
    }

    $wp_query = '';
    if($category){
    	$wp_query = new WP_Query(array(
    		'showposts' => $num_post,
    		'post_type' => 'restaurantmenu',
    		'post_status' => 'publish',
    		'tax_query' => array(
    		    array(
    				'taxonomy' => 'restaurantmenu_category',
    				'field' => 'term_id',
    				'terms' => $category,
    		        'operator' => 'IN'
    		    )
    		),
    	    'orderby' => $orderby,
    	    'order' => $order,
    	));
    } else {
        $wp_query = new WP_Query(array(
            'showposts' => $num_post,
            'post_type' => 'restaurantmenu',
            'post_status' => 'publish',
            'orderby' => $orderby,
            'order' => $order,
        ));
    }
	$term = get_term( $category, 'restaurantmenu_category');
	$cat_data = get_option("category_".$category);
	$images_id = '';
	$attachment_image = array();
	if(isset($cat_data['img'])){
    	$images_id = (int)$cat_data['img'];
    	$attachment_image = wp_get_attachment_image_src($images_id,'full');
	}
	/* Background */
	$bg = '';
	$styles = '';
	$data_image_height = '';
	if(count($attachment_image) > 0){
	    $bg = $attachment_image[0];
	    if(empty($cat_data['bg_parallax_speed'])){
	        $cat_data['bg_parallax_speed'] = 0.6;
	    }
	    $data_image_height = " data-stellar-background-ratio='{$cat_data['bg_parallax_speed']}' data-background-height='{$attachment_image[2]}' data-background-width='{$attachment_image[1]}'";
	    $styles .= '<style type="text/css">';
	    $styles .= '#'.$id.'{';
	    $styles .= ' background-image:url('.$bg.');';
	    $styles .= ' padding:'.$category_padding.';';
	    if(isset($cat_data['bg_parallax']) && $cat_data['bg_parallax'] == 'yes'){
	       $styles .= ' -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;';
	    }
	    $styles .= '}';
	    $styles .= '</style>';
	}
	
	
	$total_items = $wp_query->post_count;
	
	ob_start();
	?>
    <?php echo $styles; ?>
    <?php if($show_hidden_category_heading == '1'): ?>
        <div id="<?php echo $id; ?>" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-categoryFood<?php if($cat_data['bg_parallax'] == 'yes'){ echo " stripe-parallax-bg"; } ?>"<?php echo $data_image_height; ?>>
                <div class="title-category">
                   <<?php echo $category_heading; ?> class="title-default"><?php if(isset($term->name)){ echo esc_attr($term->name);} ?></<?php echo $category_heading; ?>>
                </div>
            <div class="description-category"><?php if(isset($term->description)){ echo esc_attr($term->description);} ?></div>
        </div>
    <?php endif; ?>
    <div class="container"><?php require "layouts/menu-layout-$layout.php"; ?></div>
    <?php $menufood_id++; wp_reset_query(); wp_reset_postdata(); ?>
    <?php
    return ob_get_clean();
}