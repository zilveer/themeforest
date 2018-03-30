<?php

/*
	@package WordPress
	@subpackage The Cause
*/

get_header(); ?>

<?php

$archivePrefix = 'Archive for ';

if (is_category()) { 		
	$archiveTitle = $archivePrefix . single_cat_title('', false);
} elseif (is_day()) {
	$archiveTitle = $archivePrefix . get_the_time('F jS, Y');
} elseif (is_month()){ 
	$archiveTitle = $archivePrefix . get_the_time('F, Y'); 
} elseif (is_year()) { 
	$archiveTitle = $archivePrefix . get_the_time('Y'); 
} elseif (is_tag()) { 
	$archiveTitle = $archivePrefix . single_tag_title('', false); 
} elseif (is_search()) {
	$archiveTitle = 'Search Results'; 
} elseif (is_author()) { 
	$archiveTitle = 'Author Archive';
} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
	$archiveTitle = 'Blog Archives';
} elseif(is_tax()){
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$archiveTitle = $archivePrefix . $term->name;
} else {
	$archiveTitle = get_bloginfo('name');
}

?>

<h2><?php echo $archiveTitle; ?></h2>

<!-- News -->
<div id="news">

<?php

$archiveLayout = get_option('tb_blog_layout', DEFAULT_BLOG_LAYOUT);

if ($archiveLayout == 'wide') {
	$class = 'wide';
} else {
	$class = 'narrow';
}

$itemIndex = 1;

if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php $postID = get_the_ID(); ?>
    <?php $postTitle = get_the_title($postID); ?>
    <?php $postPermalink = get_permalink($postID); ?>
	
	<?php if ($itemIndex % 3 == 1 && $class == 'narrow') {
		echo '<div class="row">';
	} ?>

	<div class="news <?php echo $class; ?>">
	<?php $postThumbnail = tb_get_thumbnail($postID, 'dfl'); ?>
	<?php if ($postThumbnail) { ?>
	        
		<div class="doubleFramed large alignleft">
			<a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>">
				<?php echo $postThumbnail; ?>
			</a>
		</div>
		
	<?php } ?>
        
        <div <?php if ($class == 'wide' && $postThumbnail) echo 'class="right"'; ?>>
        	<div class="newsInfo"><?php echo get_the_date('l, F jS, Y @ g:iA'); ?></div>
            <h3><a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a></h3>
            
			<?php the_excerpt(); ?>
            
			<?php if ($class == 'wide') { ?>
            <div class="newsInfoDetails">
           		<div class="newsInfo">
					<strong>Posted by</strong> <?php the_author_posts_link(); ?><br> 
    				<strong>Posted under:</strong> <?php the_category(', '); ?>		
				</div>
            
	             <a href="<?php echo $postPermalink; ?>" title="View More" class="tinyButton roundButtonX">View</a>
            </div>
			<?php } ?>
        </div>
    </div>
	
	<?php if ($itemIndex % 3 == 0 && $class == 'narrow') {echo '</div>';} $itemIndex++; ?>


<?php endwhile; endif;
	
if ($itemIndex % 3 != 1 && $class == 'narrow') {echo '</div>';} ?>
    
<?php wp_reset_postdata(); ?>

</div>
<!-- .News -->
	
<?php kriesi_pagination(); ?>
    

<?php
get_footer();
?>