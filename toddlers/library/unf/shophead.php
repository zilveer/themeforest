<?php global $unf_options;
if ($unf_options['unf_showshophead'] == 1){
?>

<div class="row">
	<div class="col-md-12">

		<div id="shophead" class="row">
			<?php if ($unf_options['unf_showshopslider'] == 1) {
			?>

				<div class="shopslider col-md-8">
					<div class="sliderloading">
						<img src="<?php echo get_template_directory_uri(); ?>/library/img/loading-white.svg" alt="loading" height="32" width="32" data-no-retina="">
					</div>
					<div class="sliderloaded">
					<div class="shopsliderwrapper">
						<div class="swiper-container">
						  <div class="swiper-wrapper">

						 	 <?php foreach( $unf_options['unf_shophomeslider'] as $slide ) :?>
						 	  <?php if (!empty($slide['image'])) {?>
							      <div class="swiper-slide">
								    <?php if (!empty($slide['url'])) {?>
								    <a href="<?php echo esc_url($slide['url']); ?>">
									<?php } ?>
									<?php echo wp_get_attachment_image( $slide['attachment_id'], 'shopbannerslide' ); ?>
							        <?php if (!empty($slide['url'])) {?>
							        </a>
							        <?php } ?>
							      </div>
						      <?php } ?>
							  <?php endforeach; ?>
						  </div>
						</div>
						<div class='pagination hidden-xs'></div>
					</div>
					</div>

					<script>
					jQuery('.sliderloaded').hide();
					jQuery(window).load(function() {
						"use strict";
						jQuery('.sliderloading').hide();
						jQuery('.sliderloaded').fadeIn();
						jQuery(function(){
						  var mySwiper = jQuery('.swiper-container').swiper({
						    //Your options here:
							pagination: '.pagination',
						    keyboardControl: true,
						    paginationClickable: true,
						    autoplay:<?php echo esc_js($unf_options['unf_shophomesliderdelay']); ?>,
						    speed:<?php echo esc_js($unf_options['unf_shophomesliderspeed']); ?>,
						    mode:'horizontal',
						    loop: true,
						    calculateHeight: true
						  });

						})
					});
					</script>

				</div>
			<?php } // end slider ?>

				<div class="<?php
					if ($unf_options['unf_showshopslider'] == 1) {?>col-md-4<?php }
					else { ?>col-md-12<?php } ?>">
					<div class="shopbuttons clearfix <?php
						if ($unf_options['unf_showshopslider'] == 1) {?>vertical-links<?php }
						else { ?>horizontal-links<?php } ?>">

						<a href="<?php if (!empty($unf_options['unf_shoplink1url'])){ echo esc_url($unf_options['unf_shoplink1url']);} else { echo '#';}?>" class="button1 shophomebuttons <?php
						if ($unf_options['unf_showshopslider'] == 1) {?>col-md-12<?php }
						else { ?>col-md-4<?php } ?>">
							<?php if (!empty($unf_options['unf_shoplink1'])){ echo wp_kses_post($unf_options['unf_shoplink1']);} else {?>
							<i class="icon icon-right-circle"></i> On Sale
							<?php } ?>
						</a>
						<a href="<?php if (!empty($unf_options['unf_shoplink2url'])){ echo esc_url($unf_options['unf_shoplink2url']);} else { echo '#';}?>" class="button2 shophomebuttons <?php
						if ($unf_options['unf_showshopslider'] == 1) {?>col-md-12<?php }
						else { ?>col-md-4<?php } ?>">
							<?php if (!empty($unf_options['unf_shoplink2'])){ echo wp_kses_post($unf_options['unf_shoplink2']);} else {?>
							<i class="icon icon-right-circle"></i> On Sale
							<?php } ?>
						</a>
						<a href="<?php if (!empty($unf_options['unf_shoplink3url'])){ echo esc_url($unf_options['unf_shoplink3url']);} else { echo '#';}?>" class="button3 shophomebuttons <?php
						if ($unf_options['unf_showshopslider'] == 1) {?>col-md-12<?php }
						else { ?>col-md-4<?php } ?>">
							<?php if (!empty($unf_options['unf_shoplink3'])){ echo wp_kses_post($unf_options['unf_shoplink3']);} else {?>
							<i class="icon icon-right-circle"></i> On Sale
							<?php } ?>
						</a>
					</div>
				</div>

		</div>

	</div>
</div>
<?php } ?>