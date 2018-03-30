<?php
function webnus_asermon( $attributes, $content = null ) {
extract(shortcode_atts(	array(
	'post'=>'',
	'type'=>'latest',
	'style'=>'',
	'box_title'=>'',
), $attributes));
	ob_start();	
	$w_post = ($type=='custom')?'&p='.$post:'&posts_per_page=1';
	$query = new WP_Query('post_type=sermon'.$w_post);
	if ($query -> have_posts()) : $query -> the_post();
	
	//terms		
		$post_id = get_the_ID();
		$terms = get_the_terms( $post_id , 'sermon_speaker' );
		if(is_array($terms)){
			$sermon_speaker= array();
			foreach($terms as $term){
				$sermon_speaker[] = $term->slug;
			}
		}else $sermon_speaker=array();
		$terms = get_the_terms(get_the_id(), 'sermon_speaker' );
		$terms_slug_str = '';
		if ($terms && ! is_wp_error($terms)) :
			$term_slugs_arr = array();
		foreach ($terms as $term) {
			$term_slugs_arr[] = $term->name;
		}
		$terms_slug_str = implode( ", ", $term_slugs_arr);
		endif;
		
		$content ='<p>'.webnus_excerpt(28).'</p>';
		$date = get_the_time('F d, Y');
		$sep2 = ($date && $terms_slug_str )?' | ':'';
		$speaker = ($terms_slug_str)?esc_html__('Speaker: ','webnus_framework') . $terms_slug_str:'';
		$title = get_the_title();
		$permalink = get_the_permalink();
		$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'sermons-grid','echo'=>false, ) );
		$button=($style=='hasbutton')?'button dark-gray medium':'';
		global $sermon_meta;
		$w_sermon_meta = $sermon_meta->the_meta();
		if(!empty($w_sermon_meta)){
		$sermon_video = (array_key_exists('sermon_video',$w_sermon_meta))?'<a href="'.$w_sermon_meta['sermon_video'].'" class="fancybox-media '.$button.'" target="_self"><i class="fa-play-circle"></i>'.esc_html__('WATCH','webnus_framework').'</a>':'';
		$sermon_audio = (array_key_exists('sermon_audio',$w_sermon_meta))?'<a href="#w-audio-'.$post_id.'" class="inlinelb '.$button.'" target="_self"><i class="fa-headphones"></i>'.esc_html__('LISTEN','webnus_framework').'</a><div style="display:none"><div class="w-audio" id="w-audio-'.$post_id.'">'.do_shortcode('[audio mp3="'.$w_sermon_meta['sermon_audio'].'"][/audio]').'</div></div>':'';
		$sermon_pdf = (array_key_exists('sermon_pdf',$w_sermon_meta))?'<a class="'.$button.'" href="'.$w_sermon_meta['sermon_pdf'].'" target="_blank"><i class="fa-download"></i>'.esc_html__('DOWNLOAD','webnus_framework').'</a>':'';
		}else{
			$sermon_audio=$sermon_video=$sermon_pdf='';
		}
		$sermon_read ='<a class="'.$button.'" href="'.$permalink.'" target="_self"><i class="fa-book"></i>'.esc_html__('READ MORE','webnus_framework').'</a>';
		if($style=='boxed'){
			echo '<article class="a-sermon-boxed">';
			echo '<div class="sermon-boxed-top"><i class="fa-microphone"></i>';
			echo($box_title)?'<h3>'.$box_title.'</h3>':'';
			echo '</div><h4><a href="'.$permalink.'">'.$title.'</a></h4><div class="sermon-detail">'.$speaker.'<br>'.$date.'</div>';
			echo (!empty($w_sermon_meta))?'<div class="media-links">'. $sermon_audio . $sermon_video . $sermon_pdf.'</div>':'';
			echo '</article>';
		}else{
			echo '<article class="a-sermon"><div class="sermon-detail">'.$speaker.$sep2.$date.'</div><h4><a href="'.$permalink.'">'.$title.'</a></h4>';
			echo ($image)?'<figure class="sermon-img">'.$image.'</figure>':'';
			echo $content;
			echo (!empty($w_sermon_meta))?'<div class="media-links">'. $sermon_audio . $sermon_video . $sermon_pdf.'</div>':'';
			echo '</article>';
		}
		
	endif;
	$out = ob_get_contents();
	ob_end_clean();	
	wp_reset_postdata();
	return $out;
 }
 add_shortcode('asermon', 'webnus_asermon');
?>