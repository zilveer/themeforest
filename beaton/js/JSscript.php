<?php

$type       = of_get_option('type_background');
$image      = of_get_option('background_upload');

echo '
<script type="text/javascript">
jQuery(document).ready(function($) {';
switch ($type) {
    case "image":
        echo '
	$.backstretch("' . esc_js($image) . '");';
        break;
}
echo '	
});
</script>';



