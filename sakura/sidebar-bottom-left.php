<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

<?php

ob_start();
dynamic_sidebar( 'bottom-left' );
echo '   ';
$ret=ob_get_clean();

$ret=explode('<break />', $ret);

//print_r($ret);

if (count($ret)>=2 && !trim($ret[count($ret)-1])) unset($ret[count($ret)-1]);
$ret=implode('<div class="widget_block_spred"></div>', $ret);

echo $ret;

?>
