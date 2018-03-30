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
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Backup & Reset > Reset */
    array(
        'type'         => 'reset',
        'title'        => __( 'Cache Folder', 'yit' ),
        'desc'         => __( 'When you click the button below, the folder <strong>wp-content/themes/%s/cache/</strong> will be empty.<br /><br />
                               It\'s possible you will see the website front-end broken after deleteing the cache. <strong>Do not worry!</strong>
                               Simply reload the page so the theme can regenerate the correct style.', 'yit' ),
        'button_label' => __( 'Empty Cache Folder', 'yit' ),
        'action'       => 'yit_delete_cache_folder'
    ),

    array(
        'type'         => 'reset',
        'title'        => __( 'Theme Options', 'yit' ),
        'desc'         => __( 'When you click the button below, the Theme Options return to its default values.<br /><br />
                               Once the Theme Options is resetted to default, you need to save it again to regenerate the style.', 'yit' ),
        'button_label' => __( 'Restore Default Value', 'yit' ),
        'action'       => 'yit_restore_default_value'
    ),

    array(
        'type'         => 'reset',
        'title'        => __( 'Resized Image', 'yit' ),
        'desc'         => __( 'Click here to remove all resized images located inside the "uploads" folder. The images are been generated to show some images with a specific size.', 'yit' ),
        'button_label' => __( 'Delete Resized Image', 'yit' ),
        'action'       => 'yit_delete_resized_image'
    ),

    defined( 'YITH_PRELAUNCH' ) && YITH_PRELAUNCH ? array(
        'type'         => 'reset',
        'title'        => __( 'YITH Pre-Launch', 'yit' ),
        'desc'         => __( 'When you click the button below, the YITH Pre-Launch plugin Options return to its default values.', 'yit' ),
        'button_label' => __( 'YITH Pre-Launch Reset', 'yit' ),
        'action'       => 'yit_restore_default_prelaunch_value'
    ) : false,
);


