<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
$header_style_option = dfd_get_header_style_option();
if (isset($dfd_ronneby['show_search_form_header_'.$header_style_option]) && strcmp($dfd_ronneby['show_search_form_header_'.$header_style_option],'1') === 0) : ?>
	<div class="form-search-wrap">
		<a href="#" class="header-search-switcher dfd-icon-zoom"></a>
	</div>
<?php endif; ?>
