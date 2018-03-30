<?php
/**
 * Template Name: Masonry
 *
 * A custom page template for blog page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress

 */
?>

<?php get_header(); ?>

		
	<div id="content">

            <div class="post-wrap masonrycontainer">
			<!-- grab the posts -->
			<?php 
			$args = array(
			'post_type' => 'post'
			);		
			query_posts($args); 
			global $wp_query;
			global $more; $more = 0;
			?>
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
			<div class="masonr">	
			
				<div <?php post_class('post'); ?>>
					<!-- uses the post format -->
					<?php
                        if(!get_post_format()) {                       
                            get_template_part('format', 'standard-small');
                        } else {                
                            $format = get_post_format();
                            if ($format == 'image') {get_template_part('format', 'image-small');} 
                            else if ($format == 'gallery') {get_template_part('format', 'gallery-small');}
                            else {get_template_part('format', $format);}
                        }
					?>
				</div><!-- post-->
			</div>		
		
			<?php endwhile; ?>
			</div> <!-- end content if no posts -->
			<!-- load more -->
			<?php 	if($wp_query->max_num_pages>1)	echo '<a href="#" id="load-more" >'.__('Load More','cr').'</a>';
					$temp = $wp_query; $wp_query = null; wp_reset_query(); 
			?><!-- end load more -->

			<?php else: ?>
			<?php endif; ?><!-- end posts -->
	</div>

<!-- grab footer -->
<?php get_footer(); ?>