<?php

/**
 * Custom widgets for trizzy theme
 *
 *
 * @package trizzy
 * @since trizzy 1.0
 */


add_action('widgets_init', 'trizzy_load_widgets'); // Loads widgets here
function trizzy_load_widgets() {
    register_widget('trizzy_tabbed');
    if(class_exists( 'WooCommerce' ) ) { register_widget( 'Trizzy_WC_Widget_Product_Categories' ); }
    if(class_exists('NS_MC_Plugin')){ register_widget('trizzy_NS_Widget_MailChimp'); }
}

class trizzy_tabbed extends WP_Widget {

    function trizzy_tabbed() {
        $widget_ops = array('classname' => 'trizzy-tabbed', 'description' => 'Tabbed widget for post and comments');
        $control_ops = array('width' => 300, 'height' => 350);
        parent::__construct('trizzy_tabbed', 'Trizzy Tabbed Widget', $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $recent = $instance['recent'];
        $popular = $instance['popular'];
        $comments = $instance['comments'];
        $recenttitle = empty($instance['recenttitle']) ? 'Recent' : $instance['recenttitle'];
        $populartitle = empty($instance['populartitle']) ? 'Popular' : $instance['populartitle'];
        $commentstitle = empty($instance['commentstitle']) ? 'Comments' : $instance['commentstitle'];
        $number = $instance['number'];
        echo $before_widget;
        ?>

        <ul class="tabs-nav blog">
            <?php if(!empty($recent)) { ?><li class="active"><a href="#tab1" title="Recent Posts"><?php echo $recenttitle; ?></a></li><?php } ?>
            <?php if(!empty($popular)) { ?><li><a href="#tab2" title="Popular Posts"><?php echo $populartitle; ?></a></li><?php } ?>
            <?php if(!empty($comments)) { ?><li><a href="#tab3" title="Recent Comments"><?php echo $commentstitle; ?></a></li><?php } ?>
        </ul>
        <!-- Tabs Content -->
        <div class="tabs-container">
         <?php if(!empty($recent)) { ?>
         <div class="tab-content" id="tab1">
             <!-- Recent Posts -->
             <ul class="widget-tabs">
                <?php echo self::showLatest($posts = $number); ?>
            </ul>
        </div>
        <?php } ?>
        <?php if(!empty($popular)) { ?>
        <div class="tab-content" id="tab2">
            <!-- Popular Posts -->
            <ul class="widget-tabs">
               <?php echo self::showLatest($posts = $number, $orderby = "comment_count"); ?>
           </ul>
       </div>
       <?php } ?>

       <?php if(!empty($comments)) { ?>
       <div class="tab-content" id="tab3">
           <!-- Recent Comments -->
           <ul class="widget-tabs comments">
               <?php echo self::showLatestComments($posts = $number); ?>
           </ul>
       </div>
       <?php } ?>
   </div>


   <?php
   echo $after_widget;
}


function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['recent'] = strip_tags($new_instance['recent']);
    $instance['popular'] = strip_tags($new_instance['popular']);
    $instance['comments'] = strip_tags($new_instance['comments']);
    $instance['recenttitle'] = strip_tags($new_instance['recenttitle']);
    $instance['populartitle'] = strip_tags($new_instance['populartitle']);
    $instance['commentstitle'] = strip_tags($new_instance['commentstitle']);
    $instance['number'] = strip_tags($new_instance['number']);
    return $instance;
}

function form($instance) {
    $instance = wp_parse_args((array) $instance, array('title' => ''));
    $title = strip_tags($instance['title']);
    $recent = $instance['recent'];
    $popular = $instance['popular'];
    $comments = $instance['comments'];
    $recenttitle = empty($instance['recenttitle']) ? 'Recent' : $instance['recenttitle'];
    $populartitle = empty($instance['populartitle']) ? 'Popular' : $instance['populartitle'];
    $commentstitle = empty($instance['commentstitle']) ? 'Comments' : $instance['commentstitle'];

    $number = esc_attr($instance['number']);
    ?>
    <p>Set tabs to display:</p>
    <p>
        <input id="<?php echo $this->get_field_id('recent'); ?>" name="<?php echo $this->get_field_name('recent'); ?>" type="checkbox" value="1" <?php checked( '1', $recent ); ?>/>
        <label for="<?php echo $this->get_field_id('recent'); ?>"><?php _e('Recent posts','trizzy'); ?></label>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('recenttitle'); ?>"><?php _e('Recent posts Title','trizzy'); ?></label>
        <input id="<?php echo $this->get_field_id('recenttitle'); ?>" name="<?php echo $this->get_field_name('recenttitle'); ?>" type="text" value="<?php echo esc_attr($recenttitle); ?>" />
    </p>
    <p>
        <input id="<?php echo $this->get_field_id('popular'); ?>" name="<?php echo $this->get_field_name('popular'); ?>" type="checkbox" value="1" <?php checked( '1', $popular ); ?>/>
        <label for="<?php echo $this->get_field_id('popular'); ?>"><?php _e('Popular posts','trizzy'); ?></label>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('populartitle'); ?>"><?php _e('Popular posts Title','trizzy'); ?></label>
        <input id="<?php echo $this->get_field_id('populartitle'); ?>" name="<?php echo $this->get_field_name('populartitle'); ?>" type="text" value="<?php echo esc_attr($populartitle); ?>" />
    </p>
    <p>
        <input id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" type="checkbox" value="1" <?php checked( '1', $comments ); ?>/>
        <label for="<?php echo $this->get_field_id('comments'); ?>"><?php _e('Latest comments','trizzy'); ?></label>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('commentstitle'); ?>"><?php _e('Latest comments Title','trizzy'); ?></label>
        <input id="<?php echo $this->get_field_id('commentstitle'); ?>" name="<?php echo $this->get_field_name('commentstitle'); ?>" type="text" value="<?php echo esc_attr($commentstitle); ?>" />
    </p>

    <label>Set number of items to display
        <select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
            <?php for ($i=1; $i < 10; $i++) { ?>
            <option <?php if ($number == $i) echo 'selected'; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
    </label>
    <?php
}

/**
     * Display Latest posts
     */
static function showLatest( $posts = 3, $orderby = 'post_date' ) {
    global $post;
    $latest = get_posts(
        array(
            'suppress_filters' => false,
            'ignore_sticky_posts' => 1,
            'orderby' => $orderby,
            'order' => 'desc',
            'numberposts' => $posts )
        );

    ob_start();

    $date_format = get_option('date_format');
    foreach($latest as $post) :
        setup_postdata($post);
    ?>

    <!-- Post #1 -->
    <li>
        <?php if ( has_post_thumbnail() ) { ?>
        <div class="widget-thumb">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('shop-small-thumb'); ?></a>
        </div>
        <?php } ?>

        <div class="widget-text">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <span><?php echo get_the_date(); ?></span>
        </div>
        <div class="clearfix"></div>
    </li>

    <?php endforeach;
    $contents = ob_get_contents();
    ob_end_clean();
    return $contents;
}

static function showLatestComments( $posts = 3 ) {
    global $post;

    $comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $posts, 'status' => 'approve', 'post_status' => 'publish' ) ) );

    ob_start();

    if ( $comments ) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
        $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
        _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

        foreach ( (array) $comments as $comment) { ?>
        <li>
            <div class="widget-thumb">
                <a href="<?php echo esc_url( get_comment_link($comment->comment_ID) ); ?>">
                    <?php echo get_avatar( $comment->comment_author_email, 100 ); ?>
                </a>
            </div>

            <div class="widget-text">
                <span><?php echo $comment->comment_author; ?> on:</span>
                <h4><a href="<?php echo esc_url( get_comment_link($comment->comment_ID) ); ?>"><?php echo $comment->post_title; ?></a></h4>
            </div>
            <div class="clearfix"></div>
        </li>
        <?php

    }
}
$contents = ob_get_contents();
ob_end_clean();
return $contents;
}

    /**
     * Display most commented posts
     */
} //eof tabbed




