<?php
/*
 Template Name: Portfolio Gallery
 Displays the portfolio items in a grid, separated by pages. The items can be also
 filtered by a category.
 */
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		
		//get all the settings for the portfolio page
		$page_title=get_the_title();
		$subtitle=get_post_meta($post->ID, 'subtitle_value', true);
		$intro=get_post_meta($post->ID, 'intro_value', true);
		$show_cat=get_post_meta($post->ID,'categories_value',true);
		$show_cat=$show_cat==='hide'?'false':'true';
		$show_desc=get_post_meta($post->ID,'showdesc_value',true);
		$cat_id=get_post_meta($post->ID,'postCategory_value',true);
		$post_per_page=get_post_meta($post->ID,'postNumber_value',true);
		$slider=get_post_meta($post->ID, "slider_value", $single = true);
		$slider_prefix=get_post_meta($post->ID, 'slider_name_value', true);
		if($slider_prefix=='default'){
			$slider_prefix='';
		}
		$title_link=get_post_meta($post->ID, '_title_link_value', true);
		if($title_link==''){
			$title_link='on';
		}
		$column_number=get_post_meta($post->ID, 'column_number_value', true);
		if($column_number==''){
			$column_number=3;
		}
		$order=get_post_meta($post->ID, 'order_value', true);
		$layout='full';
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
	}
}
?>

<div id="gallery">

<?php include(TEMPLATEPATH . '/includes/portfolio/portfolio-setter.php'); ?>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#gallery').portfolioSetter({
		itemsPerPage:<?php echo $post_per_page; ?>, 
		pageWidth:960,
		showCategories:<?php echo $show_cat?>,
		showDescriptions:<?php echo $show_desc?>,
		columns:<?php echo $column_number?>
		});
});

</script>	
</div>
<?php
//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
