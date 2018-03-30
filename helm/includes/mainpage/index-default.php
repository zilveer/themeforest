<?php
// Get stored home order - eg. 1,2,3,4,5
$sort_order= get_option('mtheme_home_order');
$sort_val = explode(",", $sort_order);
$main_count=0;

get_template_part ( 'includes/featured/featured-call');

?>
<div class="home-wrap">




<?php

for ($main_count=0; $main_count<=4; $main_count++) {
	//echo $main_count;
	if ($sort_val[$main_count]==1) {
	
		if ( of_get_option('welcome_section_status') ) {
		
			get_template_part ( 'includes/mainpage/welcome-message');
			
		}
	}
	
	if ($sort_val[$main_count]==2) {
		if ( of_get_option('fourstep_section_status') ) {
			get_template_part ( 'includes/mainpage/four-steps');
		}
	}	
	
	if ($sort_val[$main_count]==3) {
		if ( of_get_option('portfolio_section_status') ) {
			get_template_part ( 'includes/mainpage/home-portfolio');
		}
	}
	
	if ($sort_val[$main_count]==4) {
		if ( of_get_option('services_section_status') ) {
			get_template_part ( 'includes/mainpage/service-columns');
		}
	}
	
	if ($sort_val[$main_count]==5) {
		if ( of_get_option('endmsg_section_status') ) {
			get_template_part ( 'includes/mainpage/end-message');
		}
	}

}

?>


</div>