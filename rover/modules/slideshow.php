<?php
/**
 * Slideshow
 * @package by Theme Record
 * @auther: MattMao
*/

function theme_slideshow() 
{
	$args = array( 
					'post_type' => 'slideshow',
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'post_status' => 'publish'
					); 
	$query = new WP_Query( $args );
	?>
	<div class="homepage-slideshow-warp">
	<div class="flex-container-home homepage-slideshow col-width">
	<div class="flexslider flexslider-homepage">
    <ul class="slides">
	<?php
		while ($query->have_posts()) : $query->the_post();

		#Get Meta
		$type = get_meta_option('slideshow_type');
		$caption_full = get_meta_option('slideshow_caption_full');
		$desc_full = get_meta_option('slideshow_desc_full');
		$enable_caption_full = get_meta_option('enable_slideshow_caption_full');
		$enable_desc_full = get_meta_option('enable_slideshow_desc_full');
		$image_full = get_meta_option('slideshow_image_full');
		$link_full = get_meta_option('slideshow_external_link_full');

		$caption_text = get_meta_option('slideshow_caption_text');
		$desc_text = get_meta_option('slideshow_desc_text');
		$enable_caption_text = get_meta_option('enable_slideshow_caption_text');
		$enable_desc_text = get_meta_option('enable_slideshow_desc_text');
		$image_text = get_meta_option('slideshow_image_text');
		$image_align = get_meta_option('slideshow_image_align');
		$link_text = get_meta_option('slideshow_link_text');
		$link_text_url = get_meta_option('slideshow_external_link_text');

		$embed_player = get_meta_option('embed_player');
		$video_id = get_meta_option('video_embed_id');
		$video_height = get_meta_option('video_height');
	?>
	<?php if($type == 'full' && $image_full) : ?>
	<li class="flex-item flex-item-full">
	<?php if($link_full) : ?>
		<a href="<?php echo $link_full; ?>"><img src="<?php echo $image_full; ?>" alt="<?php echo $caption_full; ?>" /></a>
	<?php else : ?>
		<img src="<?php echo $image_full; ?>" alt="<?php echo $caption_full; ?>" />
	<?php endif; ?>
	<?php if(($caption_full && $enable_caption_full == 'yes') || ($desc_full && $enable_desc_full == 'yes')) : ?>
	<div class="flex-caption">
	<?php if($caption_full && $enable_caption_full == 'yes') : ?><h1 class="title"><?php echo $caption_full; ?></h1><?php endif; ?>
	<?php if($desc_full && $enable_desc_full == 'yes') : ?><div class="desc"><?php echo $desc_full; ?></div><?php endif; ?>
	</div>
	<?php endif; ?>
	</li>
	<?php elseif($type == 'text' && $image_text) : ?>
	<li class="flex-item flex-item-text clearfix">
	<div class="<?php echo $image_align; ?>"><img src="<?php echo $image_text; ?>" alt="<?php echo $caption_text; ?>" /></div>
	<div class="text">
		<?php if($caption_text && $enable_caption_text == 'yes') : ?><h1 class="title"><?php echo $caption_text; ?></h1><?php endif; ?>
		<?php if($desc_text && $enable_desc_text == 'yes') : ?><div class="desc"><?php echo $desc_text; ?></div><?php endif; ?>
		<?php if($link_text && $link_text_url) : ?><div class="link"><a href="<?php echo $link_text_url; ?>"><?php echo $link_text; ?></a></div><?php endif; ?>
	</div>	
	</li>
	<?php elseif($type == 'video' && $video_id) : ?>
	<li class="flex-item flex-item-video">
	<?php
		$video_width = 940;
		if($video_height == '') { $video_height = $video_width * 9/16; }
		if($embed_player == 'youtube')
		{
			if($video_id) { echo '<iframe class="video" width="'.$video_width.'" height="'.$video_height.'" src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>'."\n"; }
		}
		elseif($embed_player == 'vimeo')
		{
			if($video_id) { echo '<iframe class="video" src="http://player.vimeo.com/video/'.$video_id.'" width="'.$video_width.'" height="'.$video_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'."\n"; }
		}
	?>
	</li>
	<?php endif; ?>
	<?php endwhile; wp_reset_query(); ?>
	</ul>
    </div>
	</div>
	<div class="loader"></div>
	</div>
	<?php
}

?>