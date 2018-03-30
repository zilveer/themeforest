<?php

get_template_part('/inc/modules/ambrosite/ambrosite');

function astro_widgets_init() {
    register_sidebar(array(
        'name' => __('Right Sidebar', 'astro'),
        'id' => 'sidebar-primary',
        'before_widget' => '<div id="%1$s" class="widget %2$s vertical_widget"><div class="widget-inner">',
        'after_widget' => '</div></div><div class="clearfix"></div>',
        'before_title' => '<div class="widget-title bd_headings_text_shadow zero_color">',
        'after_title' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('Left Sidebar', 'astro'),
        'id' => 'sidebar-footer',
        'before_widget' => '<div class="prk-widget-body"><div id="%1$s" class="widget %2$s twelve columns"><div class="widget-inner-footer">',
        'after_widget' => '</div></div><div class="clearfix"></div></div>',
        'before_title' => '<div class="widget-title">',
        'after_title' => '<div class="clearfix"></div></div>',
    ));
    //PLACE WOOCOMMERCE IF NEEDED
    if (PRK_WOO=="true") {
            register_sidebar(array(
            'name' => __('WooCommerce Sidebar', 'astro'),
            'id' => 'prk-woo-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s vertical_widget"><div class="widget-inner">',
            'after_widget' => '</div></div><div class="clearfix"></div>',
            'before_title' => '<div class="widget-title bd_headings_text_shadow zero_color">',
            'after_title' => '</div>',
        ));
    }
}
add_action('widgets_init', 'astro_widgets_init');

add_filter( 'ups_sidebar', 'ups_display_sidebar' );
add_filter( 'ryno_sidebar', 'ups_display_sidebar' );
add_action( 'init', 'ups_options_init' );
add_action( 'admin_init', 'ups_options_admin_init' );
add_action( 'admin_menu', 'ups_options_add_page' );

/**
 * Displays the sidebar which is attached to the page being viewed.
 * 
 * @since Unique Page Sidebars 0.1
 */
function ups_display_sidebar( $default_sidebar ) {
    global $post;
    
    $sidebars = get_option( 'ups_sidebars' );
    if ($sidebars!="") {
        foreach ( $sidebars as $id => $sidebar ) {
            if ( array_key_exists( 'pages', $sidebar ) ) {
                if ( array_key_exists( 'children', $sidebar ) && $sidebar['children'] == 'on' ) {
                    $child = array_key_exists( $post->post_parent, $sidebar['pages'] );
                } else {
                    $child = false;
                }
                if ( array_key_exists( $post->ID, $sidebar['pages'] ) || $child ) {
                    return $id;
                }
            }
        }
    }
    
    return $default_sidebar;
}

/**
 * Add the options page to the "Appearance" admin menu
 * 
 * @since Unique Page Sidebars 0.1
 */
function ups_options_add_page() {
    add_theme_page( 'Manage Sidebars', 'Manage Sidebars', 'edit_theme_options', 'ups_sidebars', 'ups_sidebars_do_page' );
}

/**
 * Registers all sidebars for use on the front-end and Widgets page
 * 
 * @since Unique Page Sidebars 0.1
 */
function ups_options_init() {
    $sidebars = get_option( 'ups_sidebars' );
    
    if ( is_array( $sidebars ) ) {
        foreach ( (array) $sidebars as $id => $sidebar ) {
            unset( $sidebar['pages'] );
            $sidebar['id'] = $id;
            register_sidebar( $sidebar );
        }
    }
}

/**
 * Adds the metaboxes to the main options page for the sidebars in the database.
 * 
 * @since Unique Page Sidebars 0.1
 */
