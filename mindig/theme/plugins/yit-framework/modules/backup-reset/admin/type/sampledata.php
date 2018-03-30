<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( $has_skins ){
    $default_data       = $options['default']['data'];
    $default_preview    = YIT_THEME_ASSETS_URL . '/images/skins/default.png';
}else{
    $theme              = wp_get_theme();
    $default_data       = YIT_DEFAULT_DUMMY_DATA;
    $default_preview    = $theme->get_screenshot();
}

?>

<div class="yit_options sampledata sampledata-<?php echo sanitize_title($title) ?>">

    <h3><?php echo $title ?></h3>

    <p><?php echo str_replace('%s', get_template(), $desc) ?></p>

    <div class="option sampledata">
        <?php if( $has_skins ) : ?>
             <div class="select_wrapper skin_change">
                 <select name="sampledata_skins_list" class="select_wrapper skin_type" id="sampledata_skins_list">
                    <?php foreach ( $options as $val => $option ) { ?>
                        <option data-skin_name="<?php echo $val ?>" value="<?php echo $option['data'] ?>"><?php echo $option['msg']; ?></option>
                    <?php } ?>
                </select>
             </div>
        <?php endif; ?>
        <input type="button" class="button-secondary sampledata" id="<?php echo sanitize_title( $title ) ?>" value="<?php echo $button_label ?>" data-action="<?php echo $action ?>"/>
        <span class="error_message"></span>
        <input type="hidden" id="sampledata_file" name="sampledata_file" value="<?php echo $default_data ?>" />
        <span class="spinner"></span>

         <div class="skin_image sample-data">
            <img src="<?php echo $default_preview ?>" class="skin_preview" data-previewurl="<?php echo YIT_THEME_ASSETS_URL . '/images/skins/' ?>"/>
        </div>
    </div>
</div>