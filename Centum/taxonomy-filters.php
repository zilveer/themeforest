<?php
/**
 * The taxonomy filters view.
 * @package WordPress
 */
get_header(); 


$layout = ot_get_option('portfolio_layout');
if ($layout == '4') { 
	get_template_part('pftpl4col'); 
} else if ($layout == '2') {
	get_template_part('pftpl');
} else {
	get_template_part('pftpl3col'); 
}

get_footer(); 

?>