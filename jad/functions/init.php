<?php

define('SG_TEMPLATEPATH', get_template_directory());

/* Init */
require_once SG_TEMPLATEPATH . '/functions/apperance/init.php';
require_once SG_TEMPLATEPATH . '/functions/helpers/init-helpers.php';

/* Futures */
require_once SG_TEMPLATEPATH . '/functions/futures/shortcodes.php';
require_once SG_TEMPLATEPATH . '/functions/futures/admin.php';
require_once SG_TEMPLATEPATH . '/functions/futures/tpl.php';

/* Appearance */
require_once SG_TEMPLATEPATH . '/functions/apperance/post-types.php';
require_once SG_TEMPLATEPATH . '/functions/apperance/menus.php';
require_once SG_TEMPLATEPATH . '/functions/apperance/sidebars.php';

/* Metaboxes & SG Panel */
require_once SG_TEMPLATEPATH . '/functions/modules/metaboxes.php';
require_once SG_TEMPLATEPATH . '/functions/sgpanel/sgpanel.php';

/* Widgets */
require_once SG_TEMPLATEPATH . '/functions/widgets/widgets.php';