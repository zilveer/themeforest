<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="yit_options backup backup-<?php echo sanitize_title($title) ?>">

    <h3><?php echo $title ?></h3>

    <p><?php echo str_replace('%s', get_template(), $desc) ?></p>

    <p>
        <table class="<?php if( empty( $options ) ) echo 'hidden' ?> yit-backup-list">
            <tr class="yit-panel-backup-list">
                <td class="backup-file"><?php _e( 'File Name', 'yit') ?></td>
                <td class="backup-icon"><?php _e( 'Restore', 'yit') ?></td>
                <td class="backup-icon"><?php _e( 'Delete', 'yit') ?></td>
            </tr>
            <?php foreach( $options as $key => $option ) : ?>
                <tr class="yit-panel-backup-list">
                    <td class="backup-name"><?php echo $option ?></td>
                    <td class="backup-restore" data-action="yit_restore_backup" data-name="<?php echo $option ?>"><i class="fa fa-rotate-left"></i></td>
                    <td class="backup-delete"  data-action="yit_delete_backup" data-name="<?php echo $option ?>"><i class="fa fa-times"></i></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div id="no-backup-file" class="<?php if( ! empty( $options ) ) echo 'hidden' ?>"><?php _e( 'No backup file created', 'yit' ) ?></div>
        <span class="spinner"></span>
    </p>

</div>