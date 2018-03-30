<?php
/*
 * Portfolio Format - Audio
 * Supports Featured Audio, title and subtext.
 * */

global $key,$image_size,$more,$automatic_post_excerpt,$orderby_menu;

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

//-----------------------------------------------------
// Single Output
//-----------------------------------------------------
if(is_single()){

    $audio_embed = sanitize_text_field(get_post_meta( $post->ID, '_format_audio_embed', true));
    $audio_shortcode = sanitize_text_field(get_post_meta( $post->ID, '_format_audio_shortcode', true));

    if (isset($audio_embed) && $audio_embed > ""){
        $embed_code = wp_oembed_get($audio_embed, array('width'=>328));
    }elseif($audio_shortcode > ""){
        $embed_code = do_shortcode($audio_shortcode);
    }

    echo "<div class='col-md-7'>";
    if ( has_post_thumbnail() ) {
        $featured_img_attr = array('class'	=> "img-responsive");
        the_post_thumbnail($image_size,$featured_img_attr);
    }
    if ($embed_code > "") {echo $embed_code;}
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
    if ( has_post_thumbnail() ) {
        $featured_img_attr = array('class'	=> "img-responsive port-img");
    }
    echo '<div class="port-wrap">';
    echo get_the_post_thumbnail($post->ID,$image_size,$featured_img_attr);
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
    if(isset($orderby_menu)){
        echo '<a class="port-link" href="' . esc_url_raw(add_query_arg('portorder','menu',get_the_permalink())). '"></a>';
    }else{
        echo '<a class="port-link" href="' . get_the_permalink(). '"></a>';
    }
    echo '</div><!-- /.port-inner -->';
    echo '</div><!-- /.port-wrap -->';
}