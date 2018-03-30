<?php 
global $mk_options;

if ($view_params['header_style'] == 3) return false;

if(isset($mk_options['hide_header_nav']) && $mk_options['hide_header_nav'] == 'false') return false;

?>

<div class="mk-nav-responsive-link">
    <div class="mk-css-icon-menu">
        <div class="mk-css-icon-menu-line-1"></div>
        <div class="mk-css-icon-menu-line-2"></div>
        <div class="mk-css-icon-menu-line-3"></div>
    </div>
</div>