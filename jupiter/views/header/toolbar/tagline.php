<?php

/**
 * template part for header toolbar tagline. views/header/toolbar
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;

if (!empty($mk_options['header_toolbar_tagline'])) {

	echo '<span class="mk-header-tagline">' . stripslashes($mk_options['header_toolbar_tagline']) . '</span>';

}

