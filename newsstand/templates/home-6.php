<?php
	/* Template Name: Home 6 */
get_header(); ?>

<?php
	$args = array('post_type'=>'post', 'posts_per_page' => 5);
	$wp_query = new WP_Query( $args );
?>
<?php if ($wp_query->have_posts()): ?>
	<style scoped>
		<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
			.post-<?php echo esc_attr($post->ID); ?> .container .valign .title a:before{
				background-color: <?php echo newsstand_cat_color($post->ID); ?>;
			}
		<?php endwhile; ?>
	</style>
	<section class="big-cat-latest-post">
		<div class="bclp-slider">
			<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
				<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
			<div <?php post_class('single'); ?> style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
				<div class="container">
					<div class="valign">
						<div class="title">
							<span class="date"><?php the_time('d'); ?><span><?php the_time('M'); ?></span></span>
							<a href="javascript:void(null);" style="background-color: <?php echo newsstand_cat_color($post->ID); ?>;">
								<?php the_title(); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		<div class="container arrows-holder"></div>
	</section>
<?php endif ?>

<?php wp_reset_query(); ?>

<?php
	$cat_args=array( 'orderby' => 'name', 'order' => 'DESC', 'number'=>6);
	$categories=get_categories($cat_args);
	$exclude = array();
	foreach ($categories as $category) { $exclude[$category->cat_ID] = $category->cat_ID; }

	$cat_args_rest=array( 'orderby' => 'name', 'order' => 'DESC', 'exclude'=>$exclude);
	$categories_rest=get_categories($cat_args_rest);
?>

<section class="category-chooser">
	<div class="container">
		<div class="cc-holder">
			<div class="a-holder">
				<?php foreach ($categories as $category): ?>
					<a href="<?php echo get_category_link( $category->cat_ID ); ?>"><?php echo esc_html($category->cat_name); ?></a>
				<?php endforeach ?>
			</div>

			<?php if (isset($categories_rest) && !empty($categories_rest)): ?>
				<a href="javascript:void(null);" class="show-more"><?php _e('More', 'newsstand'); ?></a>

				<div class="more-links">
					<?php foreach ($categories_rest as $category): ?>
						<a href="<?php echo get_category_link( $category->cat_ID ); ?>"><?php echo esc_html($category->cat_name); ?></a>
					<?php endforeach ?>
				</div>
			<?php endif ?>

		</div>
	</div>
</section>
<?php wp_reset_query(); ?>

<?php
	$cat_args=array( 'post_type' => 'post', 'orderby' => 'name', 'order' => 'DESC');
	$categories=get_categories($cat_args);
?>

<?php if (!empty($categories)): ?>

	<?php foreach ($categories as $category): ?>

		<?php
			$cat_color = Taxonomy_MetaData::get( 'category', $category->cat_ID, 'newsstand_cat_color');
			$cat_name = $category->cat_name;
			$cat_id = $category->cat_ID;
			$cat_color = Taxonomy_MetaData::get( 'category', $cat_id, 'newsstand_cat_color');
			$cat_link = get_category_link( $category->cat_ID);

			$args = array('post_type' => 'post', 'posts_per_page'=>3, 'cat'=>$category->cat_ID );
			$wp_query = new WP_Query( $args );
		?>
		<style scoped>
			.cat-<?php echo esc_attr($cat_id); ?> .valign a, .cat-<?php echo esc_attr($cat_id); ?> .valign a:before, .cat-<?php echo esc_attr($cat_id); ?> .social{
				background: <?php echo esc_attr($cat_color); ?> !important;
			}
		</style>
		<?php if ($wp_query->have_posts()): ?>

			<section class="boxed-cat-posts">
				<div class="container">
					<div class="row">

						<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>


							<?php
								$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								$post_title = get_the_title( $post->ID );
							?>
							<div class="col-md-4">
								<div <?php post_class('single cat-'.$cat_id); ?> style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
									<div class="social">
										<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
										<a href="https://twitter.com/home?status=<?php echo urlencode($post_title); ?>-<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
										<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
									</div>
									<div class="valign">
										<a href="<?php the_permalink(); ?>" class="title">
											<span class="date">
												<?php the_time('d'); ?><span><?php the_time('M'); ?></span>
											</span>

											<?php the_title(); ?>
										</a>
									</div>
								</div><!-- end of single -->
							</div><!-- end of col -->

						<?php endwhile; ?>

					</div>
				</div>
			</section>

		<?php endif ?>

	<?php endforeach ?>

<?php endif; ?>

<?php wp_reset_query(); ?>
<?php get_template_part('inc/theme/strip_text'); ?>
<?php get_footer(); ?>