<?php global $smof_data, $post;
$c_pageID = null;
if(!empty($post->ID)){
    $c_pageID = $post->ID;
}
?>
body.csbody{
    <?php
    if(empty($smof_data['bg_image']) && $smof_data['bg_pattern_option']){
        $smof_data['bg_image'] = $smof_data['bg_pattern'];
    }
    if(get_post_meta($c_pageID, 'cs_bg_repeat', true) != ''){
        $smof_data['bg_repeat'] = get_post_meta($c_pageID, 'cs_bg_repeat', true);
    }
    if(get_post_meta($c_pageID, 'cs_bg_attachment', true) != ''){
        $smof_data['bg_attachment'] = get_post_meta($c_pageID, 'cs_bg_attachment', true);
    }
         $arr = array(
            'color'=>get_post_meta($c_pageID, 'cs_bg_color', true),
            'color_default'=>$smof_data['bg_color'],
            'image'=>get_post_meta($c_pageID, 'cs_bg_image', true),
            'image_default'=>$smof_data['bg_image'],
            'repeat'=>$smof_data['bg_repeat'],
         );
         echo cshero_generetor_background($arr);
    ?>
    background-size: cover;
    background-position: center center;
    background-attachment: <?php echo $smof_data['bg_attachment']; ?>;
    font-size: <?php echo esc_attr($smof_data['body_font_size']); ?>;
}
<?php if($smof_data['layout'] == 'Boxed'): ?>
#wrapper{
    margin: 0 auto;
    max-width: <?php echo $smof_data['layout_width']; ?>;
}
#wrapper .container {
    max-width: 100%;
}
#footer-top{
    background:none!important;
    padding:0!important;
    margin: 0!important;
}
#footer-top .container{
    max-width: <?php echo $smof_data['layout_width']; ?>!important;
    background-color: <?php echo $smof_data['footer_top_bg_color']; ?>;
    padding: <?php echo $smof_data['footer_top_padding']; ?>;
    margin: 0 auto;
}
#footer-bottom{
    background:none!important;
    padding:0!important;
    margin: 0!important;
}
#footer-bottom .container{
    max-width: <?php echo $smof_data['layout_width']; ?>!important;
    background-color: <?php echo $smof_data['footer_bottom_bg_color']; ?> !important;
    padding: <?php echo $smof_data['footer_bottom_padding']; ?> !important;
    margin: 0 auto;
}
<?php endif; ?>
#header-sticky ul.navigation > li > a,.logo-sticky a {
    line-height: <?php echo esc_attr($smof_data["header_sticky_height"]); ?>;
}
body #cshero-header {
<?php
    $arr = array(
            'image'=>get_post_meta($c_pageID, 'cs_header_bg_image', true),
            'image_default'=>$smof_data['header_bg_image'],
            'repeat'=>get_post_meta($c_pageID, 'cs_header_bg_repeat', true),
            'parallax'=>get_post_meta($c_pageID, 'cs_header_bg_parallax', true),
            'parallax_default'=>$smof_data['header_bg_parallax']
         );
    echo cshero_generetor_background($arr);
?>
}
@media (max-width: 992px) {
    .main-menu, .sticky-menu{
        display: none;
    }
    .header-wrapper .btn-nav-mobile-menu{
        display: block;
    }
}
.logo {
    text-align : <?php echo esc_attr($smof_data['logo_alignment']); ?>;
}
.normal_logo {
    margin:<?php echo esc_attr($smof_data['margin_logo']); ?>;
    padding:<?php echo esc_attr($smof_data['padding_logo']); ?>;
}
.logo-sticky {
    text-align : <?php echo esc_attr($smof_data['sticky_logo_alignment']); ?>;
    margin:<?php echo esc_attr($smof_data['sticky_margin_logo']); ?>;
}
.logo-sticky img {
    padding:<?php echo esc_attr($smof_data['sticky_padding_logo']); ?>;
}
.cshero-menu-dropdown > ul > li > a {
    height: <?php echo esc_attr($smof_data['nav_height']); ?>;
    line-height: <?php echo esc_attr($smof_data['nav_height']); ?>;
}
.cshero-menu-dropdown > ul > li {
    padding-right: <?php echo esc_attr($smof_data['nav_padding']); ?>;
}
.sticky-header{
    background: <?php echo HexToRGB($smof_data['header_sticky_bg_color'],$smof_data['header_sticky_opacity']/100); ?>;
}
.sticky-header .cshero-menu-dropdown > ul > li{
    padding-right: <?php echo esc_attr($smof_data['header_sticky_nav_padding']); ?>;
}
.sticky-header .cshero-logo > a,.sticky-header .cshero-menu-dropdown > ul > li > a {
    display: block;
    line-height: <?php echo esc_attr($smof_data['header_sticky_height']); ?>;
}

