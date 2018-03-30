<?php


/*
 * Register custom post type for special use
 */
if(!function_exists('a13_cpt_work_register')){
    function a13_cpt_work_register(){
        global $apollo13;

        $labels = array(
            'name' =>           __be( 'Works' ),
            'singular_name' =>  __be( 'Work' ),
            'add_new' =>        __be( 'Add New' ),
            'add_new_item' =>   __be( 'Add New Work' ),
            'edit_item' =>      __be( 'Edit Work' ),
            'new_item' =>       __be( 'New Work' ),
            'view_item' =>      __be( 'View Work' ),
            'search_items' =>   __be( 'Search Works' ),
            'not_found' =>      __be( 'Nothing found' ),
            'not_found_in_trash' => __be( 'Nothing found in Trash' ),
            'parent_item_colon' => ''
        );

        $supports = array( 'title','thumbnail','editor' );
        if($apollo13->get_option('cpt_work', 'comments') == 'on')
            array_push($supports, 'comments');

        $args = array(
            'labels' => $labels,
            'public' => true,
            'query_var' => true,
            'menu_position' => 5,
            'rewrite' =>  array('slug' => A13_CUSTOM_POST_TYPE_WORK_SLUG),
            'supports' => $supports,
        );

        register_post_type( A13_CUSTOM_POST_TYPE_WORK , $args );

        $genre_labels = array(
            'name' => __be( 'Work Categories' ),
            'singular_name' => __be( 'Work Category' ),
            'search_items' =>  __be( 'Search Work Categories' ),
            'popular_items' =>  __be( 'Popular Work Categories' ),
            'all_items' => __be( 'All Work Categories' ),
            'parent_item' => __be( 'Parent Work Category' ),
            'parent_item_colon' => __be( 'Parent Work Category:' ),
            'edit_item' => __be( 'Edit Work Category' ),
            'update_item' => __be( 'Update Work Category' ),
            'add_new_item' => __be( 'Add New Work Category' ),
            'new_item_name' => __be( 'New Work Category Name' ),
            'menu_name' => __be( 'Categories' ),
        );

        register_taxonomy(A13_CPT_WORK_TAXONOMY, array(A13_CUSTOM_POST_TYPE_WORK),
            array(
                "hierarchical" => false,
                "label" => __be('Works Genres'),
                "labels" => $genre_labels,
                "rewrite" => true,
                'show_admin_column' => true
            )
        );

    }
}



/*
 * Get only src of post image
 */
if(!function_exists('a13_get_post_image_src')){
    function a13_get_post_image_src( $post_id, $thumb_size ){
        if ( has_post_thumbnail($post_id) ) {
            $src = wp_get_attachment_image_src( get_post_thumbnail_id ( $post_id ), $thumb_size );
            $src = $src[0];
        }
        else{
            $src = A13_TPL_GFX . '/holders/photo.jpg';
        }

        return $src;
    }
}



/*
 * Making cover for works in Works list
 */
if(!function_exists('a13_make_work_image')){
    function a13_make_work_image( $work_id, $thumb_size, $hidden = false ){
        if(empty($work_id)){
            $work_id = get_the_ID();
        }

        $src = a13_get_post_image_src($work_id, $thumb_size);
        $style = '';
        if($hidden){
            $style = ' style="visibility: hidden;"';
        }

        return '<img src="'.esc_url($src).'" alt=""'.$style.' />';
    }
}


/*
 * For printing categories(taxonomies) of custom type post
 */
if(!function_exists('a13_cpt_work_posted_in')){
    function a13_cpt_work_posted_in( $separator = '<span>/</span>' ) {
        $term_list = wp_get_post_terms(get_the_ID(), A13_CPT_WORK_TAXONOMY, array("fields" => "all"));
        $count_terms = count( $term_list );
        $html = '';
        $iter = 1;
        if( $count_terms ){
            foreach($term_list as $term) {
                $html .= '<a href="' . esc_url(get_term_link($term)) . '">' . $term->name . '</a>';
                if( $count_terms != $iter ){
                    $html .= $separator;
                }
                $iter++;
            }
        }

        return $html;
    }
}


