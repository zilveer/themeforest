<?php
/**
 * Single Multimedia Item Template
 */

global $wp_embed;

// Get media URLs
$video_url = risen_multimedia_url( $post->ID, 'video' );
$audio_url = risen_multimedia_url( $post->ID, 'audio' );
$pdf_url = risen_multimedia_url( $post->ID, 'pdf' );

// Players
$video = risen_video( $video_url );
$video_player = ! empty( $video['embed_code'] ) ? $video['embed_code'] : '';
$audio_player = do_shortcode( $wp_embed->shortcode( array(), $audio_url ) );

// Player request (?player=audio or ?player=video)
// Optionally show and scroll to a specific player
$player_request = '';
if (
	isset( $_GET['player'] ) // query string is requesting a specific player
	&& (
		( 'video' == $_GET['player'] && $video_player )		// request is for video player and video player exists
		|| ( 'audio' == $_GET['player'] && $audio_player )	// request is for audio player and audio player exists
	)
) {
	$player_request = $_GET['player'];
}

// Determine which player to show
$show_player = '';
if ( $player_request ) {
	$show_player = $player_request;
} elseif ( $video_player ) {
	$show_player = 'video';
} elseif ( $audio_player ) {
	$show_player = 'audio';
}

// Scroll to player requested, if any
if ( $player_request ) {

	add_action( 'wp_footer', 'risen_sermon_player_scroll' );

	function risen_sermon_player_scroll() {

echo <<< HTML
<script>
jQuery(document).ready(function($) {
	$.smoothScroll({
		scrollTarget: '#multimedia-single-media-player',
		offset: -60,
		easing: 'swing',
		speed: 800
	});
});
</script>
HTML;

	}

}

// Header
get_template_part( 'header', 'multimedia-archive')

