<?php if ( !empty($support) ) : ?>
	<?php foreach( $support as $version => $file ) : ?>
		<?php if( $version <= 8 ) : ?>
			<!--[if lt IE 9]>
				<link rel="stylesheet" href="<?php echo THB_TEMPLATE_URL . '/css/' . $file . '.css'; ?>" type="text/css">
			<![endif]-->
		<?php else : ?>
			<!--[if IE <?php echo $version; ?>]>
				<link rel="stylesheet" href="<?php echo THB_TEMPLATE_URL . '/css/' . $file . '.css'; ?>" type="text/css">
			<![endif]-->
		<?php endif; ?>
	<?php endforeach; ?>
<?php else : ?>
	<?php if( file_exists(THB_TEMPLATE_DIR . '/css/ie.css') ) : ?>
		<!--[if IE]>
			<link rel="stylesheet" href="<?php echo THB_TEMPLATE_URL . '/css/ie.css'; ?>" type="text/css">
		<![endif]-->
	<?php endif; ?>
<?php endif; ?>

<!--[if lt IE 9]>
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->