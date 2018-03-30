<?php
/**
 * The galleries loop
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wolf_albums_get_template_part( 'content', 'gallery-' . wolf_get_theme_option( 'gallery_type' ) );