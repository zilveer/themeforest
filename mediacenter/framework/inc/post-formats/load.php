<?php
/*
    Extension Name: Post Formats
    Version: 1.0
    Description: User interface and controls for post formats.
*/

// Optional, predefined path for extensions
define('MC_POSTS_FORMAT_PATH', trailingslashit(get_template_directory_uri()).'framework/inc/post-formats');

// Load post formats
require('post-formats.php');