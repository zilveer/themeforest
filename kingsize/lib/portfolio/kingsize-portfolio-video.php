<?php 
if(file_exists('../../../../../wp-load.php')) :
	include '../../../../../wp-load.php';
else:
	include '../../../../../../wp-load.php';
endif; 

?>

<div class="video_in_lightbox" style="text-align: center;">
<?php echo stripslashes(htmlspecialchars_decode(get_post_meta($_GET['id'], 'kingsize_embed_code', true))); ?>
</div>