<?php
function webnus_speakers( $attributes, $content = null ) {
	extract(shortcode_atts(	array(
		'hide'=>'',
	), $attributes));
		ob_start();		
	echo '<div class="container sermons-speakers">';
	$tax = 'sermon_speaker';
	$hide_empty = ($hide)?true:false;
	$terms = get_terms( $tax, array('hide_empty' => $hide_empty,));
	$speaker_counter = 0;
	foreach( $terms as $term ) {
		if ($speaker_counter == 0){
			echo '<div class="row">';
		}
		$speaker_counter++;
		$sermons_count = $term->count;
		$speaker_detail = term_description( $term->term_id, $tax );		
		if ( $sermons_count > 1 ) {
		$w_sermons_count = '<a href="'. get_term_link( $term ) .'">'. str_replace( '%', number_format_i18n( $sermons_count ), __( '% Sermons', 'webnus_framework' )) .'</a>';
		} elseif ( $sermons_count == 0 ) {
		$w_sermons_count = __( 'No Sermons', 'webnus_framework' );
		} else {
		$w_sermons_count = '<a href="'. get_term_link( $term ) .'">'. __( '1 Sermon', 'webnus_framework' ) .'</a>';
		}
		echo '<div class="col-md-4"><article class="our-team">';
		if (function_exists('z_taxonomy_image_url') ){
			echo '<figure><img width="80" src="' . z_taxonomy_image_url($term->term_id,array(300, 300), TRUE) . '"></figure>';
		}
		echo '<h2>'. $term->name .'</h2><h5>'. $w_sermons_count .'</h5>'. $speaker_detail .'</article></div>';
		if ($speaker_counter == 3){
			echo '</div>';
			$speaker_counter = 0;
		}
	}
	if ($speaker_counter != 0){ // if row not full
		echo '</div>'; //close row
	}
	echo '</div>';	
	$out = ob_get_contents();
	ob_end_clean();	
	wp_reset_postdata();
	return $out;
}
add_shortcode('speakers', 'webnus_speakers');
?>