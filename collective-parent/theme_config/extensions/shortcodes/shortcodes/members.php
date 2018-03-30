<?php
/**
 * Members
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_members($atts, $content = null) {
    global $memebers_uniq;
    extract(shortcode_atts(array('order' => 'RAND','title' => '', 'display' => ''), $atts));
    $output = '';
    $memebers_uniq = rand(500, 600);

    if (!empty($order) && ($order == 'ASC' || $order == 'DESC')) $order = '&order=' . $order;
    else $order = '&orderby=rand';

    $posts = get_posts('post_type=members&posts_per_page=-1&suppress_filters=0' . $order);

    if($display == 'cols1'){
        if($title != '') $output .= '<div class="title clearfix"><h2>'.$title.'</h2></div>';
        $output .= '<div class="row"><div class="span6"><div class="team_members clearfix">
            <div id="team_carousel'.$memebers_uniq.'">';
            foreach($posts as $item){
                $src = tfuse_page_options('thumbnail_image','',$item->ID);
                $twitter = tfuse_page_options('twitter_username','',$item->ID);
                if($src != ''){
                    $image = new TF_GET_IMAGE();
                    $img = $image->width(225)->height(202)->src($src)->get_img();
                }else $img = '';
                $output .= '<div class="member_team clearfix ">
                    <div class="member_info alignleft">';
                        if($img != '') $output .= '<div class="member_img">'.$img.'</div>';
                        if($twitter != '') $output .= '<div class="member_meta clearfix"><span class="tweet_ico">@<a target="_blank" href="https://twitter.com/'.$twitter.'">'.$twitter.'</a></span></div>';
                    $output .= '</div>
                    <div class="member_desc">
                        <h3 class="member_name">'.get_the_title($item->ID).'</h3>
                        <span class="member_post">'.tfuse_page_options('profession','',$item->ID).'</span>'.$item->post_excerpt.'
                    </div>
                    <a href="'.get_permalink($item->ID).'" class="link_read">'.__('Read more','tfuse').'</a>
                </div>';
            }
            $output .= '</div>
            <div class="team_carousel_nav"><a class="prev" id="team_item_prev'.$memebers_uniq.'" href="#"></a><a class="next" id="team_item_next'.$memebers_uniq.'" href="#"></a></div>
            </div></div></div>
            <script>
                jQuery(window).load(function() {
                    function start_member_carousel(){
                        jQuery("#team_carousel'.$memebers_uniq.'").carouFredSel({
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
                                pauseOnHover: true,
                                fx : "crossfade"
                            },
                            auto: 6000,
                            prev: "#team_item_prev'.$memebers_uniq.'",
                            next: "#team_item_next'.$memebers_uniq.'",
                            swipe: true,
                            mousewheel: false
                        });
                    }
                    start_member_carousel();
                    jQuery(".nav-tabs li").click(function(){
                         start_member_carousel();
                    });
                });
            </script>';
    }
    elseif($display == 'cols2'){
        if($title != '') $output .= '<div class="title clearfix"><h2>'.$title.'</h2></div>';
        $output .= '<div class="team_carousel carousel clearfix">
            <div class="team_carousel_inner">
                <div class="row">
                    <div id="team_list'.$memebers_uniq.'">';
                    foreach($posts as $item){
                        if(tfuse_page_options('thumbnail_image','',$item->ID) !=''){
                            $image = new TF_GET_IMAGE();
                            $img = $image->width(300)->height(300)->src(tfuse_page_options('thumbnail_image','',$item->ID))->get_img();
                        }
                        $output .= '<div class="span4"><a href="'.get_permalink($item->ID).'">'.$img.'</a></div>';
                    }

            $output .= '</div>
                  </div>
                </div>
            <div class="carousel_nav">
                <a class="prev" id="team_item_prev'.$memebers_uniq.'" href="#"></a><a class="next" id="team_item_next'.$memebers_uniq.'" href="#"></a>
            </div>
            <script>
            jQuery(window).load(function() {
                jQuery("#team_list'.$memebers_uniq.'").carouFredSel({
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
                    auto: 7000,
                    prev: "#team_item_prev'.$memebers_uniq.'",
                    next: "#team_item_next'.$memebers_uniq.'",
                    swipe: true,
                    mousewheel: false
                });
            });
            </script>
            </div>';
    }
    return $output;
}

$atts = array(
    'name' => __('Members','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title of an shortcode','tfuse'),
            'id' => 'tf_shc_members_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Display type','tfuse'),
            'desc' => __('Select display type','tfuse'),
            'id' => 'tf_shc_members_display',
            'value' => '',
            'options' => array(
                'cols1' => __('In 1 Column','tfuse'),
                'cols2' => __('In 2 Columns','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Order','tfuse'),
            'desc' => __('Select display order','tfuse'),
            'id' => 'tf_shc_members_order',
            'value' => 'DESC',
            'options' => array(
                'RAND' => __('Random','tfuse'),
                'ASC' => __('Ascending','tfuse'),
                'DESC' => __('Descending','tfuse'),
            ),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('members', 'tfuse_members', $atts);