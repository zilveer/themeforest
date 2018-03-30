<?php
  
// FAQ
add_shortcode('faq', 'venedor_shortcode_faq');
function venedor_shortcode_faq($atts, $content = null) {

    global $post;
    
    extract(shortcode_atts(array(
        'cats' => 0,
        'filter' => 'false',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    
    $args = array(
        'post_type' => 'faq',
        'nopaging' => true
    );
    $cats = explode(',', $cats);
    if ($cats && in_array(0, $cats)) {
        $cats = false;
    }
    
    if ($cats) {
        $args['tax_query'][] = array(
            'taxonomy' => 'faq_cat',
            'field' => 'ID',
            'terms' => $cats
        );
    }
    $faqs = new WP_Query($args);
    $faq_taxs = array();
    if (is_array($faqs->posts) && !empty($faqs->posts)) {
        foreach ($faqs->posts as $faq) {
            $post_taxs = wp_get_post_terms($faq->ID, 'faq_cat', array("fields" => "all"));
            if (is_array($post_taxs) && !empty($post_taxs)) {
                foreach ($post_taxs as $post_tax) {
                    if (is_array($cats) && !empty($cats) && in_array($post_tax->term_id, $cats)) {
                        $faq_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                    }

                    if (empty($cats) || !isset($cats)) {
                        $faq_taxs[urldecode($post_tax->slug)] = $post_tax->name;
                    }
                }
            }
        }
    }
    if (is_array($faq_taxs)) {
        asort($faq_taxs);
    } 
    ob_start();?>
    <div class="shortcode shortcode-faq <?php echo $class ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <?php if (is_array($faq_taxs) && !empty($faq_taxs) && ($filter=="true"?true:false)) : ?>
        <ul class="faq-filter clearfix">
            <li><a class="active" data-filter="*" href="#"><?php echo __('All', 'venedor'); ?></a></li>
            <?php foreach ($faq_taxs as $faq_tax_slug => $faq_tax_name) : ?>
            <li><a data-filter=".<?php echo $faq_tax_slug; ?>" href="#"><?php echo $faq_tax_name; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <div class="faq-wrapper panel-group" id="faqs">
            <?php
            while ($faqs->have_posts()): $faqs->the_post();
                $item_classes = '';
                $item_cats = get_the_terms($post->ID, 'faq_cat');
                if ($item_cats):
                    foreach ($item_cats as $item_cat) {
                        $item_classes .= urldecode($item_cat->slug) . ' ';
                    }
                endif;
                ?>
                <div class="post-item <?php echo $item_classes; ?> panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#faqs" href="#collapse<?php the_ID() ?>"><span class="faq-icon"><span class="fa"></span></span> <?php the_title(); ?></a>
                        </h4>
                    </div>
                    <div id="collapse<?php the_ID() ?>" class="panel-collapse collapse">
                        <div class="panel-body"><?php the_content() ?></div>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php
    $str = ob_get_contents();
    ob_end_clean();

    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_faq() {
        $vc_icon = venedor_vc_icon().'faq.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "FAQ",
            "base" => "faq",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "FAQ Category IDs",
                    "param_name" => "cats",
                    "value" => "0",
                    "description" => "Comma separated list of faq category ids.",
                    "admin_label" => true
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Show Filter",
                    "param_name" => "filter",
                    "value" => "false",
                    "admin_label" => true
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCodes' ) ) {
            class WPBakeryShortCode_Faq extends WPBakeryShortCodes {
            }
        }
    }
}