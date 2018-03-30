<?php
if (!function_exists('tfuse_media')) :
    /**
     * Display post media.
     *
     * To override tfuse_media() in a child theme, add your own tfuse_media()
     * to your child theme's file.
     */
    function tfuse_media($return=false)
    {
        global $post;

        $tfuse_media['img_position']   = $tfuse_media['image'] = $tfuse_image = $tf_media_add_space = $output = '';
        $tfuse_media['img_dimensions'] = array();
        $tfuse_media['enable_listing_lightbox'] = tfuse_options('enable_listing_lightbox');
        $tfuse_media['enable_single_lightbox']  = tfuse_options('enable_single_lightbox');

        if (is_singular() )
        {
            $tfuse_media['video_link']             = tfuse_page_options('video_link');
            $tfuse_media['enable_video']           = tfuse_page_options('enable_video',tfuse_options('enable_video'));
            $tfuse_media['enable_image']           = tfuse_page_options('enable_image',tfuse_options('enable_image'));

            if ( $tfuse_media['enable_image'] )
            {
                $tfuse_media['image']               = tfuse_page_options('single_image');
                $tfuse_media['img_dimensions']      = tfuse_page_options('single_img_dimensions',tfuse_options('single_img_dimensions'));
                $tfuse_media['img_position']        = tfuse_page_options('single_img_position',tfuse_options('single_img_position'));
            }

            if ( !empty($tfuse_media['video_link'] ) && $tfuse_media['enable_video'] )
            {
                $tfuse_media['video_dimensions']    = tfuse_page_options('video_dimensions',tfuse_options('video_dimensions'));
                $tfuse_media['video_position']      = tfuse_page_options('video_position',tfuse_options('video_position'));


                if ( !empty($tfuse_media['image']) ) $tf_media_add_space = ' tf_media_add_space';

                $output .= '<div class="video_embed '.$tfuse_media['video_position'].'" style="width:'.$tfuse_media['video_dimensions'][0].'px">';
                $video = new TF_GET_EMBED();
                $output .= $video->width($tfuse_media['video_dimensions'][0])->height($tfuse_media['video_dimensions'][1])->source('video_link')->get();        //$output .= tfuse_get_embed($tfuse_media['media_width'], $tfuse_media['media_height'], PREFIX . "_post_video");
                $output .= '</div><!--/.video_embed  -->';
            }
        }
        elseif ( !is_singular() )
        {
            $tfuse_media['image']               = tfuse_page_options('thumbnail_image',tfuse_page_options('single_image'));
            $tfuse_media['img_dimensions']      = tfuse_page_options('thumbnail_dimensions',tfuse_options('thumbnail_dimensions'));
            $tfuse_media['img_position']        = tfuse_page_options('thumbnail_position',tfuse_options('thumbnail_position'));
        }

        if ( !empty($tfuse_media['image']) )
        {
            $image = new TF_GET_IMAGE();
            $tfuse_image = $image->width($tfuse_media['img_dimensions'][0])->height($tfuse_media['img_dimensions'][1])->
                properties(array('class'=>''.$tf_media_add_space))->src($tfuse_media['image'])->get_img();
        }

        if (  ( (!is_singular() && $tfuse_media['enable_listing_lightbox']) || (is_singular() && $tfuse_media['enable_single_lightbox']) ) && !empty($tfuse_image) )
        {
            $attachments = get_children( array('post_parent' => $post->ID, 'numberposts' => -1, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
            $output .= '<span style="display:none">';
            if( !empty($attachments) )
            {
                foreach ($attachments as $att_id => $attachment)
                {
                    $tfuse_src = wp_get_attachment_image_src($att_id, 'full', true);
                    $tfuse_image_link_attach = $tfuse_src[0];
                    $output .= '<a href="'. $tfuse_image_link_attach.'" data-rel="prettyPhoto[gallery'.$post->ID.']" style="display: none;">'.$tfuse_media['image'].'</a>';
                }
            }
            if ( !empty($tfuse_media['post_video']) ) $output .= '<a href="'. $tfuse_media['post_video'].'" data-rel="prettyPhoto[gallery'.$post->ID.']">'.$tfuse_image.'</a>';
            $output .= '</span>';
            $output .= '<div class="post-image '.$tfuse_media['img_position'].'"><a href="'.$tfuse_media['image'].'" data-rel="prettyPhoto[gallery'.$post->ID.']">'.$tfuse_image.'</a></div>';
        }
        else
            $output .= '<div class="post-image '.$tfuse_media['img_position'].'"><a href="'.get_permalink($post->ID).'">'.$tfuse_image.'</a></div>';

        if( $return )
            return $output;
        else
            echo $output;
    }
endif; // tfuse_media