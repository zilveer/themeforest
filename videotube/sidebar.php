<?php if( !defined('ABSPATH') ) exit;?>
<?php 
	if( is_author() ){
		get_template_part('sidebar','author');
	}
	elseif( !is_home() && !is_front_page() ){
		get_template_part('sidebar','inner');
	}
	else{
		get_template_part('sidebar','home');
	}
?>
