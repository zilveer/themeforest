<?php
function event($atts)
{
    extract(shortcode_atts(array(
		'text'       => '',
        'content'       => '',
        'number'       => '5'
    ), $atts));
    
    $service_return = '';
        $ser_args1 = array(
            'post_type'         => array('event'),
            'post_status'       => array('publish'),
            'orderby'           => 'DESC',
            'order'             => 'date',
            'posts_per_page'    => $number
        );
        query_posts($ser_args1);
        if(have_posts())
        {
            $service_return .= '<div id="gallery"><h3 class="uppercase">'.esc_html($text).'</h3><p>'.esc_html($content).'</p>';
			$service_return .= '<div class="row">';
            $last = 1;
            while (have_posts()): the_post();
			
				$ida = get_post_thumbnail_id( get_the_ID() );
                if(has_post_thumbnail())
                {
                    $thumgevent = get_the_post_thumbnail(get_the_ID(), 'portfolio');
                }
                else
                {
                    $thumgevent = '<img alt="" src="http://placehold.it/240x200" alt="ThemeOnLab"/>';
                }
				
                $service_return .= '
					<a class="image-link col-xs-12 col-md-4 col-lg-4" href="'.wp_get_attachment_url($ida).'"><img class="img-responsive" src="'.wp_get_attachment_url($ida).'" alt=""></a>';
                $last++;
            endwhile;
            $service_return .= '</div>';
            $service_return .= '</div>';
        }
        else
        {
			$features_return .= '<div class="col-lg-12 text-center">';
				$features_return .= '<h1 class="common_main_heading">Please Insert Some <span>Past Event</span> First.</h1>';
			$features_return .= '</div>';
        }
        wp_reset_query();
    return $service_return;
}
add_shortcode( "rms-event", "event" );