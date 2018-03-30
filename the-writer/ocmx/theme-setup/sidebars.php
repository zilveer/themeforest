<?php
// Create Dynamic Sidebars
if (function_exists('register_sidebar')) :
	register_sidebar(array("name" => "Widget Area", "id" => "widgetarea", "before_title" => '<h4 class="widgettitle">', "after_title" => '</h4>', 'before_widget' => '<div id="%1$s" class="widget column %2$s"><div class="content">', 'after_widget' => '</div></div>'));
endif;
