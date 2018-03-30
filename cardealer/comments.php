<?php
if (!defined('ABSPATH')) exit();

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die('Please do not load this page directly.');

global $post;
$user_id = get_current_user_id();
$comments_number = (int)get_comments_number();
$result = array();

if ($comments_number === 0) {
	$args = array(
		'post_id' => $post->ID,
		'user_id' => $user_id
	);
	$comments = get_comments($args);

	foreach ($comments as $comment) {
		if (!$comment->comment_approved && ($user_id > 0 || $comment->comment_author_IP === $_SERVER['REMOTE_ADDR'])) {
			$comments_number++;
			$result[] = $comment;
		}
	}
}

if ($comments_number != 0) {
	?>

	<!-- - - - - - - - - - - - Post Comments - - - - - - - - - - - - - - -->

	<section id="comments">

		<h3 class="section-title"><?php echo get_comments_number() . " " . __('Comments', 'cardealer'); ?></h3>

		<?php paginate_comments_links() ?>

		<ol class="comments-list">
			<?php
			if (count($result) > 0) {
				wp_list_comments('avatar_size=60&callback=tmm_comments', $result);
			} else {
				wp_list_comments('avatar_size=60&callback=tmm_comments');
			}
			?>
		</ol>

		<?php paginate_comments_links() ?>

	</section><!--/ #comments-->

	<!-- - - - - - - - - - - end Post Comments - - - - - - - - - - - - - -->

<?php } ?>

<?php if (comments_open()) : ?>

	<!-- - - - - - - - - - - Comment Form - - - - - - - - - - - - - -->

	<?php comment_form(); ?>

	<!-- - - - - - - - - - end Comment Form - - - - - - - - - - - - -->

<?php endif; ?>

<?php
if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments'))
	wp_enqueue_script('comment-reply');
?>

<input type="hidden" name="current_post_id" value="<?php echo $post->ID ?>"/>
<input type="hidden" name="current_post_url" value="<?php echo get_permalink($post->ID) ?>"/>
<input type="hidden" name="is_user_logged_in" value="<?php echo(is_user_logged_in() ? 1 : 0) ?>"/>