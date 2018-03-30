<?php
/* cosmetico audio page template */
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');

if($side=='yes') { $ss='1'; $w='653'; $h='350'; } else { $w='958'; $h='550'; }
?>


<?php
$cc=1;
if(have_posts()) :
while(have_posts()) : the_post() ?>

<div id="audio-<?php echo $post->ID; ?>" class="<?php echo $col_v;?>">

<?php $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );
wp_enqueue_style('videojs', WP_THEME_URL.'/inc/js/video-js/video-js.css', false, '1.0', 'screen');
wp_enqueue_script('videojs',WP_THEME_URL.'/inc/js/video-js/video.min.js', array('jquery'), '1.0', true);

if($isrc&&$sf!='no') { ?>
	<div class="<?php echo $fr; ?> frame_main <?php echo $roundy; ?> in">
		<div class="<?php echo $frin; ?> <?php echo $roundy; ?>">
			<a
				href="<?php if($plink=='page') echo get_permalink(); else echo $isrc[0];?>"
				<?php if($plink=='image') echo'data-rel="pp"';?> class="fade"><img
				src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'height'=>250, 'crop' => true)); ?>"
				class="<?php echo $roundy; ?> fade" alt="featured image" /> </a>
			<div class="cl"></div>

			<div class="cl"></div>

			<?php if($si!='no'){ foreach ($imgs as $att_id => $att) {
				$gall_img=wp_get_attachment_image_src($att_id);
				$gall_img_large=wp_get_attachment_image_src($att_id,'full');
				if($gall_img_large[0]!=$isrc[0]) echo '<a href="'.$gall_img_large[0].'" data-rel="pp[post-'.$post->ID.']" style="float:left;margin-top:1px;margin-left:0px;margin-right:2px;" class="fade"><div class="fade_c"></div><img src="'.bfi_thumb($gall_img[0], array('width' =>95, 'height'=>65, 'crop' => true)).'" class="'.$roundy.' fade" alt="thumb"/></a>';
			} } ?>

			<div class="cl"></div>
		</div>
	</div>

	<?php echo $div_left; } ?>

	<?php
	$murl=$aurl;$video='';
	if (preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $murl, $match)) {
		$video = $match[1]; }

		if($video!='') { echo '<div class="'.$fr.' '.$roundy.' cb5_media"><div class="'.$frin.'"><iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'. $video.'?wmode=transparent&amp;controls=1&amp;showinfo=0" title="'.get_the_title().'" frameborder="0"></iframe></div></div>'; }

		$pos = strpos($murl,'vimeo.com');

		if($pos === false) { } else {
			$video = substr($murl,17,8);
			echo '<div class="'.$fr.' '.$roundy.' cb5_media"><div class="'.$frin.'"><iframe class="cb5_media" width="'.$w.'" height="'.$h.'" src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0" title="'.$alt.'" frameborder="0"></iframe></div></div>';
		}

		if($video==''&&$pos===false&&$murl!='') {
			if($cb_type=='audio') $h='50'; if($cb_type=='audio') $aa='2'; else $aa='';
			if(!isset($roundy))$roundy='';
			echo '<div class="'.$fr.' '.$roundy.' cb5_media2"><div class="'.$frin.'"><video id="media-'.$post->ID.'" class="video-js vjs-default-skin cb5_media'.$aa.'" controls preload="none" width="'.$w.'" height="'.$h.'" poster="" data-setup=> <source src="'.$murl.'" type="video/mp4" /> </video></div></div>';
		}
		?>

	<div class="cl"></div>

	<?php the_content(); ?>

	<?php echo $div_close; ?>
	<div class="cl"></div>
	<?php echo '<div class="wp-pagenavi page_list">'; wp_link_pages(array('before'=>'<p>', 'next_or_number'=>'next', 'previouspagelink' => __('Previous Page','cb-cosmetico'), 'nextpagelink'=>__('Next Page','cb-cosmetico'))); echo '</div>'; ?>
	<div class="cl"></div>

</div>
<!--/audio page end-->


	<?php $cc++; endwhile; else : ?>

	<?php get_template_part('cb-404'); ?>

	<?php endif; ?>

	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
	else if ($wp_query->max_num_pages > 1) : ?>
<div id="nav-below" class="navigation">
	<div class="nav-previous">
	<?php next_posts_link(__('&larr; Older posts','cb-cosmetico')); ?>
	</div>
	<div class="nav-next">
	<?php previous_posts_link(__('Newer posts &rarr;','cb-cosmetico')); ?>
	</div>
</div>
	<?php endif; ?>

<!--/ audio end-->
