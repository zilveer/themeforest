<?php
/**
 * blog content detail
 * @package metcreative
 */

$posttags = get_the_tags();

$post_date = get_the_date('d-F');
$post_date = explode('-',$post_date);
$post_day = $post_date[0];
$post_month = $post_date[1];

if( function_exists('rwmb_meta') ){
	$gallery_images = rwmb_meta( 'met_gallery_images', $args = array('type'=>'plupload_image','size'=>'full'), get_the_ID() );
	$content_media_option = rwmb_meta( 'met_content_media', array(), get_the_ID() );
	$video_url = rwmb_meta( 'met_video_link', array(), get_the_ID() );

	$slider_option['auto_play'] = rwmb_meta( 'met_slider_auto_play', array(), get_the_ID() );
	$slider_option['duration'] = rwmb_meta( 'met_slider_auto_play_duration', array(), get_the_ID() );
	$slider_option['circular'] = rwmb_meta( 'met_slider_circular', array(), get_the_ID() );
	$slider_option['infinite'] = rwmb_meta( 'met_slider_infinite', array(), get_the_ID() );
}

if(empty($content_media_option) OR $content_media_option=='thumbnail'){
	$thumb = get_post_thumbnail_id(get_the_ID());
	$img_url = wp_get_attachment_url( $thumb,'full');
	$postThumbnail = '';
	if(!empty($img_url)){
		$postThumbnail = aq_resize( $img_url, 870, 320, true );
	}
}

$html5a = $html5v = false;
if(!empty($content_media_option) AND ($content_media_option=='html5a' OR $content_media_option=='html5v') ){
	if($content_media_option=='html5a') {
		$html5a = true;
	}

	if($content_media_option=='html5v') {
		$html5v = true;
		$video_thumb = get_post_thumbnail_id(get_the_ID());
		$video_img_url = wp_get_attachment_url( $video_thumb,'full');
		$video_poster = '';
		if(!empty($video_img_url)){
			$video_poster = aq_resize( $video_img_url, 870, 320, true );
		}
	}

	wp_enqueue_script('metcreative-nouislider');
	wp_enqueue_script('metcreative-html5audio');
	wp_enqueue_style( 'metcreative-nouislider.fox');
	wp_enqueue_style( 'metcreative-nouislider.space');

	$content_media_url = rwmb_meta( 'met_media_url', array(), get_the_ID() );
	$content_media_url = wp_get_attachment_url( $content_media_url,'full');
}
?>

