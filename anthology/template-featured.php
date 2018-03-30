<?php
/*
 Template Name: Featured page
 */

get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		$title=get_the_title();
		$cat_id=get_opt('_featured_cat');
		$subtitle=get_post_meta($post->ID, 'subtitle_value', true);
		$slider=get_post_meta($post->ID, "slider_value", $single = true);
		$layout=get_post_meta($post->ID, 'layout_value', true);
		if($layout==''){
			$layout='right';
		}
		$sidebar=get_post_meta($post->ID, 'sidebar_value', $single = true);
		if($sidebar=='' || $sidebar=='default'){
			$sidebar='home';
		}

		include(TEMPLATEPATH . '/includes/page-header.php');

?>
<div id="content-container" class="center <?php echo $layoutclass; ?> ">
<div id="<?php echo $content_id; ?>">
<?php 
		the_content();

		}
}
query_posts(array(
      'cat' => $cat_id,
	  'posts_per_page' => -1
));


if(have_posts()){
	while(have_posts()){
		the_post();
		global $more;
		$more = 0;
		
include(TEMPLATEPATH . '/includes/post-template.php');	

	}  
}    ?>

</div>

<?php 
if($layout!='full'){
	print_sidebar($sidebar);
}
?>


</div>
<?php
get_footer();
?>
