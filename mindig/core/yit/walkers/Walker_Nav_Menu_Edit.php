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
 * Extends classic WP_Nav_Menu_Edit
 *
 * @class YIT_Walker_Nav_Menu_Edit
 * @package	Yithemes
 * @since 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {

    //TODO: Sistemare PHPDoc.


    /**
     * Walker::start_el(&$output, $object, $depth = 0, $args = Array, $current_object_id = 0)
     *
     * @see    Walker::start_el()
     * @since  1.0.0
     *
     * @param string       $output            Passed by reference. Used to append additional content.
     * @param object       $item              Menu item data object.
     * @param int          $depth             Depth of menu item. Used for padding. (Default = 0)
     * @param array|object $args              An argument array
     * @param int          $current_object_id The id of current object. Default = 0)
     *
     * @return void
     * @author Simone D'Amico <simone.damico@yithemes.com>
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {

        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        ob_start();
        $item_id = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = '';
        if ( 'taxonomy' == $item->type ) {
            $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
            if ( is_wp_error( $original_title ) )
                $original_title = false;
        } elseif ( 'post_type' == $item->type ) {
            $original_object = get_post( $item->object_id );
            $original_title = $original_object->post_title;
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( $item_id == YIT_Request()->get('edit-menu-item') ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( __( '%s (Invalid)', 'yit' ), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( __( '%s (Pending)', 'yit' ), $item->title );
        }

        $title = empty( $item->label ) ? $title : $item->label;

       // $awesome = YIT_Plugin_Common::get_awesome_icons();
        $icon_list = class_exists( 'YIT_Plugin_Common' ) ? YIT_Plugin_Common::get_icon_list() : array();


        ?>
    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html( $title ); ?></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
                            echo esc_url(
                                    wp_nonce_url(
                                        add_query_arg(
                                            array(
                                                'action' => 'move-up-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ),
                                        'move-menu_item'
                                    )
                                );
                            ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'yit'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
                            echo esc_url (
                                    wp_nonce_url(
                                        add_query_arg(
                                            array(
                                                'action' => 'move-down-menu-item',
                                                'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ),
                                    'move-menu_item'
                                )
                            );
                            ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'yit'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'yit' ); ?>" href="<?php
                        echo ( $item_id == YIT_Request()->get('edit-menu-item') ) ? admin_url( 'nav-menus.php' ) : esc_url( add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
                        ?>"><?php _e( 'Edit Menu Item', 'yit' ); ?></a>
					</span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                        <?php _e( 'URL', 'yit' ); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    <?php _e( 'Navigation Label', 'yit' ); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                    <?php _e( 'Title Attribute', 'yit' ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php _e( 'Open link in a new window/tab', 'yit' ); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                    <?php _e( 'CSS Classes (optional)' , 'yit' ); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>

            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                    <?php _e( 'Link Relationship (XFN)', 'yit' ); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                    <?php _e( 'Description', 'yit' ); ?><br />
                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'yit'); ?></span>
                </label>
            </p>



            <!-- custom code -->
            <?php $custom_fields = YIT_Registry::get_instance()->{'navmenu'}->fields; ?>
            <?php if( !empty($custom_fields) ): ?>


                <div class="clear"></div>
                <p style="margin-top: 20px"><strong><?php _e( 'Customize menu', 'yit') ?></strong></p>


                <?php foreach( $custom_fields as $id => $field ): ?>
                    <p class="description description-<?php echo $field['width'] ?>">
                        <label for="edit-menu-item-<?php echo $id; ?>-<?php echo $item_id; ?>">
                            <?php echo $field['label']; ?>

                            <?php if( $field['type'] == 'input' ): ?>
                                <input type="text" id="edit-menu-item-<?php echo $id; ?>-<?php echo $item_id; ?>" class="widefat code" name="menu-item-<?php echo $id; ?>[<?php echo $item_id; ?>]" value="<?php if( isset($item->{$id}) ) echo esc_attr( $item->{$id} ); ?>" />
                            <?php elseif( $field['type'] == 'textarea' ): ?>
                                <textarea id="edit-menu-item-<?php echo $id; ?>-<?php echo $item_id; ?>" class="widefat" rows="3" cols="20" name="menu-item-<?php echo $id; ?>[<?php echo $item_id; ?>]"><?php if( isset($item->{$id}) ) echo esc_html( $item->{$id} ); // textarea_escaped ?></textarea>
                                <span class="description"><?php echo $field['description']; ?></span>
                            <?php elseif( $field['type'] == 'text' ): ?>
                                <input type="text" id="edit-menu-item-<?php echo $id; ?>-<?php echo $item_id; ?>" name="menu-item-<?php echo $id; ?>[<?php echo $item_id; ?>]"   class="widefat code" value="<?php if( isset($item->{$id}) ) echo esc_html( trim($item->{$id}) );?>"/>
                                <span class="description"><?php echo $field['description']; ?></span>
                            <?php elseif( $field['type'] == 'select-icon' ): ?>
                                <div class="icon-manager-wrapper">
                                    <div class="icon-manager-text">
                                        <div class="icon-preview"></div>
                                        <input type="text" id="edit-menu-item-<?php echo $id; ?>-<?php echo $item_id; ?>" class="icon-text" data-sfx="icon" name="menu-item-<?php echo $id; ?>[<?php echo $item_id; ?>]" value="<?php if ( isset( $item->{$id} ) ) {
                                            echo esc_attr( $item->{$id} );
                                        } ?>" />
                                    </div>
                                    <div class="icon-manager">
                                        <ul id="edit-menu-item-<?php echo $id; ?>-<?php echo $item_id; ?>" class="icon-list-wrapper" >
                                            <?php foreach ( $icon_list as $font => $icons ):
                                                foreach ( $icons as $key => $icon ): ?>
                                                    <li data-font="<?php echo esc_attr( $font ) ?>" data-icon="<?php echo ( strpos( $key, '\\' ) === 0 ) ? '&#x' . substr( $key, 1 ) : $key ?>" data-key="<?php echo esc_attr( $key ) ?>" data-name="<?php echo esc_attr( $icon ) ?>" value="<?php echo $font . ':' . $icon ?>" <?php echo selected( $item->{$id}, $font . ':' . $icon ) ?>></li>
                                                <?php
                                                endforeach;
                                            endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php elseif( $field['type'] == 'upload' ): ?>
                                <input type="text" id="edit-menu-item-<?php echo $id; ?>-<?php echo $item_id; ?>" class="widefat code menu-custom-field menu-custom-field-upload"  data-sfx="background" value="<?php if( isset($item->{$id}) ) echo esc_attr( $item->{$id} ); ?>" />
                                <input type="button" value="<?php _e('Upload', 'yit') ?>" id="edit-menu-item-<?php echo $id; ?>-<?php echo $item_id; ?>-button" class="upload_button button" />
                            <?php endif ?>
                        </label>
                    </p>
                <?php endforeach ?>
            <?php endif ?>
            <!-- /custom code -->



            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( __( 'Original: %s', 'yit' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                echo esc_url(
                    wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'delete-menu-item',
                                'menu-item' => $item_id,
                            ),
                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                        ),
                        'delete-menu_item_' . $item_id
                    )
                ); ?>"><?php _e( 'Remove', 'yit' ); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php	echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e( 'Cancel', 'yit' ); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }
}
