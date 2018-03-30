<?php
if(comments_open())
{
?>
<div class="comments clearfix page_margin_top">
<?php
if(have_comments()):
	global $comments_form_animation, $comments_form_animation_duration, $comments_form_animation_delay;
	?>
		<div class="comment_box<?php echo ($comments_form_animation!='' ? ' animated_element animation-' . $comments_form_animation . ((int)$comments_form_animation_duration>0 && (int)$comments_form_animation_duration!=600 ? ' duration-' . (int)$comments_form_animation_duration : '') . ((int)$comments_form_animation_delay>0 ? ' delay-' . (int)$comments_form_animation_delay : '') : ''); ?>">
			<div class="comments_number">
				<a href="#comments_list" title="<?php echo $comments_count = get_comments_number(); echo " " . ($comments_count!=1 ? __("comments", 'medicenter') : __("comment", 'medicenter')); ?>"><?php echo $comments_count = get_comments_number(); echo " " . ($comments_count!=1 ? __("comments", 'medicenter') : __("comment", 'medicenter')); ?></a>
				<div class="arrow_comments"></div>
			</div>
		</div>
		<div id="comments_list">
			<ul>
			<?php
			paginate_comments_links();
			wp_list_comments(array(
				'avatar_size' => 73,
				'page' => (isset($_GET["paged"]) ? (int)$_GET["paged"] : ''),
				'per_page' => '5',
				'callback' => 'theme_comments_list'
			));
			?>
			</ul>
		<?php
		global $post;
		$query = "SELECT COUNT(*) AS count FROM $wpdb->comments WHERE comment_approved = 1 AND comment_post_ID = " . get_the_ID() . " AND comment_parent = 0";
		$parents = $wpdb->get_row($query);
		if($parents->count>5)
			comments_pagination(2, ceil($parents->count/5));
		?>
		</div>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		$(".comments .reply_button").click(function(event){
			event.preventDefault();
			var offset = $("#comment_form").offset();
			$("html, body").animate({scrollTop: offset.top-10}, 400);
			$("#comment_form [name='comment_parent_id']").val($(this).attr("href").substr(1));
			$("#cancel_comment").css('display', 'block');
		});
		$("#cancel_comment").click(function(event){
			event.preventDefault();
			$(this).css('display', 'none');
			$("#comment_form [name='comment_parent_id']").val(0);
		});
	});
	</script>
	<?php
endif;
?>
</div>
<?php
}
function theme_comments_list($comment, $args, $depth)
{
	global $post;
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class('comment clearfix'); ?> id="comment-<?php comment_ID() ?>">
		<div class="comment_author_avatar">
			<?php echo get_avatar( $comment->comment_author_email, $args['avatar_size'] ); ?>
		</div>
		<div class="comment_details">
			<div class="posted_by">
				<?php 
				_e("Posted by ", 'medicenter'); comment_author_link();
				_e(" on", 'medicenter'); 
				printf(__(' %1$s, %2$s'), get_comment_date(),  get_comment_time());
				edit_comment_link(__('(Edit)', 'medicenter'),'&nbsp;&nbsp;&nbsp;','');
				if((int)$comment->comment_parent>0)
				{
					echo '<br /><a class="show_source_comment" href="#comment-' . (int)$comment->comment_parent . '" title="' . __('Show comment', 'medicenter') . '">';
					_e('in reply to ', 'medicenter');
					$comment_parent = get_comment($comment->comment_parent);
					echo $comment_parent->comment_author . '</a>';
				}
				?>
			</div>
			<?php comment_text(); ?>
			<a class="icon_small_arrow right_white reply_button" href="#<?php comment_ID(); ?>" title="<?php _e('Reply', 'medicenter'); ?>">
				<?php _e('Reply &rarr;', 'medicenter'); ?>
			</a>
		</div>
<?php
}
function comments_pagination($range, $pages)
{
	$paged = (!isset($_GET["paged"]) || (int)$_GET["paged"]==0 ? 1 : (int)$_GET["paged"]);
	$showitems = ($range * 2)+1;
	
	echo "<ul class='pagination'>";
	if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='#page-1' class='pagination_arrow'>&laquo;</a></li>";
	if($paged > 1 && $showitems < $pages) echo "<li><a href='#page-" . ($paged-1) . "' class='pagination_arrow'>&lsaquo;</a></li>";

	for ($i=1; $i <= $pages; $i++)
	{
		if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		{
			echo "<li" . ($paged == $i ? " class='selected'" : "") . ">" . ($paged == $i ? "<span>".$i."</span>":"<a href='#page-" . $i . "'>".$i."</a>") . "</li>";
		}
	}

	if ($paged < $pages && $showitems < $pages) echo "<li><a href='#page-" . ($paged+1) . "' class='pagination_arrow'>&rsaquo;</a></li>";  
	if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='#page-" . $pages . "' class='pagination_arrow'>&raquo;</a></li>";
	echo "</ul>";
}
?>