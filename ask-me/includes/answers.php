<?php $comment_id = esc_attr($comment->comment_ID);
$user_get_current_user_id = get_current_user_id();
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
$time_edit_comment = strtotime('+'.$can_edit_comment_after.' hour',strtotime($comment->comment_date));
$time_end = ($time_now-$time_edit_comment)/60/60;
$edit_comment = get_comment_meta($comment_id,"edit_comment",true);?>
<li rel="posts-<?php echo $comment->comment_post_ID?>" class="comment" id="comment-<?php echo $comment_id?>">
	<div class="comment-body clearfix" rel="post-<?php echo $comment->comment_post_ID?>">
		<h3><a href="<?php echo get_permalink($comment->comment_post_ID);?>#comment-<?php echo $comment_id; ?>"><?php echo get_the_title($comment->comment_post_ID)?></a></h3>
		<div class="avatar-img">
			<?php if ($comment->user_id != 0){
				if (get_the_author_meta('you_avatar', $comment->user_id)) {
					$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $comment->user_id)),"full",65,65);
					echo "<img alt='".$comment->comment_author."' src='".$you_avatar_img."'>";
				}else {
					echo get_avatar($comment->user_id,60);
				}
			}else {
				echo get_avatar($comment->comment_author_email,60);
			}
			?>
		</div>
		<div class="comment-text">
		    <div class="author clearfix">
		    	<div class="comment-author">
		    		<?php if ($comment->user_id > 0){?>
    		    		<a href="<?php echo vpanel_get_user_url($user_login_id_l->ID);?>">
    		    	<?php }
	    		    	echo get_comment_author();
    		    	if ($comment->user_id > 0){?>
    		    		</a>
    		    		<?php echo vpanel_get_badge($user_login_id_l->ID);
    		    	}?>
		    	</div>
		    	<?php $active_vote = vpanel_options("active_vote");
		    	$show_dislike_answers = vpanel_options("show_dislike_answers");
		    	if ($active_vote == 1) {?>
			    	<div class="comment-vote">
			        	<ul class="single-question-vote">
			        		<?php if (is_user_logged_in() && $comment->user_id != get_current_user_id()){?>
			        			<li class="loader_3"></li>
		        				<li><a href="#" class="single-question-vote-up ask_vote_up comment_vote_up vote_allow<?php echo (isset($_COOKIE['comment_vote'.$comment_id])?" ".$_COOKIE['comment_vote'.$comment_id]."-".$comment_id:"")?>" title="<?php _e("Like","vbegy");?>" id="comment_vote_up-<?php echo $comment_id?>"><i class="icon-thumbs-up"></i></a></li>
			        			<?php if ($show_dislike_answers != 1) {?>
			        				<li><a href="#" class="single-question-vote-down ask_vote_down comment_vote_down vote_allow<?php echo (isset($_COOKIE['comment_vote'.$comment_id])?" ".$_COOKIE['comment_vote'.$comment_id]."-".$comment_id:"")?>" id="comment_vote_down-<?php echo $comment_id?>" title="<?php _e("Dislike","vbegy");?>"><i class="icon-thumbs-down"></i></a></li>
			        			<?php }
			        		}else { ?>
			        			<li class="loader_3"></li>
		        				<li><a href="#" class="single-question-vote-up ask_vote_up comment_vote_up <?php echo (is_user_logged_in() && $comment->user_id == get_current_user_id()?"vote_not_allow":"vote_not_user")?>" title="<?php _e("Like","vbegy");?>"><i class="icon-thumbs-up"></i></a></li>
			        			<?php if ($show_dislike_answers != 1) {?>
			        				<li><a href="#" class="single-question-vote-down ask_vote_down comment_vote_down <?php echo (is_user_logged_in() && $comment->user_id == get_current_user_id()?"vote_not_allow":"vote_not_user")?>" title="<?php _e("Dislike","vbegy");?>"><i class="icon-thumbs-down"></i></a></li>
			        			<?php }
			        		}?>
			        	</ul>
			    	</div>
			    	<span class="question-vote-result question_vote_result <?php echo ($comment_vote < 0?"question_vote_red":"")?>"><?php echo ($comment_vote != ""?$comment_vote:0)?></span>
		    	<?php }?>
		    	<div class="comment-meta">
		            <a href="<?php echo get_permalink($comment->comment_post_ID);?>#comment-<?php echo esc_attr($comment->comment_ID); ?>" class="date"><i class="fa fa-calendar"></i><?php printf(__( __('%1$s at %2$s','vbegy'), 'vbegy' ),get_comment_date(), get_comment_time()) ?></a> 
		        </div>
		        <div class="comment-reply">
		            <?php if (current_user_can('edit_comment',$comment_id)) {
		            	edit_comment_link('<i class="icon-pencil"></i>'.__("Edit","vbegy"),'  ','');
		            }else {
		            	if ($can_edit_comment == 1 && $comment->user_id == $user_get_current_user_id && ($can_edit_comment_after == 0 || $time_end <= $can_edit_comment_after)) {
		            		echo "<a class='comment-edit-link edit-comment' href='".esc_url(add_query_arg("comment_id", $comment_id,get_page_link(vpanel_options('edit_comment'))))."'><i class='icon-pencil'></i>Edit</a>";
		            	}
		            }
		            $active_reports = vpanel_options("active_reports");
		            if ($active_reports == 1) {?>
		            	<a class="question_r_l comment_l report_c" href="#"><i class="icon-flag"></i><?php _e("Report","vbegy")?></a>
		            <?php }?>
		        </div>
		    </div>
		    <div class="text">
		    	<?php if ($active_reports == 1) {?>
			    	<div class="explain-reported">
			    		<h3><?php _e("Please briefly explain why you feel this answer should be reported .","vbegy")?></h3>
			    		<textarea name="explain-reported"></textarea>
			    		<div class="clearfix"></div>
			    		<div class="loader_3"></div>
			    		<a class="color button small report"><?php _e("Report","vbegy")?></a>
			    		<a class="color button small dark_button cancel"><?php _e("Cancel","vbegy")?></a>
			    	</div><!-- End reported -->
		    	<?php }?>
		    	<a href="<?php echo get_permalink($comment->comment_post_ID);?>#comment-<?php echo $comment_id; ?>"><?php echo wp_html_excerpt($comment->comment_content,60)?></a>
		    </div>
		    <div class="clearfix"></div>
			<div class="loader_3"></div>
		    <div class="no_vote_more"></div>
		</div>
	</div>
</li>