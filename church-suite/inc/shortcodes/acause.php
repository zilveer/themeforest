<?php
 function webnus_acause( $attributes, $content = null ) {
extract(shortcode_atts(	array(
	'post'=>'',
), $attributes));
	ob_start();		
	$args = array(
		'post_type' => 'cause',
		'posts_per_page' => 1,
		'p'	=> $post,
	);
	$query = new WP_Query($args);	
?>
<div class="container causes single-cause">
<?php	while ($query -> have_posts()) : $query -> the_post();	
		$post_id = get_the_ID();
		$cats = get_the_terms( $post_id , 'cause_category' );
		if(is_array($cats)){
			$cause_category = array();
			foreach($cats as $cat){
				$cause_category[] = $cat->slug;
			}
		}else $cause_category=array();
		$cats = get_the_terms($post_id, 'cause_category' );
		$cats_slug_str = '';
		if ($cats && ! is_wp_error($cats)) :
			$cat_slugs_arr = array();
		foreach ($cats as $cat) {
			$cat_slugs_arr[] = '<a href="'. get_term_link($cat, 'cause_category') .'">' . $cat->name . '</a>';
		}
		$cats_slug_str = implode( ", ", $cat_slugs_arr);
		endif;
	
		$category = ($cats_slug_str)?esc_html__('Category: ','webnus_framework') . $cats_slug_str:'';
		$date = get_the_time('F d, Y');
		$permalink = get_the_permalink();
		$image = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'sermons-gridmons-grid','echo'=>false, ) );
		$image2 = get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog2_thumb','echo'=>false, ) );	
		$title = '<h4><a class="cause-title" href="'.$permalink.'">'.get_the_title().'</a></h4>';
		$content ='<p>'.webnus_excerpt(64).'</p>';
		$view = '<div class="cause_view"><i class="fa-eye"></i>'.webnus_getViews($post_id).'</div>';
		$webnus_options = webnus_options();
		global $cause_meta;	
		$progressbar = $cause_days = $cause_donate = '';
		$received = $percentage = 0;
		$cause_meta_w = $cause_meta->the_meta();
		if($cause_meta_w){
			$received = $cause_meta_w['cause_amount_received'];
			$amount = $cause_meta_w['cause_amount']; 
			$end = $cause_meta_w['cause_end']; 
			$webnus_options['webnus_cause_currency'] = isset( $webnus_options['webnus_cause_currency'] ) ? $webnus_options['webnus_cause_currency'] : '';
			$currency = esc_html($webnus_options['webnus_cause_currency']);
		}
		if($amount) {
			$percentage = ($received/$amount)*100;
			$percentage = round($percentage);
			$out=$currency.$received.esc_html__(' RAISED OF ','webnus_framework').$currency.$amount;
			$progressbar = do_shortcode('[vc_pie value="'.$percentage.'" color="btn-warning" el_class="single-cause-pie" units="%" title="'.$out.'"]');
		}
		$now = date('Y-m-d 23:59:59');
		$now = strtotime($now);
		$end_date = $end.' 23:59:59';
		$your_date = strtotime($end_date);
		$datediff = $your_date - $now;
		$days_left = floor($datediff/(60*60*24)); 
		$date_msg = '';
		if($days_left==0) {$date_msg = '1';}
		elseif($days_left<0) {$date_msg = 'No';}
		else {$date_msg = $days_left+'1'.'';}
		$cause_days = ($percentage<100)?'<span>'.$date_msg.'</span> '.esc_html__('Days left to achieve target','webnus_framework'):esc_html__('Thank You','webnus_framework');
		echo '<article class="container"><div class="cause-content row">';
		echo '<div class="cause-progress col-md-4 col-sm-4">'.$progressbar.'</div>';
		echo '<div class="col-md-8 col-sm-8">'.$title.$content;
		$webnus_options['webnus_donate_form'] = isset( $webnus_options['webnus_donate_form'] ) ? $webnus_options['webnus_donate_form'] : '';
		if($days_left>=0 && $percentage<100 && $webnus_options['webnus_donate_form']){
			echo webnus_modal_donate();
		}else{
			echo '<p class="cause-completed">'.esc_html__('Has been completed','webnus_framework').'</p>';
		}	
		echo '<p class="cause-days">'.$cause_days.'</p></div></div></article>';
	endwhile;
		$out = ob_get_contents();
		ob_end_clean();	
		wp_reset_postdata();
		return $out;
	}
 add_shortcode('acause', 'webnus_acause');
?>