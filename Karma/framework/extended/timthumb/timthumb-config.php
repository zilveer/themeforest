<?php
//Timthumb configuration file
//Define constant here will overwrite Timthumb default defines.
//do not edit.

//Yes, allow all sites because we do not know what external sites clients are fetching images.
define ('ALLOW_ALL_EXTERNAL_SITES', TRUE);
//Do not store resized/modified images on disk
define ('FILE_CACHE_ENABLED', false);
// Directory where images are cached. Left blank it will use the system temporary directory (which is better for security)
define ('FILE_CACHE_DIRECTORY', '');
?>