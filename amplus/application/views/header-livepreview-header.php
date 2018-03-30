<?php

if (!isset($_SESSION)) $_SESSION = array();
if (!array_key_exists('preview', $_SESSION)) $_SESSION['preview'] = array();

$vars = array('opacity', 'bgcolor', 'pattern', 'themecolor', 'textcolor');
foreach ($vars as $key) {
    if (isset($_GET[$key])) $_SESSION[$key] = $_GET[$key];
}
if (isset($_GET['reset'])) {
    unset($_SESSION);
}

?>
<style>
<?php



if (isset($_SESSION['opacity']) || isset($_SESSION['pattern'])) {
    if (!isset($_SESSION['pattern'])) {
        $_SESSION['pattern'] =  'wood_pattern';
    }
    if (!isset($_SESSION['opacity'])) {
        $_SESSION['opacity'] = 1;
    }
    $o = $_SESSION['opacity'] * 100;
    $pat = $_SESSION['pattern'];
    $negate = '';
    if (stripos($pat, '-inv') !== false) {
        $negate = '1';
        $pat = str_replace('-inv', '', $pat);
    }
    echo "body {
        background-image: url('".bfi_thumb(BFI_IMAGEURL."patterns/$pat.png", array("opacity" => $_SESSION['opacity'], 'negate' => $negate))."') !important;
    }";
}
if (isset($_SESSION['bgcolor'])) {
    echo "body {
        background-color: #{$_SESSION['bgcolor']};
    }";
}

if (isset($_SESSION['textcolor'])) {
    echo "
    #top-menu a, #top-menu a:visited,
    #top-menu a i, #top-menu a:visited i,
    #main-menu > ul > li > a, #main-menu > ul > li > a:visited,
    #main-menu > ul > li > a i, #main-menu > ul > li > a:visited i,
    footer .widget *,
    footer .widget a:hover, footer .widget a:visited:hover,
    footer .widget a:hover i, footer .widget a:visited:hover i,
    footer .widget li:before {
        color: #{$_SESSION['textcolor']} !important;
    }";
    
    echo "
    footer .widget hr {
        background-color: rgba(".hexdec(substr($_SESSION['textcolor'], 0, 2)) .','. hexdec(substr($_SESSION['textcolor'], 2, 2)) .','. hexdec(substr($_SESSION['textcolor'], 4, 2)).",.1);
    }
    footer .widget li {
        border-color: rgba(".hexdec(substr($_SESSION['textcolor'], 0, 2)) .','. hexdec(substr($_SESSION['textcolor'], 2, 2)) .','. hexdec(substr($_SESSION['textcolor'], 4, 2)).",.06);
    }
    
    #top-menu > ul.has-cta > li:last-child a:before { color: white !important; }";
}

