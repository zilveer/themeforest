<?php if(! defined('ABSPATH')){ return; }

$content_type = zget_option( '404_content_type', 'zn_404_options', false, '' );

if( 'pb_template' === $content_type ){

	get_template_part( '404', 'smart-area' );
}
else{
	get_template_part( '404', 'standard' );
}