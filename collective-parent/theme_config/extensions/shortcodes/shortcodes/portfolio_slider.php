<?php
/**
 * Portfolio Slider
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_portfolio_slider($atts, $content = null) {
    extract(shortcode_atts(array('title' => '', 'multi' => ''), $atts));
    $arr_ids = explode(',',$multi);
    $uniq = rand(100,200);
    $args = array(
        'posts_per_page'=> -1,
        'post_type'     => 'portfolio',
        'orderby'       => 'post_date',
        'order'         => 'DESC',
        'include'       => $arr_ids,
        'post_status'   => 'publish',
    );
    $portfolios = get_posts($args);
    // for order in initial order
    $portfolios_ord = array();
    foreach($arr_ids as $key=>$ord){
        foreach($portfolios as $unord){
            if($ord==$unord->ID) {
                $portfolios_ord[$key] = $unord;
                continue;
            }
        }
    }
    $out = '';

    if($title !='' ) $out .= '<div class="title clearfix"><h2>'.tfuse_qtranslate($title).'</h2></div>';
    $out .= '<div class="portfolio_carousel carousel clearfix">
        <div class="portfolio_carousel_inner">
            <div class="row">
                <div id="portfolio_list'.$uniq.'">';
                foreach($portfolios_ord as $item){
                    $src = tfuse_page_options('thumbnail_image','single_image',$item->ID);
                    if($src != ''){
                        $image = new TF_GET_IMAGE();
                        $tfuse_image = $image->width(225)->height(202)->src($src)->get_img();
                        $out .= '<div class="portfolio_item">
                            <div class="portfolio_img">'.$tfuse_image.'</div>
                            <div class="meta_info clearfix">
                                <span class="meta_date">'.date("M j, Y", strtotime($item->post_date)).'</span><span class="meta_author">'.get_the_author().'</span><a class="link_more" href="'.get_permalink($item->ID).'"></a>
                            </div>
                            <div class="portfolio_title"><h5>'.$item->post_title.'</h5></div>
                        </div>';
                    }
                }
                $out .= '</div>
            </div>
        </div>
        <div class="carousel_nav"><a class="prev" id="portfolio_item_prev'.$uniq.'" href="#"></a><a class="link_all" href="?post_type=portfolio&posts=all"></a><a class="next" id="portfolio_item_next'.$uniq.'" href="#"></a></div>
        <script>
            jQuery(window).load(function() {
                jQuery("#portfolio_list'.$uniq.'").carouFredSel({
                    width: "100%",
                    height: "variable",
                    items: {
                        visible: "variable",
                        minimum: 1,
                        width: "variable",
                        height: "variable"
                    },
                    scroll: {
                        items: 1,
                        pauseOnHover: true
                    },
                    auto: false,
                    prev: "#portfolio_item_prev'.$uniq.'",
                    next: "#portfolio_item_next'.$uniq.'",
                    swipe: true,
                    mousewheel: false
                });
           });
          </script>
    </div>';

    return $out;
}

$atts = array(
    'name' => __('Portfolio Slider','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 6,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title.','tfuse'),
            'id' => 'tf_shc_portfolio_slider_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Enter portfolio posts','tfuse'),
            'desc' => __('Enter portfolio posts.','tfuse'),
            'id' => 'tf_shc_portfolio_slider_multi',
            'value' => '',
            'type' => 'multi',
            'subtype' => 'portfolio',
        )
    )
);

tf_add_shortcode('portfolio_slider', 'tfuse_portfolio_slider', $atts);