<?php

global $mk_settings;

$body_font_backup = (!empty($mk_settings['body-font']['font-backup'])) ? ('font-family:' . $mk_settings['body-font']['font-backup'] . ';') : '';
$body_font_family = (!empty($mk_settings['body-font']['font-family'])) ? ('font-family:' . $mk_settings['body-font']['font-family'] . ';') : '';
$heading_font_family = (!empty($mk_settings['heading-font']['font-family'])) ? ('font-family:' . $mk_settings['heading-font']['font-family'] . ';') : '';
$p_font_size = (!empty($mk_settings['p-text-size'])) ? $mk_settings['p-text-size'] : $mk_settings['body-font']['font-size'];

$typekit = get_typekit_font_style();

Mk_Static_Files::addGlobalStyle("
	
	body
	{
		line-height: 20px;
		{$body_font_backup}
		{$body_font_family}
		font-size:{$mk_settings['body-font']['font-size']};
		color:{$mk_settings['body-txt-color']};
	}

	{$typekit}

	p {
		font-size:{$p_font_size}px;
		color:{$mk_settings['body-txt-color']};
		line-height:{$mk_settings['p-line-height']}px;
	}

	a {
		color:{$mk_settings['link-color']['regular']};
	}

	a:hover {
		color:{$mk_settings['link-color']['hover']};
	}


	.page-master-holder h1,
	.page-master-holder h2,
	.page-master-holder h3,
	.page-master-holder h4,
	.page-master-holder h5,
	.page-master-holder h6
	{
		font-weight:{$mk_settings['heading-font']['font-weight']};
		color:{$mk_settings['heading-color']};
	}

	h1, h2, h3, h4, h5, h6
	{
		{$heading_font_family}
	}


	input,
	button,
	textarea {
		{$body_font_family}
	}

");