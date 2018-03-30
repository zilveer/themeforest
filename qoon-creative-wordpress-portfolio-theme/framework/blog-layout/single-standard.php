<div class="oi_page_holder">
<?php $pp = get_option( 'page_for_posts' )?>
<div class="container">
	<div class="row">
    	<div class="col-md-12">
        <?php echo qoon_breadcrumbs()?>
        </div>
    </div>
    <div class="row">
        <div class="<?php if (get_post_meta($pp, 'sidebarss_position', 1) =='Disabled'){echo 'col-md-12';}elseif(get_post_meta($pp, 'sidebarss_position', 1) =='Right Sidebar'){echo 'col-md-8';}else{echo 'col-md-8 col-md-push-4';};?>">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php $format = get_post_format(); get_template_part( 'framework/post-format/single', $format );   ?>
            <div class="clearfix"></div>
            <div class="single_post_bottom_sidebar_holder">
                <?php comments_template(); ?>
            </div>
            <?php endwhile; endif; ?>
        </div>
        <?php if (get_post_meta($pp, 'sidebarss_position', 1) !='Disabled'){?>
            <div class="<?php if (get_post_meta($pp, 'sidebarss_position', 1) =='Right Sidebar'){echo 'col-md-4 right_sb';}else{echo 'col-md-4 col-md-pull-8 left_sb';}?>">
                <div class="widget_area">
                    <?php dynamic_sidebar( get_post_meta($pp, 'sidebarss', 1) ); ?>
                </div>
        	</div>
		<?php };?>
    </div>
</div>
</div>