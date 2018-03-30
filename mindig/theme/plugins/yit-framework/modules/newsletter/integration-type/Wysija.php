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
 * @package Yithemes
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * YIT_Newsletter_Mailchimp exists
 */
define( 'YIT_NEWSLETTER_MAILPOET', true );

/**
 * Perform Newsletter Mailchimp init
 *
 * @class YIT_Newsletter_Mailchimp
 * @package Yithemes
 * @since Version 1.0.0
 * @author Your Inspiration Themes
 */
class YIT_Newsletter_Wysija{
    /**
     * @var string $newsletter_post_type The post type name for the post type of all newsletter forms
     */
    public $newsletter_post_type;

    /**
     * @var string Plugin url
     */
    public $plugin_url;

    /**
     * @var string Plugin path
     */
    public $plugin_path;

    /**
     * Constructor
     *
     * Add mailchimp to integration list in newsletter plugin
     *
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function __construct( ){
        if( defined( 'WYSIJA' ) ){
            $this->newsletter_post_type = YIT_Newsletter()->newsletter_post_type;
            $this->plugin_url  = YIT_Newsletter()->plugin_url;
            $this->plugin_path = YIT_Newsletter()->plugin_path;
            // register integration type
            add_filter( 'yit-newsletter-integration-type', array( $this, 'add_integration_type' ) );
            add_filter( 'yit-newsletter-metabox', array($this, 'add_metabox_field') );

            // CUSTOM INTEGRATION TYPE HANDLING
            $this->add_form_handling();
        }
    }

    /**
     * Add Integration Type
     *
     * Add mailpoet integration to integration mode select in newsletter plugin
     *
     * @param $types
     *
     * @return mixed
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_integration_type( $types ){
        $types['mailpoet'] = __( 'Wysija', 'yit' );

        return $types;
    }

    /**
     * Add Metabox Field
     *
     * Add mailpoet specific fields to newsletter cpt metabox
     *
     * @param $args
     *
     * @return mixed
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_metabox_field( $args ){
        global $pagenow;
        // generate option array
        $options = array( '-1' => __( 'Select a list', 'yit' ) );

        $mailpoet_lists = $this->get_mailpoet_lists();

        if( $mailpoet_lists !== false ){
            $options = $options + $mailpoet_lists;
        }

        $args = array_merge(
            $args,
            array(
                'mailpoet-list' => array(
                    'label' => __( 'Wysija List', 'yit' ),
                    'desc' => __( 'A valid wysija list name.', 'yit' ),
                    'type' => 'select',
                    'std' => '-1',
                    'options' => $options,
                    'deps'     => array(
                        'ids' => '_integration',
                        'values' => 'mailpoet'
                    )
                )
            )
        );

        return $args;
    }

    /**
     * Add Form Handling
     *
     * Add the frontend form handling, if needed
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function add_form_handling(){
        // add mailchimp subscription
        add_action( 'wp_ajax_subscribe_mailpoet_user', array( $this, 'subscribe_mailpoet_user' ) );
        add_action( 'wp_ajax_nopriv_subscribe_mailpoet_user', array( $this, 'subscribe_mailpoet_user'));
    }

    /**
     * Subscribe Mailpoet user
     *
     * Add user to a mailpoet list posted via AJAX-Request to wp_ajax_subscribe_mailpoet_user action
     *
     * @return void
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function subscribe_mailpoet_user(){
        $post_id = $_REQUEST['yit_mailpoet_newsletter_form_id'];
        $mail = $_REQUEST['yit_mailpoet_newsletter_form_email'];

        $list = "";

        if( isset( $post_id ) && strcmp( $post_id, '' ) != 0 ){
            $list = YIT_Newsletter()->get_meta( '_mailpoet-list', $post_id );
        }

        if( isset( $mail ) && is_email( $mail ) ){
            if( isset( $list ) && strcmp( $list, '-1' ) != 0 && check_ajax_referer( 'yit_mailpoet_newsletter_form_nonce', 'yit_mailpoet_newsletter_form_nonce', false ) ){

                $user_data = array(
                    'email' => $mail
                );
                $data_subscriber = array(
                    'user' => $user_data,
                    'user_list' => array('list_ids' => array($list))
                );

                $helper_user = WYSIJA::get('user','helper');
                $helper_user->addSubscriber($data_subscriber);

                _e( 'Email succesfully registered', 'yit' );
                die();
            }
            else{
                _e( 'Ops! Something went wrong', 'yit');
                die();
            }
        }
        else{
            _e( 'Ops! You have to insert a valid email', 'yit');
            die();
        }
    }

    /**
     * Get Mailpoet list registered in db
     *
     * Get mailpoet lists
     *
     * @return boolean|mixed array()
     * @since 1.0.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.it>
     */
    public function get_mailpoet_lists(){
        $model_list =  WYSIJA::get('list','model');
        $mailpoet_lists = $model_list->get(array('name','list_id'),array('is_enabled'=>1));

        if(! empty($mailpoet_lists) ){
            $lists = array();
            foreach( $mailpoet_lists as $list ){
                $lists[ $list['list_id'] ] = $list['name'];
            }

            return $lists;
        }
        else{
            return false;
        }
    }
}