<?php if($view_params['layout_structure'] != 'full') return false; ?>

<?php if ($view_params['video_mask'] == 'true') { ?>
	<div class="mk-video-mask"></div>
<?php } ?>


<?php 
$video_color_mask_css = '';

if (!empty($view_params['video_color_mask'])) { 
    $video_color_mask_css = ' style="background-color:' . $view_params['video_color_mask'] . ';opacity:' . $view_params['video_opacity'] . ';"';
}
?>

<div<?php echo $video_color_mask_css; ?> class="mk-video-color-mask"></div>
