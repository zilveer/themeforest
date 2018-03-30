<?php

function webnus_ourclients($attributes, $content){
	extract(shortcode_atts(array(
	'type'  => '1',
	'client_images'=>''
	), $attributes));

	$client_images_url = '';
	if(!empty($client_images))
	{
		$images_id_array = array();
		$images_id_array =explode(',',$client_images);
		foreach($images_id_array as $id)
		{
			@$link = get_post($id)->post_excerpt;
			$alt_text = get_post_meta($id, '_wp_attachment_image_alt', true);
			if(empty($link))
			$client_images_url .= '<li><img alt="'.$alt_text.'" src="' .wp_get_attachment_url( $id ) . '"/></li>';
			else
			$client_images_url .= '<li><a target="_blank" href="'.$link.'"><img alt="'.$alt_text.'"  src="' .wp_get_attachment_url( $id ) . '"/></a></li>';
		}
	}
	$out = '';
	$out .= '<div class="aligncenter">';
    $out .= '<hr class="vertical-space1"><div class="col-md-12 our-clients-wrap ';
	if($type==2)
	{
	$out .='crsl';
	}
	$out .= '"><ul id="our-clients" class="our-clients ';
	if($type==2)
	{
	$out .='crsl';
	}
	$out .='">';
	$out .= $client_images_url;
	$out .= do_shortcode($content);
	$out .='</ul>';
	$out .= '</div><hr class="vertical-space2"></div>';
	
	return $out;
}
add_shortcode("ourclients", "webnus_ourclients");
function webnus_client($attributes, $content){
	extract(shortcode_atts(array(
		"img" => '',
		"img_alt" => '',
	), $attributes));

return !empty($img)?'<li><img src="'.$img.'" alt="'.$img_alt.'"></li>':'';
}
add_shortcode("client", "webnus_client");
?>