<?php if (!$smof_data['header_sticky_tablet']): ?>
    @media (max-width: 992px) and (min-width: 768px) {
        #header-sticky{
            display: none;
        }
    }
<?php endif; ?>
<?php if (!$smof_data['header_sticky_mobile']): ?>
    @media (max-width: 767px) {
        #header-sticky{
            display: none;
        }
    }
<?php endif; ?>
#footer-top{
<?php
    $arr = array(
            'color'=>get_post_meta($c_pageID, 'cs_footer_top_bg_color', true),
            'color_default'=>$smof_data['footer_top_bg_color'],
            'image'=>get_post_meta($c_pageID, 'cs_footer_top_bg_image', true),
            'image_default'=>$smof_data['footer_top_bg_image'],
            'repeat'=>get_post_meta($c_pageID, 'footer_top_bg_repeat', true),
            'position'=>get_post_meta($c_pageID, 'footer_top_bg_pos', true),
            'parallax'=>get_post_meta($c_pageID, 'cs_footer_top_bg_parallax', true),
            'parallax_default'=>$smof_data['footer_top_bg_parallax'],
            'bgfull'=>get_post_meta($c_pageID, 'cs_footer_top_bg_full', true),
            'bgfull_default'=>$smof_data['footer_top_bg_full']
         );
    echo cshero_generetor_background($arr);
?>
}
<?php $bg = $color = $padding = $parallax = $repeat = ''; ?>
<?php if(get_post_meta($c_pageID, 'cs_page_title', true) == 'custom'){
    $bg = get_post_meta($c_pageID, 'cs_page_title_bg', true);
    $color = get_post_meta($c_pageID, 'cs_page_title_background_color', true);
    $padding = get_post_meta($c_pageID, 'cs_page_title_padding', true);
} else {
    $bg = $smof_data['page_title_bg'];
    $color = $smof_data['page_title_bg_color'];
    $padding = $smof_data['page_title_padding'];
}
$parallax = $smof_data['page_title_bg_parallax'];
?>
#cs-page-title-wrapper{
    <?php if($color): ?>
    background-color:<?php echo $color; ?>;
    <?php endif; ?>
    <?php if($bg):?>
    background-image:url(<?php echo $bg; ?>);
    <?php endif; ?>
    <?php if($padding): ?>
    padding:<?php echo $padding; ?>;
    <?php endif; ?>
    <?php if($parallax == '1'): ?>
    -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;
    <?php endif; ?>
    <?php if($smof_data['page_title_border_color']): ?>
    border-color: <?php echo esc_attr($smof_data['page_title_border_color']); ?>;
    <?php endif; ?>
}
.page-title-style .page-title {
    font-size: <?php echo esc_attr(get_post_meta($c_pageID, 'cs_page_title_custom_size', true)); ?> !important;
}
.cs-breadcrumbs,.cs-breadcrumbs a{
    color: <?php echo esc_attr($smof_data['breadcrumbs_text_color']); ?>;
    }
<?php if ($smof_data['body_font_options'] != ''): ?>
    <?php
