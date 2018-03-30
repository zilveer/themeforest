<div id="widget-container">
<?php

$area = basename(__FILE__);
$area = str_replace(".php", "", $area);

dynamic_sidebar( $area );

?>
</div>
