<?php
$post_type = get_post_meta($post->ID, 'link_type', true);
$video=get_post_meta(get_the_ID(),'name',true);
$project_gallery_images = get_post_meta(get_the_ID(), '_cmb_project_gallery_images', true);
$project_is_slider = get_post_meta(get_the_ID(), '_cmb_project_is_slider', true);
$project_is_thumb_include = get_post_meta(get_the_ID(), '_cmb_project_is_thumb_include', true);


if($post_type == 'single_page' && !empty($video) ) {
	
echo '<div class="embed-responsive embed-responsive-16by9">';
    echo wp_oembed_get($video);
echo '</div>';

}
elseif( $post_type == 'single_page' && !empty($project_gallery_images) ) {

    $images_output = $slider_wrapper = $thumbnail_url = $thumbnail = '';
    $thumbnail_url .= wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );


    if( $thumbnail_url != '' && $project_is_thumb_include == 'on'){

        $images_output .= '<div class="item"><img width="100%" src="'.$thumbnail_url.'" alt="'.get_the_title().'"></div>';
    }

    foreach ($project_gallery_images as $img){
        $images_output .= '<div class="item"><img width="100%" src="'.$img.'" alt=""></div>';
    }

    if( $post_type == 'single_page' && !empty($project_gallery_images) && $project_is_slider == 'on' ){

        $slider_wrapper .= '<div id="owl-project-single" class="owl-carousel owl-project owl-theme">';
        $slider_wrapper .= $images_output;
        $slider_wrapper .= '</div>';

        echo $slider_wrapper;

    }else{
        echo $images_output;
    }

}
elseif( $post_type == 'single_page' && empty($project_gallery_images) && empty($video ) ) {

    $thumbnail_url = $thumbnail = '';

    $thumbnail_url .= wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
    $thumbnail .= '<img width="100%" src="'.$thumbnail_url.'" alt="'.get_the_title().'">';

    echo $thumbnail;

}?>