<?php require_once( '../../../../wp-load.php' );?>

<a href="#" onclick="javascript:lightboxclose();" class="light-close"><span>&#10062;</span><?php _e("Close Window",THEME_NAME);?></a>
<div class="main-block">
	
	<!-- BEGIN .panel-content -->
	<div class="panel-content">
		
		<div class="big-photo-block ot-slide-item">
			<span class="next-image" data-next="0"></span>

			<span class="gal-current-image gallery-full-photo">
				<div class="the-image loading waiter">
					<div class="the-image">
						<a href="#gal-prev" class="prev icon-text">&#59233;</a>
						<a href="#gal-next" class="next icon-text">&#59234;</a>
						<img class="image-big-gallery ot-gallery-image" data-id="0" style="display:none;" src="#" alt="" />
					</div>
				</div>
			</span>
			<div class="the-thumbs" id="ot-lightbox-thumbs">
			</div>
		</div>

		<div class="lightbox-content">
			<div class="split-line-1"></div>

			<h2 class="ot-light-title"></h2>

			<p id="ot-lightbox-content"></p>
		</div>

	</div>
	<div class="clear-float"></div>
	
</div>
