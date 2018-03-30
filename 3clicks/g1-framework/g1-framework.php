<?php
/**
 * This file is part of the G1_Framework package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Config
 * @since G1_Config 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

global $pagenow;
$g1_dir = trailingslashit( dirname(__FILE__) );


// Require core files
require_once( $g1_dir . 'lib/core.php' );
require_once( $g1_dir . 'lib/core-tools.php' );

// Redux config
define('Redux_OPTIONS_URL', trailingslashit(get_template_directory_uri()) . 'g1-framework/options/');
define('Redux_TEXT_DOMAIN', 'g1_theme');

function get_redux_opts_sections_filter_name () {
    return 'redux-opts-sections-3clicks';
}

// load only in admin
if ( is_admin() || isset($_GET['feed'])) {
    require_once( $g1_dir . 'options.php' );
}

if ( !is_admin() ) {
    require_once( $g1_dir . 'lib/template-tags.php' );
}

require_once( $g1_dir . 'lib/form-controls.php' );

if ( is_admin() && ( 'post.php' === $pagenow || 'post-new.php' === $pagenow ) ) {
    require_once( $g1_dir . 'lib/post-meta-manager.php' );
}

require_once( $g1_dir . 'lib/features.php' );

require_once( $g1_dir . 'lib/elements.php' );

require_once( $g1_dir . 'lib/style.php' );

require_once( $g1_dir . 'lib/theme.php' );

require_once( $g1_dir . 'lib/theme-activation.php' );

if ( is_admin() && ( $pagenow === 'term.php' || $pagenow === 'edit-tags.php')  ) { // term.php is required since WP 4.5
    require_once( $g1_dir . 'lib/term-meta-manager.php' );
}

require_once( $g1_dir . 'lib/shortcodes.php' );

if ( is_admin() && ( 'post.php' === $pagenow || 'post-new.php' === $pagenow ) ) {
    require_once( $g1_dir . 'lib/shortcode-generator.php' );
}

require_once( $g1_dir . 'lib/fonts.php' );

require_once( $g1_dir . 'lib/aq_resizer.php' );

require_once( $g1_dir . 'lib/theme-updater/theme-updater.php' );