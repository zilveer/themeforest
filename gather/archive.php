<?php
/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

global $cththemes_options;

get_header();

?>
<!-- 
 Sub Header - for inner pages
 ====================================== -->

<header id="top" class="sub-header">
    <div class="container">

        <h3 class="page-title wow fadeInDown"><?php the_archive_title() ;?></h3>
		
        <?php gather_breadcrumbs();?>


    </div>
    <!-- end .container -->
</header>
<!-- end .sub-header -->

<div class="container">
    <div class="row">
    	<?php if($cththemes_options['blog_layout']==='left_sidebar'):?>
			<div class="col-md-3 left-sidebar">
				<div class="sidebar">
	    			<?php get_sidebar(); ?>
	    		</div>
			</div>
		<?php endif;?>
		<?php if($cththemes_options['blog_layout']==='fullwidth'):?>
		<div class="col-md-12">
		<?php else:?>
		<div class="col-md-9">
		<?php endif;?>
            <div id="post" class="post-wrap">
						
				<?php if(have_posts()) : 
					?>
					<?php while(have_posts()) : the_post(); ?>
						
						<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>
					
					<?php endwhile; ?>

				<?php else: ?>

					<?php get_template_part('content','none' ); ?>

				<?php endif; ?> 

				<?php gather_pagination(__('«','gather'),__('»','gather'));?>
            </div>

        </div>
        <!--// col md 9-->
		<?php if($cththemes_options['blog_layout']==='right_sidebar'):?>
        <!--Blog Sidebar-->
        <div class="col-md-3 right-sidebar">

            <div class="sidebar">
                <?php 
    				get_sidebar(); 
    			?>
            </div>

        </div>
    	<?php endif;?>

    </div>
</div>

<?php
get_footer(); 