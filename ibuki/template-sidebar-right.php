<?php
/* Template Name: Sidebar Right */
?>

<?php get_header(); ?>
<?php 
$options_ibuki = get_option('ibuki'); 
$header_type = $options_ibuki['header-type'];
$header_layout = $options_ibuki['header-container'];
$header_container = null;

if($header_type == 'header-normal' || $header_type == 'header-fixed' || $header_type == 'header-sticky' ) {
    $header_container = 'container';
} else {
	$header_container = 'container-fluid';
}
?>

<div id="content">
	<?php az_page_header($post->ID); ?>
	
	<section class="wrap_content">
		<div class="content-sidebar <?php echo $header_container; ?>">
			<div class="row default-padding">
				<div class="col-md-9 page-content left_side">
					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				        <?php //edit_post_link( __('Edit', AZ_THEME_NAME), '<span class="edit-post">[', ']</span>' ); ?>
				        <?php the_content(); ?>
				        <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', AZ_THEME_NAME).'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				    <?php endwhile; endif; ?>
		    	</div>
		    	<aside class="col-md-3 page-sidebar right_side">
		    		<?php get_sidebar(); ?>
		    	</aside>
		    </div>
		</div>
	</section>
</div>

<?php get_footer(); ?>