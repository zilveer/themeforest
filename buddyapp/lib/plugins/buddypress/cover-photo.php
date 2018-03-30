<?php

function kleo_bp_get_member_cover_attr( $user_id = false )
{
    if ( ! $user_id ) {
        $user_id = bp_get_member_user_id();
    }

    /* BPCP plugin is set to force */
    $bpcp_enabled = bp_get_option( 'bpcp-enabled' );

    if ( $bpcp_enabled || version_compare( BP_VERSION, '2.4', '<' ) ) {
        $cover_url = bp_get_user_meta( $user_id, 'profile_cover', true );
    } else {
        $cover_url = bp_attachments_get_attachment( 'url', array( 'item_id' => $user_id, 'type' => 'cover-image', 'object_dir' => 'members' ) );

        if ( ! $cover_url ) {
            $cover_url = bp_get_user_meta( $user_id, 'profile_cover', true );
        }
    }




    $cover_url = apply_filters( 'bpcp_get_image', $cover_url, $user_id );

    if ( ! $cover_url ) {
        if ( bp_get_option( 'bpcp-profile-default' ) ) {
            $cover_url =  bp_get_option( 'bpcp-profile-default' );
        }
        else {
            return 'class="item-cover"';
        }
    }

    $current_position = bp_get_user_meta( $user_id, 'profile_cover_pos', true );
    if ( ! $current_position ) {
        $current_position = 'center';
    }

    $cover = 'class="item-cover has-cover" style=\'background-image: url("' . $cover_url . '"); background-position: '. $current_position . '; ' .
       'background-repeat: no-repeat; background-size: cover;\'';

    return $cover;
}


function kleo_bp_get_group_cover_attr( $group_id = false ) {
    if ( ! $group_id ) {
        $group_id = bp_get_group_id();
    }

    /* BPCP plugin is set to force */
    $bpcp_enabled = bp_get_option( 'bpcp-enabled' );

    if ( $bpcp_enabled || version_compare( BP_VERSION, '2.4', '<' ) ) {
        $cover_url = groups_get_groupmeta( $group_id, 'bpcp_group_cover' );
    } else {
        $cover_url = bp_attachments_get_attachment( 'url', array( 'item_id' => $group_id, 'type' => 'cover-image', 'object_dir' => 'groups' ) );
        if (! $cover_url) {
            $cover_url = groups_get_groupmeta( $group_id, 'bpcp_group_cover' );
        }
    }

    $cover_url = apply_filters( 'bpcp_get_group_image', $cover_url, $group_id );

    if ( ! $cover_url ) {
        if ( bp_get_option( 'bpcp-group-default' ) ) {
            $cover_url =  bp_get_option('bpcp-group-default');
        }
        else {
            return 'class="item-cover"';
        }
    }

    $current_position = groups_get_groupmeta( $group_id, 'bpcp_group_cover_pos' );
    if ( ! $current_position ) {
        $current_position = 'center';
    }

    $cover = 'class="item-cover has-cover" style=\'background-image: url("' . $cover_url . '"); background-position: '. $current_position . '; ' .
        'background-repeat: no-repeat; background-size: cover;\'';

    return $cover;
}




/* Buddypress cover compatibility */

function sq_bp_cover_image_css( $settings = array() ) {
    /**
     * If you are using a child theme, use bp-child-css
     * as the theme handel
     */
    $theme_handle = 'bp-parent-css';

    $settings['theme_handle'] = $theme_handle;
    $settings['width']  = 768;
    $settings['height'] = 400;


    /**
     * Then you'll probably also need to use your own callback function
     * @see the previous snippet
     */
    $settings['callback'] = 'sq_bp_legacy_theme_cover_image';


    return $settings;
}
add_filter( 'bp_before_xprofile_cover_image_settings_parse_args', 'sq_bp_cover_image_css', 10, 1 );
add_filter( 'bp_before_groups_cover_image_settings_parse_args', 'sq_bp_cover_image_css', 10, 1 );


function kleo_bp_cover_html() {

    $output = '<div class="profile-cover-inner"></div>';

    echo $output;
}

if ( version_compare( BP_VERSION, '2.4', '>=' ) ) {
    add_action('bp_before_member_header', 'kleo_bp_cover_html', 20);
    add_action('bp_before_group_header', 'kleo_bp_cover_html', 20);
}



/**
 * BP Legacy's callback for the cover image feature.
 *
 * @since  2.4.0
 *
 * @param  array $params the current component's feature parameters.
 * @return array          an array to inform about the css handle to attach the css rules to
 */
function sq_bp_legacy_theme_cover_image( $params = array() ) {

    if ( empty( $params ) || (isset($params['cover_image']) && ! $params['cover_image'] ) ) {
        return;
    }

    /* Add body class for users with cover */
    add_filter( 'body_class', 'kleo_bp_cover_add_body_class', 30 );

    $cover_image = 'background-image: url(' . $params['cover_image'] . '); ' .
        'background-repeat: no-repeat; background-size: cover; background-position: center center !important;';
    return '
		/* Cover image */
		body.buddypress div#item-header #header-cover-image {
			' . $cover_image . '
		}';
}

//inject custom class for profile pages
function kleo_bp_cover_add_body_class( $classes ) {
    $classes[] = 'is-user-profile';
    return $classes;
}
