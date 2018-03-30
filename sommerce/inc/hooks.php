<?php
/**
 * All hooks for the theme.
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */

add_filter( 'document_title_separator' , create_function( '', 'return "|";' ) );