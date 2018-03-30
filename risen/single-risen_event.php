<?php
/**
 * Single Event Template
 */

// Header
get_header();

?>

<?php if ( risen_events_header_image( true ) ) : // show title and breadcrumb path over header image if provided ?>
<header id="page-header">
	<?php risen_events_header_image(); // show featured image from page using Upcoming or Past Events template if Theme Options allows ?>
	<?php
	$template = risen_event_parent_page_template( $post ); // Use Upcoming or Past template?
	$tpl_page = risen_get_page_by_template( $template );
	if ( ! empty( $tpl_page->post_title ) ) : // use title from page using Events template
	?>
	<h1><?php echo $tpl_page->post_title; ?></h1>
	<?php endif; ?>
	<?php risen_breadcrumbs(); ?>
</header>
<?php else : // show breadcrumbs if no header image provided ?>
<?php risen_breadcrumbs(); ?>
<?php endif; ?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'events' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header>

				<h1 id="event-single-page-title" class="page-title">
					<?php the_title(); ?>
					<?php if ( $numpages > 1 ) : ?>
					<span><?php printf( __( '(Page %s)', 'risen' ), $page, $numpages ); ?></span>
					<?php endif; ?>
				</h1>
			
				<?php if ( ! post_password_required() ) : // dont show dates, time, etc ?>
				<div id="event-single-header-meta" class="box event-header-meta">

					<div class="event-date-location">

						<?php							
						$start_date = get_post_meta( $post->ID , '_risen_event_start_date' , true );
						$end_date = get_post_meta( $post->ID , '_risen_event_end_date' , true );
						$date_format = get_option( 'date_format' );
						if ( $start_date ) :
						?>
						<span class="event-header-meta-date">
							<?php if ( $end_date != $start_date ) : // date range ?>
							<?php
							printf( __( '%s &ndash; %s', 'risen' ),
								date_i18n( $date_format, strtotime( $start_date ) ),
								date_i18n( $date_format, strtotime( $end_date ) )
							);
							?>
							<?php else : // start date only ?>
							<?php echo date_i18n( $date_format, strtotime( $start_date ) ); ?>
							<?php endif; ?>
						</span>
						<?php endif; ?>
						
						<?php							
						$time = get_post_meta( $post->ID , '_risen_event_time' , true );
						if ( $time ) :
						?>
						<span class="event-header-meta-time"><?php echo $time; ?></span>
						<?php endif; ?>
					
					</div>

					<ul class="event-header-meta-icons risen-icon-list dark">
						<?php if ( ( comments_open() || get_comments_number() > 0 ) && ! post_password_required() ) : // show X comments if some were posted, even if no new comments are off; always hide if post is protected ?>
						<li><?php comments_popup_link( __( '0 Comments', 'risen' ), __( '1 Comment', 'risen' ), __( '% Comments', 'risen' ), 'single-icon comment-icon scroll-to-comments', '' ); ?><?php comments_popup_link( __( '0 Comments', 'risen' ), __( '1 Comment', 'risen' ), __( '% Comments', 'risen' ), 'risen-icon-label scroll-to-comments', '' ); ?></li>
						<?php endif; ?>
					</ul>
					
					<div class="clear"></div>
					
				</div>
				<?php endif; ?>

			</header>
			
			<?php if ( ! post_password_required() ) : // dont map, location, etc. ?>
				
			<?php
			$google_map = risen_google_map( array(
				'latitude'	=> get_post_meta( $post->ID , '_risen_event_map_lat' , true ),
				'longitude'	=> get_post_meta( $post->ID , '_risen_event_map_lng' , true ),
				'type'		=> get_post_meta( $post->ID , '_risen_event_map_type' , true ),
				'zoom'		=> get_post_meta( $post->ID , '_risen_event_map_zoom' , true )
			) );
			if ( $google_map ) :
			?>
			<div id="event-single-map">
				<?php echo $google_map; ?>
			</div>
			<?php endif; ?>
			
			<?php
			$venue = get_post_meta( $post->ID , '_risen_event_venue' , true );
			$address = get_post_meta( $post->ID , '_risen_event_address' , true );
			if ( $venue || $address ) :
			?>
			<div id="event-single-venue-address" class="box<?php if ( $address ) : ?> event-has-address<?php endif; ?>">
			<?php endif; ?>
			
				<?php							
				if ( $venue ) :
				?>
				<div id="event-single-venue"><?php echo $venue; ?></div>
				<?php endif; ?>
			
				<?php							
				if ( $address ) :
				?>
				<div id="event-single-address">
					<?php echo nl2br( $address ); ?>			
				</div>
				<?php endif; ?>
				
				<div class="clear"></div>
				
			<?php if ( $venue || $address ) : ?>
			</div>
			<?php endif; ?>
			
			<?php endif; ?>

			<div class="post-content event-single-content"> <!-- confines heading font to this content -->
				<?php the_content(); ?>
			</div>
			
			<?php
			// multipage post nav: 1, 2, 3, etc. for when <!--nextpage--> is used in content
			if ( ! post_password_required() ) {
				wp_link_pages( array(
					'before'	=> '<div class="box multipage-nav"><span>' . __( 'Pages:', 'risen' ) . '</span>',
					'after'		=> '</div>'
				) );
			}
			?>

			<?php
			if ( get_edit_post_link( $post->ID ) ) : // admin can edit
			?>
			<footer id="event-single-footer-meta" class="box post-footer<?php echo ( get_edit_post_link() ? ' can-edit-post' : '' ); // add class if there will be an edit button ?>">				
				<?php edit_post_link( __( 'Edit Post', 'risen' ), '<span class="post-edit-link-container">', '</span>' ); // edit link for admin if logged in ?>
			</footer>
			<?php endif; ?>
			
		</article>

		<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop ?>

		<nav class="nav-left-right" id="event-single-nav">

			<?php
			$prev_next_title_characters = apply_filters( 'prev_next_title_characters', 28 ); // let child themes change this
			?>

			<?php if ( $prev_post = get_previous_post() ) : ?>
				<div class="nav-left">
					<?php
					/* translators: %s is post title */
					previous_post_link( '%link', sprintf( _x( '<span>&larr;</span> %s', 'previous post link', 'risen' ), risen_shorten( $prev_post->post_title, $prev_next_title_characters ) ) );
					?>
				</div>
			<?php endif; ?>

			<?php if ( $next_post = get_next_post() ) : ?>
				<div class="nav-right">
					<?php
					/* translators: %s is post title */
					next_post_link( '%link', sprintf( _x( '%s <span>&rarr;</span>', 'next post link', 'risen' ), risen_shorten( $next_post->post_title, $prev_next_title_characters ) ) );
					?>
				</div>
			<?php endif; ?>

			<div class="clear"></div>

		</nav>
				
	</div>

</div>

<?php risen_show_sidebar( 'events' ); ?>

<?php get_footer(); ?>