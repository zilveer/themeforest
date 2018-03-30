<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$theme_mods = defined( 'YIT_THEME_NAME' ) ? 'theme_mods_' . YIT_THEME_NAME : 'theme_mods_%';

$tables = apply_filters( 'yit_export_data_tables', array(
        'wp' => array(
            'posts',
            'postmeta',
            'terms',
            'term_taxonomy',
            'term_relationships',
            'comments',
            'commentmeta'
        ),

        'options' => array(
            'show_on_front',
            'page_on_front',
            'page_for_posts',
            $theme_mods,
            'widget_%',
            'sidebars_widgets',
            'yit%',
            'category%',
            'general-skin',
            'permalink_structure',
        ),

        'plugins' => array(),
    )
);

return $tables;