if(!function_exists('a13_work_meta_data')){
    function a13_work_meta_data(){
        global $apollo13;
        ?>
    <div class="meta-data">
        <?php

        //internet address
        $temp = get_post_meta(get_the_ID(), '_www', true);
        if(strlen($temp)){
            echo '<a class="project-site a13-button" href="'.$temp.'">'.__( 'Visit Site', 'fame' ).'</a>';
        }

        //like plugin
        if( function_exists('dot_irecommendthis') ) dot_irecommendthis();

        //custom fields
        $fields = '';
        for($i = 1; $i < 6; $i++){
            $temp = get_post_meta(get_the_ID(), '_custom_'.$i, true);
            if(strlen($temp)){
                $pieces = explode(':', $temp, 2);
                if(sizeof($pieces) == 1){
                    $fields .= '<span>'.make_clickable($temp).'</span>';
                }
                else{
                    $fields .= '<span><em>'.$pieces[0].'</em>'.make_clickable($pieces[1]).'</span>';
                }
            }
        }
        if(strlen($fields)){
            echo '<div class="fields">'.$fields.'</div>';
        }

        //categories
        if($apollo13->get_option('cpt_work', 'genres') == 'on'){
            echo a13_posted_in();
        }

        ?>
    </div>
        <?php
    }
}
/*
 * Collection of photos
 */
