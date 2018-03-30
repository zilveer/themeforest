<?php

global $mk_options;

Mk_Static_Files::addGlobalStyle("

.mk-header-toolbar
{
	background-color: {$mk_options['header_toolbar_bg']};
}	

.mk-toolbar-navigation a,
.mk-toolbar-navigation a:hover,
.mk-language-nav > a,
.mk-header-login .mk-login-link,
.mk-subscribe-link,
.mk-checkout-btn,
.mk-header-tagline a,
.header-toolbar-contact a,
.mk-language-nav > a:hover,
.mk-header-login .mk-login-link:hover,
.mk-subscribe-link:hover,
.mk-checkout-btn:hover,
.mk-header-tagline a:hover
{
	color:{$mk_options['header_toolbar_link_color']};
}



.mk-header-tagline,
.header-toolbar-contact,
.mk-header-date
{
	color:{$mk_options['header_toolbar_txt_color']};
}


.mk-header-toolbar .mk-header-social svg {
	fill:{$mk_options['header_toolbar_social_network_color']};
}

");