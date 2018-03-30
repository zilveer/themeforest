<?php
/*
	* The template used for displaying none content
*/
?>

<div class="category-post-list post-list single-list">
	<article class="none-content-list clearfix">
		<div class="post-wrapper">
			<div class="post-header">
				<h2><?php echo esc_html__( 'None Content', 'eventstation' ); ?></h2>
			</div>
			<div class="post-image">
				<?php echo wp_get_attachment_link( get_the_ID(), 'full', true, true ); ?>
			</div>
			<div class="post-content">
				<div class="post-none-content">
					<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
					
						<?php $get_started_here = esc_html__( 'Get started here.', 'eventstation' ); ?>

						<p c><?php printf( esc_html__( 'Ready to publish your first post?', 'eventstation' ) . ' <a href="%s">' . esc_attr( $get_started_here ) . '</a>', admin_url( 'post-new.php' ) ); ?></p>

					<?php elseif ( is_search() ) : ?>

						<p class="text-center"><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'eventstation' ); ?></p>
						
						<div class="content-none-search">
							<?php get_search_form(); ?>
						</div>
					
					<?php else : ?>

						<p class="text-center"><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'eventstation' ); ?></p>
						<div class="content-none-search">
							<?php get_search_form(); ?>
						</div>

					<?php endif; ?>
				</div>
			</div>
		</div>
	</article>
</div>