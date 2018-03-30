<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
?>

<?php 
if (!empty($atts['post_type'])):

	echo '<div class="woffie-post-creation">';

	if($atts['post_type'] == 'project') {
		$option_name = 'projects_create';
	} elseif($atts['post_type'] == 'wiki') {
		$option_name = 'wiki_create';
	} else {
		$option_name = 'post_create';
	}
	$allowed_data = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('projects_create') : '';
	if (woffice_role_allowed($allowed_data, $atts['post_type'])):

		/*
		* BACKEND SIDE :
		*/
		$hasError = woffice_frontend_proccess($atts['post_type'], true);

		/*
		 * FORM :
		 */
		woffice_frontend_render($atts['post_type'],$hasError);

	endif;

	echo '</div>';


endif;	
?>