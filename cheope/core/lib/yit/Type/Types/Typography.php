<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * YIT Type: Typography
 *
 * @since 1.0.0
 */
class YIT_Type_Typography {

    /**
     * Load and print the correspondent field type.
     *
     * @param @field
     * @return string
     */
    public static function display( $value, $dep ) {

        global $web_fonts_select, $google_fonts_select, $google_fonts_json;

        if ( ! isset( $google_fonts_json ) ) {
            $google_fonts_json = yit_get_json_google_fonts();
            $web_fonts_json = yit_get_json_web_fonts();

            echo "<script>";
            echo "var yit_google_fonts = '" . $google_fonts_json . "';\n";
            echo "var yit_web_fonts = '" . $web_fonts_json . "';\n";
            echo "var yit_family_string = '';\n";
            echo "</script>\n";
        }

        $std = yit_get_option( $value['id'] );
        ob_start(); ?>
        <?php if( yit_is_safari_on_mavericks() ): ?>
            <div id="<?php echo $value['id_container'] ?>" class="yit_options rm_option rm_input rm_text">
                <h3><?php echo $value['name'] ?></h3>
                <p><p><?php _e("We're sorry but there are some issues with new version of Safari on Mavericks. In order to use typography options please use another browser as Chrome or Firefox. We're alredy working hard to check the issue out.", 'yit'); ?></p>
            </div>
        <?php else: ?>

            <div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="typography_container yit_options rm_typography rm_option rm_input rm_number rm_text">
                <div class="option">
                    <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?> <small><?php echo $value['desc'] ?> <?php printf( __( '(Default: %s)', 'yit' ), $value['std']['size'] .  $value['std']['unit'] . ', ' .  $value['std']['family'] . ', ' .  ucfirst( str_replace( '-', ' ', $value['std']['style'] ) ) . ', ' .  $value['std']['color'] ) ?></small></label>

                    <!-- Size -->
                    <div class="spinner_container">
                        <input class="typography_size number" type="text" name="<?php yit_field_name( $value['id'] ) ?>[size]" id="<?php echo $value['id'] ?>-size" value="<?php echo $std['size'] ?>" data-min="<?php if(isset( $value['min'] )) echo $value['min'] ?>" data-max="<?php if(isset( $value['max'] )) echo $value['max'] ?>" />
                    </div>

                    <!-- Unit -->
                    <div class="select_wrapper font-unit">
                        <select class="typography_unit" name="<?php yit_field_name( $value['id'] ) ?>[unit]" id="<?php echo $value['id'] ?>-unit">
                            <option value="px" <?php selected( $std['unit'], 'px' ) ?>><?php _e( 'px', 'yit' ) ?></option>
                            <option value="em" <?php selected( $std['unit'], 'em' ) ?>><?php _e( 'em', 'yit' ) ?></option>
                            <option value="pt" <?php selected( $std['unit'], 'pt' ) ?>><?php _e( 'pt', 'yit' ) ?></option>
                            <option value="rem" <?php selected( $std['unit'], 'rem' ) ?>><?php _e( 'rem', 'yit' ) ?></option>
                        </select>
                    </div>

                    <!-- Family -->
                    <div class="select_wrapper font-family">
                        <select class="typography_family" name="<?php yit_field_name( $value['id'] ) ?>[family]" id="<?php echo $value['id'] ?>-family" data-instance="false">
                            <?php if( $std['family'] ): ?>
                                <option value="<?php echo stripslashes( $std['family'] ) ?>"><?php echo $std['family'] ?></option>
                            <?php else: ?>
                                <option value=""><?php _e('Select a font family', 'yit') ?></option>
                            <?php endif ?>
                        </select>
                    </div>

                    <!-- Style -->
                    <div class="select_wrapper font-style">
                        <select class="typography_style" name="<?php yit_field_name( $value['id'] ) ?>[style]" id="<?php echo $value['id'] ?>-style">
                            <option value="regular" <?php selected( $std['style'], 'regular' ) ?>><?php _e( 'Regular', 'yit' ) ?></option>
                            <option value="bold" <?php selected( $std['style'], 'bold' ) ?>><?php _e( 'Bold', 'yit' ) ?></option>
                            <option value="extra-bold" <?php selected( $std['style'], 'extra-bold' ) ?>><?php _e( 'Extra bold', 'yit' ) ?></option>
                            <option value="italic" <?php selected( $std['style'], 'italic' ) ?>><?php _e( 'Italic', 'yit' ) ?></option>
                            <option value="bold-italic" <?php selected( $std['style'], 'bold-italic' ) ?>><?php _e( 'Italic bold', 'yit' ) ?></option>
                        </select>
                    </div>

                    <!-- Color -->
                    <div id="<?php echo $value['id'] ?>_container" class="typography_color colorpicker_container" data-color="<?php echo $std['color'] ?>"><div style="background-color: <?php echo $std['color'] ?>"></div></div>
                    <input type="text" name="<?php yit_field_name( $value['id'] ) ?>[color]" id="<?php echo $value['id'] ?>-color" style="width:150px" value="<?php echo $std['color'] ?>" />

                </div>
                <div class="clear"></div>
                <div class="font-preview">
                    <p>The quick brown fox jumps over the lazy dog</p>
                    <!-- Refresh -->
                    <div class="refresh_container"><button class="refresh"><img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/search.png" title="<?php _e( 'Click to preview', 'yit' ) ?>" alt="" /><?php _e( 'Click to preview', 'yit' ) ?></button></div>
                </div>
            </div>
        <?php endif ?>
        <?php
        return ob_get_clean();
    }
}