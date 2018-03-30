<?php header("Content-type: text/css; charset: UTF-8"); 
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
$alc_options = get_option('alc_general_settings');
?>
<?php if ( $alc_options['alc_custom_background'] != '' || $alc_options['alc_background_color'] != '' || $alc_options['alc_background_repeat'] != '') :?>
body{
	<?php 	if ($alc_options['alc_custom_background'] !='') :?>background-image:url('<?php echo $alc_options['alc_custom_background']?>') !important;<?php endif;?>
	<?php 
	echo $alc_options['alc_background_color'] != '' ? 'background-color:'.$alc_options['alc_background_color'].'!important;' : '';  
	echo $alc_options['alc_background_repeat'] != '' ? 'background-repeat:'.$alc_options['alc_background_repeat'].';' : ''; 	
	?>
}
<?php endif?>
<?php if ($alc_options['alc_topbar_bg'] || $alc_options['alc_topbar_bg_color']):?>
.top-header{
	<?php if (!(empty($alc_options['alc_topbar_bg']))):?> background-image:url('<?php echo $alc_options['alc_topbar_bg']?>'); <?php endif ?> 
	<?php if (!(empty($alc_options['alc_topbar_bg_repeat']))):?> background-repeat:<?php echo $alc_options['alc_topbar_bg_repeat'] ?>; <?php endif ?> 
	<?php if (!(empty($alc_options['alc_topbar_bg_color']))):?> background-color:<?php echo $alc_options['alc_topbar_bg_color'] ?>; <?php endif ?> 
}
<?php endif?>
<?php if ($alc_options['alc_header_bg'] || $alc_options['alc_header_bg_color']):?>
.main-navigation, .bottom-header{
	<?php if (!(empty($alc_options['alc_header_bg']))):?> background-image:url('<?php echo $alc_options['alc_header_bg']?>'); <?php endif ?> 
	<?php if (!(empty($alc_options['alc_header_bg_repeat']))):?> background-repeat:<?php echo $alc_options['alc_header_bg_repeat'] ?>; <?php endif ?> 
		<?php if (!(empty($alc_options['alc_header_bg_color']))):?> background-color:<?php echo $alc_options['alc_header_bg_color'] ?>; <?php endif ?> 
}
<?php endif?>
<?php if ($alc_options['alc_content_bg'] || $alc_options['alc_content_bg_static']):?>
.main-content-top{
	<?php if (!(empty($alc_options['alc_content_bg']))):?> background-image:url('<?php echo $alc_options['alc_content_bg']?>'); <?php endif ?> 
	<?php if (!(empty($alc_options['alc_content_bg_static']))):?> background-color:<?php echo $alc_options['alc_content_bg_static']?>; <?php endif ?> 
	<?php if (!(empty($alc_options['alc_content_bg_repeat']))):?> background-repeat:<?php echo $alc_options['alc_content_bg_repeat']?>; <?php endif ?> 
	
}
<?php endif?>
<?php if($alc_options['alc_menu_color'] != ''):?>
.top-bar-section ul li > a {color:<?php echo $alc_options['alc_menu_color']?>}
<?php endif?>
<?php if($alc_options['alc_submenu_color'] != ''):?>
.top-bar-section ul.dropdown a{color:<?php echo $alc_options['alc_submenu_color']?>}
<?php endif?>
<?php if($alc_options['alc_submenu_bg'] != ''):?>
.top-bar-section .dropdown li, .top-bar-section .dropdown li a  {background-color:<?php echo $alc_options['alc_submenu_bg']?>}
<?php endif?>
<?php if($alc_options['alc_menu_hover_color'] != ''):?>
.top-bar-section .current-menu-item a:hover, .current-menu-item a:hover, .current_page_item a:hover, .current_page_parent a:hover, .current-menu-parent a:hover, .top-bar-section ul>li> a:hover {color:<?php echo $alc_options['alc_menu_hover_color'] ?> !important;}
<?php endif?>
<?php if($alc_options['alc_menu_active_bg'] != ''):?>
.top-bar-section > li.active a, 
.top-bar-section .current > a, .top-bar-section .current-menu-item > a, .top-bar-section .current_page_item > a, .top-bar-section .current_page_parent > a, .top-bar-section .current-menu-parent > a{background-color:<?php echo $alc_options['alc_menu_active_bg']?>;}
<?php endif?>
<?php if($alc_options['alc_main_color']):?>
.meta li, .top-bar-section .dropdown li a:hover, .banner>.button, .services, .module_img, .promo a.button, .pagination li.current a, .pagination li.current a:hover, .pagination li a:hover,
.widgets.widget_tag_cloud a, .footer-widgets a.postfix, .filter li.active a, .filter li:hover a, .proj_view a.button, .featured-block, .featured-block:hover .fblock-sub,
.title-block .icon-container, .social-icons li:hover, .toggle:before, .toggle.open:before, .bx-controls-direction a:hover, mark,  .smallipop-instance.blue .sipContent,
.button, .button:hover, .button:focus, .button.disabled, .button, .button.disabled:hover, .button.disabled:focus, .button[disabled]:hover, .button[disabled]:focus,
a.prev:hover, a.next:hover,.construction .progress .meter, div#clock .small-2.columns p, .filter li a.selected, .orbit-container .orbit-prev, .orbit-container .orbit-next,
.col-highlight a.button, .button.success, .sub-nav dt.active a, .sub-nav dd.active a, .section-container.tabs section.active .title, 
.section-container.tabs .section.active .title,.panel.callout, .cta-button a.button{
	background-color:<?php echo $alc_options['alc_main_color']?>;
}
.widgets p, .breadcrumbs li.current a, .breadcrumbs li a:hover, a:hover, .test_author, h4.footer-title, .contact_title, .color, .featured-block:hover .fblock-icon, .featured-block:hover .fblock-main, .toggle-title:hover, .toggle.open .toggle-title,
.toggle.open .toggle-title:hover, a, a:hover, a:focus, .top-bar-section .left>li>a:hover, .top-bar-section ul li > a.button:hover, .top-bar-section ul li.active> a,
.top-footer a:hover, .reveal-modal h2, .pricing-table .title, highlight, .contact-details p span, .widgets li a:hover, .shop-sidebar li  a:hover, mark, .twitter-item a{
	color:<?php echo $alc_options['alc_main_color']?> ;
}

