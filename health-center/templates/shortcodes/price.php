<div class="price-outer-wrapper">
	<div class="price-wrapper <?php echo $featured=='true'? 'featured':'' ?>">
		<h3 class="price-title"><?php echo $title ?></h3>
		<div class="price" style="text-align:<?php echo $text_align?>">
			<div class="value-box">
				<div class="value-box-content">
					<span class="value">
						<i><?php echo $currency?></i><span class="number"><?php echo $price?></span>
					</span>
					<span class="meta <?php if(empty($duration)) echo 'invisible' ?>"><?php echo $duration?></span>
				</div>
			</div>

			<div class="content-box">
				<?php echo do_shortcode($content)?>
			</div>
			<div class="meta-box">
				<?php if(!!$summary):?><p class="description"><?php echo htmlspecialchars_decode($summary)?></p><?php endif?>
				<?php
					echo wpv_shortcode_button(array(
						'link' => $button_link,
						'bgcolor' => 'accent1',
						'hover_color' => 'accent1',
						'style' => 'border',
					), $button_text, 'button');
				?>
			</div>
		</div>
	</div>
</div>