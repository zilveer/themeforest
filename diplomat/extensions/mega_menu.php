<?php

/*
 * Mega menu extension
 * Create HTML list of nav menu items.
 * @uses Walker_Nav_Menu
 */

class TMM_Mega_Menu extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = array() ) {

        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";

    }
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        if (function_exists('icl_object_id')){
            global $sitepress;
            $item_id = $item->ID;
            $orig_id = $sitepress->get_original_element_id($item_id, 'post_nav_menu_item' );
            if ($orig_id!=$item_id){
                $menu_icon = get_post_meta($orig_id, 'tmm_menu_icon', true);
                $menu_image = get_post_meta($orig_id, 'tmm_menu_image', true);
                $menu_content = get_post_meta($orig_id, 'tmm_menu_content', true);
                $mega_menu = get_post_meta($orig_id, 'tmm_mega_menu', true);
                $hide_title_menu = get_post_meta($orig_id, 'tmm_hide_title_menu', true);
                $column = get_post_meta($orig_id, 'tmm_menu_column', true);

                $post_custom = get_post_custom($item_id);

                $self_menu_icon = get_post_meta($item_id, 'tmm_menu_icon', true);
                $self_menu_image = get_post_meta($item_id, 'tmm_menu_image', true);
                $self_menu_content = get_post_meta($item_id, 'tmm_menu_content', true);
                $self_mega_menu = get_post_meta($item_id, 'tmm_mega_menu', true);
                $self_hide_title_menu = get_post_meta($item_id, 'tmm_hide_title_menu', true);
                $self_column = get_post_meta($item_id, 'tmm_menu_column', true);

                if (!empty($menu_icon) && empty($self_menu_icon) && !isset($post_custom['tmm_menu_icon']))
                    update_post_meta($item_id, 'tmm_menu_icon', $menu_icon);

                if (!empty($menu_image) && empty($self_menu_image) && !isset($post_custom['tmm_menu_image']))
                    update_post_meta($item_id, 'tmm_menu_image', $menu_image);

                if (!empty($menu_content) && empty($self_menu_content) && !isset($post_custom['tmm_menu_content']))
                    update_post_meta($item_id, 'tmm_menu_content', $menu_content);

                if (!empty($mega_menu) && empty($self_mega_menu) && !isset($post_custom['tmm_mega_menu']))
                    update_post_meta($item_id, 'tmm_mega_menu', $mega_menu);

                if (!empty($hide_title_menu) && empty($self_hide_title_menu) && !isset($post_custom['tmm_hide_title_menu']))
                    update_post_meta($item_id, 'tmm_hide_title_menu', $hide_title_menu);

                if (!empty($column) && empty($self_column) && !isset($post_custom['tmm_menu_column']))
                    update_post_meta($item_id, 'tmm_menu_column', $column);

            }
        }

        $menu_icon = get_post_meta($item->ID, 'tmm_menu_icon', true);
        $menu_image = get_post_meta($item->ID, 'tmm_menu_image', true);
        $menu_content = get_post_meta($item->ID, 'tmm_menu_content', true);

        $content = preg_replace('/^<p>|<\/p>$/', '', do_shortcode($menu_content));

        $mega_menu = get_post_meta($item->ID, 'tmm_mega_menu', true);
        $hide_title_menu = get_post_meta($item->ID, 'tmm_hide_title_menu', true);
        $item_parent = get_post($item->menu_item_parent);
        $parent_mega_menu = get_post_meta($item->menu_item_parent, 'tmm_mega_menu', true);
        $column = get_post_meta($item->ID, 'tmm_menu_column', true);

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_clear = (!empty($content)) ? 'clearfix ' : '';
        $class_icon = (!empty($menu_icon)&&($menu_icon!='none')) ? 'menu_item_icon ' : '';
        $class_names = $class_names ? ' class="'. $class_clear . $class_icon . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $item_title = (!empty($item->title)) ? $item->title : $item->post_title;
        $item_title = ($hide_title_menu!='1') ? $item_title : '';

        if ($parent_mega_menu=='1' && $depth==1){
            $data_column = (isset($column)&&($column!='default')) ? $column : '';
            $data_column = 'data-column="'.$data_column.'"';
            $output .= sprintf( '<li>');
            $output .= sprintf( '<span '.$data_column.'>'.$item_title.'</span>');

        }else{

            $output .= $indent . '<li' . $id . $value . $class_names .'>';

            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : $item->guid;

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $args_before = (isset($args->before)) ? $args->before : '';
            $args_after = (isset($args->after)) ? $args->after : '';
            $args_link_before = (isset($args->link_before)) ? $args->link_before : '';
            $args_link_after = (isset($args->link_after)) ? $args->link_after : '';

            $item_output = $args_before;

            if (!empty($item_title) || (!empty($menu_image) && ($menu_image!='none'))){

                $a_class = '';
                if (!empty($menu_image) && ($menu_image!='none') && ($depth!='0')){
                    $a_class .=' class="menu-image"';
                }

                $item_output .= '<a'. $a_class . $attributes .'>';
                if (!empty($menu_icon)&&($menu_icon!='none')){
                    $item_output .='<i class="'.$menu_icon.'"></i>';
                }
                $item_output .= $args_link_before . apply_filters( 'the_title', $item_title, $item->ID ) . $args_link_after;

                if (!empty($item->description)){
                    $item_output .= '<br><span class="sub">'.$item->description.'</span>';
                }
                if (!empty($menu_image) && ($menu_image!='none') && ($depth!='0')){

                    $item_output .= '<image src="' .  esc_url(TMM_Helper::resize_image($menu_image, '273*207')) . '">';
                }

                $item_output .= '</a>';

            }

            if (!empty($content)&& ($depth!='0')){
                $item_output .= $content;
            }

            $item_output .= $args_after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        if (($depth==0)&&($mega_menu=='1')){
            $output .= '<div class="mega-menu">';
        }

    }

}
class TMM_Menu_Walker extends Walker_Nav_Menu {

    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {

    }

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl( &$output, $depth = 0, $args = array() ) {

    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $icon_type_array = array(
            'icon-paper-plane-2' => __('Type', 'diplomat') . ': ' . 'icon-paper-plane-2',
            'icon-pencil-7' => __('Type', 'diplomat') . ': ' . 'icon-pencil-7',
            'icon-beaker-1' => __('Type', 'diplomat') . ': ' . 'icon-beaker-1',
            'icon-megaphone-3' => __('Type', 'diplomat') . ': ' . 'icon-megaphone-3',
            'icon-cog-6' => __('Type', 'diplomat') . ': ' . 'icon-cog-6',
            'icon-lightbulb-3' => __('Type', 'diplomat') . ': ' . 'icon-lightbulb-3',
            'icon-comment-6' => __('Type', 'diplomat') . ': ' . 'icon-comment-6',
            'icon-thumbs-up-5' => __('Type', 'diplomat') . ': ' . 'icon-thumbs-up-5',
            'icon-laptop' => __('Type', 'diplomat') . ': ' . 'icon-laptop',
            'icon-search' => __('Type', 'diplomat') . ': ' . 'icon-search',
            'icon-wrench' => __('Type', 'diplomat') . ': ' . 'icon-wrench',
            'icon-leaf' => __('Type', 'diplomat') . ': ' . 'icon-leaf',
            'icon-cogs' => __('Type', 'diplomat') . ': ' . 'icon-cogs',
            'icon-group' => __('Type', 'diplomat') . ': ' . 'icon-group',
            'icon-folder-close' => __('Type', 'diplomat') . ': ' . 'icon-folder-close',
            'icon-cloud' => __('Type', 'diplomat') . ': ' . 'icon-cloud',
            'icon-briefcase' => __('Type', 'diplomat') . ': ' . 'icon-briefcase',
            'icon-beaker' => __('Type', 'diplomat') . ': ' . 'icon-beaker',
            'icon-bullhorn' => __('Type', 'diplomat') . ': ' . 'icon-bullhorn',
            'icon-comment' => __('Type', 'diplomat') . ': ' . 'icon-comment',
            'icon-globe' => __('Type', 'diplomat') . ': ' . 'icon-globe',
            'icon-globe-6' => __('Type', 'diplomat') . ': ' . 'icon-globe-6',
            'icon-heart' => __('Type', 'diplomat') . ': ' . 'icon-heart',
            'icon-rocket' => __('Type', 'diplomat') . ': ' . 'icon-rocket',
            'icon-suitcase' => __('Type', 'diplomat') . ': ' . 'icon-suitcase',
            'icon-pencil' => __('Type', 'diplomat') . ': ' . 'icon-pencil',
            'icon-params' => __('Type', 'diplomat') . ': ' . 'icon-params',
            'icon-folder-open' => __('Type', 'diplomat') . ': ' . 'icon-folder-open',
            'icon-cog' => __('Type', 'diplomat') . ': ' . 'icon-cog',
            'icon-coffee' => __('Type', 'diplomat') . ': ' . 'icon-coffee',
            'icon-gift' => __('Type', 'diplomat') . ': ' . 'icon-gift',
            'icon-home' => __('Type', 'diplomat') . ': ' . 'icon-home',
            'icon-lightbulb' => __('Type', 'diplomat') . ': ' . 'icon-lightbulb',
            'icon-thumbs-up' => __('Type', 'diplomat') . ': ' . 'icon-thumbs-up',
            'icon-umbrella' => __('Type', 'diplomat') . ': ' . 'icon-umbrella',
            'icon-th-list' => __('Type', 'diplomat') . ': ' . 'icon-th-list',
            'icon-resize-small' => __('Type', 'diplomat') . ': ' . 'icon-resize-small',
            'icon-download-alt' => __('Type', 'diplomat') . ': ' . 'icon-download-alt'
        );

        ob_start();

        $item_id = esc_attr($item->ID);

        if (function_exists('icl_object_id')){
            global $sitepress;
            $orig_id = $sitepress->get_original_element_id($item_id, 'post_nav_menu_item' );
            if ($orig_id!=$item_id){
                $menu_icon = get_post_meta($orig_id, 'tmm_menu_icon', true);
                $menu_image = get_post_meta($orig_id, 'tmm_menu_image', true);
                $menu_content = get_post_meta($orig_id, 'tmm_menu_content', true);
                $mega_menu = get_post_meta($orig_id, 'tmm_mega_menu', true);
                $hide_title_menu = get_post_meta($orig_id, 'tmm_hide_title_menu', true);
                $column = get_post_meta($orig_id, 'tmm_menu_column', true);

                $post_custom = get_post_custom($item_id);

                $self_menu_icon = get_post_meta($item_id, 'tmm_menu_icon', true);
                $self_menu_image = get_post_meta($item_id, 'tmm_menu_image', true);
                $self_menu_content = get_post_meta($item_id, 'tmm_menu_content', true);
                $self_mega_menu = get_post_meta($item_id, 'tmm_mega_menu', true);
                $self_hide_title_menu = get_post_meta($item_id, 'tmm_hide_title_menu', true);
                $self_column = get_post_meta($item_id, 'tmm_menu_column', true);

                if (!empty($menu_icon) && empty($self_menu_icon) && !isset($post_custom['tmm_menu_icon']))
                    update_post_meta($item_id, 'tmm_menu_icon', $menu_icon);

                if (!empty($menu_image) && empty($self_menu_image) && !isset($post_custom['tmm_menu_image']))
                    update_post_meta($item_id, 'tmm_menu_image', $menu_image);

                if (!empty($menu_content) && empty($self_menu_content) && !isset($post_custom['tmm_menu_content']))
                    update_post_meta($item_id, 'tmm_menu_content', $menu_content);

                if (!empty($mega_menu) && empty($self_mega_menu) && !isset($post_custom['tmm_mega_menu']))
                    update_post_meta($item_id, 'tmm_mega_menu', $mega_menu);

                if (!empty($hide_title_menu) && empty($self_hide_title_menu) && !isset($post_custom['tmm_hide_title_menu']))
                    update_post_meta($item_id, 'tmm_hide_title_menu', $hide_title_menu);

                if (!empty($column) && empty($self_column) && !isset($post_custom['tmm_menu_column']))
                    update_post_meta($item_id, 'tmm_menu_column', $column);

            }
        }

        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = '';
        if ('taxonomy' == $item->type) {
            $original_title = get_term_field('name', $item->object_id, $item->object, 'raw');
            if (is_wp_error($original_title))
                $original_title = false;
        } elseif ('post_type' == $item->type) {
            $original_object = get_post($item->object_id);
            $original_title = $original_object->post_title;
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr($item->object),
            'menu-item-edit-' . ( ( isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if (!empty($item->_invalid)) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf(__('%s (Invalid)', 'diplomat'), $item->title);
        } elseif (isset($item->post_status) && 'draft' == $item->post_status) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf(__('%s (Pending)', 'diplomat'), $item->title);
        }

        $title = empty($item->label) ? $title : $item->label;

        $style_ititle = (get_post_meta($item->menu_item_parent, 'tmm_mega_menu', true)=='1') ? 'style="display:block"' : 'style="display:none"';
        ?>
    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes); ?>" data-parent="<?php echo $item->menu_item_parent ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html($title); ?> <i <?php echo $style_ititle ?>><?php _e(' (column) ', 'diplomat'); ?></i></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html($item->type_label); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                        echo esc_url(wp_nonce_url(add_query_arg(array('action' => 'move-up-menu-item', 'menu-item' => $item_id,), remove_query_arg($removed_args, admin_url('nav-menus.php'))), 'move-menu_item'));
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'diplomat'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                        echo esc_url(wp_nonce_url(add_query_arg(array('action' => 'move-down-menu-item', 'menu-item' => $item_id,), remove_query_arg($removed_args, admin_url('nav-menus.php'))), 'move-menu_item'));
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'diplomat'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', 'diplomat'); ?>" href="<?php
                    echo ( isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item'] ) ? esc_url(admin_url('nav-menus.php')) : esc_url(add_query_arg('edit-menu-item', $item_id, remove_query_arg($removed_args, admin_url('nav-menus.php#menu-item-settings-' . $item_id))));
                    ?>"><?php _e('Edit Menu Item', 'diplomat'); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
            <?php if ('custom' == $item->type) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                        <?php _e('URL', 'diplomat'); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->url); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    <?php _e('Navigation Label', 'diplomat'); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->title); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                    <?php _e('Title Attribute', 'diplomat'); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->post_excerpt); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked($item->target, '_blank'); ?> />
                    <?php _e('Open link in a new window/tab', 'diplomat'); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                    <?php _e('CSS Classes (optional)', 'diplomat'); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr(implode(' ', $item->classes)); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                    <?php _e('Link Relationship (XFN)', 'diplomat'); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->xfn); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                    <?php _e('Description', 'diplomat'); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php
                            echo esc_html($item->description);
                            // textarea_escaped
                            ?></textarea>
                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'diplomat'); ?></span>
                </label>
            </p>

            <div class="clear"></div>

            <div class="advanced_menu_options">
                <?php

                ?>

                <div class="use_mega_menu">
                    <label for="edit-menu-item-mega-<?php echo $item_id; ?>">
                        <input type="hidden" class="widefat code edit-menu-item-mega" name="menu-item-mega[<?php echo $item_id; ?>]" value="<?php echo get_post_meta($item_id, 'tmm_mega_menu', true); ?>"/>
                        <input type="checkbox" id="edit-menu-item-mega-<?php echo $item_id; ?>" class="widefat code edit-menu-item-mega option_menu_checkbox" <?php if (get_post_meta($item_id, 'tmm_mega_menu', true)=='1') echo "checked"; ?> />
                        <?php _e('Use as Mega Menu', 'diplomat'); ?>
                    </label>
                </div>

                <div class="hide_title_menu">
                    <label for="hide-title-menu-item-<?php echo $item_id; ?>">
                        <input type="hidden" class="widefat code hide-title-menu-item" name="hide-title-menu[<?php echo $item_id; ?>]" value="<?php echo get_post_meta($item_id, 'tmm_hide_title_menu', true); ?>"/>
                        <input type="checkbox" id="hide-title-menu-item-<?php echo $item_id; ?>" class="widefat code hide-title-menu-item option_menu_checkbox" <?php if (get_post_meta($item_id, 'tmm_hide_title_menu', true)=='1') echo "checked"; ?> />
                        <?php _e('Hide Menu Item Title', 'diplomat'); ?>
                    </label>
                </div>

                <?php
                $style_column = (get_post_meta($item->menu_item_parent, 'tmm_mega_menu', true)=='1') ? 'style="display:block"' : 'style="display:none"';
                ?>

                <div class="column_layout_menu" <?php echo $style_column ?>>
                    <label for="column-layout-item-<?php echo $item_id; ?>">
                        <?php
                        $item_column = get_post_meta($item_id, 'tmm_menu_column', true);
                        $columns = array('default' => 'Default',
                            'one_fourth' => 'One fourth',
                            'one_third' => 'One third',
                            'one_half' => 'One half',
                            'two_thirds' => 'Two thirds',
                            'three_fourth' => 'Three Fourth',
                            'full_width' => 'Full width'
                        ); ?>


                        <select name="menu-item-column[<?php echo $item_id; ?>]">
                            <?php foreach ($columns as $key => $column) { ?>
                                <option <?php echo ($item_column == $key) ? 'selected' : '' ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html($column); ?></option>
                            <?php } ?>
                        </select>

                        <?php _e('Column Type', 'diplomat'); ?>

                    </label>

                </div>

                <?php
                $item_parent_mega_menu=get_post_meta($item->menu_item_parent, 'tmm_mega_menu', true);
                $style_icon = (isset($item_parent_mega_menu)&&($item_parent_mega_menu=='1')) ? 'style="display:none"' : 'style="display:block"';
                ?>
                <div class="set_icon_menu" <?php echo $style_icon ?>>
                    <label for="edit-menu-item-icon-<?php echo $item_id; ?>">
                        <?php $menu_icon_type = get_post_meta($item_id, 'tmm_menu_icon', true); ?>


                        <select class="menu_icon_type" name="menu-item-icon[<?php echo $item_id; ?>]">
                            <option value="none">None</option>
                            <?php foreach ($icon_type_array as $key => $icon_type) { ?>
                                <option <?php echo ($menu_icon_type == $key) ? 'selected' : '' ?> value="<?php echo esc_attr($key); ?>"><?php echo $icon_type ?></option>
                            <?php } ?>
                        </select>

                        <?php _e('Icon Type', 'diplomat'); ?>

                        <?php if (!empty($menu_icon_type)) { ?>
                            <i class="ca-icon <?php echo esc_attr($menu_icon_type); ?>"></i>
                        <?php } ?>

                    </label>
                </div>

                <?php
                $style_image = (get_post_meta($item->menu_item_parent, 'tmm_mega_menu', true)) ? 'style="display:none"' : 'style="display:block"';
                ?>
                <div class="set_image_menu" <?php echo $style_image; ?>>
                    <?php $menu_item_image = get_post_meta($item_id, 'tmm_menu_image', true); ?>
                    <input type="hidden" value="<?php echo esc_attr($menu_item_image); ?>" name="menu-item-image[<?php echo $item_id ?>]">
                    <?php if (!empty($menu_item_image) && ($menu_item_image!='none')) { ?>
                        <a  data-id="<?php echo esc_attr($item_id); ?>" href="#" class="remove_menu_item_image"><?php _e('Remove featured image', 'diplomat'); ?></a>
                    <?php } else { ?>
                        <a  data-id="<?php echo esc_attr($item_id); ?>" href="#" class="add_menu_item_image"><?php _e('Add Featured Image', 'diplomat'); ?></a>
                    <?php } ?>

                    <div class="menu_item_image_<?php echo $item_id ?>">
                        <?php if (!empty($menu_item_image) && ($menu_item_image!='none')) { ?>
                            <img src="<?php echo esc_url(TMM_Helper::get_image($menu_item_image, '376*186')); ?>">
                        <?php }
                        ?>
                    </div>
                </div>

                <div class="set_shortcode_menu">
                    <?php $editor_id = 'item_content_' . $item_id; ?>
                    <a href="#" data-id="<?php echo esc_attr($editor_id); ?>" class="show_editor" ><?php _e('Show advanced editor', 'diplomat'); ?></a>
                    <div style="display:none;" class="advanced_editor" data-editorid="<?php echo esc_attr($editor_id); ?>">
                        <?php
                        $menu_content = get_post_meta($item_id, 'tmm_menu_content', true);
                        $content = (!empty($menu_content)) ? $menu_content : "";

                        $settings = array(
                            'media_buttons' => true,
                            'textarea_name' => 'menu-item-content[' . $item_id . ']',
                            'quicktags' => false
                        );

                        wp_editor($content, $editor_id, $settings);
                        ?>
                    </div>
                </div>

            </div>

            <div class="menu-item-actions description-wide submitbox">
                <?php if ('custom' != $item->type && $original_title !== false){ ?>
                    <p class="link-to-original">
                        <?php printf(__('Original: %s', 'diplomat'), '<a href="' . esc_url($item->url) . '">' . esc_html($original_title) . '</a>'); ?>
                    </p>
                <?php } ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                echo esc_url(wp_nonce_url(add_query_arg(array('action' => 'delete-menu-item', 'menu-item' => $item_id,), remove_query_arg($removed_args, admin_url('nav-menus.php'))), 'delete-menu_item_' . $item_id));
                ?>"><?php _e('Remove', 'diplomat'); ?>
                </a>
                <span class="meta-sep"> | </span>
                <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url(add_query_arg(array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg($removed_args, admin_url('nav-menus.php')))); ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', 'diplomat'); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->object_id); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->object); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->menu_item_parent); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->menu_order); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr($item->type); ?>" />
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }

    static function nav_menu_meta_box() {

        add_meta_box('tmm_navmenu_editor_metabox', __('Custom Box', 'diplomat'), array(__CLASS__, 'editor_menu_custom_box'), 'nav-menus', 'side', 'default');

    }
    function editor_menu_custom_box() {

        wp_editor('', 'nav_menu_content_'.uniqid(), array('default_editor'   => 'tinymce'));

    }

}