if ($smof_data['body_font_options'] == 'Google Font' && $smof_data['google_body_font_family'] != '' && $smof_data['body_font_family_selector'] != '') {
    $font_body = '' . esc_attr($smof_data['google_body_font_family']) . ' !important';
     ?>
    <?php echo $smof_data['body_font_family_selector']; ?>{font-family:<?php echo $font_body; ?>;}
    <?php
}
if ($smof_data['body_font_options'] == 'Standard Font' && $smof_data['standard_body_font_family'] != '' && $smof_data['body_font_family_selector'] != '') {
    $font_body = '' . esc_attr($smof_data['standard_body_font_family']) . ' !important';
    ?>
    <?php echo $smof_data['body_font_family_selector']; ?>{font-family:<?php echo $font_body; ?>;}
    <?php
}
if ($smof_data['body_font_options'] == 'Custom Font' && $smof_data['custom_body_font_family'] != '' && $smof_data['body_font_family_selector'] != '') {
    $font_body = esc_attr($smof_data['custom_body_font_family']) . ' !important' ;
    ?>
    @font-face {
        font-family: '<?php echo esc_attr($smof_data['custom_body_font_family']);?>';
        src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_body_font_family']);?>.eot');
        src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_body_font_family']);?>.eot?#iefix') format('embedded-opentype'),
        url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_body_font_family']);?>.woff') format('woff'),
        url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_body_font_family']);?>.ttf') format('truetype'),
        url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_body_font_family']);?>.svg#<?php echo esc_attr($smof_data['custom_body_font_family']);?>') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    <?php echo $smof_data['body_font_family_selector']; ?>{font-family:<?php echo $font_body; ?>;}
    <?php
}
?>
<?php endif; ?>
<?php if ($smof_data['header_font_options'] != ''): ?>
    <?php
        if ($smof_data['header_font_options'] == 'Google Font' && $smof_data['google_header_font_family'] != '' && $smof_data['header_font_family_selector'] != '') {
            $font_header = '' . esc_attr($smof_data['google_header_font_family']) . ' !important';
            ?>
    <?php echo $smof_data['header_font_family_selector']; ?>{font-family:<?php echo $font_header; ?>;}
    <?php
}
if ($smof_data['header_font_options'] == 'Standard Font' && $smof_data['standard_header_font_family'] != '' && $smof_data['header_font_family_selector'] != '') {
    $font_header = '' . esc_attr($smof_data['standard_header_font_family']) . ' !important';
    ?>
    <?php echo $smof_data['header_font_family_selector']; ?>{font-family:<?php echo $font_header; ?>;}
    <?php
}
if ($smof_data['header_font_options'] == 'Custom Font' && $smof_data['custom_header_font_family'] != '' && $smof_data['header_font_family_selector'] != '') {
    $font_header = esc_attr($smof_data['custom_header_font_family']) . ' !important';
    ?>
    @font-face {
        font-family: '<?php echo $smof_data['custom_header_font_family']?>';
        src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_header_font_family']);?>.eot');
        src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_header_font_family']);?>.eot?#iefix') format('embedded-opentype'),
        url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_header_font_family']);?>.woff') format('woff'),
        url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_header_font_family']);?>.ttf') format('truetype'),
        url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data['custom_header_font_family']);?>.svg#<?php echo esc_attr($smof_data['custom_header_font_family']);?>') format('svg');
        font-weight: normal;
        font-style: normal;
    }
    <?php echo $smof_data['header_font_family_selector']; ?>{font-family:<?php echo $font_header; ?>;}
    <?php
}
?>
<?php endif; ?>
<?php for ($i = 0 ; $i <= 10 ; $i++): ?>
    <?php if ($smof_data["other_font_options_$i"] != ''): ?>
        <?php
            if ($smof_data["other_font_options_$i"] == 'Google Font' && $smof_data["google_other_font_family_$i"] != '' && $smof_data["other_font_family_selector_$i"] != '') {
                $font_header = '' . esc_attr($smof_data["google_other_font_family_$i"]) . ' !important';
                ?>
        <?php echo $smof_data["other_font_family_selector_$i"]; ?>{font-family:<?php echo $font_header; ?>;}
        <?php
    }
    if ($smof_data["other_font_options_$i"] == 'Standard Font' && $smof_data["standard_other_font_family_$i"] != '' && $smof_data["other_font_family_selector_$i"] != '') {
        $font_header = '' . esc_attr($smof_data["standard_other_font_family_$i"]) . ' !important';
        ?>
        <?php echo $smof_data["other_font_family_selector_$i"]; ?>{font-family:<?php echo $font_header; ?>;}
        <?php
    }
    if ($smof_data["other_font_options_$i"] == 'Custom Font' && $smof_data["custom_other_font_family_$i"] != '' && $smof_data["other_font_family_selector_$i"] != '') {
        $font_header = esc_attr($smof_data["custom_other_font_family_$i"]). ' !important';
        ?>
        @font-face {
            font-family: '<?php echo esc_attr($smof_data["custom_other_font_family_$i"]);?>';
            src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data["custom_other_font_family_$i"]);?>.eot');
            src: url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data["custom_other_font_family_$i"]);?>.eot?#iefix') format('embedded-opentype'),
            url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data["custom_other_font_family_$i"]);?>.woff') format('woff'),
            url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data["custom_other_font_family_$i"]);?>.ttf') format('truetype'),
            url('<?php echo get_template_directory_uri(); ?>/fonts/<?php echo esc_attr($smof_data["custom_other_font_family_$i"]);?>.svg#<?php echo esc_attr($smof_data["custom_other_font_family_$i"]);?>') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        <?php echo $smof_data["other_font_family_selector_$i"]; ?>{font-family:<?php echo $font_header; ?>;}
        <?php
    }
    ?>
    <?php endif; ?>
