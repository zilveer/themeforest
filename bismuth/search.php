<?php
/**
 * @package WordPress
 * @subpackage Bismuth Theme
 */
?>
<?php get_header(); ?>
		<?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts($query_string .'&posts_per_page=10&paged=' . $paged);
		if (have_posts()) : ?>
		
 <div class="bg" style="text-align: left">
    <div class="container">
        <div class="sixteen columns">
            <div class="headline">
                    <h2><span class="lines"><?php _e('Results for', 'LB'); ?>: <?php the_search_query(); ?></span></h2>
            </div>
        </div>
		<!-- end page-heading -->
		
        <!-- start eleven columns -->
        <div class="eleven columns blog-bg">
            
                <div <?php post_class('article'); ?>>
				
					<?php
						//get feat img
						$feat_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-post');
					?>	
				
					<?php if($feat_img) { ?>
						<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="loop-entry-thumbnail"><img src="<?php echo $feat_img[0]; ?>" alt="<?php echo the_title(); ?>" /></a>
					<?php } ?>
				
                    <h3 style="margin-bottom: 5px"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <p class="line2nd meta">
                        <?php the_time("d M Y");?> 
                        in <?php the_category(', ') ?> - 
                        <?php comments_popup_link(esc_html__('0 Comments','LB'), esc_html__('1 Comment','LB'), '% '.esc_html__('Comments','LB')); ?>
                    </p>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink();?>"><div class="button1">Continue Reading...</div></a>
                </div>
				
			<?php get_template_part('includes/pagination'); ?>
			
        </div> <!-- end eleven columns -->
        
		<?php else : ?>
        
        <header id="page-heading">
            <h1 id="archive-title"><?php _e('Results For', 'LB'); ?> "<?php the_search_query(); ?>"</h1>
        </header>
        <!-- /page-heading -->

        <div id="post" class="post clearfix">
            <?php _e('No results found for that query.', 'LB'); ?>
        </div>
			<!-- /post  -->
            
        <?php endif; ?>
        

        <div class="four columns sidebar blog-bg">
            <?php  
                dynamic_sidebar("Right sidebar");
            ?>
        </div>
        <!-- end sidebar -->
    </div>
</div>		
<?php get_footer(); ?>