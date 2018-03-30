<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Blog Wide
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
		
		$postsPerPage = get_option('tb_blog_number_wide', DEFAULT_BLOG_NUMBER_WIDE);
		
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

    <?php if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>
	
    <?php $postID = get_the_ID(); ?>
    <?php $postTitle = get_the_title($postID); ?>
    <?php $postPermalink = get_permalink($postID); ?>
	
	
	<div class="news wide <?php post_class(); ?>">
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
        
        <div <?php if ($postThumbnail) { ?> class="right" <?php } ?>>
            <h3><a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a></h3>
            
        	<div class="newsInfo"><strong>Posted by</strong> <?php the_author_posts_link(); ?> <strong>under:</strong> <?php the_category(', '); ?>	</div>

			<?php the_excerpt(); ?>
            
            <div class="newsInfoDetails">
           		<div class="newsInfo numberOfComments">
				<?php
				$numComments = get_comments_number(); // get_comments_number returns only a numeric value
				
				if ( comments_open() ) {
					if ( $numComments == 0 ) {
						$comments = __('No Comments', 'the-cause');
					} elseif ( $num_comments > 1 ) {
						$comments = $numComments . __(' Comments', 'the-cause');
					} else {
						$comments = __('1 Comment', 'the-cause');
					}
					$writeComments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
					
					echo $writeComments;
				}
				
				?>
						
				</div>
            
	             <a href="<?php echo $postPermalink; ?>" title="View More" class="tinyButton roundButtonX">View</a>
            </div>
        </div>
    </div>
    
    <?php endwhile; endif; ?>
    
</div>
<!-- .News -->
		
		
	<?php kriesi_pagination($tbQuery->max_num_pages); ?>
	
    <?php wp_reset_postdata(); ?>

<?php
get_footer();
?>