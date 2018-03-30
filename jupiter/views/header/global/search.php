<?php

/**
 * template part for search in header and header toolbar. views/header/global
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;

if ($mk_options['header_search_location'] != $view_params['location']) return false; ?>

<div class="mk-header-search">
    <form class="mk-header-searchform" method="get" id="mk-header-searchform" action="<?php echo home_url('/'); ?>">
        <span>
        	<input type="text" class="text-input on-close-state" value="" name="s" id="s" placeholder="<?php _e('Search..', 'mk_framework'); ?>" />
        	<i class="mk-searchform-icon"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-icon-search'); ?><input value="" type="submit" class="header-search-btn" /></i>
        </span>
    </form>
</div>
