<?php

function theme_analytics_options()
{
	$options = dt_get_theme_options();
   
	if ( empty( $options['ga_code'] ) ) {
		$options['ga_code'] = '';
	}
   
   theme_header();
?>

         <fieldset>
            <legend>Google analytics code</legend>

            <textarea name="<?php echo LANGUAGE_ZONE; ?>_theme_options[ga_code]" style="width: 100%; height: 100px;"><?php echo $options['ga_code']; ?></textarea>
            
            </fieldset>

<?php
   theme_footer();
}

?>
