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

    <p>
        <input type="submit" value="<?php echo $button_label ?>" class="button-secondary reset" id="<?php echo sanitize_title($title) ?>" data-action=<?php echo $action ?> />
        <span class="spinner"></span>
    </p>

</div>