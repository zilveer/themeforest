<?php

/*************************************************************************************
 *	Add default options after activation
 *************************************************************************************/


if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	add_action('admin_head','om_option_setup');
}

function om_option_setup(){

	$options_template = get_option(OM_THEME_PREFIX.'options_template');
	
	foreach($options_template as $option) {
		if(isset($option['id'])) {
			$db_option = get_option($option['id']);
			if(empty($db_option)){
				update_option($option['id'], $option['std']);
			}
		}
	}
	
	do_action('om_options_updated');
}


/*************************************************************************************
 *	Admin Backend Message
 *************************************************************************************/

function om_options_admin_head() { 
	
	//Tweaked the message on theme activate
	?>
  <script type="text/javascript">
  jQuery(function(){
		var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=om_options'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
  	jQuery('.themes-php #message2').html(message);
  });
  </script>
  <?php
}

add_action('admin_head', 'om_options_admin_head'); 

?>