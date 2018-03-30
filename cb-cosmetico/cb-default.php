<?php
/* cosmetico default page template */

require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');

?>
<?php
if(have_posts()) :
while(have_posts()) : the_post() ?>
<div id="page-<?php echo $post->ID; ?>">

<?php $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

if($isrc&&$sf!='no') { ?>
	<div class="<?php echo $fr; ?> frame_main <?php echo $roundy; ?>">
		<div class="<?php echo $frin; ?> <?php echo $roundy; ?>">
			<a href="<?php echo $isrc[0];?>" <?php echo'data-rel="pp"';?>><img
				src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'height'=>250, 'crop' => true)); ?>"
				class="<?php echo $roundy; ?> fade" alt="featured image" /> </a>
			<div class="cl"></div>

			<div class="cl"></div>

			<?php if($si!='no'){ foreach ($imgs as $att_id => $att) {
				$gall_img=wp_get_attachment_image_src($att_id);
				$gall_img_large=wp_get_attachment_image_src($att_id,'full');
				if($gall_img_large[0]!=$isrc[0]) echo '<a href="'.$gall_img_large[0].'" data-rel="pp[post-'.$post->ID.']" style="float:left;margin-top:5px;margin-left:3px;margin-right:2px;"><img src="'.bfi_thumb($gall_img[0], array('width' => 95, 'height'=>65, 'crop' => true)).'" class="'.$roundy.' fade" alt="thumb"/></a>';
			} } ?>

			<div class="cl"></div>
		</div>
	</div>

	<?php } ?>

	<?php the_content(); ?>

	<?php echo $div_close; ?>
	<div class="cl"></div>
	<?php echo '<div class="wp-pagenavi page_list">'; wp_link_pages(array('before'=>'<p>', 'next_or_number'=>'next', 'previouspagelink' => __('Previous Page','cb-cosmetico'), 'nextpagelink'=>__('Next Page','cb-cosmetico'))); echo '</div>'; ?>
	<div class="cl"></div>

</div>
<!--/page end-->

	<?php endwhile; else : ?>

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

<!--/ default page end-->
