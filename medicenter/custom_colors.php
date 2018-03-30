<?php global $theme_options; ?>
<!--custom style-->
<style type="text/css">
	<?php if($theme_options["site_background_color"]!=""): ?>
	body
	{
		background-color: #<?php echo $theme_options["site_background_color"]; ?>;
	}
	<?php endif;
	if($theme_options["header_background_color"]!=""): ?>
	.header_container
	{
		background-color: #<?php echo $theme_options["header_background_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_background_color"]!=""): ?>
	.site_container
	{
		background-color: #<?php echo $theme_options["body_background_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_background_color"]!=""): ?>
	.footer_container
	{
		background-color: #<?php echo $theme_options["footer_background_color"]; ?>;
	}
	<?php endif;
	if($theme_options["link_color"]!=""): ?>
	a,
	.more
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce-message a,
	.woocommerce-info a,
	.woocommerce-error a,
	.woocommerce-review-link,
	.woocommerce-checkout #payment .payment_method_paypal .about_paypal
	<?php
	endif;
	?>
	{
		color: #<?php echo $theme_options["link_color"]; ?>;
		border-color: #<?php echo $theme_options["link_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["link_hover_color"]!=""): ?>
	a:hover,
	.post_footer_details li a:hover,
	.bread_crumb li a:hover,
	.post_footer_details li a:hover,
	#comments_list .comment_details .posted_by a:hover,
	#cancel_comment:hover
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce .posted_in a:hover
	<?php
	endif;
	?>
	{
		color: #<?php echo $theme_options["link_hover_color"]; ?>;
		border-color: #<?php echo $theme_options["link_hover_color"]; ?>;
	}
	<?php endif;
	if($theme_options["footer_link_color"]!=""): ?>
	.footer a,
	.footer .scrolling_list li a
	{
		color: #<?php echo $theme_options["footer_link_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_link_hover_color"]!=""): ?>
	.footer a:hover,
	.footer .scrolling_list li a:hover
	{
		color: #<?php echo $theme_options["footer_link_hover_color"]; ?>;
	}
	<?php endif;
	if($theme_options["body_headers_color"]!=""): ?>
	h1, h2, h3, h4, h5,
	h1 a, h2 a, h3 a, h4 a, h5 a,
	h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover
	{
		color: #<?php echo $theme_options["body_headers_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_headers_border_color"]!=""): ?>
	.box_header:after
	<?php 
	if(is_plugin_active('woocommerce/woocommerce.php')): ?>	
	,
	.woocommerce .comment-reply-title:after,
	.woocommerce-checkout .woocommerce h2:after
	<?php endif; ?>
	{
		<?php if($theme_options["body_headers_border_color"]=="none"): ?>
		background: none;
		height: 0;
		margin-top: 0;
		<?php else: ?>
		background: #<?php echo $theme_options["body_headers_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if(is_plugin_active('woocommerce/woocommerce.php') && $theme_options["body_headers_border_color"]!=""): ?>	
	.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a.selected,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a
	{
		border-bottom-color: #<?php echo $theme_options["body_headers_border_color"] ?>;
	}
	<?php endif; 
	if($theme_options["body_text_color"]!=""): ?>
	p
	{
		color: #<?php echo $theme_options["body_text_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["timeago_label_color"]!=""): ?>
	.timeago
	{
		color: #<?php echo $theme_options["timeago_label_color"]; ?>;
	}
	<?php endif;
	if($theme_options["footer_headers_color"]!=""): ?>
	.footer h1, .footer h2, .footer h3, .footer h4, .footer h5,
	.footer h1 a, .footer h2 a, .footer h3 a, .footer h4 a, .footer h5 a,
	.footer .box_header
	{
		color: #<?php echo $theme_options["footer_headers_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_headers_border_color"]!=""): ?>
	.footer .box_header:after
	{
		<?php if($theme_options["footer_headers_border_color"]=="none"): ?>
		background: none;
		height: 0;
		margin-top: 0;
		<?php else: ?>
		background: #<?php echo $theme_options["footer_headers_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["footer_text_color"]!=""): ?>
	.footer,
	.footer_box,
	.footer p,
	.footer_box p
	{
		color: #<?php echo $theme_options["footer_text_color"]; ?>;
	}
	<?php endif;
	if($theme_options["footer_timeago_label_color"]!=""): ?>
	.footer .timeago
	{
		color: #<?php echo $theme_options["footer_timeago_label_color"]; ?>;
	}
	<?php endif;
	if($theme_options["sentence_color"]!=""): ?>
	.sentence
	{
		color: #<?php echo $theme_options["sentence_color"]; ?>;
	}
	<?php endif;
	if($theme_options["quote_color"]!=""): ?>
	blockquote,
	blockquote p
	{
		color: #<?php echo $theme_options["quote_color"]; ?>;
		border-color:  #<?php echo $theme_options["quote_color"]; ?>;
	}
	<?php
	if($theme_options["quote_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
	?>
	.woocommerce mark
	{
		background:  #<?php echo $theme_options["quote_color"]; ?>;
	}
	<?php
	endif;
	?>
	<?php endif; 
	if($theme_options["logo_text_color"]!=""): ?>
	.logo
	{
		color: #<?php echo $theme_options["logo_text_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_button_color"]!=""): ?>
	.ui-tabs-nav li a,
	.tabs_navigation li a,
	.scrolling_list li .number,
	.categories li, .widget_categories li,
	.categories li a, .widget_categories li a,
	.pagination li a, .pagination li span
	{
		color: #<?php echo $theme_options["body_button_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["body_button_hover_color"]!="" || $theme_options["body_button_border_hover_color"]!=""): ?>
	.header_right a.scrolling_list_control_left:hover, 
	.header_right a.scrolling_list_control_right:hover,
	.pagination li a:hover,
	.pagination li.selected a,
	.pagination li.selected span,
	.tabs_navigation li a:hover,
	.tabs_navigation li a.selected,
	.tabs_navigation li.ui-tabs-active a,
	.categories li a:hover,
	.widget_categories li a:hover,
	.categories li.current-cat a,
	.widget_categories li.current-cat a,
	.scrolling_list li a:hover .number,
	.controls .close:hover, .controls .prev:hover, .controls .next:hover
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce .product-categories li a:hover
	<?php
	endif;
	?>
	{
		<?php if($theme_options["body_button_hover_color"]!=""): ?>
		color: #<?php echo $theme_options["body_button_hover_color"]; ?>;
		<?php endif;
		if($theme_options["body_button_border_hover_color"]!=""): ?>
		border-color: #<?php echo $theme_options["body_button_border_hover_color"]; ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["body_button_border_color"]!=""): ?>
	.header_right a.scrolling_list_control_left, 
	.header_right a.scrolling_list_control_right,
	.pagination li a,
	.pagination li span,
	.categories li a,
	.widget_categories li a,
	.scrolling_list li .number
	{
		border-color: #<?php echo $theme_options["body_button_border_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_button_color"]!=""): ?>
	.footer .ui-tabs-nav li a,
	.footer .tabs_navigation li a,
	.footer .scrolling_list li .number,
	.footer .categories li, .widget_categories li,
	.footer .categories li a, .widget_categories li a
	{
		color: #<?php echo $theme_options["footer_button_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["footer_button_hover_color"]!="" || $theme_options["footer_button_border_hover_color"]!=""): ?>
	.footer .header_right a.scrolling_list_control_left:hover, 
	.footer .header_right a.scrolling_list_control_right:hover,
	.footer .pagination li a:hover,
	.footer .pagination li.selected a,
	.footer .pagination li.selected span,
	.footer .tabs_navigation li a:hover,
	.footer .tabs_navigation li a.selected,
	.footer .tabs_navigation li.ui-tabs-active a,
	.footer .categories li a:hover,
	.footer .widget_categories li a:hover,
	.footer .scrolling_list li a:hover .number
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce .woocommerce-pagination ul.page-numbers li a:hover,
	.woocommerce .woocommerce-pagination ul.page-numbers li a.current,
	.woocommerce .woocommerce-pagination ul.page-numbers li span.current
	<?php
	endif;
	?>
	{
		<?php if($theme_options["footer_button_hover_color"]!=""): ?>
		color: #<?php echo $theme_options["footer_button_hover_color"]; ?>;
		<?php endif;
		if($theme_options["footer_button_border_hover_color"]!=""): ?>
		border-color: #<?php echo $theme_options["footer_button_border_hover_color"]; ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["footer_button_border_color"]!=""): ?>
	.footer .header_right a.scrolling_list_control_left, 
	.footer .header_right a.scrolling_list_control_right,
	.footer .pagination li a,
	.footer .pagination li span,
	.footer .categories li a,
	.footer .widget_categories li a,
	.footer .scrolling_list li .number,
	.footer .ui-tabs-nav li a,
	.footer .tabs_navigation li a
	{
		border-color: #<?php echo $theme_options["footer_button_border_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["menu_position_text_color"]!="" || $theme_options["menu_position_background_color"]!=""): ?>
	.sf-menu li a, .sf-menu li a:visited
	{
		<?php if($theme_options["menu_position_text_color"]!=""): ?>
		color: #<?php echo $theme_options["menu_position_text_color"] ?>;
		<?php endif;
		if($theme_options["menu_position_background_color"]!=""): ?>
		background-color: #<?php echo $theme_options["menu_position_background_color"] ?>;
		<?php endif; ?>
	}
	.mobile_menu_container nav.mobile_menu>ul li.current-menu-ancestor ul a,
	.mobile_menu_container nav.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul a,
	.mobile_menu_container nav.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent ul a
	{
		<?php if($theme_options["menu_position_text_color"]!=""): ?>
		color: #<?php echo $theme_options["menu_position_text_color"] ?>;
		<?php endif; 
		if($theme_options["menu_position_background_color"]!=""): ?>
		background-color: #<?php echo $theme_options["menu_position_background_color"] ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["menu_position_hover_text_color"]!="" || $theme_options["menu_position_hover_background_color"]!=""): ?>
	.sf-menu li:hover a, .sf-menu li.selected a, .sf-menu li.current-menu-item a, .sf-menu li.current-menu-ancestor a
	{
		<?php if($theme_options["menu_position_hover_text_color"]!=""): ?>
		color: #<?php echo $theme_options["menu_position_hover_text_color"] ?>;
		<?php endif; 
		if($theme_options["menu_position_hover_background_color"]!=""): ?>
		background-color: #<?php echo $theme_options["menu_position_hover_background_color"] ?>;
		<?php endif; ?>
	}
	.header.layout_2 .sf-menu li:hover a, .header.layout_2 .sf-menu li.selected a, .header.layout_2 .sf-menu li.current-menu-item a, .header.layout_2 .sf-menu li.current-menu-ancestor a
	{
		<?php
		if($theme_options["menu_position_hover_background_color"]!=""): ?>
		border-color: #<?php echo $theme_options["menu_position_hover_background_color"] ?>;
		<?php endif; ?>
	}
	.mobile-menu-switch
	{
		<?php
		if($theme_options["menu_position_hover_background_color"]!=""): ?>
		border-color: #<?php echo $theme_options["menu_position_hover_background_color"] ?>;
		<?php endif; ?>
	}
	.mobile-menu-switch:hover
	{
		<?php
		if($theme_options["menu_position_hover_background_color"]!=""): ?>
		background: #<?php echo $theme_options["menu_position_hover_background_color"] ?>;
		border-color: #<?php echo $theme_options["menu_position_hover_background_color"] ?>;
		<?php endif; ?>
	}
	.mobile-menu-switch .line
	{
		<?php
		if($theme_options["menu_position_hover_background_color"]!=""): ?>
		background: #<?php echo $theme_options["menu_position_hover_background_color"] ?>;
		<?php endif; ?>
	}
	.mobile_menu_container nav.mobile_menu>ul li.current-menu-item>a,
	.mobile_menu_container nav.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-item a,
	.mobile_menu_container nav.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-item a,
	.mobile_menu_container nav.mobile_menu>ul li.current-menu-ancestor a,
	.mobile_menu_container nav.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent a,
	.mobile_menu_container nav.mobile_menu>ul li.current-menu-ancestor ul li.current-menu-parent ul li.current-menu-parent a
	{
		<?php if($theme_options["menu_position_hover_text_color"]!=""): ?>
		color: #<?php echo $theme_options["menu_position_hover_text_color"] ?>;
		<?php endif;
		if($theme_options["menu_position_hover_background_color"]!=""): ?>
		background: #<?php echo $theme_options["menu_position_hover_background_color"] ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["submenu_position_text_color"]!="" || $theme_options["submenu_position_border_color"]): ?>
	.sf-menu li:hover ul a, .sf-menu li.submenu:hover ul a,
	.header.layout_2 .sf-menu li:hover ul a, .header.layout_2 .sf-menu li.submenu:hover ul a
	{
		<?php if($theme_options["submenu_position_text_color"]!=""): ?>
		color: #<?php echo $theme_options["submenu_position_text_color"] ?>;
		<?php endif;
		if($theme_options["submenu_position_border_color"]=="none"): ?>
		border: none;
		padding-bottom: 16px;
		<?php else: ?>
		border-bottom: 1px solid #<?php echo $theme_options["submenu_position_border_color"] ?>;
		<?php endif; ?>
	}
	<?php
	if($theme_options["submenu_position_border_color"]!="none"):?>
	.vertical_menu li a
	{
		border-color: #<?php echo $theme_options["submenu_position_border_color"] ?>;
	}
	<?php endif; ?>
	@media screen and (max-width:1009px)
	{
		.sf-menu li:hover ul a, .sf-menu li.submenu:hover ul a,
		.header.layout_2 .sf-menu li:hover ul a, .header.layout_2 .sf-menu li.submenu:hover ul a
		{
			<?php
			if($theme_options["submenu_position_border_color"]=="none"): ?>
			padding-bottom: 13px;
			<?php else: ?>
			padding-bottom: 11px;
			<?php endif; ?>
		}
	}
	<?php endif; 
	if($theme_options["submenu_position_hover_text_color"]!="" || $theme_options["submenu_position_hover_border_color"] || $theme_options["submenu_position_border_color"]=="none"): ?>
	.sf-menu li ul li a:hover, .sf-menu li ul li.selected a, .sf-menu li ul li.current-menu-item a,
	.sf-menu li.submenu ul li a:hover, .sf-menu li.submenu:hover ul li.selected a, .sf-menu li.submenu:hover ul li.current-menu-item a,
	.sf-menu li.submenu:hover ul li.selected ul li a:hover,.sf-menu li.submenu:hover ul li.current-menu-item ul li a:hover, .sf-menu li.submenu:hover ul li ul li.selected a, .sf-menu li.submenu:hover ul li ul li.current-menu-item a, .sf-menu li.submenu:hover ul li.selected ul li.selected a, .sf-menu li.submenu:hover ul li.selected ul li.current-menu-item a,
	.sf-menu li.submenu:hover ul li.menu-item-type-custom a:hover, .sf-menu li ul li.menu-item-type-custom a:hover,
	.header.layout_2 .sf-menu li ul li a:hover, .header.layout_2 .sf-menu li ul li.selected a, .header.layout_2 .sf-menu li ul li.current-menu-item a,
	.header.layout_2 .sf-menu li.submenu ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li.selected a, .header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item a,
	.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li ul li.selected a, .header.layout_2 .sf-menu li.submenu:hover ul li ul li.current-menu-item a, .header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li.selected a, .header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li.current-menu-item a,
	.header.layout_2 .sf-menu li.submenu:hover ul li.menu-item-type-custom a:hover, .header.layout_2 .sf-menu li ul li.menu-item-type-custom a:hover
	
	/*.header.layout_2 .sf-menu li ul li a:hover, .header.layout_2 .sf-menu li ul li.selected a, .header.layout_2 .sf-menu li ul li.current-menu-item a,
	.header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item a, .header.layout_2 .sf-menu li.submenu ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li.selected a,
	.header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li ul li.current-menu-item a,
	.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li.current-menu-item a, 
	.header.layout_2 .sf-menu li.submenu:hover ul li.menu-item-type-custom a:hover, .header.layout_2 .sf-menu li ul li.menu-item-type-custom a:hover,
	.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li ul li.selected a, .header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li.selected a*/
	{
		<?php if($theme_options["submenu_position_hover_text_color"]!=""): ?>
		color: #<?php echo $theme_options["submenu_position_hover_text_color"] ?>;
		<?php endif;
		if($theme_options["submenu_position_hover_border_color"]=="none"): ?>
		border: none;
		padding-bottom: 16px;
		<?php else: ?>
		border-bottom: 2px solid #<?php echo $theme_options["submenu_position_hover_border_color"] ?>;
		padding-bottom: 14px;
		<?php endif; ?>
	}
	@media screen and (max-width:1009px)
	{
		/*.sf-menu li ul li a:hover, .sf-menu li ul li.selected a, .sf-menu li ul li.current-menu-item a,
		.sf-menu li.submenu ul li a:hover, .sf-menu li.submenu:hover ul li.selected a, .sf-menu li.submenu:hover ul li.current-menu-item a,
		.sf-menu li.submenu:hover ul li.selected ul li a:hover,.sf-menu li.submenu:hover ul li.current-menu-item ul li a:hover, .sf-menu li.submenu:hover ul li ul li.selected a, .sf-menu li.submenu:hover ul li ul li.current-menu-item a, .sf-menu li.submenu:hover ul li.selected ul li.selected a, .sf-menu li.submenu:hover ul li.selected ul li.current-menu-item a,
		.sf-menu li ul li.menu-item-type-custom a:hover,*/
		/*.header.layout_2 .sf-menu li ul li a:hover, .header.layout_2 .sf-menu li ul li.selected a, .header.layout_2 .sf-menu li ul li.current-menu-item a,
		.header.layout_2 .sf-menu li.submenu ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li.selected a, .header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item a,
		.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li ul li.selected a, .header.layout_2 .sf-menu li.submenu:hover ul li ul li.current-menu-item a, .header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li.selected a, .header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li.current-menu-item a,
		.header.layout_2 .sf-menu li ul li.menu-item-type-custom a:hover,*/
		.sf-menu li ul li a:hover, .sf-menu li ul li.selected a, .sf-menu li ul li.current-menu-item a,
		.sf-menu li.submenu:hover ul li.current-menu-item a, .sf-menu li.submenu ul li a:hover, .sf-menu li.submenu:hover ul li.selected a,
		.sf-menu li.submenu:hover ul li.current-menu-item ul li a:hover, .sf-menu li.submenu:hover ul li ul li.current-menu-item a,
		.sf-menu li.submenu:hover ul li.selected ul li.current-menu-item a, .sf-menu li ul li.menu-item-type-custom a,
		.sf-menu li.submenu:hover ul li.menu-item-type-custom a:hover, .sf-menu li ul li.menu-item-type-custom a:hover,
		.sf-menu li.submenu:hover ul li.selected ul li a:hover, .sf-menu li.submenu:hover ul li ul li.selected a, .sf-menu li.submenu:hover ul li.selected ul li.selected a,
		.sf-menu li.submenu:hover ul li ul li.current-menu-item a:hover,
		.header.layout_2 .sf-menu li ul li a:hover, .header.layout_2 .sf-menu li ul li.selected a, .header.layout_2 .sf-menu li ul li.current-menu-item a,
		.header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item a, .header.layout_2 .sf-menu li.submenu ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li.selected a,
		.header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li ul li.current-menu-item a,
		.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li.current-menu-item a, .header.layout_2 .sf-menu li ul li.menu-item-type-custom a,
		.header.layout_2 .sf-menu li.submenu:hover ul li.menu-item-type-custom a:hover, .header.layout_2 .sf-menu li ul li.menu-item-type-custom a:hover,
		.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li a:hover, .header.layout_2 .sf-menu li.submenu:hover ul li ul li.selected a, .header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li.selected a,
		.header.layout_2 .sf-menu li.submenu:hover ul li ul li.current-menu-item a:hover
		{
			<?php if($theme_options["submenu_position_hover_text_color"]!=""): ?>
			color: #<?php echo $theme_options["submenu_position_hover_text_color"] ?>;
			<?php endif;
			if($theme_options["submenu_position_hover_border_color"]=="none"): ?>
			padding-bottom: 13px;
			<?php else: ?>
			padding-bottom: 11px;
			<?php endif; ?>
		}
	}
	.sf-menu li.submenu:hover ul li.menu-item-type-custom a,
	.sf-menu li.submenu:hover ul li.selected ul li a,
	.sf-menu li.submenu:hover ul li.current-menu-item ul li a,
	.sf-menu li ul li.menu-item-type-custom a,
	.header.layout_2 .sf-menu li.submenu:hover ul li.menu-item-type-custom a,
	.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li a,
	.header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item ul li a,
	.header.layout_2 .sf-menu li ul li.menu-item-type-custom a
	/*.header.layout_2 .sf-menu li.submenu:hover ul li.menu-item-type-custom a, 
	.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li a,
	.header.layout_2 .sf-menu li ul li.menu-item-type-custom a*/
	{
		color: #<?php echo ($theme_options["submenu_position_text_color"]!="" ? $theme_options["submenu_position_text_color"] : "888"); ?>;
		<?php if($theme_options["submenu_position_border_color"]=="none"): ?>
		border: none;
		padding-bottom: 16px;
		<?php else: ?>
		border-bottom: 1px solid #<?php echo ($theme_options["submenu_position_border_color"]!="" ? $theme_options["submenu_position_border_color"] : "E8E8E8"); ?>;
		padding-bottom: 15px;
		<?php endif; ?>
	}
	@media screen and (max-width:1009px)
	{
		/*.header.layout_2 .sf-menu li.submenu:hover ul li.menu-item-type-custom a, 
		.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li a,
		.header.layout_2 .sf-menu li ul li.menu-item-type-custom a*/
		.sf-menu li.submenu:hover ul li.menu-item-type-custom a,
		.sf-menu li.submenu:hover ul li.selected ul li a,
		.sf-menu li.submenu:hover ul li.current-menu-item ul li a,
		.sf-menu li ul li.menu-item-type-custom a,
		.header.layout_2 .sf-menu li.submenu:hover ul li.menu-item-type-custom a,
		.header.layout_2 .sf-menu li.submenu:hover ul li.selected ul li a,
		.header.layout_2 .sf-menu li.submenu:hover ul li.current-menu-item ul li a,
		.header.layout_2 .sf-menu li ul li.menu-item-type-custom a
		{
			<?php if($theme_options["submenu_position_border_color"]=="none"): ?>
			border: none;
			padding-bottom: 13px;
			<?php else: ?>
			border-bottom: 1px solid #<?php echo ($theme_options["submenu_position_border_color"]!="" ? $theme_options["submenu_position_border_color"] : "E8E8E8"); ?>;
			padding-bottom: 12px;
			<?php endif; ?>
		}
	}
	<?php
	if($theme_options["submenu_position_hover_border_color"]!="none"):?>
	.vertical_menu li a:hover,
	.vertical_menu li.is-active a
	{
		border-color: #<?php echo $theme_options["submenu_position_hover_border_color"] ?>;
	}
	<?php endif; 
	endif;
	if($theme_options["dropdownmenu_background_color"]!=""): ?>
	.tabs_box_navigation.sf-menu .tabs_box_navigation_selected
	{
		background-color: #<?php echo $theme_options["dropdownmenu_background_color"] ?>;
	}
	<?php endif; 
	if($theme_options["dropdownmenu_hover_background_color"]!=""): ?>
	.tabs_box_navigation.sf-menu .tabs_box_navigation_selected:hover
	{
		background-color: #<?php echo $theme_options["dropdownmenu_hover_background_color"] ?>;
	}
	<?php endif; 
	if($theme_options["dropdownmenu_border_color"]!=""): ?>
	.tabs_box_navigation.sf-menu li:hover ul, .tabs_box_navigation.sf-menu li.sfHover ul
	{
		border-color: #<?php echo $theme_options["dropdownmenu_border_color"] ?>;
	}
	<?php endif;
	if($theme_options["form_field_text_color"]!=""): ?>
	.comment_form input, .comment_form textarea, .contact_form input, .contact_form textarea
	{
		color: #<?php echo $theme_options["form_field_text_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["form_field_border_color"]!=""): ?>
	.search .search_input, 
	.comment_form input, .comment_form textarea, 
	.contact_form input, .contact_form textarea
	{
		<?php if($theme_options["form_field_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-top: 1px solid #<?php echo $theme_options["form_field_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["form_button_background_color"]!="" || $theme_options["form_button_text_color"]!=""): ?>
	.comment_form .mc_button,
	.contact_form .mc_button
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce #respond input#submit,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.altm,
	.woocommerce .widget_product_search form input[type='submit'],
	.woocommerce .cart .coupon input.button,
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
	.woocommerce .widget_price_filter .price_slider_amount .button,
	.woocommerce .widget_product_search form input[type='submit'],
	.woocommerce div.product form.cart .button.single_add_to_cart_button,
	.woocommerce #review_form #respond .form-submit input,
	.woocommerce #payment #place_order,
	.woocommerce .cart input.button,
	.woocommerce .button.wc-forward,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range	
	<?php
	endif;
	?>
	{
		<?php if($theme_options["form_button_background_color"]!=""): ?>
		background-color: #<?php echo $theme_options["form_button_background_color"]; ?>;
		border-color: #<?php echo $theme_options["form_button_background_color"]; ?>;
		<?php endif; ?>
		<?php if($theme_options["form_button_text_color"]!=""): ?>
		color: #<?php echo $theme_options["form_button_text_color"]; ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["form_button_background_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
	?>
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle
	{
		border: 2px solid #<?php echo $theme_options["form_button_background_color"]; ?>;	
	}
	<?php
	endif;
	
	if($theme_options["form_button_background_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
	?>
	.woocommerce .woocommerce-error,
	.woocommerce .woocommerce-info,
	.woocommerce .woocommerce-message
	{
		border-left-color: #<?php echo $theme_options["form_button_background_color"]; ?>;	
	}
	.rtl .woocommerce .woocommerce-error,
	.rtl .woocommerce .woocommerce-info,
	.rtl .woocommerce .woocommerce-message
	{
		border-right-color: #<?php echo $theme_options["form_button_background_color"]; ?>;	
	}
	<?php
	endif;
	
	if($theme_options["form_button_background_color"]!="" && is_plugin_active('woocommerce/woocommerce.php')):
	?>
	.woocommerce a.remove
	{
		color: #<?php echo $theme_options["form_button_background_color"]; ?> !important;	
	}
	.woocommerce a.remove:hover
	{
		background-color: #<?php echo $theme_options["form_button_background_color"]; ?>;	
	}
	<?php
	endif;
	
	if($theme_options["form_button_hover_background_color"]!="" || $theme_options["form_button_hover_text_color"]!=""): ?>
	.comment_form .mc_button:hover,
	.contact_form .mc_button:hover
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce #respond input#submit:hover,
	.woocommerce a.button:hover,
	.woocommerce button.button:hover,
	.woocommerce input.button:hover,
	.woocommerce #respond input#submit.alt:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce button.button.alt:hover,
	.woocommerce input.button.altm:hover,
	.woocommerce .widget_product_search form input[type='submit']:hover,
	.woocommerce .cart .coupon input.button:hover,
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
	.woocommerce .widget_price_filter .price_slider_amount .button:hover,
	.woocommerce .widget_product_search form input[type='submit']:hover,
	.woocommerce div.product form.cart .button.single_add_to_cart_button:hover,
	.woocommerce #review_form #respond .form-submit input:hover,
	.woocommerce #payment #place_order:hover,
	.woocommerce .cart input.button:hover,
	.woocommerce .button.wc-forward:hover,
	.woocommerce .quantity .plus:hover,
	.woocommerce .quantity .minus:hover
	<?php
	endif;
	?>
	{
		<?php if($theme_options["form_button_hover_background_color"]!=""): ?>
		background-color: #<?php echo $theme_options["form_button_hover_background_color"]; ?> !important;
		border-color: #<?php echo $theme_options["form_button_hover_background_color"]; ?> !important;
		<?php endif; ?>
		<?php if($theme_options["form_button_hover_text_color"]!=""): ?>
		color: #<?php echo $theme_options["form_button_hover_text_color"]; ?>;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["form_field_active_border_color"]!=""): ?>
	.search .search_input:focus,
	.woocommerce-cart table.cart td.actions .coupon .input-text#coupon_code:focus,
	.woocommerce .widget_product_search form .search-field:focus,
	.comment_form .text_input:focus,
	.comment_form textarea:focus, 
	.contact_form .text_input:focus,
	.contact_form textarea:focus
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce form .form-row input.input-text:active,
	.woocommerce form .form-row textarea:active,
	.woocommerce form .form-row input.input-text:focus,
	.woocommerce form .form-row textarea:focus,
	.woocommerce #review_form_wrapper .comment-form-comment #comment:focus
	<?php
	endif;
	?>
	{
		<?php if($theme_options["form_field_active_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-top: 1px solid #<?php echo $theme_options["form_field_active_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["date_box_color"]!="" || $theme_options["date_box_text_color"]!=""): ?>
	.comment_box .date .value
	<?php
	if(is_plugin_active('woocommerce/woocommerce.php')):
	?>
	,
	.woocommerce span.onsale,
	.cart_items_number
	<?php
	endif;
	?>
	{
		<?php if($theme_options["date_box_color"]!=""): ?>
		background-color: #<?php echo $theme_options["date_box_color"]; ?>;
		<?php endif;
		if($theme_options["date_box_text_color"]!=""): ?>
		color: #<?php echo $theme_options["date_box_text_color"]; ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["date_box_color"]!=""): ?>
	.comment_box .date .arrow_date
	{
		border-color: #<?php echo $theme_options["date_box_color"]; ?> transparent;
	}
	<?php endif;
	if($theme_options["date_box_comments_number_color"]!="" || $theme_options["date_box_comments_number_text_color"]!=""): ?>
	.comment_box .comments_number a
	{
		<?php if($theme_options["date_box_comments_number_color"]!=""): ?>
		background-color: #<?php echo $theme_options["date_box_comments_number_color"]; ?>;
		<?php endif;
		if($theme_options["date_box_comments_number_text_color"]!=""): ?>
		color: #<?php echo $theme_options["date_box_comments_number_text_color"]; ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["date_box_comments_number_color"]!=""): ?>
	.comment_box .arrow_comments
	{
		border-color: #<?php echo $theme_options["date_box_comments_number_color"]; ?> transparent;
	}
	<?php endif;
	if($theme_options["gallery_box_color"]!=""): ?>
	.gallery_box .description
	{
		background-color: #<?php echo $theme_options["gallery_box_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_text_first_line_color"]!=""): ?>
	.gallery_box h3
	{
		color: #<?php echo $theme_options["gallery_box_text_first_line_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_text_second_line_color"]!=""): ?>
	.gallery_box .description h5
	{
		color: #<?php echo $theme_options["gallery_box_text_second_line_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_hover_color"]!=""): ?>
	.gallery_box:hover .description
	{
		background-color: #<?php echo $theme_options["gallery_box_hover_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_hover_text_first_line_color"]!=""): ?>
	.gallery_box:hover h3
	{
		color: #<?php echo $theme_options["gallery_box_hover_text_first_line_color"]; ?>;
	}
	<?php endif; 
	if($theme_options["gallery_box_hover_text_second_line_color"]!=""): ?>
	.gallery_box:hover .description h5
	{
		color: #<?php echo $theme_options["gallery_box_hover_text_second_line_color"]; ?>;
	}
	<?php endif;
	if($theme_options["gallery_box_border_color"]!=""): ?>
	.gallery_box .item_details
	{
		<?php if($theme_options["gallery_box_border_color"]=="none"): ?>
		border: none;
		padding-bottom: 21px;
		<?php else: ?>
		border-bottom: 1px solid #<?php echo $theme_options["gallery_box_border_color"] ?>;
		padding-bottom: 20px;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["gallery_box_hover_border_color"]!=""): ?>
	.gallery_box:hover .item_details
	{
		<?php if($theme_options["gallery_box_hover_border_color"]=="none"): ?>
		border: none;
		padding-bottom: 20px;
		<?php else: ?>
		border-bottom: 2px solid #<?php echo $theme_options["gallery_box_hover_border_color"] ?>;
		padding-bottom: 19px;
		<?php endif; ?>
	}
	<?php endif; 
	if($theme_options["timetable_box_color"]!="" || $theme_options["timetable_box_text_color"]!=""): ?>
	.timetable .event
	{
		<?php if($theme_options["timetable_box_color"]!=""): ?>
		background-color: #<?php echo $theme_options["timetable_box_color"]; ?>;
		<?php endif;
		if($theme_options["timetable_box_text_color"]!=""): ?>
		color: #<?php echo $theme_options["timetable_box_text_color"]; ?>;
		<?php endif; ?>
	}
	<?php if($theme_options["timetable_box_text_color"]!=""): ?>
	.timetable .event a
	{
		color: #<?php echo $theme_options["timetable_box_text_color"]; ?>;
	}
	<?php endif;
	endif;
	if($theme_options["timetable_box_hover_color"]!="" || $theme_options["timetable_box_hover_text_color"]!=""): ?>
	.timetable .event.tooltip:hover,
	.timetable .event .event_container.tooltip:hover,
	.tooltip .tooltip_content
	{
		<?php if($theme_options["timetable_box_hover_color"]!=""): ?>
		background-color: #<?php echo $theme_options["timetable_box_hover_color"]; ?>;
		<?php endif;
		if($theme_options["timetable_box_hover_text_color"]!=""): ?>
		color: #<?php echo $theme_options["timetable_box_hover_text_color"]; ?>;
		<?php endif; ?>
	}
	<?php if($theme_options["timetable_box_hover_text_color"]!=""): ?>
	.timetable .event.tooltip:hover a,
	.timetable .event .event_container.tooltip:hover a,
	.tooltip .tooltip_content a
	{
		color: #<?php echo $theme_options["timetable_box_hover_text_color"]; ?>;
	}
	<?php endif;
	if($theme_options["timetable_box_hover_color"]!=""): ?>
	.tooltip .tooltip_arrow
	{
		border-color: #<?php echo $theme_options["timetable_box_hover_color"]; ?> transparent;
	}
	<?php endif; 
	endif;
	if($theme_options["timetable_box_hours_text_color"]!=""): ?>
	.timetable .hours
	{
		color: #<?php echo $theme_options["timetable_box_hours_text_color"]; ?>;
	}
	<?php endif;
	if($theme_options["timetable_box_hover_hours_text_color"]!=""): ?>
	.timetable .event.tooltip:hover .hours,
	.timetable .event .event_container.tooltip:hover .hours,
	.tooltip .tooltip_content .hours
	{
		color: #<?php echo $theme_options["timetable_box_hover_hours_text_color"]; ?>;
	}
	<?php endif;
	if($theme_options["timetable_tip_box_color"]!=""): ?>
	.tip
	{
		background-color: #<?php echo $theme_options["timetable_tip_box_color"]; ?>;
	}
	<?php endif; 
	/*if($theme_options["gallery_details_box_border_color"]!=""): ?>
	.gallery_item_details_list .details_box
	{
		<?php if($theme_options["gallery_details_box_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-top: 2px solid #<?php echo $theme_options["gallery_details_box_border_color"] ?>;
		border-bottom: 2px solid #<?php echo $theme_options["gallery_details_box_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["bread_crumb_border_color"]!=""): ?>
	.bread_crumb
	{
		<?php if($theme_options["bread_crumb_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-top: 1px solid #<?php echo $theme_options["bread_crumb_border_color"] ?>;
		border-bottom: 1px solid #<?php echo $theme_options["bread_crumb_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif;*/
	if($theme_options["accordion_tab_color"]!=""):
		$tab_color = $theme_options["accordion_tab_color"];
		$tab_icon_color = "";
		if($tab_color=="3156a3" || $tab_color=="0384ce" || $tab_color=="42b3e5")
			$tab_icon_color = "blue";
		else if($tab_color=="43a140" || $tab_color=="008238" || $tab_color=="7cba3d")
			$tab_icon_color = "green";
		else if($tab_color=="f17800" || $tab_color=="cb451b" || $tab_color=="ffa800")
			$tab_icon_color = "orange";
		else if($tab_color=="db5237" || $tab_color=="c03427" || $tab_color=="f37548")
			$tab_icon_color = "red";
		else if($tab_color=="0097b5" || $tab_color=="006688" || $tab_color=="00b6cc")
			$tab_icon_color = "turquoise";
		else if($tab_color=="6969b3" || $tab_color=="3e4c94" || $tab_color=="9187c4")
			$tab_icon_color = "violet"; ?>
	.accordion .ui-accordion-header h3
	{
		background-image: url('<?php echo get_template_directory_uri(); ?>/images/accordion/<?php echo $tab_icon_color; ?>/accordion_plus.png');
	}
	.accordion .ui-accordion-header.ui-state-hover h3
	{
		color: #<?php echo $tab_color; ?>;
	}
	.accordion .ui-accordion-header.ui-state-active
	{
		background: #<?php echo $tab_color; ?>;
		border-color: #<?php echo $tab_color; ?>;
	}
	<?php endif; 
	if($theme_options["copyright_area_border_color"]!=""): ?>
	.copyright_area
	{
		<?php if($theme_options["copyright_area_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-top: 1px solid #<?php echo $theme_options["copyright_area_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["top_hint_background_color"]!=""): ?>
	.top_hint
	{
		background-color: #<?php echo $theme_options["top_hint_background_color"]; ?>;
	}
	<?php endif;
	if($theme_options["top_hint_text_color"]!=""): ?>
	.top_hint
	{
		color: #<?php echo $theme_options["top_hint_text_color"]; ?>;
	}
	<?php endif;
	if($theme_options["page_top_border_color"]!=""): ?>
	.theme_page
	{
		<?php if($theme_options["page_top_border_color"]=="none"): ?>
		border: none;
		<?php else: ?>
		border-top: 8px solid #<?php echo $theme_options["page_top_border_color"] ?>;
		<?php endif; ?>
	}
	<?php endif;
	if($theme_options["divider_background_color"]!=""): ?>
	.wpb_separator.wpb_content_element, .vc_text_separator.wpb_content_element
	{
		border-color: #<?php echo $theme_options["divider_background_color"]; ?>
	}
	<?php endif;
	/*if($theme_options["comment_reply_button_color"]!=""): ?>
	#comments_list .reply_button
	{
		color: #<?php echo $theme_options["comment_reply_button_color"]; ?>;
	}
	<?php endif;
	if($theme_options["post_author_link_color"]!=""): ?>
	.categories li.posted_by .author,
	#comments_list .comment_details .posted_by a
	{
		color: #<?php echo $theme_options["post_author_link_color"]; ?>;
	}
	<?php endif;
	if($theme_options["contact_details_box_background_color"]!=""): ?>
	.contact_details_about
	{
		background-color: #<?php echo $theme_options["contact_details_box_background_color"]; ?>;
	}
	<?php endif;*/
	if($theme_options["header_font"]!=""): $header_font_explode = explode(":", $theme_options["header_font"]); ?>
	h1, h2, h3, h4, h5,
	.header_left a, .logo
	{
		font-family: '<?php echo $header_font_explode[0]; ?>';
	}
	<?php endif;
	if($theme_options["subheader_font"]!=""): $subheader_font_explode = explode(":", $theme_options["subheader_font"]); ?>
	blockquote,
	.sentence,
	.slider_content .subtitle,
	.gallery_box .description h5,
	.gallery_item_details_list .details_box .subheader
	{
		font-family: '<?php echo $subheader_font_explode[0]; ?>';
	}
	<?php endif; ?>
</style>