<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $layout
 * @var $content
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_Eventbrite
 */
$el_class = $layout = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//$countdown_data = trim($date).' '.trim($month) .' '.trim($year).' '. trim($time);
?>
<?php if($layout == 'modal') :?>
<div class="modal fade" id="eventbrite-register" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-transparent" role="document">
        <div class="modal-content">
            <div class="modal-body">
<?php endif;?>
                <div class="eventbrite-wrapper <?php echo esc_attr($el_class );?>">
                    <?php echo rawurldecode( base64_decode( strip_tags( $content ) ) );?>
                </div>
<?php if($layout == 'modal') :?>
            </div>

        </div>
    </div>
</div>
<?php endif;?>