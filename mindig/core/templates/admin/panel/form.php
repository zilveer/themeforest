<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt

 * The footer of the panel.
 *
 * @package	Yithemes
 * @author Antonino Scarf <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<form method="post" id="<?php echo $form_id ?>" enctype="multipart/form-data" class="ajax-save">
    <div id="yit-content">

        <?php do_action('yit-panel-message') ?>

        <span class="submit top"><input type="submit" value="<?php echo __('Save options', 'yit') ?>" class="button-secondary" /></span>
        <div class="clear-right"></div>