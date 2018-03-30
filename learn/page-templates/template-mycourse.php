<?php
/**
 * Template Name: My Courses
 */
get_header(); ?>

<div class="courses-list my-course">
	<div class="container">
		<?php learn_breadcrumbs(); ?>
	    <div class="row">

	    	<aside class="col-lg-3 col-md-4 col-sm-4">
                <div class="box_style_1">
                    <?php dynamic_sidebar( 'sidebar-course' ); ?>
                </div>
            </aside>
            <div class="col-lg-9 col-md-8 col-sm-8">
	                       
	            <?php while (have_posts()) : the_post()?>
	            
	                <?php the_content(); ?>

	                <?php wp_link_pages(); ?>
	                
	            <?php endwhile; ?>

	        </div>

	    </div>
	</div>
</div>
<!-- content close -->
<?php get_footer(); ?>