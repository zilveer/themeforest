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
 * Return an array with the options for Theme Options > Content > Blog
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Backup & Reset > Import and Export Data */

    array(
        'type'         => 'import',
        'title'        => __( 'Import Data', 'yit' ),
        'desc'         => __( '<strong>Warning: You must import export file before customizing your theme.</strong>
                               <br/><br/>
                               If you begin customizing your theme, and then importing sample data, all current data entered on your site will be overwritten
                               to the default settings of the file you are uploading! Please proceed with the utmost care, after <strong>exporting all current data!</strong>
                               <br/><br/>
                               Inside the package you have downloaded, you will find a <strong>sample data folder</strong> containing all the files:
                               choose the skin you want(if any) and upload it to manually import it.
                               <strong>Note:</strong> If you get errors, please be sure that your server can use the PHP function set_time_limit() before opening a ticket in our support platform.', 'yit' ),
        'button_label' => __( 'Import Data', 'yit' ),
        'action' => 'import-sampledata',
        'options' => YIT_Backup_Reset()->import_options
    ),

    array(
        'type'         => 'export',
        'title'        => __( 'Export Data', 'yit' ),
        'desc'         => __( 'When you click the button below, WordPress will create a GZIP file you can save in your computer.
                                <br/><br/>
                                This format will contain your theme options and all the current data of the site.
                                <br/><br/>
                                Once you will have downloaded the file, you can use the Import function in another WordPress installation to import the content from this site.', 'yit' ),
        'button_label' => __( 'Export All Current Data', 'yit' ),
    ),
);


