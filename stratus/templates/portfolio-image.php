<?php
/*
 * Portfolio Format - IMAGE
 * Supports Featured Image, title and subtext.
 * */

global $key,$image_size,$more,$automatic_post_excerpts,$orderby_menu;

// Custom Icon
$custom_icon_set = get_post_meta( get_the_ID(), 'themo_project_single__glyphicons_icon_set', false);
$custom_icon = get_post_meta( get_the_ID(), 'themo_project_single__glyphicons-icon', false);

if(isset($custom_icon[0]) &&  !is_array($custom_icon[0]) && $custom_icon[0] > ""){
    $custom_icon = $custom_icon[0];
    if(isset($custom_icon_set[0]) &&  !is_array($custom_icon_set[0]) && $custom_icon_set[0] > "" && $custom_icon_set[0] != 'none'){
        $custom_icon_set = $custom_icon_set[0];
    }else{
        $custom_icon_set = '';
    }
}else{
    $custom_icon_set = false;
    $custom_icon = false;
}

// Get Project Format Options
$enable_lightbox = get_post_meta( $post->ID, 'themo_project_lightbox', false);
$project_thumb_alt_img = get_post_meta( $post->ID, 'themo_project_thumb', false);

//print_r($project_thumb_alt_img);

if (isset($project_thumb_alt_img[0]) && is_array($project_thumb_alt_img[0]) > "") {
    $img_src = themo_return_metabox_image($project_thumb_alt_img[0], null, "themo_portfolio_standard", true, $alt);
    $img_src = esc_url($img_src);
    $alt_text = esc_attr($alt);
}

$show_lightbox = false;
if(isset($enable_lightbox) && is_array($enable_lightbox)){
    $enable_lightbox = $enable_lightbox[0][0];
    if($enable_lightbox) {
        $show_lightbox = true;
    }
}

$href = "";
$href_close = "";
$href_lightbox = "";

// Pre lightbox link
$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'themo_full_width');
$href_lightbox = '<a href="' . esc_url($large_image_url[0]) . '" title="' . the_title_attribute('echo=0') . '" data-toggle="lightbox" data-gallery="multiimages" >';

// Standard link
$href = '<a href="' . esc_url(get_permalink()) . '" title="' . the_title_attribute('echo=0') . '"  >';
$href_close = '</a>';

//-----------------------------------------------------
// Single Output
//-----------------------------------------------------
if(is_single()){
    echo "<div class='col-md-7'>";
        if ( has_post_thumbnail() ) {
            $featured_img_attr = array('class'	=> "img-responsive");
            echo $href_lightbox . get_the_post_thumbnail($post->ID,$image_size,$featured_img_attr) . wp_kses_post($href_close) ;
        }
    echo "</div>";
    echo "<div class='col-md-5'>";
        get_template_part('templates/meta-social-addthis'); // AddThis Social Toolbox
        $content = apply_filters( 'the_content', get_the_content() );
        $content = str_replace( ']]>', ']]&gt;', $content );
        if($content != ""){
            echo "<div class='entry-content'>";
            echo $content;
            themo_do_shortocde_button('',$key.'_');
            themo_do_shortocde_button('',$key.'_',false,false,2);
            echo "</div>";
        }
    echo "</div>";
} else {
//-----------------------------------------------------
// Index and Archive Output
//-----------------------------------------------------
    $more = 0;
    echo '<div class="port-wrap">';
    if(isset($img_src) &&  $img_src > ""){
        echo '<img class="img-responsive port-img" src="'.esc_url($img_src).'" alt="'.$alt_text.'">';
    }else{
        if ( has_post_thumbnail() ) {
            $featured_img_attr = array('class'	=> "img-responsive port-img");
            echo get_the_post_thumbnail($post->ID,$image_size,$featured_img_attr);
        }
    }

    echo '<div class="port-overlay"></div>';
    echo '<div class="port-inner">';
    echo '<div class="port-center">';
    themo_print_project_icon(false,$custom_icon,$custom_icon_set);
    echo '<h3 class="port-title">'.get_the_title().'</h3>';
    if($automatic_post_excerpts === 'off'){
        $content = apply_filters( 'the_content', get_the_content() );
        $content = str_replace( ']]>', ']]&gt;', $content );
        if($content != ""){
            echo '<p class="port-sub">'.$content.'</p>';
        }
    }else{
        $excerpt = apply_filters( 'the_excerpt', get_the_excerpt() );
        $excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
        $excerpt = str_replace('<p', '<p class="port-sub"', $excerpt);
        if($excerpt != ""){
            echo $excerpt;
        }
    }
    echo '</div><!-- /.port-center -->';
    // See if Lightbox is enabled.
    if($show_lightbox){

        $href = $href_lightbox;
        $href = str_replace('<a', '<a class="port-link"', $href_lightbox);
        echo $href.$href_close;
    }else{
        if(isset($orderby_menu)){
            echo '<a class="port-link" href="' . esc_url_raw(add_query_arg('portorder','menu',get_the_permalink())). '"></a>';
        }else{
            echo '<a class="port-link" href="' . get_the_permalink(). '"></a>';
        }
    }
    echo '</div><!-- /.port-inner -->';
    echo '</div><!-- /.port-wrap -->';
}


