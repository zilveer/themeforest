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
dynamic_sidebar( 'primary-widget-area' );
$ret=ob_get_clean();



if (!$ret)
{
   ob_start();
   $ret=array('widget_sakura_Search', 'widget_sakura_Popular', 'sakura_widget_quickflickr', 'widget_sakura_Cats', 'widget_sakura_Ads');
   global $left_block_args;
   foreach ($ret as $v)
   {
      $v($left_block_args);
      echo '<break />';
   }
   $ret=ob_get_clean();
}

//$ret=explode('<break />', $ret);
//unset($ret[count($ret)-1]);
//$ret=implode('<div class="rc_spread"></div>', $ret);
//$ret=implode('', $ret);

echo $ret;

?>
