<?php 
global $avia_config;

$items_per_page = 8; 
$gallery = new masonry_gallery('masonry');
$items = $gallery->display($items_per_page);
$pagination = avia_pagination($gallery->pagecount());
if(!post_password_required())
{
	if($items)
	{
		$loading_text = __('Loading more images','avia_framework');
		$loading_stop = __('No more images available','avia_framework');
		$loading_img = AVIA_BASE_URL."images/skin-minimal/loading.gif";
	
		echo "<div class='masonry-content-area' data-loadingtext='$loading_text' data-loadingstop='$loading_stop' data-loadingimg='$loading_img' >";
		echo $items;
		echo "</div>";
		echo "<div class='masonry-pagination'>";
		if($pagination) { echo $pagination; } else { echo "<div class='pagination'></div>"; }
		echo "</div>";
	}
}
