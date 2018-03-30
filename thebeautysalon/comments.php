<?php
/**
  * Comment Display
  *
  * The area of the page that contains both current comments
  * and the comment form. The actual display of comments is
  * handled by a callback to RF_Framework::show_comment() which is
  * located in the RF_Framework class. If more specific functionality is
  * needed [themename]_show_comment() is used in the functions.php file.
  *
  * @package The Beauty Salon
  *
  */
  global $post, $blueprint, $framework;
  $indent_side = ( $blueprint->get_sidebar_position() == 'right' ) ? 'left' : 'right';

?>

<?php if( comments_open() AND post_type_supports( $post->post_type, 'comments' ) ) : ?>
	<div class='comments <?php echo get_post_type() ?>'>

		<?php if ( post_password_required() ) : ?>
			<div class="comments nopassword">
				<hgroup class='notice'>
					<h1><?php echo $framework['options']['password_protected_title'] ?></h1>
					<h2><?php echo $framework['options']['password_protected_message'] ?></h2>
				</hgroup>
			</div>
		<?php return; endif; ?>

		<div class='comments'>

				<?php if ( have_comments() ) : ?>
					<div class='indent <?php echo $indent_side ?>'>
					<h1 class="<?php echo $indent_side ?> primary comments-title"><?php comments_number( 'No Comments Yet', '1 Comment', '% Comments'  ) ?> on "<?php the_title() ?>"</h1>

					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
						<nav class="comment-nav above">
							<a href='<?php previous_comments_link() ?>' class="previous">Older Comments</a>
							<a href='<?php next_comments_link() ?>' class="next">Newer Comments</a>
						</nav>
					<?php endif ?>
					</div>

					<ol class="commentlist <?php echo $indent_side ?>"><?php wp_list_comments( array( 'callback' => 'tbs_show_comment' ) ) ?></ol>

					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
						<div class='indent <?php echo $indent_side ?>'>
						<nav class="comment-nav below">
							<a href='<?php previous_comments_link() ?>' class="previous">Older Comments</a>
							<a href='<?php next_comments_link() ?>' class="next">Newer Comments</a>
						</nav>
						</div>
					<?php endif ?>
				<?php endif ?>

			<div class='indent <?php echo $indent_side ?>'>
			<?php
				ob_start();
				$args = array(
					'comment_notes_after' => '',
					'comment_notes_before' => ''
				);
				comment_form( $args );
				$comment_form = ob_get_clean();
				$replacement = '<p class="form-submit">$1 <span class="read-more-arrow"></span></p>';

				$comment_form = preg_replace( "/<p class=[\"|']form-submit[\"|']>(.*?)<\/p>/s", $replacement, $comment_form);



				echo $comment_form;

			?>
			</div>

		</div><!-- .comments -->
	</div>

<?php elseif( is_single( 'post' ) ) : ?>
	<div <?php echo $blueprint->boxed_class( 'comments' ) ?>>
		<hgroup class='notice'>
			<h1><?php echo $framework['options']['comments_closed_title'] ?></h1>
			<h2><?php echo $framework['options']['comments_closed_message'] ?></h2>
		</hgroup>
	</div>
<?php endif; ?>