?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'multimedia' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header>

				<h1 id="multimedia-single-page-title" class="page-title">
					<?php the_title(); ?>
					<?php if ( $numpages > 1 ) : ?>
					<span><?php printf( __( '(Page %s)', 'risen' ), $page, $numpages ); ?></span>
					<?php endif; ?>
				</h1>

				<div id="multimedia-single-header-meta" class="box multimedia-header-meta">

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

					<ul class="multimedia-header-meta-icons risen-icon-list dark">
						<?php if ( ( comments_open() || get_comments_number() > 0 ) && ! post_password_required() ) : // show X comments if some were posted, even if no new comments are off; always hide if post is protected ?>
						<li><?php comments_popup_link( __( '0 Comments', 'risen' ), __( '1 Comment', 'risen' ), __( '% Comments', 'risen' ), 'single-icon comment-icon scroll-to-comments', '' ); ?><?php comments_popup_link( __( '0 Comments', 'risen' ), __( '1 Comment', 'risen' ), __( '% Comments', 'risen' ), 'risen-icon-label scroll-to-comments', '' ); ?></li>
						<?php endif; ?>
					</ul>

					<div class="clear"></div>

				</div>

			</header>

			<?php // video and/or audio player
			if ( $show_player && ! post_password_required() ) : // we have video or audio and post is not password protected
			?>
			<div id="multimedia-single-media-player">

				<?php if ( 'video' == $show_player ) : ?>
					<?php echo $video_player; // has container with classes .video-container and .youtube-video (or .vimeo-video) ?>
				<?php endif; ?>

				<?php if ( 'audio' == $show_player ) : ?>
					<div class="audio-container">
						<?php echo $audio_player; ?>
					</div>
				<?php endif; ?>

				<div class="clear"></div>

			</div>
			<?php endif; ?>

			<?php // show media options if there is more than one
			$media_options = 0;
			$media_options += $video_url ? 1 : 0;
			$media_options += $audio_url ? 2 : 0; // 2 because it can be played or downloaded
			$media_options += $pdf_url ? 1 : 0;
			if ( ( $media_options > 1 || $pdf_url ) && ! post_password_required() ) : // don't show if post is password protected
			?>

			<div id="multimedia-single-options" class="box">

				<ul class="multimedia-header-meta-icons risen-icon-list">

					<?php if ( $video_player && 'audio' == $show_player ) : // have video player but currently showing audio ?>
					<li><a href="<?php echo esc_url( add_query_arg( 'player', 'video' ) ); ?>" class="single-icon video-icon play-video-link"><?php _e( 'Show Video Player', 'risen' ); ?></a><a href="<?php echo esc_url( add_query_arg( 'player', 'video' ) ); ?>" class="risen-icon-label play-video-link"><?php _e( 'Show Video Player', 'risen' ); ?></a></li>
					<?php endif; ?>

					<?php if ( $audio_player && 'video' == $show_player ) : // have audio player but currently showing video ?>
					<li><a href="<?php echo esc_url( add_query_arg( 'player', 'audio' ) ); ?>" class="single-icon audio-icon play-audio-link"><?php _e( 'Show Audio Player', 'risen' ); ?></a><a href="<?php echo esc_url( add_query_arg( 'player', 'audio' ) ); ?>" class="risen-icon-label play-audio-link"><?php _e( 'Show Audio Player', 'risen' ); ?></a></li>
					<?php endif; ?>

					<?php if ( $audio_url ) : ?>
					<li><a href="<?php echo esc_url( risen_force_download_url( $audio_url ) ); ?>" class="single-icon audio-icon"><?php _e( 'Download Audio', 'risen' ); ?></a><a href="<?php echo esc_url( risen_force_download_url( $audio_url ) ); ?>" class="risen-icon-label"><?php _e( 'Download MP3', 'risen' ); ?></a></li>
					<?php endif; ?>

					<?php if ( $pdf_url ) : ?>
					<li><a href="<?php echo esc_url( risen_force_download_url( $pdf_url ) ); ?>" class="single-icon pdf-icon"><?php _e( 'Download PDF', 'risen' ); ?></a><a href="<?php echo esc_url( risen_force_download_url( $pdf_url ) ); ?>" class="risen-icon-label"><?php _e( 'Download PDF', 'risen' ); ?></a></li>
					<?php endif; ?>

				</ul>

				<div class="clear"></div>

			</div>

			<?php endif; ?>

			<?php if ( get_the_content() || get_the_excerpt() ) : ?>

				<div class="post-content"> <!-- confines heading font to this content -->

					<?php if ( get_the_content() ) : ?>
						<?php the_content() ?>
					<?php elseif ( get_the_excerpt() ) : // if no content, let's show the excerpt here ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>

				</div>

			<?php elseif ( function_exists( 'sharing_display' ) && sharing_display() ) : ?>

				<div class="post-content">
					<?php echo sharing_display(); ?>
				</div>

			<?php endif; ?>

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
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_term_list( $post->ID, 'risen_multimedia_category', '', __( ', ', 'risen' ) );
			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_term_list( $post->ID, 'risen_multimedia_tag', '', __( ', ', 'risen' ) );
			if ( $categories_list || $tag_list || get_edit_post_link( $post->ID ) ) :
			?>
			<footer id="multimedia-single-footer-meta" class="box post-footer<?php echo ( get_edit_post_link() ? ' can-edit-post' : '' ); // add class if there will be an edit button ?>">

				<?php
				if ( ! empty( $categories_list ) ) :
				?>
				<div id="multimedia-single-categories"><?php printf( __( 'Posted in %s', 'risen' ), $categories_list ); ?></div>
				<?php endif; ?>

				<?php
				if ( ! empty( $tag_list ) ) :
				?>
				<div id="multimedia-single-tags"><?php printf( __( 'Tagged with %s', 'risen' ), $tag_list ); ?></div>
				<?php endif; ?>

				<?php edit_post_link( __( 'Edit Post', 'risen' ), '<span class="post-edit-link-container">', '</span>' ); // edit link for admin if logged in ?>

			</footer>
			<?php endif; ?>

		</article>

		<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>

		<nav class="nav-left-right" id="multimedia-single-nav">
			<div class="nav-left"><?php next_post_link( '%link', sprintf( _x( '<span>&larr;</span> Newer %s', 'multimedia singular', 'risen' ), risen_option( 'multimedia_word_singular' ) ) ); ?></div>
			<div class="nav-right"><?php previous_post_link( '%link', sprintf( _x( 'Older %s <span>&rarr;</span>', 'multimedia singular', 'risen' ), risen_option( 'multimedia_word_singular' ) ) ); ?></div>
			<div class="clear"></div>
		</nav>

	</div>

</div>

<?php risen_show_sidebar( 'multimedia' ); ?>

<?php get_footer(); ?>