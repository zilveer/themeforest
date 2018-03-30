<?php 
	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true); 
		if(!empty($content)){
			?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content">
					<?php echo $content; ?>
				</div>
			</div>
			<?php
		}
	} 
?>