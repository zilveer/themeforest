<?php
global $mk_settings;

Mk_Static_Files::addGlobalStyle("

	.mk-divider .divider-inner i
	{
		background-color: {$mk_settings['page-bg']['color']};
	}

	.mk-loader
	{
		border: 2px solid {$mk_settings['accent-color']};
	}

	.alt-title span,
	.single-post-fancy-title span,
	.portfolio-social-share,
	.woocommerce-share ul
	{
		background-color: {$mk_settings['page-bg']['color']};
	}

	.mk-side-dashboard {
		background-color:{$mk_settings['dashboard-bg']};
	}

	#sub-footer
	{
		background-color: {$mk_settings['sub-footer-bg']};
	}

");