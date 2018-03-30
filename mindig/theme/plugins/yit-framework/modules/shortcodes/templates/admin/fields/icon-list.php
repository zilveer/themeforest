<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Icon Manager
 *
 * @package    Yithemes
 * @author     Emanuela Castorina <emanuela.castorina@yithemes.com>
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


$icon_list = YIT_Plugin_Common::get_icon_list();


?>
<div class="fieldset" id="<?php echo $var[0].'-'.$var[2]?>-container" <?php if ( isset($var[1]['deps']) ): ?>data-field="<?php echo $var[0].'-'.$var[2] ?>" data-dep="<?php echo $var[1]['deps']['ids'].'-'.$var[2] ?>" data-value="<?php echo $var[1]['deps']['values'] ?>"<?php endif;?> >

    <div class="icon-manager-text">
        <label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
        <div class="icon-preview"></div>
        <input type="text" id="<?php echo $var[0].'-'.$var[2].'-icon'; ?>" class="icon-text <?php echo ( isset($var[1]['composer_layout']) && $var[1]['composer_layout'] ) ? 'wpb_vc_param_value' : '' ?>" name="<?php echo ( isset($var[1]['composer_layout']) && $var[1]['composer_layout'] ) ? '' : 'shortcode-' ?><?php echo $var[0]; ?>" value="<?php echo esc_attr( $var[1]['std'] ); ?>" />
        <?php if (isset($var[1]['description']) && $var[1]['description'] != '') : ?>
            <span class="description"><?php echo $var[1]['description']; ?></span>
        <?php endif; ?>
    </div>


    <div class="icon-manager">
        <ul class="icon-list-wrapper">
            <?php foreach ( $icon_list as $font => $icons ):
                    foreach ( $icons as $key => $icon ): ?>
                      <li data-font="<?php echo esc_attr( $font )  ?>" data-icon="<?php echo  ( strpos( $key , '\\') === 0 ) ? '&#x'.substr( $key , 1 ) : $key  ?>" data-key="<?php echo esc_attr( $key ) ?>" data-name="<?php echo esc_attr( $icon ) ?>"></li>
            <?php
                    endforeach;
            endforeach; ?>
        </ul>
    </div>

</div>
<script>
    (function($) {
        var $icon_list = $('ul.icon-list-wrapper'),
            $preview = $('.icon-preview'),
            $element_list = $icon_list.find('li'),
            $icon_text = $('.icon-text');

        $element_list.on("click",function() {
            var  $t = $(this);
            $element_list.removeClass('active');
            $t.addClass('active');
            $preview.attr('data-font', $t.data('font'));
            $preview.attr('data-icon', $t.data('icon'));
            $preview.attr('data-name', $t.data('name'));
            $preview.attr('data-key', $t.data('key'));

            $icon_text.val( $t.data('font')+':'+$t.data('name'));

        });

    })(jQuery);
</script>