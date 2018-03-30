<?php
$themename = "Delight";
$shortname = "pix";


require_once('functions/lib/pix_sidebar-generator.php');

if (!class_exists('WPAlchemy_MetaBox')) {
    include_once ('WPAlchemy/MetaBox.php');
}

require_once('functions/lib/pix_post-types.php');

require_once('functions/lib/pix_functions.php');
require_once('functions/lib/pix_admin.php');
require_once('functions/lib/pix_menu.php');
require_once('functions/lib/pix_interface.php');
require_once('functions/lib/pix_shortcodes.php');
require_once('functions/lib/pix_tinymce-buttons.php');
require_once('functions/lib/pix_widgets.php');

?>