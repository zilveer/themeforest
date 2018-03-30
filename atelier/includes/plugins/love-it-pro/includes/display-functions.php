<?php
function lip_love_it_link($post_id = null, $echo = true, $text = "", $wrap_class = "") {

	global $user_ID, $post;

	if(is_null($post_id)) {
		$post_id = $post->ID;
	}

	global $sf_options;
	$loveit_icon = "";
	if ( isset($sf_options['loveit_icon']) ) {
	$loveit_icon = $sf_options['loveit_icon'];
	}
	$loveit_text = $sf_options['loveit_text'];
	$icon = "";

	if (isset($loveit_icon) && $loveit_icon != "") {
		$icon = '<i class="'.$loveit_icon.'"></i>';
	} else {
		$icon = '<svg version="1.1" class="loveit-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
		<g>
			<path fill="none" class="stroke" stroke="#252525" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="
				M5.631,24H2.021C1.459,24,1,23.541,1,22.975V2.025C1,1.459,1.459,1,2.021,1h25.957C28.543,1,29,1.459,29,2.025v20.949
				C29,23.541,28.543,24,27.979,24h-3.316"/>
			<path fill="#252525" class="fill" d="M19.994,22.895c-0.053-0.888-0.436-1.71-1.043-2.214C18.438,20.253,17.756,20,17.074,20
				c-1.035,0-1.684,0.45-2.068,1.009C14.611,20.45,13.961,20,12.926,20c-0.682,0-1.363,0.253-1.875,0.681
				c-0.609,0.504-0.992,1.326-1.045,2.214c-0.043,0.757,0.139,1.908,1.248,3.082c1.875,2.007,3.367,3.618,3.389,3.629L15.006,30
				l0.361-0.395c0.012-0.011,1.504-1.622,3.381-3.629C19.857,24.803,20.037,23.651,19.994,22.895z"/>
		</g>
		</svg>';
	}

	// retrieve the total love count for this item
	$love_count = lip_get_love_count($post_id);

	if ($text != "") {
		$text = ' ' .$loveit_text;
	}

	if ( sf_theme_opts_name() == "sf_atelier_options" ) {
		$text = "";
	}

	ob_start();

	// our wrapper DIV
	echo '<div class="love-it-wrapper '.$wrap_class.'">';

		if (!lip_user_has_loved_post($user_ID, $post_id)) {
			echo '<a href="#" class="love-it" data-post-id="' . $post_id . '" data-user-id="' .  $user_ID . '">' . $icon . '<span class="love-count"><data class="count" value="">' . $love_count . '</data>' . $text .'</span></a>';
		} else {
			echo '<a href="#" class="love-it loved" data-post-id="' . $post_id . '" data-user-id="' .  $user_ID . '">' . $icon . '<span class="love-count"><data class="count" value="">' . $love_count . '</data>' . $text .'</span></a>';
		}

	// close our wrapper DIV
	echo '</div>';

	if($echo)
		echo apply_filters('lip_links', ob_get_clean() );
	else
		return apply_filters('lip_links', ob_get_clean() );
}


function lip_love_it_nolink($post_id = null, $link_text, $already_loved, $echo = true) {

	global $user_ID, $post;

	if(is_null($post_id)) {
		$post_id = $post->ID;
	}

	// retrieve the total love count for this item
	$love_count = lip_get_love_count($post_id);

	ob_start();

	// our wrapper DIV
	echo '<div class="love-it-wrapper">';

		// show a message to users who have already loved this item
		echo '<span class="loved">' . $already_loved . ' <span class="love-count">' . $love_count . '</span></span>';

	// close our wrapper DIV
	echo '</div>';

	if($echo)
		echo apply_filters('lip_links', ob_get_clean() );
	else
		return apply_filters('lip_links', ob_get_clean() );
}