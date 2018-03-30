<?php get_header(); ?>
	<?php if( is_category() ) {
		$term = get_term_by( 'slug', get_query_var('category' ), 'category' ); ?>
		<div class="category-title-container">
			<h2 class="category-title"><?php single_cat_title(); ?></h2>
			<?php echo category_description(); ?>
		</div>

	<?php } elseif(is_author()) { ?>
		<?php while (have_posts()) :
			the_post(); setup_postdata($post); ?>
				<div class="author-title-container">
					<div class="author-image">
						<?php echo get_avatar( get_the_author_meta('ID') , '100');  ?>
					</div>
                    <div class="author-body">
                        <h2 class="author-name"><?php _e('written by', 'ocmx'); ?> <?php the_author(); ?></h2>
                        <p><?php the_author_meta('user_description'); ?></p>
                    </div>
				</div>
		<?php break; endwhile; rewind_posts(); ?>

	<?php }; ?>


	<ul class="post-list opacity_zero">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); setup_postdata($post);
				get_template_part("/functions/post-list");
			endwhile;
		else :
			get_template_part("/functions/post-empty");
		endif; ?>
	</ul>
	<?php motionpic_pagination("clearfix", "pagination clearfix"); ?>

<?php get_footer(); ?>