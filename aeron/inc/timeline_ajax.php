<?php

function abdev_get_timeline_posts(){

	$page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
	$cat = (isset($_POST['cat'])) ? $_POST['cat'] : '';
	$read_more = __('Read More','ABdev_aeron').' <i class="ci_icon-forward"></i>';

	$the_query = new WP_QUery(array(
		'paged'    => $page,
		'cat'      => $cat,
	));


	$output = '';

	if ($the_query -> have_posts()) :  while ($the_query -> have_posts()) : $the_query -> the_post();
		$output .= '<div class="'. implode(' ', get_post_class('timeline_post timeline_appended')).'">';

		$custom = get_post_custom();

		if(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='soundcloud' && isset($custom['ABdevFW_soundcloud'][0]) && $custom['ABdevFW_soundcloud'][0]!=''){
			$output .= '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="'.esc_url('https://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F'.$custom['ABdevFW_soundcloud'][0].'').'"></iframe>';
		}
		elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='youtube' && isset($custom['ABdevFW_youtube_id'][0]) && $custom['ABdevFW_youtube_id'][0]!=''){
			$output .= '<div class="videoWrapper-youtube"><iframe src="'.esc_url('http://www.youtube.com/embed/'.$custom['ABdevFW_youtube_id'][0].'?showinfo=0&amp;autohide=1&amp;related=0').'" frameborder="0" allowfullscreen></iframe></div>';
		}
		elseif(isset($custom['ABdevFW_selected_media'][0]) && $custom['ABdevFW_selected_media'][0]=='vimeo' && isset($custom['ABdevFW_vimeo_id'][0]) && $custom['ABdevFW_vimeo_id'][0]!=''){
			$output .= '<div class="videoWrapper-vimeo"><iframe src="'.esc_url('http://player.vimeo.com/video/'.$custom['ABdevFW_vimeo_id'][0].'?title=0&amp;byline=0&amp;portrait=0').'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
		}
		else{
			$output .= get_the_post_thumbnail();
		}

		$output .='<div class="timeline_postmeta">
				<h2><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h2>
				<i class="icon-calendar"></i> <span class="date">'.get_the_date().'</span> 
				<i class="icon-user"></i> '.the_author_posts_link().'
				'.get_the_tags( '<i class="icon-tags"></i>',', ', ' ').'
			</div>
			<div class="timeline_content">
				<p>'.get_the_content($read_more).'</p>
			</div>
		</div>';

	endwhile;
	endif;
	wp_reset_postdata();
	die($output);

}

add_action('wp_ajax_abdev_get_timeline_posts', 'abdev_get_timeline_posts');
add_action('wp_ajax_nopriv_abdev_get_timeline_posts', 'abdev_get_timeline_posts');