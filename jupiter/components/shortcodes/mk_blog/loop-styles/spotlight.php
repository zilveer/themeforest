<?php
global $mk_options;

switch ($view_params['column']) {
    case 1:
        if ($view_params['layout'] == 'full') {
            $image_width = round($mk_options['grid_width']);
        } 
        else {
            $image_width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']));
        }
        $mk_column_css = 'one-column';
        break;

    case 2:
        if ($view_params['layout'] == 'full') {
            $image_width = round($mk_options['grid_width'] / 2);
        } 
        else {
            $image_width = round((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 2);
        }
        $mk_column_css = 'two-column';
        break;

    case 3:
        $image_width = $mk_options['grid_width'] / 3;
        $mk_column_css = 'three-column';
        break;

    case 4:
        $image_width = $mk_options['grid_width'] / 4;
        $mk_column_css = 'four-column';
        break;

    default:
        $image_width = $mk_options['grid_width'] / 3;
        $mk_column_css = 'three-column';
        break;
}
    $image_height = $view_params['grid_image_height'];

    $post_type = get_post_meta($post->ID, '_single_post_type', true);
    $post_type = !empty($post_type) ? $post_type : 'image';

    $attachment_id = mk_get_blog_post_thumbnail($post_type);


    $featured_image_src = Mk_Image_Resize::resize_by_id_adaptive($attachment_id, $view_params['image_size'], $image_width, $image_height, $crop = true, $dummy = true);
    $image_size_atts = Mk_Image_Resize::get_image_dimension_attr($attachment_id, $view_params['image_size'], $image_width, $image_height);


//if (!empty($attachment_id)) {
   
    $output = '<article id="' . get_the_ID() . '" class="mk-blog-spotlight-item '.$post_type.'-post-type mk-isotop-item ' . $mk_column_css . ' ' . $post_type . '-post-type">' . "\n";
    $output.= '<div class="featured-image">';
    $output.= '<img alt="' . the_title_attribute(array('echo' => false)) . '" title="' . the_title_attribute(array('echo' => false)) . '" src="'.$featured_image_src['dummy'].'" '.$featured_image_src['data-set'].' width="'.esc_attr($image_size_atts['width']).'" height="'.esc_attr($image_size_atts['height']).'" itemprop="image" />';
    $output.= '<div class="image-hover-overlay"></div>';
    
    // start:[item-wrapper]
    $output.= '<div class="item-wrapper">';
    
        // start:[mk-blog-meta]
        $output.= '<div class="mk-blog-meta">';
        if ($view_params['disable_meta'] == 'true') {
            $output.= mk_get_shortcode_view('mk_blog', 'components/meta', true, ['author' => 'false', 'cats' => 'false']);                                        
        }
        $output.= mk_get_shortcode_view('mk_blog', 'components/title', true);
        $output.= do_shortcode('[mk_button dimension="outline" corner_style="pointed" outline_skin="light" size="medium" align="center" url="' . esc_url( get_permalink() ) . '"]' . __('READ MORE', 'mk_framework') . '[/mk_button]');
        $output.= '</div>';
        // end:[mk-blog-meta]

        $output.= '</div>';
        // end:[item-wrapper]

    $output.= '</div>';
    // end:[featured-image]

    $output.= '</article>' . "\n\n\n";

    echo $output;
//}
