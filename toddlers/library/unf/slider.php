<div class="row clearfix">
	<div class="col-md-12 column">

		<?php if( have_rows('mobile_slides') ){ ?>
		<style>
		@media (max-width: 767px) {
			#desktop-slider {
		    	display: none;
			}
		}
		@media (min-width: 767px) {
			#mobile-slider {
		    	display: none;
			}
		}
		</style>
		<?php }?>

		<div id="desktop-slider">
		<?php get_template_part('library/unf/slider/desktopslider');?>
		</div>

		<div id="mobile-slider">
			<?php get_template_part('library/unf/slider/mobileslider');?>
		</div>

	</div>
</div>




