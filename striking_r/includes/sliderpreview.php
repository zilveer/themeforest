<!DOCTYPE html>
<html <?php language_attributes(); ?> style="margin-top:0 !important">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php _e('Slide Layers Preview','theme_admin'); ?></title>
<?php wp_head(); ?>
<!--[if IE 6 ]>
	<link href="<?php echo THEME_CSS;?>/ie6.css" media="screen" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo THEME_JS;?>/dd_belatedpng-min.js"></script>
	<script type="text/javascript" src="<?php echo THEME_JS;?>/ie6.js"></script>
<![endif]-->
<!--[if IE 7 ]>
<link href="<?php echo THEME_CSS;?>/ie7.css" media="screen" rel="stylesheet" type="text/css">
<![endif]-->
<!--[if IE 8 ]>
<link href="<?php echo THEME_CSS;?>/ie8.css" media="screen" rel="stylesheet" type="text/css">
<![endif]-->
<!--[if IE]>
	<script type="text/javascript" src="<?php echo THEME_JS;?>/html5.js"></script>
<![endif]-->
<script type="text/javascript">
var image_url='<?php echo THEME_IMAGES;?>';
<?php
	$fancybox_width = theme_get_option('advanced','fancybox_width');
	$fancybox_height = theme_get_option('advanced','fancybox_height');
	$fancybox_autoSize = theme_get_option('advanced','fancybox_autoSize')?'true':'false';
	$fancybox_autoWidth = theme_get_option('advanced','fancybox_autoWidth')?'true':'false';
	$fancybox_autoHeight = theme_get_option('advanced','fancybox_autoHeight')?'true':'false';
	$fancybox_fitToView = theme_get_option('advanced','fancybox_fitToView')?'true':'false';
	$fancybox_aspectRatio = theme_get_option('advanced','fancybox_aspectRatio')?'true':'false';
	$fancybox_arrows = theme_get_option('advanced','fancybox_arrows')?'true':'false';
	$fancybox_closeBtn = theme_get_option('advanced','fancybox_closeBtn')?'true':'false';
	$fancybox_closeClick = theme_get_option('advanced','fancybox_closeClick')?'true':'false';
	$fancybox_nextClick = theme_get_option('advanced','fancybox_nextClick')?'true':'false';
	$fancybox_autoPlay = theme_get_option('advanced','fancybox_autoPlay')?'true':'false';
	$fancybox_playSpeed = theme_get_option('advanced','fancybox_playSpeed');
	$fancybox_preload = theme_get_option('advanced','fancybox_preload');
	$fancybox_loop = theme_get_option('advanced','fancybox_loop')?'true':'false';
	$fancybox_thumbnail = theme_get_option('advanced','fancybox_thumbnail')?'true':'false';
	$fancybox_thumbnail_width = theme_get_option('advanced','fancybox_thumbnail_width');
	$fancybox_thumbnail_height = theme_get_option('advanced','fancybox_thumbnail_height');
	$fancybox_thumbnail_position = theme_get_option('advanced','fancybox_thumbnail_position');

		echo <<<JS
var fancybox_options = {
	width : {$fancybox_width},
	height : {$fancybox_height},
	autoSize: {$fancybox_autoSize},
	autoWidth: {$fancybox_autoWidth},
	autoHeight: {$fancybox_autoHeight},
	fitToView : {$fancybox_fitToView},
	aspectRatio: {$fancybox_aspectRatio},
	arrows: {$fancybox_arrows},
	closeBtn: {$fancybox_closeBtn},
	closeClick: {$fancybox_closeClick},
	nextClick: {$fancybox_nextClick},
	autoPlay: {$fancybox_autoPlay},
	playSpeed: {$fancybox_playSpeed},
	preload: {$fancybox_preload},
	loop: {$fancybox_loop},
	thumbnail : {$fancybox_thumbnail},
	thumbnail_width : {$fancybox_thumbnail_width},
	thumbnail_height : {$fancybox_thumbnail_height},
	thumbnail_position: '{$fancybox_thumbnail_position}'
};
JS;
?>
</script>
<?php
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-resizable');
?>

<style type="text/css">
body{
	position:relative;
}
.theme_slide_layer.big_black{
	display:inline-block;
	font-size:30px;
	background-color:white;
	line-height:35px;
}

.theme_slide_layer{
	position:absolute;
	top:0;
	left:0;
}
#preview{
	position:relative;
	margin:20px auto;
	height:300px;
	width:600px;
	overflow:hidden;
	border:1px solid #000;
}
#bg{
	width:100%;
	height:100%;
}
.ui-resizable {
position: relative;
}

.ui-resizable-e {
cursor: e-resize;
width: 7px;
right: -5px;
top: 0;
height: 100%;
}
.ui-resizable-handle {
position: absolute;
font-size: 0.1px;
display: block;
}
.ui-resizable-se {
cursor: se-resize;
width: 12px;
height: 12px;
right: 1px;
bottom: 1px;
}
#info{
	text-align:center;
}
.theme_slide_layer.is-focus{
    -webkit-box-shadow: 0 0 8px #DDE573; 
	-moz-box-shadow: 0 0 8px #DDE573;	
	box-shadow: 0 0 8px #DDE573;
}
.theme_slide_layer:hover {
	cursor:move;
}
</style>
</head>
<body>
<div id="info">
	<?php echo __('Preview Width:','theme_admin');?><span id="infoWidth"></span>&#59;
	<?php echo __('Preview Height:','theme_admin');?><span id="infoHeight"></span>
