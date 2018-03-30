<?php
/**
 * Minigallery
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * id: post/page id
 * order: ASC, DESC
 * orderby:
 * include:
 * exclude:
 * pretty: true/false use or not prettyPhoto
 * icon_plus:
 * class: css class e.g. boxed
 * carousel: jCarousel Configuration. http://sorgalla.com/projects/jcarousel/
 */

function tfuse_minigallery($attr, $content = null)
{
    extract(shortcode_atts(array('title' => '','id'=>''), $attr));
    global $post;

    extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id' => isset($post->ID) ? $post->ID : $attr['id'],
            'include'    => '',
            'exclude'    => '',
            'pretty'     => true,
            'carousel'   => 'easing: "easeInOutQuint",animation: 600',
            'class'      => 'boxed',
			'prettyphoto' => '',
    ), $attr));

    $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

    if ( empty($attachments) ) return '';

    $uniq = rand(1, 200);

    $out = '<h2>'.$title.'</h2>
    <div class="minigallery_carousel">
        <div class="carousel_content">
            <ul id="minigallery'.$uniq.'">';
            foreach ($attachments as $id => $attachment)
            {
                $link = wp_get_attachment_image_src($id, 'full', true);
                $image_link_attach = $link[0];
                $imgsrc = wp_get_attachment_image_src($id, array(100, 100), false);
                $image_src = $imgsrc[0];

                $image = new TF_GET_IMAGE();
                $img = $image->width(100)->height(100)->properties(array('alt' => $attachment->post_title))->src($image_src)->get_img();

                if ($prettyphoto == 'true' )
                    $out .= '<li><a href="' . $image_link_attach . '" data-rel="prettyPhoto[mg'.$uniq.']" class="zoom" rel="prettyPhoto[mg'.$uniq.']">'.$img.'</a></li>';
                else
                    $out .= '<li>' . $img . '</li>';
            }

            $out .= '</ul>
        </div><a class="prev" id="minigallery'.$uniq.'_prev" href="#"><span>'.__('prev','tfuse').'</span></a><a class="next" id="minigallery'.$uniq.'_next" href="#"><span>'.__('next','tfuse').'</span></a>
    </div>';
    $out .= '<script>
            jQuery(document).ready(function() {
                function minigallery_start(){
                    jQuery("#minigallery'.$uniq.'").carouFredSel({
                        next : "#minigallery'.$uniq.'_next",
                        prev : "#minigallery'.$uniq.'_prev",
                        auto: false,
                        circular: false,
                        infinite: true,
                        width: "100%",
                        scroll: {
                            items : 1
                        }
                    });
                }
                minigallery_start();
                jQuery("ul.nav-tabs li a").click(function(){
                    minigallery_start();
                });
            });
        </script>';
    return $out;
}

$atts = array(
    'name' => __('Minigallery','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 6,
    'options' => array(
        array(
            'name' => __('ID','tfuse'),
            'desc' => __('Specifies the post or page ID. For more detail about this shortcode follow the <a href="http://codex.wordpress.org/Template_Tags/get_posts" target="_blank">link</a>','tfuse'),
            'id' => 'tf_shc_minigallery_id',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Specifies the title for minigallery.','tfuse'),
            'id' => 'tf_shc_minigallery_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
        'name' => __('prettyPhoto','tfuse'),
        'desc' => __('Open images with prettyphoto','tfuse'),
        'id' => 'tf_shc_minigallery_prettyphoto',
        'value' => 'false',
        'type' => 'checkbox'
        )

    )
);

tf_add_shortcode('minigallery', 'tfuse_minigallery', $atts);