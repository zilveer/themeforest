<?php
get_header();
setPostViews(get_the_ID());
?>
<div class="theme_page relative">
	<div class="page_layout clearfix">
		<div class="page_header clearfix">
			<div class="page_header_left">
				<h1><?php the_title(); ?></h1>
				<h4><?php echo get_post_meta(get_the_ID(), $themename. "_subtitle", true); ?></h4>
			</div>
			<div class="page_header_right">
				<?php
				get_sidebar('header');
				?>
			</div>
		</div>
		<ul class="bread_crumb clearfix">
			<li><?php _e('You are here:', 'gymbase'); ?></li>
			<li>
				<a href="<?php echo get_home_url(); ?>" title="<?php _e('Home', 'gymbase'); ?>">
					<?php _e('Home', 'gymbase'); ?>
				</a>
			</li>
			<li class="separator icon_small_arrow right_white">
				&nbsp;
			</li>
			<li>
				<?php the_title(); ?>
			</li>
		</ul>
		<div class="vc_row wpb_row vc_row-fluid">
			<div class="vc_col-sm-8 wpb_column vc_column_container">
				<ul class="blog clearfix">
					<?php
					if(have_posts()) : while (have_posts()) : the_post();
					?>
						<li <?php post_class('class'); ?>>
							<div class="comment_box">
								<div class="first_row">
									<?php the_time("d"); ?><span class="second_row"><?php echo strtoupper(date_i18n("M", get_post_time())); ?></span>
								</div>
								<a class="comments_number" href="<?php comments_link(); ?>" title="<?php comments_number('0 ' . __('Comments', 'gymbase')); ?>">
									<?php comments_number('0 ' . __('Comments', 'gymbase')); ?>
								</a>
							</div>
							<div class="post_content">
								<?php
								if(has_post_thumbnail()):
									$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
									$large_image_url = $attachment_image[0];
								?>
								<a class="post_image fancybox" href="<?php echo $large_image_url; ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail("blog-post-thumb", array("alt" => get_the_title(), "title" => "")); ?>
								</a>
								<?php
								endif;
								?>
								<h2>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
								<div class="text">
									<?php the_content(); ?>
								</div>
								<?php
								if(isset($theme_options["show_share_box"]) && $theme_options["show_share_box"]==="true"):
									?>
									<div class="share_box clearfix">
										<h5 class="box_header"><?php _e('Share:', 'gymbase');?></h5>
										<ul class="social_icons clearfix">
											<?php
											$slides_count = count($theme_options["social_icon_url"]);
											for($i=0; $i<$slides_count; $i++):
												if($theme_options["social_icon_url"][$i]=="")
													continue;
												$large_image_url = "";
												if(has_post_thumbnail())
												{
													$thumb_id = get_post_thumbnail_id(get_the_ID());
													$attachment_image = wp_get_attachment_image_src($thumb_id, "large");
													$large_image_url = $attachment_image[0];
												}
												?>
												<li><a <?php echo ($theme_options["social_icon_target"][$i]=="new_window" ? " target='_blank'" : ""); ?> href="<?php echo esc_url(str_replace("{MEDIA_URL}", $large_image_url, str_replace("{TITLE}", urlencode(get_the_title()), str_replace("{URL}", get_permalink(), $theme_options["social_icon_url"][$i]))));?>" class="social_icon <?php echo esc_attr($theme_options["social_icon_type"][$i]);?>"></a></li>
												<?php
											endfor;
											?>
										</ul>
									</div>
									<?php
								endif;
								?>
								<div class="post_footer">
									<ul class="categories">
										<li class="posted_by"><?php _e('Posted by', 'gymbase'); echo " "; if(get_the_author_meta("user_url")!=""):?><a class="author" href="<?php the_author_meta("user_url"); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a><?php else: the_author(); endif; ?></li>
										<?php
										$categories = get_the_category();
										foreach($categories as $key=>$category)
										{
											?>
											<li>
												<a href="<?php echo get_category_link($category->term_id ); ?>" title="<?php echo (empty($category->description) ? sprintf(__('View all posts filed under %s', 'gymbase'), $category->name) : esc_attr(strip_tags(apply_filters('category_description', $category->description, $category)))); ?>">
													<?php echo $category->name; ?>
												</a>
											</li>
										<?php
										}
										?>
									</ul>
								</div>
							</div>
						</li>
					<?php
					endwhile; endif;
					?>
				</ul>
				<?php
				comments_template();
				gb_get_theme_file("/comments-form.php");
				?>
			</div>
			<div class="vc_col-sm-4 wpb_column vc_column_container">
				<?php
				if(is_active_sidebar('blog'))
					get_sidebar('blog');
				?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer(); 
?>