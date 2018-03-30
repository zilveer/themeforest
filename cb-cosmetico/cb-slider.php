<?php
/* cosmetico slider page template */
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');
if(!isset($roundy))$roundy='';
?>


<?php
if(have_posts()) :
while(have_posts()) : the_post() ?>

<div id="slider-<?php echo $post->ID; ?>">


<?php $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );
wp_enqueue_style('any', WP_THEME_URL.'/inc/js/anything_slider/css/anythingslider.css', false, '1.0', 'screen');
wp_enqueue_script('anyeasing',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.easing.1.2.js', array('jquery'), '1.0', true);
wp_enqueue_script('any',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.min.js', array('jquery'), '1.0', true);
wp_enqueue_script('anyfx',WP_THEME_URL.'/inc/js/anything_slider/js/jquery.anythingslider.fx.min.js', array('jquery'), '1.0', true);


if($isrc&&$sf!='no') { ?>
	<div class="<?php echo $fr; ?> frame_main <?php echo $roundy; ?> in">
		<div class="<?php echo $frin; ?> <?php echo $roundy; ?>">
			<a
				href="<?php if($plink=='page') echo get_permalink(); else echo $isrc[0];?>"
				<?php if($plink=='image') echo'data-rel="pp"';?> class="fade"><div
					class="fade_c"></div> <img
				src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'height'=>350, 'crop' => true)); ?>"
				class="<?php echo $roundy; ?> fade fade-si" alt="featured image" />
			</a>
			<div class="cl"></div>

			<div class="cl"></div>

			<?php if($si!='no'){ foreach ($imgs as $att_id => $att) {
				$gall_img=wp_get_attachment_image_src($att_id);
				$gall_img_large=wp_get_attachment_image_src($att_id,'full');
				if($gall_img_large[0]!=$isrc[0]) echo '<a href="'.$gall_img_large[0].'" data-rel="pp[post-'.$post->ID.']" style="float:left;margin-top:1px;margin-left:0px;margin-right:2px;" class="fade"><div class="fade_c"></div><img src="'.bfi_thumb($gall_img[0], array('width' => 95, 'height'=>75, 'crop' => true)).'" class="'.$roundy.' fade" alt="thumb"/></a>';
			} } ?>

			<div class="cl"></div>
		</div>
	</div>

	<?php echo $div_left; } ?>


	<?php $con=apply_filters('the_content', get_the_content());

	$pid=$post->ID; $slid_id=substr(rand(),0,3);
	if(!isset($s_fr))$s_fr='';
	if(!isset($s_fr_end))$s_fr_end='';

	if($s_beh!='cat') $rc='true'; else $rc='false';

	if($side=='yes') $slider_res='height:385px;'; else $slider_res='height:360px;';

	if($s_frame=='yes') { $s_fr='<div class="frame '.$roundy.'"><div class="framein '.$roundy.'">'; $s_fr_end='</div></div>'; }

	echo '<script type="text/javascript">
		jQuery(function(){
		 jQuery(\'#slider'.$slid_id.$pid.'\').anythingSlider({
			resizeContents       : '.$rc.',	
			hashTags            : false,
			autoPlay            : '.$s_auto.',     
			pauseOnHover        : true,    
			resumeOnVideoEnd    : true,
			delay               : '.$s_delay.',     
			animationTime       : '.$s_ani_time.',    
			easing              : \''.$s_easing.'\'
		  });
		});
		</script>'.$s_fr.'<ul id="slider'.$slid_id.$pid.'" style="'.$slider_res.'" class="page_slider slider">';

	if($s_beh!='cat'){

		$imgs=get_children('post_type=attachment&order=asc&orderby=menu_order&post_mime_type=image&post_parent='.$post->ID );

		foreach ($imgs as $att_id => $att) {

			$gall_img=wp_get_attachment_image_src($att_id,'full');

			echo '<li><a href="'.$gall_img[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($gall_img[0], array('width' => 980, 'height'=>450, 'crop' => true)).'" class="'.$roundy.' fade-s" alt="slide image"/></a><div class="cl"></div></li>';
		}

	} else {

		$slide_q = new WP_Query('cat='.$cats.'');

		while ($slide_q->have_posts()) : $slide_q->the_post();

		$isrc_slide=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');

		if($isrc_slide) echo '<li><a href="'.$isrc_slide[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($isrc_slide[0], array('width' => 980, 'height'=>450, 'crop' => true)).'" class="'.$roundy.' fade-s" alt="slide image"/></a><div class="cl"></div></li>';

		else echo '<li>'.apply_filters('the_content', get_the_content()).'</li>';

		endwhile;

	}// slider cat else end
	echo '</ul>'.$s_fr_end.'<div class="cl"></div>';
	//slider end

	echo $con;
	echo $div_close; ?>
	<div class="cl"></div>
	<?php echo '<div class="wp-pagenavi page_list">'; wp_link_pages(array('before'=>'<p>', 'next_or_number'=>'next', 'previouspagelink' => __('Previous Page','cb-cosmetico'), 'nextpagelink'=>__('Next Page','cb-cosmetico'))); echo '</div>'; ?>

	<div class="cl"></div>
</div>
<!--/page slider end-->

	<?php  endwhile; else : ?>

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
<!--/ slider end-->
