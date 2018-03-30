<?php

#
# This file performs initial environment setup.
#

// ensure EXT is defined
if ( ! defined( 'EXT' ) ) {
	define( 'EXT', '.php' );
}

do_action('before_wpgrade_core');

$basepath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

//require $basepath . 'wpgrade' . EXT;
get_template_part( 'wpgrade-core/wpgrade' );

// Dynamically load in all classes
// -------------------------------

# Loading convention: if it's a PHP file it's loaded, the shorter the path
# the higher the priority

$classpath = $basepath . 'classes' . DIRECTORY_SEPARATOR;
wpgrade::require_all( $classpath );

// Setup Option Drivers
// --------------------

if ( wpgrade::confoption('wpml_separate_options', false ) ) {
	$wpgrade_redux = new wpGrade_Redux();
}

// the handler is the main object responsible for managing the drivers
wpgrade::options_handler( new WPGradeOptions() );

# [!!] driver priority works like a LIFO stack, last in = highest priority

// register basic configuration driver
$config = wpgrade::config();
wpgrade::options()->add_optiondriver( new WPGradeOptionDriver_Config( $config['theme-options'] ) );

// we register redux as option driver via a resolver

function wpgrade_callback_bootstrap_redux_instance( $redux ) {
	$reduxdriver = new WPGradeOptionDriver_Redux( $redux );
	wpgrade::options()->add_optiondriver( $reduxdriver );
}

wpgrade::register_resolver( 'redux-instance', 'wpgrade_callback_bootstrap_redux_instance' );


// Plugins & Resolvable Dependencies
// ---------------------------------
require wpgrade::themefilepath( wpgrade::confoption( 'theme-adminpanel-path', 'theme-content/admin-panel' ) . '/bootstrap' . EXT );


// Hooks
// -----
get_template_part( 'wpgrade-core/hooks' );


do_action('after_wpgrade_core');
