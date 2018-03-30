<?php
	global $post;

	$video = isset($value['video']) ? !!$value['video'] : false;
	$button = isset($value['button']) ? $value['button'] : __('Insert', 'health-center');
	$remove = isset($value['remove']) ? $value['remove'] : __('Remove', 'health-center');
	$default = isset($GLOBALS['wpv_in_metabox']) ?
					get_post_meta($post->ID, $id, true) :
					wpv_get_option($id, $default);

	$name = $id;
	$id = preg_replace('/[^\w]+/', '', $id);
?>

<div class="upload-basic-wrapper <?php echo !empty($default)?'active':'' ?>">
	<div class="image-upload-controls <?php if($video) echo 'wpv-video-upload-controls' ?>">
		<input type="text" id="<?php echo $id?>" name="<?php echo $name?>" value="<?php echo $default?>" class="image-upload <?php wpv_static($value)?> <?php if(!$video) echo 'hidden'?>" />

		<a class="button wpv-upload-button <?php if($video) echo 'wpv-video-upload' ?>" href="#" data-target="<?php echo $id?>">
			<?php echo $button?>
		</a>

		<a class="button wpv-upload-clear <?php if(empty($default)) echo 'hidden'?>" href="#" data-target="<?php echo $id?>"><?php echo $remove?></a>
		<a class="wpv-upload-undo hidden" href="#" data-target="<?php echo $id?>"><?php echo __('Undo', 'health-center')?></a>
	</div>
	<div id="<?php echo $id?>_preview" class="image-upload-preview <?php if($video) echo 'hidden' ?>">
		<img src="<?php echo $default?>" />
	</div>
</div>