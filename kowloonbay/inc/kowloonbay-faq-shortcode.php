<?php

/* KowloonBay FAQ: shortcodes */
add_shortcode('faq', 'kowloonbay_faq_shortcode');

function kowloonbay_faq_shortcode()
{
	$cats = get_terms('kowloonbay_faq_cat', array('hide_empty' => 0, 'orderby' => 'slug'));

	global $kowloonbay_redux_opts;

	$html = '<p class="text-right margin-t-2x">';
		$html .= '<button type="button" class="letter-spacing btn btn-default accordian-expand"><i class="fa fa-plus"></i>'.$kowloonbay_redux_opts['misc_faq_label_expand_all'].'</button>';
		$html .= '<button type="button" class="letter-spacing btn btn-default accordian-collapse"><i class="fa fa-minus"></i>'.$kowloonbay_redux_opts['misc_faq_label_collapse_all'].'</button>';
	$html .= '</p>';


	$faq_count = 1;

	foreach ($cats as $c) {
		// print_r($c);
		$kowloonbay_faq_query = array(
			'posts_per_page'	=> '-1',
			'post_type'			=> 'kowloonbay_faq',
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order date',
			'paged'				=> '1',
			'tax_query' => array(
				array(
				'taxonomy' => 'kowloonbay_faq_cat',
				'field' => 'slug',
				'terms' => $c->slug
				),
			),
		);

		$kowloonbay_faq = new WP_Query( $kowloonbay_faq_query );

		$faq_cat = '<div class="row margin-v-1x">';
			$faq_cat .= '<div class="col-md-3">';
				$faq_cat .= '<h4 class="body-font uppercase margin-t-none margin-b-1x">'.esc_html($c->name).'</h4>';
			$faq_cat .= '</div>';
			$faq_cat .= '<div class="col-md-9">';
				$faq_cat .= '<div class="panel-group" id="accordion-'.esc_attr($c->term_id).'">';

		if ($kowloonbay_faq->have_posts()):
			while($kowloonbay_faq->have_posts()):
				$kowloonbay_faq->the_post();

				$faq_cat .= '<div class="panel panel-default">';
					$faq_cat .= '<div class="panel-heading">';
						$faq_cat .= '<h4 class="panel-title">';
							$faq_cat .= '<a data-toggle="collapse" data-parent="#accordion-'.esc_attr($c->term_id).'" href="#collapse'.esc_attr($faq_count).'">'. esc_html(get_the_title()) .'</a>';
						$faq_cat .= '</h4>';
					$faq_cat .= '</div>';
					$faq_cat .= '<div id="collapse'.esc_attr($faq_count).'" class="panel-collapse collapse">';
						$faq_cat .= '<div class="panel-body">';
							$faq_cat .= get_the_content();
						$faq_cat .= '</div>';
					$faq_cat .= '</div>';
				$faq_cat .= '</div>';
				
				$faq_count++;
			endwhile;
		endif;

		wp_reset_postdata();

				$faq_cat .= '</div>';
			$faq_cat .= '</div>';
		$faq_cat .= '</div>';

		$html .= $faq_cat;
	}


	return $html;
}