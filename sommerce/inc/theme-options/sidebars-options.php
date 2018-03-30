<?php    
                         
$yiw_options['sidebars'] = array (         
	    
    /* =================== SIDEBARS =================== */
    'add-sidebar' => array(    
        array( 'name' => __('Sidebar Manager', 'yiw'),
        	   'type' => 'title'),
    
        array( 'name' => __('Create Sidebar', 'yiw'),
        	   'type' => 'section',
			   'effect' => 0),
        array( 'type' => 'open'),  
         
        array( 'name' => __('Sidebar name', 'yiw'),
        	   'desc' => __('Add a new sidebar.<br/><b>NB:</b> by default, there are 1 sidebar have already created: <br />- "<strong>Blog Sidebar</strong>", for Blog Template; <br />- "<strong>Home Colourful Section</strong>"; <br />- "<strong>Home Sidebar</strong>"; <br />- "<strong>Footer Row 1/2/3</strong>", for Footer.', 'yiw'),
        	   'id' => 'sidebars',
        	   'type' => 'text',
        	   'button' => 'Add Sidebar',
        	   'data' => 'array',
        	   'mode' => 'merge',
        	   'show_value' => false,
			   'std' => ''),	
        	
        array( 'type' => 'close')
    ),
	        
    'table-sidebar' => array(    
        array( 'name' => __('Sidebar created', 'yiw'),
        	   'type' => 'section',
			   'effect' => 0,
			   'show-submit' => false),
			   
        array( 'type' => 'open'),  
         
        array( 'name' => __('List sidebar created', 'yiw'),
        	   'desc' => __('Table with sidebar that you have created.', 'yiw'),
        	   'values' => 'sidebars',
        	   'label' => array( 'Sidebar', 'Sidebars' ),
        	   'type' => 'sidebar-table'),	
        	
        array( 'type' => 'close')
    )        
    /* =================== END SIDEBARS =================== */
 
);         
?>