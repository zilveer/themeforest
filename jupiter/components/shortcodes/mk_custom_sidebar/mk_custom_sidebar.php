<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );
?>

<aside id="mk-sidebar" class="<?php echo $el_class; ?>">
	<div class="sidebar-wrapper" style="padding:0;">
		<?php dynamic_sidebar( $sidebar ); ?>
	</div>
</aside>

