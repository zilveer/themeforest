<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */
 /**
*/
get_header(); ?>
<div id="page-title" class="clearfix">
	<div class="container_12">
        <div class="grid_12">
          <h1><?php the_title();?></h1>
        </div>
	</div>
</div>
    <?php if (get_option('themeteam_origami_enable_breadcrumbs') == 'true'){ ?>
	<div id="breadcrumbs" class="clearfix">
		<div class="container_12">
	    	<div class="grid_12">
			<?php 
            breadcrumbs(get_option('themeteam_origami_enable_breadcrumbs')); 
            ?>
			</div>
		</div>
	</div>
	<?php } ?>
    
    <div id="wpec_container" class="clearfix">
    <div id="container" class="clearfix">
    	<div class="container_12">
        	<div class="col2-right-layout clearfix">
          		<div class="clearfix">
            		<?php get_sidebar('wpec'); ?>
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	            		<div class="pageTemp">
			              	<div class="grid_8">
			              		<div class="clear"> </div>
			              		<article class="entry"><?php 
                            
                                the_content(''); 
                                
                                ?></article>
			              	</div>
				  			
				  			
						</div>
					<?php endwhile; endif; ?>
				</div>
      		</div>
      		<div class="clear"> </div>
    	</div>
    </div>
    </div>
    <!-- div#container end -->

<?php get_footer(); ?>