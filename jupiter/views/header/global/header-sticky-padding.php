<?php 
if($view_params['is_shortcode']) return false;

$sticky_style = isset($mk_options['header_sticky_style']) ? $mk_options['header_sticky_style'] : 'fixed';

if ($sticky_style == 'false' || is_header_transparent()) return false;

?>
<div class="mk-header-padding-wrapper"></div>
