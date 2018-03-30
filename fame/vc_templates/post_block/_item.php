<?php

if($post->post_type === 'post' || $post->post_type === 'page'){
    $block = $block_data[0];
    $settings = $block_data[1];

    if($block === 'title'){
        echo '<h2 class="post-title">';
        echo !empty($settings[0]) && $settings[0]!='no_link' ? $this->getLinked($post, $post->title, $settings[0], 'link_title') : $post->title;
        echo '</h2>';
    }
    elseif($block === 'image' && !empty($post->thumbnail)){
        echo '<div class="item-image post-media">';
        echo !empty($settings[0]) && $settings[0]!='no_link' ? $this->getLinked($post, $post->thumbnail, $settings[0], 'link_image') : $post->thumbnail;
        echo '</div>';
    }
    elseif($block === 'text'){
        echo '<div class="real-content">';
        echo !empty($settings[0]) && $settings[0]==='text' ?  $post->content : $post->excerpt;
        echo '</div>';
    }
}
elseif($post->post_type === A13_CUSTOM_POST_TYPE_WORK || $post->post_type === A13_CUSTOM_POST_TYPE_GALLERY){
    global $apollo13;
    $show_titles        = $apollo13->get_option('cpt_work', 'show_titles') === 'on';
    $show_subtitles     = $apollo13->get_option('cpt_work', 'show_subtitles') === 'on';

    echo '<a class="g-link link" href="'.esc_url(get_permalink($post->id)).'">';
    echo $post->thumbnail;
    echo '<em class="cov"><span>'.($show_subtitles? a13_subtitle('small', $post->id) : '').($show_titles? '<strong>'.$post->title.'</strong>' : '').'</span></em>';
    echo '</a>';
    //like plugin
//    if( function_exists('dot_irecommendthis') ){
//        dot_irecommendthis();
//    };
}