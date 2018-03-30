<?php

    global $mk_options;
    
    $output = '';

    if ($view_params['thumbnail_align'] == 'left'){
        $align_class = ' content-align-right';
    }else{
        $align_class = ' content-align-left';
    }

    $image_height = $view_params['grid_image_height'];
    $image_width = 400;

    
    $post_type = get_post_meta($post->ID, '_single_post_type', true);
    $post_type = !empty($post_type) ? $post_type : 'image';

    $attachment_id = mk_get_blog_post_thumbnail($post_type);

    $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive($attachment_id, $view_params['image_size'], $image_width, $image_height, $crop = true, $dumm = false);

    $image_size_atts = Mk_Image_Resize::get_image_dimension_attr($attachment_id, $view_params['image_size'], $image_width, $image_height);
    
    $post_width = Mk_Image_Resize::is_default_thumb($featured_image_src['default']) ? 'full-width-post' : '';

    $output .= '<article id="' . get_the_ID() . '" class="mk-blog-thumbnail-item '.$post_type.'-post-type mk-isotop-item ' . $post_type . '-post-type'.$align_class.' '.$post_width.' clearfix">' . "\n";

    if (!Mk_Image_Resize::is_default_thumb($featured_image_src['default'])) {
        $output .= '<div class="featured-image" ><a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute(array('echo' => false)) . '">';
        $output .= '<img alt="' . the_title_attribute(array('echo' => false)) . '" title="' . the_title_attribute(array('echo' => false)) . '" src="'.$featured_image_src['dummy'].'" '.$featured_image_src['data-set'].' width="'.esc_attr($image_size_atts['width']).'" height="'.esc_attr($image_size_atts['height']).'" itemprop="image" />';
        $output .= '<div class="image-hover-overlay"></div>';

        $post_type_icon = 'mk-li-' . $post_type;

        if ($post_type == 'blockquote'){ $post_type_icon = 'mk-icon-quote-left'; }
        if ($post_type == 'twitter' || $post_type == 'instagram') { $post_type_icon = 'mk-icon-' . $post_type; }

        $output .= '<div class="post-type-badge" href="' . esc_url( get_permalink() ) . '">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, $post_type_icon).'</div>';
        $output .= '</a></div>';
    }

    $output .= '<div class="item-wrapper">';

        // start: [mk-blog-meta]
        $output .= '<div class="mk-blog-meta">';
        if ($view_params['disable_meta'] == 'true') {
            $output.= mk_get_shortcode_view('mk_blog', 'components/meta', true);   
        }
        $output.= mk_get_shortcode_view('mk_blog', 'components/title', true);
        $output.= mk_get_shortcode_view('mk_blog', 'components/excerpt', true, ['excerpt_length' => $view_params['excerpt_length'], 'full_content' => false]);

        $output .= '<div class="mk-teader-button">';
        $output .= do_shortcode( '[mk_button dimension="outline" corner_style="pointed" outline_skin="dark" margin_bottom="0" size="medium" align="left" url="' . esc_url( get_permalink() ) . '"]'.__('READ MORE', 'mk_framework').'[/mk_button]' );
        $output .= '</div>';

        $output .= '</div>';
        // end: [mk-blog-meta]


    $output .= '</div>'; // end: [item-wrapper]

    $output .= '<div class="clearboth"></div></article>' . "\n\n\n";
    echo $output;
