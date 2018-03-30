<?php
/**
 * Main page page
 *
 * @package BuildPress
 */

get_header();

$sidebar = get_field( 'sidebar' );

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
						<article <?php post_class(); ?>>
							<!-- Solve Microformats error -->
							<span class="hidden  entry-title"><?php the_title(); ?></span>
							<span class="hidden  vcard  author">
								<span class="fn"><?php the_author(); ?></span>
							</span>
							<time datetime="<?php the_time( 'c' ); ?>" class="hidden  published"><?php echo get_the_date(); ?></time>
							<time class="hidden  updated"><?php the_modified_date(); ?></time>

							<div class="entry-content">
								<?php the_content(); ?>
							</div>

						</article>
						<?php
							if ( comments_open( get_the_ID() ) ) {
								comments_template( '', true );
							}
						?>
					</div><!-- /blogpost -->

					<?php
						endwhile;
					endif;
					?>

				</div>
			</main>

			<?php if ( 'none' !== $sidebar ) : ?>
				<div class="col-xs-12  col-md-3<?php echo 'left' === $sidebar ? '  col-md-pull-9' : ''; ?>">
					<div class="sidebar" role="complementary">
						<?php dynamic_sidebar( 'regular-page-sidebar' ); ?>
					</div>
				</div>
			<?php endif ?>

		</div>
	</div><!-- /container -->
</div>

<?php get_footer(); ?>