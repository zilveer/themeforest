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

?>

<div class="yit_options reset reset-<?php echo sanitize_title($title) ?>">

    <h3><?php echo $title ?></h3>

    <p><?php echo str_replace('%s', get_template(), $desc) ?></p>

    <div class="option import">
        <input type="file" name="import-file" id="import-file" />
        <input type="button" class="button-secondary import" id="<?php echo sanitize_title($title) ?>" value="<?php echo esc_attr( $button_label ) ?>" data-action="<?php echo $action ?>"/>
        <span class="error_message"></span>
        <input type="hidden" name="upload" value="" />
        <span class="spinner"></span>
    </div>
</div>