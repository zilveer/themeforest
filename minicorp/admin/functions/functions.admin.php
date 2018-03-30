<?php
/**
 * SMOF Admin
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
 

/**
 * Head Hook
 *
 * @since 1.0.0
 */
function of_head() { do_action( 'of_head' ); }

/**
 * Add default options upon activation else DB does not exist
 *
 * @since 1.0.0
 */
function of_option_setup()	
{
	global $of_options, $options_machine, $sitepress;
	$options_machine = new Options_Machine($of_options);
    $defaults = $options_machine->Defaults;

    if ( ishyoboy_wpml_plugin_active() ){

        $languages = icl_get_languages('skip_missing=0&orderby=code');
        $return = '';

        if(!empty($languages)){

            $smof_wpml_default_lng = '';
            if ( is_object( $sitepress ) ){
                $smof_wpml_default_lng = $sitepress->get_default_language();
            }

            foreach($languages as $l){
                if ( $smof_wpml_default_lng == $l['language_code'] ){
                    // DEFAULT LANGUAGE
                    if (!of_get_options())
                    {
                        of_save_options($defaults);
                        ishyoboy_generate_options_css( $defaults, GENERATEDCSS_BASE, '' );
                    }
                }
                else{
                    // OTHER LANGUAGES

                    $options = OPTIONS_BASE . '_' . $l['language_code'] ;

                    if (!of_get_options($options))
                    {
                        of_save_options($defaults, $options);
                        ishyoboy_generate_options_css( $defaults, GENERATEDCSS_BASE . '_' . $l['language_code'], '_' . $l['language_code']);
                    }
                }

            }
        }
        else{
            // DEFAULT LANGUAGE
            if (!of_get_options())
            {
                of_save_options($defaults);
                ishyoboy_generate_options_css( $defaults );
            }
        }

    }
    else{
        // JUST ONE LANGUAGE VERSION

        if (!of_get_options())
        {
            of_save_options($defaults);
            ishyoboy_generate_options_css( $defaults );
        }

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
 * Get options from the database and process them with the load filter hook.
 *
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @return array
 */
function of_get_options($key = OPTIONS) {

	$data = get_option($key);
    if ( !$data && ( $key == OPTIONS ) && (OPTIONS != OPTIONS_BASE) ){
        $data = get_option(OPTIONS_BASE);
        if (is_admin()){
            if ( $data ){
                of_save_options($data);
            }
        }
    }
	$data = apply_filters('of_options_after_load', $data);

	return $data;

}

/**
 * Save options to the database after processing them
 *
 * @param $data Options array to save
 * @author Jonah Dahlquist
 * @since 1.4.0
 * @uses update_option()
 * @return void
 */
function of_save_options($data, $key=OPTIONS)
{
    $data = apply_filters('of_options_before_save', $data);
	update_option($key, $data);
}


/**
 * For use in themes
 *
 * @since forever
 */

//$data = of_get_options();
$ish_options = of_get_options();
