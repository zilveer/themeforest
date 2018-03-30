<?php

// Projects gallery

function th_projects_gallery($atts, $content = null) {
    extract(shortcode_atts(array(
        "src" => '',
        "url" => '',
        "target" => '_self',
        "title" => 'Project title',
        "description" => 'Project description',
        "el_class" => '',
    ), $atts));


    $image = wp_get_attachment_image_src($src, array(634, 634));
    if(isset($image[0]) and $image[0]){
        $image = '<img src="'.$image[0].'" alt="'.$title.'" />';
    } else {
        $image = '<img src="http://placehold.it/450x450" width="450" height="450" alt="placeholder450x450">';
    }

    $output = '
                <div class="project-inner '.$el_class.'">
                    <a href="'.$url.'" target="'.$target.'">
                        <!-- Image -->
                         '.$image.'
                        <div class="project-caption">
                            <!-- Title and Date -->
                            <div class="project-details">
                                <h3>'.$title.'</h3>
                                <p>'.$description.'</p>
                            </div>
                        </div>
                    </a>
                </div>';




return $output;

}

remove_shortcode('projects-gallery');
add_shortcode('projects-gallery', 'th_projects_gallery');