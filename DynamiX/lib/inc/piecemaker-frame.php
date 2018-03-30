<?php 

/* ------------------------------------

:: CONFIGURE SLIDE

------------------------------------ */

if(!$NV_previewimgurl) {  // check what image to use, custom, featured, image within post. 
	$post_image_id = get_post_thumbnail_id($post->ID);
		if ($post_image_id) {
			$thumbnail = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail', false);
				$NV_previewimgurl=$thumbnail[0];
				$NV_previewimgurl	=	parse_url($NV_previewimgurl, PHP_URL_PATH); // make relative Image URL
		} elseif($image) {
		$NV_previewimgurl=$image;
		}
}

if($NV_previewimgurl) { // Check "Preview Image" field is completed 
	$imagepath=$NV_previewimgurl;
} 

if(!$imagepath) {
	$imagepath=get_template_directory_uri()."/images/video_blank.jpg";
}

$target_chk = strpos($NV_cssclasses,'target_blank');
if($target_chk === false) {
	$target='_self';
}
else {
	$target='_blank';
}

/* ------------------------------------

:: CONFIGURE SLIDE *END*

------------------------------------ */

if(!$NV_videotype) { ?>
<Image Source="<?php echo $NV_imagepath; ?>" Title="<?php echo $NV_posttitle; ?>">

	<?php if($NV_stagegallery!="image" || $NV_description!="") { ?>
	<Text>
		&lt;h1&gt;<?php echo $NV_posttitle; ?> &lt;/h1&gt;
		<?php
		echo "&lt;p&gt;";  
        echo htmlspecialchars(do_shortcode($NV_description));
		echo "&lt;/p&gt;";
		?>
	</Text>
    <?php }  
	
	if( !empty ( $NV_galexturl ) ) { ?>
    <Hyperlink URL="<?php if($NV_galexturl) { echo $NV_galexturl; } ?>" Target="<?php echo $target; ?>" />
	<?php } ?>

</Image>
<?php } elseif($NV_videotype=="swf") { ?>
<Flash Source="<?php echo $NV_movieurl; ?>" Title="<?php echo $NV_posttitle; ?>">
      <Image Source="<?php echo $NV_imagepath; ?>" />
</Flash>
<?php } elseif($NV_videotype=="3dvid") { ?>
<Video Source="<?php echo $NV_movieurl; ?>" Title="<?php echo $NV_posttitle; ?>" Width="<?php echo $NV_imgwidth; ?>" Height="<?php if($NV_imgheight) { echo $NV_imgheight; } else { ?>350<?php } ?>" Autoplay="<?php if($NV_videoautoplay) { echo "true"; } else { echo "false"; } ?>">
      <Image Source="<?php echo $NV_imagepath; ?>" />
</Video>
<?php } ?>