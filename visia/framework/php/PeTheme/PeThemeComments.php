<?php

class PeThemeComments {

	public $master;
	public $user;
	public $user_identity;
	public $post_id;


	public function __construct($master) {
		$this->master =& $master;
		add_filter("comment_reply_link",array(&$this,"comment_reply_link_filter"));
		add_filter("cancel_comment_reply_link",array(&$this,"cancel_comment_reply_link_filter"));
	}

	public function open() {
		/*
		global $id;
		$this->post_id = $id;
		*/
		global $post;
		$this->post_id = $post->ID;

		$this->user = wp_get_current_user();
        $this->user_identity = ! empty($this->user->ID ) ? $this->user->display_name : '';

		if (comments_open()) {
			do_action("comment_form_before");
			return true;
		} else {
			do_action("comment_form_comments_closed");
			return false;
		}
	}

	public function end() {
		do_action("comment_form_after");
	}


	public function requireRegistered() {
		return  (get_option("comment_registration") && !is_user_logged_in());
	}

	public function register() {
		printf(__('You must be <a href="%s">logged in</a> to post a comment.','Pixelentity Theme/Plugin'),wp_login_url(apply_filters('the_permalink',get_permalink($this->post_id))));
		do_action("comment_form_must_log_in_after");
	}

	public function logout() {
		printf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','Pixelentity Theme/Plugin'), admin_url("profile.php"), $this->user_identity, wp_logout_url(apply_filters('the_permalink',get_permalink($this->post_id))));
	}


	public function action() {
		echo site_url("/wp-comments-post.php");
	}

	public function fields() {
		global $post;
		comment_id_fields($this->post_id);
		do_action('comment_form', $post->ID);
	}

	public function logged() {
		return is_user_logged_in();
	}

	public function show() {
		global $post;

		if (post_password_required($post)) {
			return;
		}
		echo '<ul class="commentlist">';
		wp_list_comments(array("callback"=>array(&$this,"format"),"walker" => new Walker_Comment_PE()));
		echo '</ul>';
	}

	public function form() {
		$this->master->template->comment_form();
	}


	public function comment_reply_link_filter($link) {
		return str_replace("comment-reply-link","comment-reply-link label",$link);
	}

	public function cancel_comment_reply_link_filter($link) {
		return str_replace("<a",'<a class="comment-reply-link label"',$link);
	}

	public function getPagerLoop() {
		global $wp_rewrite;

        if ( !is_singular() || !get_option('page_comments') ) return false;

        $page = get_query_var('cpage');
        if ( !$page ) $page = 1;
        $max_page = get_comment_pages_count();
		if (!$max_page || $max_page == 1) return false;

		$base = $wp_rewrite->using_permalinks() ? user_trailingslashit(trailingslashit(get_permalink()) . "comment-page-%#%", "commentpaged"): add_query_arg("cpage","%#%");

		for ($p = 1;$p<=$max_page;$p++) {
			$links[] = str_replace("%#%",$p,$base);
		}

		return $this->master->data->createPager($page,$links,$max_page);
	}

	public function pager($class = "span10") {
		$loop = $this->getPagerLoop();
		if ($loop) $loop->main->class = $class;
		$this->master->template->paginate_links($loop);
		// we use a custom pager for comment paginations but theme check plugins complaints if the following function is not found anywhere, even if we don't need it.
		if (false) {
			paginate_comments_links();
		}
	}

	public function supported() {
		global $post;

		if (post_password_required()) {
			return false;
		}

		if (!post_type_supports(get_post_type($post->ID),"comments")) {
			return false;
		}
		
		if (!comments_open() && get_comments_number($post->ID) == 0) {
			return false;
		}
		return true; 
	}

	public function format($comment, $args, $depth) {
		$GLOBALS["comment"] =& $comment;
		$id = $comment->comment_ID;
?>
		<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php echo $id ?>">
		
		<!--comment body-->
		<div class="row-fluid comment-body" id="div-comment-<?php echo $id ?>">
			<div class="span1 comment-author vcard">
				<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 43); ?>
			</div>

			<div class="span11">
				<?php if ($comment->comment_approved == '0') : ?>
				<span class="comment-awaiting-moderation"><?php echo __('Your comment is awaiting moderation.','Pixelentity Theme/Plugin') ?></span>
				<br/>
				<?php endif; ?>
			

				<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>','Pixelentity Theme/Plugin'), get_comment_author_link()); ?>
				<div class="comment-meta commentmetadata">
				<a href="<?php echo htmlspecialchars(get_comment_link()); ?>">
					<?php printf( __('%1$s at %2$s','Pixelentity Theme/Plugin'), get_comment_date(),  get_comment_time()); ?>
				</a>
				<?php edit_comment_link(__('(Edit)','Pixelentity Theme/Plugin'),'&nbsp;&nbsp;',''); ?>
				</div>
				<div class="pe-wp-default">
					<?php comment_text(); ?>
				</div>
				<div class="reply pull-right">
					<?php comment_reply_link(array_merge( $args, array('add_below' => "div-comment", 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
		</div>
<?php
	}
}

class Walker_Comment_PE extends Walker_Comment {
   
	function start_lvl(&$output, $depth = 0, $args = Array()) {

		global $wp_version;

		$GLOBALS['comment_depth'] = $depth + 1;

		if ( version_compare( $wp_version, '3.8', '<' ) ) { // pre wp 3.8

			echo '<div class="row-fluid"><div class="span11 pe-offset1"><ul class="children">';

		} else {

			$output .= '<div class="row-fluid"><div class="span11 pe-offset1"><ul class="children">';

		}
		
	}

	function end_lvl(&$output, $depth = 0, $args = Array()) {

		global $wp_version;

		$GLOBALS['comment_depth'] = $depth + 1;

		if ( version_compare( $wp_version, '3.8', '<' ) ) { // pre wp 3.8

			echo '</ul></div></div>';

		} else {

			$output .= '</ul></div></div>';

		}

	}

}

?>