<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Blog Columns
*/

get_header();

?>

<?php
global $post; 

$title = $post->post_title;
$postID = $post->ID;

$postCustom = get_post_custom($postID);
$relatedCat = $postCustom['_category'][0];
?>

<h2><?php echo $title; ?></h2>

<!-- News -->
<div id="news">

    
    <?php
		$args = array();
		
		$postsPerPage = get_option('tb_blog_number_3c', DEFAULT_BLOG_NUMBER_3C);
		
		$args['post_type'] = 'post';
		$args['post_status'] = 'publish';
		$args['posts_per_page'] = $postsPerPage;

		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif (get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		$args['paged'] = $paged; 
		
		if ($relatedCat) {
			$args['cat'] = $relatedCat;
		} else {
			$exclude = get_option('tb_exclude_categories');
			if (!empty($exclude)) {
				$args['cat'] = $exclude;
			}			
		}
		
		$tbQuery = new WP_Query($args);
	?>
	
	<?php $itemIndex = 1; ?>

    <?php if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>
	
    <?php $postID = get_the_ID(); ?>
    <?php $postTitle = get_the_title($postID); ?>
    <?php $postPermalink = get_permalink($postID); ?>
	
	<?php if ($itemIndex % 3 == 1) {
		echo '<div class="row">';
	} ?>
	
	<div class="news narrow <?php post_class(); ?>">
	<?php $postThumbnail = tb_get_thumbnail($postID, 'dfl'); ?>
	<?php if ($postThumbnail) { ?>
	        
		<div class="doubleFramed large alignleft">
			<span class="postDate">
				<strong><?php echo get_the_date('j'); ?></strong><br>
				<?php echo get_the_date('M'); ?>
			</span>
			<a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>">
				<?php echo $postThumbnail; ?>
			</a>
		</div>
		
	<?php } ?>
        
        <div>
            <h3><a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a></h3>
            
			<?php the_excerpt(); ?>
        </div>
    </div>
	
	<?php if ($itemIndex % 3 == 0) {echo '</div>';} $itemIndex++; ?>
    
    <?php endwhile; endif; ?>
	
	<?php if ($itemIndex % 3 != 1) {echo '</div>';} ?>
    
</div>
<!-- .News -->
		
	<?php kriesi_pagination($tbQuery->max_num_pages); ?>
	
    <?php wp_reset_postdata(); ?>
<?php
get_footer();
?>