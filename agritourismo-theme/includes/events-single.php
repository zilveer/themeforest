<?php
	wp_reset_query();
	
	global $OTunder;

	$singleImage = get_post_meta( $post->ID, THEME_NAME."_single_image", true );
	
	
	//social icons
	$shareAll = get_option(THEME_NAME."_share_all");
	$shareSingle = get_post_meta( $post->ID, THEME_NAME."_share_single", true ); 

	//event data
	$date = get_post_meta( $post->ID, THEME_NAME."_datepicker", true ); 
	$map = get_post_meta( $post->ID, THEME_NAME."_map", true ); 
	$countdown = get_post_meta( $post->ID, THEME_NAME."_countdown", true ); 
	$ticket = get_post_meta( $post->ID, THEME_NAME."_ticket", true ); 
	$buttonText = get_post_meta( $post->ID, THEME_NAME."_button_text", true ); 
	$buttonUrl = get_post_meta( $post->ID, THEME_NAME."_button_url", true ); 
	$venue = get_post_meta( $post->ID, THEME_NAME."_venue", true ); 
	$details = get_post_meta( $post->ID, THEME_NAME."_details", true ); 



?>
				<?php get_template_part(THEME_LOOP."loop","start"); ?>
					<?php ot_get_sidebar($post->ID, 'left'); ?>		
					
					<div class="content-main alternate <?php OT_content_class($post->ID);?>">
						<?php if (have_posts()) : ?>
							<div class="event-header left">
								<?php if($map) { ?>
									<div class="maps">

										<div id="map_canvas" style="height: 350px; width: 350px;"></div>
										<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;language=en"></script>
										<script type="text/javascript">
											<?php 
												$markers = json_decode($map);
											?>
											var mapOptions = { mapTypeId: google.maps.MapTypeId.ROADMAP };
											var markerBounds = new google.maps.LatLngBounds();
											var map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
											<?php 
												$i=0;
												foreach($markers as $marker) {
											?>
												markers = new google.maps.LatLng(<?php echo $marker->lb;?>,<?php echo $marker->mb;?>);
												new google.maps.Marker({position: markers, map: map, icon: '<?php echo THEME_IMAGE_URL;?>pin-red.png' });
												markerBounds.extend(markers);
											<?php 
												$i++;
												} 

												if($i==1) {
											?>
												map.setZoom(15);
												map.setCenter(markers);
											<?php
												} else {
											?>
												map.fitBounds(markerBounds);
											<?php
												}
											?>	


											

										</script>
									</div>
								<?php } ?>
								<?php if($countdown=="show") { ?>
									<div class="event-status">
										<span><?php _e("Event Status", THEME_NAME);?></span>
										<div class="countdown-text" rel="<?php echo $date;?>">00:00:00:00</div>
									</div>
								<?php } ?>
								<?php if($ticket) { ?>
									<a href="<?php echo $ticket;?>" class="event-button" style="background-color:#8cb42a;" target="_blank">
										<?php _e("Buy Tickets to this event", THEME_NAME);?>
									</a>
								<?php } ?>
								<?php if($buttonUrl || $buttonText) { ?>
									<a href="<?php echo $buttonUrl;?>" class="event-button" target="_blank"><?php echo $buttonText;?></a>
								<?php } ?>
							</div>

							<div class="main-event-content">
								<h2><?php the_title();?></h2>

								<div class="article-icons">
									<?php if($venue) { ?>
										<span class="article-icon">
											<span class="icon-text">&#59172;</span><?php echo $venue;?>
										</span>
									<?php } ?>
									<a href="<?php the_permalink();?>" class="article-icon">
										<span class="icon-text">&#128340;</span>
										<?php echo date("F d, Y, H:i",$date);?>
									</a>
								</div>

								<?php the_content();?>

								<div class="split-line-1"></div>

								<div class="more-info">

									<div class="left">

										<div class="event-info">
											<span><?php _e("Date", THEME_NAME);?></span>
											<b><?php echo date("d F",$date);?></b>
										</div>
										<div class="event-info">
											<span><?php _e("Time", THEME_NAME);?></span>
											<b><?php echo date("H:i",$date);?></b>
										</div>

									</div>
									<div class="right">
										<?php if($venue) { ?>
											<div class="event-info">
												<span><?php _e("Venue", THEME_NAME);?></span>
												<b><?php echo $venue;?></b>
											</div>
										<?php } ?>
										<?php if($details) { ?>
										<div class="event-info">
											<span><?php _e("More Details", THEME_NAME);?></span>
											<b><?php echo $details;?></b>
										</div>
										<?php } ?>
									</div>
									<div class="clear-float"></div>

								</div>
							</div>

							<div class="clear-float"></div>
							<div class="split-line-1"></div>
							<?php get_template_part(THEME_SINGLE."share"); ?>
							<?php wp_reset_query(); ?>
							<?php if ( comments_open() ) : ?>
								<?php comments_template(); // Get comments.php template ?>
							<?php endif; ?>
						<?php else: ?>
							<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
						<?php endif; ?>

						<!-- END .content-main -->
						</div>

						<?php ot_get_sidebar($post->ID, 'right'); ?>	
				<?php get_template_part(THEME_LOOP."loop","end"); ?>
