<?php
$d = 0; // search depth;
while (!file_exists(str_repeat('../', $d) . 'wp-load.php')) if (++$d > 99) exit;
$wp_load = str_repeat('../', $d) . 'wp-load.php';
require_once($wp_load);

global $wpdb;

$stringer_options = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options WHERE option_name REGEXP '^cb5_'");


// output the header
$filename = 'options.' . str_replace("http://","",get_option('siteurl')) . "." . date('Y-m-d') . '.xml';
header('Content-Description: File Transfer');
header("Content-Disposition: attachment; filename=$filename");
header('Content-Type: text/xml; charset=' . get_option('blog_charset'), true);

echo '<?php
';

foreach ($stringer_options as $stringer_option) {
	$opt=$stringer_option->option_value;
	$opt=str_replace("'","\'",$opt);
        echo "update_option('" . $stringer_option->option_name . "', '".$opt."');\n";
    }

echo '
?>';
?>
