<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/10/16
 * Time: 10:29 PM
 */
if ( get_option( 'houzez_1_4_db' ) == false ) :

    function houzez_db_update_notice() {

        $update_url     = add_query_arg( array(
            'houzez_update_bd' => 'true'
        ), admin_url() );

        ?>
        <div class="error notice">
            <h3><?php _e( 'Database need to be update for Houzez 1.4.0', 'houzez' ); ?></h3>
            <p><a href="<?php echo esc_url( $update_url ); ?>"><?php _e( 'Click here for database update, It is recommended', 'houzez' ); ?></a></p>
        </div>
        <?php

    }

    add_action( 'admin_notices', 'houzez_db_update_notice' );

    function houzez_update_bd() {

        if ( isset( $_REQUEST['houzez_update_bd'] ) && $_REQUEST['houzez_update_bd'] == true ) :

            global $wpdb;

            $table     = $wpdb->postmeta;

            $results = $wpdb->get_results( "SELECT * FROM {$table} WHERE meta_key = 'fave_property_location'", OBJECT );

            foreach ( $results as $value ) :

                $postID = $value->post_id;
                $location = explode( ',', $value->meta_value );

                update_post_meta( $postID, 'houzez_geolocation_lat', $location[0] );
                update_post_meta( $postID, 'houzez_geolocation_long', $location[1] );

            endforeach;

            add_option( 'houzez_1_4_db', true );

            header( 'Location: ' . admin_url() );

        endif;

    }

    add_action( 'admin_init', 'houzez_update_bd' );

endif;