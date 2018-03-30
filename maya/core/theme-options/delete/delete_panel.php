<?php
	function delete_panel()
	{      
		global $prefix, $message;
    
    ?>		
<div class="wrap">            
	<div id="icon-options-general" class="icon32"><br></div>            
	
	<h2><?php _e( 'Delete Resized Images', 'yiw' ) ?></h2>

        <?php yiw_message(); ?>

        <?php
        if( isset( $_REQUEST['action'] ) && 'delete' == $_REQUEST['action'] )
            yiw_delete_images();
        ?>

        <br />
	
	<h3>Delete Resized Images</h3>
	
	<form action="?page=<?php echo $_GET['page'] ?>" method="post">
		<input type="hidden" name="action" value="delete" />
		<p>
			<?php _e( 'Click here to remove all resized images located inside the "uploads" folder. The images are been generated to show some images with a specific size.', 'yiw' ) ?><br />
			<input type="submit" value="Delete Resized Images" class="button-secondary" />
		</p> 
	</form>                             

<?php
	}
	?>