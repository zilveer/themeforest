<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$overlay_opacity_ie = $button2_txt_color = $button1_txt_color = $outline1_hover_color = $outline2_hover_color = $button2_bg_color = $button1_bg_color = $outline2_active_color = $video_color_mask_css = $outline1_active_color = '';

global $post, $mk_options;

wp_dequeue_script('smoothscroll');

$count = !empty($slides) ? count(explode(',',$slides)) : 10;

$query = mk_wp_query(array(
    'post_type' => 'edge',
    'count' => $count,
    'posts' => $slides,
    'orderby' => $orderby,
    'order' => $order,
));

$r = $query['wp_query'];


$output = '<div id="fullpage" class="mk-edge-one-pager '.$el_class.'" data-pagination="'.$pagination.'">';
while ($r->have_posts()):
    $r->the_post();


    $type            = get_post_meta($post->ID, '_edge_type', true) ? get_post_meta($post->ID, '_edge_type', true) : 'image';
    $animation       = get_post_meta($post->ID, '_animation', true) ? get_post_meta($post->ID, '_animation', true) : 'slide_down';
    $mp4             = get_post_meta($post->ID, '_video_mp4', true);
    $webm            = get_post_meta($post->ID, '_video_webm', true);
    $video_preview   = get_post_meta($post->ID, '_video_preview', true);
    $video_pattern   = get_post_meta($post->ID, '_pattern', true);
    $video_overlay   = get_post_meta( $post->ID, '_video_color_overlay', true );
    $overlay_opacity = get_post_meta( $post->ID, '_overlay_opacity', true ) ? get_post_meta( $post->ID, '_overlay_opacity', true ) : 0.3;
    $slide_image     = get_post_meta($post->ID, '_slide_image', true);
    $slide_image_portrait = get_post_meta($post->ID, '_slide_image_portrait', true);
    $slide_bg_color  = get_post_meta($post->ID, '_bg_color', true);
    $cover_bg        = get_post_meta($post->ID, '_cover', true);

    $content_width = get_post_meta($post->ID, '_content_width', true) ? get_post_meta($post->ID, '_content_width', true) : 70;
    $title         = get_post_meta($post->ID, '_title', true);
    $description   = get_post_meta($post->ID, '_description', true);

    $title_size           = get_post_meta($post->ID, '_title_size', true) ? ('font-size : '.get_post_meta($post->ID, '_title_size', true).'px;') : '';
    $title_weight         = get_post_meta($post->ID, '_caption_title_weight', true) ? ('font-weight:'.get_post_meta($post->ID, '_caption_title_weight', true).';') : '';
    $title_letter_spacing = get_post_meta($post->ID, '_title_letter_spacing', true) ? ('letter-spacing:'.get_post_meta($post->ID, '_title_letter_spacing', true).'px;') : '';
    $caption_custom_color = get_post_meta($post->ID, '_custom_caption_color', true) ? ('color:'.get_post_meta($post->ID, '_custom_caption_color', true).';') : '';

    $btn_1_txt = get_post_meta($post->ID, '_btn_1_txt', true);
    $btn_1_url = get_post_meta($post->ID, '_btn_1_url', true);
    $btn_1_target =  get_post_meta( $post->ID, '_btn_1_target', true );
    $btn_2_txt = get_post_meta($post->ID, '_btn_2_txt', true);
    $btn_2_url = get_post_meta($post->ID, '_btn_2_url', true);
    $btn_2_target =  get_post_meta( $post->ID, '_btn_2_target', true );

    $caption_skin = get_post_meta($post->ID, '_caption_skin', true);

    $btn_1_style = get_post_meta($post->ID, '_btn_1_style', true);
    $btn_2_style = get_post_meta($post->ID, '_btn_2_style', true);

    $btn_1_corner_style =  get_post_meta( $post->ID, '_btn_1_corner_style', true ) ? get_post_meta( $post->ID, '_btn_1_corner_style', true ) : 'pointed';
    $btn_2_corner_style =  get_post_meta( $post->ID, '_btn_2_corner_style', true ) ? get_post_meta( $post->ID, '_btn_2_corner_style', true ) : 'pointed';

    $btn_1_skin    = get_post_meta($post->ID, '_btn_1_skin', true);
    $btn_2_skin    = get_post_meta($post->ID, '_btn_2_skin', true);
    $caption_align = get_post_meta($post->ID, '_caption_align', true);

    $header_skin = get_post_meta($post->ID, '_edge_header_skin', true) ? get_post_meta($post->ID, '_edge_header_skin', true) : 'dark';



 if ( $btn_1_style == 'flat' ) {
    if ( $btn_1_skin == 'light' ) {
        $button1_bg_color = '#ffffff';
        $button1_txt_color = 'dark';

    } else if ( $btn_1_skin == 'dark' ) {
        $button1_bg_color = '#252525';
        $button1_txt_color = 'light';

    } else if ( $btn_1_skin == 'skin' ) {
        $button1_bg_color = $mk_options['skin_color'];
        $button1_txt_color = 'light';
    }
}

