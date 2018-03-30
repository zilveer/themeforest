<?php get_header();
    $sidebar_layout = vpanel_options('sidebar_layout');
    $date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<article <?php post_class('post single-post');?> id="post-<?php the_ID();?>">
			<div class="post-inner">
				<div class="post-img post-img-0">
					<?php
					if ($sidebar_layout == "full") {
						$img_width = 1100;
						$img_height = 600;
					}else {
						$img_width = 810;
						$img_height = 450;
					}
					$img_url = wp_get_attachment_url(get_post_thumbnail_id(),'full');
					$image = aq_resize($img_url,$img_width,$img_height,true);
					if ($image) {
						echo "<div class='post-img'><img alt='".get_the_title()."' width='".$img_width."' height='".$img_height."' src='".$image."'></div>";
						}
					?>
				</div>
	        	<h2 class="post-title"><?php the_title()?></h2>
				<?php $posts_meta = vpanel_options("post_meta");
				if ($posts_meta == 1) {?>
					<div class="post-meta">
					    <span class="meta-author"><i class="icon-user"></i><?php the_author_posts_link();?></span>
					    <span class="meta-date"><i class="fa fa-calendar"></i><?php the_time($date_format);?></span>
					    <span class="meta-comment"><i class="fa fa-comments-o"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
					</div>
				<?php }?>
				<div class="post-content">
					<?php the_content();?>
				</div>
			</div><!-- End post-inner -->
		</article><!-- End article.post -->
		<?php $post_comments = vpanel_options("post_comments");
		if ($post_comments == 1) {
			comments_template();
		}
	endwhile; endif;
get_footer();?>