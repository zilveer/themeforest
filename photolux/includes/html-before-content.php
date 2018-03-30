<?php
global $pex_page,$slider_data;

//set the layout variables
$layoutclass='layout-'.$pex_page->layout;

$content_id='content';
if($pex_page->layout=='full'){
	$content_id='full-width';
}elseif($pex_page->layout=='grid-full'){
	//for portfolio and other page templates when no additional stylings are needed for the div
	$content_id='grid-full-width';
}
?>

<?php
if(isset($pex_page->slider) && $pex_page->slider!='none' && $pex_page->slider!=''){
	if($pex_page->slider=='static'){
		//this is static image
		require(TEMPLATEPATH . '/includes/static-header.php');
	}else{
		//this is a slider
		$slider_data=pexeto_get_slider_data($pex_page->slider);
		require(TEMPLATEPATH . '/includes/'.$slider_data['filename']);
	}
}

$container_id=is_page_template('template-grid-gallery.php')?'full-content-container':'content-container';
?>

<div id="<?php echo $container_id; ?>" class="<?php echo $layoutclass; ?>">
<div id="<?php echo $content_id; ?>">