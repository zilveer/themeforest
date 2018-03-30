<?php

Kleo::set_config( 'bp_default_icons',
    array(
        'activity' => 'speaker-notes',
        'profile' => 'my-profile',
        'notifications' => 'notification-full',
        'messages' => 'markunread',
        'friends' => 'users',
        'groups' => 'buddyapp-groups',
        'forums' => 'forum',
        'media' => 'video-collection',
        'settings' => 'settings',
        'events' => 'event',
        'buddydrive' => 'file-upload',
        'default' => 'panorama-fisheye'
    )
);

add_filter( 'kleo_theme_settings', 'kleo_bp_nav_settings' );

function kleo_bp_nav_settings( $kleo )
{
    //
    // Settings Sections
    //

    $kleo['sec']['kleo_section_bp_icons'] = array(
        'title' => esc_html__( 'Profile icons', 'buddyapp' ),
        'panel' => 'kleo_panel_bp',
        'priority' => 17
    );


    $defaults = Kleo::get_config( 'bp_default_icons' );

    $bp = buddypress();

    if (version_compare(BP_VERSION, '2.6', '>=')) {
        $nav_items = $bp->members->nav->get_primary();
    } else {
        $nav_items = $bp->bp_nav;
    }

    foreach ($nav_items as $nav ) {
        if (isset($nav['name']) && isset($nav['slug'])) {
            $icon = isset( $defaults[ $nav['slug'] ] ) ? $defaults[ $nav['slug'] ] : $defaults['default'];

            $kleo['set'][] = array(
                'id'         => 'bp_nav_' . $nav['slug'],
                'title'      => strip_tags( $nav['name'] ) . esc_html__( ' icon', 'buddyapp' ),
                'type'       => 'select',
                'default'    => $icon,
                'choices'    => kleo_icons_array(),
                'section'    => 'kleo_section_bp_icons',
                'customizer' => true,
                'transport'  => 'refresh'
            );
        }

    }

    if ( class_exists( 'RTMedia' ) ) {

        $kleo['set'][] = array(
            'id' => 'bp_nav_media',
            'title' =>  esc_html__( 'Media', 'buddyapp' ),
            'type' => 'select',
            'default' => $defaults['media'],
            'choices' => kleo_icons_array(),
            'section' => 'kleo_section_bp_icons',
            'customizer' => true,
            'transport' => 'refresh'
        );

    }

    return $kleo;

}

function kleo_bp_profile_menu_tabs(){

    $bp = buddypress();

    $theme_options = sq_options();
    $bp_nav_options = array();

    foreach ( $theme_options as $k => $opt ) {
        if ( 0 === strpos($k, 'bp_nav_') ) {
            $bp_nav_options[str_replace('bp_nav_', '', $k)] = $opt;
        }
    }

    if (version_compare(BP_VERSION, '2.6', '>=')) {
        $nav_items = $bp->members->nav->get_primary();
    } else {
        $nav_items = $bp->bp_nav;
    }

    $default_icons = Kleo::get_config('bp_default_icons');
    if (! empty( $nav_items ) ) {
        foreach ( $nav_items as $nav ) {

            if (isset($bp_nav_options[$nav['slug']])) {
                $icon = $bp_nav_options[$nav['slug']];
            } else {
                if (isset($default_icons[$nav['slug']])) {
                    $icon = $default_icons[$nav['slug']];
                } else {
                    $icon = $default_icons['default'];
                }
            }
            if (version_compare(BP_VERSION, '2.6', '>=')) {
                $nav['name'] = '<i class="icon-' . $icon . '"></i> ' . $nav['name'];
            } else {
                $bp->bp_nav[ $nav['slug'] ]['name'] = '<i class="icon-' . $icon . '"></i> ' . $bp->bp_nav[ $nav['slug'] ]['name'];
            }

        }
    }

}
if ( ! is_admin() || is_customize_preview() ) {
    add_action( 'init', 'kleo_bp_profile_menu_tabs', 201 );
}


/**
 * Get BuddyPress navigation icons
 * @return array
 */
function kleo_bp_get_navigation()
{
    $nav_items = array();
    global $bp;

    foreach ($bp->bp_nav as $nav) {
        $nav_items[$nav['slug']] = $nav['name'];
    }

    return $nav_items;
}
