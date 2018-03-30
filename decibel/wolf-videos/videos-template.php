<?php
/**
 * The Template for displaying the main videos page
 *
 * Override this template by copying it to yourtheme/wolf-videos/videos-template.php
 *
 * @author WolfThemes
 * @package WolfVideos/Templates
 * @since 1.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wolf_videos_get_template_part( 'videos', 'template-' . wolf_get_theme_option( 'video_type' ) );