function ups_options_admin_init() {
    wp_enqueue_script('common');
    wp_enqueue_script('wp-lists');
    wp_enqueue_script('postbox');
    
    // Register setting to store all the sidebar options in the *_options table
    register_setting( 'ups_sidebars_options', 'ups_sidebars', 'ups_sidebars_validate' );
    
    $sidebars = get_option( 'ups_sidebars' );
    if ( is_array( $sidebars ) && count ( $sidebars ) > 0 ) {
        foreach ( $sidebars as $id => $sidebar ) {
            add_meta_box(
                esc_attr( $id ),
                esc_html( $sidebar['name'] ),
                'ups_sidebar_do_meta_box',
                'ups_sidebars',
                'normal',
                'default',
                array(
                    'id' => esc_attr( $id ),
                    'sidebar' => $sidebar
                )
            );
        
            unset( $sidebar['pages'] );
            $sidebar['id'] = esc_attr( $id );
            register_sidebar( $sidebar );
        }
    } else {
        add_meta_box( 'ups-sidebar-no-sidebars', 'No sidebars', 'ups_sidebar_no_sidebars', 'ups_sidebars', 'normal', 'default' );
    }
    
    // Sidebar metaboxes
    add_meta_box( 'ups-sidebar-add-new-sidebar', 'Add New Sidebar', 'ups_sidebar_add_new_sidebar', 'ups_sidebars', 'side', 'default' );
    add_meta_box( 'ups-sidebar-about-the-plugin', 'About the Plugin', 'ups_sidebar_about_the_plugin', 'ups_sidebars', 'side', 'default' );
}

function ups_sidebar_no_sidebars() {
    ?>
    <p>You haven&rsquo;t added any sidebars yet. Add one using the form on the right hand side!</p>
    <?php
}

/**
 * Callback function which creates the theme page and adds a spot for the metaboxes
 * 
 * @since Unique Page Sidebars 0.1
 */
