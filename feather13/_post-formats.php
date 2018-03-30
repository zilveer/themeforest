<?php $meta=get_post_custom($post->ID); // Get Post Meta ?>

<?php if(has_post_format( 'audio' )): // Post Format: Audio
	$formats=array();
	foreach(explode('|','mp3|ogg') as $format)
		if(isset($meta['_audio_'.$format.'_url'])) {
			$format=(($format=='ogg')?'oga':$format);
			$formats[]=$format;
		}
?>

	<?php if(!empty($formats)): ?>
	<script type="text/javascript"> 
	jQuery(document).ready(function(){
		if(jQuery().jPlayer) {
			jQuery("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
				ready: function () {
					jQuery(this).jPlayer("setMedia", {
						<?php if(in_array('mp3',$formats)) { echo 'mp3: "'.$meta['_audio_mp3_url'][0].'",'."\n"; } ?>
						<?php if(in_array('oga',$formats)) { echo 'oga: "'.$meta['_audio_ogg_url'][0].'",'."\n"; } ?>
					});
				},
				swfPath: "<?php echo get_template_directory_uri() ?>/js",
				cssSelectorAncestor: "#jp_interface_<?php the_ID(); ?>",
				supplied: "<?php echo implode(',',$formats); ?>"
			});
		}
	});
	</script>
	<?php endif; ?>
	<div class="entry-format audio fix">
		<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>
		<div class="jp-audio">
			<div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">
				<ul class="jp-controls">
					<li><a href="#" class="jp-play" tabindex="1">play</a></li>
					<li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
					<li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
					<li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
				</ul>
				<div class="jp-progress-container">
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
				</div>
				<div class="jp-volume-bar-container">
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php endif; ?>


<?php if(has_post_format( 'gallery' )): // Post Format: Gallery ?>

<?php $images = wpb_post_images(); ?>
	
	<?php if(!empty($images)): ?>
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('.flexslider').flexslider({
				animation: "fade",
				slideshow: true,
				directionNav: true,
				controlNav: true,
				pauseOnHover: true,
				slideshowSpeed: 7000,
				animationDuration: 600,
				smoothHeight: true
			});
			jQuery('.slides').addClass('loaded');
		}); 
	</script>
	<?php endif; ?>
	<div class="entry-format gallery fix">
		<?php if(!empty($images)): ?>
		<div class="flexslider flex-post fix" id="slider-<?php the_ID(); ?>">
			<ul class="slides">
				<?php foreach($images as $image): ?>
					<li>
						<?php $imagesize=wp_get_attachment_image_src($image->ID,'post-format'); ?>
						<img src="<?php echo $imagesize[0]; ?>" alt="<?php echo $image->post_title; ?>">
						<?php if($image->post_excerpt): ?>
						<span class="caption-bar"><i><?php echo $image->post_excerpt; ?></i></span>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	
<?php endif; ?>

<?php if(has_post_format( 'image' )): // Post Format: Image ?>

	<?php $images = wpb_post_images();
		if(!empty($images) && (1==count($images)) && !has_post_thumbnail()) {
			$imagesize=wp_get_attachment_image_src($images[0]->ID,'post-format');
			$imagesize['title']=$images[0]->post_excerpt;
		} elseif (has_post_thumbnail()) {
			$img_id = get_post_thumbnail_id();
			$imagesize['title'] = get_post_field('post_excerpt', $img_id);
		}
	?>
	<div class="entry-format image fix">
		<div class="image-container">
			<?php echo (isset($meta['_image_url'][0])?'<a href="'.$meta['_image_url'][0].'">':''); ?>
				<?php if(has_post_thumbnail()) { the_post_thumbnail('post-format'); } ?>
				<?php if(isset($imagesize) && !has_post_thumbnail()) { echo '<img src="'.$imagesize[0].'" alt="'.$images[0]->post_title.'" >'; } ?>
			<?php echo (isset($meta['_image_url'][0])?'</a>':''); ?>
			<?php if(isset($imagesize['title']) && $imagesize['title']): ?>
				<span class="caption-bar"><i><?php echo $imagesize['title']; ?></i></span>
			<?php endif; ?>
		</div>
	</div>
	
<?php endif; ?>

<?php if (has_post_format( 'video' )): // Post Format: Video ?>

	<div class="entry-format video fix">
		<div class="video-container">
			<?php 
			if(isset($meta['_video_url'][0]) && !empty($meta['_video_url'][0])) {
				global $wp_embed;
				$video = $wp_embed->run_shortcode('[embed]'.$meta['_video_url'][0].'[/embed]');
				echo $video;
			} elseif(isset($meta['_video_embed_code'][0]) && !empty($meta['_video_embed_code'][0])) {
				echo $meta['_video_embed_code'][0];
			}
			?>
		</div>
	</div>
	
<?php endif; ?>

<?php if(has_post_format( 'quote' )): // Post Format: Quote ?>

	<div class="entry-format quote fix">
		<i class="icon-32"></i>
		<blockquote>
			<?php echo (isset($meta['_quote'][0])?wpautop($meta['_quote'][0]):''); ?>
		</blockquote>
		<p class="quote-author"><?php echo (isset($meta['_quote_author'][0])?'&mdash; '.$meta['_quote_author'][0]:''); ?></p>
	</div>
	
<?php endif; ?>

<?php if(has_post_format( 'chat' )): // Post Format: Chat ?>

	<div class="entry-format chat fix">
		<i class="icon-32"></i>
		<blockquote>
			<?php echo (isset($meta['_chat'][0])?wpautop($meta['_chat'][0]):''); ?>
		</blockquote>
	</div>
	
<?php endif; ?>

<?php if(has_post_format( 'link' )): // Post Format: Link ?>

	<div class="entry-format link fix">
		<p>
			<a href="<?php echo (isset($meta['_link_url'][0])?$meta['_link_url'][0]:'#'); ?>">
				<i class="icon-32"></i>
				<?php echo (isset($meta['_link_title'][0])?$meta['_link_title'][0]:get_the_title()); ?> &rarr;
			</a>
		</p>
	</div>
	
<?php endif; ?>

<?php if(has_post_format( 'status' )): // Post Format: Status ?>
<?php endif; ?>

<?php if(has_post_format( 'aside' )): // Post Format: Aside ?>
<?php endif; ?>