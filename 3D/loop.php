<?php
/**
 * @package WordPress
 * @subpackage 3D
 * @since Idea 3D
 * Graphic Desing : Ilkay ALPGIRAY
 * Code : Mustafa TANRIVERDI
 */
?>
<?php global $wpdb;	$prefix = $wpdb->prefix; ?>

<?php if ( ! have_posts() ) : ?>  
     <!-- Blog Post List -->
     <div class="grid_17">
     	
        <!-- Blog List #1 -->
        <div class="blogsingle">
            <p></p>
            <h1>NOT FOUND</h1>
            <blockquote>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</blockquote>
            
        </div><!-- Blog List .bloglist -->
     
    </div>
<?php endif; ?>



<?php while ( have_posts() ) : the_post(); ?>

    <!-- Blog List #1 -->
    <div class="bloglist">
        <h1><?php the_title(); ?></h1>
        <span class="author-tag"><strong><?php echo get_option('im_lang_blog_author', true); ?>:</strong> <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a></span>
        <span class="time-tag"><strong><?php echo get_option('im_lang_blog_date', true); ?>:</strong> <?php echo mb_strtoupper(get_the_date(),'UTF-8'); ?></span>
        <!-- #Image & Icon -->
        <div class="bloglist-rightarea">
            <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_id())); ?>" class="fancypicture" title="<?php the_title(); ?>">
                 <?php the_post_thumbnail('category-thumb', array('class' => 'bloglist-right')); ?> 
            </a>
            <span class="clear"></span>
            <ul class="sidebar-loop-post">
                <li>
                	<?php if(get_post_meta($post->ID, 'im_theme_portfolio_iframe_url', true) != ''){  ?>
                        <a href="<?php echo get_post_meta($post->ID, 'im_theme_portfolio_iframe_url', true); ?>" class="fancylink">
                            <img src="<?php bloginfo('template_url'); ?>/image/b5.png" class="bloglist-rightarea-icon">
                        </a>
                    <?php } ?>
                    
                    <?php if(get_post_meta($post->ID, 'im_theme_portfolio_video_url', true) != '' and get_post_meta($post->ID, 'im_theme_portfolio_video_url', true) != 'http://'){  ?>
                        <a href="<?php echo get_post_meta($post->ID, 'im_theme_portfolio_video_url', true); ?>" class="fancyvideo" title="">
                            <img src="<?php bloginfo('template_url'); ?>/image/b4.png" class="bloglist-rightarea-icon">
                        </a>
                    <?php } ?>
                    
                    <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>" class="fancypicture" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_url'); ?>/image/b3.png" class="bloglist-rightarea-icon"></a> 

                    <strong><?php echo get_option('im_lang_blog_attchment', true); ?>:</strong>
                </li>
                <li><img src="<?php bloginfo('template_url'); ?>/image/b1.png" class="bloglist-rightarea-icon"> <strong><?php echo get_option('im_lang_blog_categories', true); ?>:</strong> <?php 
foreach((get_the_category(get_the_ID())) as $category) { 
    echo '<a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a> ';
} 
?></li>
                <li><img src="<?php bloginfo('template_url'); ?>/image/b2.png" class="bloglist-rightarea-icon"> <strong><?php echo get_option('im_lang_blog_tags', true); ?>:</strong> <?php
				$posttags = get_the_tags();
				if ($posttags) {
				  foreach($posttags as $tag) {
					echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a> ';
				  }
				}
			?></li>
            </ul>
        </div> <!-- /.bloglist-rightarea -->
        <p><?php echo get_the_content(''); ?></p>
        
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="More3d bloglist-button-right"><?php echo get_option('im_lang_blog_more', true); ?></a>           
        <span class="clear"></span>
    </div><!-- Blog List .bloglist -->
    
<?php endwhile; ?>



<!-- Page Navi -->
	<div class="page-navi">
		<?php
        // category navigation
        $catID = the_category_ID(false);
        $query_sort = mysql_query("SELECT * FROM ".$prefix."term_relationships, ".$prefix."posts WHERE 
        ".$prefix."term_relationships.term_taxonomy_id='$catID' 
        AND ".$prefix."posts.ID=".$prefix."term_relationships.object_id	
        AND ".$prefix."posts.post_status='publish'");
        $post_count = mysql_num_rows($query_sort);
        
        $query_posts_per_page = mysql_query("SELECT * FROM ".$prefix."options WHERE option_name='posts_per_page'");
        while($list_posts_per_page = mysql_fetch_assoc($query_posts_per_page))
        {
           $posts_per_page = $list_posts_per_page['option_value'];
        }
        
        $numberOfPages = ceil($post_count / $posts_per_page);
		if($numberOfPages > 1)
		{
			for($i = 1; $i <= $numberOfPages; $i++)
			{ ?>
				<a href="?cat=<?php echo $catID; ?>&paged=<?php echo $i; ?>" class="More3d pagenavi"><?php echo $i; ?></a>
			<?php } $i = $i - 1; ?>
			<?php if($_GET['paged'] > 1) { ?>
			<a href="?cat=<?php echo $catID; ?>&paged=<?php echo ($_GET['paged'] - 1); ?>" class="More3d pagenavi"> < </a>
			<?php } if ($_GET['paged'] != $i) { ?>
			<a href="?cat=<?php echo $catID; ?>&paged=<?php if($_GET['paged'] == 0){echo $_GET['paged'] + 2;} else {echo $_GET['paged'] + 1;} ?>" class="More3d pagenavi"> > </a>
			<?php } ?>
         <?php } ?>
	</div> <!-- /.page-navi -->
