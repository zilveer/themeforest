<?php

/**
 * template part for post featured image. views/global
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */
if (get_the_post_thumbnail() != ''):

    $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'crop', $view_params['width'], $view_params['height'], $crop = true, $dummy = true);
    $el_class =  isset($view_params['el_class']) ? $view_params['el_class'] : '';
    
    $output = '<div class="' . esc_attr( $view_params['post_type'] ) . '-featured-image ' . esc_attr( $el_class ) . '">';
    $output.= '<img alt="' . the_title_attribute(array('echo' => false)) . '" title="' . the_title_attribute(array('echo' => false)) . '" src="' . $featured_image_src['dummy'] . '" '.$featured_image_src['data-set'].' height="' . $view_params['height'] . '" width="' . $view_params['width'] . '" />';
    $output.= '</div>';
    echo $output;
endif;
