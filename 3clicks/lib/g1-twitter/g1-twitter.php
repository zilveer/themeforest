<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Twitter_Module
 * @since G1_Twitter_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

class G1_Twitter_Module extends G1_Module {
    public function __construct() {
        parent::__construct();

        $this->set_version( '1.0.0' );
    }

    /**
     * Set up all hooks
     */
    protected function setup_hooks() {
        parent::setup_hooks();

        add_action( 'widgets_init', array( $this, 'register_widgets' ) );
        add_action( get_redux_opts_sections_filter_name(), array( $this, 'add_theme_options' ) );
        add_action( 'g1_prefooter_begin', array( $this, 'render_toolbar_in_prefooter' ) );
    }

    public function register_widgets() {
        register_widget( 'G1_Twitter_Widget' );
    }

    public function render_toolbar_in_prefooter () {
        $twitter_toolbar = g1_get_theme_option('ta_prefooter', 'twitter_toolbar', 'none');

        if ( 'none' === $twitter_toolbar ) {
            return;
        }

        $twitter_username = g1_get_theme_option('twitter', 'username', '');
        $twitter_max = g1_get_theme_option('twitter', 'max', 3);

        if ( strlen($twitter_username) > 0 ) {
            echo '<div class="g1-twitter-toolbar">';
            echo do_shortcode( sprintf('[twitter username="%s" max="%s" type="carousel"]', esc_attr($twitter_username), esc_attr($twitter_max) ) );
            echo '</div>';
        }
    }

    public function add_theme_options ( $sections ) {
        $sections['twitter'] = array(
            'priority'   => 970,
            'icon'       => 'twitter',
            'icon_class' => 'icon-large',
            'title'      => __( 'Twitter', Redux_TEXT_DOMAIN ),
            'fields'     => array(
                array(
                    'id'        => 'twitter_username',
                    'priority'  => 5,
                    'type'      => 'text',
                    'title'     => __( 'Username', Redux_TEXT_DOMAIN ),
                    'sub_desc'  => __( 'Global value, used as a default value for shortcodes/widgets and prefooter toolbar', Redux_TEXT_DOMAIN ),
                    'desc'  => __( 'Eg. bringthepixel', Redux_TEXT_DOMAIN )
                ),
                array(
                    'id'        => 'twitter_max',
                    'priority'  => 7,
                    'type'      => 'text',
                    'title'     => __( 'Max Tweets To Show', Redux_TEXT_DOMAIN ),
                    'sub_desc'  => __( 'Global value, used as a default value for shortcodes/widgets and prefooter toolbar', Redux_TEXT_DOMAIN ),
                    'validate'  => 'numeric',
                    'std'       => 3
                ),
                array(
                    'id'        => 'twitter_autoplay',
                    'priority'  => 8,
                    'type'      => 'select',
                    'title'     => __( 'Autoplay', Redux_TEXT_DOMAIN ),
                    'options'   => array(
                        'standard'  => __('yes', Redux_TEXT_DOMAIN),
                        'none'      => __('no', Redux_TEXT_DOMAIN),
                    ),
                    'std'       => 'standard',
                ),
                array(
                    'id' => 'twitter_cache_duration',
                    'priority' => 10,
                    'type' => 'g1_range',
                    'title' => __( 'Cache Duration', 'g1_theme' ),
                    'sub_desc' => __( 'How long tweets will be fetched from cache, not from Twitter site', 'g1_theme' ),
                    'desc' => __( 'in seconds, empty value for default. 0 value means no cache at all (use it only if you use cache for a whole site)', 'g1_theme' ),
                    'min' => 0,
                    'max' => 86400,
                    'step' => 100,
                    'std' => 3600,
                ),
                array(
                    'id' => 'twitter_retweets',
                    'priority' => 50,
                    'type' => 'select',
                    'title' => __( 'Include Retweets', 'g1_theme' ),
                    'std' => 0,
                    'options'   => array(
                        'none'      => __('no', Redux_TEXT_DOMAIN),
                        'standard'  => __('yes', Redux_TEXT_DOMAIN),
                    ),
                    'std'       => 'none',
                ),
                array(
                    'id' => 'twitter_oauth_info',
                    'priority' => 100,
                    'type' => 'info',
                    'desc'     =>
                        '<h4>' . __( 'oAuth Authentication', 'g1_theme' ) . '</h4>' .
                        '<p>' .
                            __( 'Most of this configuration can be found on the application overview page: <a target="_blank" href="http://dev.twitter.com/apps">http://dev.twitter.com/apps</a>.', 'g1_theme' ) . ' ' .
                            __( 'You\'ll need to create a new Application first.', 'g1_theme' ).
                        '</p>' .
                        '<strong>'.__( 'Why do I need to use oAuth?', 'g1_theme' ).'</strong>'.
                        '<p>' .
                            __( 'According to Twitter doc:', 'g1_theme' ).' '.
                        '"'.__( 'When using OAuth to authenticate requests with the API, the rate limit applied is specific to that user_token. This means, every user who authorizes your application to act on their behalf, has their own bucket of API requests for you to use.', 'g1_theme' ).'"'.
                        '</p>' .
                        '<p>' .
                            __( 'Read more about <a target="_blank" href="https://dev.twitter.com/docs/rate-limiting/1.1">REST API Rate Limiting in v1.1</a>.', 'g1_theme' ) .
                        '</p>',
                ),
                array(
                    'id'        => 'twitter_consumer_key',
                    'priority'  => 120,
                    'type'      => 'text',
                    'title'     => __( 'Consumer Key', Redux_TEXT_DOMAIN ),
                ),
                array(
                    'id'        => 'twitter_consumer_secret',
                    'priority'  => 130,
                    'type'      => 'text',
                    'title'     => __( 'Consumer Secret	', Redux_TEXT_DOMAIN ),
                ),
                array(
                    'id'        => 'twitter_access_token',
                    'priority'  => 140,
                    'type'      => 'text',
                    'title'     => __( 'Access Token', Redux_TEXT_DOMAIN ),
                ),
                array(
                    'id'        => 'twitter_access_token_secret',
                    'priority'  => 150,
                    'type'      => 'text',
                    'title'     => __( 'Access Token Secret', Redux_TEXT_DOMAIN ),
                ),
            )
        );

        return $sections;
    }
}
function G1_Twitter_Module() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Twitter_Module();

    return $instance;
}
// Fire in the hole :)
G1_Twitter_Module();



