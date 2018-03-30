<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Number Admin View
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $web_fonts_select, $google_fonts_select, $google_fonts_json;

$default_css_style_selectors = array(
    'color'     => 'color',
    'family'    => 'font-family',
    'size'      => 'font-size',
    'style'     => 'font-weight',
    'uppercase' => 'text-transform',
    'align'     => 'text-align'
);

if( ! isset( $preview ) ) {
    $preview = true;
}

$require_style_css_selectors = array_map( 'trim', explode( ',', $style['properties'] ) );
$default_value_string = $std;
if( isset( $std['style'] ) ) {
    $std_style = str_replace('700', 'bold', $std['style']);
    $default_value_string['style'] = $std_style;
}

if( isset( $std['size'] ) && $std['size'] != '' ){
    $default_value_string['size'] = $default_value_string['size'] . $default_value_string['unit'];
    unset( $default_value_string['unit'] );
}

if ( !isset( $google_fonts_json ) ):
    $google_fonts_json = yit_get_json_google_fonts();
    $web_fonts_json = yit_get_json_web_fonts();
    ?>
    <script>
        var yit_google_fonts    = '<?php echo $google_fonts_json ?>';
        var yit_web_fonts       = '<?php echo $web_fonts_json ?>';
        var yit_family_string   = '';
        var yit_default_name    = '<?php _e('Default Theme Font', 'yit')?>';
    </script>
<?php endif ?>

<div id="<?php echo $id ?>-container" <?php if( isset( $is_default ) && $is_default ):?>data-is-default="true"<?php endif;?> <?php if( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $deps['values'] ?>" <?php endif ?>class="typography_container yit_options rm_typography rm_option rm_input rm_number rm_text">
    <div class="option">
        <label for="<?php echo $id ?>"><?php echo $name ?>
            <small>
                <?php echo $desc ?>
                <?php printf( __( '(Default: %s)', 'yit' ), implode( ', ', $default_value_string ) ) ?>
            </small>
        </label>

        <?php
        if( isset( $std['color'] ) ) {
            $std_color = $std['color'];
        }

        $std = yit_get_option( $id ); ?>

        <?php if( in_array($default_css_style_selectors['size'], $require_style_css_selectors  ) ) : ?>
            <!-- Size -->
            <div class="spinner_container">
                <input class="typography_size number" type="text" name="<?php yit_field_name( $id ) ?>[size]" id="<?php echo $id ?>-size" value="<?php echo esc_attr( $std['size'] ) ?>" data-min="<?php if(isset( $min )) echo $min ?>" data-max="<?php if(isset( $max )) echo $max ?>" />
            </div>

            <!-- Unit -->
            <div class="select_wrapper font-unit">
                <select class="typography_unit" name="<?php yit_field_name( $id ) ?>[unit]" id="<?php echo $id ?>-unit">
                    <option value="px"  <?php selected( $std['unit'], 'px' )  ?>><?php _e( 'px', 'yit' ) ?></option>
                    <option value="em"  <?php selected( $std['unit'], 'em' )  ?>><?php _e( 'em', 'yit' ) ?></option>
                    <option value="pt"  <?php selected( $std['unit'], 'pt' )  ?>><?php _e( 'pt', 'yit' ) ?></option>
                    <option value="rem" <?php selected( $std['unit'], 'rem' ) ?>><?php _e( 'rem', 'yit' ) ?></option>
                </select>
            </div>
        <?php endif; ?>

        <?php if( in_array($default_css_style_selectors['family'], $require_style_css_selectors  ) ) : ?>
            <!-- Family -->
            <div class="select_wrapper font-family">
                <select class="typography_family" name="<?php yit_field_name( $id ) ?>[family]" id="<?php echo $id ?>-family" data-instance="false" <?php if( isset( $default_font_id ) ) : ?> data-default-font-id="<?php echo $default_font_id ?>" <?php endif; ?>>
                    <?php if( isset($std['family']) && $std['family'] != 'default' ) : ?>
                        <option value="<?php echo stripslashes( $std['family'] ) ?>"><?php echo $std['family'] ?></option>
                    <?php else: ?>
                        <option value="<?php echo stripslashes( $std['family'] ) ?>"><?php _e('Default Theme Font', 'yit') ?></option>
                    <?php endif; ?>
                </select>
            </div>
        <?php endif; ?>

        <?php if( in_array($default_css_style_selectors['style'], $require_style_css_selectors  ) ) : ?>
            <!-- Style -->
            <div class="select_wrapper font-style">
                <select class="typography_style" name="<?php yit_field_name( $id ) ?>[style]" id="<?php echo $id ?>-style" data-first-init="false">
                    <option value="<?php echo stripslashes( $std['style'] ) ?>"> <?php echo $std_style ?></option>
                </select>
            </div>
        <?php endif; ?>

        <?php if( in_array($default_css_style_selectors['color'], $require_style_css_selectors  ) ) : ?>
            <!-- Color -->
            <div id="<?php echo $id ?>_container" class="typography_color colorpicker_container">
                <input type="text" name="<?php yit_field_name( $id ) ?>[color]" id="<?php echo $id ?>-color" value="<?php echo esc_attr( $std['color'] ) ?>" style="width:75px" data-default-color="<?php echo $std_color ?>" class="medium-text code panel-colorpicker" />
            </div>
        <?php endif; ?>

        <?php if( in_array($default_css_style_selectors['align'], $require_style_css_selectors  ) ) : ?>
            <!-- Align -->
            <div class="select_wrapper text-align">
                <select class="typography_align" name="<?php yit_field_name( $id ) ?>[align]" id="<?php echo $id ?>-align">
                    <option value="left"    <?php selected( $std['align'], 'left' )  ?>><?php _e( 'Left', 'yit' ) ?></option>
                    <option value="center"  <?php selected( $std['align'], 'center' )  ?>><?php _e( 'Center', 'yit' ) ?></option>
                    <option value="right"   <?php selected( $std['align'], 'right' )  ?>><?php _e( 'Right', 'yit' ) ?></option>
                </select>
            </div>
        <?php endif; ?>

        <?php if( in_array($default_css_style_selectors['uppercase'], $require_style_css_selectors  ) ) : ?>
            <!-- Uppercase -->
            <div class="select_wrapper text-transform">
                <select class="typography_transform" name="<?php yit_field_name( $id ) ?>[transform]" id="<?php echo $id ?>-transform">
                    <option value="none"       <?php selected( $std['transform'], 'none'       )  ?>><?php _e( 'None',       'yit' ) ?></option>
                    <option value="lowercase"  <?php selected( $std['transform'], 'lowercase'  )  ?>><?php _e( 'Lowercase',  'yit' ) ?></option>
                    <option value="uppercase"  <?php selected( $std['transform'], 'uppercase'  )  ?>><?php _e( 'Uppercase',  'yit' ) ?></option>
                    <option value="capitalize" <?php selected( $std['transform'], 'capitalize' )  ?>><?php _e( 'Capitalize', 'yit' ) ?></option>
                </select>
            </div>
        <?php endif; ?>



    </div>
    <div class="clear"></div>
    <?php if ( $preview ) : ?>
        <div class="font-preview">
            <p>The quick brown fox jumps over the lazy dog</p>
            <!-- Refresh -->
            <div class="refresh_container">
                <button class="refresh">
                    <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/search.png" title="<?php esc_attr_e( 'Click to preview', 'yit' ) ?>" alt="" /><?php _e( 'Click to preview', 'yit' ) ?>
                </button>
            </div>
        </div>
    <?php endif; ?>
</div>