<div class="met_content">
	<div class="row-fluid">
		<div class="span12">
			<div class="met_page_header met_bgcolor5 clearfix">
				<h1 class="met_bgcolor met_color2">
					<?php
					$category = get_the_category();
					echo '<a href="'.get_category_link( $category[0]->cat_ID ).'" class="met_color2">'.$category[0]->cat_name.'</a>';
					?>
				</h1>
				<h2 class="met_color2">
					<?php the_title() ?>
				</h2>
			</div>
		</div>
	</div>

	<div <?php post_class('row-fluid'); ?> id="post-<?php the_ID(); ?>">
		<div class="span9">
			<div class="row-fluid">
				<div class="span12">
					<?php if( $content_media_option=='thumbnail' AND isset($postThumbnail) AND !empty($postThumbnail)): ?>
					<a href="<?php the_permalink(); ?>" class="met_blog_list_preview">
						<img src="<?php echo $postThumbnail ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
					</a>
					<?php endif; ?>

					<?php if( $content_media_option == 'video' AND !empty($video_url) ): ?>
					<a href="<?php the_permalink(); ?>" class="met_blog_list_preview">
						<div class="met_blog_video_iframe">
							<iframe src="<?php echo video_url_to_embed($video_url) ?>" width="770" height="320" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</div>
						<aside class="met_blog_preview_bar met_bgcolor met_color2">
							<div>
								<span><?php echo $post_day ?></span>
								<span><?php echo $post_month ?></span>
							</div>
						</aside>
					</a>
					<?php endif; ?>

					<?php if( $html5a AND !empty($content_media_url) ): ?>
						<div class="met_blog_list_preview">
							<div class="met_blog_html5_audio">

								<audio id="audio" controls>
									<source src="<?php echo $content_media_url ?>" type="audio/mpeg">
									Your browser does not support HTML5 Auido Player, Please Install Google Chrome Browser
								</audio>
								<div class="met_audio_player clearfix">
									<button class="met_audio_play_pause met_play met_bgcolor_transition"><i class="icon-play"></i></button>
									<span class="met_audio_current_time"><span class="met_audio_current_time_minutes">00</span>:<span class="met_audio_current_time_seconds">00</span></span>

									<div class="met_audio_sound met_sound_on met_bgcolor_transition">
										<div class="met_audio_volume"><span class="noUiSlider"></span></div>
										<i class="icon-volume-up" data-volume="100"></i>
										<span class="met_audio_sound_volume">55</span>
									</div>
									<span class="met_audio_total_time">00:00</span>

									<div class="met_audio_progress_bar">
										<div class="met_audio_current_progress" style="width: 0%"></div>
									</div>
								</div>

							</div>
						</div>
					<?php endif; ?>

					<?php if( $html5v AND !empty($content_media_url) ): ?>
						<div class="met_blog_list_preview">
							<div class="met_blog_video_iframe met_blog_html5_video">

								<video id="video" controls poster="<?php echo $video_poster ?>">
									<source src="<?php echo $content_media_url ?>" type="video/mp4">
									Your browser does not support HTML5 Video Player, Please Install Google Chrome Browser
								</video>
								<div class="met_audio_player clearfix">
									<button class="met_audio_play_pause met_play met_bgcolor_transition"><i class="icon-play"></i></button>
									<span class="met_audio_current_time"><span class="met_audio_current_time_minutes">00</span>:<span class="met_audio_current_time_seconds">00</span></span>

									<div class="met_audio_sound met_sound_on met_bgcolor_transition">
										<div class="met_audio_volume"><span class="noUiSlider"></span></div>
										<i class="icon-volume-up" data-volume="100"></i>
										<span class="met_audio_sound_volume">55</span>
									</div>
									<span class="met_audio_total_time">00:00</span>

									<div class="met_audio_progress_bar">
										<div class="met_audio_current_progress" style="width: 0%"></div>
									</div>
								</div>

							</div>
							<aside class="met_blog_preview_bar met_bgcolor met_color2">
								<div>
									<span>30</span>
									<span>MAY</span>
								</div>
							</aside>
						</div>
					<?php endif; ?>

					<?php if( $content_media_option == 'gallery' AND count($gallery_images) > 0):
						wp_enqueue_script('metcreative-caroufredsel');
						wp_enqueue_script('metcreative-magnific-popup');
						wp_enqueue_style('metcreative-magnific-popup');
					?>
						<div class="met_blog_list_preview clearfix">
							<div class="met_blog_slider_wrap clearfix">
								<div class="met_blog_slider">
									<?php foreach($gallery_images as $gallery_image): ?>
									<a href="<?php echo $gallery_image['full_url'] ?>" rel="lb_<?php the_ID(); ?>" class=""><img src="<?php echo $gallery_image['full_url'] ?>" alt=""/></a>
									<?php endforeach; ?>
								</div>
								<a href="#" class="met_blog_slider_nav_prev"><i class="icon-chevron-left"></i></a>
								<a href="#" class="met_blog_slider_nav_next"><i class="icon-chevron-right"></i></a>
							</div>
						</div>
						<script>
							jQuery(window).load(function(){
								jQuery(".met_blog_slider").carouFredSel({
									responsive: true,
									prev: { button : function(){ return jQuery(this).parents('.met_blog_slider_wrap').find('.met_blog_slider_nav_prev') } },
									next:{ button : function(){ return jQuery(this).parents('.met_blog_slider_wrap').find('.met_blog_slider_nav_next') } },
									circular: <?php echo $slider_option['circular'] ?>,
									infinite: <?php echo $slider_option['infinite'] ?>,
									auto: {
										play : <?php echo $slider_option['auto_play'] ?>,
										pauseDuration: 0,
										duration: <?php echo $slider_option['duration'] ?>
									},
									scroll: {
										items: 1,
										duration: 400,
										wipe: true
									},
									items: {
										visible: {
											min: 1,
											max: 1
										},
										width: 870,
										height: 300
									},
									width: 870,
									height: 300
								});
							});
						</script>
					<?php endif; ?>

					<a href="<?php the_permalink(); ?>" class="met_blog_title"><h2 class="met_bold_one met_color_transition"><?php the_title(); ?></h2></a>
					<div class="entry-content">
						<?php echo the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'metcreative' ), 'after' => '</div>' ) ); ?>
						<div class="clearfix"></div>
					</div>

					<div class="met_blog_miscs clearfix">
						<?php if(get_theme_mod('cacoon_blog_social','1') == '1'): ?>
						<div class="met_blog_socials">
							<a class="met_color_transition" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="icon-facebook"></i></a>
							<a class="met_color_transition" target="_blank" href="http://twitter.com/home?status=<?php echo esc_attr(get_the_title()); ?> - <?php the_permalink(); ?>"><i class="icon-twitter"></i></a>
							<a class="met_color_transition" href="javascript:void((function(){var e=document.createElement('script'); e.setAttribute('type','text/javascript'); e.setAttribute('charset','UTF-8'); e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());"><i class="icon-pinterest"></i></a>
							<a class="met_color_transition" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="icon-google-plus"></i></a>
						</div>
						<?php endif; ?>

						<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
							<?php if ( 'post' == get_post_type() AND get_theme_mod('cacoon_blog_posted_on','1') ) : ?><div class="met_blog_posted_by"><?php metcreative_posted_on(); ?></div><?php endif; ?>

							<?php
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list( __( ', ', 'metcreative' ) );
							if ( $categories_list AND metcreative_categorized_blog() AND get_theme_mod('cacoon_blog_category_list','1') ) : ?>
							<div class="met_blog_posted_by">
								<span class="cat-links">
								<?php printf( __( 'Posted in %1$s', 'metcreative' ), $categories_list ); ?>
								</span>
							</div>
							<?php endif; // End if categories ?>

							<?php
							/* translators: used between list items, there is a space after the comma */
							$tags_list = get_the_tag_list( '', __( ', ', 'metcreative' ) );
							if ( $tags_list AND get_theme_mod('cacoon_blog_tag_list','1') ) :
							?>
							<div class="met_blog_posted_by">
								<span class="tags-links">
									<?php printf( __( 'Tagged %1$s', 'metcreative' ), $tags_list ); ?>
								</span>
							</div>
							<?php endif; // End if $tags_list ?>
						<?php endif; // End if 'post' == get_post_type() ?>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span12">
					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
					?>
				</div>
			</div>
		</div>

		<div class="span3">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog') ); ?>
		</div>
	</div>
</div>