if (isset($_SESSION['themecolor'])) {
    echo "
    a, a:visited,
    a i, a:visited i,
    #main-menu > ul > li > ul a:hover,
    #main-menu > ul > li > ul a.selected,
    #main-menu > ul > li > ul a i,
    footer .widget a, footer .widget a:visited,
    footer .widget a i, footer .widget a:visited i {
        color: #{$_SESSION['themecolor']};
    }
    
    #top-menu > ul.has-cta > li:last-child a,
    #top-menu > ul.has-cta > li:last-child a:visited,
    #heading-box .nivo-controlNav a,
    #heading-box .nivo-controlNav a:visited,
    .bfi_accordion li > h4.selected,
    .bfi_tabs .tab-title li.selected h4,
    .dropcaps.colored,
    .bfi_toggle.colored > h4,
    .bfi_highlight.colored,
    .bfi_pricingtable > div.big > h3,
    .bfi_pricingtable > div.big > a,
    .bfi_pricingtable > div.big > a:visited,
    .bfi_pricingtable > div.big > .subtitle,
    a.button,
    a.button:visited,
    #body-content .nivo-controlNav a.active,
    .featurebox1 > i,
    .featurebox2 > i,
    .featurebox3,
    .featurenumber > h2,
    .featurenumber > h4,
    form.search a,
    form.search a:visited,
    body.error404 #body-content > .container > .columns > h1,
    .widget_calendar #wp-calendar td a,
    .widget_calendar #wp-calendar td a:visited,
    .widget_calendar #wp-calendar td form.search,
    .widget_calendar #wp-calendar td form.signup,
    .navigation > a,
    .filters a.filter.selected,
    .filters a.filter.selected:hover,
    form.signup a {
        background-color: #{$_SESSION['themecolor']};
    }
    
    hr,
    #top-menu > ul > li.current-menu-item a,
    #main-menu > ul > li.current-menu-item > a,
    #main-menu > ul > li.current-menu-item > a:visited,
    .bfi_tabs .tab-body,
    #main-menu> ul > li > ul,
    footer .widget hr {
        border-color: #{$_SESSION['themecolor']};
    }
    ";
}
?>
    #preview {
        z-index: 99;
        padding: 10px 20px;
        background: white;
        background-color: rgba(255,255,255,.8);
        position: absolute;
        left: 20px;
        top: 0;
    }
    #preview small {
        line-height: 12px;
        font-size: 10px;
        font-style: italic;
        color: red;
        display: block;
        margin-bottom: 5px;
    }
    #preview i {
        margin-right: 5px;
    }
    #preview .toggler {
        margin: 0;
        margin-top: 5px;
        cursor: pointer;
    }
    #preview hr {
        margin: 5px 0;
    }
    #preview h6 {
        margin-bottom: 5px;
    }
    #preview .bg a {
        float: left;
    }
    #preview a img {
        background: white;
        padding: 2px;
        border: 1px solid #ccc;
        margin: 1px;
    }
    #preview,
    #preview-info {
        -webkit-transition-property: all;
        -moz-transition-property: all;
        -o-transition-property: all;
        transition-property: all;
        -webkit-transition-duration: 0.8s;
        -moz-transition-duration: 0.8s;
        -o-transition-duration: 0.8s;
        transition-duration: 0.8s;
    }
    #preview.hide {
        top: -590px;
    }
    #preview-info {
        position: fixed;
        right: 10px;
        z-index: 9;
        opacity: .9;
        top: -150px;
    }
    #preview-info.showme {
        top: 10px;
    }
    #preview .reset {
        background: #444;
        color: #fff;
        font-size: 10px;
        padding: 4px 12px;
        display: block;
        float: left;
        margin-top: 10px;
    }
    @media only screen and (max-width: 767px) {
    #preview, #preview-info {
            display: none;
        }
    }
</style>
<script>
    jQuery(document).ready(function($){
        $('#preview .opacity:eq(0) img').css('opacity', 1 / 5 * 5);
        $('#preview .opacity:eq(1) img').css('opacity', 1 / 5 * 4);
        $('#preview .opacity:eq(2) img').css('opacity', 1 / 5 * 3);
        $('#preview .opacity:eq(3) img').css('opacity', 1 / 5 * 2);
        $('#preview .opacity:eq(4) img').css('opacity', 1 / 5 * 1);
        $('#preview .opacity:eq(5) img').css('opacity', 1 / 5 * 0 + .1);
        var timer = setTimeout("jQuery('#preview').addClass('hide')", 3000);
        $('#preview').hover(function() {
            clearTimeout(timer);
        });
        $('#preview .toggler').click(function() {
            $('#preview').toggleClass('hide');
        });
        <?php
        if (!isset($_SESSION['visited'])) $_SESSION['visited'] = 0;
        if ($_SESSION['visited'] < 3) {
            echo "setTimeout('jQuery(\"#preview-info\").toggleClass(\"showme\")', 5000)";
            $_SESSION['visited']++;
        }
        ?>
    });
</script>
