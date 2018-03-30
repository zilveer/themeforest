<?php
/** The main template file **/
global $theme_option;
global $wp_query;

get_header();

$show_sidebar =  get_post_meta($wp_query->get_queried_object_id(), "_cmb_show_sidebar", true) ? get_post_meta($wp_query->get_queried_object_id(), "_cmb_show_sidebar", true) : 'yes';
if($show_sidebar == 'yes'){
	$main_col = 'col-sm-8 col-md-9';
	$sidebar_col = 'col-sm-4 col-md-3';
}else{
	$main_col = 'col-sm-12';
}

?>

<!-- PAGE BLOG -->
<section class="page-section with-sidebar sidebar-right">
	<div class="container">
		<div class="row">

			<!-- Content -->
			<section id="content" class="content <?php echo esc_attr($main_col); ?>">
				<?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
                            <?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>                
                        <?php endwhile; ?>
                		<?php else: ?>
                    		<h1><?php _e('Nothing Found Here!', TEXT_DOMAIN); ?></h1>
                <?php endif; ?>	    
			    
                <?php comments_template(); ?>

			</section>
			<!-- Content -->



			<?php if($show_sidebar == 'yes'){ ?>

				<hr class="page-divider transparent visible-xs"/>\
				<aside id="sidebar" class="sidebar <?php echo esc_attr($sidebar_col); ?>">
					<?php dynamic_sidebar('sidebar-right' ); ?>
				</aside>

			<?php } ?>				
			

		</div>
	</div>
</section>
<!-- /PAGE BLOG -->

<?php get_footer(); ?>