.meta li, .top-bar-section ul li>a:hover.thumbs li a img:hover, .avatar, .featured-block:hover .fblock-sub, .smallipop-instance.blue .sipArrow, .smallipop-instance.blue.sipPositionedLeft .sipArrow,
.smallipop-instance.blue.sipAlignBottom .sipArrow, .smallipop-instance.blue.sipPositionedRight .sipArrow , .button.disabled, .button,.panel.callout,
.th:hover, .th:focus{
	border-color:<?php echo $alc_options['alc_main_color']?>;
}
.main-content-top, .arrow-right,.top-bar-section .dropdown li, .top-bar-section .dropdown li:hover {
	border-left-color:<?php echo $alc_options['alc_main_color']?>;
}
.top-header ul li{border-right-color:#666}
.top-header ul li:first-child{border-left-color:#666}
.top-header .login{background:#666}
<?php endif?>
<?php if($alc_options['alc_headings_color'] != ''):?>h1, h2, h3, h4, h5, h6 {color:<?php echo $alc_options['alc_headings_color']?> !important}<?php endif?>
<?php if($alc_options['alc_footer_color'] != ''):?>
.footer-part *{<?php echo 'color:'.$alc_options['alc_footer_color'] ?>!important;}
<?php endif?>
<?php if($alc_options['alc_footer_bg'] != '' || $alc_options['alc_footer_bg_color'] != ''):?>
.top-footer{
	<?php if($alc_options['alc_footer_bg'] != ''):?>background-image:url('<?php echo $alc_options['alc_footer_bg']?>') !important; <?php endif?>
	background-repeat:<?php echo $alc_options['footer_bg_repeat'] ?>;	
	<?php if($alc_options['alc_footer_bg_color'] != ''):?>background-color:<?php	echo  $alc_options['alc_footer_bg_color'] ?><?php endif?>;
}
<?php endif?>
<?php if($alc_options['alc_topmenu_font_size'] != ''):?>
#menu-main a{font-size: <?php echo $alc_options['alc_topmenu_font_size']?>}
<?php endif?>
<?php if($alc_options['alc_dropdownmenu_font_size'] != ''):?>
#menu-main .dropdown a{font-size: <?php echo $alc_options['alc_dropdownmenu_font_size']?> !important}
<?php endif?>
<?php if($alc_options['alc_body_font_size'] != ''):?>
body, p, ul#twitter_update_list li, .crumb_navigation ul a, .copyright, .widgets ul li a{font-size: <?php echo $alc_options['alc_body_font_size']?>}
<?php endif?>
<?php if($alc_options['alc_menu_active_bg'] != ''):?>
.top-bar-section ul li.active> a {background:<?php echo $alc_options['alc_menu_active_bg']?>}
<?php endif?>
<?php if($alc_options['alc_custom_css']):?>
	<?php echo $alc_options['alc_custom_css'] ?>
<?php endif?>