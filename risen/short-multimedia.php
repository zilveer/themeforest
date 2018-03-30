<?php
/**
 * Short Multimedia (Sermons)
 *
 * Used in loop-multimedia.php and search.php
 *
 * MODIFIED TO use download="download"
 */
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'multimedia-short' ); ?>>

	<header>

		<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

		<div class="box multimedia-header-meta">

			<div class="multimedia-time-speaker">

				<time datetime="<?php the_time( 'c' ); ?>"><?php echo risen_date_ago( get_the_time( 'U' ), 5 ); // show up to "5 days ago" but actual date if older ?></time>

				<?php
				/* translators: used between list items, there is a space after the comma */
				$speaker_list = get_the_term_list( $post->ID, 'risen_multimedia_speaker', '', __( ', ', 'risen' ) );
				if ( ! empty( $speaker_list ) ) :
				?>
				<span class="multimedia-header-meta-speaker"><?php echo sprintf( _x( 'by %s', 'multimedia speaker', 'risen'), $speaker_list ); ?></span>
				<?php endif; ?>

			</div>

			<ul class="multimedia-header-meta-icons risen-icon-list">

				<?php if ( risen_multimedia_url( $post->ID, 'video' ) ) : ?>
				<li><a href="<?php echo esc_url( add_query_arg( 'player', 'video', get_permalink() ) ); ?>" class="single-icon video-icon" title="<?php esc_attr_e( 'Video', 'risen' ); ?>"><?php _e( 'Video', 'risen' ); ?></a></li>
				<?php endif; ?>

				<?php if ( risen_multimedia_url( $post->ID, 'audio' ) ) : ?>
				<li><a href="<?php echo esc_url( add_query_arg( 'player', 'audio', get_permalink() ) ); ?>" class="single-icon audio-icon" title="<?php esc_attr_e( 'Audio', 'risen' ); ?>"><?php _e( 'Audio', 'risen' ); ?></a></li>
				<?php endif; ?>

				<?php if ( get_post_meta( $post->ID, '_risen_multimedia_text', true ) ) : ?>
				<li><a href="<?php the_permalink(); ?>" class="single-icon text-icon" title="<?php esc_attr_e( 'Read Online', 'risen' ); ?>"><?php _e( 'Read Online', 'risen' ); ?></a></li>
				<?php endif; ?>

				<?php if ( $pdf_url = risen_multimedia_url( $post->ID, 'pdf' ) ) : ?>
				<li><a href="<?php echo esc_url( risen_force_download_url( $pdf_url ) ); ?>" class="single-icon pdf-icon" title="<?php esc_attr_e( 'Download PDF', 'risen' ); ?>"><?php _e( 'Download PDF', 'risen' ); ?></a></li>
				<?php endif; ?>

				<?php if ( ( comments_open() || get_comments_number() > 0 ) && ! post_password_required() ) : // show X comments if some were posted, even if now new comments are off (unless password protected) ?>
				<li><?php comments_popup_link( _x( '0', 'comment count', 'risen' ), _x( '1', 'comment count', 'risen' ), '%', 'single-icon comment-icon', '' ); ?><?php comments_popup_link( _x( '0', 'comment count', 'risen' ), _x( '1', 'comment count', 'risen' ), '%', 'risen-icon-label', '' ); ?></li>
				<?php endif; ?>

			</ul>

			<div class="clear"></div>

		</div>

	</header>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="image-frame multimedia-short-image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'risen-post', array( 'title' => '' ) ); ?></a></div>
	<?php endif; ?>

	<div class="multimedia-short-excerpt">
		<?php the_excerpt(); ?>
	</div>

</article>
