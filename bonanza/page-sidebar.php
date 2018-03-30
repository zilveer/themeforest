<?php 
/* 
Template Name: Page with Sidebar
*/ ?>
<?php get_header();?>
<?php 
global $theme_shortname;
$location = icore_get_location();   
$meta = icore_get_multimeta(array('Subheader'));
?>
<div id="entry-full">
    <div id="left">
		<div id="head-line"> 
	    <h1 class="title"><?php  the_title();  ?></h1>
		</div>
        <div class="post-full single">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post-content"> 
					<?php the_content(); ?>
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>  
				</div>  <!--  end .post-content  -->

					<?php comments_template(); ?>

			<?php endwhile; else: ?>

				<p><?php _e('Sorry, no posts matched your criteria.','Bonanza'); ?></p>

			<?php endif; ?>
            
         </div> <!--  end .post  -->
    </div> <!--  end #left  -->
<?php get_sidebar(); ?>
</div> <!--  end #entry-full  -->
<?php get_footer(); ?>
