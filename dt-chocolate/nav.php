<?php
dt_menu( array(
	'menu_wraper' 		=> '<div class="nav"><ul id="%MENU_ID%">%MENU_ITEMS%</ul></div>',
    'menu_items'		=> '<li class="%ITEM_CLASS%"><a href="%ITEM_HREF%" %ESC_ITEM_TITLE%>%ITEM_TITLE%</a>%SUBMENU%</li>',
	'submenu' 			=> '<div><ul class="children">%ITEM%</ul><i></i></div>',
	'location'			=> 'primary',
	'menu_id'			=> 'nav',
	'depth'				=> 3
) );
