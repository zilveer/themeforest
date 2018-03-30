<?php
/**
 * Search results
 *
 * @package BuildPress
 */

get_header();

$sidebar = get_field( 'sidebar', (int) get_option( 'page_for_posts' ) );

if ( ! $sidebar ) {
	$sidebar = 'left';
}

get_template_part( 'part-main-title' );
get_template_part( 'part-breadcrumbs' );

?>
<div class="master-container">
	<div class="container">
		<div class="row">
			<main class="col-xs-12<?php echo 'left' === $sidebar ? '  col-md-9  col-md-push-3' : ''; echo 'right' === $sidebar ? '  col-md-9' : ''; ?>" role="main">
				<div class="row">

					<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
					?>
					<div class="col-xs-12">
						<article <?php post_class( 'post-inner  hentry--search' ); ?>>
							<div class="meta-data">
								<time datetime="<?php the_time( 'c' ); ?>" class="meta-data__date"><?php echo get_the_date(); ?></time>
								<span class="meta-data__author"><?php _e( 'By' , 'buildpress_wp'); ?> <?php the_author(); ?></span>
								<?php if( has_category() ) { ?><span class="meta-data__categories"><?php _e( '' , 'buildpress_wp'); ?> <?php the_category(' &bull; '); ?></span><?php } ?>
								<?php if( has_tag() ) { ?><span class="meta-data__tags"><?php _e( '' , 'buildpress_wp'); ?> <?php the_tags( '', ' &bull; ' ); ?></span><?php } ?>
								<span class="meta-data__comments"><a href="<?php comments_link(); ?>"><?php buildpress_pretty_comments_number(); ?></a></span>
							</div>
							<h2 class="hentry__title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
							<div class="hentry__content">
								<?php the_excerpt(); ?>
							</div>
							<?php if ( strlen( get_the_title() ) < 1 ) : ?>
								<a href="<?php the_permalink(); ?>"><?php _e( 'Link to this post' , 'buildpress_wp'); ?></a>
							<?php endif; ?>
							<div class="clearfix"></div>
						</article>
					</div><!-- /blogpost -->

					<?php
							endwhile;
						else :
					?>

					<div class="col-xs-12">
						<h3><?php _e( 'Sorry, no results found.' , 'buildpress_wp'); ?></h3>
					</div>

					<?php
						endif;
					?>

					<div class="col-xs-12">
						<?php get_template_part( 'part-pagination' ); ?>
					</div>

				</div>
			</main>

			<?php if ( 'none' !== $sidebar ) : ?>
				<div class="col-xs-12  col-md-3<?php echo 'left' === $sidebar ? '  col-md-pull-9' : ''; ?>">
					<div class="sidebar" role="complementary">
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					</div>
				</div>
			<?php endif ?>

		</div>
	</div><!-- /container -->
</div>

<?php get_footer(); ?>