function ups_sidebars_do_page() {
    if ( ! isset( $_REQUEST['settings-updated'] ) )
        $_REQUEST['settings-updated'] = false;
    ?>
    <div class="wrap">
        <?php screen_icon(); ?><h2>Manage Sidebars</h2>
        <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
        <div class="updated fade"><p><strong>Sidebar settings saved.</strong> You can now go manage the <a href="<?php echo get_admin_url(); ?>widgets.php">widgets</a> for your sidebars.</p></div>
        <?php endif; ?>
        <div id="poststuff" class="metabox-holder has-right-sidebar">
            <div id="post-body" class="has-sidebar">
                <div id="post-body-content" class="has-sidebar-content">
                    <form method="post" action="options.php">
                        <?php settings_fields( 'ups_sidebars_options' ); ?>
                        <?php do_meta_boxes( 'ups_sidebars', 'normal', null ); ?>
                    </form>
                </div>
            </div>
            <div id="side-info-column" class="inner-sidebar">
                <?php do_meta_boxes( 'ups_sidebars', 'side', null ); ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Callback function which adds the content of the metaboxes for each sidebar
 * 
 * @since Unique Page Sidebars 0.1
 */
function ups_sidebar_do_meta_box( $post, $metabox ) {
    $sidebars = get_option( 'ups_sidebars' );
    $sidebar_id = esc_attr( $metabox['args']['id'] );
    $sidebar = $sidebars[$sidebar_id];
    
    if ( ! isset( $sidebar['pages'] ) ) {
        $sidebar['pages'] = array();
    }
    
    $options_fields = array(
        'name' => 'Name',
        'description' => 'Description',
        'before_title' => 'Before Title',
        'after_title' => 'After Title',
        'before_widget' => 'Before Widget',
        'after_widget' => 'After Widget',
        'children' => 'Child Behavior'
    );
    
    $get_posts = new WP_Query;
    $posts = $get_posts->query( array(
        'offset' => 0,
        'order' => 'ASC',
        'orderby' => 'title',
        'posts_per_page' => -1,
        'post_type' => 'page',
        'suppress_filters' => true,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false
    ) );
    ?>
    <div class="wp-tab-wrapper left_floated pct_25">
        <ul class="wp-tab-bar">
            <li class="wp-tab-active">All Pages</li>
        </ul>
        <div class="wp-tab-panel">
            <ul id="pagechecklist" class="categorychecklist form-no-clear">
                <?php foreach ( $posts as $post ) : ?>
                <li>
                    <label>
                    <?php
                    $checked = '';
                    if ( array_key_exists( $post->ID, $sidebar['pages'] ) ) {
                        $checked = ' checked="checked"';
                    }
                    ?>
                    <input type="checkbox" class="menu-item-checkbox" name="ups_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][pages][<?php echo esc_attr( $post->ID ); ?>]" value="<?php echo esc_attr( $post->post_title ); ?>"<?php echo $checked; ?> />
                    <?php echo esc_html( $post->post_title ); ?>
                    </label>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="right_floated pct_70">
        <table class="form-table">
            <?php foreach ( $options_fields as $id => $label ) : ?>
            <tr valign="top" class="prk_bars_<?php echo esc_attr( $id ); ?>">
                <th scope="row"><label for="ups_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]"><?php echo esc_html( $label ); ?></label></th>
                <td>
                <?php if ( 'children' == $id ) : ?>
                    <?php
                    $checked = '';
                    if ( array_key_exists( 'children', $sidebar ) && $sidebar['children'] == 'on' ) {
                        $checked = ' checked="checked"';
                    }
                    ?>
                    <label>
                    <input type="checkbox" name="ups_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]" value="on" id="ups_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]"<?php echo $checked; ?> />
                    <span class="description">Set page children to use the parent page sidebar by default?</span>
                    </label>
                <?php else : ?>
                    <input id="ups_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]" class="regular-text" type="text" name="ups_sidebars[<?php echo esc_attr( $sidebar_id ); ?>][<?php echo esc_attr( $id ); ?>]" value="<?php echo esc_html( $sidebar[$id] ); ?>" />
                <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="clear submitbox">
        <input type="submit" class="button-primary" value="Save all sidebars" />&nbsp;&nbsp;&nbsp;
        <label><input type="checkbox" name="ups_sidebars[delete]" value="<?php echo esc_attr( $sidebar_id ); ?>" /> Delete this sidebar?</label>
    </div>
    <?php
}

/**
 * Validates and handles all the post data (adding, updating, deleting sidebars)
 * 
 * @since Unique Page Sidebars 0.1
 */
function ups_sidebars_validate( $input ) {
    if ( isset( $input['add_sidebar'] ) ) {
        $sidebars = get_option( 'ups_sidebars' );
        if ( ! empty( $input['add_sidebar'] ) ) {
            if ( is_array( $sidebars ) ) {
                $sidebar_num = count( $sidebars ) + 1;
            } else {
                $sidebar_num = 1;
            }
            //PIRENKO
            $sidebar_num=rand(1,10000);
            //END PIRENKO
            $sidebars['ups-sidebar-' . $sidebar_num] = array(
                'name' => esc_html( $input['add_sidebar'] ),
                'description' => '',
                'before_widget' => '<div id="%1$s" class="widget %2$s vertical_widget"><div class="widget-inner">',
                'after_widget' => '</div></div><div class="clearfix"></div>',
                'before_title' => '<div class="prk_titlify_father"><div class="widget-title bd_headings_text_shadow zero_color">',
                'after_title' => '</div></div>',
                'pages' => array(),
                'children' => 'off'
            );
        }
        return $sidebars;
    }
    
    if ( isset( $input['delete'] ) ) {
        foreach ( (array) $input['delete'] as $delete_id ) {
            unset( $input[$delete_id] );
        }
        unset( $input['delete'] );
        return $input;
    }
    
    return $input;
}

/**
 * Handles the content of the metabox which allows adding new sidebars
 * 
 * @since Unique Page Sidebars 0.1
 */
function ups_sidebar_add_new_sidebar() {
    ?>
    <form method="post" action="options.php" id="add-new-sidebar">
        <?php settings_fields( 'ups_sidebars_options' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Name</th>
                <td>
                    <input id="ups_sidebars[add_sidebar]" class="text" type="text" name="ups_sidebars[add_sidebar]" value="" />
                </td>
            </tr>
        </table>
        <p class="submit zero_padding">
            <input type="submit" class="button-primary" value="Add Sidebar" />
        </p>
    </form>
    <?php
}

/**
 * Handles the content of the metabox that describes the plugin
 * 
 * @since Unique Page Sidebars 0.1
 */
function ups_sidebar_about_the_plugin() {
    ?>
    <p>This plugin was developed by Andrew Ryno, a WordPress developer based in Phoenix, AZ who never found a decent solution to having sidebars on different pages.</p>
    <p>Like the plugin? Think it could be improved? Feel free to contribute over at GitHub!</p>
    <?php
}