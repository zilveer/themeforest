<?php
/* 
* rt-theme categories
*/
global $rt_sidebar_location, $rt_title, $rt_pagination;

$layout = get_option(RT_THEMESLUG."_blog_layout") ? get_option(RT_THEMESLUG."_blog_layout") : "one";
$term = get_queried_object();
$rt_title = isset($term->name) ? $term->name : "";
$description = isset($term->description) ? $term->description : "";
$slug = isset($term->slug) ? $term->slug : ""; 
$rt_pagination = true;

get_header();
?>
<section class="content_block_background">
	<section class="content_block clearfix">
		<section id="category-<?php echo $slug;?>" <?php post_class("content ".$rt_sidebar_location[0]); ?> >		
		<div class="row">

			<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_post_categories', array( "called_for" => "inside_content" ) ) ); ?>

			<?php if($description):?>
				<div class="row margin-b30 clearfix"> 
					<?php  echo apply_filters('the_content',($description));?> 
				</div> 
			<?php endif;?>		


			<?php if ( have_posts() ) : 
								
				do_action( "blog_post_loop", $wp_query, $layout);
				
			else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div>
		</section><!-- / end section .content -->  


		<?php get_sidebar(); ?>
	</section>
</section>

<?php get_footer(); ?>