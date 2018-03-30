<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

global $post;

// Post teasers count
if ( $team_post_number != '' && !is_numeric($team_post_number) ) $team_post_number = -1;
if ( $team_post_number != '' && is_numeric($team_post_number) ) $team_post_number = $team_post_number;

// Columns
$team_full = null;
if ($team_layout == 'grid-team') {
	if ($team_wall==true) {
		$team_full = 'team-full-width wall-effect';

		if ( $team_columns_count=="2clm") { $team_columns_count = 'col-full-6'; }
		if ( $team_columns_count=="3clm") { $team_columns_count = 'col-full-4'; }
		if ( $team_columns_count=="4clm") { $team_columns_count = 'col-full-3'; }
		if ( $team_columns_count=="5clm") { $team_columns_count = 'col-full-2'; }
		if ( $team_columns_count=="6clm") { $team_columns_count = 'col-full-1'; }
	} 

	else {
		$team_full = 'team-normal-width';

		if ( $team_columns_count=="2clm") { $team_columns_count = 'col-md-6'; }
		if ( $team_columns_count=="3clm") { $team_columns_count = 'col-md-4'; }
		if ( $team_columns_count=="4clm") { $team_columns_count = 'col-md-3'; }
		if ( $team_columns_count=="5clm") { $team_columns_count = 'col-md-3'; }
		if ( $team_columns_count=="6clm") { $team_columns_count = 'col-md-3'; }
	}
} else {
		$team_full = 'team-listed wall-effect';

		if ( $team_columns_count=="2clm") { $team_columns_count = 'col-listed-1'; }
		if ( $team_columns_count=="3clm") { $team_columns_count = 'col-listed-1'; }
		if ( $team_columns_count=="4clm") { $team_columns_count = 'col-listed-1'; }
		if ( $team_columns_count=="5clm") { $team_columns_count = 'col-listed-1'; }
		if ( $team_columns_count=="6clm") { $team_columns_count = 'col-listed-1'; }
}

// Carousel Portfolio
if ($team_layout=="carousel-team") {
	if ($team_wall==true) {
		$team_full = 'team-full-width wall-effect';
	} else {
		$team_full = 'team-normal-width';
	}
	$team_columns_count = 'col-carousel-1';
}

// Arguments
$args = array( 
	'posts_per_page' => $team_post_number, 
   	'post_type' => 'team',
	'disciplines' => $team_categories,
	'orderby' => $orderby,
	'order' => $order
);

// Animation
$animation_loading_class = null;
if ($animation_loading == "yes") {
	$animation_loading_class = ' animated-content ';
}

$animation_effect_class = null;
if ($animation_loading == "yes") {
	$animation_effect_class = $animation_loading_effects;
} else {
	$animation_effect_class = '';
}

$animation_delay_class = null;
if ($animation_loading == "yes" && !empty($animation_delay)) {
	$animation_delay_class = ' data-delay="'.$animation_delay.'"';
}

// Carousel
$carousel_mode = null;
$carousel_data = null;
if ($team_layout == 'carousel-team') {
	$carousel_mode = ' carousel-enabled';
	$carousel_data = ' data-items="'.$carousel_team_item.'" data-navigation="'.$carousel_team_navigation.'" data-pagination="'.$carousel_team_pagination.'" data-autoplay="'.$carousel_team_autoplay.'" data-items-tablet="'.$carousel_team_item_tablet.'" data-items-mobile="'.$carousel_team_item_mobile.'"';
} else {
	$carousel_mode = null;
	$carousel_data = null;
}


// Run query
$my_query = new WP_Query($args);

$output .= '
<div class="row '.$team_full.$el_class.'">';
$output .= '
<div id="team-people" class="'.$team_layout.$carousel_mode.'" '.$carousel_data.'>';

$x= 0;

while($my_query->have_posts()) : $my_query->the_post();

if ($team_layout == 'grid-team' || $team_layout == 'carousel-team') {
	$classX = ($x%2) ? '' : '';
} else {
	$classX = ($x%2) ? ' reverse-layout' : '';
	$x++;
}

// Get the Attributes from Team
$attrs = get_the_terms( $post->ID, 'attributes' );
$attributes_fields = NULL;

if ( !empty($attrs) ){
 foreach ( $attrs as $attr ) {
   $attributes_fields[] = $attr->name;
 }
 
 $on_attributes = join( " / ", $attributes_fields );
}

$post_id = $my_query->post->ID;

$img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'team-thumb' );

$output .= '
<div class="single-people '.$team_columns_count.$classX.$animation_loading_class.$animation_effect_class.'"'.$animation_delay_class.'>';

if ($team_layout == 'grid-team' || $team_layout == 'carousel-team') {
	$output .= '
	<div class="team-post-thumb">
		<div class="team-post-hover">
			<a class="team-photo" href="'. get_permalink($post_id) .'" title="'. get_the_title() .'">
				<div class="team-naming">
					<h3>'. get_the_title() .'</h3>
					<span class="line"></span>
					<h4>'. $on_attributes .'</h4>
				</div>
			</a>
		</div>
		<img src="'. $img_thumb[0] .'" width="'.$img_thumb[1].'" height="'.$img_thumb[2].'" alt="'. get_the_title() .'" class="img-full-responsive" />
	</div>';
}
else {
	$output .= '
	<div class="team-post-thumb-listed">
		<a class="team-photo" href="'. get_permalink($post_id) .'" title="'. get_the_title() .'">
			<div class="team-post-image" style="background-image: url('.$img_thumb[0].');"><span class="overlay-bg-team"><i class="read-icon"></i></span></div>
			<div class="team-post-description">
				<div class="team-naming">
					<h3>'. get_the_title() .'</h3>
					<span class="line"></span>
					<h4>'. $on_attributes .'</h4>
				</div>
			</div>
		</a>
	</div>';
}

$output .= '
</div>';

endwhile;

wp_reset_query();

$output .= '
</div>';
$output .= '
</div>'.$this->endBlockComment('az_team_grid');

echo $output

?>