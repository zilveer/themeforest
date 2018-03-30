<?php
/*
Template Name: Archive
*/
?>

<?php get_header(); ?>

<div class="global_content_wrapper">

<div class="container_12">

    <div class="grid_8">
    
    	<h1 class="entry-title"><?php the_title(); ?></h1>
        
        <div class="page_archive_content_hr"></div>

		<h2 class="page_archive_subtitle"><?php _e( 'The last posts', 'theretailer' ); ?></h2>
        
        <div id="primary" class="content-area page-archive">
			<div id="content" class="site-content" role="main">
                
                <ul>

				<?php
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('posts_per_page=30'.'&paged='.$paged);				
				while ($wp_query->have_posts()) : $wp_query->the_post();
				?>
                    
                <li>
                    <span class="page_archive_date">
                        <span class="from_the_blog_date_day"><?php echo get_the_time('d', $post->ID); ?></span>
                        <span class="from_the_blog_date_month"><?php echo get_the_time('M', $post->ID); ?></span>
                    </span>
                    <div class="page_archive_items">
                        <a class="" href="<?php the_permalink() ?>"><h3><?php the_title(); ?></h3></a>	
                        <div class="comments"><?php echo get_comments_number( get_the_ID() ); ?> comments</div>
                    </div>
                </li>	
				
				<?php endwhile; // end of the loop. ?>
                
                </ul>
                
                <?php $wp_query = null; $wp_query = $temp;?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

	</div>

	<div class="grid_4">
    
		<div class="gbtr_aside_column">
			<?php 
			get_sidebar();
			?>
        </div>
        
    </div>

</div>

</div>

<?php get_template_part("light_footer"); ?>
<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>