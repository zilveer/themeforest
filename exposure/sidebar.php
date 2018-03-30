<?php

$sidebar = 'post-sidebar';

$sidebarTpl = new THB_TemplateLoader( 'frontend/sidebar', array(
	'sidebar' => $sidebar
));

$sidebarTpl->render();