/**
 * @author James Lafferty
 * @since 0.1
 */

class Trizzy_NS_Widget_MailChimp extends WP_Widget {
    private $default_failure_message;
    private $default_loader_graphic = '/images/loader.gif';
    private $default_signup_text;
    private $default_success_message;
    private $default_title;
    private $successful_signup = false;
    private $subscribe_errors;
    private $trizzy_ns_mc_plugin;

    /**
     * @author James Lafferty
     * @since 0.1
     */
    public function Trizzy_NS_Widget_MailChimp () {
        $this->default_failure_message = __('There was a problem processing your submission.','trizzy');
        $this->default_signup_text = __('Join','trizzy');
        $this->default_success_message = __('Thank you for joining our mailing list. Please check your email for a confirmation link.','trizzy');
        $this->default_title = __('Newsletter.','trizzy');
        $widget_options = array('classname' => 'widget_ns_mailchimp', 'description' => __( "Displays a sign-up form for a MailChimp mailing list.", 'trizzy'));
        parent::__construct('trizzy_ns_widget_mailchimp', __('Trizzy MailChimp List Signup', 'trizzy'), $widget_options);
        $this->trizzy_ns_mc_plugin = NS_MC_Plugin::get_instance();
        $this->default_loader_graphic = get_template_directory_uri() . $this->default_loader_graphic;
        add_action('init', array(&$this, 'add_scripts'));
        add_action('parse_request', array(&$this, 'process_submission'));
    }

