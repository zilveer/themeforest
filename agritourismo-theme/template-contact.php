<?php
/*
Template Name: Contact Page
*/	
?>
<?php get_header(); ?>
<?php 
	get_template_part(THEME_INCLUDES.'top');
	wp_reset_query();
	$mail_to = get_post_meta ( $post->ID, THEME_NAME."_contact_mail", true ); 
	$map = get_post_meta ( $post->ID, THEME_NAME."_map", true ); 
	//pin colors
	$colors = array(
		1 => "red",
		2 => "blue",
		3 => "green",
	);
?>
					<?php get_template_part(THEME_LOOP."loop","start"); ?>
						<!-- BEGIN .content-main -->
						<div class="content-main alternate full-width">

						<?php if($mail_to) { ?>
							<?php if (have_posts()) : ?>
								<?php get_template_part(THEME_SINGLE."page","title"); ?>
								<?php if($map) { ?>
									<div class="contact-map">

										<div id="map_canvas" style="height: 400px; width: 1148px;"></div>
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
													$i++;
													if($colors[$i]) {
														$color = $colors[$i];
													} else {
														$color = $colors[1];
													}
											?>
												markers = new google.maps.LatLng(<?php echo $marker->lb;?>,<?php echo $marker->mb;?>);
												new google.maps.Marker({position: markers, map: map, icon: '<?php echo THEME_IMAGE_URL;?>pin-<?php echo $color;?>.png' });
												markerBounds.extend(markers);
											<?php 
												
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


								<div class="paragraph-row">
									<?php
										//count active bloks and get values
										$title = array();
										$details = array();

										for($cc=1; $cc<=3; $cc++) {
											$title[$cc] = get_post_meta ( $post->ID, THEME_NAME."_title_".$cc, true ); 
											$details[$cc] = get_post_meta ( $post->ID, THEME_NAME."_details_".$cc, true ); 
											if($title[$cc]=="" && remove_html($details[$cc])=="" ) break;
										} 
										$cc = $cc-1;

										switch ($cc) {
											case 1:
												$class = "column12";
												break;
											case 2:
												$class = "column6";
												break;
											case 3:
												$class = "column4";
												break;
											default:
												$class = "column4";
												break;
										}

									?>
									<?php for($i=1; $i<=$cc; $i++) { ?>
										<?php
											$details[$i] = "<span>" . implode( "</span>\n\n<span>", preg_split( '/(?:\s*\n)+/', $details[$i] ) ) . "</span>";
										?>

										<div class="<?php echo $class;?> background-block">
											<div class="contact-info">
												<img src="<?php echo THEME_IMAGE_URL;?>px.gif" class="pin-<?php echo $colors[$i];?>" class="left" alt="<?php echo $title[$i];?>" />
												<?php if($title[$i]) { ?><h3><?php echo $title[$i];?></h3><?php } ?>
												<?php echo $details[$i];?>
											</div>
										</div>
									<?php } ?>

								</div>

								<div class="split-line-1"></div>

								<div class="paragraph-row">
									<div class="column6">
										<?php the_content(); ?>	
									</div>
									<div class="column6">

										<div class="writecomment">

											<div class="coloralert contact-success-block" style="display:none;" style="background: #68a117;">
												<p><?php _e("Success!",THEME_NAME);?></p>
												<a href="#close-alert" class="icon-text">&#10006;</a>
											</div>

											<form id="writecomment" name="writecomment" class="contact-form" action="">
												<input type="hidden"  name="form_type" value="contact" />
												<input type="hidden"  name="post_id" value="<?php echo $post->ID;?>" />

												<p class="contact-form-user">
													<label for="c_name"><?php _e("Nickname", THEME_NAME);?><span class="required">*</span></label>
													<input type="text" name="u_name" id="contact-name-input" placeholder="<?php _e("Nickname", THEME_NAME);?>" title="<?php _e("Nickname", THEME_NAME);?>" />
													<span class="error-msg" id="contact-name-error" style="display:none;"><span class="icon-text">&#9888;</span><font class="ot-error-text"></font></span>
												</p>
												<p class="contact-form-email">
													<label for="c_name"><?php _e("E-mail", THEME_NAME);?><span class="required">*</span></label>
													<input type="text" name="email" id="contact-mail-input" placeholder="<?php _e("E-mail address", THEME_NAME);?>" title="<?php _e("E-mail", THEME_NAME);?>" />
													<span class="error-msg" id="contact-mail-error" style="display:none;"><span class="icon-text">&#9888;</span><font class="ot-error-text"></font></span>
												</p>
												<p class="contact-form-message">
													<label for="c_name"><?php _e("Your message", THEME_NAME);?><span class="required">*</span></label>
													<textarea name="message" placeholder="<?php _e("Your message", THEME_NAME);?>" id="contact-message-input"></textarea>
													<span class="error-msg" id="contact-message-error" style="display:none;"><span class="icon-text">&#9888;</span><font class="ot-error-text"></font></span>
												</p>
												<p class="form-submit">
													<input onClick="Validate(); return false;" name="submit" type="submit" class="styled-button" id="contact-submit" value="<?php printf ( __( 'Send a Message' , THEME_NAME ));?>" />
												</p>
											</form>
										</div>
									</div>
								</div>
								<?php else: ?>
									<p><?php printf ( __('Sorry, no posts matched your criteria.' , THEME_NAME )); ?></p>
								<?php endif; ?>
							<?php } else { echo "<span style=\"color:#000; font-size:14pt;\">You need to set up Your contact mail!</span>"; } ?>
							<!-- END .content-main -->
							</div>
<?php get_template_part(THEME_LOOP."loop","end"); ?>
<?php get_footer(); ?>