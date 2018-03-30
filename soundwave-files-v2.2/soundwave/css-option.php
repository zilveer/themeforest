<?php
header("Content-type: text/css; charset: UTF-8");
$uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $uri[0] . 'wp-load.php' );

$patterns_style = of_get_option('patterns');
$image_style    = of_get_option('background_upload');
$type           = of_get_option('type_background');
$fixed          = of_get_option('background_position');
$font           = of_get_option('font_pred');
$color          = of_get_option('color_wize');

switch ($type) {
    case "pattern":
        echo '
body {
    background: url("images/patterns/' . $patterns_style . '.png");
                       ' . $fixed . '
}';
        break;     
}

echo '
body, h1, h2, h3, h4, h5, h6 {
    font-family: "' . $font . '", sans-serif;
}';

echo '
a,
h2.bl1shr-title a:hover,
h2.bl2page-title a:hover,
h2.bl2shr-title a:hover,
h2.ev2shr-title a:hover,
h2.ev2page-title a:hover,
h2.ev3page-title a:hover,
h2.bl1page-title a:hover,
.ev1shr-title a:hover,
.ev1page-title a:hover,
.adwdg-title a:hover,
.ev2shr-col:hover .ev2shr-week,
.ev2page-col:hover .ev2page-week,
.ev3page:hover .ev3page-week,
.evftr-week,
.evwdg-title a:hover,
.textwidget a:hover,
.widget_recent_comments ul li a:hover,
.blwdg-text a:hover,
p.bl1shr-comment a:hover,
p.bl1page-comment a:hover,
p.bl2page-comment a:hover,
#fap-current-meta a,
#footer .tweets_list li a:hover,
#footer .widget_links li a,
#footer .widget_pages li a,
#footer .widget_recent_entries li a,
#footer .widget_archive li a,
#footer .widget_nav_menu li a,
#footer .textwidget a:hover,
#footer .widget_recent_comments ul li a:hover,
#footer .blwdg a:hover {
    color:#' . $color . ';
}

.tagcloud a,
.widget-audio-buy a,
.evwdg-tickets a,
.ev2shr-tickets a,
.reply a,
.bl1page-more a,
.ev2page-tickets a,
.ev3page-tickets a,
.adsng-buy a,
.evsng-tickets a,
.button-send#submitmail,
.pagination span, .pagination a,
.highlight,
.button-link a,
p.form-submit input#submit,
div.jp-volume-bar-value,
ul.tabs li a,
#fap-progress-bar,
#fap-volume-progress,
#wizemenu > ul > li:hover > a,
#search-button,
#wp-calendar tbody td:hover,
#wizemenu > ul > li > a:active,
#wizemenu > ul ul li a:hover {
    background:#' . $color . ';
}

#mxpage-media ul.fap-my-playlist li.play a:hover {
    background:#' . $color . ' url("images/mix-play.png") no-repeat left ;
}

#mxpage-media .shop:hover {
    background:#' . $color . ' url("images/mix-shop.png") no-repeat left ;
}

.wz-last:hover .adshr-info,
.wz-last:hover .vdshr-info,
.wz-last:hover .phshr-info,
.wz-last:hover .adpage-info,
.wz-last:hover .phpage-info,
.wz-last:hover .vdpage-info,
.vdwdg:hover .vdwdg-info,
.evftr-date:hover {
    border-bottom:3px solid #' . $color . ';
}

#footer-bottom {
    border-top:3px solid #' . $color . ';
}

ul.fap-my-playlist li:hover, 
ul.fap-my-playlist li.selected {
    border-left:3px solid #' . $color . ';
}';

echo '
.flex-title-large,
.flex-title-small {
    background: url("images/slider/trans' . $color . '.png");
}

.wz-hover .bg {
    background: url("images/hover/' . $color . '.png");
}

#fap-ui-nav #fap-previous { background: url("images/player/' . $color . '.png") 0 -72px no-repeat; left: -2px; }

#fap-ui-nav #fap-next { background: url("images/player/' . $color . '.png") 0 -41px no-repeat; left: 52px; }

#fap-ui-nav .fap-play { background: url("images/player/' . $color . '.png") 0 0 no-repeat }

#fap-ui-nav .fap-pause { background: url("images/player/' . $color . '.png") -41px -103px no-repeat }

a.jp-play { background: url("images/player/' . $color . '.png") 0 0 no-repeat }

a.jp-pause { background: url("images/player/' . $color . '.png") -41px -103px no-repeat; display: none; }

a.jp-repeat { background: url("images/player/' . $color . '.png") -62px -72px no-repeat }

a.jp-repeat-off { background: url("images/player/' . $color . '.png") -93px -72px no-repeat }

a.jp-stop { background: url("images/player/' . $color . '.png") -93px -41px no-repeat; margin-left: -7px; }

#fap-ui-nav #fap-previous:hover { background: url("images/player/' . $color . '.png") -31px -72px no-repeat }

#fap-ui-nav #fap-next:hover { background: url("images/player/' . $color . '.png") -31px -41px no-repeat }

#fap-ui-nav .fap-play:hover { background: url("images/player/' . $color . '.png") -41px 0 no-repeat }

#fap-ui-nav .fap-pause:hover { background: url("images/player/' . $color . '.png") 0 -103px no-repeat }

a.jp-play:hover { background: url("images/player/' . $color . '.png") -41px 0 no-repeat }

a.jp-pause:hover { background: url("images/player/' . $color . '.png") 0 -103px no-repeat }

a.jp-repeat:hover { background: url("images/player/' . $color . '.png") -93px -72px no-repeat }

a.jp-repeat-off:hover { background: url("images/player/' . $color . '.png") -62px -72px no-repeat }

a.jp-stop:hover { background: url("images/player/' . $color . '.png") -62px -41px no-repeat }

.button-switcher-enter { background: url("images/player/hide' . $color . '.png") 0 0 no-repeat }

.button-switcher-enter:hover { background: url("images/player/hide' . $color . '.png") -50px 0 no-repeat }

.button-switcher-close { background: url("images/player/hide' . $color . '.png") 0 -35px no-repeat }

.button-switcher-close:hover { background: url("images/player/hide' . $color . '.png") -50px -35px no-repeat }

.radio-wz-open { background: url("images/player/hide' . $color . '.png") 0 0 no-repeat; }

.radio-wz-open:hover { background: url("images/player/hide' . $color . '.png") -50px 0 no-repeat }

.radio-wz-open-hidden { background: url("images/player/hide' . $color . '.png") 0 -35px no-repeat; }

.radio-wz-open-hidden:hover { background: url("images/player/hide' . $color . '.png") -50px -35px no-repeat }

.radio-wz-hidden-open { background: url("images/player/hide' . $color . '.png") 0 0 no-repeat; }
	
.radio-wz-hidden-open:hover { background: url("images/player/hide' . $color . '.png") -50px 0 no-repeat }';

echo of_get_option('custom_css');
?>