<?php endfor; ?>

.sticky-header-left{
    background: <?php echo esc_attr($smof_data['header_sticky_bg_color']); ?>;
}
.sticky-header-left:before, .sticky-header-left:after{
    border-bottom: 122px solid <?php echo esc_attr($smof_data['header_sticky_bg_color']); ?>;
}
.sticky-header-left .sticky-menu ul ul{
    background: <?php echo esc_attr($smof_data['sticky_menu_sub_bg_color']); ?>;
}

.cshero-mmenu.navbar-collapse{
    background: <?php echo esc_attr($smof_data['mobile_menu_bg_color']); ?>;
}
.cshero-mmenu ul li a{
    color: <?php echo esc_attr($smof_data['mobile_menu_first_color']); ?>;
}
.cshero-mmenu ul li a:hover, .cshero-mmenu ul li.current-menu-item a{
    color: <?php echo esc_attr($smof_data['mobile_menu_hover_first_color']); ?>;
}
.cshero-mmenu ul ul li a{
    color: <?php echo esc_attr($smof_data['mobile_menu_sub_color']); ?>;
}
.cshero-mmenu ul ul li a:hover, .cshero-mmenu ul ul li.current-menu-item a{
    color: <?php echo esc_attr($smof_data['mobile_menu_sub_hover_color']); ?>;
}
<?php if($smof_data['mobile_menu_sub_sep_color']):?>
.cshero-mmenu ul li{
    border-bottom: 1px solid <?php echo esc_attr($smof_data['mobile_menu_sub_sep_color']); ?>;
}
.cshero-mmenu ul.sub-menu li:first-child{
    border-top: 1px solid <?php echo esc_attr($smof_data['mobile_menu_sub_sep_color']); ?>;
}
<?php endif; ?>

h1{
    font-size: <?php echo esc_attr($smof_data['heading_font_size_h1']); ?>;
}
h2{
    font-size: <?php echo esc_attr($smof_data['heading_font_size_h2']); ?>;
}
h3{
    font-size: <?php echo esc_attr($smof_data['heading_font_size_h3']); ?>;
}
h4{
    font-size: <?php echo esc_attr($smof_data['heading_font_size_h4']); ?>;
}
h5{
    font-size: <?php echo esc_attr($smof_data['heading_font_size_h5']); ?>;
}
h6{
    font-size: <?php echo esc_attr($smof_data['heading_font_size_h6']); ?>;
}
