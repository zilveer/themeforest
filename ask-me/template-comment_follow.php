<?php /* Template name: Follow comment */
global $user_ID;
if(empty($_GET['u'])){
	wp_redirect(home_url());
}
$user_login = get_userdata($_GET['u']);
if(empty($user_login)){
	wp_redirect(home_url());
}
$owner = false;
if($user_ID == $user_login->ID){
	$owner = true;
}
$show_point_favorite = get_user_meta($user_login->ID,"show_point_favorite",true);
if($show_point_favorite != 1 && $owner == false){
	wp_redirect(home_url());
}
get_header();
	include (get_template_directory() . '/includes/author-head.php');
	$following_me = get_user_meta($user_login->ID,"following_me");
	
	$following_me_0 = array();
	if (isset($following_me[0])) {
		$following_me_0 = $following_me[0];
	}
	$following_me_array = $following_me_0;
	if (is_array($following_me_array)) {
		$following_me_array = array_filter($following_me_array);
	}
	if (isset($following_me_array) && is_array($following_me_array) && !empty($following_me_array)) {
		$rows_per_page = get_option("posts_per_page");
		$paged         = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
		$offset		   = ($paged-1)*$rows_per_page;
		
		$comments_all = $wpdb->get_results("SELECT * FROM {$wpdb->comments} JOIN {$wpdb->posts} ON {$wpdb->posts}.ID = {$wpdb->comments}.comment_post_ID WHERE {$wpdb->posts}.post_type = 'post' AND {$wpdb->comments}.comment_approved = '1' AND {$wpdb->comments}.user_id IN ('" . join("', '", $following_me_array) . "') ORDER BY {$wpdb->comments}.comment_date_gmt DESC");
		
		$comments_all_q = $wpdb->get_results("SELECT * FROM {$wpdb->comments} JOIN {$wpdb->posts} ON {$wpdb->posts}.ID = {$wpdb->comments}.comment_post_ID WHERE {$wpdb->posts}.post_type = 'post' AND {$wpdb->comments}.comment_approved = '1' AND {$wpdb->comments}.user_id IN ('" . join("', '", $following_me_array) . "') ORDER BY {$wpdb->comments}.comment_date_gmt DESC LIMIT {$offset} , {$rows_per_page}");
		
		if ($comments_all) {
			$current = max( 1, get_query_var('page') );
			$pagination_args = array(
				'base' => @esc_url(add_query_arg('page','%#%')),
				'format' => 'page/%#%/?u='.$_GET['u'],
				'total' => (int)ceil(count($comments_all)/$rows_per_page),
				'current' => $current,
				'show_all' => false,
				'prev_text' => '<i class="icon-angle-left"></i>',
				'next_text' => '<i class="icon-angle-right"></i>',
			);
			
			if( !empty($wp_query->query_vars['s']) )
				$pagination_args['add_args'] = array('s'=>get_query_var('s'));?>
			
			<div id="commentlist" class="page-content">
				<ol class="commentlist clearfix">
					<?php foreach ($comments_all_q as $comment) {?>
						<li <?php comment_class('comment');?> id="comment-<?php comment_ID();?>">
						    <div class="comment-body clearfix"> 
						        <div class="avatar-img">
						        	<?php 
						        	if (get_the_author_meta('you_avatar', $comment->user_id)) {
						        		$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $comment->user_id)),"full",65,65);
						        		echo "<img alt='".$comment->comment_author."' src='".$you_avatar_img."'>";
						        	}else {
						        		echo get_avatar($comment->user_id,65);
						        	}?>
						        </div>
						        <div class="comment-text">
						            <div class="author clearfix">
						            	<div class="comment-meta">
						    	        	<div class="comment-author">
							    	        	<a href="<?php echo vpanel_get_user_url($comment->user_id,get_the_author_meta('user_nicename', $comment->user_id));?>"><?php echo get_comment_author();?></a>
							    	        	<?php if ($comment->user_id > 0) {
							    	        		echo vpanel_get_badge($comment->user_id);
							    	        	}?>
						    	        	</div>
						                    <a href="<?php echo get_permalink($comment->comment_post_ID);?>#comment-<?php echo esc_attr($comment->comment_ID); ?>" class="date"><i class="fa fa-calendar"></i><?php printf(__('%1$s at %2$s','vbegy'),get_comment_date(), get_comment_time()) ?></a>
						                </div>
						            </div>
						            <div class="text">
						            	<?php if ($comment->comment_approved == '0') : ?>
						            	    <em><?php _e('Your comment is awaiting moderation.','vbegy')?></em><br>
						            	<?php endif;
						            	echo makeClickableLinks(nl2br($comment->comment_content));?>
						            </div>
						        </div>
						    </div>
						</li>
					<?php }?>
				</ol>
			</div>
		<?php }else {echo "<div class='page-content page-content-user'><div class='user-questions'><p class='no-item'>".__("No answers yet .","vbegy")."</p></div></div>";}
	}else {
		echo "<div class='page-content page-content-user'><div class='user-questions'><p class='no-item'>".__("There are no user follow yet .","vbegy")."</p></div></div>";
	}
	if (isset($following_me_array) && is_array($following_me_array) && !empty($following_me_array) && count($comments_all) > count($comments_all_q) ) : ?>
		<div class='pagination'><?php echo (paginate_links($pagination_args) != ""?paginate_links($pagination_args):"")?></div>
	<?php endif;
get_footer();?>