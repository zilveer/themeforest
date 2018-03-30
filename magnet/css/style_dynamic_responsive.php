<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
?>

@media only screen and (min-width: 500px) and (max-width: 792px){
	<?php if (!empty($qode_options_magnet['parallax_minheight'])) { ?>
	.parallax section{
		min-height: <?php echo $qode_options_magnet['parallax_minheight']; ?>px;
	}
	<?php } ?>

	h1{
		<?php if($qode_options_magnet['h1_fontsize'] != ""){?>
		font-size: <?php echo $qode_options_magnet['h1_fontsize']*0.85;  ?>px;
		<?php } ?>
		<?php if($qode_options_magnet['h1_lineheight'] != ""){?>
		line-height: <?php echo $qode_options_magnet['h1_lineheight']*0.85;  ?>px;
		<?php } ?>
	}
	
}

@media only screen and (max-width: 500px){

	<?php if (!empty($qode_options_magnet['parallax_minheight'])) { ?>
	.parallax section{
		min-height: <?php echo $qode_options_magnet['parallax_minheight']; ?>px;
	}
	<?php } ?>
	
	h1{
		<?php if($qode_options_magnet['h1_fontsize'] != ""){?>
		font-size: <?php echo $qode_options_magnet['h1_fontsize']*0.7;  ?>px;
		<?php } ?>
		<?php if($qode_options_magnet['h1_lineheight'] != ""){?>
		line-height: <?php echo $qode_options_magnet['h1_lineheight']*0.7;  ?>px;
		<?php } ?>
	}

}