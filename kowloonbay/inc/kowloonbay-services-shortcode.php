<?php

/* KowloonBay Services: shortcodes */
add_shortcode('services', 'kowloonbay_services_shortcode');

function kowloonbay_services_shortcode()
{
	global $kowloonbay_allowed_html;

	global $kowloonbay_redux_opts;
	$list_mode = $kowloonbay_redux_opts['misc_services_listing_mode'];
	if ($list_mode !== 'vertical') $list_mode = 'horizontal';
	
	$kowloonbay_services_query = array(
		'posts_per_page'	=> '-1',
		'post_type'			=> 'kowloonbay_service',
		'order'				=> 'ASC',
		'orderby'			=> 'menu_order date',
		'paged'				=> '1',
	);
	$kowloonbay_services = new WP_Query( $kowloonbay_services_query );

	$firstList = '';
	$secondList = '';
	$html = '';

	if ($kowloonbay_services->have_posts()):
		while($kowloonbay_services->have_posts()):
			$kowloonbay_services->the_post();
			$kowloonbay_service_desc = rwmb_meta( 'kowloonbay_service_desc');
			$kowloonbay_service_use_icon = rwmb_meta( 'kowloonbay_service_use_icon');
			$kowloonbay_service_icon_fa = rwmb_meta( 'kowloonbay_service_icon_fa');
			$kowloonbay_service_icon_img = rwmb_meta( 'kowloonbay_service_icon_img',array('type'=>'image_advanced') );
			$kowloonbay_service_icon_img = reset($kowloonbay_service_icon_img);
			$kowloonbay_service_disable_service_details = rwmb_meta( 'kowloonbay_service_disable_service_details');
			$kowloonbay_service_disable_service_details = $kowloonbay_service_disable_service_details === '1';
			$permalink = get_permalink(get_the_id());

			if ($list_mode === 'vertical'){
				$li = '<li class="'. esc_attr($kowloonbay_service_disable_service_details ?  '' : 'clickable-block') .'">';
					$li .= '<div class="item-icon">';
						if ($kowloonbay_service_use_icon === 'fa')
							$li .= '<i class="fa '. esc_attr($kowloonbay_service_icon_fa) .' fa-custom-lg primary-color"></i>';
						else
							$li .= '<img src="'.esc_url($kowloonbay_service_icon_img['full_url']).'" alt="">';
					$li .= '</div>';
					$li .= '<div class="item-desc">';
						$li .= '<h5 class="uppercase margin-t-none margin-b-half">';
							if (!$kowloonbay_service_disable_service_details){
								$li .= '<a class="clickable-block-link" href="'.esc_url($permalink).'">';
							}
							$li .= esc_html(get_the_title());
							if (!$kowloonbay_service_disable_service_details){
								$li .= '</a>';
							}
						$li .= '</h5>';
						$li .= '<div>'.wp_kses($kowloonbay_service_desc, $kowloonbay_allowed_html).'</div>';
					$li .= '</div>';
				$li .= '</li>';

				if ($kowloonbay_services->current_post * 2 < $kowloonbay_services->post_count) {
					$firstList .= $li;
				} else {
					$secondList .= $li;
				}
			} else{
				$is_last_row = false;
				$is_last_item = $kowloonbay_services->current_post === $kowloonbay_services->post_count - 1;
				
				if ($kowloonbay_services->current_post % 2 === 0) {
					if ($kowloonbay_services->current_post === $kowloonbay_services->post_count - 2) {
						$is_last_row = true;
					}
					$html .= '<div class="row wow-array '. ($is_last_row ? '' : 'padding-b-2x-md') .'">';
				}
						$html .= '<div class="col-md-6 '. ($is_last_item ? '' : 'padding-b-1x') .' padding-b-none-md '. esc_attr($kowloonbay_service_disable_service_details ?  '' : 'clickable-block') .'">';
							$html .= '<div class="item-icon">';
								if ($kowloonbay_service_use_icon === 'fa')
									$html .= '<i class="fa '. esc_attr($kowloonbay_service_icon_fa) .' fa-custom-lg primary-color"></i>';
								else
									$html .= '<img src="'.esc_url($kowloonbay_service_icon_img['full_url']).'" alt="">';
							$html .= '</div>';
							$html .= '<div class="item-desc">';
								$html .= '<h5 class="uppercase margin-t-none margin-b-half">';
									$html .= $kowloonbay_service_disable_service_details ?  '' : '<a class="clickable-block-link" href="'.esc_url($permalink).'">';
									$html .= esc_html(get_the_title());
									$html .= $kowloonbay_service_disable_service_details ?  '' : '</a>';
									$html .= '</h5>';
								$html .= '<div>'.wp_kses($kowloonbay_service_desc, $kowloonbay_allowed_html).'</div>';
							$html .= '</div>';
						$html .= '</div>';
				if ($kowloonbay_services->current_post % 2 === 1) {
					$html .= '</div>';
				}
			}
		endwhile;
	endif;

	if ($list_mode === 'vertical'){
		$html .= '<div class="row margin-v-3x wow-array">';
			$html .= '<div class="col-md-6">';
				$html .='<ul class="item-list">';
					$html .= $firstList;
				$html .='</ul>';
			$html .= '</div>';
			$html .= '<div class="col-md-6">';
				$html .='<ul class="item-list">';
					$html .= $secondList;
				$html .='</ul>';
			$html .= '</div>';
		$html .= '</div>';
	} else{
		$html = '<div class="margin-v-3x">'. $html .'</div>';
	}


	wp_reset_postdata();

	return $html;
}