<?php

// Team Member

function th_team_member($atts, $content=false)
{
    extract(shortcode_atts(array(
        "name" => 'John Doe',
        "description" => 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium.',
        "position" => '',
        "src" => '',
        "facebook" => '',
        "twitter" => '',
        "behance" => '',
        "linkedin" => '',
        "envelope" => '',
		"th_social_target" => '',
    ), $atts));

    $icon_arr = array('facebook', 'twitter', 'behance', 'linkedin', 'envelope');
    $envelope ='';
	$socials ='';

    foreach ($icon_arr as $icon_name) {
        if (isset($atts[$icon_name])) {
            if($atts[$icon_name] == 'envelope'){
                $socials .= '<a href="mailto:'.$atts[$icon_name].'"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-'.$icon_name.' fa-stack-1x fa-inverse"></i></span></a>';
            }else{
            $socials .= '<a target="'.$th_social_target.'" href="'.$envelope.$atts[$icon_name].'"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-'.$icon_name.' fa-stack-1x fa-inverse"></i></span></a>';
            }
        }
    }

    $image = wp_get_attachment_image_src($src, array(650, 500));
    if(isset($image[0]) and $image[0]){
        $image = '<img src="'.$image[0].'" alt="'.$name.'" class="img-circle" />';
    } else {
        $image = '<img src="http://placehold.it/350x350" width="350" height="350" alt="placeholder350x350">';
    }


    return '<!-- Team Item (name, information about, image, social icons) -->
            <div class="team-inner">
                <!-- Image -->
                ' . $image . '
                <div class="team-caption">
                    <!-- Social Icons -->
                    <div class="t-social-holder">
                        <div class="team-social">
                            '.$socials.'
                        </div>
                    </div>
                </div>                
            </div>
            <div class="team-details text-center">
                <!-- Info -->
                <h5>'.$position.'</h5>
                <!-- Name -->
                <h3>'.$name.'</h3>
                <p>'.$description.'</p>
            </div>';

}

remove_shortcode('team_member');
add_shortcode('team_member', 'th_team_member');