<?php 
/**
 * SMOF Modified / AllAround
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @theme AllAround
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

function of_head() { do_action( 'of_head' ); }

/**
 * Add default options upon activation else DB does not exist
 *
 * @since 1.0.0
 */
function of_option_setup()	
{
	global $of_options, $page_options, $options_machine, $page_options_machine;
	$options_machine = new Options_Machine($of_options);
	$page_options_machine = new Page_Options_Machine($page_options);

	if (!get_option(OPTIONS))
	{
		update_option(OPTIONS,$options_machine->Defaults);
	}
	if (!get_option(OPTIONS.'_default_meta'))
	{
		update_option(OPTIONS.'_default_meta',$page_options_machine->Defaults);
	}

}

/**
 * Change activation message
 *
 * @since 1.0.0
 */
function optionsframework_admin_message() { 
	
	//Tweaked the message on theme activate
	?>
	<script type="text/javascript">
	jQuery(function(){

		var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=optionsframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
		jQuery('.themes-php #message2').html(message);

	});
	</script>
<?php
	
}

/**
 * Get header classes
 *
 * @since 1.0.0
 */
function of_get_header_classes_array() 
{
	global $of_options;
	
	foreach ($of_options as $value) 
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));	
	}
	
	return $hooks;
}


/**
 * For use in themes
 *
 * @since forever
 */
$allaround_data = get_option(OPTIONS);
?>