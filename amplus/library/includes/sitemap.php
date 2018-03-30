<?php

// find wp-load.php
$wpLoad = 'wp-load.php';
for ($i = 0; $i < 8; $i++) {
 if (file_exists($wpLoad)) {
     require_once($wpLoad);
     break;
 }
 $wpLoad = '../'.$wpLoad;
}

$exclude = isset($_GET['exclude']) ? explode(',', $_GET['exclude']) : array();

echo "<html><head><style>* { font-family: 'Courier New'; font-size: 12px; } body { width: 1000px; }</style></head></body>";
BFISEO::generateSitemapXML($exclude);
echo "</body>";