</div>
<div id="preview">
<?php
$post_id = (int)$_GET['sliderid'];
$feature_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
?>

	<img id="bg" src="<?php echo $feature_image[0];?>"/>

<?php
$query = array(
	'post_type' => 'layer',
	'meta_key'=>'_layer_index',
	'orderby' => 'meta_value',
	'order' => 'ASC',	
	'meta_query' => array(
		array(
			'key' => 'slide_id',
			'value' => $post_id,
		)
	)
);
$r = new WP_Query($query);

$i = 1;
while($r->have_posts()) {
	$r->the_post();
	$layer_id = get_the_ID();
	$class =  get_post_meta($layer_id,'_layer_class',true);
	$style = get_post_meta($layer_id,'_layer_style',true);
	$active = get_post_meta($layer_id,'_layer_active',true);
	$top = get_post_meta($layer_id,'_layer_top',true);
	$left = get_post_meta($layer_id,'_layer_left',true);

	if(!empty($style)){
		$style = str_replace(array(" ","\n","\r","\t"),'',$style);
	}

	if(!empty($active) && ! $active){
		$hide = 'display:none;';
	}else{
		$hide = '';
	}

	if(empty($top)){
		$top = 0;
	}

	if(empty($left)){
		$left = 0;
	}

	if(empty($class)){
		$class = '';
	}

	if(empty($style)){
		$style = '';
	}

	$zIndex = $i * 10;

	$zIndex = 'z-index:'.$zIndex.';';
	$top = ' data-top="'.($top*3.0).'" ';
	$left = ' data-left="'.($left*6.0).'" ';
	echo '<div '.$top.$left.'id="layer_options_'.$layer_id.'" class="theme_slide_layer '.$class.'" style="'.$hide.$zIndex.$style.'">';
	$content = get_post_meta($layer_id,'_layer_content',true);

	if(empty($content)){
		$content = '';
	}

	echo  do_shortcode(stripcslashes($content));
	echo '</div>';
	$i++;
}
?>
</div>
<?php wp_footer();?>

<script type="text/javascript">
	var initLayer = function(id){
		var $layer = jQuery('#'+id);

		if($layer.length > 0){
			$layer.draggable({
				cursor: 'move',
				create: function( event, ui ) {
					var top =jQuery(this).data('top');
					var left = jQuery(this).data('left');

					jQuery(this).css({
						top:top,
						left:left
					});
				}
			});
		}
	}
	jQuery(document).ready(function(){
		jQuery('#wpadminbar').remove();
		jQuery('body').css({
			'margin':0
		});	
		jQuery('#infoWidth').html(jQuery('#preview').width()+'px');
		jQuery('#infoHeight').html(jQuery('#preview').height()+'px');

		var parentDoc = window.parent.document;
		var $iframe = jQuery(parentDoc).find('#sliderPreview');
		$iframe.height(jQuery('#preview').height()+60);

		jQuery('.theme_slide_layer').each(function(){
			var layer_id = jQuery(this).attr('id');
			initLayer(layer_id);
		});

		jQuery( ".theme_slide_layer" ).live("drag", function( event, ui ) {
			var outterWidth = jQuery(this).parent().width();
			var outterHeight = jQuery(this).parent().height();

			var offsetLeft = ui.position.left;
			var offsetTop = ui.position.top;
	
			var left = offsetLeft/outterWidth *100;
			var top = offsetTop/outterHeight * 100;
	
			var id = jQuery(this).attr('id');

			var $layer = jQuery(parentDoc).find('#'+id);

			$layer.find('input[name*=layer_left]').val(left);
			$layer.find('input[name*=layer_top]').val(top);
		
		});
	
		var maxWidth = $iframe.parent().width();
		jQuery( "#preview" ).resizable({
			maxWidth : maxWidth-40,
			maxHeight:1000,
			minWidth:100,
			minHeight:100,
			grid: 1

		});

		jQuery( "#preview" ).on( "resize", function( event, ui ) {
			$iframe.height(ui.size.height+60);
			jQuery('#infoWidth').html(ui.size.width+'px');
			jQuery('#infoHeight').html(ui.size.height+'px');
		});

		jQuery( "#preview" ).on( "resizestop", function(){
			jQuery( ".theme_slide_layer" ).each(function(){
				var outterWidth = jQuery(this).parent().width();
				var outterHeight = jQuery(this).parent().height();
				
				var offsetLeft = parseFloat(jQuery(this).css('left').replace('px',''));
				var offsetTop = parseFloat(jQuery(this).css('top').replace('px',''));
	
				var left = offsetLeft/outterWidth *100;
				var top = offsetTop/outterHeight * 100;
	
				var id = jQuery(this).attr('id');

				var $layer = jQuery(parentDoc).find('#'+id);

				$layer.find('input[name*=layer_left]').val(left);
				$layer.find('input[name*=layer_top]').val(top);
				
			});

		});

		jQuery( ".theme_slide_layer" ).live('mousedown',function(){
			$this = jQuery(this);

			if(! $this.hasClass('is-focus')){
				jQuery('.theme_slide_layer').removeClass('is-focus');
				$this.addClass('is-focus');
				var id = $this.attr('id');
				var $items = jQuery(parentDoc).find('.layer-item').removeClass('is-focus').removeClass('active');
				$items.find('.layer-pane').removeClass('active');
				$items.find('.layer-nav-item').removeClass('active');

				var $active = jQuery(parentDoc).find('#'+id).addClass('is-focus');

				$active.addClass('active');
				$active.find('.layer-nav a:eq(0)').addClass('active');
				$active.find('.layer-pane:eq(0)').addClass('active');
			}

		});
	
	});
</script>
</body>
</html>

