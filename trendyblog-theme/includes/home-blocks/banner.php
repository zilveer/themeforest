<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //extract array data
    extract($data[0]); 

    $contactID = df_get_page('contact', false);
   
?>
<p><?php echo do_shortcode(stripslashes($code));?></p>
