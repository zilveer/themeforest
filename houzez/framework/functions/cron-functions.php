<?php
/**
 * Run cron Jobs for different events
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 04/02/16
 * Time: 5:33 PM
 */

/*-----------------------------------------------------------------------------------*/
// Add Weekly crop interval
/*-----------------------------------------------------------------------------------*/
add_filter( 'cron_schedules', 'houzez_add_weekly_cron_schedule' );
if( !function_exists('houzez_add_weekly_cron_schedule') ):
    function houzez_add_weekly_cron_schedule( $schedules ) {

        $schedules['weekly'] = array(
            'interval' => 7 * 24 * 60 * 60, //7 days * 24 hours * 60 minutes * 60 seconds
            'display'  => 'Once Weekly',
        );
        $schedules['one_minute'] = array(
            'interval' => 30,
            'display'  => 'One minute',
        );

        return $schedules;
    }
endif;

/*-----------------------------------------------------------------------------------*/
// Schedule core
/*-----------------------------------------------------------------------------------*/
function houzez_schedule_checks() {
    $enable_paid_submission = esc_html ( houzez_option('enable_paid_submission') );
    $per_listing_expire_unlimited = houzez_option('per_listing_expire_unlimited');

    // Per listings expire
    if( $enable_paid_submission == 'per_listing' && $per_listing_expire_unlimited != 0 ) {
        wp_clear_scheduled_hook('houzez_per_listing_expire_check');

        if (!wp_next_scheduled('houzez_per_listing_expire_check')) {
            wp_schedule_event(time(), 'twicedaily', 'houzez_per_listing_expire_check');
        }
    }

    // Schedule Membership check
    if( $enable_paid_submission == 'membership' ) {
        wp_clear_scheduled_hook('houzez_check_membership_expire');
        houzez_setup_daily_membership_check_schedule();
    }

    houzez_schedule_email_events();

}
add_action( 'init', 'houzez_schedule_checks' );

/*-----------------------------------------------------------------------------------*/
// Schedule daily membership check
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_setup_daily_membership_check_schedule') ):
    function  houzez_setup_daily_membership_check_schedule(){
        $enable_paid_submission = esc_html ( houzez_option('enable_paid_submission') );

        if( $enable_paid_submission == "membership" ) {
            if (!wp_next_scheduled('houzez_check_membership_expire')) {
                wp_schedule_event(time(), 'twicedaily', 'houzez_check_membership_expire');
            }
        }
    }
endif;
add_action( 'houzez_check_membership_expire', 'houzez_check_membership_expire_cron' );

if( !function_exists('houzez_per_listing_expire_check') ) {
    function houzez_per_listing_expire_check () {

        $enable_paid_submission = esc_html ( houzez_option('enable_paid_submission') );
        $per_listing_expire_unlimited = houzez_option('per_listing_expire_unlimited');
        $per_listing_expiration = intval ( houzez_option('per_listing_expire') );

        if( $enable_paid_submission == 'per_listing' ) {
            if ( $per_listing_expiration != 0 && $per_listing_expiration != '' && $per_listing_expire_unlimited != 0 ) {

                $args = array(
                    'post_type' => 'property',
                    'post_status' => 'publish'
                );

                $prop_selection = new WP_Query($args);
                while ($prop_selection->have_posts()): $prop_selection->the_post();

                    $the_id = get_the_ID();
                    $prop_listed_date = strtotime(get_the_date("Y-m-d", $the_id));

                    $expiration_date = $prop_listed_date + $per_listing_expiration * 24 * 60 * 60;
                    $today = time();

                    $user_id = houzez_get_author_by_post_id( $the_id );
                    $user = new WP_User( $user_id ); //administrator
                    $user_role = $user->roles[0];

                    if( $user_role != 'administrator' ) {
                        if ($expiration_date < $today) {
                            houzez_listing_set_to_expire($the_id);
                        }
                    }

                endwhile;

            }
        }

    }
}
add_action( 'houzez_per_listing_expire_check', 'houzez_per_listing_expire_check' );


