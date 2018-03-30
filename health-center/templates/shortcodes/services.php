<?php
	$has_image   = !empty($image);
	$has_icon    = !empty($icon);
	$has_button  = !empty($button_link);

	$className[] = 'services clearfix';
	$className[] = $fullimage == 'true' ? 'fullimage'  : 'smallimage';
	$className[] = $has_image           ? 'has-image'  : 'no-image';
	$className[] = $has_icon            ? 'has-icon'   : 'no-icon';
	$className[] = $has_button          ? 'has-button' : 'no-button';
	$className[] = $class;
	$className   = implode(' ', $className);

?>
<div class="<?php echo $className?>" style="text-align:<?php echo $text_align?>;">
	<div class="services-inside">
		<?php if($has_image || $has_icon): ?>
			<?php if($fullimage == 'true'): ?>
				<div class="thumbnail">
					<?php if($has_button): ?>
						<a href="<?php echo $button_link?>" title="<?php echo esc_attr( $title ) ?>" class="<?php if($has_image) echo 'has-border' ?>">
					<?php endif ?>
						<?php if($has_image): ?>
							<?php wpv_url_to_image( $image ) ?>
						<?php elseif($has_icon): ?>
							<?php
								echo wpv_shortcode_icon(array(
									'name' => $icon,
									'color' => $icon_color,
									'size' => $icon_size,
								));
							?>
						<?php endif ?>
					<?php if($has_button): ?>
						</a>
					<?php endif ?>
				</div>
				<?php if($has_icon): ?>
					<div class="sep-2"></div>
				<?php endif ?>
			<?php else: ?>
				<div class="shrinking-outer clearfix">
					<div class="shrinking" style="background:<?php echo wpv_sanitize_accent($background)?> no-repeat 50% 50%;<?php if($has_image) echo esc_attr("background-image:url('$image')"); ?>">
						<?php if($has_button): ?>
							<a href="<?php echo $button_link?>" title="<?php echo esc_attr($button_text) ?>">
						<?php endif ?>
						<?php if(!$has_image && $has_icon): ?>
							<?php
								echo wpv_shortcode_icon(array(
									'name' => $icon,
									'color' => $icon_color,
								));
							?>
						<?php endif ?>
						<?php if($has_button): ?>
							</a>
						<?php endif ?>
					</div>
				</div>
			<?php endif ?>
		<?php endif ?>
		<?php if($title != ''):?>
			<h3 class="services-title">
				<?php if( !empty($button_link)): ?>
					<a href="<?php echo $button_link?>" title="<?php echo $title ?>"><?php echo $title?></a>
				<?php else: ?>
					<?php echo $title ?>
				<?php endif ?>
			</h3>
		<?php endif ?>
		<?php if(!empty($content)): ?>
			<div class="services-content"><?php echo do_shortcode($content)?></div>
		<?php endif ?>
		<?php if($button_text != '' && $has_button && !(($has_image || $has_icon) && $fullimage != 'true')): ?>
			<div class="services-button-wrap">
				<a href="<?php echo $button_link?>"><span class="btext"><?php echo $button_text?></span></a>
			</div>
		<?php endif ?>
	</div>
</div>
