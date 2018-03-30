<?php
global $qode_options;
global $more;
$more = 0;

$blog_hide_comments = "";
if (isset($qode_options['blog_hide_comments'])) {
	$blog_hide_comments = $qode_options['blog_hide_comments'];
}

$blog_hide_author = "";
if (isset($qode_options['blog_hide_author'])) {
	$blog_hide_author = $qode_options['blog_hide_author'];
}

$wp_read_more = "off";
if (isset($qode_options['wp_read_more'])) {
	$wp_read_more = $qode_options['wp_read_more'];
}
$_post_format = get_post_format();
?>
<?php
switch ($_post_format) {
	case "video":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_image">
				<?php $_video_type = get_post_meta(get_the_ID(), "video_format_choose", true);?>
				<?php if($_video_type == "youtube") { ?>
					<iframe src="//www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
				<?php } elseif ($_video_type == "vimeo"){ ?>
					<iframe src="//player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php } elseif ($_video_type == "self"){ ?>
					<div class="video">
						<div class="mobile-video-image" style="background-image: url(<?php echo get_post_meta(get_the_ID(), "video_format_image", true);  ?>);"></div>
						<div class="video-wrap"  >
							<video class="video" poster="<?php echo get_post_meta(get_the_ID(), "video_format_image", true);  ?>" preload="auto">
								<?php if(get_post_meta(get_the_ID(), "video_format_webm", true) != "") { ?> <source type="video/webm" src="<?php echo get_post_meta(get_the_ID(), "video_format_webm", true);  ?>"> <?php } ?>
								<?php if(get_post_meta(get_the_ID(), "video_format_mp4", true) != "") { ?> <source type="video/mp4" src="<?php echo get_post_meta(get_the_ID(), "video_format_mp4", true);  ?>"> <?php } ?>
								<?php if(get_post_meta(get_the_ID(), "video_format_ogv", true) != "") { ?> <source type="video/ogg" src="<?php echo get_post_meta(get_the_ID(), "video_format_ogv", true);  ?>"> <?php } ?>
								<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf">
									<param name="movie" value="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf" />
									<param name="flashvars" value="controls=true&file=<?php echo get_post_meta(get_the_ID(), "video_format_mp4", true);  ?>" />
									<img src="<?php echo get_post_meta(get_the_ID(), "video_format_image", true);  ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
								</object>
							</video>
						</div></div>
				<?php } ?>
			</div>
			<div class="post_text">
				<div class="post_text_inner">
					<div class="post_info">
						<span class="time">
							<?php the_time(get_option('date_format')); ?>
						</span>
					</div>
					<h4><a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<?php
					if($wp_read_more == "off"){
						qode_excerpt();
					} else {
						the_content('<span>Read More</span>');
					}
					?>
					<?php if($blog_hide_author == "no") { ?>
						<div class="post_author_holder">
							<div class="post_author">
								<span><?php _e('By', 'qode'); ?></span> <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span><?php the_author_meta('display_name'); ?></span></a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</article>

		<?php
		break;
	case "audio":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_image">
				<audio class="blog_audio" src="<?php echo get_post_meta(get_the_ID(), "audio_link", true) ?>" controls="controls">
					<?php _e("Your browser don't support audio player","qode"); ?>
				</audio>
			</div>
			<div class="post_text">
				<div class="post_text_inner">
					<div class="post_info">
						<span class="time">
							<?php the_time(get_option('date_format')); ?>
						</span>
					</div>
					<h4><a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<?php
					if($wp_read_more == "off"){
						qode_excerpt();
					} else {
						the_content('<span>Read More</span>');
					}
					?>
					<?php if($blog_hide_author == "no") { ?>
						<div class="post_author_holder">
							<div class="post_author">
								<span><?php _e('By', 'qode'); ?></span> <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span><?php the_author_meta('display_name'); ?></span></a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</article>
		<?php
		break;
	case "link":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<div class="post_text">
					<div class="post_text_inner">
						<i class="link_mark fa fa-link pull-left"></i>
						<div class="post_info">
								<span class="time">
									<?php the_time(get_option('date_format')); ?>
								</span>
						</div>

						<div class="post_title">
							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						</div>
						<?php if($blog_hide_author == "no") { ?>
							<div class="post_author_holder">
								<div class="post_author">
									<span><?php _e('By', 'qode'); ?></span> <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span><?php the_author_meta('display_name'); ?></span></a>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</article>
		<?php
		break;
	case "gallery":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_image">
				<div class="flexslider">
					<ul class="slides">
						<?php
						$post_content = get_the_content();
						preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);

						if (array_key_exists(1, $ids)) {
							$array_id = explode(",", $ids[1]);

							foreach($array_id as $img_id){ ?>
								<li><a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $img_id, 'portfolio-default' ); ?></a></li>
							<?php } } ?>
					</ul>
				</div>
			</div>
			<div class="post_text">
				<div class="post_text_inner">
					<div class="post_info">
							<span class="time">
								<?php the_time(get_option('date_format')); ?>
							</span>
					</div>
					<h4><a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

					<?php
					if($wp_read_more == "off"){
						qode_excerpt();
					} else {
						$post_content = get_the_content();

						$content =  str_replace($ids[0], "", $post_content);
						$filtered_content = apply_filters( 'the_content', $content);

						echo do_shortcode($filtered_content);
					}
					?>
					<?php if($blog_hide_author == "no") { ?>
						<div class="post_author_holder">
							<div class="post_author">
								<span><?php _e('By', 'qode'); ?></span> <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span><?php the_author_meta('display_name'); ?></span></a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</article>
		<?php
		break;
	case "quote":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<div class="post_text">
					<div class="post_text_inner">
						<i class="qoute_mark icon_quotations pull-left"></i>
						<div class="post_info">
							<span class="time">
								<?php the_time(get_option('date_format')); ?>
							</span>
						</div>
						<div class="post_title">
							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_post_meta(get_the_ID(), "quote_format", true); ?>
									<span class="quote_author">&mdash; <?php the_title(); ?></span>
								</a>
							</h3>
						</div>
						<?php if($blog_hide_author == "no") { ?>
							<div class="post_author_holder">
								<div class="post_author">
									<span><?php _e('By', 'qode'); ?></span> <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span><?php the_author_meta('display_name'); ?></span></a>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</article>
		<?php
		break;
	default:
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post_image">
					<a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('portfolio-default'); ?>
						<span class="post_overlay">
							<i class="icon_plus" aria-hidden="true"></i>
						</span>
					</a>
				</div>
			<?php } ?>
			<div class="post_text">
				<div class="post_text_inner">
					<div class="post_info">
						<span class="time">
							<?php the_time(get_option('date_format')); ?>
						</span>
					</div>
					<h4><a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<?php
					if($wp_read_more == "off"){
						qode_excerpt();
					} else {
						the_content('<span>Read More</span>');
					}
					?>
					<?php if($blog_hide_author == "no") { ?>
						<div class="post_author_holder">
							<div class="post_author">
								<span><?php _e('By', 'qode'); ?></span> <a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span><?php the_author_meta('display_name'); ?></span></a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</article>
		<?php
}
?>