<?php

// To let Visual Composer load shortcodes through ajax.
if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
        WPBMap::addAllMappedShortcodes();
}


$image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full');

$image_permalink = isset($view_params['single_post']) ? $image_src_array[0] : esc_url( get_permalink() );
$image_permalink_class = isset($view_params['single_post']) ? 'mk-lightbox' : '';

// Do not output random placeholder images in single post if the post does not have a featured image!
$dummy = isset($view_params['single_post']) ? false : true;

$featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), $view_params['image_size'], $view_params['image_width'], $view_params['image_height'], $crop = false, $dummy);
$image_size_atts = Mk_Image_Resize::get_image_dimension_attr(get_post_thumbnail_id(), $view_params['image_size'], $view_params['image_width'], $view_params['image_height']);


switch ($view_params['post_type']) {
    case 'image':
        if (!Mk_Image_Resize::is_default_thumb($image_src_array[0])) {
            echo '<div class="featured-image"><a class="full-cover-link '.$image_permalink_class.'" title="' .  the_title_attribute(array('echo' => false)) . '" href="' . $image_permalink . '">&nbsp;</a>';
            echo '<img alt="' . the_title_attribute(array('echo' => false)) . '" title="' . the_title_attribute(array('echo' => false)) . '" src="'.$featured_image_src['dummy'].'" '.$featured_image_src['data-set'].' width="'.esc_attr($image_size_atts['width']).'" height="'.esc_attr($image_size_atts['height']).'" itemprop="image" />';
            echo '<div class="image-hover-overlay"></div>';
            echo '<div class="post-type-badge" href="' . esc_url( get_permalink() ) . '">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-li-' . $view_params['post_type'], 48).'</div>';
            echo '</div>';
        }
        break;

    case 'portfolio':
        $featured_image_id = get_post_thumbnail_id();
        $attachment_ids = get_post_meta($post->ID, '_gallery_images', true);
        
        if (!empty($attachment_ids)) {
            
            if (!empty($featured_image_id)) {
                $attachment_ids = $featured_image_id . ',' . $attachment_ids;
            }
            
            echo '<div class="blog-gallery-type">';
            echo do_shortcode('[mk_swipe_slideshow images="' . $attachment_ids . '" image_size="'.$view_params['image_size'].'" image_width="' . $image_size_atts['width'] . '" image_height="' .$image_size_atts['height'] . '"]');
            echo '</div>';
        } 
        else {
            if (!Mk_Image_Resize::is_default_thumb($image_src_array[0])) {
                echo '<div class="featured-image"><a class="full-cover-link '.$image_permalink_class.'" title="' . the_title_attribute(array('echo' => false)) . '" href="' . $image_permalink . '">&nbsp;</a>';
                echo '<img alt="' . the_title_attribute(array('echo' => false)) . '" title="' . the_title_attribute(array('echo' => false)) . '" src="'.$featured_image_src['dummy'].'" '.$featured_image_src['data-set'].' width="'.$image_size_atts['width'].'" height="'.$image_size_atts['height'].'" itemprop="image" />';
                echo '<div class="image-hover-overlay"></div>';
                echo '<div class="post-type-badge" href="' . esc_url( get_permalink() ) . '">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-li-' . $view_params['post_type']).'</div>';
                echo '</div>';
            }
        }
        break;

    case 'video':
        
        $video_id = get_post_meta($post->ID, '_single_video_id', true);
        $video_site = get_post_meta($post->ID, '_single_video_site', true);
        
        echo '<div class="featured-image">';
        
        if ($video_site == 'vimeo') {
            echo '<div class="mk-video-wrapper"><div class="mk-video-container"><iframe src="http' . ((is_ssl()) ? 's' : '') . '://player.vimeo.com/video/' . $video_id . '?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
        }
        if ($video_site == 'youtube') {
            echo '<div class="mk-video-wrapper"><div class="mk-video-container"><iframe src="http' . ((is_ssl()) ? 's' : '') . '://www.youtube.com/embed/' . $video_id . '?showinfo=0&amp;theme=light&amp;color=white&amp;rel=0" frameborder="0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
        }
        if ($video_site == 'dailymotion') {
            echo '<div style="width:' . $view_params['image_width'] . 'px;" class="mk-video-wrapper"><div class="mk-video-container"><iframe src="http' . ((is_ssl()) ? 's' : '') . '://www.dailymotion.com/embed/video/' . $video_id . '?logo=0" frameborder="0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
        }
        echo '</div>';
        
        break;

    case 'audio':
        $iframe = get_post_meta($post->ID, '_audio_iframe', true);
        if (empty($iframe)) {
            $mp3_file = get_post_meta($post->ID, '_mp3_file', true);
            $ogg_file = get_post_meta($post->ID, '_ogg_file', true);
            $audio_author = get_post_meta($post->ID, '_single_audio_author', true);
            
            echo do_shortcode('[mk_audio mp3_file="' . $mp3_file . '" ogg_file="' . $ogg_file . '" thumb="' . $image_src_array[0] . '" audio_author="' . $audio_author . '"]');
        } 
        else {
            echo '<div class="audio-iframe">' . $iframe . '</div>';
        }
        break;

    case 'twitter':
        $url = get_post_meta($post->ID, '_tweet_oembed', true);
        echo mk_get_shortcode_view('mk_blog', 'components/tweet-status', true, ['url' => $url]);
        
        break;

    case 'blockquote':
        $quote = get_post_meta($post->ID, '_blockquote_content', true);
        $quote_author = get_post_meta($post->ID, '_blockquote_author', true);
        if (!empty($quote)) {
            echo '<div class="blog-blockquote-content">
                    '.Mk_SVG_Icons::get_svg_icon_by_class_name(false, 'mk-icon-quote-left', 48).'
                    <a href="' . esc_url( get_permalink() ) . '">' . $quote . '</a>
                    <footer> - <q>' . $quote_author . '</q> </footer>
                </div>
            ';
        }
        break;

    case 'instagram':
        $url = get_post_meta($post->ID, '_instagram_url', true);
        echo mk_get_shortcode_view('mk_blog', 'components/instagram-feed', true, ['url' => $url]);
        
        break;
}

