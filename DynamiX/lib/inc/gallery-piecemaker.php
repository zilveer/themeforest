<div class="slider-3d-wrap <?php echo $NV_galleryclass; ?> nv-skin">
	<div id="slider_3d">
	</div>
    <?php 
	
	$NV_galleryheight ? $NV_galleryheight = $NV_galleryheight : $NV_galleryheight = '450'; 
	
	$page_id = $post->ID;
	
	$_SESSION['piecemaker_ID'] = $page_id;
	
	$flash_array = array
	(
		'element'		=> '#slider_3d',
		'wmode'			=> 'transparent',
		'allowScript'	=> 'always',
		'src' 			=> get_template_directory_uri() .'/images/piecemaker.swf',
		'expInstall' 	=> get_template_directory_uri() .'/lib/inc/swfobject/expressInstall.swf',
		'width'			=> '100%',
		'height'		=> $NV_galleryheight,
		'cssSource'		=> get_template_directory_uri() .'/stylesheets/piecemaker.php?page_id='.$page_id,
		'xmlSource'		=> get_template_directory_uri() .'/lib/inc/piecemakerXML.php?page_id='.$page_id
	);

	wp_deregister_script('jquery-flash');	
	wp_register_script('jquery-flash',get_template_directory_uri().'/js/jquery.flash.js',false,array('jquery'));
	wp_localize_script('jquery-flash', 'JFLASH', $flash_array );
	wp_enqueue_script('jquery-flash');
	
	?> 
</div>