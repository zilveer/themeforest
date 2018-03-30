<div id="op-panel" class="wrap">
	<div id="icon-options-general" class="icon32"><br></div>
	<h2><strong><?php echo op_config( 'theme_name' ); ?></strong> <?php _e( 'Settings Panel', 'openframe' ); ?></h2>
	<h2 id="op-panel-menu" class="nav-tab-wrapper"></h2>
	<form id="op-panel-content">
		<?php require_once( op_config( 'theme_op' ) . '/options.php' ); ?>		
	</form>
	<a id="op-panel-save" data-str-saved="<?php _e( 'Saved!' , 'openframe' ); ?>" data-str-saving="<?php _e( 'Wait a sec..' , 'openframe' ); ?>" class="button button-primary button-large" href="#"><?php _e( 'Save Settings' , 'openframe' ); ?></a>
</div>