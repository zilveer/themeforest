<?php
$post_id = get_the_ID();
$views = wolf_format_number( absint( get_post_meta( $post_id, '_wolf_views', true ) ) );
$likes =wolf_format_number( absint( get_post_meta( $post_id, '_wolf_likes', true ) ) );
$shares =wolf_format_number( absint( get_post_meta( $post_id, '_wolf_shares', true ) ) );
$comments = get_comments_number();
?>
<article <?php post_class( 'clearfix' ); ?>   id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>">
	<div class="video">
		<?php echo wolf_post_media(); ?>
		<div class="clearfix video-inner">
			<h1 class="video-title"><?php the_title(); ?></h1>

			<?php if ( wolf_get_theme_option( 'video_author' ) ) : ?>
				<div class="video-author-meta clearfix">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 48 ); ?>
					<span class="video-author-name">
						<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php wolf_the_author(); ?>
						</a>
					</span>
				</div>
			<?php endif; ?>

			<?php if ( comments_open() && wolf_get_theme_option( 'video_comments' ) ) : ?>
			<span class="item-icon" title="<?php printf( __( '%d comments', 'wolf' ), $comments ); ?>">
				<a href="#comment" class="scroll comments-link"><i class="fa fa-comment-o"></i> <span class="item-views-count"><?php echo absint( $comments ); ?></span></a>
			</span><!-- .comments-link -->
			<?php endif; // comments_open() ?>

			<?php if ( wolf_get_theme_option( 'video_likes' ) ) : ?>
				<span class="item-icon item-like" title="<?php _e( 'Like this video', 'wolf' ); ?>">
					<i class="fa fa-heart-o"></i> <span class="item-likes-count"><?php echo absint( $likes ); ?></span>
				</span>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'video_views' ) ) : ?>
				<span class="item-icon" title="<?php printf( __( '%d views', 'wolf' ), $views ); ?>">
					<i class="fa fa-eye"></i> <span class="item-views-count"><?php echo absint( $views ); ?></span>
				</span>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'video_share' ) ) : ?>
				<span class="item-icon item-share" title="<?php _e( 'Share this video', 'wolf' ); ?> video">
					<i class="fa fa-share-alt"></i> <?php _e( 'share', 'wolf' ); ?>
				</span>
			<?php endif; ?>


		</div>
	</div>

	<?php if ( wolf_get_theme_option( 'video_share' ) || wolf_get_theme_option( 'video_embed' ) ) : ?>
	<div class="video-meta video-inner" style="display:none;">
		<?php if ( wolf_get_theme_option( 'video_share' ) && wolf_get_theme_option( 'video_embed' ) ) : ?>
		<ul class="video-tabs-menu">
			<li class="current"><a class="video-tab-link" href="#share-panel"><?php _e( 'Share', 'wolf' ); ?></a></li>
			<li><a class="video-tab-link" href="#embed-panel"><?php _e( 'Embed', 'wolf' ); ?></a></li>
		</ul>
		<?php endif; ?>
		<div id="share-panel" class="video-tab-content">
			<p class="share-buttons">
				<?php if ( wolf_get_theme_option( 'video_share' ) ) : ?>
					<?php get_template_part( 'partials/share', 'video' ); ?>
				<?php endif; ?>
			</p>
			<input class="url" value="<?php echo esc_url( wolf_get_first_video_url() ); ?>">
		</div>
		<?php if ( wolf_get_theme_option( 'video_embed' ) ) : ?>
			<div id="embed-panel" class="video-tab-content" style="<?php if ( wolf_get_theme_option( 'video_share' ) && wolf_get_theme_option( 'video_embed' ) ) echo 'display:none;' ?>">

				<p class="embed-input"><input class="embed" value="<?php echo esc_attr( wolf_get_video_iframe_embed_code() ); ?>"></p>
			</div>
		<?php endif; ?>
		<span class="close-share-panel">&times;</span>
	</div>
	<?php endif; ?>
	<div class="video-description video-inner">
		<div class="entry-meta">
			<span class="fa fa-clock-o"></span><?php printf( __( 'Uploaded %s ago', 'wolf' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
		</div>
		<?php if ( wolf_sample( wolf_no_video_content() ) ): ?>
			<div class="video-excerpt">
				<p><?php echo wolf_sample( wolf_no_video_content() ); ?></p>
				<span class="video-read-more"><?php _e( 'more', 'wolf' ); ?></span>
			</div>
			<div class="video-content">
				<?php echo wolf_no_video_content(); ?>
				<div class="entry-meta">
					<?php echo get_the_term_list( $post_id, 'video_type', '<span class="fa fa-folder-o"></span>', __( ', ', 'wolf' ), '' ); ?>
					<?php echo get_the_term_list( $post_id, 'video_tag','<br><span class="fa fa-tags"></span>', __( ', ', 'wolf' ), '' );; ?>
				</div>
				<span class="video-read-less"><?php _e( 'less', 'wolf' ); ?></span>
			</div>
		<?php else : ?>
			<div class="video-excerpt">
				<div class="entry-meta">
					<?php echo get_the_term_list( $post_id, 'video_type', '<span class="fa fa-folder-o"></span>', __( ', ', 'wolf' ), '' ); ?>
					<?php echo get_the_term_list( $post_id, 'video_tag','<br><span class="fa fa-tags"></span>', __( ', ', 'wolf' ), '' );; ?>
					<div style="height:18px"></div>
				</div>
			</div>
		<?php endif; ?>
	</div>
<?php
if ( wolf_get_theme_option( 'video_comments' ) )
	comments_template();
?>
</article>