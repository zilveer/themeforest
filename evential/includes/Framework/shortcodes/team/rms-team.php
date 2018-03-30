<?php
function team($atts)
{
    extract(shortcode_atts(array(
        'member'       => '3'
    ), $atts));
    
    $team_return = '';
	
        $args1 = array(
            'post_type'         => array('team'),
            'post_status'       => array('publish'),
            'posts_per_page'    => $member,
            'orderby'           => 'date',
            'order'             => 'DESC'
        );
        
        query_posts($args1);
        if(have_posts())
        {
            
		$team_return .= '<div class="col-lg-12"><div class="row">';
            while(have_posts())
            {
                the_post();
                $des1 = get_post_meta(get_the_ID(), 'designation', TRUE);
				if($des1 != '')
				{
					$desig = $des1;
				}
				else
				{
					$desig = '';
				}
				
				$ida = get_post_thumbnail_id( get_the_ID() );
				if(has_post_thumbnail( get_the_ID() ))
				{
					$team_thumb = get_the_post_thumbnail(get_the_ID(), 'team_thumb');
				}
				else
				{
					$team_thumb = '<img src="http://placehold.it/360x270" alt="Reorder">';
				}
				$team_return .='
				<div class="speaker col-xs-12 col-sm-4 col-md-3 col-lg-3">
					<figure>
						<img class="img-responsive" src="'.wp_get_attachment_url($ida).'" alt="">
						<figcaption>
							<h4>'.get_the_title().'</h4> 
							<p>'.substr(get_the_content(), 0, 200).'</p>
							<a data-toggle="modal" href="#speaker_modal_'.  get_the_ID().'">
								<i class="fa fa-2x fa-external-link"></i>
							</a>
							<div class="social">';
							$fa = get_post_meta(get_the_ID(), 'facebook', true); if($fa != '') { 
								$team_return .='<a target="blank" href="http://www.facebook.com/'.$fa.'" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a>';
							} 
							$tw = get_post_meta(get_the_ID(), 'twitter', true); if($tw != '') { 
								$team_return .='<a target="blank" href="http://www.twitter.com/'.$tw.'/" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>';
							}
							$gp = get_post_meta(get_the_ID(), 'google', true); if($gp != '') { 
								$team_return .='<a target="blank" href="http://www.plus.google.com/'.$gp.'" target="_blank"><i class="fa fa-2x fa-google-plus-square"></i></a>';
							}
							$lin = get_post_meta(get_the_ID(), 'linkedin', true); if($lin != '') { 
								$team_return .='<a target="blank" href="http://www.linkedin.com/in/'.$lin.'/" target="_blank"><i class="fa fa-2x fa-linkedin-square"></i></a>';
							}
							$team_return .='</div>
						</figcaption>
					</figure>
					
					<h4>'.get_the_title().'</h4>
					<span class="title">'.substr($desig, 0, 100).'</span>
				</div>
				<div class="modal fade portfoliomodal" id="speaker_modal_'.get_the_ID().'" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="portfolio-overlay container">
						<div class="modal-dialog">
							<div class="modal-content" style="border-radius: 0;">
								<div class="modal-body">
									<button type="button" class="btn btn-default" data-dismiss="modal" style="float: right;border: 0px none;font-weight: 900;">X</button>
									<div class="speaker-detail">
										<div class="row">
											
											<div class="col-md-4 col-lg-4">
												<img class="img-responsive" src="'.wp_get_attachment_url($ida).'" alt=""><br>';
												$fa = get_post_meta(get_the_ID(), 'facebook', true); if($fa != '') { 
													$team_return .='<i style="width: 16px;height: 16px;" class="fa fa-lg fa-facebook"></i><a target="blank" href="http://www.facebook.com/'.$fa.'" target="_blank">'.$fa.'</a><br>';
												} 
												$tw = get_post_meta(get_the_ID(), 'twitter', true); if($tw != '') { 
													$team_return .='<i style="width: 16px;height: 16px;" class="fa fa-lg fa-twitter"></i><a target="blank" href="http://www.twitter.com/'.$tw.'/" target="_blank">'.$tw.'</a><br>';
												}
												$gp = get_post_meta(get_the_ID(), 'google', true); if($gp != '') { 
													$team_return .='<i style="width: 16px;height: 16px;" class="fa fa-lg fa-google-plus"></i><a target="blank" href="http://www.plus.google.com/'.$gp.'" target="_blank">'.$gp.'</a><br>';
												}
												$lin = get_post_meta(get_the_ID(), 'linkedin', true); if($lin != '') { 
													$team_return .='<i style="width: 16px;height: 16px;" class="fa fa-lg fa-linkedin"></i><a target="blank" href="http://www.linkedin.com/in/'.$lin.'/" target="_blank">'.$lin.'</a><br>';
												}
											$team_return .= '</div>
												
											<div class="col-md-8 col-lg-8">
												<h2>'.get_the_title().'</h2>
												<h3>'.esc_html($desig).'</h3>
												<p>'.get_the_content().'</p>
											</div>
										
										</div>
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
				</div>';
            }
		$team_return .= '</div></div>';
        }
        else
        {
            $team_return .= '<div class="col-lg-12 text-center">';
                $team_return .= '<h1 class="common_main_heading">Please Insert Some <span>Speaker</span> First.</h1>';
            $team_return .= '</div>';
        }
        wp_reset_query();
    
    return $team_return;
}
add_shortcode( "rms-team", "team" );