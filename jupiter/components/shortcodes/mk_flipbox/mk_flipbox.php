<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );
$id = Mk_Static_Files::shortcode_id();

Mk_Static_Files::addCSS('
#flipbox-'.$id.' .mk-flipbox-front 	{ '.($front_background_color ? ('background-color: '.$front_background_color.';') : '').'}
#flipbox-'.$id.' .front-icon svg 	{ '.($icon_color ? ('fill:'.$icon_color.';') : '').'}
#flipbox-'.$id.' .front-title  		{ '.($font_weight ? ('font-weight:'.$font_weight.';') : '').'font-size:'.$front_title_size.'px; '.($front_title_color ? ('color:'.$front_title_color.';') : '').'}
#flipbox-'.$id.' .front-desc 		{ font-size:'.$front_desc_size.'px; '.($front_desc_color ? ('color:'.$front_desc_color.';') : '').'}
#flipbox-'.$id.' .mk-flipbox-back 	{ height:' . $min_height . 'px; '.($back_background_color ? ('background-color: '.$back_background_color.';') : '').'}
#flipbox-'.$id.' .mk-flipbox-front 	{ height:' . $min_height . 'px;}
#flipbox-'.$id.' .back-title  		{ font-weight:'.$font_weight.'; font-size:'.$back_title_size.'px; '.($back_title_color ? ('color:'.$back_title_color.';') : '').'}
#flipbox-'.$id.' .back-desc 		{ font-size:'.$back_desc_size.'px; '.($back_desc_color ? ('color:'.$back_desc_color.';') : '').'}
', $id);
?>


<div id="flipbox-<?php echo $id; ?>" onclick="" class="mk-flipbox flip-<?php echo $flip_direction; ?> <?php echo $el_class; ?> _ perspective height-full">
	<div class="mk-flipbox-holder _ height-full text-center no-pointer perspective" style="min-height: <?php echo $min_height ?>px">

		<div class="mk-flipbox-front _   a_col-1of2 no-backface origin-center bezier-1">
			<div class="mk-flipbox-content _ width-full">
				<div class="front-icon _ padding-20">
					<?php if($icon_type == 'icon'){ ?>
						<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, $icon, $icon_size); ?>
					<?php } else { ?>
					      <img src="<?php echo $image; ?>" alt="<?php echo $front_title; ?>" />
					<?php } ?>
				</div>

				<div class="front-title _ padding-20"><?php echo $front_title; ?></div>
				<div class="front-desc _ padding-x-10-pr"><?php echo preg_replace("/<\\/?p(.|\\s)*?>/", '', $front_desc); ?></div>
			</div>
		</div>

		<div class="mk-flipbox-back _   a_col-1of2 fold-back-<?php echo $flip_direction ?> no-backface chrome-flipbox-backface-fix origin-center bezier-1 pointer">
			<div class="mk-flipbox-content width-full">

				<div class="back-title _ padding-20"><?php echo $back_title; ?></div>
				<div class="back-desc _ padding-x-10-pr"><?php echo preg_replace("/<\\/?p(.|\\s)*?>/", '', $back_desc); ?></div>

				<?php 
				if($button_url) {
					$btn_atts[] = 'dimension="flat"';
					$btn_atts[] = 'corner_style="pointed"';
					$btn_atts[] = 'size="small"';
					$btn_atts[] = 'align="center"';
					$btn_atts[] = 'bg_color="'.$button_bg_color.'"';
					$btn_atts[] = 'btn_hover_bg="'.$button_bg_hover_color.'"';
					$btn_atts[] = 'text_color="'.$button_text_skin.'"';
					$btn_atts[] = 'url="'.$button_url.'"';
					$btn_atts[] = 'target="'.$button_target.'"';
					$btn_atts[] = 'margin_top="20"';
					$btn_atts[] = 'el_class="back-button _ no-backface"';
					echo do_shortcode( '[mk_button '.implode(' ', $btn_atts).']'.$button_text.'[/mk_button]');
				}
				?>
			</div>
		</div>
	</div>
</div>
