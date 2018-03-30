<?php
global $qode_options;
global $more;
$more = 0;

$blog_show_categories = "no";
if (isset($qode_options['blog_split_column_show_categories'])){
	$blog_show_categories = $qode_options['blog_split_column_show_categories'];
}

$blog_show_comments = "no";
if (isset($qode_options['blog_split_column_show_comments'])){
	$blog_show_comments = $qode_options['blog_split_column_show_comments'];
}

$blog_show_author = "yes";
if (isset($qode_options['blog_split_column_show_author'])){
	$blog_show_author = $qode_options['blog_split_column_show_author'];
}
$blog_show_like = "no";
if (isset($qode_options['blog_split_column_show_like'])) {
	$blog_show_like = $qode_options['blog_split_column_show_like'];
}

$blog_show_ql_icon_mark = "yes";
$blog_title_holder_icon_class = "";
if (isset($qode_options['blog_split_column_show_ql_mark'])) {
	$blog_show_ql_icon_mark = $qode_options['blog_split_column_show_ql_mark'];	
}

if($blog_show_ql_icon_mark == "yes"){
	$blog_title_holder_icon_class = " with_icon_right";
}

$blog_show_date = "yes";
if (isset($qode_options['blog_split_column_show_date'])) {
	$blog_show_date = $qode_options['blog_split_column_show_date'];
}

$blog_social_share_type = "dropdown";
if(isset($qode_options['blog_split_column_select_share_option'])){
	$blog_social_share_type = $qode_options['blog_split_column_select_share_option'];
}
$blog_show_social_share = "no";
if (isset($qode_options['enable_social_share'])&& $qode_options['enable_social_share'] =="yes"){
	if (isset($qode_options['post_types_names_post'])&& $qode_options['post_types_names_post'] =="post"){
		if (isset($qode_options['blog_split_column_show_share']) && $blog_social_share_type == "dropdown") {
			$blog_show_social_share = $qode_options['blog_split_column_show_share'];
		}
	}
}

$background_image_object = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID()), 'blog_image_format_link_quote');
$background_image_src = $background_image_object[0];

$_post_format = get_post_format();

