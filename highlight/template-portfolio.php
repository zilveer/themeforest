<?php
/*
 Template Name: Portfolio Showcase Page
 Can be used for portfolio items with more content to them - displays the content of the item on the left
 and a list with the other items on the right.
 */
get_header();?>

<?php

if(have_posts()){
	while(have_posts()){
		the_post();
		$pageTitle=get_the_title();
		$subtitle=get_post_meta($post->ID, 'subtitle_value', true);
		$intro=get_post_meta($post->ID, 'intro_value', true);
		$catId=get_post_meta($post->ID,'postCategory_value',true);
		$postNumberToShow=get_post_meta($post->ID,'postNumber_value',true);
		$slider=get_post_meta($post->ID, "slider_value", $single = true);
		$slider_prefix=get_post_meta($post->ID, 'slider_name_value', true);
		if($slider_prefix=='default'){
			$slider_prefix='';
		}
		$order=get_post_meta($post->ID, 'order_value', true);
		$layout='full';
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
	}
}
?>



<div id="portfolio-preview-container">
<div class="loading"></div>


<?php include(TEMPLATEPATH . '/includes/portfolio/portfolio-previewer.php'); ?>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#portfolio-preview-container').portfolioPreviewer({
		itemnum:<?php echo $postNumberToShow; ?>,
		order:"<?php echo $order; ?>",
		prev:"<?php echo pex_text('_previous_text'); ?>",
		next:"<?php echo pex_text('_next_text'); ?>",
		more:"<?php echo pex_text('_more_projects_text'); ?>"
		});
});
</script>	

    </div>

<?php

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
