<?php
	$featured_image = thb_get_featured_image( thb_get_page_ID(), 'full' );
?>
<div id="thb-full-background">
	<div class="thb-page-overlay"></div>
	<div class="slide">
		<img src="<?php echo $featured_image; ?>" alt="">
	</div>
</div>