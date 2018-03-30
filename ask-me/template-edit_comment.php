<?php ob_start();/* Template Name: Edit comment & answer */
get_header();
global $posted;
$comment_id = (isset($_GET["comment_id"])?(int)$_GET["comment_id"]:0);
$get_comment = get_comment($comment_id);
$get_post = array();
if (isset($comment_id) && $comment_id != 0 && is_object($get_comment)) {
	$get_post = get_post($get_comment->comment_post_ID);
	$can_edit_comment = vpanel_options("can_edit_comment");
	$can_edit_comment_after = vpanel_options("can_edit_comment_after");
	$can_edit_comment_after = (int)(isset($can_edit_comment_after) && $can_edit_comment_after > 0?$can_edit_comment_after:0);
	if (version_compare(phpversion(), '5.3.0', '>')) {
		$time_now = strtotime(current_time( 'mysql' ),date_create_from_format('Y-m-d H:i',current_time( 'mysql' )));
	}else {
		list($year, $month, $day, $hour, $minute, $second) = sscanf(current_time( 'mysql' ), '%04d-%02d-%02d %02d:%02d:%02d');
		$datetime = new DateTime("$year-$month-$day $hour:$minute:$second");
		$time_now = strtotime($datetime->format('r'));
	}
	$time_edit_comment = strtotime('+'.$can_edit_comment_after.' hour',strtotime($get_comment->comment_date));
	$time_end = ($time_now-$time_edit_comment)/60/60;
}
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div class="page-content">
			<div class="boxedtitle page-title"><h2><?php the_title();?></h2></div>
			<?php the_content();
			if (isset($comment_id) && $comment_id != 0 && $get_post) {
				if ($can_edit_comment == 1 && $get_comment->user_id == get_current_user_id() && $get_comment->user_id != 0 && get_current_user_id() != 0 && ($can_edit_comment_after == 0 || $time_end <= $can_edit_comment_after)) {
					do_action('vpanel_edit_comment');
					echo '<div class="form-style form-style-3">
						<form method="post" enctype="multipart/form-data">
							<div class="note_error display"></div>
							<div class="form-inputs clearfix">
								<div>
									<label class="required">'.__("Comment","vbegy").'<span>*</span></label><div class="clearfix"></div><br>';
									$settings = array("textarea_name" => "comment_content","media_buttons" => true,"textarea_rows" => 10);
									wp_editor((isset($posted['comment_content'])?wp_kses_post($posted['comment_content']):wp_kses_post($get_comment->comment_content)),"comment_content",$settings);
								echo '</div>
							</div>
							<p class="form-submit margin_0">
								<input type="hidden" name="comment_id" value="'.$comment_id.'">
								<input type="submit" value="'.__("Edit Comment","vbegy").'" class="button color small submit edit-comment">
							</p>
						</form>
					</div>';
				}else {
					_e("You are not allowed to edit this comment.","vbegy");
				}
			}else {
				_e("Sorry no comment has you select or not found.","vbegy");
			}?>
		</div><!-- End page-content -->
	<?php endwhile; endif;
get_footer();?>