    /**
     * @author James Lafferty
     * @since 0.1
     */

    public function add_scripts () {
        wp_dequeue_script('ns-mc-widget');
        wp_enqueue_script('ns-mc-widget1', get_template_directory_uri() . '/js/mailchimp-widget.js', array('jquery'), false);
    }

    /**
     * @author James Lafferty
     * @since 0.1
     */

    public function form ($instance) {
        $mcapi = $this->trizzy_ns_mc_plugin->get_mcapi();
        if (false == $mcapi) {
            echo $this->trizzy_ns_mc_plugin->get_admin_notices();
        } else {
            $this->lists = $mcapi->lists();
            $defaults = array(
                'failure_message' => $this->default_failure_message,
                'title' => $this->default_title,
                'signup_text' => $this->default_signup_text,
                'success_message' => $this->default_success_message,
                'collect_first' => false,
                'collect_last' => false,
                'old_markup' => false
                );
            $vars = wp_parse_args($instance, $defaults);
            extract($vars);
            ?>
            <h3><?php echo  __('General Settings', 'trizzy'); ?></h3>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo  __('Title :', 'trizzy'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('desc'); ?>"><?php echo  __('Description :', 'trizzy'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo $desc; ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('current_mailing_list'); ?>"><?php echo __('Select a Mailing List :', 'trizzy'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('current_mailing_list');?>" name="<?php echo $this->get_field_name('current_mailing_list'); ?>">
                    <?php
                    foreach ($this->lists['data'] as $key => $value) {
                        $selected = (isset($current_mailing_list) && $current_mailing_list == $value['id']) ? ' selected="selected" ' : '';
                        ?>
                        <option <?php echo $selected; ?>value="<?php echo $value['id']; ?>"><?php echo __($value['name'], 'trizzy'); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p><strong>N.B.</strong><?php echo  __('This is the list your users will be signing up for in your sidebar.', 'trizzy'); ?></p>
            <p>
                <label for="<?php echo $this->get_field_id('signup_text'); ?>"><?php echo __('Sign Up Button Text :', 'trizzy'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('signup_text'); ?>" name="<?php echo $this->get_field_name('signup_text'); ?>" value="<?php echo esc_attr($signup_text); ?>" />
            </p>
            <h3><?php echo __('Personal Information', 'trizzy'); ?></h3>
            <p><?php echo __("These fields won't (and shouldn't) be required. Should the widget form collect users' first and last names?", 'trizzy'); ?></p>
            <p>
                <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('collect_first'); ?>" name="<?php echo $this->get_field_name('collect_first'); ?>" <?php echo  checked($collect_first, true, false); ?> />
                <label for="<?php echo $this->get_field_id('collect_first'); ?>"><?php echo  __('Collect first name.', 'trizzy'); ?></label>
                <br />
                <input type="checkbox" class="checkbox" id="<?php echo  $this->get_field_id('collect_last'); ?>" name="<?php echo $this->get_field_name('collect_last'); ?>" <?php echo checked($collect_last, true, false); ?> />
                <label><?php echo __('Collect last name.', 'trizzy'); ?></label>
            </p>
            <h3><?php echo __('Notifications', 'trizzy'); ?></h3>
            <p><?php echo  __('Use these fields to customize what your visitors see after they submit the form', 'trizzy'); ?></p>
            <p>
                <label for="<?php echo $this->get_field_id('success_message'); ?>"><?php echo __('Success :', 'trizzy'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('success_message'); ?>" name="<?php echo $this->get_field_name('success_message'); ?>"><?php echo $success_message; ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('failure_message'); ?>"><?php echo __('Failure :', 'trizzy'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id('failure_message'); ?>" name="<?php echo $this->get_field_name('failure_message'); ?>"><?php echo $failure_message; ?></textarea>
            </p>
            <?php

        }
    }

    /**
     * @author James Lafferty
     * @since 0.1
     */

    public function process_submission () {

        if (isset($_GET[$this->id_base . '_email'])) {

            header("Content-Type: application/json");

            //Assume the worst.
            $response = '';
            $result = array('success' => false, 'error' => $this->get_failure_message($_GET['ns_mc_number']));

            $merge_vars = array();

            if (! is_email($_GET[$this->id_base . '_email'])) { //Use WordPress's built-in is_email function to validate input.

                $response = json_encode($result); //If it's not a valid email address, just encode the defaults.

            } else {

                $mcapi = $this->trizzy_ns_mc_plugin->get_mcapi();

                if (false == $this->trizzy_ns_mc_plugin) {

                    $response = json_encode($result);

                } else {

                    if (isset($_GET[$this->id_base . '_first_name']) && is_string($_GET[$this->id_base . '_first_name'])) {

                        $merge_vars['FNAME'] = $_GET[$this->id_base . '_first_name'];

                    }

                    if (isset($_GET[$this->id_base . '_last_name']) && is_string($_GET[$this->id_base . '_last_name'])) {

                        $merge_vars['LNAME'] = $_GET[$this->id_base . '_last_name'];

                    }

                    $subscribed = $mcapi->listSubscribe($this->get_current_mailing_list_id($_GET['ns_mc_number']), $_GET[$this->id_base . '_email'], $merge_vars);

                    if (false == $subscribed) {

                        $response = json_encode($result);

                    } else {

                        $result['success'] = true;
                        $result['error'] = '';
                        $result['success_message'] =  $this->get_success_message($_GET['ns_mc_number']);
                        $response = json_encode($result);

                    }

                }

            }

            exit($response);

        } elseif (isset($_POST[$this->id_base . '_email'])) {

            $this->subscribe_errors = '<div class="notification closeable error"><p>'  . $this->get_failure_message($_POST['ns_mc_number']) .  '</p></div>';

            if (! is_email($_POST[$this->id_base . '_email'])) {

                return false;

            }

            $mcapi = $this->trizzy_ns_mc_plugin->get_mcapi();

            if (false == $mcapi) {

                return false;

            }

            if (is_string($_POST[$this->id_base . '_first_name'])  && '' != $_POST[$this->id_base . '_first_name']) {

                $merge_vars['FNAME'] = strip_tags($_POST[$this->id_base . '_first_name']);

            }

            if (is_string($_POST[$this->id_base . '_last_name']) && '' != $_POST[$this->id_base . '_last_name']) {

                $merge_vars['LNAME'] = strip_tags($_POST[$this->id_base . '_last_name']);

            }

            $subscribed = $mcapi->listSubscribe($this->get_current_mailing_list_id($_POST['ns_mc_number']), $_POST[$this->id_base . '_email'], $merge_vars);

            if (false == $subscribed) {

                return false;

            } else {

                $this->subscribe_errors = '';

                //setcookie($this->id_base . '-' . $this->number, $this->hash_mailing_list_id(), time() + 31556926);

                $this->successful_signup = true;

                $this->signup_success_message = '<p>' . $this->get_success_message($_POST['ns_mc_number']) . '</p>';

                return true;

            }

        }

    }

    /**
     * @author James Lafferty
     * @since 0.1
     */

    public function update ($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['collect_first'] = ! empty($new_instance['collect_first']);

        $instance['collect_last'] = ! empty($new_instance['collect_last']);

        $instance['current_mailing_list'] = esc_attr($new_instance['current_mailing_list']);

        $instance['failure_message'] = esc_attr($new_instance['failure_message']);

        $instance['signup_text'] = esc_attr($new_instance['signup_text']);

        $instance['success_message'] = esc_attr($new_instance['success_message']);

        $instance['title'] = esc_attr($new_instance['title']);

        $instance['desc'] = esc_attr($new_instance['desc']);

        return $instance;

    }

    /**
     * @author James Lafferty
     * @since 0.1
     */

    public function widget ($args, $instance) {

        extract($args);



        echo $before_widget . $before_title . $instance['title'] . $after_title;

        if ($this->successful_signup) {
            echo $this->signup_success_message;
        } else {
            ?>
            <p class="margin-bottom-15"><?php echo $instance['desc']; ?></p>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="<?php echo $this->id_base . '_form-' . $this->number; ?>" method="post">
                <?php echo $this->subscribe_errors;?>
                <?php
                if ($instance['collect_first']) {
                    ?>
                    <input value="<?php echo __('First Name :', 'trizzy'); ?>" onblur="if(this.value=='')this.value='<?php echo __('First Name :', 'trizzy'); ?>';" onfocus="if(this.value=='<?php echo __('First Name :', 'trizzy'); ?>')this.value='';" type="text" name="<?php echo $this->id_base . '_first_name'; ?>" />
                    <br />
                    <br />
                    <?php
                }
                if ($instance['collect_last']) {
                    ?>
                    <input value="<?php echo __('Last Name :', 'trizzy'); ?>" onblur="if(this.value=='')this.value='<?php echo __('Last Name :', 'trizzy'); ?>';" onfocus="if(this.value=='<?php echo __('Last Name :', 'trizzy'); ?>')this.value='';" type="text" name="<?php echo $this->id_base . '_last_name'; ?>" />
                    <br />
                    <br />
                    <?php
                }
                ?>
                <input type="hidden" name="ns_mc_number" value="<?php echo $this->number; ?>" />
                <input class="newsletter" onblur="if(this.value=='')this.value='mail@example.com';" onfocus="if(this.value=='mail@example.com')this.value='';" value="mail@example.com" id="<?php echo $this->id_base; ?>-email-<?php echo $this->number; ?>" type="text" name="<?php echo $this->id_base; ?>_email" />
                <input class="newsletter-btn" type="submit" name="<?php echo __($instance['signup_text'], 'trizzy'); ?>" value="<?php echo __($instance['signup_text'], 'trizzy'); ?>" />
            </form>
            <script>jQuery('#<?php echo $this->id_base; ?>_form-<?php echo $this->number; ?>').ns_mc_widget({"url" : "<?php echo $_SERVER['PHP_SELF']; ?>", "cookie_id" : "<?php echo $this->id_base; ?>-<?php echo $this->number; ?>", "cookie_value" : "<?php echo $this->hash_mailing_list_id(); ?>", "loader_graphic" : "<?php echo $this->default_loader_graphic; ?>"}); </script>
            <?php
        }
        echo $after_widget;


    }

    /**
     * @author James Lafferty
     * @since 0.1
     */

    private function hash_mailing_list_id () {

        $options = get_option($this->option_name);

        $hash = md5($options[$this->number]['current_mailing_list']);

        return $hash;

    }

    /**
     * @author James Lafferty
     * @since 0.1
     */

    private function get_current_mailing_list_id ($number = null) {

        $options = get_option($this->option_name);

        return $options[$number]['current_mailing_list'];

    }

    /**
     * @author James Lafferty
     * @since 0.5
     */

    private function get_failure_message ($number = null) {

        $options = get_option($this->option_name);

        return $options[$number]['failure_message'];

    }

    /**
     * @author James Lafferty
     * @since 0.5
     */

    private function get_success_message ($number = null) {

        $options = get_option($this->option_name);

        return $options[$number]['success_message'];

    }

}




/**
 * Product Categories Widget
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */

if(class_exists( 'WooCommerce' ) ) { 
class Trizzy_WC_Widget_Product_Categories extends WC_Widget {

    /**
     * Category ancestors
     *
     * @var array
     */
    public $cat_ancestors;

    /**
     * Current Category
     *
     * @var bool
     */
    public $current_cat;

    /**
     * Constructor
     */
    public function __construct() {
        $this->widget_cssclass    = 'trizzy_woocommerce widget_product_categories';
        $this->widget_description = __( 'A list or dropdown of product categories.', 'woocommerce' );
        $this->widget_id          = 'trizzy_woocommerce_product_categories';
        $this->widget_name        = __( 'Trizzy WooCommerce Product Categories', 'woocommerce' );
        $this->settings           = array(
            'title'  => array(
                'type'  => 'text',
                'std'   => __( 'Product Categories', 'woocommerce' ),
                'label' => __( 'Title', 'woocommerce' )
            ),
            'orderby' => array(
                'type'  => 'select',
                'std'   => 'name',
                'label' => __( 'Order by', 'woocommerce' ),
                'options' => array(
                    'order' => __( 'Category Order', 'woocommerce' ),
                    'name'  => __( 'Name', 'woocommerce' )
                )
            ),
            'dropdown' => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => __( 'Show as dropdown', 'woocommerce' )
            ),
            'count' => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => __( 'Show product counts', 'woocommerce' )
            ),
            'hierarchical' => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => __( 'Show hierarchy', 'woocommerce' )
            ),
            'show_children_only' => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => __( 'Only show children of the current category', 'woocommerce' )
            )
        );

        parent::__construct();
    }

    /**
     * widget function.
     *
     * @see WP_Widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        global $wp_query, $post;

        $c             = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
        $h             = isset( $instance['hierarchical'] ) ? $instance['hierarchical'] : $this->settings['hierarchical']['std'];
        $s             = isset( $instance['show_children_only'] ) ? $instance['show_children_only'] : $this->settings['show_children_only']['std'];
        $d             = isset( $instance['dropdown'] ) ? $instance['dropdown'] : $this->settings['dropdown']['std'];
        $o             = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];
        $dropdown_args = array( 'hide_empty' => false );
        $list_args     = array( 'show_count' => $c, 'hierarchical' => $h, 'taxonomy' => 'product_cat', 'hide_empty' => false );

        // Menu Order
        $list_args['menu_order'] = false;
        if ( $o == 'order' ) {
            $list_args['menu_order'] = 'asc';
        } else {
            $list_args['orderby']    = 'title';
        }

        // Setup Current Category
        $this->current_cat   = false;
        $this->cat_ancestors = array();

        if ( is_tax( 'product_cat' ) ) {

            $this->current_cat   = $wp_query->queried_object;
            $this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );

        } elseif ( is_singular( 'product' ) ) {

            $product_category = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent' ) );

            if ( $product_category ) {
                $this->current_cat   = end( $product_category );
                $this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
            }

        }

        // Show Siblings and Children Only
        if ( $s && $this->current_cat ) {

            // Top level is needed
            $top_level = get_terms(
                'product_cat',
                array(
                    'fields'       => 'ids',
                    'parent'       => 0,
                    'hierarchical' => true,
                    'hide_empty'   => false
                )
            );

            // Direct children are wanted
            $direct_children = get_terms(
                'product_cat',
                array(
                    'fields'       => 'ids',
                    'parent'       => $this->current_cat->term_id,
                    'hierarchical' => true,
                    'hide_empty'   => false
                )
            );

            // Gather siblings of ancestors
            $siblings  = array();
            if ( $this->cat_ancestors ) {
                foreach ( $this->cat_ancestors as $ancestor ) {
                    $ancestor_siblings = get_terms(
                        'product_cat',
                        array(
                            'fields'       => 'ids',
                            'parent'       => $ancestor,
                            'hierarchical' => false,
                            'hide_empty'   => false
                        )
                    );
                    $siblings = array_merge( $siblings, $ancestor_siblings );
                }
            }

            if ( $h ) {
                $include = array_merge( $top_level, $this->cat_ancestors, $siblings, $direct_children, array( $this->current_cat->term_id ) );
            } else {
                $include = array_merge( $direct_children );
            }

            $dropdown_args['include'] = implode( ',', $include );
            $list_args['include']     = implode( ',', $include );

            if ( empty( $include ) ) {
                return;
            }

        } elseif ( $s ) {
            $dropdown_args['depth']        = 1;
            $dropdown_args['child_of']     = 0;
            $dropdown_args['hierarchical'] = 1;
            $list_args['depth']            = 1;
            $list_args['child_of']         = 0;
            $list_args['hierarchical']     = 1;
        }

        $this->widget_start( $args, $instance );

        // Dropdown
        if ( $d ) {
            $dropdown_defaults = array(
                'show_counts'        => $c,
                'hierarchical'       => $h,
                'show_uncategorized' => 0,
                'orderby'            => $o,
                'selected'           => $this->current_cat ? $this->current_cat->slug : ''
            );
            $dropdown_args = wp_parse_args( $dropdown_args, $dropdown_defaults );

            // Stuck with this until a fix for http://core.trac.wordpress.org/ticket/13258
            wc_product_dropdown_categories( apply_filters( 'woocommerce_product_categories_widget_dropdown_args', $dropdown_args ) );

            wc_enqueue_js( "
                jQuery( '.dropdown_product_cat' ).change( function() {
                    if ( jQuery(this).val() != '' ) {
                        var this_page = '';
                        var home_url  = '" . esc_js( home_url( '/' ) ) . "';
                        if ( home_url.indexOf( '?' ) > 0 ) {
                            this_page = home_url + '&product_cat=' + jQuery(this).val();
                        } else {
                            this_page = home_url + '?product_cat=' + jQuery(this).val();
                        }
                        location.href = this_page;
                    }
                });
            " );

        // List
        } else {

            include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );

            $list_args['walker']                     = new WC_Product_Cat_List_Walker;
            $list_args['title_li']                   = '';
            $list_args['pad_counts']                 = 1;
            $list_args['show_option_none']           = __('No product categories exist.', 'woocommerce' );
            $list_args['current_category']           = ( $this->current_cat ) ? $this->current_cat->term_id : '';
            $list_args['current_category_ancestors'] = $this->cat_ancestors;

            echo '<ul class="product-categories">';

            wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $list_args ) );

            echo '</ul>';
        }

        $this->widget_end( $args );
    }
}
}
?>