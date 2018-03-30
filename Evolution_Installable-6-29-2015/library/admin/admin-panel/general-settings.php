<?php
function alc_adminpanel_scripts($hook) {
	
	if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'adminpanel') {
		// JAVASCRIPT
		wp_enqueue_script('r-colorpicker', get_template_directory_uri() . '/library/admin/js/colorpicker.js', array('jquery'), '1.0.0');
	}
}

add_action('admin_enqueue_scripts', 'alc_adminpanel_scripts');

function adminpanel() {
	
	global $theme_name, $shortname, $options;
?>

<div id="header">
	<div id="logo-container">
		<h1><img src="<?php echo get_template_directory_uri()?>/library/admin/images/main_logo.png" alt="Evolution" /></h1>		
	</div>	
    <div id="admin-panel">
    	<p>Administration Panel</p>
       
    </div>       
    <div class="clear"></div>
</div>
<div class="wrap alc_wrap">
	<div class="alc_opts">
		<div id="messages">
			<?php
            $upload_tracking = get_option('alc_tracking');
            if (!empty($upload_tracking)) {
                foreach($upload_tracking as $array) {
                    if (array_key_exists('error', $array)) {
                        echo '<div class="error-message"><p><strong>' . $array['upload_name'] . '</strong> - ' . $array['error'] . '</p></div>';
                    }
                }
            }
            delete_option('alc_tracking');
            if (isset($_REQUEST['saved'])) echo '<div class="success-message"><p>Settings successfully saved</p></div>'; 
            ?>
		</div>
		<form method="post" id="post" enctype="multipart/form-data">
			<div id="vtabs1">
				<div>
					<ul>
			  		<?php
						foreach($options as $value) 
						{
							if (isset($value['tab_name'])) 
							{
								echo '<li><a href="#'.$value['tab_id'].'" id="'.$value['tab_id'].'"><span>' . $value['tab_name'] . '</span></a></li>' . "\n";
							}
						} 
					?>
					</ul>
				</div>
				<div>
					<?php adminpanel_contructor($options); ?>
				</div>	  	
			</div>
		
			<div id="footer-block">
            	<input name="save" type="submit" value="Save changes"  />
            	<input type="hidden" name="caction" value="save" />
        	</div>
        </form>
	</div>
</div>
<?php } ?>