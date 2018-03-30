<?php	
global $NHP_Options; 
$options_morphis = $NHP_Options; 
$page_level_layerslider_id = get_post_meta($post->ID,'_cmb_layer_slider_id',TRUE); 
$page_level_slider = get_post_meta($post->ID,'_cmb_home_slider',TRUE);

if( $page_level_slider == 'layerslider' ) {
	$layerslider_id = isset($page_level_layerslider_id) ? $page_level_layerslider_id : $options_morphis['gen_layer_slider_id'];
} else {
	$layerslider_id = $options_morphis['gen_layer_slider_id'];
}

$main_accent_hover_color = substr($options_morphis['main_accent_hover_color'], 1);
?>
<!-- HOME PAGE LAYER SLIDER -->
<div id="main-slider" class="container-full-width">

<?php $toggle_slider_boxed = ''; ?>
<?php if(isset($options_morphis['toggle_slider_boxed'])): ?>
	<?php $toggle_slider_boxed = $options_morphis['toggle_slider_boxed']; ?>
<?php endif; ?>
  <?php if($toggle_slider_boxed == '1' && $options_morphis['boxed_full_layout_select'] == 'boxed'): ?>
	<div class="container">
<?php else : ?>
	<div class="bottom-spacer">
  <?php endif; ?>
	<div class="divider upper"></div>
	
	   <?php echo do_shortcode('[layerslider id="' . $layerslider_id . '"]'); ?>
		<div class="divider lower"></div>
		
		</div>
		
</div>
  <!-- END HOME PAGE LAYER SLIDER -->
	