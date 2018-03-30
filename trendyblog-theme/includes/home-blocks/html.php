<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //extract array data
    extract($data[0]); 

?>

<div class="shortcode-content">
    <!-- Entry content -->
    <div class="entry_content">
		<?php echo do_shortcode(stripslashes($code));?>
	</div>
</div>