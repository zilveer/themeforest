<?php
/*
    Extension Name: Post Formats
    Version: 1.0
    Description: User interface and controls for post formats.
*/

// Optional, predefined path for extensions
define('RUNWAY_POST_FORMATS_EXT_PATH', trailingslashit(get_template_directory_uri()).'extensions/post-formats');

// Load post formats
require('post-formats.php');
