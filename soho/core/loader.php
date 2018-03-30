<?php

#main config
require_once("config.php");
require_once("update_parameters.php");

require_once("aq_resizer.php");

#classes
require_once("classes/admin-tabs-controls.php");
require_once("classes/admin-tabs-option-types.php");
require_once("classes/admin-tabs-list.php");
require_once("classes/css-js-generator.php");
require_once("classes/global-js-message.php");
require_once("classes/menu-walker.php");
require_once("classes/gt3_helper.php");

#all registration
require_once("registrator/admin-pages.php");
require_once("registrator/css-js.php");
require_once("registrator/css-js-demo.php");
require_once("registrator/ajax-handlers.php");
require_once("registrator/sidebars.php");
require_once("registrator/fonts.php");
require_once("registrator/misc.php");

#admin
require_once("admin/options.php");
require_once("admin/theme-settings-page.php");

#widgets
require_once("widgets/flickr.php");
require_once("widgets/posts.php");

#start pagebuilder
#require_once("plugins/gt3-pagebuilder/gt3_builder.php");

#TGM init
require_once("tgm/gt3-tgm.php");

require_once("updates-notifier.php");

?>