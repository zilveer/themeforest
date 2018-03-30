<?php
function schedule($atts)
{
    extract(shortcode_atts(array(
        'number'           => '3'
    ), $atts));
    
    $pro = '';
        $filter_cat = array(
            'orderby'       => 'id',
            'order'         => 'ASC', 
            'hide_empty'    => 0,
            'hierarchical'  => 1,
            'taxonomy'      => 'schedule_cat'
        );
        $pro .= '<div id="tabs">';
        $categoriess = get_categories( $filter_cat );
        $pro .= '<ul>';
        global $tlazya_evential;
		$opt_switch = '';
        if($tlazya_evential['opt-switch'] == 1){
        	$opt_switch = $tlazya_evential['opt-switch'];
        }
		$x=1; 
        foreach($categoriess as $cat)
        {
        	$days_div = ($opt_switch) ? '<h5>Day '.esc_html($x).'</h5>' : '';
            $pro .= '<li class="item uppercase"><a class="uppercase hidden-xs" href="#'.$cat->slug.'"><span>'.$cat->name.'</span>'.$days_div.'</a></li>';
            $pro .= '';
			$x++;
        }
        $pro .= '</ul>';
		
        $categories = get_terms('schedule_cat');
		foreach( $categories as $category ):
			$pro .= '<div id="'.$category->slug.'" class="tabs-content">';
			$posts = get_posts(array(
				'post_type' => 'schedule',
				'taxonomy' => $category->taxonomy,
				'term' => $category->slug,
				'order' => 'DESC', 
				'nopaging' => true, 
			));
			foreach($posts as $post): 
			$icon = get_post_meta($post->ID, 'iclass', true);
			if($icon != '')
			{
				$sicon = '<i class="fa fa-2x '.$icon.'"></i>';
			}
			else
			{
				$sicon = '<i class="fa fa-2x fa-clock-o"></i>';
			}
			$time = get_post_meta($post->ID, 'stime', true);
			if($time != '')
			{
				$stime = '<span class="time">'.$time.'</span>';
			}
			else
			{
				$stime = '<span class="time">Set The Time</span>';
			}
			setup_postdata($post);
			$pro .= '<div class="event">
						<div class="event-inner">
							<div class="icon">
								'.$sicon.'
								'.$stime.'
							</div>
							
							<div class="description">
								<h3>'.get_the_title($post->ID).'</h3>
								<p>'.get_the_content().'</p>
								<span class="name">'.get_post_meta($post->ID, 'tname', true).'</span>
							</div>
						</div>
					</div>';
			endforeach;
			
			$pro .= '</div>';
			
		endforeach;	
		$pro .= '</div>';
    return $pro;
}
add_shortcode( "rms-schedule", "schedule" );