if(!function_exists('a13_make_media_collection')){
    function a13_make_media_collection(){
        global $apollo13;

        $ID             = get_the_ID();
        $theme          = $apollo13->get_meta('_theme', $ID);
        $is_slider      = $theme === 'slider';
        $is_scroller    = $theme === 'scroller';
        $is_full_photos = $theme === 'full_photos';
        $is_bricks      = $theme === 'bricks';
        $is_work        = defined( 'A13_WORK_PAGE' );
        $is_gallery     = defined( 'A13_GALLERY_PAGE' );
        $image_size     = 'full';
        $thumb_size     = 'full';
        $slides         = array();
        $media_count    = 0;
        $temp_attachment = '';

        //setup image and thumb sizes
        if( $is_gallery){
            if($is_slider){
                if($apollo13->get_option('cpt_gallery', 'slider_images') === 'resized'){
                    $image_size = 'gallery-slider-image';
                }
                //no thumb size for this variant
            }
            elseif($is_bricks){
                $thumb_size = 'gallery-bricks';
            }
        }
        elseif( $is_work ){
            if($is_slider){
                if($apollo13->get_option('cpt_work', 'slider_images') === 'resized'){
                    $image_size = 'work-slider-image';
                }
                //no thumb size for this variant
            }
            elseif($is_scroller){
                if($apollo13->get_option('cpt_work', 'scroller_images') === 'resized'){
                    $thumb_size = 'work-scroller-image';
                }
            }
        }

        //default gallery settings
        $a_desc               = trim( get_post_meta($ID, '_description', true) );

        //get our items collection
        $images_videos_array = get_post_meta($ID, '_images_n_videos' , true);
        if(!empty($images_videos_array)){
            $images_videos_array = json_decode($images_videos_array, true);
            $media_count = count($images_videos_array);
        }


        //if is work is only openable to lightbox then it will have no photos in content
        //if it is opened accidentally then it may have empty content
        //that is why we try to insert featured image for such work type
        if(!$media_count && $is_work && has_post_thumbnail($ID)){
            $img_src = get_the_post_thumbnail($ID);
            $img_id  = get_post_thumbnail_id($ID);
            //fill array with values
            $images_videos_array = array('0' => array(
                "item_type"         => "image",
                "attachment_id"     => $img_id,
                "item_image_thumb"  => $img_src,
                "item_image"        => $img_src,
                "item_link"         => "",
                "bg_color"          => "",
                "item_title"        => "",
                "item_desc"         => "",
            ));
            $media_count = count($images_videos_array);
        }
        //so we filled our special case and now we check again

        if( $media_count ){
            //sorting order
            $order_asc = true;
            if($is_work || $is_gallery){
                $order = get_post_meta($ID, '_order', true);
                if($order === 'DESC'){
                    $order_asc = false;
                }
                elseif($order === 'random'){
                    shuffle($images_videos_array);
                }
            }

//            ASC
//            for( $i = 0; $i < $media_count; $i++ ){
//            DESC
//            for( $i = $media_count-1; $i >= 0; $i-- ){

            for( $i = ($order_asc? 0 : $media_count - 1); ($order_asc? ($i < $media_count) : ($i >= 0)); ($order_asc? $i++ : $i--) ){
                $current_element = $images_videos_array[$i];
                //image or video?
                $type = $current_element['item_type'];

                //image | video
                if( $type ){
                    $caption            = trim( $current_element['item_title'] );
                    $desc               = trim( $current_element['item_desc'] );
                    //local item settings VS gallery settings
                    $desc               = (empty($desc))? nl2br($a_desc) : nl2br($desc);

                    if($type === 'image'){
                        $media              = $current_element['item_image'];
                        //no image so we skip this item
                        if(!strlen($media)){
                            continue;
                        }

                        $attachment_id      = trim( $current_element['attachment_id'] );

                        //if not using full image version
                        if(!empty($attachment_id) && $image_size !== 'full'){
                            $temp = wp_get_attachment_image_src($attachment_id, $image_size);
                            if($temp){
                                $media = $temp[0];
                            }
                        }

                        $link               = trim( $current_element['item_link'] );
                        $bg_color           = trim( $current_element['bg_color'] );
                        $thumb              = $media;
                        $lbthumb            = $media;

                        //can get normal thumb ?
                        if(!empty($attachment_id)){
                            //main thumbnail
                            $temp_attachment = wp_get_attachment_image_src($attachment_id, $thumb_size);
                            if(!$temp_attachment){
                            }
                            else{
                                $thumb = $temp_attachment[0];
                            }

                            //lightbox thumb
                            $temp_attachment = wp_get_attachment_image_src($attachment_id, 'sidebar-size');
                            if(!$temp_attachment){
                            }
                            else{
                                $lbthumb = $temp_attachment[0];
                            }
                        }


                        //fill array with values
                        $slides[] = array(
                            'type'              => $type,
                            'image'             => $media,
                            'thumb'             => $thumb,
                            'lbthumb'           => $lbthumb,
                            'title'             => $caption,
                            'desc'              => $desc,
                            'bg_color'          => $bg_color,
                            'link'              => $link,
                        );
                    }

                    elseif($type === 'video'){
                        $media          = $current_element['item_video'];
                        if(!strlen($media)){
                            continue;
                        }

                        $v_arr          = a13_detect_movie($media);
                        $thumb          = a13_get_movie_thumb_src($v_arr, trim( $current_element['item_video_thumb'] ) );
                        $movie_link     = a13_get_movie_link($v_arr, array('width' => 500, 'height' => 500, 'poster' => $thumb));
                        $autoplay       = trim( $current_element['item_video_autoplay'] );

                        //fill array with values
                        $slides[] = array(
                            'type'              => $type,
                            'image'             => $movie_link,
                            'thumb'             => $thumb,
                            'lbthumb'           => $thumb,
                            'title'             => $caption,
                            'desc'              => $desc,
                            'autoplay'          => $autoplay,
                            'movie_type'        => $v_arr['type'],
                            'link'              => $media
                        );
                    }
                }
            }


            if( sizeof($slides) ){
                $html = '';
                $desc_html = '';
                foreach($slides as $key => $slide){
                    //description
                    if(!empty($slide['desc'])){
                        $desc_html .= '<div id="g_d_'.$key.'">'.$slide['desc'].'</div>';
                    }

                    //element
                    $html .= "\n".'<a class="' .
                        (($is_bricks || $is_slider)? 'g-link' : '' ) .
                        ($slide['type'] != 'image'? ' '.($slide['type'] .' mfp-iframe' ) : (empty($slide['link'])?'' : ' link')) .
                        '" href="'.esc_url(empty($slide['link'])? $slide['image'] : $slide['link']).'"'.
                        ' data-group="gallery"'.
                        ((!empty($slide['autoplay']) && $slide['autoplay'] == '1')? ' data-autoplay="true"' : '') .
                        (!empty($slide['title'])? (' data-title="'.esc_attr(str_replace('"',"'",$slide['title'])).'"') : '') .
                        (!empty($slide['lbthumb'])? (' data-thumbnail="'.esc_attr($slide['lbthumb']).'"') : '') .
                        (!empty($slide['desc'])? (' data-description="#g_d_'.$key.'"') : '') .
                        (!empty($slide['movie_type'])? (' data-movie_type="'.esc_attr($slide['movie_type']).'"') : '') .
                        (!empty($slide['bg_color'])? (' data-bg_color="'.esc_attr($slide['bg_color']).'"') : '') .
                        ' data-image="'.esc_attr($slide['image']).'"' .
                        ' data-type="'.esc_attr($slide['type']).'"' .
                        '>'.
                        '<img src="'.esc_url($slide['thumb']).'" alt="" />' .
                        '</a>';
                }

                if($is_bricks || $is_slider){
                    $html = '<div id="a13-gallery" class="bricks-list '.esc_attr($apollo13->get_meta('_theme').' '.$apollo13->get_meta('_hover_type')).'">'.$html.'</div>';
                    if(($is_work || $is_gallery) && $is_slider){
                        $html = '<div class="in-post-slider">'.$html.'</div>';
                    }
                    return $html . '<div id="g_descs">'.$desc_html.'</div>';
                }
                elseif($is_scroller){
                    return '<div id="a13-scroll-pan"><div id="a13-work-slides" class="clearfix '.$apollo13->get_meta('_theme').'">'.$html.'</div></div>'.
                        '<div id="g_descs">'.$desc_html.'</div>';
                }
                else{
                    return '<div id="a13-full-photos">'.$html.'</div>'.
                        '<div id="g_descs">'.$desc_html.'</div>';
                }

            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }
}




add_action( 'init', 'a13_cpt_work_register' );