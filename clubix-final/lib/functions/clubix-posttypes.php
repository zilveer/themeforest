<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


class Haze_PostTypes {

    protected $prefix = 'haze_post_types_';

    protected static $instance = null;

    private function __construct() {

        // Song Post Type
        require_once(THEMEDIR.'/lib/functions/posttypes/song.php');

        // Album Post Type
        require_once(THEMEDIR.'/lib/functions/posttypes/album.php');

        // Event Post Type
        require_once(THEMEDIR.'/lib/functions/posttypes/event.php');
        require_once(THEMEDIR.'/lib/functions/posttypes/event-recurring.php');

        // Artist Post Type
        require_once(THEMEDIR.'/lib/functions/posttypes/artist.php');

        // Photo Categories
        require_once(THEMEDIR.'/lib/functions/posttypes/photo.php');

        // Video Categories
        require_once(THEMEDIR.'/lib/functions/posttypes/video.php');

        // Employee Post Type
        //require_once('posttypes/employee.php');

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

Haze_PostTypes::get_instance();