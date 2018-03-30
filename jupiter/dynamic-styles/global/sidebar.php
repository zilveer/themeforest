<?php

global $mk_options;

$links_hover_color = !empty($mk_options['sidebar_links_hover_color']) ? $mk_options['sidebar_links_hover_color'] : $mk_options['skin_color'];

Mk_Static_Files::addGlobalStyle("

#mk-sidebar, #mk-sidebar p
{
		font-size: {$mk_options['sidebar_text_size']}px;
		color: {$mk_options['sidebar_text_color']};
		font-weight: {$mk_options['sidebar_text_weight']};
}



#mk-sidebar .widgettitle
{
		text-transform: {$mk_options['sidebar_title_transform']};
		font-size: {$mk_options['sidebar_title_size']}px;
		color: {$mk_options['sidebar_title_color']};
		font-weight: {$mk_options['sidebar_title_weight']};
}


#mk-sidebar .widgettitle a
{
		color: {$mk_options['sidebar_title_color']};
}



#mk-sidebar .widget a
{
		color: {$mk_options['sidebar_links_color']};
}

#mk-sidebar .widget:not(.widget_social_networks) a:hover 
{
	color: {$links_hover_color};
}

");