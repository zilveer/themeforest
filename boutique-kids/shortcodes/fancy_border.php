<?php


function dtbaker_shortcode_fancy_border($atts, $innercontent='', $code='') {
    extract(shortcode_atts(array(
        'id' => false,
        'class' => '',
    ), $atts));
    // query wordpress for posts in this category.
    ob_start();
    ?>
    <div class="fancy_border<?php echo strlen($class) ? ' '.esc_attr($class) : '';?>">
    <?php
    // already escaped/sanatised by wordpress:
    echo trim($innercontent);?>
    </div>
<?php
    return force_balance_tags(ob_get_clean());
}
add_shortcode('fancy_border', 'dtbaker_shortcode_fancy_border');


function dtbaker_shortcode_caption_fancy_border($output, $atts, $content){
	if ( $output != '' )
		return $output;
    if(isset($atts['caption'])){
        $content .= '<p class="wp-caption-text">' . esc_html($atts['caption']) . '</p>';
    }
    if(isset($atts['align'])){
        $atts['class'] = isset($atts['class']) ? esc_attr($atts['class']) . ' ' . esc_attr($atts['align']) : esc_attr($atts['align']);
    }
    return dtbaker_shortcode_fancy_border($atts, $content);
}
add_filter('img_caption_shortcode', 'dtbaker_shortcode_caption_fancy_border', 10, 3);
