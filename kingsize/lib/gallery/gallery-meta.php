<?php
/**
 * @KingSize 2014
 * The PHP code for setup Theme Gallery custom fields.
 * OurWebMedia http://www.ourwebmedia.com
 **/

#-----------------------------------------------------------------#
#####################  Define Metabox Fields  #####################
#-----------------------------------------------------------------#
include_once(get_template_directory() . "/lib/meta-fields.php");

###### Generating Meta boxes #######
function gallery_meta_box() {

	global $gallery_metas,$post;
	
	echo '<style>
	#portfolio_hide_content { width: 130px !important; }
	#kingsize_portfolio_video_background { width: 80% !important; }
	#kingsize_portfolio_background { width: 80% !important; }
	#upload_image, #upload_image_thumb {width: 80% !important; }
	#kingsize_portfolio_porfolio_orderby, #kingsize_portfolio_porfolio_category, #kingsize_portfolio_slider_contents, #kingsize_portfolio_columns, #kingsize_portfolio_slider_transition_type, #kingsize_portfolio_slider_display,  #kingsize_portfolio_slider_video_background, #kingsize_portfolio_slider_controller_position, #portfolio_hide_content, #kingsize_portfolio_hide_content, #kingsize_portfolio_grid_overlay { width: 130px !important; }
	#gallery_metabox { margin-top: 25px !important; }
	</style>';

	echo '<p style="padding:10px 0 0 0;">'.__('To help eliminate common mistakes [and confusion], we\'re including an informational <em>\'How To Guide\'</em> inside our Galleries.', 'framework').'</p>';
	
	echo '<p style="padding:10px 0 0 0;">'.__('<iframe src="//player.vimeo.com/video/89083466" width="630" height="410" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>', 'framework').'</p>';
	
	echo '<p style="padding:10px 0 0 0;">'.__('You may also wish to read the <a href="'. get_template_directory_uri() .'/documentation/help.html#gallery" target="blank">Documentation</a> on using our Galleries. As well our <a href="http://bit.ly/1hjPhXZ" target="blank">Video Tutorials</a> here.', 'framework').'</p>';
	
	echo '<p style="padding:10px 0 0 0;">'.__('Although if you\'re still having troubles we encourage you to visit our <a href="http://bit.ly/1e0FkzU" target="blank">Buyer Support Forums</a> for further assistance.', 'framework').'</p>';
 
}
##### End Generating Meta boxes #######





//Add all meta fields to write up panel
function gallery_create_meta_box() {
	if ( function_exists('add_meta_box') ) {  
		add_meta_box( 'gallery_metabox', 'Kingsize Gallery Help', 'gallery_meta_box', 'galleries', 'normal', 'high' );
	}
}  

//init
add_action('admin_menu', 'gallery_create_meta_box'); 
/*
	End creating custom fields
*/