<?php 
/**
 * Youtube style video sidebar
 */
?>

<div id="secondary" class="sidebar-container video-sidebar-container sidebar-video">
	<?php get_template_part( 'searchform', 'video' ); ?>
	<hr>
	<div class="sidebar-inner">
		<?php
		$post_id = get_the_ID();
		$category = get_the_term_list( $post_id, 'video_type', '', ',', '' );
		$tags = get_the_term_list( $post_id, 'video_tag', '', ',', '' );
		$do_not_duplicate[] = $post_id;

		$args = array(
			'post_type' => 'video',
			'post_per_page' => 10,
			'meta_key' => '_thumbnail_id',
			'ignore_sticky_posts' => 1,
			'post__not_in' => $do_not_duplicate,
			'video_type' => $category,
			'video_tag' => $tag,
		);

		$loop = new WP_Query( $args );

		if ( 10 > $loop->post_count ) {
			$args = array(
				'post_type' => 'video',
				'post_per_page' => 10,
				'meta_key' => '_thumbnail_id',
				'ignore_sticky_posts' => 1,
				'post__not_in' => $do_not_duplicate,
			);

			$loop = new WP_Query( $args );
		}

		if ( $loop->have_posts() ) {
			while( $loop->have_posts() ) {
				$loop->the_post();

				wolf_videos_get_template_part( 'content', 'video-youtube-sidebar' );
			}
		} else {
			echo '<p>';
			_e( 'No related video', 'wolf' );
			echo '</p>';
		}
		wp_reset_postdata();
		?>
	</div><!-- .sidebar-inner -->
</div><!-- #secondary .sidebar-container -->