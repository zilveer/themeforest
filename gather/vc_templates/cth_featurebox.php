<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $icon
 * @var $title
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Featurebox
 */
$el_class = $icon = $title = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

?>
<div class="benefit-item <?php echo esc_attr($el_class );?>">
<?php
$icon = preg_replace("/^icon-([\w-_]+)$/i", '$1', $icon);
if(!empty($icon)){ ?>
    <div class="benefit-icon"><i class="icon icon-<?php echo esc_attr($icon );?>"></i></div>
<?php
}
?>
<?php if(!empty($title)) :?>
    <h6 class="benefit-title"><?php echo esc_attr($title );?></h6>
<?php endif;?>
    <?php echo wpb_js_remove_wpautop($content,true);?>
</div>