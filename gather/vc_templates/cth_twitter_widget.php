<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $statuslink
 * @var $width
 * @var $lang
 * @var $align
 * @var $hidecard
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Twitter_Widget
 */
$el_class = $statuslink = $width = $lang = $align = $hidecard = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

?>
<div class="embed-tweet-item <?php echo esc_attr($el_class );?>">
    <blockquote class="twitter-tweet" lang="<?php echo esc_attr($lang);?>" data-width="<?php echo esc_attr($width);?>" data-link-color="#4eae49" data-align="<?php echo esc_attr($align);?>" <?php if($hidecard == 'yes') echo 'data-cards="hidden"';?>>
        <a href="<?php echo esc_url($statuslink );?>"></a>
    </blockquote>
</div>
<!-- end .embed-tweet-item -->
<?php //echo wpb_js_remove_wpautop($content,true);?>