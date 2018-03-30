<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Description Page
*/

get_header('sidebar');
?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php $postID = get_the_ID(); ?>
	<?php $postTitle = get_the_title($postID); ?>
	<?php $postPermalink = get_permalink($postID); ?>
	<?php $postContent = apply_filters('the_content', get_the_content()); ?>

    <h2><?php echo $postTitle; ?></h2>
    
    <div id="post-<?php echo $postID; ?>">
	<div>
	
	<?php
	// include Simple HTML DOM
	include(TBI . 'plugins/simple_html_dom.php');
	
	$inputHTML = str_get_html($postContent);
	
	$listOfSections = array();
	$sectionIndex = 0;
	
	foreach ($inputHTML->find('h4') as $heading) {
		$currentIndex = 'section' . $sectionIndex;
		$heading->id = $currentIndex;
		$listOfSections[] = '<a href="#' . $currentIndex . '" class="scroll">' . ucwords(strtolower($heading->plaintext)) . '</a>';
		$headerInner = $heading->innertext . '<a href="#top" class="backToTop scroll" title="back to top">back to top</a>';
		$heading->innertext = $headerInner;
		$sectionIndex++;
	}
	
	$postContent = $inputHTML;
	
	unset($inputHTML);
	
	?>

	<!-- SIDEBAR -->
	<div id="sidebar" class="<?php tb_write_bckg('sidebar'); ?>">
	
	<?php
	if (count($listOfSections) > 1) {
		echo '<ul id="listOfSections">';
		foreach ($listOfSections as $section) {
			echo '<li>' . $section . '</li>';
		}
		echo '</ul>';
	} else {
		dynamic_sidebar( 'Sidebar' );
	}
	?>
	</div>
	<!-- SIDEBAR -->
	
    <!-- INNER content -->
    <div id="inner" class="description">   


    <?php $postThumbnail = tb_get_thumbnail($postID, 'dfl'); ?>
    <?php if ($postThumbnail) { ?>
	
	<?php $imageFull = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'full'); ?>
            
    <div class="doubleFramed large alignleft">
		<a href="<?php echo $imageFull[0]; ?>" title="<?php echo $postTitle; ?>">
    	<?php echo $postThumbnail; ?>
		</a>
    </div>
    <?php } ?>
    
    <?php echo $postContent; ?>
    
    <?php endwhile; endif; ?>

    </div>

    </div>
    </div>

<?php
get_footer();
?>