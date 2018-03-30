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
 * Return an array with the options for Backup & Reset > Backup > Configuration
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithems.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Backup & Reset > Backup > Configuration */
    array(
        'type' => 'backups-list',
        'title' => __( 'Your Backups', 'yit' ),
        'desc' => __( 'In this section, you can back up your theme options.
                       <strong>Note:</strong> the backup will just include the theme settings; contents will not be saved.
                       For a complete export, visit the <strong>Import and Export Data section</strong>.', 'yit' ),
        'options' => $options = YIT_Backup_Reset()->get_backups_list()
    ),

    array(
        'id'    => 'backup-new-name',
        'type'  => 'backup',
        'button_label' => __('Save', 'yit'),
        'action' => 'yit_create_backup',
        'title'  => __( 'Create New Backup ', 'yit' ),
        'desc'  => __( 'Select the backup name', 'yit' ),
    ),
);