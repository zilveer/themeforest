<?php

	$theme_settings = sleek_theme_settings();
	$loop_classes = '';

	// get display style
	if( is_home() ){
		$display_style 		= $theme_settings->posts['blog_home_display_style'];
		$blog_title 		= $theme_settings->posts['blog_home_posts_title'];
		$blog_title_above 	= $theme_settings->posts['blog_home_posts_title_above'];
	}
	if( is_archive() || is_search() ){
		$display_style = $theme_settings->posts['archive_display_style'];
	}

	$loop_classes .= ' loop-container--style-'.$display_style;
	if( $display_style == 'masonry' || $display_style == 'newspaper' ){
		$loop_classes .= ' js-loop-is-masonry';
	}

?>



<?php if (have_posts()): ?>

<div class="sleek-blog sleek-blog--style-<?php echo $display_style; ?>">

	<?php if( isset($blog_title) && $blog_title ){
		echo '<h2 style="text-align:center;">';
		if( isset($blog_title_above) && $blog_title_above ){
			echo '<span class="above">'.$blog_title_above.'</span>';
		}
		echo $blog_title;
		echo '</h2>';
	} ?>

	<div class="loop-container loop-container--wp <?php echo $loop_classes; ?>">

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'loop_item', $display_style ); ?>

		<?php endwhile; ?>

	</div>

	<?php get_template_part('pagination'); ?>

</div>

<?php endif; ?>