<?php ob_start();/* Template Name: Edit post */
get_header();
$get_post = (isset($_GET["edit_post"])?(int)$_GET["edit_post"]:0);
$get_post_p = get_post($get_post);
$can_edit_post = vpanel_options("can_edit_post");
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div class="page-content">
			<div class="boxedtitle page-title"><h2><?php the_title();?></h2></div>
			<?php the_content();
			if (isset($get_post) && $get_post != 0 && $get_post_p && get_post_type($get_post) == "post") {
				if ($can_edit_post == 1 && $get_post_p->post_author != 0) {
					$user_login_id_l = get_user_by("id",$get_post_p->post_author);
					if ($user_login_id_l->ID == get_current_user_id()) {
						echo do_shortcode("[vpanel_edit_post]");
					}else {
						_e("Sorry you can't edit this post .","vbegy");
					}
				}else {
					_e("Sorry you can't edit this post .","vbegy");
				}
			}else {
				_e("Sorry no post has you select or not found .","vbegy");
			}?>
		</div><!-- End page-content -->
	<?php endwhile; endif;
get_footer();?>