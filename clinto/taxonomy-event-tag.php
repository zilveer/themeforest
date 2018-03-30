<?php
/**
 * The template for displaying lists of events
 *
 * Queries to do with events will default to this template if a more appropriate template cannot be found
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. 
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */

//Call the template header
?>

<?php get_header(); ?>

<?php get_template_part( 'partials/primary-nav' ); ?>

<?php if ( have_posts() ) : ?>

	<!-- White Strip -->
	<div class="navbar secondary-nav" >
		<div class="navbar-inner">

			<hr class="sexy_line">
			<h2 class="archive-title"><?php	printf( single_cat_title( '', false ) ); ?></h2>

			<!---- If the tag has a description display it-->
			<?php echo '<p class="category-archive-meta center">' . __( 'Event Tag Archives', 'eventorganiser' ) . '</p>'; ?>
		</div>
	</div>

	<section >
		<div class="container">

			<?php get_template_part( 'partials/loop-events' ); ?>

			<!-- Navigate between pages-->
			<?php 
				if ( $wp_query->max_num_pages > 1 ) : ?>
					<ul class="pager">
						<li><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Later events' , 'eventorganiser' ) ); ?></li>
						<li><?php previous_posts_link( __( 'Newer events <span class="meta-nav">&rarr;</span>', 'eventorganiser' ) ); ?></li>
					</ul>
				<?php
				endif; 
			?>
		</div>
	</section>

<?php else: ?>

	<section >
		<div class="container">

			<div class="row-fluid">
				<div class="offset2 span8">
			
					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found for the requested archive', 'eventorganiser' ); ?></p>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				</div>
			</div>
		</div>
	</section>

<?php endif; ?>

<?php get_footer(); ?>