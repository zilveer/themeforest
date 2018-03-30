<?php // Template Name: Page With Sidebar ?>
<?php $my_sb =  get_post_meta($post->ID, 'sidebarss', 1);
if ($my_sb == ''){$sb = 'Right Sidebar';} else { $sb = $my_sb;};
$sb_pos =  get_post_meta($post->ID, 'sidebarss_position', 1);
?> 

<?php get_header() ?>
	<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<div class="container oi_container_holder_vc oi_page_sidebar">
            <div class="oi_page_holder_custom">
            	<div class="row">
                	<div class="col-md-8 <?php if ($sb_pos == "Left Sidebar"){?> col-md-push-4 col-sm-push-4 <?php }?>">
                    	<?php the_content();  ?>
                    </div>
                    <div class="col-md-4 oi_widget_area <?php if ($sb_pos == "Left Sidebar"){?> col-md-pull-8 oi_left_sb <?php };?>">
                    <?php if ( is_active_sidebar( $sb ) ) { ?>
						<?php dynamic_sidebar( $sb ); ?>
                    <?php }; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; endif; ?>
<?php  get_footer(); ?>