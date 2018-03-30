<?php

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if ( ! function_exists( 'udesign_get_post_thumb' ) ) {
    
    /**
     * Gets post's thumbnail image and formats it accordingly
     * 
     * @param int $post_id Optional. The post ID.
     * @param boul $remove_thumb_frame Toggle the image frame
     * @param boul $thumb_frame_shadow Toggle frame shadow
     * @param string $post_thumb_width The thumbnail image width
     * @param string $post_thumb_height The thumbnail image height
     * @param string $alignment The image alignemnt, choose from three options: 'alignleft', 'aligncenter' and 'aligright'
     * @param mixed $thumb_fallback Image URL as string or pass true/false to show/hide default image respectively
     * 
     * @return string An HTML image element, if there is any, otherwise a default (fallback) image
     */
    function udesign_get_post_thumb( $post_id = null, $remove_thumb_frame = false, $thumb_frame_shadow = false, $post_thumb_width = 60, $post_thumb_height = 60, $alignment = 'alignleft', $thumb_fallback = '' ) {
        
        global $udesign_options;
        $post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
        
        ob_start();
        
        @$the_post_thumbnail_link = ( get_post_meta( $post_id, 'post_thumbnail', true ) ) ? get_post_meta( $post_id, 'post_thumbnail', true ) : get_post_meta( $post_id, 'thumbnail', true );
        
        // Handle default/fallback thumbnail image
        if ( true === $thumb_fallback || $thumb_fallback == 1 ) {
            $thumb_fallback =  get_template_directory_uri() . '/styles/common-images/default-thumb.png';
        }
        
	/**
	 * Filter the post thumbnail default (fallback) image
	 *
	 * @since 2.7.5
	 *
	 * @param string $thumb_fallback A thumbnail default image.
	 */
        $default_thumb = apply_filters( 'udesign_get_post_thumb_fallback', $thumb_fallback );
        
        $thumb_frame_wrappers_before = ( $remove_thumb_frame ) ? '' : '<div class="custom-frame-inner-wrapper"><div class="custom-frame-padding">';
        $thumb_frame_wrappers_after = ( $remove_thumb_frame ) ? '' : '</div></div>';
        $shadow_class = ($thumb_frame_shadow == '' | $thumb_frame_shadow == false) ? '': ' frame-shadow'; // $thumb_frame_shadow is set in 'latestPost-widget.php' file
        // the case when "Get The Image" plugin is available (installed and activated)
        if ( function_exists('get_the_image') ) { 
                if ( $default_thumb ) { // Default thumbnail option is selected
                        $the_thumb_html_as_array = get_the_image( array(
                                            'meta_key' => array('post_thumbnail','thumbnail'),
                                            'format' => 'array',
                                            'size' => 'full',
                                            'default' => $default_thumb,
                                            'link_to_post' => false,
                                            'scan' => true,
                                            'width' => $post_thumb_width,
                                            'height' => $post_thumb_height,
                                            'cache' => false,
                                            'echo' => false,
                                        ) );
                } else { // Default thumbnail option is NOT selected
                        $the_thumb_html_as_array = get_the_image( array(
                                            'meta_key' => array('post_thumbnail','thumbnail'),
                                            'format' => 'array',
                                            'size' => 'full',
                                            'default' => false,
                                            'link_to_post' => false,
                                            'scan' => true,
                                            'width' => $post_thumb_width,
                                            'height' => $post_thumb_height,
                                            'cache' => false,
                                            'echo' => false,
                                        ) );
                }
                echo ( $the_thumb_html_as_array['src'] ) ? '<div class="small-custom-frame-wrapper '.$alignment.$shadow_class.'">'.$thumb_frame_wrappers_before.'<a href="'.get_permalink().'" title="'.the_title('', '', false).'"><img src="'.udesign_process_image( $the_thumb_html_as_array['src'], $post_thumb_width, $post_thumb_height, true, '', false ).'" width="'.$post_thumb_width.'" height="'.$post_thumb_height.'" alt="'.$the_thumb_html_as_array['alt'].'" /></a>'.$thumb_frame_wrappers_after.'</div>' : '';

        } else { // the case when "Get The Image" plugin is NOT available
                if ( $default_thumb ) { // Default thumbnail option is selected
                    if ( $the_post_thumbnail_link ) { // look for the thumbnail passed as a 'post_thumbnail' or 'thumbnail' custom field ?>
                            <div class="small-custom-frame-wrapper <?php echo $alignment.$shadow_class; ?>"><?php echo $thumb_frame_wrappers_before; ?><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php echo udesign_process_image( $the_post_thumbnail_link, $post_thumb_width, $post_thumb_height, true, '', false ); ?>" width="<?php echo $post_thumb_width; ?>" height="<?php echo $post_thumb_height; ?>" alt="<?php the_title(); ?>" /></a><?php echo $thumb_frame_wrappers_after; ?></div>
<?php               } else { // load default thumbnail image ?>
                            <div class="small-custom-frame-wrapper <?php echo $alignment.$shadow_class; ?>"><?php echo $thumb_frame_wrappers_before; ?><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php echo $default_thumb; ?>" width="<?php echo $post_thumb_width; ?>" height="<?php echo $post_thumb_height; ?>" alt="<?php the_title(); ?>" /></a><?php echo $thumb_frame_wrappers_after; ?></div>
<?php               }
                } else { // Default thumbnail option is NOT selected
                    if ( $the_post_thumbnail_link ) { // look for the thumbnail passed as a 'post_thumbnail' or 'thumbnail' custom field ?>
                            <div class="small-custom-frame-wrapper <?php echo $alignment.$shadow_class; ?>"><?php echo $thumb_frame_wrappers_before; ?><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img src="<?php echo udesign_process_image( $the_post_thumbnail_link, $post_thumb_width, $post_thumb_height, true, '', false ); ?>" width="<?php echo $post_thumb_width; ?>" height="<?php echo $post_thumb_height; ?>" alt="<?php the_title(); ?>" /></a><?php echo $thumb_frame_wrappers_after; ?></div>
<?php               }
                }
        }
        $the_image_html = ob_get_clean();
        
        return $the_image_html;
    }
    
}


