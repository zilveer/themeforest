<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: The Issues Page
*/

get_header();
?>

	<?php $relatedCat = 0; ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php $postID = get_the_ID(); ?>
	<?php $postTitle = get_the_title($postID); ?>
	<?php $postPermalink = get_permalink($postID); ?>
    
    <h2><?php echo $postTitle; ?></h2>
    
    <div id="post-<?php echo $postID; ?>">
	
	<?php
	$postCustom = get_post_custom($postID);
	
	$relatedCat = $postCustom['_category'][0];
	
	$showAccordion = $postCustom['_accordion_slider'][0];
	if (!$showAccordion) $showAccordion = 'no';
	
	$numberAccordion = $postCustom['_number_of_posts_in_accordion'][0];
	if (!$numberAccordion) $numberAccordion = 4;
	
	if ($showAccordion == 'yes') {
		$argsF['post_type'] = 'post';
		$argsF['post_status'] = 'publish';
		$argsF['posts_per_page'] = $numberAccordion;
		$argsF['cat'] = $relatedCat;
		$argsF['meta_query'] = array(
			array(
				'key'	=> '_featured',
				'value'	=> 1
			)
		);
		
		$postsArrayF = array();

		$tbQueryF = new WP_Query($argsF);
		
		if ($tbQueryF->have_posts()) : while ($tbQueryF->have_posts()) : $tbQueryF->the_post();
		
			$contentF = '';
			$fID = get_the_ID();		
		    $fThumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($fID), 'gallerySlider');
			$fLink = get_permalink();
			$fTitle = '<h3>' . get_the_title() . '</h3>';
			$contentF .= '<li style="background-image: url(' . $fThumbnail[0] . ');">';
			$contentF .= '<a href="' . $fLink . '">' . $fTitle . '</a>';
			$contentF .= $fTitle;
			$contentF .= '<div class="gradient"></div>';
			$contentF .= '<div class="excerpt">';
			$contentF .= $fTitle;
			$contentF .= '<p>' . strip_shortcodes(get_the_excerpt()) . '</p>';
			$contentF .= '</div>';
			$contentF .= '</li>';

			$postsArrayF[] = $contentF;
		
		endwhile; endif;
		
		wp_reset_postdata();
		
	}
	
	?>
	
	<?php
	$numberOfFeaturedPosts = count($postsArrayF);
	
	$featuredPostsWidths = array();
	
	$featuredPostsWidths[] =  array('widthF' => 453, 'max' => 817, 'min' => 89); // 2 posts
	$featuredPostsWidths[] =  array('widthF' => 301, 'max' => 725, 'min' => 89); // 3 posts
	$featuredPostsWidths[] =  array('widthF' => 225, 'max' => 633, 'min' => 89); // 4 posts
	$featuredPostsWidths[] =  array('widthF' => 180, 'max' => 544, 'min' => 89); // 5 posts
	
	$arrayPositionF = $numberOfFeaturedPosts - 2;
	
	if ($numberOfFeaturedPosts > 1) { ?>
		<div id="issuesAccordion">
			<ul class="no<?php echo $numberOfFeaturedPosts; ?>">
			<?php
			foreach ($postsArrayF as $singleF) {
				echo $singleF;
			}
			?>
			</ul>
			
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#issuesAccordion ul').eAccordion({
						easing: 'linear',
						autoPlay: true,
						startStopped: false,
						stopAtEnd: false,	
						delay: 3000,		
						animationTime: 600,	
						hashTags: true,		
						pauseOnHover: true,	
						height: null,		
						expandedWidth: '<?php echo $featuredPostsWidths[$arrayPositionF]['max']; ?>px',
						neutralState: true
					});
				});
			</script>
	
		</div>
	<?php }	?>

    <?php the_content(); ?>
    
    <?php endwhile; endif; ?>
	
	<?php if ($relatedCat) {

		$args = array();
		
		$postsPerPage = get_post_meta($postID, '_related_articles_number', true);
		if (!$postsPerPage) $postsPerPage = 4;
		
		$args['post_type'] = 'post';
		$args['post_status'] = 'publish';
		$args['posts_per_page'] = $postsPerPage;
		$args['cat'] = $relatedCat;
		
		$tbQuery = new WP_Query($args);	
		
		$catIndex = 1;
		
		if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>

	    <?php $articleID = get_the_ID(); ?>
    	<?php $articleTitle = get_the_title($articleID); ?>
    	<?php $articlePermalink = get_permalink($articleID); ?>
		
		<?php
		if ($catIndex % 2 == 0) {
			$fClass = 'right';
		} else {
			$fClass = 'left';
			echo '<div class="issuesThumbs">';
		}
		?>

        <div class="issuesThumb <?php echo $fClass; ?>">
		    <?php $articleThumbnail = tb_get_thumbnail($articleID, 'caption', ''); ?>
		    <?php if ($articleThumbnail) { ?>
		            
		    <div class="caption">
				<a href="<?php echo $articlePermalink; ?>" title="<?php echo $articleTitle; ?>" class="thumb">
		    	<?php echo $articleThumbnail; ?>
                </a>
		    </div>
		    <?php } ?>
            
            <div>
            	<div class="cats"><?php the_category(', '); ?></div>
           		<h3><a href="<?php echo $articlePermalink; ?>" title="<?php echo $articleTitle; ?>"><?php echo $articleTitle; ?></a></h3>
    	        <p><?php echo tb_max_words(get_the_excerpt(), 20); ?>...</p>
            </div>
        </div>

		<?php
		if ($catIndex % 2 == 0) {
			echo '</div>';
		}	
		?>
			
		<?php $catIndex++; ?>

		<?php endwhile; endif; ?>

		<?php
		if ($catIndex % 2 == 0) {
			echo '</div>';
		}	
		?>
			
	<?php } ?>

    </div>

<?php
get_footer();
?>