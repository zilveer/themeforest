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

        <h3 class="page-title wow fadeInDown"><?php the_archive_title(); ?></h3>
		
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
				<div class="about-author">
					<div class="about-author-avatar">
						<a href="<?php echo esc_url(get_the_author_meta('user_url' ) ); ?>">
							<?php echo get_avatar(get_the_author_meta('user_email'),$size='72',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=72' ); ?>
						</a>
					</div>
					<div class="about-author-info">
						<div class="media-heading"><h4><?php _e('About ','gather');?><a href="<?php echo esc_url(get_the_author_meta('user_url' ));?>"><?php echo get_the_author_meta('display_name');?></a></h4></div>
						<?php echo get_the_author_meta('description');?>
					</div>
					<div class="clearfix"></div>
					<div class="nav-social">
						<ul>
					    <?php if(get_user_meta(get_the_author_meta('ID'), '_cmb_twitterurl' ,true)!=''){ ?>
					    	<li><a title="<?php _e('Follow on Twitter','gather');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cmb_twitterurl' ,true)); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
					    <?php } ?>
					    <?php if(get_user_meta(get_the_author_meta('ID'), '_cmb_facebookurl' ,true)!=''){ ?>
					    	<li><a title="<?php _e('Like on Facebook','gather');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cmb_facebookurl' ,true)); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
					    <?php } ?>
					    <?php if(get_user_meta(get_the_author_meta('ID'), '_cmb_googleplusurl' ,true)!=''){ ?>
					    	<li><a title="<?php _e('Circle on Google Plus','gather');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cmb_googleplusurl' ,true)) ;?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
					    <?php } ?>
					    <?php if(get_user_meta(get_the_author_meta('ID'), '_cmb_linkedinurl' ,true)!=''){ ?>
					    	<li><a title="<?php _e('Be Friend on Linkedin','gather');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cmb_linkedinurl' ,true) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
					    <?php } ?>
					    </ul>
					</div>
					<div class="clearfix"></div>
				</div>	

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