class G1_Twitter_Shortcode extends G1_Shortcode {
    public function __construct( $id, $args = array() ) {
        parent::__construct( $id, $args );

        add_action( 'g1_shortcode_generator_register', array( $this, 'add_shortcode_generator_item' ) );
    }

    /**
     * Add shortcode to the global shortcode generator
     *
     * @param       G1_Shortcode_Generator $generator
     */
    public function add_shortcode_generator_item( $generator ) {
        $generator->add_item( $this, 'misc' );
    }

    protected function load_attributes() {
        // username attribute
        $this->add_attribute( 'username', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'user_name',
                'user-name',
                'user',
                'name',
            ),
        ));

        // max
        $this->add_attribute( 'max', array(
            'form_control' => 'Text',
            'id_aliases' => array(
                'maximum',
            ),
            'hint'		=> __( 'Maximum items to display', 'g1_theme' ),
        ));

        // type attribute
        $this->add_attribute( 'type', array(
            'form_control' => 'Choice',
            'default'      => 'simple',
            'choices'	   => array(
                'simple' 		=> 'simple',
                'carousel'		=> 'carousel',
            ),
        ));
    }

    /**
     * Shortcode callback function.
     *
     * @return string
     */
    protected function do_shortcode() {
        $error_message = $this->test_dependencies();

        if ( !empty($error_message) ) {
            return $error_message;
        }

        extract( $this->extract() );

        // Sanitize arguments
        $username = preg_replace( '/[^0-9a-zA-Z_-]/', '', $username );
        $max = absint( $max );
        $cache_duration = abs(g1_get_theme_option( 'twitter', 'cache_duration', ''));

        if (strlen($cache_duration) === 0) {
            $cache_duration = 3600;
        } else {
            $cache_duration = abs($cache_duration);
        }

        $autoplay = g1_get_theme_option( 'twitter', 'autoplay') === 'standard';
        $include_rts = g1_get_theme_option( 'twitter', 'retweets') === 'standard';

        $oauth_enabled = (bool)g1_get_theme_option( 'twitter', 'oauth_enabled', true);

        // build oAuth config
        $config['key'] =          g1_get_theme_option( 'twitter', 'consumer_key', '' );
        $config['secret'] =       g1_get_theme_option( 'twitter', 'consumer_secret', '' );
        $config['token'] =        g1_get_theme_option( 'twitter', 'access_token', '' );
        $config['token_secret'] = g1_get_theme_option( 'twitter', 'access_token_secret', '' );
        $config['screenname'] =   $username;
        $config['cache_expire'] = 0;

        $wp_upload_dir = wp_upload_dir();
        $config['directory'] = trailingslashit($wp_upload_dir['basedir']);

        $oauth_configured = !empty($config['key']) && !empty($config['secret']) && !empty($config['token']) && !empty($config['token_secret']);

        $use_oauth = ($oauth_enabled && $oauth_configured);

        // Compose the transient name
        if ($use_oauth) {
            $transient = 'g1_twitter_oauth_' . $config['screenname'] . '_' . $max;
        } else {
            $transient = 'g1_twitter_' . $username . '_' . $max;
        }

        $out = '';

        $tweets = $cache_duration > 0 ? get_transient( $transient ) : false;

        if ( false === $tweets ) {
            // fetch tweets
            if ($use_oauth) {
                require_once('StormTwitter.class.php');

                $obj = new StormTwitter($config);
                $res = $obj->getTweets($max);

                if (empty($res)) {
                    return $out;
                }

                $tweets = $res;
            } else {
                // Compose the resource URL
                $resource = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $username . '&count=' . $max;

                if ($include_rts) {
                    $resource .= '&include_rts=1';
                }

                $result = wp_remote_get($resource);
                if ( is_wp_error( $result ) ) {
                    return $out;
                }

                $json = $result['body'];

                // Convert JSON String to PHP Array
                $tweets = json_decode($json);
            }

            // Set transient
            if ($cache_duration > 0) {
                set_transient($transient, $tweets, $cache_duration);
            }
        }

        $secondsOffset = 0;

        $timezoneOffset = get_option('gmt_offset');
        if (is_numeric($timezoneOffset)) {
            $secondsOffset = $timezoneOffset * 3600;
        }

        // Compose output
        foreach ( (array) $tweets as $tweet) {
            if (is_array($tweet)) {
                $tweet = (object)$tweet;
            }

            if ( empty($tweet->text) ) {
                continue;
            }

            $_out = "\t\t" . '<li>' . "\n" .
                "\t\t\t" . '<div class="g1-twitter__item">' . "\n" .
                "\t\t\t\t" . '<p class="g1-tweet-text">%tweet_text%</p>' . "\n" .
                "\t\t\t\t" . '<p class="g1-meta"><a href="%tweet_href%" rel="bookmark">%tweet_time%, %tweet_date%</a></p>' . "\n" .
                "\t\t\t" . '</div>' . "\n" .
                "\t\t" . '</li>' . "\n";

            $_out = str_replace(
                array(
                    '%tweet_text%',
                    '%tweet_href%',
                    '%tweet_time%',
                    '%tweet_date%',
                ),
                array(
                    $this->twitter_linkify( $tweet->text ),
                    esc_url( 'http://twitter.com/' . $username . '/status/' . $tweet->id_str ),
                    date( get_option( 'time_format' ), strtotime( $tweet->created_at ) + $secondsOffset ),
                    date( get_option( 'date_format' ), strtotime( $tweet->created_at ) + $secondsOffset ),
                ),
                $_out
            );

            $out .= $_out;
        }

        $classes = array(
            'g1-twitter',
            'g1-twitter--' . $type,
            $use_oauth ? 'g1-auth-oauth' : 'g1-auth-simple',
            $autoplay ? 'g1-autoplay-on' : 'g1-autoplay-off'
        );

        $classes = array_merge( $classes, explode(' ', $class ) );

        $out = 	'<div class="'.sanitize_html_classes($classes).'">' . "\n" .
                    "\t" . '<ul class="g1-twitter__items">' . "\n" .
                        $out .
                    "\t" . '</ul>' . "\n" .
                    "\t" . '<p class="g1-twitter__follow"><a href="' . esc_url( 'http://twitter.com/' . $username ) . '">' . sprintf( __( 'Follow @%s', 'g1_theme' ), esc_html( $username ) ) . '</a>' . '</p>' . "\n" .
                '</div>';

        return $out;
    }

    /**
     * Linkifies twitter statuses
     *
     * @param string $status_text
     * @return string
     */
    public function twitter_linkify( $status_text ) {
        // linkify URLs
        $status_text = preg_replace(
            '/(https?:\/\/\S+)/',
            '<a href="\1">\1</a>',
            $status_text
        );

        // linkify twitter users
        $url = 'http://twitter.com';

        $status_text = preg_replace(
            '/(^|\s)@(\w+)/',
            '\1@<a href="'. $url .'/\2">\2</a>',
            $status_text
        );

        // linkify tags
        $url = 'https://twitter.com';

        $status_text = preg_replace(
            '/(^|\s)#(\w+)/',
            '\1#<a class="g1-new-window" href="'. $url .'/search?q=%23\2">\2</a>',
            $status_text
        );

        return $status_text;
    }

    protected function test_dependencies () {
        $error_message = '';

        if ( !function_exists('curl_init') ) {
            $error_message .= __( 'cURL module is not enabled on your server but is required by Twitter component.', 'g1_theme' ).'<br />';
            $error_message .= __( 'Please contact your hosting provider and ask about enabling cURL for your account.', 'g1_theme' );
        }

        return $error_message;
    }
}

function G1_Twitter_Shortcode() {
    static $instance = null;

    if ( null === $instance ) {
        $instance = new G1_Twitter_Shortcode( 'twitter' );
    }

    return $instance;
}
// Fire in the hole :)
G1_Twitter_Shortcode();

class G1_Twitter_Widget extends G1_Shortcode_Widget {
    public function get_id_base() { return 'twitter_widget'; }
    public function get_name() { return __( 'G1 Twitter', 'g1_theme' ); }

    public function setup_shortcode() {
        $this->shortcode = G1_Twitter_Shortcode();
    }
}