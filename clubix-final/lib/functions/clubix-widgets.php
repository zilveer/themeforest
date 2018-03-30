<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


class Clx_Widgets {

    protected static $instance = null;

    private function __construct() {

        // Require the widgets files
        require_once(THEMEDIR.'/lib/functions/widgets/clx_next_event.php');
        require_once(THEMEDIR.'/lib/functions/widgets/clx_upcoming_events.php');
        require_once(THEMEDIR.'/lib/functions/widgets/clx_featured_album.php');
        require_once(THEMEDIR.'/lib/functions/widgets/clx_player.php');
        require_once(THEMEDIR.'/lib/functions/widgets/clx_random_album.php');
        require_once(THEMEDIR.'/lib/functions/widgets/clx_top_rated_albums.php');

        // Init the widgets
        add_action( 'widgets_init', array( &$this, 'register_widgets' ));

    }

    // register widgets
    public function register_widgets() {
        register_widget( 'Clx_Next_Event_Widget' );
        register_widget( 'Clx_Upcoming_Events_Widget' );
        register_widget( 'Clx_Featured_Album_Widget' );
        register_widget( 'Clx_Player_Widget' );
        register_widget( 'Clx_Random_Album_Widget' );
        register_widget( 'Clx_Top_Rated_Albums_Widget' );
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object  A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}

Clx_Widgets::get_instance();