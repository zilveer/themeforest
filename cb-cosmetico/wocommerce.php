<?php
/*
 Template Name: WooCommerce Page
 */
get_header(); ?>
<?php
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');

if($headtfc!=''||$headtsc!='') {
	if($headtfc!='') $hst1='color:'.$headtfc.';';
	if($headtsc!='') $hst2='text-shadow:1px 1px '.$headtsc.';';
	$hst='style="'.$hst1.$hst2.'"';
}
?>

<?php if($header_type!='slider_head') { ?>
<div
	class="wrapper_p <?php if($header_bg_image=='') echo 'head_title';?>">
	<?php if(($title=='yes'||$title=='')&&$cb_type!='home') echo '<h1 class="title"><a href="'.get_permalink().'" '.$hst.'>'.get_the_title().'</a></h1>'; ?>
</div>
<div class="cl"></div>
	<?php } ?>

</div>

	<?php if($show_bread=='yes'&&$header_type!='slider_head'){ if(function_exists('yoast_breadcrumb')){ yoast_breadcrumb('<div class="bread_wrap"><div class="wrapper_p"><div id="breadcrumbs">','</div><div class="cl"></div></div></div>'); } } ?>
</div>
<!-- bg_head end -->

<div id="middle">
	<div
		class="wrapper_p woo <?php if($fullg=='yes'&&$cb_type=='gallery') echo 'fullgallery'; ?>">

		<?php if($header_type=='slider_head'&&($title=='yes'||$title=='')) { ?>
		<?php echo '<h1 class="in"><a href="'.get_permalink().'" '.$hst.'>'.get_the_title().'</a></h1>'; ?>
		<?php } ?>

		<?php if($cb_type!='contact') { if($sidebar=='left') { ?>
		<div id="sidebar_l">
		<?php if($sidebar_name!='0') { dynamic_sidebar($sidebar_name); } else { dynamic_sidebar('shop'); } ?>
		</div>
		<!-- sidebar #end -->
		<?php } } ?>








		<div id="page" class="<?php if($side=='yes') { ?>side<?php } ?>">

		<?php
		if(have_posts()) :
		while(have_posts()) : the_post() ?>
			<div id="page-<?php echo $post->ID; ?>">

			<?php $isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
			$imgs=get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

			if($isrc&&$sf!='no') { ?>
				<div class="<?php echo $fr; ?> <?php echo $roundy; ?>">
					<div class="<?php echo $frin; ?> <?php echo $roundy; ?>">
						<a
							href="<?php if($plink=='page') echo get_permalink(); else echo $isrc[0];?>"
							<?php if($plink=='image') echo'data-rel="pp"';?>><img
							src="<?php echo bfi_thumb($isrc[0], array('width' => 980, 'height'=>250, 'crop' => true)); ?>"
							class="<?php echo $roundy; ?> fade fade-si" alt="featured image" />
						</a>
						<div class="cl"></div>

						<div class="cl"></div>

						<?php if($si!='no'){ foreach ($imgs as $att_id => $att) {
							$gall_img=wp_get_attachment_image_src($att_id);
							$gall_img_large=wp_get_attachment_image_src($att_id,'large');
							if($gall_img_large[0]!=$isrc[0]) echo '<a href="'.$gall_img_large[0].'" data-rel="pp[post-'.$post->ID.']" style="float:left;margin-top:5px;margin-left:3px;margin-right:2px;"><img src="'.bfi_thumb($gall_img[0], array('width' => 95, 'height'=>65, 'crop' => true)).'" class="'.$roundy.' fade" alt="thumb"/></a>';
						} } ?>

						<div class="cl"></div>
					</div>
				</div>

				<?php } ?>

				<?php the_content(); ?>

				<?php echo $div_close; ?>
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

		</div>
		<!--/ default page end-->







		<?php if($cb_type!='contact') { if ($sidebar=='right') { ?>
		<div id="sidebar_r">
			<ul>
			<?php if($sidebar_name!='0') { dynamic_sidebar($sidebar_name); } else { dynamic_sidebar('shop'); } ?>
			</ul>
		</div>
		<!-- sidebar #end -->
		<?php } } ?>

		<div class="cl"></div>

	</div>
	<!-- wrapper #end -->
</div>
<!-- middle #end -->

		<?php get_footer(); ?>
