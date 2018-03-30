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
			<?php
				if ( isset( $_GET["ondate"] ) ) :
					$timestamp = strtotime( $_GET["ondate"] );
					$date = date( get_option( 'date_format' ), $timestamp ); ?>
					<h2 class="archive-title"><?php _e( 'Events on', 'eventorganiser' ); ?> <?php echo $date ?></h2>
				<?php else: ?>
					<h2 class="archive-title"><?php _e( 'Events Timetable', 'eventorganiser' ); ?></h2>
			<?php endif; ?>
			<p class="center"><?php _e( 'Events are ordered in a chronological sequence', 'eventorganiser' ); ?></p>

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
			<?php endif; ?>
		</div>
	</section>

<?php else: ?>

	<section>
		<div class="container">
			<div class="row-fluid">
				<div class="offset1 span8 pagebody pull-left">
			
					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h1>
						</header>

						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found for the requested archive', 'eventorganiser' ); ?></p>
						</div>
					</article>

				</div>
			</div>
		</div>
	</section>

<?php endif; ?>

<?php get_footer(); ?>