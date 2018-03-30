<div id="module-video" class="module module-video clearfix">
	<?php global $current_user, $wp_roles;
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):	
	?>
	
<?php fee_handle('Video');?>	
	
<div class="fee-options" id="video-options">
	
<form method="post">
<?php
$poster = get_post_meta($post->ID,'epic_video_preview',true);
$videohost = get_post_meta($post->ID,'epic_video_host',true);
$m4v = get_post_meta($post->ID,'epic_video_url_m4v',true);
$ogv = get_post_meta($post->ID,'epic_video_url_ogv',true);
$webmv = get_post_meta($post->ID,'epic_video_url_webmv',true);
$video_width = get_post_meta($post->ID,'epic_video_width',true);
$video_height = get_post_meta($post->ID,'epic_video_height',true);
$video_id_vimeo = get_post_meta($post->ID,'epic_video_id_vimeo',true);
$video_id_youtube = get_post_meta($post->ID,'epic_video_id_youtube',true);

?>
	<p>	
	<input type="radio" name="epic_video_host" id="self" value="self" <?php if($videohost == 'self') { echo 'checked="checked"';}?>/><label for="self">HTML5</label>
	<input type="radio" name="epic_video_host" id="vimeo" value="vimeo" <?php if($videohost == 'vimeo') { echo 'checked="checked"';}?>/><label for="vimeo">Vimeo</label>
	<input type="radio" name="epic_video_host" id="youtube" value="youtube" <?php if($videohost == 'youtube') { echo 'checked="checked"';}?>/><label for="youtube">Youtube</label>
	</p>	
	<h5>HTML5 Video</h5>		
	
	<p><label for="upload_preview_image">Poster image</label><br/>
	<input id="epic_video_preview" type="text" size="36" name="epic_video_preview" value="<?php echo $poster;?>" />
	<input id="upload_preview_image_button" class="upload_button" name="upload_video" type="button" value="Upload image" />
	<input id="remove_preview_image_button" class="remove_button" name="remove_video" type="button" value="Clear image" /></p>
	
	<!-- Video files -->
	<p><label for="epic_video_url_m4v">Video url - m4v</label><br/><input id="epic_video_url_m4v" type="text" size="60" name="epic_video_url_m4v" value="<?php echo $m4v;?>" /></p>
	<p><label for="epic_video_url_ogv">Video url - ogw</label><br/><input id="epic_video_url_ogv" type="text" size="60" name="epic_video_url_ogv" value="<?php echo $ogv;?>" /></p>
	<p><label for="epic_video_url_webmv">Video url - webmv</label><br/><input id="epic_video_url_webmv" type="text" size="60" name="epic_video_url_webmv" value="<?php echo $webmv;?>"/></p>
	
		
	
	<h5>Vimeo video</h5>
	<p><label for="epic_video_id_vimeo">Video id</label>
	<input  type="text" size="36" name="epic_video_id_vimeo" value="<?php echo $video_id_vimeo; ?>" />
	<small>Enter video id, i.e. <em>21968302</em>. Do NOT enter the full path to the video.</small></p>
	
	
	
	<h5>Youtube video</h5>
	<p><label for="epic_video_id_youtube">Video id</label><br/>
	<input type="text" size="36" name="epic_video_id_youtube" value="<?php echo $video_id_youtube;?>" />
	<small>Enter video id, i.e. <em>HJet6i6Qz3M</em>. Do NOT enter the full path to the video.</small></p>
	
	<h5>Video size</h5>
	<!-- Video size -->
	<p><label for="epic_video_width">Video width</label><input type="text" size="10" name="epic_video_width" value="<?php echo $video_width;?>" />
	<small>Default video width on fullwidth pages is 920px. On pages with sidebar - 640px</small></p>
	<!-- Video size -->
	<p><label for="epic_video_height">Video height</label><input  type="text" size="10" name="epic_video_height" value="<?php echo $video_height;?>" />
	<small>Adjust height according to width/aspect-ratio</small></p>
	

	<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_videomodule'); ?>	
	<input type="hidden" name="action" value="saved" />
	<input type="submit" value="Save changes"/>	
	<input type="reset" value="Cancel"/>
	<script>
		jQuery(function($) {
			jQuery( "#video-options" ).dialog({
				autoOpen: false,
				title:"Video settings",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});


			jQuery( "#video_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#video-options" ).dialog( "open" );
				return false;
			});
		});
		</script>	
	</form>
	
	
	
	
	
		</div>
	</div>
	<?php endif;?>
	
<div class="module-content">
<?php

global $post;

$type = get_post_meta($post->ID,'epic_video_host',true);
$poster = get_post_meta($post->ID,'epic_video_preview',true);
$m4v = get_post_meta($post->ID,'epic_video_url_m4v',true);
$ogv = get_post_meta($post->ID,'epic_video_url_ogv',true);
$webmv = get_post_meta($post->ID,'epic_video_url_webmv',true);
$video_width = get_post_meta($post->ID,'epic_video_width',true);
$video_height = get_post_meta($post->ID,'epic_video_height',true);
$video_id_vimeo = get_post_meta($post->ID,'epic_video_id_vimeo',true);
$video_id_youtube = get_post_meta($post->ID,'epic_video_id_youtube',true);


$id='';
if($type == 'vimeo')	{ $id = $video_id_vimeo;	}
if($type == 'youtube')	{ $id = $video_id_youtube;	}

$args = array(
	'type' 		=> $type,
	'poster' 	=> $poster,
	'm4v' 		=> $m4v,
	'ogv' 		=> $ogv,
	'webmv' 	=> $webmv,
	'width' 	=> $video_width,
	'height' 	=> $video_height,
	'id' 		=> $id,
	);
if($video_id_vimeo || $video_id_youtube || $m4v || $ogv || $webmv){
echo epic_video($args);
}else{
echo '<div class="message_box message_box_yellow"><p>No video has been added. Please fill out the required input.</p></div>';
}			
		?>
	</div>
</div>