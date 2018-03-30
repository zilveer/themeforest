<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/UBERMENU.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Filter Menu for UberMenu Integration
//   02. Define Package name for UberMenu integration
//   03. Define notice to show in place of the standard UberMenu update notice
//	 04. Define notice to show in the help tab with a link to support article
//	 05. Define link to X Support
// =============================================================================

// Theme Setup
// =============================================================================

add_filter( 'ubermenu_settings_defaults', 'x_ubermenu_settings_default', 20, 1 );

function x_ubermenu_settings_default($defaults) {
	$defaults['ubermenu_main']['auto_theme_location'] = array( 'primary' => 'primary' );
		return $defaults;
}

// Define package name for UberMenu integration
// =============================================================================

define('UBERMENU_PACKAGED_THEME', 'X Theme' );

// Define notice to show in place of default updates notice, shows on the updates screen
// =============================================================================

define('UBERMENU_PACKAGED_THEME_UPDATES_NOTICE', 'Purchase not required. Your license of UberMenu is included with your X license purchase. If your X license is validated (<a href="https://community.theme.co/kb/product-validation/">explained here</a>), your copy of UberMenu will be validated as well including updates as they are made available and support directly from Themeco. <a href="https://community.theme.co/kb/integrated-plugins-ubermenu/">Find out more in this article</a>.');

// Define notice to show in the help tab linking to support article
// =============================================================================

define('UBERMENU_PACKAGED_THEME_SUPPORT_NOTICE', 'Purchase not required. Your license of UberMenu is included with your X license purchase. If your X license is validated (<a href="https://community.theme.co/kb/product-validation/">explained here</a>), your copy of UberMenu will be validated as well including updates as they are made available and support directly from Themeco. <a href="https://community.theme.co/kb/integrated-plugins-ubermenu/">Find out more in this article</a>.');

// Define link to X support
// =============================================================================

define('UBERMENU_PACKAGED_THEME_SUPPORT_LINK', '<a class="button button-primary" href="http://community.theme.co/" target="_blank">Visit X Support</a>' );
