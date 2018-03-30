<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


class Haze_Meta_Boxes {

    protected static $instance = null;

    public $prefix = 'clx_';

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    protected function __construct() {

        add_filter('rwmb_meta_boxes', array( &$this, 'haze_register_meta_boxes'));

        if ( is_admin() ) {
            add_action( 'admin_enqueue_scripts', array( &$this, 'zen_meta_admin_init' ));
        }

    }

    public function zen_meta_admin_init() {
        global $pagenow;

        if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' || $pagenow == 'edit.php' ) {

            wp_enqueue_script('clx_meta_js', THEMEROOT .'/assets/js/one-meta-js.js', array('jquery'));

            wp_enqueue_style( 'clx_meta_css', THEMEROOT .'/assets/css/clx-meta-css.css');

        }
    }

    /**
     * @param $meta_boxes
     * @return array
     */
    public function haze_register_meta_boxes( $meta_boxes ) {
        $prefix = $this->prefix;
        $prefix_team = $this->prefix;

        $events_array = array();
        $albums_array = array();

        $meta_boxes[] = array(
            'id'        => "{$prefix}page_layout",
            'title'     => __('Post Layout', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('post'),
            'context'   => 'side',
            'priority'  => 'default',

            'fields'    => array(
                array(
                    'id'            => "{$prefix}page_sidebar",
                    'type'          => 'radio',
                    'class'         => 'custom_sidebar_select',
                    'options'       => array(
                        'left'          => __('Left Sidebar', LANGUAGE_ZONE_ADMIN),
                        'none'          => __('No Sidebar', LANGUAGE_ZONE_ADMIN),
                    ),
                    'std'           => 'left',
                    'desc'          => '<br>*** Use this option to add or hide the single post sidebar.',
                ),
            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}bg_image",
            'title'     => __('Background Image', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('post', 'page', AlbumPostType::get_instance()->postType, EventPostType::get_instance()->postType, ArtistPostType::get_instance()->postType, PhotoPostType::get_instance()->postType, VideoPostType::get_instance()->postType),
            'context'   => 'side',
            'priority'  => 'default',

            'fields'    => array(
                array(
                    'id'            => "{$prefix}bg_image_override",
                    'type'          => 'image_advanced',
                    'max_file_uploads' => 1
                ),
            ),
        );

        // Get the Sliders
        $rev_sliders = array( 'none' => __('none', LANGUAGE_ZONE) );

        if ( class_exists('RevSlider') ) {

            $rev = new RevSlider();

            $arrSliders = $rev->getArrSliders();
            foreach ( (array) $arrSliders as $revSlider ) {
                $rev_sliders[ $revSlider->getAlias() ] = $revSlider->getTitle();
            }
        }

        // Get all songs
        $args1 = array(
            'post_type' => SongPostType::get_instance()->postType,
            'posts_per_page'    => 999
        );
        $songs_array1 = array();
        $songs1 = get_posts($args1);
        foreach($songs1 as $song) {
            $songs_array1[$song->ID] = $song->post_title;
        }

        $meta_boxes[] = array(
            'id'        => "{$prefix}page_header",
            'title'     => __('Page Header Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(

                array(
                    'type' => 'heading',
                    'name' => __( 'Slider', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),

                array(
                    'name'  => __( 'Enable', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}rev_slider_enable",
                    'type'  => 'checkbox',
                ),

                array(
                    'name'  => __( 'Slider:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}rev_slider",
                    'type'          => 'select',
                    'std'			=> 'default',
                    'multiple'    => false,
                    'options'   => $rev_sliders,
                ),

                array(
                    'type' => 'heading',
                    'name' => __( 'Big Player', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),

                array(
                    'name'  => __( 'Enable', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}big_player_enable",
                    'type'  => 'checkbox',
                ),

                array(
                    'name'  => __( 'Songs:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}big_player",
                    'type'  => 'checkbox_list',
                    //'multiple'    => true,
                    'options'   => $songs_array1,
                ),

                array(
                    'name'  => __( 'Autoplay', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}auto_play_player",
                    'type'  => 'checkbox',
                ),

                array(
                    'type' => 'heading',
                    'name' => __( 'Albums / Events / Artists', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),

                array(
                    'name'  => __( 'Enable', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}featured_widget_enable",
                    'type'  => 'checkbox',
                ),

                array(
                    'name'  => __( 'Type:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}featured_widget_post_type",
                    'type'  => 'select',
                    'multiple'    => false,
                    'options'   => array(
                        AlbumPostType::get_instance()->postType     => __('Albums', LANGUAGE_ZONE),
                        EventPostType::get_instance()->postType     => __('Events', LANGUAGE_ZONE),
                        ArtistPostType::get_instance()->postType    => __('Artists', LANGUAGE_ZONE)
                    ),
                ),

                array(
                    'name'  => __( 'Number of items:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}featured_widget_items",
                    'type'  => 'number',
                    //'desc'  => 'How many posts you want to display on a single page?',
                    'std'   => '5'
                ),

                array(
                    'name'     => __( 'Order by', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}featured_widget_order_by",
                    'type'     => 'select',
                    // Array of 'value' => 'Label' pairs for select box
                    'options'  => array(
                        'date'      => __( 'Date', LANGUAGE_ZONE ),
                        'name'      => __( 'Name', LANGUAGE_ZONE ),
                        'author'    => __( 'Author', LANGUAGE_ZONE ),
                        'ID'        => __( 'ID', LANGUAGE_ZONE ),
                        'rand'      => __( 'Random', LANGUAGE_ZONE ),
                        'title'     => __( 'Title', LANGUAGE_ZONE ),
                    ),
                    // Select multiple values, optional. Default is false.
                    'multiple'    => false,
                    'std'         => 'date',
                ),

                array(
                    'name' => __( 'Order', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}featured_widget_order",
                    'type' => 'select',
                    'options' => array(
                        'DESC' => __( 'DESC', LANGUAGE_ZONE ),
                        'ASC' => __( 'ASC', LANGUAGE_ZONE ),
                    ),
                ),

                array(
                    'type' => 'heading',
                    'name' => __( 'Text Title', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),

                array(
                    'name'  => __( 'Enable', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}text_title_enable",
                    'type'  => 'checkbox',
                ),

                array(
                    'name'  => __( 'Title', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}text_title",
                    'type'  => 'text',
                    'desc'  => __('You can use HTML too for bold text or italic.', LANGUAGE_ZONE)
                ),

            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}event_page_layout",
            'title'     => __('Event Layout', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(EventPostType::get_instance()->postType, EventRecurringPostType::get_instance()->postType),
            'context'   => 'side',
            'priority'  => 'default',

            'fields'    => array(
                array(
                    'id'            => "{$prefix}event_template",
                    'type'          => 'radio',
                    'class'         => 'custom_sidebar_select',
                    'options'       => array(
                        'one'          => __('Type 1 ', LANGUAGE_ZONE_ADMIN),
                        'two'          => __('Type 2 (with sidebar)', LANGUAGE_ZONE_ADMIN),
                    ),
                    'std'           => 'one',
                    'desc'          => '<br>*** Use this option to select what type of event single layout you want.',
                ),
            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}event_info",
            'title'     => __('Event Info', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(EventRecurringPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(
                // DATE & TIME INFO
                array(
                    'type' => 'heading',
                    'name' => __( 'Date & Time', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name' => __( 'All Day Event:', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_all_day",
                    'type' => 'checkbox',
                    'class'  => '',
                    'std'  => 0,
                ),
                array(
                    'name' => __( 'Recurrence Start Date', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_start_date_recurrence",
                    'type' => 'date',
                    'js_options' => array(
                        'appendText'      => __( '(dd-mm-yyyy)', LANGUAGE_ZONE_ADMIN ),
                        'dateFormat'      => __( 'dd-mm-yy', LANGUAGE_ZONE_ADMIN ),
                        'changeMonth'     => true,
                        'changeYear'      => true,
                        'showButtonPanel' => true,
                    ),
                ),
                array(
                    'name' => __( 'Recurrence End Date', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_end_date_recurrence",
                    'type' => 'date',
                    'js_options' => array(
                        'appendText'      => __( '(dd-mm-yyyy)', LANGUAGE_ZONE_ADMIN ),
                        'dateFormat'      => __( 'dd-mm-yy', LANGUAGE_ZONE_ADMIN ),
                        'changeMonth'     => true,
                        'changeYear'      => true,
                        'showButtonPanel' => true,
                    ),
                    //'desc' => __('If the event is recurring, the end date will be used as the recurrence end date.', LANGUAGE_ZONE)
                ),
                array(
                    'name'     => __( 'Start Time', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_start_hour",
                    'type'     => 'select',
                    'class'    => 'event_time_hour',
                    'options'  => array(
                        '01' => __( '01', LANGUAGE_ZONE_ADMIN ),
                        '02' => __( '02', LANGUAGE_ZONE_ADMIN ),
                        '03' => __( '03', LANGUAGE_ZONE_ADMIN ),
                        '04' => __( '04', LANGUAGE_ZONE_ADMIN ),
                        '05' => __( '05', LANGUAGE_ZONE_ADMIN ),
                        '06' => __( '06', LANGUAGE_ZONE_ADMIN ),
                        '07' => __( '07', LANGUAGE_ZONE_ADMIN ),
                        '08' => __( '08', LANGUAGE_ZONE_ADMIN ),
                        '09' => __( '09', LANGUAGE_ZONE_ADMIN ),
                        '10' => __( '10', LANGUAGE_ZONE_ADMIN ),
                        '11' => __( '11', LANGUAGE_ZONE_ADMIN ),
                        '12' => __( '12', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_start_minute",
                    'type'     => 'select',
                    'class'    => 'event_time_minute',
                    'options'  => array(
                        '00' => __( '00', LANGUAGE_ZONE_ADMIN ),
                        '05' => __( '05', LANGUAGE_ZONE_ADMIN ),
                        '10' => __( '10', LANGUAGE_ZONE_ADMIN ),
                        '15' => __( '15', LANGUAGE_ZONE_ADMIN ),
                        '20' => __( '20', LANGUAGE_ZONE_ADMIN ),
                        '25' => __( '25', LANGUAGE_ZONE_ADMIN ),
                        '30' => __( '30', LANGUAGE_ZONE_ADMIN ),
                        '35' => __( '35', LANGUAGE_ZONE_ADMIN ),
                        '40' => __( '40', LANGUAGE_ZONE_ADMIN ),
                        '45' => __( '45', LANGUAGE_ZONE_ADMIN ),
                        '50' => __( '50', LANGUAGE_ZONE_ADMIN ),
                        '55' => __( '55', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_start_am_pm",
                    'type'     => 'select',
                    'class'    => 'event_time_am_pm',
                    'options'  => array(
                        'am' => __( 'AM', LANGUAGE_ZONE_ADMIN ),
                        'pm' => __( 'PM', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( 'End Time', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_end_hour",
                    'type'     => 'select',
                    'class'    => 'event_time_hour',
                    'options'  => array(
                        '01' => __( '01', LANGUAGE_ZONE_ADMIN ),
                        '02' => __( '02', LANGUAGE_ZONE_ADMIN ),
                        '03' => __( '03', LANGUAGE_ZONE_ADMIN ),
                        '04' => __( '04', LANGUAGE_ZONE_ADMIN ),
                        '05' => __( '05', LANGUAGE_ZONE_ADMIN ),
                        '06' => __( '06', LANGUAGE_ZONE_ADMIN ),
                        '07' => __( '07', LANGUAGE_ZONE_ADMIN ),
                        '08' => __( '08', LANGUAGE_ZONE_ADMIN ),
                        '09' => __( '09', LANGUAGE_ZONE_ADMIN ),
                        '10' => __( '10', LANGUAGE_ZONE_ADMIN ),
                        '11' => __( '11', LANGUAGE_ZONE_ADMIN ),
                        '12' => __( '12', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_end_minute",
                    'type'     => 'select',
                    'class'    => 'event_time_minute',
                    'options'  => array(
                        '00' => __( '00', LANGUAGE_ZONE_ADMIN ),
                        '05' => __( '05', LANGUAGE_ZONE_ADMIN ),
                        '10' => __( '10', LANGUAGE_ZONE_ADMIN ),
                        '15' => __( '15', LANGUAGE_ZONE_ADMIN ),
                        '20' => __( '20', LANGUAGE_ZONE_ADMIN ),
                        '25' => __( '25', LANGUAGE_ZONE_ADMIN ),
                        '30' => __( '30', LANGUAGE_ZONE_ADMIN ),
                        '35' => __( '35', LANGUAGE_ZONE_ADMIN ),
                        '40' => __( '40', LANGUAGE_ZONE_ADMIN ),
                        '45' => __( '45', LANGUAGE_ZONE_ADMIN ),
                        '50' => __( '50', LANGUAGE_ZONE_ADMIN ),
                        '55' => __( '55', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_end_am_pm",
                    'type'     => 'select',
                    'class'    => 'event_time_am_pm',
                    'options'  => array(
                        'am' => __( 'AM', LANGUAGE_ZONE_ADMIN ),
                        'pm' => __( 'PM', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),

                // RECURRENCE
                array(
                    'type' => 'heading',
                    'name' => __( 'Recurrence', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id_recurrence', // Not used but needed for plugin
                ),
                array(
                    'name'     => __( 'This event repeats', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_recurrence_type",
                    'type'     => 'select',
                    'class'    => 'recurrence_type',
                    'options'  => array(
                        'daily' => __( 'Daily', LANGUAGE_ZONE_ADMIN ),
                        'weekly' => __( 'Weekly', LANGUAGE_ZONE_ADMIN ),
                        'monthly' => __( 'Monthly', LANGUAGE_ZONE_ADMIN ),
                        'yearly' => __( 'Yearly', LANGUAGE_ZONE_ADMIN )
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'  => __( 'Every', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}recurrence_every",
                    'class' => 'recurrence_every',
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'number',
                    'min'   => 1,
                    'std'   => 1
                ),
                array(
                    'name'  => __( 'day(s)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}recurrence_null",
                    'class' => 'recurrence_type_label recurrence_type_label_modify',
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                ),
                array(
                    'name'  => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}recurrence_weekly_days",
                    'type'  => 'checkbox_list',
                    'class' => 'clear recurrence_weekly_days',
                    'multiple'    => true,
                    'options'   => array(
                        'monday' => __( 'Mon', LANGUAGE_ZONE_ADMIN ),
                        'tuesday' => __( 'Tue', LANGUAGE_ZONE_ADMIN ),
                        'wednesday' => __( 'Wen', LANGUAGE_ZONE_ADMIN ),
                        'thursday' => __( 'Thu', LANGUAGE_ZONE_ADMIN ),
                        'friday' => __( 'Fri', LANGUAGE_ZONE_ADMIN ),
                        'saturday' => __( 'Sat', LANGUAGE_ZONE_ADMIN ),
                        'sunday' => __( 'Sun', LANGUAGE_ZONE_ADMIN ),
                    )
                ),
                array(
                    'name'  => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}recurrence_monthly_days_number",
                    'type'  => 'select',
                    'class' => 'clear recurrence_monthly_days',
                    'multiple'    => false,
                    'options'   => array(
                        'first' => __( 'First', LANGUAGE_ZONE_ADMIN ),
                        'second' => __( 'Second', LANGUAGE_ZONE_ADMIN ),
                        'third' => __( 'Third', LANGUAGE_ZONE_ADMIN ),
                        'fourth' => __( 'Fourth', LANGUAGE_ZONE_ADMIN ),
                        'last' => __( 'Last', LANGUAGE_ZONE_ADMIN ),
                    )
                ),
                array(
                    'name'  => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}recurrence_monthly_days",
                    'type'  => 'select',
                    'class' => 'clear recurrence_monthly_days',
                    'multiple'    => false,
                    'options'   => array(
                        'monday' => __( 'Mon', LANGUAGE_ZONE_ADMIN ),
                        'tuesday' => __( 'Tue', LANGUAGE_ZONE_ADMIN ),
                        'wednesday' => __( 'Wen', LANGUAGE_ZONE_ADMIN ),
                        'thursday' => __( 'Thu', LANGUAGE_ZONE_ADMIN ),
                        'friday' => __( 'Fri', LANGUAGE_ZONE_ADMIN ),
                        'saturday' => __( 'Sat', LANGUAGE_ZONE_ADMIN ),
                        'sunday' => __( 'Sun', LANGUAGE_ZONE_ADMIN ),
                    )
                ),
                array(
                    'name'  => __( 'Each event spans', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}recurrence_days",
                    'class' => 'recurrence_every',
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'number',
                    'min'   => 0,
                    'std'   => 1
                ),
                array(
                    'name'  => __( 'day(s)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}recurrence_null",
                    'class' => 'recurrence_type_label',
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),


                // LOCATION INFO
                array(
                    'type' => 'heading',
                    'name' => __( 'Location', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name'  => __( 'Venue Name', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_venue_name",
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                array(
                    'name'  => __( 'City', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_city",
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                array(
                    'name'  => __( 'Country', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_country",
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                array(
                    'name'  => __( 'Full Address', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_address",
                    'desc'  => __( 'This address won\'t be desplayed. It will be used for the Google Map on the event page. Try to copy the address from Google Maps directly for better position.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                array(
                    'name' => __( 'Show Google Map', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_show_map",
                    'type' => 'checkbox',
                    'std'  => 1,
                ),


                // TICKETS INFO
                array(
                    'type' => 'heading',
                    'name' => __( 'Tickets', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name' => __( 'Enable Tickets', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_enable_tickets",
                    'type' => 'checkbox',
                    'std'  => 1,
                ),
                array(
                    'name'     => __( 'Event Type', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_tickets_type",
                    'type'     => 'select_advanced',
                    'options'  => array(
                        'selling' => __( 'Tickets Available', LANGUAGE_ZONE_ADMIN ),
                        'free' => __( 'Free Entry', LANGUAGE_ZONE_ADMIN ),
                        'cancelled' => __( 'Event Cancelled', LANGUAGE_ZONE_ADMIN ),
                        'soldout' => __( 'Event Sold Out', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'  => __( 'Currency', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_price_currency",
                    'type'  => 'text',
                    'std'   => __( '$', LANGUAGE_ZONE_ADMIN ),
                ),
                array(
                    'name'  => __( 'Tickets Price', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_price",
                    'type'  => 'number',
                    //'std'   => __( '$', LANGUAGE_ZONE_ADMIN ),
                ),

                array(
                    'name'  => __( 'Purchase Site Title (1)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_buy_title_1",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __( 'Purchase URL (1)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_buy_url_1",
                    'type'  => 'url',
                ),

                array(
                    'name'  => __( 'Purchase Site Title (2)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_buy_title_2",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __( 'Purchase URL (2)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_buy_url_2",
                    'type'  => 'url',
                ),

            ),

            'validation' => array(
                'rules' => array(
                    "{$prefix}event_start_date" => array(
                        'required'  => true
                    ),
                    "{$prefix}event_end_date" => array(
                        'required'  => true
                    ),
                )
            )
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}event_info",
            'title'     => __('Event Info', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(EventPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(
                // DATE & TIME INFO
                array(
                    'type' => 'heading',
                    'name' => __( 'Date & Time', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name' => __( 'All Day Event:', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_all_day",
                    'type' => 'checkbox',
                    'class'  => '',
                    'std'  => 0,
                ),
                array(
                    'name' => __( 'Start Date', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_start_date",
                    'type' => 'date',
                    'js_options' => array(
                        'appendText'      => __( '(dd-mm-yyyy)', LANGUAGE_ZONE_ADMIN ),
                        'dateFormat'      => __( 'dd-mm-yy', LANGUAGE_ZONE_ADMIN ),
                        'changeMonth'     => true,
                        'changeYear'      => true,
                        'showButtonPanel' => true,
                    ),
                ),
                array(
                    'name' => __( 'End Date', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_end_date",
                    'type' => 'date',
                    'js_options' => array(
                        'appendText'      => __( '(dd-mm-yyyy)', LANGUAGE_ZONE_ADMIN ),
                        'dateFormat'      => __( 'dd-mm-yy', LANGUAGE_ZONE_ADMIN ),
                        'changeMonth'     => true,
                        'changeYear'      => true,
                        'showButtonPanel' => true,
                    ),
                    //'desc' => __('If the event is recurring, the end date will be used as the recurrence end date.', LANGUAGE_ZONE)
                ),
                array(
                    'name'     => __( 'Start Time', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_start_hour",
                    'type'     => 'select',
                    'class'    => 'event_time_hour',
                    'options'  => array(
                        '01' => __( '01', LANGUAGE_ZONE_ADMIN ),
                        '02' => __( '02', LANGUAGE_ZONE_ADMIN ),
                        '03' => __( '03', LANGUAGE_ZONE_ADMIN ),
                        '04' => __( '04', LANGUAGE_ZONE_ADMIN ),
                        '05' => __( '05', LANGUAGE_ZONE_ADMIN ),
                        '06' => __( '06', LANGUAGE_ZONE_ADMIN ),
                        '07' => __( '07', LANGUAGE_ZONE_ADMIN ),
                        '08' => __( '08', LANGUAGE_ZONE_ADMIN ),
                        '09' => __( '09', LANGUAGE_ZONE_ADMIN ),
                        '10' => __( '10', LANGUAGE_ZONE_ADMIN ),
                        '11' => __( '11', LANGUAGE_ZONE_ADMIN ),
                        '12' => __( '12', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_start_minute",
                    'type'     => 'select',
                    'class'    => 'event_time_minute',
                    'options'  => array(
                        '00' => __( '00', LANGUAGE_ZONE_ADMIN ),
                        '05' => __( '05', LANGUAGE_ZONE_ADMIN ),
                        '10' => __( '10', LANGUAGE_ZONE_ADMIN ),
                        '15' => __( '15', LANGUAGE_ZONE_ADMIN ),
                        '20' => __( '20', LANGUAGE_ZONE_ADMIN ),
                        '25' => __( '25', LANGUAGE_ZONE_ADMIN ),
                        '30' => __( '30', LANGUAGE_ZONE_ADMIN ),
                        '35' => __( '35', LANGUAGE_ZONE_ADMIN ),
                        '40' => __( '40', LANGUAGE_ZONE_ADMIN ),
                        '45' => __( '45', LANGUAGE_ZONE_ADMIN ),
                        '50' => __( '50', LANGUAGE_ZONE_ADMIN ),
                        '55' => __( '55', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_start_am_pm",
                    'type'     => 'select',
                    'class'    => 'event_time_am_pm',
                    'options'  => array(
                        'am' => __( 'AM', LANGUAGE_ZONE_ADMIN ),
                        'pm' => __( 'PM', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( 'End Time', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_end_hour",
                    'type'     => 'select',
                    'class'    => 'event_time_hour',
                    'options'  => array(
                        '01' => __( '01', LANGUAGE_ZONE_ADMIN ),
                        '02' => __( '02', LANGUAGE_ZONE_ADMIN ),
                        '03' => __( '03', LANGUAGE_ZONE_ADMIN ),
                        '04' => __( '04', LANGUAGE_ZONE_ADMIN ),
                        '05' => __( '05', LANGUAGE_ZONE_ADMIN ),
                        '06' => __( '06', LANGUAGE_ZONE_ADMIN ),
                        '07' => __( '07', LANGUAGE_ZONE_ADMIN ),
                        '08' => __( '08', LANGUAGE_ZONE_ADMIN ),
                        '09' => __( '09', LANGUAGE_ZONE_ADMIN ),
                        '10' => __( '10', LANGUAGE_ZONE_ADMIN ),
                        '11' => __( '11', LANGUAGE_ZONE_ADMIN ),
                        '12' => __( '12', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_end_minute",
                    'type'     => 'select',
                    'class'    => 'event_time_minute',
                    'options'  => array(
                        '00' => __( '00', LANGUAGE_ZONE_ADMIN ),
                        '05' => __( '05', LANGUAGE_ZONE_ADMIN ),
                        '10' => __( '10', LANGUAGE_ZONE_ADMIN ),
                        '15' => __( '15', LANGUAGE_ZONE_ADMIN ),
                        '20' => __( '20', LANGUAGE_ZONE_ADMIN ),
                        '25' => __( '25', LANGUAGE_ZONE_ADMIN ),
                        '30' => __( '30', LANGUAGE_ZONE_ADMIN ),
                        '35' => __( '35', LANGUAGE_ZONE_ADMIN ),
                        '40' => __( '40', LANGUAGE_ZONE_ADMIN ),
                        '45' => __( '45', LANGUAGE_ZONE_ADMIN ),
                        '50' => __( '50', LANGUAGE_ZONE_ADMIN ),
                        '55' => __( '55', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( ' ', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_end_am_pm",
                    'type'     => 'select',
                    'class'    => 'event_time_am_pm',
                    'options'  => array(
                        'am' => __( 'AM', LANGUAGE_ZONE_ADMIN ),
                        'pm' => __( 'PM', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),


                // LOCATION INFO
                array(
                    'type' => 'heading',
                    'name' => __( 'Location', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name'  => __( 'Venue Name', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_venue_name",
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                array(
                    'name'  => __( 'City', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_city",
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                array(
                    'name'  => __( 'Country', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_country",
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                array(
                    'name'  => __( 'Full Address', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_address",
                    'desc'  => __( 'This address won\'t be desplayed. It will be used for the Google Map on the event page. Try to copy the address from Google Maps directly for better position.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                array(
                    'name' => __( 'Show Google Map', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_show_map",
                    'type' => 'checkbox',
                    'std'  => 1,
                ),


                // TICKETS INFO
                array(
                    'type' => 'heading',
                    'name' => __( 'Tickets', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name' => __( 'Enable Tickets', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}event_enable_tickets",
                    'type' => 'checkbox',
                    'std'  => 1,
                ),
                array(
                    'name'     => __( 'Event Type', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}event_tickets_type",
                    'type'     => 'select_advanced',
                    'options'  => array(
                        'selling' => __( 'Tickets Available', LANGUAGE_ZONE_ADMIN ),
                        'free' => __( 'Free Entry', LANGUAGE_ZONE_ADMIN ),
                        'cancelled' => __( 'Event Cancelled', LANGUAGE_ZONE_ADMIN ),
                        'soldout' => __( 'Event Sold Out', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'  => __( 'Currency', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_price_currency",
                    'type'  => 'text',
                    'std'   => __( '$', LANGUAGE_ZONE_ADMIN ),
                ),
                array(
                    'name'  => __( 'Tickets Price', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_price",
                    'type'  => 'number',
                    //'std'   => __( '$', LANGUAGE_ZONE_ADMIN ),
                ),

                array(
                    'name'  => __( 'Purchase Site Title (1)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_buy_title_1",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __( 'Purchase URL (1)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_buy_url_1",
                    'type'  => 'url',
                ),

                array(
                    'name'  => __( 'Purchase Site Title (2)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_buy_title_2",
                    'type'  => 'text',
                ),
                array(
                    'name'  => __( 'Purchase URL (2)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}event_buy_url_2",
                    'type'  => 'url',
                ),

            ),

            'validation' => array(
                'rules' => array(
                    "{$prefix}event_start_date" => array(
                        'required'  => true
                    ),
                    "{$prefix}event_end_date" => array(
                        'required'  => true
                    ),
                )
            )
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}song_info",
            'title'     => __('Song Info', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(SongPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(
                // Song Name
                array(
                    'name'  => __( 'Song Title', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}song_name",
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                // Artist Name
                array(
                    'name'  => __( 'Artist Name', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}song_artist_name",
                    'desc'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => __( '', LANGUAGE_ZONE_ADMIN )
                ),
                // HEADING
                array(
                    'type' => 'heading',
                    'name' => __( 'Song Upload / URL', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                // Song Uploader
                array(
                    'name' => __( 'Song Upload', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}song_upload_url",
                    'type' => 'file_advanced',
                    'max_file_uploads' => 1,
                    'mime_type' => 'application,audio,video', // Leave blank for all file types
                    'desc' => __('The file you wish to upload (.mp3 format preferably).', LANGUAGE_ZONE)
                ),
                // Song URL
                array(
                    'name'  => __( 'Song URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}song_url",
                    'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'url',
                    'std'   => '',
                ),
                // HEADING
                array(
                    'type' => 'heading',
                    'name' => __( 'Download/Buy Info', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                // Beatport URL
                array(
                    'name'  => __( 'Beatport URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}beatport_url",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'url',
                    'std'   => '',
                ),
                // iTunes URL
                array(
                    'name'  => __( 'iTunes URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}itunes_url",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'url',
                    'std'   => '',
                ),
                // Soundcloud URL
                array(
                    'name'  => __( 'Soundcloud URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}soundcloud_url",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'url',
                    'std'   => '',
                ),
                // Youtube URL
                array(
                    'name'  => __( 'Youtube URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}youtube_url",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'url',
                    'std'   => '',
                ),
                // HEADING
                array(
                    'type' => 'heading',
                    'name' => __( 'Advanced INFO', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                // Release Date
                array(
                    'name' => __( 'Song Release Date', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}song_release_date",
                    'type' => 'date',
                    'js_options' => array(
                        'appendText'      => __( '(yyyy-mm-dd)', LANGUAGE_ZONE_ADMIN ),
                        'dateFormat'      => __( 'yy-mm-dd', LANGUAGE_ZONE_ADMIN ),
                        'changeMonth'     => true,
                        'changeYear'      => true,
                        'showButtonPanel' => true,
                    ),
                ),
                // Description
                array(
                    'name' => __( 'Description', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}song_description",
                    'type' => 'wysiwyg',
                    'raw'  => false,
                    'std'  => __( '', LANGUAGE_ZONE_ADMIN ),
                    'options' => array(
                        'textarea_rows' => 6,
                        'teeny'         => true,
                        'media_buttons' => false,
                    ),
                ),
            ),
        );

        // Get all songs
        $args = array(
            'post_type' => SongPostType::get_instance()->postType,
            'posts_per_page'    => 9999
        );
        $songs_array = array();
        $songs = get_posts($args);
        foreach($songs as $song) {
            $songs_array[$song->ID] = $song->post_title;
        }

        $meta_boxes[] = array(
            'id'        => "{$prefix}album_info",
            'title'     => __('Album Info', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(AlbumPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(
                array(
                    'name'  => __( 'Artist Name(s)', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}album_artist_name",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => '',
                ),
                // Release Date
                array(
                    'name' => __( 'Album Release Date', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}album_release_date",
                    'type' => 'date',
                    'js_options' => array(
                        'appendText'      => __( '(yyyy-mm-dd)', LANGUAGE_ZONE_ADMIN ),
                        'dateFormat'      => __( 'yy-mm-dd', LANGUAGE_ZONE_ADMIN ),
                        'changeMonth'     => true,
                        'changeYear'      => true,
                        'showButtonPanel' => true,
                    ),
                ),
                array(
                    'name'     => __( 'Rating', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}album_rating",
                    'type'     => 'select_advanced',
                    'options'  => array(
                        '20' => __( '1 Star', LANGUAGE_ZONE_ADMIN ),
                        '40' => __( '2 Stars', LANGUAGE_ZONE_ADMIN ),
                        '60' => __( '3 Stars', LANGUAGE_ZONE_ADMIN ),
                        '80' => __( '4 Stars', LANGUAGE_ZONE_ADMIN ),
                        '100' => __( '5 Stars', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                array(
                    'name'     => __( 'Single Template', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}album_template",
                    'type'     => 'select_advanced',
                    'options'  => array(
                        'one' => __( 'Style 1', LANGUAGE_ZONE_ADMIN ),
                        'two' => __( 'Style 2', LANGUAGE_ZONE_ADMIN ),
                        'two-sidebar' => __( 'Style 2 without sidebar', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'multiple'    => false,
                    //'placeholder' => __( 'Select an Item', 'rwmb' ),
                ),
                // HEADING
                array(
                    'type' => 'heading',
                    'name' => __( 'Songs', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                // CHECKBOX LIST
                array(
                    'name' => __( 'Choose Songs', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}album_songs",
                    'type' => 'checkbox_list',
                    'options' => $songs_array,
                ),
                // HEADING
                array(
                    'type' => 'heading',
                    'name' => __( 'Download/Buy Info', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),

                array(
                    'name'  => __( 'Field Name', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}album_field_1_name",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => '',
                ),
                array(
                    'name'  => __( 'Field URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}album_field_1_url",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'url',
                    'std'   => '',
                ),
                // DIVIDER
                array(
                    'type' => 'divider',
                    'id'   => 'fake_divider_id', // Not used, but needed
                ),

                array(
                    'name'  => __( 'Field Name', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}album_field_2_name",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => '',
                ),
                array(
                    'name'  => __( 'Field URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}album_field_2_url",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'url',
                    'std'   => '',
                ),
                // DIVIDER
                array(
                    'type' => 'divider',
                    'id'   => 'fake_divider_id', // Not used, but needed
                ),

                array(
                    'name'  => __( 'Field Name', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}album_field_3_name",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => '',
                ),
                array(
                    'name'  => __( 'Field URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}album_field_3_url",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'url',
                    'std'   => '',
                ),
                // DIVIDER
                array(
                    'type' => 'divider',
                    'id'   => 'fake_divider_id', // Not used, but needed
                ),

                array(
                    'name'  => __( 'Field Name', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}album_field_4_name",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'text',
                    'std'   => '',
                ),
                array(
                    'name'  => __( 'Field URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}album_field_4_url",
                    //'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used.', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'url',
                    'std'   => '',
                ),
            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}post_options",
            'title'     => __('Post Options', LANGUAGE_ZONE_ADMIN),

            'fields'    => array(
                array(
                    'name' => __( 'Show featured image on single page:', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}hide_featured_image",
                    'type' => 'checkbox',
                    'std'  => 1,
                ),

                array(
                    'type' => 'heading',
                    'name' => __( 'Post preview style', 'rwmb' ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),

                array(
                    'name' => __( 'Video/Audio post preview:', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}video_preview_style",
                    'type' => 'radio',
                    'options' => array(
                        '' => __( 'video/audio', LANGUAGE_ZONE_ADMIN ),
                        'featured' => __( 'featured image', LANGUAGE_ZONE_ADMIN ),
                    ),
                    'std'  => '',
                    'desc' => __( 'This will influence how the video or audio post will show up.' , LANGUAGE_ZONE_ADMIN),
                ),

            ),
        );

        // GET BLOG CATs
        $blog_cat = array();
        $cats = get_terms( 'category', 'orderby=count');
        foreach($cats as $cat) {
            $blog_cat[$cat->term_id] = $cat->name;
        }
        $meta_boxes[] = array(
            'id'        => "{$prefix}blog_options",
            'title'     => __('Blog Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'low',
            'show'      => array(
            	'relation' => 'OR',
            	'template' => array( 'template-blog-1.php', 'template-blog-1-no-sidebar.php', 'template-blog-2.php', 'template-blog-3.php' ),
            ),
            'fields'    => array(

                array(
                    'name'  => __( 'Posts per Page:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}posts_per_page",
                    'type'  => 'number',
                    'desc'  => 'How many posts you want to display on a single page?',
                    'std'   => '5'
                ),

                array(
                    'name'  => __( 'Categories:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}category",
                    'type'  => 'checkbox_list',
                    //'multiple'    => true,
                    'options'   => $blog_cat
                ),

                /*array(
                    'name'  => __( 'Authors:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}author",
                    'type'  => 'text',
                    'desc'  => 'The categories ids, separated with commas (,). By default, it will display posts from all authors.'
                ),*/

                array(
                    'name'     => __( 'Order by', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}order_by",
                    'type'     => 'select',
                    // Array of 'value' => 'Label' pairs for select box
                    'options'  => array(
                        'date'      => __( 'Date', LANGUAGE_ZONE ),
                        'name'      => __( 'Name', LANGUAGE_ZONE ),
                        'author'    => __( 'Author', LANGUAGE_ZONE ),
                        'ID'        => __( 'ID', LANGUAGE_ZONE ),
                        'rand'      => __( 'Random', LANGUAGE_ZONE ),
                        'title'     => __( 'Title', LANGUAGE_ZONE ),
                    ),
                    // Select multiple values, optional. Default is false.
                    'multiple'    => false,
                    'std'         => 'date',
                ),

                array(
                    'name' => __( 'Order', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}order",
                    'type' => 'select',
                    'options' => array(
                        'DESC' => __( 'DESC', LANGUAGE_ZONE ),
                        'ASC' => __( 'ASC', LANGUAGE_ZONE ),
                    ),
                ),

                /*array(
                    'type' => 'divider',
                    'id'   => 'fake_divider_id', // Not used, but needed
                ),

                array(
                    'name' => __( 'Animation', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}anim",
                    'type' => 'select',
                    'options' => array(
                        ''                              => __("None", LANGUAGE_ZONE_ADMIN),
                        'element_from_top'              => __("From Top", LANGUAGE_ZONE_ADMIN),
                        'element_from_bottom'           => __("From Bottom", LANGUAGE_ZONE_ADMIN),
                        'element_from_left'             => __("From Left", LANGUAGE_ZONE_ADMIN),
                        'element_from_right'            => __("From Right", LANGUAGE_ZONE_ADMIN),
                        'element_fade_in'               => __("Fade-In", LANGUAGE_ZONE_ADMIN),
                    ),
                ),*/

            ),
        );

        // GET Album Genres
        $genres = get_terms( AlbumPostType::get_instance()->postTypeTax, 'orderby=count');
        $g_array = array();
        foreach($genres as $g) {
            $g_array[$g->term_id] = $g->name;
        }
        $meta_boxes[] = array(
            'id'        => "{$prefix}albums_listing_options",
            'title'     => __('Albums Listing Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'low',
            'show'      => array(
            	'relation' => 'OR',
            	'template' => array( 'template-albums-1.php', 'template-albums-2.php', 'template-albums-3.php' ),
            ),

            'fields'    => array(

                array(
                    'name'  => __( 'Albums per Page:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}albums_posts_per_page",
                    'type'  => 'number',
                    'desc'  => 'How many posts you want to display on a single page?',
                    'std'   => '5'
                ),

                // RANGE
                array(
                    'name'  => __( 'Albums Columns', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}albums_columns",
                    //'desc'  => __( 'Range description', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'range',
                    'min'   => 2,
                    'max'   => 4,
                    'step'  => 1,
                    'std'   => 4,
                ),

                array(
                    'name'  => __( 'Categories:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}albums_category",
                    'type'  => 'checkbox_list',
                    //'multiple'    => true,
                    'options'   => $g_array
                ),

                array(
                    'name'     => __( 'Order by', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}albums_order_by",
                    'type'     => 'select',
                    // Array of 'value' => 'Label' pairs for select box
                    'options'  => array(
                        'date'      => __( 'Date', LANGUAGE_ZONE ),
                        'name'      => __( 'Name', LANGUAGE_ZONE ),
                        'author'    => __( 'Author', LANGUAGE_ZONE ),
                        'ID'        => __( 'ID', LANGUAGE_ZONE ),
                        'rand'      => __( 'Random', LANGUAGE_ZONE ),
                        'title'     => __( 'Title', LANGUAGE_ZONE ),
                    ),
                    // Select multiple values, optional. Default is false.
                    'multiple'    => false,
                    'std'         => 'date',
                ),

                array(
                    'name' => __( 'Order', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}albums_order",
                    'type' => 'select',
                    'options' => array(
                        'DESC' => __( 'DESC', LANGUAGE_ZONE ),
                        'ASC' => __( 'ASC', LANGUAGE_ZONE ),
                    ),
                ),

                /*array(
                    'name' => __( 'Animation', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}anim",
                    'type' => 'select',
                    'options' => array(
                        ''                              => __("None", LANGUAGE_ZONE_ADMIN),
                        'element_from_top'              => __("From Top", LANGUAGE_ZONE_ADMIN),
                        'element_from_bottom'           => __("From Bottom", LANGUAGE_ZONE_ADMIN),
                        'element_from_left'             => __("From Left", LANGUAGE_ZONE_ADMIN),
                        'element_from_right'            => __("From Right", LANGUAGE_ZONE_ADMIN),
                        'element_fade_in'               => __("Fade-In", LANGUAGE_ZONE_ADMIN),
                    ),
                ),*/

            ),
        );

        // GET Events Categories
        $genres = get_terms( EventPostType::get_instance()->postTypeTax, 'orderby=count');
        $g_array = array();
        foreach($genres as $g) {
            $g_array[$g->term_id] = $g->name;
        }
        $meta_boxes[] = array(
            'id'        => "{$prefix}events_listing_options",
            'title'     => __('Events Listing Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'low',
            'show'      => array(
            	'relation' => 'OR',
            	'template' => array( 'template-events-1.php', 'template-events-1-2.php', 'template-events-2.php', 'template-events-3.php' ),
            ),

            'fields'    => array(

                array(
                    'name'  => __( 'Events per Page:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}events_posts_per_page",
                    'type'  => 'number',
                    'desc'  => 'How many events you want to display on a single page?',
                    'std'   => '5'
                ),

                array(
                    'name'  => __( 'Show past events?', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}hide_past_events",
                    'type'  => 'checkbox',
                    'desc'  => 'Check this box if you want the past events from the query to be shown.'
                ),

                array(
                    'name'  => __( 'Categories:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}events_category",
                    'type'  => 'checkbox_list',
                    //'multiple'    => true,
                    'options'   => $g_array
                ),

            ),
        );

        // GET Album Genres
        $genres = get_terms( ArtistPostType::get_instance()->postTypeTax, 'orderby=count');
        $g_array = array();
        foreach($genres as $g) {
            $g_array[$g->term_id] = $g->name;
        }
        $meta_boxes[] = array(
            'id'        => "{$prefix}artist_listing_options",
            'title'     => __('Artists Listing Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'low',
            'show'      => array(
            	'relation' => 'OR',
            	'template' => array( 'template-artists.php' ),
            ),

            'fields'    => array(

                array(
                    'name'  => __( 'Artists per Page:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}artists_posts_per_page",
                    'type'  => 'number',
                    'desc'  => 'How many posts you want to display on a single page?',
                    'std'   => '5'
                ),

                // RANGE
                array(
                    'name'  => __( 'Artists Columns', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}artists_columns",
                    //'desc'  => __( 'Range description', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'range',
                    'min'   => 2,
                    'max'   => 4,
                    'step'  => 1,
                    'std'   => 4,
                ),

                array(
                    'name'  => __( 'Categories:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}artists_category",
                    'type'  => 'checkbox_list',
                    //'multiple'    => true,
                    'options'   => $g_array
                ),

                array(
                    'name'     => __( 'Order by', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}artists_order_by",
                    'type'     => 'select',
                    // Array of 'value' => 'Label' pairs for select box
                    'options'  => array(
                        'date'      => __( 'Date', LANGUAGE_ZONE ),
                        'name'      => __( 'Name', LANGUAGE_ZONE ),
                        'author'    => __( 'Author', LANGUAGE_ZONE ),
                        'ID'        => __( 'ID', LANGUAGE_ZONE ),
                        'rand'      => __( 'Random', LANGUAGE_ZONE ),
                        'title'     => __( 'Title', LANGUAGE_ZONE ),
                    ),
                    // Select multiple values, optional. Default is false.
                    'multiple'    => false,
                    'std'         => 'date',
                ),

                array(
                    'name' => __( 'Order', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}artists_order",
                    'type' => 'select',
                    'options' => array(
                        'DESC' => __( 'DESC', LANGUAGE_ZONE ),
                        'ASC' => __( 'ASC', LANGUAGE_ZONE ),
                    ),
                ),

            ),
        );

        // Get all events
        $args = array(
            'post_type' => EventPostType::get_instance()->postType,
            'posts_per_page'    => 999
        );
        $events = get_posts($args);
        foreach($events as $event) {
            $events_array[$event->ID] = $event->post_title;
        }
        // Get all albums
        $args = array(
            'post_type' => AlbumPostType::get_instance()->postType,
            'posts_per_page'    => 999
        );

        $albums = get_posts($args);
        foreach($albums as $album) {
            $albums_array[$album->ID] = $album->post_title;
        }
        $meta_boxes[] = array(
            'id'        => "{$prefix}artist_info",
            'title'     => __('Artist Info', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(ArtistPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'low',

            'fields'    => array(

                array(
                    'type' => 'heading',
                    'name' => __( 'Basic Info', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name' => __( 'Social Media Icons', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}artist_social",
                    'type' => 'textarea',
                    'raw'  => false,
                    'std'  => __( '[clx_isocial href="" target="_blank" icon=""]', LANGUAGE_ZONE_ADMIN ),
                    'options' => array(
                        'textarea_rows' => 6,
                        'teeny'         => true,
                        'media_buttons' => false,
                    ),
                ),

                array(
                    'type' => 'heading',
                    'name' => __( 'Featured Songs', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name' => __( 'Choose Featured Songs', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}artist_songs",
                    'type' => 'checkbox_list',
                    'options' => $songs_array,
                ),

                array(
                    'type' => 'heading',
                    'name' => __( 'Events', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name' => __( 'Choose Events', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}artist_events",
                    'type' => 'checkbox_list',
                    'options' => $events_array,
                ),

                array(
                    'type' => 'heading',
                    'name' => __( 'Albums', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name' => __( 'Choose Albums', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}artist_albums",
                    'type' => 'checkbox_list',
                    'options' => $albums_array,
                ),

            ),
        );


        $meta_boxes[] = array(
            'id'        => "{$prefix}gallery",
            'title'     => __('Add/Edit Photos', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(PhotoPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(
                // RANGE
                array(
                    'name'  => __( 'Photo Galleries Columns', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}pgallery_columns",
                    //'desc'  => __( 'Range description', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'range',
                    'min'   => 2,
                    'max'   => 4,
                    'step'  => 1,
                    'std'   => 4,
                ),
                array(
                    'id'            => "{$prefix}photo_gallery",
                    'type'          => 'image_advanced',
                    'max_file_uploads' => 999
                ),

            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}vgallery",
            'title'     => __('Add/Edit Videos', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(VideoPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(
                // RANGE
                array(
                    'name'  => __( 'Photo Galleries Columns', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}vgallery_columns",
                    //'desc'  => __( 'Range description', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'range',
                    'min'   => 2,
                    'max'   => 4,
                    'step'  => 1,
                    'std'   => 4,
                ),
                array(
                    'id'            => "{$prefix}video_gallery",
                    'type'          => 'image_advanced',
                    'max_file_uploads' => 999
                ),

            ),
        );

        // GET Album Genres
        $genres1 = get_terms( PhotoPostType::get_instance()->postTypeTax, 'orderby=count');
        $g_array = array();
        if(!empty($genres1)) {
            foreach($genres1 as $g) {
                $g_array[$g->term_id] = $g->name;
            }
        }
        $meta_boxes[] = array(
            'id'        => "{$prefix}pgallery_listing_options",
            'title'     => __('Photo Galleries Listing Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'low',
            'show'      => array(
            	'relation' => 'OR',
            	'template' => array( 'template-photo-gallery.php' ),
            ),

            'fields'    => array(

                array(
                    'name'  => __( 'Photo Galleries per Page:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}pgallery_posts_per_page",
                    'type'  => 'number',
                    'desc'  => 'How many posts you want to display on a single page?',
                    'std'   => '5'
                ),

                // RANGE
                array(
                    'name'  => __( 'Photo Galleries Columns', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}pgallery_columns",
                    //'desc'  => __( 'Range description', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'range',
                    'min'   => 2,
                    'max'   => 4,
                    'step'  => 1,
                    'std'   => 4,
                ),

                array(
                    'name'  => __( 'Categories:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}pgallery_category",
                    'type'  => 'checkbox_list',
                    //'multiple'    => true,
                    'options'   => $g_array
                ),

                array(
                    'name'     => __( 'Order by', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}pgallery_order_by",
                    'type'     => 'select',
                    // Array of 'value' => 'Label' pairs for select box
                    'options'  => array(
                        'date'      => __( 'Date', LANGUAGE_ZONE ),
                        'name'      => __( 'Name', LANGUAGE_ZONE ),
                        'author'    => __( 'Author', LANGUAGE_ZONE ),
                        'ID'        => __( 'ID', LANGUAGE_ZONE ),
                        'rand'      => __( 'Random', LANGUAGE_ZONE ),
                        'title'     => __( 'Title', LANGUAGE_ZONE ),
                    ),
                    // Select multiple values, optional. Default is false.
                    'multiple'    => false,
                    'std'         => 'date',
                ),

                array(
                    'name' => __( 'Order', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}pgallery_order",
                    'type' => 'select',
                    'options' => array(
                        'DESC' => __( 'DESC', LANGUAGE_ZONE ),
                        'ASC' => __( 'ASC', LANGUAGE_ZONE ),
                    ),
                ),
            ),
        );

        // GET Album Genres
        $genres1 = get_terms( VideoPostType::get_instance()->postTypeTax, 'orderby=count');
        $g_array1 = array();
        if(!empty($genres1)) {
            foreach($genres1 as $g) {
                $g_array1[$g->term_id] = $g->name;
            }
        }
        $meta_boxes[] = array(
            'id'        => "{$prefix}vgallery_listing_options",
            'title'     => __('Video Galleries Listing Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'low',
            'show'      => array(
            	'relation' => 'OR',
            	'template' => array( 'template-video-gallery.php' ),
            ),

            'fields'    => array(

                array(
                    'name'  => __( 'Video Galleries per Page:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}vgallery_posts_per_page",
                    'type'  => 'number',
                    'desc'  => 'How many posts you want to display on a single page?',
                    'std'   => '5'
                ),

                // RANGE
                array(
                    'name'  => __( 'Video Galleries Columns', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}vgallery_columns",
                    //'desc'  => __( 'Range description', LANGUAGE_ZONE_ADMIN ),
                    'type'  => 'range',
                    'min'   => 2,
                    'max'   => 4,
                    'step'  => 1,
                    'std'   => 4,
                ),

                array(
                    'name'  => __( 'Categories:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}vgallery_category",
                    'type'  => 'checkbox_list',
                    //'multiple'    => true,
                    'options'   => $g_array1
                ),

                array(
                    'name'     => __( 'Order by', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}vgallery_order_by",
                    'type'     => 'select',
                    // Array of 'value' => 'Label' pairs for select box
                    'options'  => array(
                        'date'      => __( 'Date', LANGUAGE_ZONE ),
                        'name'      => __( 'Name', LANGUAGE_ZONE ),
                        'author'    => __( 'Author', LANGUAGE_ZONE ),
                        'ID'        => __( 'ID', LANGUAGE_ZONE ),
                        'rand'      => __( 'Random', LANGUAGE_ZONE ),
                        'title'     => __( 'Title', LANGUAGE_ZONE ),
                    ),
                    // Select multiple values, optional. Default is false.
                    'multiple'    => false,
                    'std'         => 'date',
                ),

                array(
                    'name' => __( 'Order', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}vgallery_order",
                    'type' => 'select',
                    'options' => array(
                        'DESC' => __( 'DESC', LANGUAGE_ZONE ),
                        'ASC' => __( 'ASC', LANGUAGE_ZONE ),
                    ),
                ),
            ),
        );

        return $meta_boxes;
    }

}

Haze_Meta_Boxes::get_instance();