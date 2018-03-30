<?php 
global $qode_options;

$blog_author_info="no";
if (isset($qode_options['blog_author_info'])) {
	$blog_author_info = $qode_options['blog_author_info'];
}
$blog_hide_author = "";
if (isset($qode_options['blog_hide_author'])) {
    $blog_hide_author = $qode_options['blog_hide_author'];
}
$blog_single_hide_date = false;
if (isset($qode_options['blog_single_hide_date']) && $qode_options['blog_single_hide_date'] == "yes") {
    $blog_single_hide_date = true;
}
$blog_single_hide_category = false;
if (isset($qode_options['blog_single_hide_category']) && $qode_options['blog_single_hide_category'] == "yes") {
    $blog_single_hide_category = true;
}
?>
<?php
//check social share style
$social_type = 'circle';
if(isset($qode_options['blog_single_social_share_type'])  && $qode_options['blog_single_social_share_type'] != "") {
$social_type = $qode_options['blog_single_social_share_type'];
}
?>

<?php
//check social share style
$audio_bar_style = '';
if(isset($qode_options['blog_single_audio_style'])  && $qode_options['blog_single_audio_style'] != "") {
	$audio_bar_style = $qode_options['blog_single_audio_style'];
}
?>
<?php
$_post_format = get_post_format();
?>
<?php
	switch ($_post_format) {
		case "video":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
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
						<?php if(!$blog_single_hide_date || !$blog_single_hide_category || $blog_hide_author == "no"){ ?>
						<div class="post_info">
							<?php if(!$blog_single_hide_date){ ?>
								<span class="time">
									<span><?php the_time(get_option('date_format')); ?></span>
								</span>
							<?php } ?>
							<?php if(!$blog_single_hide_category){ ?>
								<span class="post_category">
									<span><?php _e('In', 'qode'); ?></span>
									<span><?php the_category(', '); ?></span>
								</span>
							<?php } ?>
							<?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
									<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
										<span><?php the_author_meta('display_name'); ?></span>
									</a>
								</span>
                            <?php } ?>
						</div>
						<?php } ?>
						<div class="post_content">
							<h2><span><?php the_title(); ?></span></h2>
							<?php the_content(); ?>
							<div class="clear"></div>
							<?php if(do_shortcode('[social_share_list]') != ""){ ?>
								<div class="post_social">
									<?php echo do_shortcode('[social_share_list list_type=' . $social_type . ']'); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
<?php
		break;
		case "audio":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class($audio_bar_style); ?>>
			<div class="post_content_holder">
				<div class="post_image">
					<audio class="blog_audio" src="<?php echo get_post_meta(get_the_ID(), "audio_link", true) ?>" controls="controls">
						<?php _e("Your browser don't support audio player","qode"); ?>
					</audio>
				</div>
				<div class="post_text">
					<div class="post_text_inner">
						<?php if(!$blog_single_hide_date || !$blog_single_hide_category || $blog_hide_author == "no"){ ?>
						<div class="post_info">
							<?php if(!$blog_single_hide_date){ ?>
								<span class="time">
									<span><?php the_time(get_option('date_format')); ?></span>
								</span>
							<?php } ?>
							<?php if(!$blog_single_hide_category){ ?>
								<span class="post_category">
									<span><?php _e('In', 'qode'); ?></span>
									<span><?php the_category(', '); ?></span>
								</span>
							<?php } ?>
							<?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
									<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
										<span><?php the_author_meta('display_name'); ?></span>
									</a>
								</span>
                            <?php } ?>
						</div>
						<?php } ?>
						<div class="post_content">
							<h2><span><?php the_title(); ?></span></h2>
							<?php the_content(); ?>
							<div class="clear"></div>
							<?php if(do_shortcode('[social_share_list]') != ""){ ?>
								<div class="post_social">
									<?php echo do_shortcode('[social_share_list list_type=' . $social_type . ']'); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
	
<?php
		break;
		case "link":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<div class="post_text">
					<div class="post_text_inner">
						<?php $title_link = get_post_meta(get_the_ID(), "title_link", true) != '' ? get_post_meta(get_the_ID(), "title_link", true) : 'javascript: void(0)'; ?>
						<?php if(!$blog_single_hide_date || !$blog_single_hide_category || $blog_hide_author == "no"){ ?>
						<div class="post_info">
							<?php if(!$blog_single_hide_date){ ?>
								<span class="time">
									<span><?php the_time(get_option('date_format')); ?></span>
								</span>
							<?php } ?>
							<?php if(!$blog_single_hide_category){ ?>
								<span class="post_category">
									<span><?php _e('In', 'qode'); ?></span>
									<span><?php the_category(', '); ?></span>
								</span>
							<?php } ?>
							<?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
									<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
										<span><?php the_author_meta('display_name'); ?></span>
									</a>
								</span>
                            <?php } ?>
						</div>
						<?php } ?>
						<div class="post_title">
							<h3><a href="<?php echo esc_url($title_link); ?>" target="_blank"><?php the_title(); ?></a></h3>
						</div>
					</div>
					<div class="post_content">
						<?php the_content(); ?>
						<div class="clear"></div>
						<?php if(do_shortcode('[social_share_list]') != ""){ ?>
							<div class="post_social">
								<?php echo do_shortcode('[social_share_list list_type=' . $social_type . ']'); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
<?php
		break;
		case "gallery":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<div class="post_image">
					<div class="flexslider">
						<ul class="slides">
							<?php
								$post_content = get_the_content();
								preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);

								if (array_key_exists(1, $ids)) {
		                            $array_id = explode(",", $ids[1]);
		                            
		                            $content =  str_replace($ids[0], "", $post_content);
									$filtered_content = apply_filters( 'the_content', $content);
									
									foreach($array_id as $img_id){ ?>
										<li><?php echo wp_get_attachment_image( $img_id, 'blog_image_in_grid' ); ?></li>
								<?php } } ?>
						</ul>
					</div>
				</div>
				<div class="post_text">
					<div class="post_text_inner">
						<?php if(!$blog_single_hide_date || !$blog_single_hide_category || $blog_hide_author == "no"){ ?>
						<div class="post_info">
							<?php if(!$blog_single_hide_date){ ?>
								<span class="time">
									<span><?php the_time(get_option('date_format')); ?></span>
								</span>
							<?php } ?>
							<?php if(!$blog_single_hide_category){ ?>
								<span class="post_category">
									<span><?php _e('In', 'qode'); ?></span>
									<span><?php the_category(', '); ?></span>
								</span>
							<?php } ?>
							<?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
									<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
										<span><?php the_author_meta('display_name'); ?></span>
									</a>
								</span>
                            <?php } ?>
						</div>
						<?php } ?>
						<div class="post_content">
							<h2><span><?php the_title(); ?></span></h2>

							<?php if(!empty($filtered_content)){
									echo do_shortcode($filtered_content);
								} else {
									the_content();
								} 
							?>

							<?php if(do_shortcode('[social_share_list]') != ""){ ?>
								<div class="post_social">
									<?php echo do_shortcode('[social_share_list list_type=' . $social_type . ']'); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>

			</div>
		
<?php
		break;
		case "quote":
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post_content_holder">
					<div class="post_text">
						<div class="post_text_inner">
							<?php if(!$blog_single_hide_date || !$blog_single_hide_category || $blog_hide_author == "no"){ ?>
							<div class="post_info">
								<?php if(!$blog_single_hide_date){ ?>
									<span class="time">
										<span><?php the_time(get_option('date_format')); ?></span>
									</span>
								<?php } ?>
								<?php if(!$blog_single_hide_category){ ?>
									<span class="post_category">
										<span><?php _e('In', 'qode'); ?></span>
										<span><?php the_category(', '); ?></span>
									</span>
								<?php } ?>
								<?php if($blog_hide_author == "no") { ?>
	                                <span class="post_author">
										<span><?php _e('By', 'qode'); ?></span>
										<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
											<span><?php the_author_meta('display_name'); ?></span>
										</a>
									</span>
	                            <?php } ?>
							</div>
							<?php } ?>
							<div class="post_title">
								<h3>
									<?php echo get_post_meta(get_the_ID(), "quote_format", true); ?>
									<span class="quote_author">&mdash; <?php the_title(); ?></span>
								</h3>
							</div>		
						</div>
						<div class="post_content">
							<?php the_content(); ?>
							<div class="clear"></div>
							<?php if(do_shortcode('[social_share_list]') != ""){ ?>
								<div class="post_social">
									<?php echo do_shortcode('[social_share_list list_type=' . $social_type . ']'); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
<?php
		break;
		default:
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<?php if(get_post_meta(get_the_ID(), "qode_hide-featured-image", true) != "yes") {
					if ( has_post_thumbnail() ) { ?>
						<div class="post_image">
	                        <?php the_post_thumbnail('blog_image_in_grid'); ?>
						</div>
				<?php } } ?>
				<div class="post_text">
					<div class="post_text_inner">
						<?php if(!$blog_single_hide_date || !$blog_single_hide_category || $blog_hide_author == "no"){ ?>
						<div class="post_info">
							<?php if(!$blog_single_hide_date){ ?>
								<span class="time">
									<span><?php the_time(get_option('date_format')); ?></span>
								</span>
							<?php } ?>
							<?php if(!$blog_single_hide_category){ ?>
								<span class="post_category">
									<span><?php _e('In', 'qode'); ?></span>
									<span><?php the_category(', '); ?></span>
								</span>
							<?php } ?>
							<?php if($blog_hide_author == "no") { ?>
                                <span class="post_author">
									<span><?php _e('By', 'qode'); ?></span>
									<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
										<span><?php the_author_meta('display_name'); ?></span>
									</a>
								</span>
                            <?php } ?>
						</div>
						<?php } ?>
						<div class="post_content">
							<h2><span><?php the_title(); ?></span></h2>
							<?php the_content(); ?>
							<div class="clear"></div>
							<?php if(do_shortcode('[social_share_list]') != ""){ ?>
								<div class="post_social">
									<?php echo do_shortcode('[social_share_list list_type=' . $social_type . ']'); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
<?php
}
?>
	<?php if( has_tag()) { ?>
		<div class="single_tags clearfix">
            <div class="tags_text">
				<h5><?php _e('Tags:', 'qode'); ?></h5>
				<?php the_tags('', '', ''); ?>
			</div>
		</div>
	<?php } ?>
	<?php 
		$args_pages = array(
			'before'           => '<p class="single_links_pages">',
			'after'            => '</p>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'pagelink'         => '%'
		);

		wp_link_pages($args_pages);
	?>
<?php if($blog_author_info == "yes") { 

	$disable_author_info_email = true;
	if (isset($qode_options['disable_author_info_email']) && $qode_options['disable_author_info_email'] == "yes") {
	    $disable_author_info_email = false;
	}

	?>
	<div class="author_description">
		<div class="author_description_inner">
			<div class="image">
				<?php echo get_avatar(get_the_author_meta( 'ID' ), 102); ?>
			</div>
			<div class="author_text_holder">
				<h4 class="author_name">
				<?php  
					if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
						echo get_the_author_meta('first_name') . " " . get_the_author_meta('last_name');
					} else {
						echo get_the_author_meta('display_name');
					}
				?>
				</h4>
				<?php if($disable_author_info_email){ ?>
					<span class="author_email"><?php echo get_the_author_meta('email'); ?></span>
				<?php } ?>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="author_text">
						<p><?php echo get_the_author_meta('description') ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
</article>