<?php global $options_data; ?>
<div id="portfolio-content" class="portfolio-sidebyside clearfix">
	<div class="span8">
		<?php if( get_post_meta( get_the_ID(), 'richer_embed', true ) == "" ){ ?>
				<?php global $wpdb, $post;
			    $images = rwmb_meta( 'richer_screenshot', 'type=image&size=standard' );
			    $id = rand(1, 999);
			    if(!empty($images)){
				    $rel="prettyPhoto[slides".$id."]";
					if(sizeof($images) < 2) {
						$rel="prettyPhoto";
					}
		    		if(get_post_meta( get_the_ID( ), 'richer_gridlayout', true ) != "true") { ?>
		    			<?php if(get_post_meta( get_the_ID( ), 'richer_slider_thumb', true ) == "true") {
		    				$directionNav = 'false';
		    			} else {
		    				$directionNav = 'true';
		    			} ?>
			    		<script>
							jQuery(window).load(function(){
								jQuery('#portfolio-thumb-carousel').flexslider({
									animation: 'slide',
									controlNav: false,
									directionNav: true,
									slideshow: false,
									itemWidth: 240,
									itemMargin: 4,
									minItems: 3,
									maxItems:3,
									touch: true,
									useCSS: false,
									asNavFor: '#portfolio-slider'
								});
								jQuery('#portfolio-slider').flexslider({
									animation: "fade",
									smoothHeight: true,
									controlNav: false,
									directionNav: <?php echo $directionNav;?>,
									touch: true,
									useCSS: false,
									sync: '#portfolio-thumb-carousel'
								});
							});
						</script>		
						<div id="portfolio-slider" class="flexslider">
							<ul class="slides">
						   <?php	
						   foreach ( $images as $att ) {
					    		// Show image
					    		echo "<li><a href='". $att['full_url'] . "' rel='".$rel."' class='prettyPhoto' title='".$att['title']."'><img src='". $att['url'] . "' alt='".$att['alt']."'/><div class='overlay'></div></a></li>";
					    	}?>
						   </ul>
				    	</div> 
				    	<?php if(get_post_meta( get_the_ID( ), 'richer_slider_thumb', true ) == "true") {?>
					    	<div id="portfolio-thumb-carousel" class="flexslider">
					    		<ul class="slides">
					    		<?php
					    		$images = rwmb_meta( 'richer_screenshot', 'type=image&size=span4-thin' );
							   foreach ( $images as $att ) {
						    		echo "<li><a href='javascript: void(0);'><img src='". $att['url'] . "' alt='".$att['alt']."'/></a></li>";
						    	}?>
					    		</ul>
					    	</div>
				    	<?php } ?>
			    <?php } else {?>
			    		<div id="portfolio-images" class="row-fluid">
				   <?php
				   $images = rwmb_meta( 'richer_screenshot', 'type=image&size=span4' );	
				   foreach ( $images as $att ) {
				    		// Show image
				    		echo "<div class='portfolio-image span4'><a href='". $att['full_url'] . "' rel='".$rel."' class='prettyPhoto' title='".$att['title']."'><img src='". $att['url'] . "' alt='".$att['alt']."'/><div class='overlay'></div></a></div>";
				    	}?>
				    </div>
			    <?php }
				} else {
			    	if(has_post_thumbnail()) {
			    		echo '<div class="portfolio-pic">';
			    		the_post_thumbnail('standard');
			    		echo '</div>';
			    	} else {
			    		$no_img = wp_get_attachment_image_src( 1300, 'full', true );
			    		echo '<span class="portfolio-pic"><img src="'.$no_img[0].'" alt="" /></span>';
			    	}
			    } ?>
				   
		<?php } else { ?>
				    
		    <?php  
		    if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
		        echo '<div id="portfolio-video"><div><iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
		    }  
		    else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
		        echo '<div id="portfolio-video"><div><iframe width="960" height="540" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe></div></div>';  
		    }  
		    else {  
		        echo '<div id="portfolio-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>'; 
		    }  
		    ?>
		    
		<?php } ?>

		<div class="portfolio-comments"><?php comments_template(); ?></div>

	</div>
	
	<div class="span4">
			<div class="portfolio-detail-attributes">
				<h4><?php _e('About Project:', 'richer'); ?></h4>
				<div class="portfolio-detail-description">
					<div class="portfolio-detail-description-text"><?php the_content(); ?></div>
				</div>
				<?php if( get_post_meta( get_the_ID(), 'richer_portfolio-details', true ) == 1 ) { ?>
				<div class="portfolio-detail-attributes">
					<div class="date">
						<h4><?php _e('Posted on', 'richer'); ?>:</h4>
						<?php the_date() ?>
					</div>
					<?php 
					if( get_post_meta( get_the_ID(), 'richer_portfolio-client', true ) != "") { ?>	
						<div class="client">
							<h4><?php _e('Client', 'richer'); ?>:</h4>
							<?php echo get_post_meta( get_the_ID(), 'richer_portfolio-client', true ); ?>
						</div>
					<?php } ?>
					<?php if(get_post_meta( get_the_ID( ), 'richer_wysiwyg', false )){
							$descriptions = implode(' ', get_post_meta( get_the_ID( ), 'richer_wysiwyg', false )); ?>
							<div class="details">
								<?php echo do_shortcode($descriptions); ?>
							</div>
					<?php } ?>
				</div>
				<?php if($options_data['check_sharebox_folio'] != 0) {
					get_template_part( 'framework/inc/sharebox-folio' ); 
				} ?>
			<?php } ?>
			<div class="clear"></div>
		</div>
	</div>
</div>