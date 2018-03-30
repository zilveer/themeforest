<?php
/*
 Template Name: Grid Gallery
 Displays the portfolio items in a grid, separated by pages. The items can be also
 filtered by a category.
 */
get_header();


if(have_posts()){
	while(have_posts()){
		the_post();
		
		//get all the page meta data (settings) needed (function located in lib/functions/meta.php)
		$page_settings=pexeto_get_post_meta($post->ID, array('show_filter', 'show_info', 'post_category', 'post_number', 'slider',
		'order', 'image_width', 'desaturate', 'show_back_btn_end', 'partial_loading', 'img_num_before_load'));
		
		//create a data object that will be used globally by the other files that are included
		$pex_page=new stdClass();
		$pex_page->layout='grid-full';
		$pex_page->show_title='off';
		$pex_page->slider='none';

		$page_url = get_permalink( $post->ID );
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
		wp_reset_postdata();
	}
}

//ADD THE ADDITIONAL SCRIPTS NEEDED
global $pexeto_scripts_to_print;
if($page_settings['desaturate']=='true'){
	//load the desaturation script
	$pexeto_scripts_to_print[]='pexeto-desaturate';
}

$gallery_class=$page_settings['show_filter']!='false'?'with-filter':'no-filter';
?>

<?php if($page_settings['partial_loading']=="true"){
//when partial loading is enabled for the horizontal slider, preload the images needed for the navigation, as otherwise they will be displayed after all the other images get loaded
$navigationImages = $arrayName = array("scroll-bg.png", "scroll-handle-bg.png", "preview_arrows.png");
	for($i=0; $i<sizeof($navigationImages); $i++){
		echo '<img src="'.get_template_directory_uri().'/images/'.$navigationImages[$i].'" class="preload-img"/>';
	}
} ?>
<div id="grid-gallery-wrapper" class="loading <?php echo $gallery_class; ?>">
<div id="gallery-container">

<?php 
//generate the categories in JSON format
if($page_settings['show_filter']!='false'){
	$args=array("hide_empty"=>false, "hierarchical"=>true);
	if($page_settings['post_category']!='-1'){
		$args['parent']=$page_settings['post_category'];
	}
	$cats=get_terms('portfolio_category', $args);
	$cat_arr=array();
	foreach($cats as $cat){
		$cat_arr[]=array("id"=>$cat->term_id, "name"=>$cat->name);
	}
	$cats_to_json = json_encode($cat_arr);
}else{
	$cats_to_json='[]';
}

?>
</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#grid-gallery-wrapper').pexetoGridGallery({
		"itemsPerPage":<?php echo $page_settings['post_number']; ?>, 
		"showCategories":<?php echo $page_settings['show_filter']; ?>,
		"imageWidth":<?php echo $page_settings['image_width']; ?>,
		"showInfo":<?php echo $page_settings['show_info']; ?>,
		"ajaxUrl":"<?php echo admin_url( 'admin-ajax.php' ); ?>",
		"category":<?php echo $page_settings['post_category']; ?>,
		"categories":<?php echo $cats_to_json; ?>,
		"allText":"<?php echo pex_text("_all_text"); ?>",
		"filterText":"<?php echo pex_text("_filter_text"); ?>",
		"loadMoreText":"<?php echo pex_text("_load_more_text"); ?>",
		"backText":"<?php echo pex_text("_back_to_gallery_text"); ?>",
		"orderBy":"<?php echo $page_settings['order']; ?>",
		"desaturate":<?php echo $page_settings['desaturate']; ?>,
		"showBackBtnEnd":<?php echo $page_settings['show_back_btn_end']; ?>,
		"partialLoading":<?php echo $page_settings['partial_loading']; ?>,
		"imgNumBeforeLoad":<?php echo $page_settings['img_num_before_load']; ?>,
		"infoText":"<?php echo pex_text("_info_text"); ?>",
		"pageUrl":"<?php echo $page_url; ?>"
		});
});
</script>
<?php

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