/*-----------------------------------------------------------------------------------*/
// Add Weekly crop interval
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_schedule_email_events') ):
    function houzez_schedule_email_events(){
        global $houzez_options;
        $saved_search = $houzez_options['enable_disable_save_search'];
        $saved_search_duration = $houzez_options['save_search_duration'];

        if( $saved_search == '1' ) {
            if( $saved_search_duration == 'daily' ) {
                houzez_setup_saved_search_daily_schedule();

            } elseif( $saved_search_duration == 'weekly' ) {
                houzez_setup_saved_search_weekly_schedule();
            }

        } else {
            wp_clear_scheduled_hook('houzez_check_new_listing_action_hook');
        }

    }
endif;

/*-----------------------------------------------------------------------------------*/
// Add daily crop interval
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'houzez_setup_saved_search_daily_schedule' ) ) {
    function houzez_setup_saved_search_daily_schedule() {
        if (!wp_next_scheduled('houzez_check_new_listing_action_hook')) {
            wp_schedule_event(time(), 'daily', 'houzez_check_new_listing_action_hook');
        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Add Weekly crop interval
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'houzez_setup_saved_search_weekly_schedule' ) ) {
    function houzez_setup_saved_search_weekly_schedule() {
        if (!wp_next_scheduled('houzez_check_new_listing_action_hook2')) {
            wp_schedule_event(time(), 'weekly', 'houzez_check_new_listing_action_hook2');
        }
    }
}



/*-----------------------------------------------------------------------------------*/
// Add Weekly crop interval
/*-----------------------------------------------------------------------------------*/
add_action('houzez_check_new_listing_action_hook', 'houzez_check_new_listing');

if( !function_exists('houzez_check_new_listing') ) {
    function houzez_check_new_listing() {

        $wp_date_query = houzez_get_mail_period();
        $args = array(
            'post_type' => 'property',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'date_query' => $wp_date_query

        );
        $properties = new WP_Query($args);

        if ($properties->have_posts()) {
            houzez_check_saved_search();
        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Check saved searches
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_check_saved_search') ) :
    function houzez_check_saved_search() {
        global $wpdb;

        $table_name     = $wpdb->prefix . 'houzez_search';
        $results        = $wpdb->get_results( 'SELECT * FROM ' . $table_name, OBJECT );

        if ( sizeof ( $results ) !== 0 ) :

            foreach ( $results as $houzez_saved_search ) :

                // $post_id = get_the_id();
                $arguments = unserialize( base64_decode( $houzez_saved_search->query ) );

                $user_email = $houzez_saved_search->email;

                $mail_content = houzez_compose_send_email($arguments);

                if ($user_email != '' && $mail_content != '') :

                    $args = array(
                        'matching_submissions' => $mail_content
                    );

                    houzez_email_type( $user_email, 'matching_submissions', $args );

                endif;

            endforeach;

        endif;

    }

endif;

/*-----------------------------------------------------------------------------------*/
// Add Weekly crop interval
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_mail_period') ) {
    function houzez_get_mail_period() {
        global $houzez_options;
        $saved_search_duration = houzez_option('save_search_duration');
        //$houzez_options['save_search_duration'];

        if ( $saved_search_duration == 'daily' ) {
            $today = getdate();
            $wp_date_query = array(
                array(
                    'year' => $today['year'],
                    'month' => $today['mon'],
                    'day' => $today['mday'],
                )
            );
        } else {
            $wp_date_query = array(
                array(
                    'year' => date('Y'),
                    'week' => date('W'),
                )
            );
        }
        return $wp_date_query;
    }
}

/*-----------------------------------------------------------------------------------*/
// Add Weekly crop interval
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_compose_send_email') ):
    function houzez_compose_send_email($args){
        $mail_content   = '';
        $mail_content   .= esc_html__('Hello,','houzez')."\r\n".esc_html__('A new submission matching your chosen criteria has been published at ', 'houzez').$_SERVER['HTTP_HOST']." \r\n ";
        $mail_content   .=esc_html__('These are the new submissions:','houzez')." \r\n ";
        $arguments      = $args;


        $arguments['date_query'] = $date_query_array = houzez_get_mail_period();


        $prop_selection = new WP_Query($arguments);

        if($prop_selection->have_posts()){

            while ($prop_selection->have_posts()): $prop_selection->the_post();
                $post_id = get_the_id();
                $mail_content .= get_the_permalink($post_id)."\r\n";
            endwhile;
            $mail_content .= "\r\n".esc_html__('If you do not wish to be notified anymore please enter your account and delete the saved search.Thank you!', 'houzez');
        }else{
            $mail_content='';
        }
        wp_reset_postdata();

        return $mail_content;
    }

endif;