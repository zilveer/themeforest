<?php /* Default Post Template */ ?>
<?php get_header(); ?>
<div class="oi_page_holder">
    <div class="container">
	<div class="oi_blog_single_container">
	<div class="row">
    	<div class="col-md-8">
			<?php if (!(have_posts())) { ?><h3 class="page_title">There are no posts</h3><?php }  ?>   
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="blog_item inner_post_holder">
                	<?php $format = get_post_format(); get_template_part( 'framework/post-format/single', $format );   ?>
                </div>
            <?php endwhile; endif; ?>
        </div>
        <div class="col-md-4 oi_widget_area">
			<?php if ( is_active_sidebar( 'oi_blog_sidebar' ) ) { ?>
                <?php dynamic_sidebar( 'oi_blog_sidebar' ); ?>
            <?php }; ?>
        </div>
    </div>
    </div>
</div>
</div>
<?php get_footer(); ?>