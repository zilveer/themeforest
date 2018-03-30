<?php get_header(); ?>
<?php
global $wp_query;
$id = $wp_query->get_queried_object_id();
if(get_post_meta($id, "qode_show-sidebar", true) == ''){
		$sidebar = $qode_options['category_blog_sidebar'];
}
else{
	$sidebar = get_post_meta($id, "qode_show-sidebar", true);
}

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, "qode_page_background_color", true));
}else{
	$background_color = "";
}

?>

	<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
		<script>
		var page_scroll_amount_for_sticky = <?php echo esc_attr(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)); ?>;
		</script>
	<?php } ?>

	<?php get_template_part( 'title' ); ?>
	<?php get_template_part('slider'); ?>

<?php if(isset($qode_options['blog_style']) && ($qode_options['blog_style'] == 4)){ 
		$blog_style_class = '';
		 if($qode_options['blog_style'] == 4){
			$blog_style_class = ' blog_masonry_full_width_template';
		}?>
	<div class="full_width <?php echo esc_attr($blog_style_class)?> ">
		<div class="full_width_inner">

			<?php
			get_template_part('templates/blog/blog-structure', 'loop');
			?>

		</div>
	</div>

	<?php } else { ?>

	<div class="container"<?php qode_inline_style($background_color); ?>>
		<?php if($qode_options['overlapping_content'] == 'yes') {?>
			<div class="overlapping_content"><div class="overlapping_content_inner">
		<?php } ?>
		<div class="container_inner default_template_holder clearfix">
			<?php if(($sidebar == "default")||($sidebar == "")) : ?>
				<?php
					get_template_part('templates/blog/blog', 'structure');
				?>
			<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
				<div class="<?php if($sidebar == "1"):?>two_columns_66_33<?php elseif($sidebar == "2") : ?>two_columns_75_25<?php endif; ?> background_color_sidebar grid2 clearfix">
					<div class="column1 content_left_from_sidebar">
						<div class="column_inner">
							<?php
								get_template_part('templates/blog/blog', 'structure');
							?>
						</div>
					</div>
					<div class="column2">
						<?php get_sidebar(); ?>
					</div>
				</div>
		<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
				<div class="<?php if($sidebar == "3"):?>two_columns_33_66<?php elseif($sidebar == "4") : ?>two_columns_25_75<?php endif; ?> background_color_sidebar grid2 clearfix">
					<div class="column1">
					<?php get_sidebar(); ?>
					</div>
					<div class="column2 content_right_from_sidebar">
						<div class="column_inner">
							<?php
								get_template_part('templates/blog/blog', 'structure');
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php if($qode_options['overlapping_content'] == 'yes') {?>
			</div></div>
		<?php } ?>
	</div>

	<?php } ?>
<?php get_footer(); ?>