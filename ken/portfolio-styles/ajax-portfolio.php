<?php



add_action('wp_ajax_nopriv_mk_ajax_portfolio', 'mk_ajax_portfolio');
add_action('wp_ajax_mk_ajax_portfolio', 'mk_ajax_portfolio');

function mk_ajax_portfolio()
{
    if (isset($_POST['id']) && !empty($_POST['id'])):
        $output = get_ajax_portfolio_item($_POST['id']);
        die($output);
    else:
        die(0);
    endif;
}


function get_ajax_portfolio_item($id = false)
{
    if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
        WPBMap::addAllMappedShortcodes();
    }

    require_once THEME_INCLUDES . "/image-cropping.php";
    $query = array();
    global $wp_embed, $mk_settings;
    if (empty($id))
        return false;
    
    $grid_width = $mk_settings['grid-width'];
    
    query_posts(array(
        'post_type' => 'portfolio',
        'p' => $id
    ));
    
    $html = '';
    
    if (have_posts()):
        while (have_posts()):
            the_post();
            
            $the_id = get_the_ID();
            
            $current_post['content'] = get_the_content();
            $post_type               = get_post_format(get_the_id());
            $content                 = get_post_meta(get_the_id(), '_portfolio_short_desc', true);

            if(preg_match('/vc_row fullwidth="true"/', $content) || preg_match('/mk_page_section/', $content)) {
                $content = '<br>' .do_shortcode('[mk_message_box type="warning"]Page Section or Fullwidth Rows are used in this single post. Either remove page sections and disable fullwidth feature of Rows or use Ajax Content metabox field (without mentioned shortcodes and options).[/mk_message_box]');    
            } else {
                $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content));    
            }
            
            $no_content_cssClass = ($content == '') ? 'no-ajax-content' : '';
            
            
            if ($content == '') {
                $image_width  = $grid_width - 103;
                $image_height = $image_width / 1.7;
            } else {
                $image_width  = ((66 / 100) * $grid_width) - 62;
                $image_height = $image_width / 1.6;
            }
            
            
            $html = "<div id='ajax_project_{$the_id}' class='ajax_project' data-project_id='{$the_id}'>";
            
            if ($content != '') {
                $html .= "<div class='project_content_section'>";
                
                $html .= '<ul class="single-social-share ajax-portfolio-social-share">';
                $html .= '<li><a class="facebook-share" data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" href="#"><i class="mk-icon-facebook"></i></a></li>';
                $html .= '<li><a class="twitter-share" data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" href="#"><i class="mk-icon-twitter"></i></a></li>';
                $html .= '<li><a class="googleplus-share" data-title="' . get_the_title() . '" data-url="' . get_permalink() . '" href="#"><i class="mk-icon-google-plus"></i></a></li>';
                $html .= '<li><a class="linkedin-share" data-title="'. get_the_title() .'" data-url="'. get_permalink() .'" href="#"><i class="mk-icon-linkedin"></i></a></li>';
                if (function_exists('mk_love_this')) {
                    ob_start();
                    mk_love_this();
                    $html .= '<li><div class="mk-love-holder">' . ob_get_clean() . '</div></li>';
                }
                $html .= '</ul>';
                
                $html .= $content;
                $html .= '</div>';
            }
            
            $html .= "<div class='project_preview_section {$no_content_cssClass}'>";
            
            if ($post_type == 'gallery') {
                
                $attachment_ids = get_post_meta($the_id, '_gallery_images', true);
                $html .= '<div class="portfolio-ajax-gallery">' . do_shortcode('[mk_image_slideshow images="' . $attachment_ids . '" direction="horizontal" image_width="' . $image_width . '" image_height="' . $image_height . '" animation_speed="700" slideshow_speed="7000" direction_nav="true" pagination="false"]') . '</div>';
                
            } else if ($post_type == 'image') {
                
                $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                
                $html .= '<div class="project-featured-image">
						<img alt="' . get_the_title() . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src_array[0], $image_width, $image_height) . '" height="' . $image_height . '" width="' . $image_width . '" itemprop="image" />
					 </div>';
                
                
            } else if ($post_type == 'video') {
                
                $link = get_post_meta($the_id, '_video_url', true);
                
                if ($link) {
                    global $wp_embed;
                    $html .= '<div class="mk-video-wrapper"><div class="mk-video-container">' . $wp_embed->run_shortcode('[embed]' . $link . '[/embed]') . '</div></div>';
                }
                
            } else {
                $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                
                $html .= '<div class="project-featured-image">
						<img alt="' . get_the_title() . '" title="' . get_the_title() . '" src="' . mk_thumbnail_image_gen($image_src_array[0], $image_width, $image_height) . '" height="' . $image_height . '" width="' . $image_width . '" />
					 </div>';
            }
            
            $html .= "</div>";
            
            $html .= "</div>";
        endwhile;
    endif;
    
    wp_reset_query();
    
    if ($html)
        return $html;
    
    
}
