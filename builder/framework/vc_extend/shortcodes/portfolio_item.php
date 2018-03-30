<?php
/*PORTFOLIO  ITEM*/
add_shortcode('vc_portfolio_item', 'vc_portfolio_item_f');
function vc_portfolio_item_f( $atts, $content = null)
{
	extract(shortcode_atts(
		array(
			'id' => '',
			'height' => '',
		), $atts)
	);
	$post = get_post($id);
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'wall-portfolio-squrex2'); 
	$title = $post->post_title;
	$catt = get_the_terms( $id, 'portfolio-category' );
	if (isset($catt) && ($catt!='')){
		$slugg = '';
		$slug = ''; 
		foreach($catt  as $vallue=>$key){
			$slugg .= strtolower($key->slug) . " ";
			$slug  .= ''.$key->name.', ';
		}
		
	};
	
	$output ='<div class="oi_strange_portfolio_item">';
            $output .='<div class="oi_vc_potrfolio">';
            	$output .='<a href="'.get_the_permalink($id).'">';
            	$output .='<img class="img-responsive" src="'.$image[0].'" alt="" />';
                $output .='<div class="oi_vc_port_mask"  style="background:'. get_post_meta($id, 'port-bg', true).'">';
                    $output .='<div class="text-center">';
                        $output .='<h3 class="oi_sub_legend" style="color:'.get_post_meta($id, 'port-text-color', true).'">'.$title.'</h3>';
                        $output .='<div class="oi_vc_port_cat" style="color:'.get_post_meta($id, 'port-text-color', true).'">'.substr($slug, '0', '-2').'</div>';
                        $output .='<div class="oi_vc_sep" style="background:'.get_post_meta($id, 'port-text-color', true).'"></div>';
                    $output .='</div>';
                $output .='</div>';
                $output .='</a>';
            $output .='</div>';
        $output .='</div>';
	
	return $output;
};

vc_map( array(
	"name" => __("Portfolio Item",'orangeidea'),
	"base" => "vc_portfolio_item",
	"admin_enqueue_css" => array(get_template_directory_uri().'/framework/vc_extend/style.css'),
	"class" => "",
	"category" => __('BUILDER','orangeidea'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "id",
			"heading" => __("Portfolio Item", "orangeidea"),
			"value" => '',
			"description" => __( "Portfolio ID", 'orangeidea' )
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"param_name" => "height",
			"heading" => __("Size", "orangeidea"),
			"value" => '',
			"description" => __( "x1 or x2", 'orangeidea' )
		)
	)
) );

