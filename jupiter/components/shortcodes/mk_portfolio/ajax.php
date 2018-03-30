<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Class to for fetching portfolio posts from server using ajax
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @version     5.0
 * @package     artbees
 */

class Mk_Ajax_Portfolio
{
    
    function __construct() {
        add_action('wp_ajax_nopriv_mk_ajax_portfolio', array(&$this,
            'get_post_by_id'
        ));
        add_action('wp_ajax_mk_ajax_portfolio', array(&$this,
            'get_post_by_id'
        ));
    }
    
    /*
     * Get ID via WP ajax hook and pass it to view
    */
    public function get_post_by_id() {
        $id = $_GET['id'];
        
        if (isset($id) && !empty($id)) {
            echo $this->get_view($id);
        }
        wp_die();
    }
    
    function get_view($id) {

        if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
            WPBMap::addAllMappedShortcodes();
        }


        if (empty($id)) return false;
        global $mk_options;

        
        $query = array(
            'post_type' => 'portfolio',
            'p' => $id,
            'suppress_filters' => 0
        );
        
        $r = new WP_Query($query);


        if ($r->have_posts()):
            while ($r->have_posts()):
                $r->the_post();
                $the_id = get_the_ID();
                $size = 'full';
                $current_post['title'] = get_the_title();
                
                $ajax_content = get_post_meta($the_id, '_ajax_content', true);
                $main_content = get_the_content();
                
                $the_content = (!empty($ajax_content)) ? $ajax_content : $main_content;
                
                $image_height = $mk_options['Portfolio_single_image_height'];

                $post_type = get_post_meta($the_id, '_single_post_type', true);
                $post_type = $post_type ? $post_type : 'image';


                $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', true);

                $featured_image_src = Mk_Image_Resize::resize_by_id( get_post_thumbnail_id(), 'full', $mk_options['grid_width'], $image_height, $crop = false, $dummy = true);
                
                ?>
                
                <div class="ajax_project" data-project_id="<?php echo $the_id; ?>">
                
                    <?php 

                    /* Social Share icons */
                    if ($mk_options['single_portfolio_social'] == 'true'): ?>
                        <div class="single-social-section portfolio-social-share ajax-portfolio-share">
                        
                        <div class="mk-love-holder"><?php echo Mk_Love_Post::send_love(); ?></div>
                        <div class="blog-share-container">
                        <div class="blog-single-share mk-toggle-trigger"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-share-2', 16); ?></div>
                        <ul class="single-share-box mk-box-to-trigger">
                        <li>
                            <a class="facebook-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#">
                            <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-facebook', 16); ?>
                            </a>
                        </li>

                        <li>
                            <a class="twitter-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#">
                            <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-twitter', 16); ?>   
                            </a>
                        </li>

                        <li>
                            <a class="googleplus-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#">
                            <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-googleplus', 16); ?>    
                            </a>
                        </li>

                        <li>
                            <a class="linkedin-share" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#">
                            <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-linkedin', 16); ?>
                            </a>
                        </li>

                        <?php if ($post_type == 'image') { ?>
                            <li>
                                <a class="pinterest-share" data-image="<?php echo $image_src_array[0]; ?>" data-title="<?php the_title_attribute(); ?>" data-url="<?php echo esc_url( get_permalink() ); ?>" href="#">
                                <?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-simple-pinterest', 16); ?>
                                </a>
                            </li>
                        <?php } ?>
                        </ul>
                        </div>
                        </div>
                    <?php endif; ?>


                    <div class="project_description">
                        <?php 
                            // Switched from h3 to h2 to follow same semantics and styling as in v4 - Maki
                        ?>
                        <h2 class="title"><?php the_title(); ?></h2>

                        <?php
                        $featured_image = get_post_meta($the_id, '_portfolio_featured_image', true);
                        $featured_image = $featured_image ? $featured_image : 'true';

                        if ($featured_image != 'false') {
                            if ($post_type == 'image') { ?>
                                <div class="single-featured-image">
                                <a class="mk-lightbox portfolio-modern-lightbox" data-fancybox-group="portfolio-ajax-image" title="<?php the_title_attribute(); ?>" href="<?php echo $image_src_array[0]; ?>">
                                    <img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo $featured_image_src; ?>" />
                                </a>
                                </div>
                            <?php } 
                            elseif ($post_type == 'video') {
                                $video_height = round($mk_options['grid_width'] / 1.77777);
                                $video_id = get_post_meta($the_id, '_single_video_id', true);
                                $video_site = get_post_meta($the_id, '_single_video_site', true);
                                
                                if ($video_site == 'vimeo') { ?>
                                    <div class="mk-portfolio-video">
                                        <div class="mk-video-container">
                                            <iframe src="//player.vimeo.com/video/<?php echo $video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;" width="<?php echo $mk_options['grid_width']; ?>" height="<?php echo $video_height; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                        </div>
                                    </div>
                                <?php }
                                if ($video_site == 'youtube') { ?>
                                    <div class="mk-portfolio-video">
                                        <div class="mk-video-container">
                                            <iframe src="//www.youtube.com/embed/<?php echo $video_id; ?>?showinfo=0" frameborder="0" width="<?php echo $mk_options['grid_width']; ?>" height="<?php echo $video_height; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                        </div>
                                    </div>
                                <?php }
                                if ($video_site == 'dailymotion') { ?>
                                    <div  class="mk-portfolio-video">
                                        <div class="mk-video-container">
                                            <iframe src="//www.dailymotion.com/embed/video/<?php echo $video_id; ?>?logo=0" frameborder="0" width="<?php echo $mk_options['grid_width']; ?>" height="<?php echo $video_height; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                                        </div>
                                    </div>
                                <?php }
                            }
                        }
                        if (preg_match('/vc_row fullwidth="true"/', $the_content) || preg_match('/mk_page_section/', $the_content)) {
                            echo do_shortcode('[mk_message_box type="warning-message"]Page Section or Fullwidth Rows are used in this single post. Either remove page sections and disable fullwidth feature of Rows or use Ajax Content metabox field (without mentioned shortcodes and options).[/mk_message_box]');
                        } 
                        else {
                            echo str_replace(']]>', ']]&gt;', apply_filters('the_content', $the_content));
                        } ?>
                        </div>
                </div>
            <?php 
            endwhile;
        endif;
        wp_reset_query();

    }
}


new Mk_Ajax_Portfolio();
