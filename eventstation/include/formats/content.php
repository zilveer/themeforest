<?php
/*
	* The template used for displaying single content
*/
?>

<div class="category-post-list post-list single-list">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-wrapper">
			<div class="post-header">
				<?php
					$single_post_information = ot_get_option( 'single_post_information' );
					if( $single_post_information == "on" or !$single_post_information == "off" ) {
				?>
					<ul class="post-information">
						<li class="author"><i class="fa fa-user"></i> <?php echo esc_html__( 'Author:', 'eventstation' ); ?> <span><?php the_author_posts_link(); ?></span></li>
						<li class="separator">&#45;</li>
						<li class="date"><i class="fa fa-calendar-check-o"></i> <?php echo esc_html__( 'Date:', 'eventstation' ); ?> <span><?php the_time( get_option( 'date_format' ) ); ?></span></li>
					</ul>
					<?php } ?>
				<h2><?php the_title(); ?></h2>
				<?php
					$single_post_title_excerpt = ot_get_option( 'single_post_title_excerpt' );
					if( $single_post_title_excerpt == "on" or !$single_post_title_excerpt == "off" ) {
						$post_excerpt_two = get_post_meta( get_the_ID(), "excerpt_two_meta_box_text", true );
						if( !empty( $post_excerpt_two ) ) {
				?>
						<div class="post-excerpt-two">
							<?php echo esc_attr( $post_excerpt_two ); ?>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
				<?php
					$single_post_image = ot_get_option( 'single_post_image' );
					if( $single_post_image == "on" or !$single_post_image == "off" ) {
				?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-image">
						<?php the_post_thumbnail( 'eventstation-blog-list' ); ?>
						<?php
							$single_post_category_name = ot_get_option( 'single_post_category_name' );
							if( $single_post_category_name == "on" or !$single_post_category_name == "off" ) {
						?>
							<div class="category"><?php the_category( '', '' ); ?></div>
						<?php } ?>
					</div>
				<?php endif; ?>
			<?php } ?>
			<div class="post-content">
				<?php the_content(); ?>
			</div>
			<?php
				$single_post_share_buttons = ot_get_option( 'single_post_share_buttons' );
				$single_post_tags = ot_get_option( 'single_post_tags' );
				$single_post_navigation = ot_get_option( 'single_post_navigation' );
			?>
			<div class="post-bottom">
				<?php if ( $single_post_tags == "on" or !$single_post_tags == "off" ) : ?>
					<?php $tags_title = esc_html__( 'Tags:', 'eventstation' ); ?>
					<?php the_tags( '<div class="single-tag-list"><span class="single-tag-list-title">' . $tags_title . '</span><span>', '</span><span>', '</span></div>' ); ?>
				<?php endif; ?>
				<?php if( $single_post_share_buttons == "on" or !$single_post_share_buttons == "off" ) : ?>
					<?php eventstation_post_content_social_share(); ?>
				<?php endif; ?>
				<?php
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'eventstation' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
				<?php if ( $single_post_navigation == "on" or !$single_post_navigation == "off" ) { ?>
					<?php eventstation_single_nav(); ?>
				<?php } ?>
				<?php eventstation_related_posts(); ?>
			</div>
		</div>
	</article>
</div>