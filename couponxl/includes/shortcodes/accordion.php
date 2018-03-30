<?php
function couponxl_accordion_func( $atts, $content ){
	extract( shortcode_atts( array(
		'titles' => '',
		'contents' => ''
	), $atts ) );

	$titles = explode( "/n/", $titles );
	if( !empty( $content ) ){
		$contents = explode( "/n/", $content );
	}
	else{
		$contents = explode( "/n/", $contents );
	}

	$titles_html = '';
	$contents_html = '';

	$rnd = couponxl_random_string();

	$html = '';

	if( !empty( $titles ) ){
		for( $i=0; $i<sizeof( $titles ); $i++ ){
			if( !empty( $titles[$i] ) ){
				$html .= '
				  <div class="panel panel-default">
				    <div class="panel-heading" role="tab" id="heading_'.$i.'">
				      <div class="panel-title">
				        <a class="'.( $i !== 0 ? 'collapsed' : '' ).'" data-toggle="collapse" data-parent="#accordion_'.$rnd.'" href="#coll_'.$i.'_'.$rnd.'" aria-expanded="true" aria-controls="coll_'.$i.'_'.$rnd.'">
				        	'.$titles[$i].'
				        </a>
				      </div>
				    </div>
				    <div id="coll_'.$i.'_'.$rnd.'" class="panel-collapse collapse '.( $i == 0 ? 'in' : '' ).'" role="tabpanel" aria-labelledby="heading_'.$i.'">
				      <div class="panel-body">
				        '.( !empty( $contents[$i] ) ? apply_filters( 'the_content', $contents[$i] ) : '' ).'
				      </div>
				    </div>
				  </div>
				';
			}
		}
	}

	return '
		<div class="panel-group" id="accordion_'.$rnd.'" role="tablist" aria-multiselectable="true">
		'.$html.'
		</div>';
}

add_shortcode( 'accordion', 'couponxl_accordion_func' );

function couponxl_accordion_params(){
	return array(
		array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __("Titles","couponxl"),
			"param_name" => "titles",
			"value" => '',
			"description" => __("Input accordion titles separated by /n/.","couponxl")
		),
		array(
			"type" => "textarea_raw_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Contents","couponxl"),
			"param_name" => "contents",
			"value" => '',
			"description" => __("Input accordion contents separated by /n/.","couponxl")
		),

	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Accordion", 'couponxl'),
	   "base" => "accordion",
	   "category" => __('Content', 'couponxl'),
	   "params" => couponxl_accordion_params()
	) );
}
?>