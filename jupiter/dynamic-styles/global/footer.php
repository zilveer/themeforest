<?php 

global $mk_options;

$links_hover_color = (!empty($mk_options['footer_links_hover_color'])) ? $mk_options['footer_links_hover_color'] : $mk_options['skin_color'];
$padding_wrapper = (!empty($mk_options['footer_wrapper_padding'])) ? '#mk-footer .footer-wrapper{padding:'.$mk_options['footer_wrapper_padding'].'px 0}' : '';
$border_thickness = (!empty($mk_options['footer_top_thickness'])) ? '#mk-footer{border-top:'.$mk_options['footer_top_thickness'].'px solid '.$mk_options['footer_top_border_color'].'}' : '';

Mk_Static_Files::addGlobalStyle("

{$border_thickness}
{$padding_wrapper}

#mk-footer [class*='mk-col-'] {
	padding:0 {$mk_options['footer_gutter']}%;
}

#sub-footer
{
	background-color: {$mk_options['sub_footer_bg_color']};
}

.mk-footer-copyright {
	font-size:{$mk_options['copyright_size']}px;
	letter-spacing: {$mk_options['copyright_letter_spacing']}px;
}

#mk-footer .widget
{
	margin-bottom:{$mk_options['footer_widget_margin_bottom']}px;
}

#mk-footer,
#mk-footer p
{
		font-size: {$mk_options['footer_text_size']}px;
		color: {$mk_options['footer_text_color']};
		font-weight: {$mk_options['footer_text_weight']};
}



#mk-footer .widgettitle
{
		text-transform: {$mk_options['footer_title_transform']};
		font-size: {$mk_options['footer_title_size']}px;
		color: {$mk_options['footer_title_color']};
		font-weight: {$mk_options['footer_title_weight']};
}



#mk-footer .widgettitle a
{
		color: {$mk_options['footer_title_color']};
}



#mk-footer .widget:not(.widget_social_networks) a
{
		color: {$mk_options['footer_links_color']};

}

#mk-footer .widget:not(.widget_social_networks) a:hover 
{
	color: {$links_hover_color};
}

.mk-footer-copyright, #mk-footer-navigation li a
{
	color: {$mk_options['sub_footer_nav_copy_color']};
}

");