<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

$post_types = get_post_types( array(
    'public' => true,
    'publicly_queryable' => true
), 'name' );
$exclude_posts_type = array( 'attachment', 'revision', 'nav_menu_item' );
$post_types['page'] = get_post_type_object( 'page' );

$taxonomies = get_taxonomies(array(
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true
), 'name' );
$exclude_taxonomies = array( 'nav_menu');
$taxonomies['post_format'] = get_taxonomy( 'post_format' );
$taxonomies = apply_filters( 'yit_layouts_taxonomies_list', $taxonomies );
?>

<div id="side-sortables" class="accordion-container">
    <ul class="outer-border">

        <?php

        YIT_Layout_Module_Site()->get_box();


        foreach ( $post_types as $name => $post_type ) {
            if ( ! in_array( $name, $exclude_posts_type ) ) {
                YIT_Layout_Module_Post_Type()->get_box( $name );
            }
        }

       // YIT_Layout_Module_Static()->get_box();
        foreach ( $taxonomies as $name => $taxonomy ) {
            if ( ! in_array( $name, $exclude_taxonomies ) ) {
                YIT_Layout_Module_Taxonomy()->get_box( $name );
            }
        }

        YIT_Layout_Module_Author()->get_box('author');

        ?>
    </ul>
</div>