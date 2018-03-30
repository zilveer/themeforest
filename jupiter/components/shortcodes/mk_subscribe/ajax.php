<?php
if (!defined('THEME_FRAMEWORK'))
{
    exit('No direct script access allowed');
}

/**
 * Class to for MailChimp operations using ajax
 *
 * @author      Mucahit Yilmaz
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @version     5.0
 * @package     artbees
 */

class Mk_Ajax_Subscribe
{

    public function __construct()
    {
        add_action('wp_ajax_nopriv_mk_ajax_subscribe', array(&$this,
            'subscribe_to_list',
        ));
        add_action('wp_ajax_mk_ajax_subscribe', array(&$this,
            'subscribe_to_list',
        ));
    }

    public function subscribe_to_list()
    {

        $email   = stripslashes($_POST['email']);
        $list_id = stripslashes($_POST['list_id']);
        $optin   = stripslashes($_POST['optin']);

        $result = $this->subscribe($email, $list_id, $optin);

        if (empty($result['status']) == false)
        {
            switch ($result['name'])
            {
                case 'Invalid_ApiKey':
                    echo json_encode(
                        array(
                            'action_status' => false,
                            'message'       => $result['error'],
                        )
                    );
                    break;
                case 'List_DoesNotExist':
                    echo json_encode(
                        array(
                            'action_status' => false,
                            'message'       => $result['error'],
                        )
                    );
                    break;
                case 'ValidationError':
                    echo json_encode(
                        array(
                            'action_status' => false,
                            'message'       => __('Oops! Enter a valid Email address', 'mk_framework'),
                        )
                    );
                    break;

                case 'List_AlreadySubscribed':
                    echo json_encode(
                        array(
                            'action_status' => false,
                            'message'       => __('This email already subscribed to the list.', 'mk_framework'),
                        )
                    );
                    break;
            }
        }
        elseif (isset($result['email']))
        {
            echo json_encode(
                array(
                    'action_status' => true,
                    'message'       => $result['email'] . __(' has been subscribed.', 'mk_framework'),
                )
            );
        }
        wp_die();
    }

    private function subscribe($email, $list_id, $optin)
    {

        $path    = pathinfo(__FILE__);
        $dirname = $path['dirname'];
        require_once $dirname . '/MailChimpApi.php';

        global $mk_options;

        $mailchimp = new MailChimp( trim( $mk_options['mailchimp_api_key'] ) );

        // return $mailchimp->get_lists();
        return $mailchimp->subscribe($email, $list_id, $optin);
    }
}

new Mk_Ajax_Subscribe();
