<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

global $post;

$client_mode = null;
$clients_data = null;
if ($client_layout == 'carousel-clients') {
	$client_mode = 'carousel-enabled ';
	$clients_data = ' data-items="'.$client_item.'" data-navigation="'.$client_navigation.'" data-pagination="'.$client_pagination.'" data-autoplay="'.$client_autoplay.'" data-items-tablet="'.$client_item_tablet.'" data-items-mobile="'.$client_item_mobile.'"';
} else {
	$client_mode = 'no-carousel ';
	$clients_data = null;
}

// Arguments
$args = array( 
	'posts_per_page' => -1, 
   	'post_type' => 'client'
);

// Run query
$my_query = new WP_Query($args);

$output .= '
<div class="az-clients '.$client_mode.$el_class.'" '.$clients_data.'>';

while($my_query->have_posts()) : $my_query->the_post();

$post_id = $my_query->post->ID;

$img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), '' );

if ($client_layout == 'carousel-clients') {
	$output .= '
	<div class="client-col">
		<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'. get_the_title() .'" class="img-responsive" />
	</div>
	';
} else {
	$output .= '
	<div class="client-col col-md-3">
		<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'. get_the_title() .'" class="img-responsive" />
	</div>
	';
}

endwhile;

wp_reset_query();

$output .= '
</div>'.$this->endBlockComment('az_clients');

echo $output

?>