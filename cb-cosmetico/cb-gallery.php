<?php
/* cosmetico gallery template */
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');

require(get_template_directory().'/inc/cb-little-head.php');

$gw='20';
$hh='980';
$hh2='580';
$hh1='full';

if($columns=='1') { $hh=980; $hh2=800; }
if($columns=='2') { $hh=800; $hh2=600; }
if($columns=='3') { $hh=600; $hh2=500; }
if($columns=='4') { $hh=400; $hh2=350; }

$fll='';$zc='';
$zc='1';
if($grid=='yes') {
	$fll='style="float:left;"';
	if($columns=='1') $zc='1'; else $zc='0';
}
if(!isset($roundy))$roundy='';

if($grid=='yes') { $hh2=''; $hh=$hh*2; }

if($columns>'1') { $mas='-masonry';
$mas2=' id="gallery-inside"';
?>
<?php
}
?>

<?php
if($bnw=='yes') $adi_st='grayscale';

if($bnw=='yes') { ?>
<script type="text/javascript">
jQuery(function(){
jQuery('.fade-g').adipoli({
    'startEffect' : '<?php echo $adi_st;?>',
    'hoverEffect' : 'normal'
});
});</script>
<?php } ?>


<div class="cl"></div>



<?php
if(have_posts()) :
while(have_posts()) : the_post() ?>



<?php
$con=apply_filters('the_content', get_the_content());

$isrc=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');

if($isrc) { ?>
<div class="<?php echo $fr; ?> frame_main framepad">
	<div class="<?php echo $frin; ?>" <?php echo $es_w; ?>>
		<a href="<?php echo $isrc[0];?>" data-rel="pp"><img
			src="<?php echo bfi_thumb($isrc[0], array('width' => 958, 'height'=>240, 'crop' => true)); ?>"
			alt="gallery item" /> </a>
		<div class="cl"></div>
	</div>
</div>
<?php }

if($fullg!='yes'){ the_content();

?>
<br />
<?php } ?>
<div class="cl"></div>
<div <?php echo $mas2; ?>>
	<div id="gallery<?php echo $mas; ?>-<?php echo $post->ID; ?>">
	<?php

	$cc=1;
	$imgs=get_children('order=asc&orderby=menu_order&post_type=attachment&post_mime_type=image&post_parent='.$post->ID );

	foreach ($imgs as $att_id => $att) {
		if($gcap=='yes') $a_t='<div class="cap">'.$att->post_title.'</div>'; else $a_t='';
		if($columns=='3'||$columns=='4') $sstl='margin-top:0px!important;';
		$gall_img=wp_get_attachment_image_src($att_id,$hh1);
		if($columns!=1&&$cc%$columns==0&&$cc!=0) $cvs='style="margin:0;"'; else $cvs='';
		if($zoom!='yes'){if($gall_img[0]!=$isrc[0]) { echo '<div class="'.$col_v.' gallery_element fade single_image" '.$fll.' '.$cvs.'><div class="frame"><div class="frame_in">'; ?>
		<div class="fade_c">
			<div class="see_more_wrap">
				<div class="see_wrap2">
					<a href="<?php echo $gall_img[0]; ?>" data-rel="pp[gally]"><img
						src="<?php echo WP_THEME_URL; ?>/img/icons/arr_rw.png"
						class="fade-s fade_arr_r"
						alt="<?php _e('see more','cb-cosmetico');?>" />
						<h1>
							<span class="fade_see"><?php _e('see more','cb-cosmetico'); ?> </span>
						</h1> </a>
				</div>
			</div>
			<div class="cl"></div>
		</div>
		<?php echo '<a href="'.$gall_img[0].'" data-rel="pp[post-'.$post->ID.']"><img src="'.bfi_thumb($gall_img[0], array('width' => $hh,'height'=>$hh2, 'crop' => true)).'" '.$fll.' class=" fade-g fade-si" alt="gallery item"/></a><div class="cl"></div></div></div></div>'; if($columns!=1&&$cc%$columns==0&&$cc!=0) echo '<div class="cl"></div>';
		$cc++; } }
		else {if($gall_img[0]!=$isrc[0]) { echo '<div class="'.$col_v.' gallery_element" '.$fll.' '.$cvs.'><img src="'.bfi_thumb($gall_img[0], array('width' => $hh,'height'=>$hh2, 'crop' => true)).'" '.$fll.' class="zoomTarget" alt="gallery item"/><div class="cl"></div></div>'; if($columns!=1&&$cc%$columns==0&&$cc!=0) echo '<div class="cl"></div>';
		$cc++; }}
	}
	?>

		<div class="cl"></div>

	</div>
	<!--/ gallery article end-->

	<?php endwhile; else : ?>

	<?php get_template_part('cb-404'); ?>

	<?php endif; ?>

	<?php if($grid=='yes') { ?>
	<?php
	$masend='';
	$massdnm='
      columnWidth: function( containerWidth ) {
              return containerWidth /'.$coll.';
            }';

	echo '

<script type="text/javascript">
"use strict";
  jQuery(function(){
   var widd=jQuery(document).width();
   if(widd>768) {
jQuery(\'#blog-masonry\').imagesLoaded( function(){
   jQuery(\'.blog-masonry.hidden_blog\').show();
   jQuery(\'.hidden_blog_loader\').hide();

   jQuery(\'#blog-masonry\').masonry({
      itemSelector: \'.postbox\', 
      '.$massdnm.'
    });

   var gridh=jQuery(\'.grid_fullw #blog-masonry\').height();
   jQuery(\'.grid_fullw #blog-masonry\').parent().next(\'.grid_spacer\').height(gridh);

    });
	}
else {
   jQuery(\'.hidden_blog_loader\').hide();
   jQuery(\'.blog-masonry.hidden_blog\').show();
}
  });
</script>';
	} ?>
	<div class="cl"></div>
	<?php echo '<div class="wp-pagenavi page_list">'; wp_link_pages(array('before'=>'<p>', 'next_or_number'=>'next', 'previouspagelink' => __('Previous Page','cb-cosmetico'), 'nextpagelink'=>__('Next Page','cb-cosmetico'))); echo '</div>'; ?>


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
<!--/ gallery end-->
