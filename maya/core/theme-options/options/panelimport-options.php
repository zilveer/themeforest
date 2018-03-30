<?php                

$yiw_options['panelimport'] = array (
	 
    /* =================== GENERAL =================== */
    "landing" => array(    
        array( "name" => __('Panel import configuration', 'yiw'),
        	   "type" => "title",
               "showform" => false,
               'callback_save' => 'yiw_panel_configuration_save' ),
        
		array(  'type' => 'include',
				"file" => dirname(__FILE__) . '/../include/panel-import.php' )
	)
    /* =================== END GENERAL =================== */
 
);            
?>