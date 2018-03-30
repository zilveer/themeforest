<?php
function faq($atts)
{
    extract(shortcode_atts(array(
        'text'       => '',
        'content'       => '',
        'number'       => '5'
    ), $atts));
    
    $service_return = '';
        $ser_args1 = array(
            'post_type'         => array('faq'),
            'post_status'       => array('publish'),
            'orderby'           => 'DESC',
            'order'             => 'date',
            'posts_per_page'    => $number
        );
        query_posts($ser_args1);
        if(have_posts())
        {
            $service_return .= '
			<div class="panel-group" id="faq">
				<h3 class="uppercase">'.esc_html($text).'</h3>
				<p>'.esc_html($content).'</p>';
            $last = 1;
            while (have_posts()): the_post();
                $content = substr(get_the_content(), 0, 100);
                $service_return .= '
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#faq" href="#'.get_the_ID().'" class="collapsed">
									<i class="fa fa-2x fa-plus-circle"></i> '.get_the_title().'
								</a>
						  </h4>
						</div>
						<div id="'.get_the_ID().'" class="panel-collapse collapse">
							<div class="panel-body">
								<p class="small" style="color: rgb(46, 46, 46);">'.get_the_content().'</p>
							</div>
						</div>
					</div>';
                $last++;
            endwhile;
            $service_return .= '</div>';
        }
        else
        {
			$features_return .= '<div class="col-lg-12 text-center">';
				$features_return .= '<h1 class="common_main_heading">Please Insert Some <span>FAQ</span> First.</h1>';
			$features_return .= '</div>';
        }
        wp_reset_query();
    return $service_return;
}
add_shortcode( "rms-faq", "faq" );