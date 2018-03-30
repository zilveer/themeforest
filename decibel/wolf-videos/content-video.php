<?php
/**
 * The galleries loop
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$layout = ( wolf_get_theme_option( 'video_type' ) ) ? wolf_get_theme_option( 'video_type' ) : 'grid';

wolf_videos_get_template_part( 'content', 'video-' . wolf_get_theme_option( 'video_type' ) );