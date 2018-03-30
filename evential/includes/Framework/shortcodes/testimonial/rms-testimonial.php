<?php
function testimonial($atts)
{
    extract(shortcode_atts(array(
        'number'       => '5'
    ), $atts));
    
    $testimonial_return = '';
        $ser_args1 = array(
            'post_type'         => array('testimonial'),
            'post_status'       => array('publish'),
            'orderby'           => 'DESC',
            'order'             => 'date',
            'posts_per_page'    => $number
        );
        query_posts($ser_args1);
        if(have_posts())
        {
            $testimonial_return .= '<div id="quote" class="owl-carousel owl-theme">';
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
				
                $testimonial_return .= '
					<div class="item text-center">
						<img class="img-circle" src="'.wp_get_attachment_url($ida).'" alt="">
						<div>
							<p>'.get_the_content().'</p>
							<h4 class="uppercase">'.get_the_title().'</h4>
						</div>
					</div>';
                $last++;
            endwhile;
            $testimonial_return .= '</div>';
        }
        else
        {
			$features_return .= '<div class="col-lg-12 text-center">';
				$features_return .= '<h1 class="common_main_heading">Please Insert Some <span>FAQ</span> First.</h1>';
			$features_return .= '</div>';
        }
        wp_reset_query();
    return $testimonial_return;
}
add_shortcode( "rms-testimonial", "testimonial" );