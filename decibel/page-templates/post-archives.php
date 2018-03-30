<?php
/*
 * Template Name:  Post Archives
 */
get_header();
wolf_page_before();
?>
	<div id="primary" class="content-area">
		<main id="content" class="site-content" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				<div class="entry-content">

					<section class="archives-search col-8 centered">
						<?php get_search_form(); ?>
						<?php if ( function_exists( 'wolf_top_tags' ) )
								echo wp_kses(
									wolf_top_tags( __( 'Most used tags : ', 'wolf' ), 5 ),
									array(
										'div' => array(
											'class' => array(),
										),
										'a' => array(
											'href' => array(),
											'title' => array()
										),
									)
								);
						?>
					</section>

					<?php
					$tags = get_tags(
						array(
							'orderby' => 'name',
						)
					);
					?>
					<?php if ( $tags != array() ) : ?>

					<section class="tag-list">
						<h2>Tags</h2>
						<?php
	$html = '<ul class="post_tags">';
	foreach ( $tags as $tag ) {
		$tag_link = get_tag_link( $tag->term_id );

		$html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
		$html .= "{$tag->name}</a></li>";
	}
	$html .= '</ul>';
	echo wp_kses(
			$html,
			array(
				'ul' => array(),
				'li' => array(),
				'a' => array(
					'href' => array(),
					'title' => array()
				),
			)
		);
	?>
					</section><hr>
					<?php endif; ?>
					<section class="archives-list clearfix">
						<div class="archives-row">
							<h2><?php _e( 'Last 30 posts', 'wolf' ); ?></h2>
							<ul>
								<?php wp_get_archives( 'type=postbypost&limit=30' ); ?>
							</ul>
						</div>
						<div class="archives-row">
							<h2><?php _e( 'Archives by Month', 'wolf' ); ?></h2>
							<ul>
								<?php wp_get_archives(); ?>
							</ul>
						</div>
						<div class="archives-row">
							<h2><?php _e( 'Archives by Subject', 'wolf' ); ?></h2>
							<ul>
								<?php wp_list_categories( 'title_li=' ); ?>
							</ul>
						</div>
					</section>



				</div><!-- .entry-content -->

				<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
			</article><!-- #post -->

		</main><!-- main#content .site-content-->
	</div><!-- #primary .content-area -->
<?php
wolf_page_after();
get_footer();
?>