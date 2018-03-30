<?php
if ( post_password_required() )
	return;

$settings = crazyblog_opt();
$comment_settings = $settings;
$countComments = crazyblog_set( wp_count_comments( get_the_ID() ), 'approved' );
if ( crazyblog_set( $comment_settings, 'single_post_comments_listing' ) == 'show' && comments_open() ):
	?>
	<?php if ( have_comments() ) : ?>
		<div class="post-comments">
			<span class="comments-title"><i class="fa fa-comments"></i>
				<?php echo crazyblog_set( $comment_settings, 'single_post_comment_listing_title' ); ?>
				<?php echo esc_html( ($countComments > 0) ? "(" . crazyblog_restyle_text( $countComments ) . " )" : ""  ); ?>
			</span>
			<ul><?php wp_list_comments( array( 'avatar_size' => 170, 'callback' => 'crazyblog_comments_listing' ) ); ?></ul>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through?  ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'crazyblog' ); ?></h2>
				<div class="pagination">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'crazyblog' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'crazyblog' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation.  ?>
		<?php
	endif;
	if ( !comments_open() && get_comments_number() ) :
		?>
		<p><?php esc_html_e( 'Comments are closed.', 'crazyblog' ); ?></p>
		<?php
	endif;
endif;


if ( comments_open() ) :
	?>
	<div id="respond">
		<?php crazyblog_comment_form(); ?>
	</div>
<?php endif; ?>


