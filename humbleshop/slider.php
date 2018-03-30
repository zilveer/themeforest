	<!-- ====== -->
	<!-- SLIDER -->
	<!-- ====== -->
	<section id="slider">
	<div class="container">
		
		<?php if( get_theme_mod('homeslider')) : ?>
		<div class="row">
			<div class="col-12 flexslider masthead">
				<ul class="slides">
					<?php $slide = ot_get_option( 'slider' );
	
					if ($slide) {
						foreach($slide as $key => $value) {
						 	echo '<li>';
						 	if ($value['slider_link']) { 
						 		echo '<a href="'.$value['slider_link'].'">';
						 		echo '<img src="'.$value['slider_img'].'" alt="'.$value['title'].'" />';
						 		echo '</a>';
						 	} else {
						 		echo '<img src="'.$value['slider_img'].'" alt="'.$value['title'].'" />';
						 	}
						 	if ($value['slider_caption']) {
						 		echo '<div class="flex-caption">';
						 		echo $value['slider_caption'];
						 		echo '</div>';
						 	}
						 	echo '</li>';
						}
					} else { ?>
						
						<li>
							<img src="//placehold.it/1000x400" alt="">
							<div class="flex-caption">
								Hello world <br> <a href="#" class="btn btn-sm btn-danger">BUY NOW</a>
							</div>
						</li>
						<li><img src="//placehold.it/1000x400" alt=""></li>
						<li><img src="//placehold.it/1000x400" alt=""></li>
						<li><img src="//placehold.it/1000x400" alt=""></li>
						<li><img src="//placehold.it/1000x400" alt=""></li>
						<li><img src="//placehold.it/1000x400" alt=""></li>

					<?php } ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
		
		<?php if( get_theme_mod('homecarousel')) : ?>
		<div class="row hidden-xs">
			<div class="col-12 flexslider carousel">
				<ul class="slides">
					<?php $slide = ot_get_option( 'slider' );
	
					if ($slide) {
						foreach($slide as $key => $value) {
						 	echo '<li>';
						 	if ($value['slider_link']) { 
						 		echo '<a href="'.$value['slider_link'].'">';
						 		echo '<img src="'.$value['slider_img'].'" alt="'.$value['title'].'" />';
						 		echo '</a>';
						 	} else {
						 		echo '<img src="'.$value['slider_img'].'" alt="'.$value['title'].'" />';
						 	}
						 	if ($value['slider_caption']) {
						 		echo '<p class="flex-caption">';
						 		echo $value['slider_caption'];
						 		echo '</p>';
						 	}
						 	echo '</li>';
						}
					} else { ?>
						
						<li><img src="//placehold.it/1000x400" alt=""></li>
						<li><img src="//placehold.it/1000x400" alt=""></li>
						<li><img src="//placehold.it/1000x400" alt=""></li>
						<li><img src="//placehold.it/1000x400" alt=""></li>
						<li><img src="//placehold.it/1000x400" alt=""></li>
						<li><img src="//placehold.it/1000x400" alt=""></li>

					<?php } ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
		
		<?php if( get_theme_mod('homepromo')) : ?>
		<div class="row" id="promobanner">
			<?php 
			$promo = ot_get_option('banner');
			if ($promo) {
				foreach($promo as $key => $value) {
					echo '<article class="col-sm-4"><a href="'.$value['promo_link'].'"><img src="'.$value['promo_img'].'" alt="" class="img-responsive" /></a></article>'; 
				} 
			} else { ?>
				<div class="col-sm-4">
					<img src="//placehold.it/500x250" alt="" class="img-responsive">
				</div>
				<div class="col-sm-4">
					<img src="//placehold.it/500x250" alt="" class="img-responsive">
				</div>
				<div class="col-sm-4">
					<img src="//placehold.it/500x250" alt="" class="img-responsive">
				</div>
			<?php } ?>
		</div>
		<?php endif; ?>

	</div>
</section>