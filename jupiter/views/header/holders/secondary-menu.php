<?php

/**
 * template part for header style 3 navigation. views/header/holders
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;

$style = !empty($mk_options['secondary_menu']) ? $mk_options['secondary_menu'] : 'fullscreen';

$seondary_header_for_all = !empty($mk_options['seondary_header_for_all']) ? $mk_options['seondary_header_for_all'] : 'false';

// Disable when seconday menu style is false and header style is not 3. So basically user can not disable this module if header style 3 is chosen.
if ($seondary_header_for_all == 'false' && get_header_style() != 3  && $view_params['header_shortcode_style'] != 3) return false;

    
if ($style == 'dashboard') {
    
    mk_get_header_view('master', 'side-dashboard');
} 
else if ($style == 'fullscreen') {
    
    mk_get_header_view('master', 'full-screen-nav');
}
