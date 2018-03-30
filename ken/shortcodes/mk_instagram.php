<?php

extract( shortcode_atts( array(
			'el_class' => '',
			'size' => 'thumbnail',
			'sort_by' => 'most-recent',
			'tag_name' => 's',
			'instagram_id' => '',
			'access_token' => '',
			'count' => 6,
			'column' => 'one'
		), $atts ) );

wp_enqueue_script( 'instafeed' );

$id = Mk_Static_Files::shortcode_id();

echo '<div id="instagram-feeds-'.$id.'" class="mk-instagram-feeds '.$el_class.'" data-size="'.$size.'" data-sort="'.$sort_by.'" data-count="'.$count.'" data-userid="'.$instagram_id.'" data-accesstoken="'.$access_token.'" data-column="'.$column.'"></div>';