?>
<?php
switch ($_post_format) {
	case "video":		
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">								
				<div class="post_content_column">
					<div class="post_image">						
						<?php $_video_type = get_post_meta(get_the_ID(), "video_format_choose", true);?>
						<?php if($_video_type == "youtube") { ?>
							<iframe  src="http://www.youtube.com/embed/<?php echo esc_attr(get_post_meta(get_the_ID(), "video_format_link", true));  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
						<?php } elseif ($_video_type == "vimeo"){ ?>
							<iframe src="http://player.vimeo.com/video/<?php echo esc_attr(get_post_meta(get_the_ID(), "video_format_link", true));  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<?php } elseif ($_video_type == "self"){ ?>
							<div class="video">
								<div class="mobile-video-image" style="background-image: url(<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true));  ?>);"></div>
								<div class="video-wrap"  >
									<video class="video" poster="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true));  ?>" preload="auto">
										<?php if(get_post_meta(get_the_ID(), "video_format_webm", true) != "") { ?> <source type="video/webm" src="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_webm", true));  ?>"> <?php } ?>
										<?php if(get_post_meta(get_the_ID(), "video_format_mp4", true) != "") { ?> <source type="video/mp4" src="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_mp4", true));  ?>"> <?php } ?>
										<?php if(get_post_meta(get_the_ID(), "video_format_ogv", true) != "") { ?> <source type="video/ogg" src="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_ogv", true));  ?>"> <?php } ?>
										<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>">
											<param name="movie" value="<?php echo esc_url(get_template_directory_uri().'/js/flashmediaelement.swf'); ?>" />
											<param name="flashvars" value="controls=true&file=<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_mp4", true));  ?>" />
											<img src="<?php echo esc_url(get_post_meta(get_the_ID(), "video_format_image", true));  ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
										</object>
									</video>
								</div>
							</div>
						<?php } ?>							
					</div>
				</div>
				<div class="post_content_column text-wrapper">
					<div class="post_text">
						<div class="post_text_inner">
							<h2>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2>
							<?php if($blog_show_author == "yes" || $blog_show_date == "yes" || $blog_show_social_share == "yes" || $blog_show_categories == "yes" || $blog_show_comments == "yes" || $blog_show_like == "yes") { ?>
								<div class="post_info">
									<?php qode_post_info(array('date' => $blog_show_date, 'author' => $blog_show_author, 'share' => $blog_show_social_share, 'category' => $blog_show_categories, 'comments' => $blog_show_comments, 'like' => $blog_show_like)); ?>
								</div>
							<?php } ?>
							<?php
								qode_excerpt();
								qode_read_more_button('blog_split_column_read_more_button');
							?>
							<?php if(isset($qode_options['blog_split_column_show_share']) && $qode_options['blog_split_column_show_share'] == "yes" && $blog_social_share_type == "list") {
								echo do_shortcode('[no_social_share_list]'); // XSS OK
							}; ?>	
						</div>
					</div>
				</div>	
			</div>
		</article>
		<?php
		break;
	case "audio":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post_content_column">
						<div class="post_image">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail('full'); ?>
							</a>
						</div>
					</div>	
				<?php } ?>				
				<div class="post_content_column text-wrapper <?php  if (!has_post_thumbnail()) echo " split_column_full_width";?>">
					<div class="audio_image">
						<audio class="blog_audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "audio_link", true)) ?>" controls="controls">
							<?php _e("Your browser don't support audio player","qode"); ?>
						</audio>
					</div>
					<div class="post_text">
						<div class="post_text_inner">
							<h2>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2>
							<?php if($blog_show_author == "yes" || $blog_show_date == "yes" || $blog_show_social_share == "yes" || $blog_show_categories == "yes" || $blog_show_comments == "yes" || $blog_show_like == "yes") { ?>
								<div class="post_info">
									<?php qode_post_info(array('date' => $blog_show_date, 'author' => $blog_show_author, 'share' => $blog_show_social_share, 'category' => $blog_show_categories, 'comments' => $blog_show_comments, 'like' => $blog_show_like)); ?>
								</div>
							<?php } ?>
							<?php
								qode_excerpt();
								qode_read_more_button('blog_split_column_read_more_button');
							?>
							<?php if(isset($qode_options['blog_split_column_show_share']) && $qode_options['blog_split_column_show_share'] == "yes" && $blog_social_share_type == "list") {
								echo do_shortcode('[no_social_share_list]'); // XSS OK
							}; ?>	
						</div>
					</div>
				</div>	
			</div>
		</article>
		<?php
		break;
	case "link":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post_content_column">
						<div class="post_image">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail('full'); ?>
							</a>
						</div>
					</div>	
				<?php } ?>
				<div class="post_content_column text-wrapper<?php  if (!has_post_thumbnail()) echo " split_column_full_width";?>">
					<div class="post_text">
						<div class="post_text_inner">
							<?php if ($blog_show_ql_icon_mark == "yes") { ?>
								<div class="post_info_link_mark">
									<span class="fa fa-link link_mark"></span>
								</div>
							<?php } ?>
							<div class="post_title<?php echo esc_attr($blog_title_holder_icon_class); ?>">
								<h3>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h3>
							</div>
							<?php if($blog_show_author == "yes" || $blog_show_date == "yes" || $blog_show_social_share == "yes" || $blog_show_categories == "yes" || $blog_show_comments == "yes" || $blog_show_like == "yes") { ?>
								<div class="post_info">
									<?php qode_post_info(array('date' => $blog_show_date, 'author' => $blog_show_author, 'share' => $blog_show_social_share, 'category' => $blog_show_categories, 'comments' => $blog_show_comments, 'like' => $blog_show_like)); ?>
								</div>
							<?php } ?>
							<?php if(isset($qode_options['blog_split_column_show_share']) && $qode_options['blog_split_column_show_share'] == "yes" && $blog_social_share_type == "list") {
								echo do_shortcode('[no_social_share_list]'); // XSS OK
							}; ?>
						</div>
					</div>
				</div>	
			</div>
		</article>
		<?php
		break;
	case "gallery":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<div class="post_content_column">
					<div class="post_image">
						<?php get_template_part('templates/blog/parts/post-format-gallery-slider'); ?>
					</div>
				</div>
				<div class="post_content_column text-wrapper<?php  if (!has_post_thumbnail()) echo " split_column_full_width";?>">
					<div class="post_text">
						<div class="post_text_inner">
							<h2>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2>
							<?php if($blog_show_author == "yes" || $blog_show_date == "yes" || $blog_show_social_share == "yes" || $blog_show_categories == "yes" || $blog_show_comments == "yes" || $blog_show_like == "yes") { ?>
								<div class="post_info">
									<?php qode_post_info(array('date' => $blog_show_date, 'author' => $blog_show_author, 'share' => $blog_show_social_share, 'category' => $blog_show_categories, 'comments' => $blog_show_comments, 'like' => $blog_show_like)); ?>
								</div>
							<?php } ?>
							<?php
								qode_excerpt();
								qode_read_more_button('blog_split_column_read_more_button');
							?>
							<?php if(isset($qode_options['blog_split_column_show_share']) && $qode_options['blog_split_column_show_share'] == "yes" && $blog_social_share_type == "list") {
								echo do_shortcode('[no_social_share_list]'); // XSS OK
							}; ?>	
						</div>
					</div>
				</div>
			</div>	
		</article>
		<?php
		break;
	case "quote":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post_content_column">
						<div class="post_image">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail('full'); ?>
							</a>
						</div>
					</div>	
				<?php } ?>
				<div class="post_content_column text-wrapper<?php  if (!has_post_thumbnail()) echo " split_column_full_width";?>">
					<div class="post_text">
						<div class="post_text_inner">
							<?php if ($blog_show_ql_icon_mark == "yes") { ?>
								<div class="post_info_quote_mark">
									<span class="fa fa-quote-right quote_mark"></span>
								</div>
							<?php } ?>
							<div class="post_title<?php echo esc_attr($blog_title_holder_icon_class); ?>">
								<h3>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "quote_format", true)); ?></a>
								</h3>
								<span class="quote_author"><?php the_title(); ?></span>
							</div>
							<?php if($blog_show_author == "yes" || $blog_show_date == "yes" || $blog_show_social_share == "yes" || $blog_show_categories == "yes" || $blog_show_comments == "yes" || $blog_show_like == "yes") { ?>
								<div class="post_info">
									<?php qode_post_info(array('date' => $blog_show_date, 'author' => $blog_show_author, 'share' => $blog_show_social_share, 'category' => $blog_show_categories, 'comments' => $blog_show_comments, 'like' => $blog_show_like)); ?>
								</div>
							<?php } ?>
							<?php if(isset($qode_options['blog_split_column_show_share']) && $qode_options['blog_split_column_show_share'] == "yes" && $blog_social_share_type == "list") {
								echo do_shortcode('[no_social_share_list]'); // XSS OK
							}; ?>
						</div>
					</div>
				</div>	
			</div>
		</article>
		<?php
		break;
	default:
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post_content_holder">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="post_content_column">						
								<div class="post_image">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php the_post_thumbnail('full'); ?>
									</a>
								</div>
						</div>
					<?php } ?>					
					<div class="post_content_column text-wrapper<?php  if (!has_post_thumbnail()) echo " split_column_full_width";?>">
						<div class="post_text">
							<div class="post_text_inner">
								<h2>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h2>
								<?php if($blog_show_author == "yes" || $blog_show_date == "yes" || $blog_show_social_share == "yes" || $blog_show_categories == "yes" || $blog_show_comments == "yes" || $blog_show_like == "yes") { ?>
									<div class="post_info">
										<?php qode_post_info(array('date' => $blog_show_date, 'author' => $blog_show_author, 'share' => $blog_show_social_share, 'category' => $blog_show_categories, 'comments' => $blog_show_comments, 'like' => $blog_show_like)); ?>
									</div>
								<?php } ?>
								<?php
									qode_excerpt();
									qode_read_more_button('blog_split_column_read_more_button');
								?>
								<?php if(isset($qode_options['blog_split_column_show_share']) && $qode_options['blog_split_column_show_share'] == "yes" && $blog_social_share_type == "list") {
									echo do_shortcode('[no_social_share_list]'); // XSS OK
								}; ?>
							</div>
						</div>
					</div>
				</div>
			</article>
		<?php
}
?>