if ( $btn_2_style == 'flat' ) {
    if ( $btn_2_skin == 'light' ) {
        $button2_bg_color = '#ffffff';
        $button2_txt_color = 'dark';
    } else if ( $btn_2_skin == 'dark' ) {
        $button2_bg_color = '#252525';
        $button2_txt_color = 'light';

    } else if ( $btn_2_skin == 'skin' ) {
        $button2_bg_color = $mk_options['skin_color'];
        $button2_txt_color = 'light';
    }
}

if ( $btn_1_style == 'outline' ) {
    if ( $btn_1_skin == 'skin' ) {
        $outline1_active_color = $mk_options['skin_color'];
        $outline1_hover_color = '#ffffff';
    }
}

if ( $btn_2_style == 'outline' ) {
    if ( $btn_2_skin == 'skin' ) {
        $outline2_active_color = $mk_options['skin_color'];
        $outline2_hover_color = '#ffffff';
    }
}





    $bg_image_css = ($type == 'image') ? ' style="background-color:' . $slide_bg_color . '" ' : '';
    $bg_image_set = ($type == 'image' && (!empty($slide_image) || !empty($slide_image_portrait))) ? Mk_Image_Resize::get_bg_res_set($slide_image, $slide_image_portrait) : '';

    $sanitised_attr_title = str_replace(' ', '-', the_title_attribute(array('echo' => false)));

    $output .= '<section id="edge-entry-'.get_the_id().'" class="section one-pager-slide ' . $caption_align . ' ' . mk_get_bg_cover_class($cover_bg) . '"' . $bg_image_css .' '.$bg_image_set.' data-title="'.$sanitised_attr_title.'" data-header-skin="' . $header_skin . '">';



    if ( $video_pattern == 'true' ) {
            $output .= '<div class="mk-video-mask"></div>';
        }

    if ( !empty( $video_overlay ) ) {
        $video_color_mask_css = ' style="background-color:'.$video_overlay.';opacity:'.$overlay_opacity.';"';
        $output .= '<div'.$video_color_mask_css.' class="mk-video-color-mask"></div>';
    }

    /*
    * Video Section
    */
    if ( $type == 'video' ) {

        if(!empty($video_preview)) {
                $output .= '<div style="background-image:url('.$video_preview.');" class="mk-video-section-touch"></div>';
        }

        $output .= '<div class="mk-section-video mk-center-video"><video poster="'.$video_preview.'" muted="muted" preload="auto" loop="true" autoplay="true">';

        if ( !empty( $mp4 ) ) {
            //MP4 must be first for iPad!
            $output .= '<source type="video/mp4" src="'.$mp4.'" />';
        }
        if ( !empty( $webm ) ) {
            $output .= '<source type="video/webm" src="'.$webm.'" />';
        }
        if ( !empty( $ogv ) ) {
            $output .= '<source type="video/ogg" src="'.$ogv.'" />';
        }

        $output .= '</video></div>';
    }
    /***********/


    $output .= '<div class="mk-grid">';

    $output .= '<div class="edge-slide-content edge-' . $animation . ' caption-' . $caption_skin . '" style="width:' . $content_width . '%">';
    $output .= (!empty($title)) ? '<div class="mk-edge-title" style="'.$title_size.$title_weight.$caption_custom_color.$title_letter_spacing.'">' . $title . '</div>' : '';
    $output .= (!empty($description)) ? '<p class="mk-edge-desc" style="'.$caption_custom_color.'">' . $description . '</p>' : '';

    if (!empty($btn_1_txt) || !empty($btn_2_txt)) {
        $smooth_scroll_1 = (preg_match('/#/',$btn_1_url)) ? ' el_class="mk-smooth"' : '';
        $smooth_scroll_2 = (preg_match('/#/',$btn_2_url)) ? ' el_class="mk-smooth"' : '';

        $btn1_atts[] = 'dimension="'.$btn_1_style.'"';
        $btn1_atts[] = 'corner_style="'.$btn_1_corner_style.'"';
        $btn1_atts[] = 'size="large"';
        $btn1_atts[] = 'url="'.$btn_1_url.'"';
        $btn1_atts[] = 'target="'.$btn_1_target.'"';
        $btn1_atts[] = 'align="none"';
        $btn1_atts[] = 'margin_top="0"';
        $btn1_atts[] = 'margin_bottom="0"';
        $btn1_atts[] = 'button_custom_width="0"';
        $btn1_atts[] = $smooth_scroll_1;
        if($btn_1_style == 'flat'){
            $btn1_atts[] = 'bg_color="'.$button1_bg_color.'"';
            $btn1_atts[] = 'text_color="'.$button1_txt_color.'"';
            $btn1_atts[] = 'btn_hover_bg="'.hexDarker($button1_bg_color, 7).'"';
            $button1_txt_color = ($button1_txt_color == '' || $button1_txt_color == 'light') ? '#ffffff' : '#252525';
            $btn1_atts[] = 'btn_hover_txt_color="'.hexDarker($button1_txt_color, 7).'"';
        }else if($btn_1_style == 'outline') {
            if ($btn_1_skin == 'light') {
                $btn1_atts[] = 'outline_skin="light"';
            }else if ($btn_1_skin == 'dark') {
                $btn1_atts[] = 'outline_skin="light"';
            }else if ($btn_1_skin == 'skin') {
                $btn1_atts[] = 'outline_active_color="'.$outline1_active_color.'"';
                $btn1_atts[] = 'outline_active_text_color="'.$outline1_active_color.'"';
                $btn1_atts[] = 'outline_hover_bg_color="'.$outline1_hover_color.'"';
                $btn1_atts[] = 'outline_hover_color="'.$outline1_active_color.'"';
            }
        }

        $btn2_atts[] = 'dimension="'.$btn_2_style.'"';
        $btn2_atts[] = 'corner_style="'.$btn_2_corner_style.'"';
        $btn2_atts[] = 'size="large"';
        $btn2_atts[] = 'url="'.$btn_2_url.'"';
        $btn2_atts[] = 'target="'.$btn_2_target.'"';
        $btn2_atts[] = 'align="none"';
        $btn2_atts[] = 'margin_top="0"';
        $btn2_atts[] = 'margin_bottom="0"';
        $btn2_atts[] = 'button_custom_width="0"';
        $btn2_atts[] = $smooth_scroll_2;
        if($btn_2_style == 'flat'){
            $btn2_atts[] = 'bg_color="'.$button2_bg_color.'"';
            $btn2_atts[] = 'text_color="'.$button2_txt_color.'"';
            $btn2_atts[] = 'btn_hover_bg="'.hexDarker($button2_bg_color, 7).'"';
            $button2_txt_color = ($button2_txt_color == '' || $button2_txt_color == 'light') ? '#ffffff' : '#252525';
            $btn2_atts[] = 'btn_hover_txt_color="'.hexDarker($button2_txt_color, 7).'"';
        }else if($btn_2_style == 'outline') {
            if ($btn_2_skin == 'light') {
                $btn2_atts[] = 'outline_skin="light"';
            }else if ($btn_2_skin == 'dark') {
                $btn2_atts[] = 'outline_skin="light"';
            }else if ($btn_2_skin == 'skin') {
                $btn2_atts[] = 'outline_skin="custom"';
                $btn2_atts[] = 'outline_active_color="'.$outline2_active_color.'"';
                $btn2_atts[] = 'outline_active_text_color="'.$outline2_active_color.'"';
                $btn2_atts[] = 'outline_hover_bg_color="'.$outline2_hover_color.'"';
                $btn1_atts[] = 'outline_hover_color="'.$outline2_active_color.'"';
            }
        }


        $output .= '<div class="mk-edge-buttons">';
        $output .= ( !empty( $btn_1_txt ) ) ? do_shortcode( '[mk_button '.implode(' ', $btn1_atts).']'.$btn_1_txt.'[/mk_button]' ) : '';
        $output .= ( !empty( $btn_2_txt ) ) ? do_shortcode( '[mk_button '.implode(' ', $btn2_atts).']'.$btn_2_txt.'[/mk_button]' ) : '';
        $output .= '</div>';
    }
    if(preg_match('/vc_row fullwidth="true"/', get_the_content()) || preg_match('/mk_page_section/', get_the_content())) {
        $content = do_shortcode('[mk_message_box type="warning-message"]Page Section or Fullwidth Rows are not allowed in Edge Slide. Remove Page Sections and disable fullwidth option of rows.[/mk_message_box]');
    } else {
        $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
    }

    if (!empty($content)) {
        $output .= '<div class="mk-edge-custom-content">' . $content . '</div>';
    }

    $output .= '</div><!--/edge-slide-content-->';
    $output .= '</div><!--/mk-grid-->';
    $output .= '</section><!--/edge-slide-->' . "\n\n\n";

endwhile;
wp_reset_postdata();

$output .= '</div>';


echo $output;