<?php
	function install_panel()
	{      
		global $prefix, $message;
    
    ?>		
<div class="wrap">            
	<div id="icon-options-general" class="icon32"><br></div>            
	
	<h2><?php _e( 'Import/Export Theme Data', 'yiw' ) ?></h2>          
	
	<?php yiw_message(); ?>  
	
	<?php
		if( isset( $_REQUEST['action'] ) && 'import' == $_REQUEST['action'] )
			yiw_import_theme();
	?>   
	
	<br /> 
	
	<h3><?php _e( 'Import Theme Data', 'yiw' ) ?></h3>
	
	<form action="?page=<?php echo $_GET['page'] ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="import" />
		<p>
			<?php _e( 'Insert here the file that you have exported by another installation.', 'yiw' ) ?><br />
			<input type="file" name="import-file" /> <input type="submit" value="Import" class="button-secondary" /><br /> 
			<?php _e( 'Make a backup of all installation before import, because it will remove all posts and options of theme, so that you can restore if there are problems after import.', 'yiw' ) ?>
		</p> 
	</form>                     
	
	<br />                
	
	<h3>Export Theme</h3>  
	
	<form action="?page=<?php echo $_GET['page'] ?>" method="post">
		<input type="hidden" name="action" value="export" />
		<p>
			<?php _e( 'Click here to download a file with all export, that you will use to import to another installation.', 'yiw' ) ?><br />
			<input type="submit" value="Export" class="button-secondary" />
		</p> 
	</form>                             
	
	<?php //echo '<pre>', print_r( base64_encode( export_theme() ) ), '</pre>' ?>
<?php
	}
	?>