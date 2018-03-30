                     <?php $layout = (yit_work_get( 'layout' ) != '') ? yit_work_get( 'layout' ) : 'small' ?>
                        <div id="portfolio" class="portfolio-full-description portfolio-full-<?php echo $layout ?>">
						<?php                       
                                if ( ! isset( $current_portfolio ) )
                                    { $current_portfolio = false; }
                                       
        	                	$i = 0;         
        	                    $item_id = yit_work_get('item_id');
        	                    $video = yit_work_get('video_url');
        	                    
        	                    $date_format  = yit_get_option( 'portfolio_date_format', get_option('date_format') );
        	                    $skills_label = yit_work_get('skills_label');
        	                    $skills       = yit_work_get('skills');
        	                    
        	                    $skills_label = isset( $skills_label ) && ! empty( $skills_label ) ? $skills_label : __('Skills', 'yit');
        	                    $skills       = isset( $skills ) && ! empty( $skills ) ? $skills : '';
        	                    
								$item_selected = $item_id;
						
						      	$video_url = yit_work_get('video_url');
						        $image_url = yit_work_get('image');
						        $image_id  = yit_work_get('item_id');
						                                
						        $post_permalink = yit_work_permalink( $image_id );
								$click_event = yit_get_option( 'thumbnail-portfolios', 'lightbox' );
								
						        $class = '';
						        if ( ! empty( $video_url ) ) {
						                                	
									list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
									if( $video_type == 'youtube' ) {
										$video_url = 'http://www.youtube.com/embed/' . $video_id . '?width=640&height=480&iframe=true';
									} else if( $video_type == 'vimeo') {
										$video_url = 'http://player.vimeo.com/video/' . $video_id;
									}
															
						            $thumb = $video_url;
						            $class = 'video';
						        } else {
						            $thumb = $image_url;
						            $class = 'img';
						        }
								
								$customer = yit_work_get('customer');
                        		$website = yit_work_get('website_name');
                        		$website_url = yit_work_get('website_url');
                        		$year = yit_work_get('year');
                        		$categories = yit_work_get('terms');
								
								$extra_images = yit_work_get('extra-images');
								
								$lightbox = yit_work_get( 'event_project_lightbox' );
								
						?>     
						<?php if ( $layout == 'small') :?>
							<!-- START SMALL LAYOUT -->		
                                <div <?php post_class( 'work group row' ) ?>>
									<?php if ( ! empty( $image_url ) || ! empty( $video_url ) ) : ?>
						                <div class="work-thumbnail span6">
						                    <div class="thumb-wrapper">
    											<?php if( $video_url ): ?>
    						                        <div class="post_video <?php echo $video_type ?>">
    						                            <?php echo do_shortcode( "[$video_type video_id=\"$video_id\" width=\"100%\" height=\"100%\"]" ); ?>
    						                        </div>
    											<?php else: ?>  
    						                        <?php if ( empty( $extra_images ) ) : ?> 
										                <div class="work-thumbnail">                                                                                                                           
														  	<div class="<?php if ( !$lightbox ) : ?>picture_overlay_empty <?php endif ?>picture_overlay">
														  		<?php yit_image( "id=$image_id&size=thumb_portfolio_fulldesc" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc' ); ?>
														  	
														  		<?php if ( $lightbox ) : ?>   
														  		<div class="overlay">
														  			<div>
														  				<p>
																			<a href="<?php echo $thumb ?>" rel="lightbox_fulldesc" class="lightbox_fulldesc"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a>
																		</p>
														  			</div>
														  		</div>
														  		<?php endif ?>
														    </div>
										                </div>
    	                                            <?php else : array_unshift( $extra_images, $image_id ); ?>
    	                                                <div class="extra-images-slider">
    	                                                    <ul class="slides">
    	                                                        <?php foreach ( $extra_images as $image_id ) : ?>
    	                                                        <li><?php //yit_image( "id=$image_id&size=thumb_portfolio_fulldesc" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc' ); ?>
    	                                                        	
																  	<div class="<?php if ( !$lightbox ) : ?>picture_overlay_empty <?php endif ?>picture_overlay">
																  		<?php yit_image( "id=$image_id&size=thumb_portfolio_fulldesc" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc' ); ?>

	    	                                                        	<?php if ( $lightbox ) : ?>   
																  		<div class="overlay">
																  			<div>
																  				<p>
																					<a href="<?php yit_image( "id=$image_id&output=url" ) ?>" rel="lightbox_fulldesc" class="lightbox_fulldesc"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a>
																				</p>
																  			</div>
																  		</div>
																  		<?php endif ?>
																    </div>


    	                                                        </li>
    	                                                        <?php endforeach; ?>
    	                                                    </ul>
    	                                                </div>
    	                                                <script type="text/javascript">
    	                                                    jQuery(document).ready(function($){
    	                                                        $('.extra-images-slider').flexslider({
                                                                    controlNav: false
                                                                });    
    	                                                    });
    	                                                </script>
    	                                            <?php endif; ?>
    	                                            
													<script>
													jQuery(document).ready(function($){
														jQuery(".work-thumbnail .overlay a.lightbox_fulldesc").colorbox({
															transition:'elastic',
															rel:'lightbox_fulldesc',
															fixed:true,
															maxWidth: '80%',
															maxHeight: '80%',
															opacity : 0.7
														});
													});
													</script>
    						                    <?php endif ?>
    						                </div>
						                </div>
									<?php endif ?>
									
						            <div class="work-description span6">
                                        <h3><?php yit_work_the('title') ?></h3>
						                <?php yit_work_the('content'); ?>
						
						                <?php if( ($skills && $skills_label) || $year || $customer ): ?>
                                            <div class="work-skillsdate span6">
                                                <?php if( ! empty( $skills ) && ! empty( $skills_label ) ): ?><p class="categories paragraph-links"><span class="meta-label"><?php echo $skills_label ?>:</span> <?php echo $skills ?></p><?php endif ?>
                                                <?php if( ! empty( $customer ) ): ?><p class="customer"><span class="meta-label"><?php echo _e('Customer', 'yit') ?>:</span> <?php echo $customer; ?> <?php if ( ! empty( $website ) || ! empty( $website_url ) ) : ?>- <a href="<?php echo esc_url( $website_url ) ?>"><?php echo empty( $website ) ? $website_url : $website; ?></a><?php endif ?></p><?php endif ?>
                                                <?php if( ! empty( $year ) ): ?><p class="workdate"><span class="meta-label"><?php echo _e('Year', 'yit') ?>:</span> <?php echo $year; ?></p><?php endif ?>
                                            </div>
                                        <?php endif ?>
						            </div>
						            <div class="clear"></div>
								</div>
							<!-- END SMALL LAYOUT -->	
						<?php elseif ( $layout == 'big' ) :?>		
							<!-- START BIG LAYOUT -->	
							<div <?php post_class( 'work group row' ) ?>>
								<?php if ( ! empty( $image_url ) || ! empty( $video_url ) ) : ?>
					                <div class="work-thumbnail span12">
					                    <div class="thumb-wrapper">
											<?php if( $video_url ): ?>
						                        <div class="post_video <?php echo $video_type ?>">
						                            <?php echo do_shortcode( "[$video_type video_id=\"$video_id\" width=\"100%\" height=\"100%\"]" ); ?>
						                        </div>
											<?php else: ?>  
						                        <?php if ( empty( $extra_images ) ) : ?> 
									                <div class="work-thumbnail">                                                                                                                           
													  	<div class="<?php if ( !$lightbox ) : ?>picture_overlay_empty <?php endif ?>picture_overlay">
													  		<?php yit_image( "id=$image_id&size=thumb_portfolio_fulldesc_big" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc_big' ); ?>
													  	
													  		<?php if ( $lightbox ) : ?>   
													  		<div class="overlay">
													  			<div>
													  				<p>
																		<a href="<?php yit_image( "id=$image_id&output=url" ); ?>" rel="lightbox_fulldesc" class="lightbox_fulldesc"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a>
																	</p>
													  			</div>
													  		</div>
													  		<?php endif ?>
													    </div>
									                </div>
	                                            <?php else : array_unshift( $extra_images, $image_id ); ?>
	                                                <div class="extra-images-slider">
	                                                    <ul class="slides">
	                                                        <?php foreach ( $extra_images as $image_id ) : ?>
	                                                        <li>
  	
															  	<div class="<?php if ( !$lightbox ) : ?>picture_overlay_empty <?php endif ?>picture_overlay">
															  		<?php yit_image( "id=$image_id&size=thumb_portfolio_fulldesc_big" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc_big' ); ?>

															  		<?php if ( $lightbox ) : ?>   
															  		<div class="overlay">
															  			<div>
															  				<p>
																				<a href="<?php yit_image( "id=$image_id&output=url" ); ?>" rel="lightbox_fulldesc" class="lightbox_fulldesc"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a>
																			</p>
															  			</div>
															  		</div>
															  		<?php endif ?>
															    </div>


	                                                        </li>
	                                                        <?php endforeach; ?>
	                                                    </ul>
	                                                </div>
	                                                <script type="text/javascript">
	                                                    jQuery(document).ready(function($){
	                                                        $('.extra-images-slider').flexslider({
                                                                controlNav: false
                                                            });    
	                                                    });
	                                                </script>
	                                            <?php endif; ?>
	                                            
												<script>
												jQuery(document).ready(function($){
													jQuery(".work-thumbnail .overlay a.lightbox_fulldesc").colorbox({
														transition:'elastic',
														rel:'lightbox_fulldesc',
														fixed:true,
														maxWidth: '80%',
														maxHeight: '80%',
														opacity : 0.7
													});
												});
												</script>
						                    <?php endif ?>
						                </div>
					                </div>
								<?php endif ?>
							</div>
							<div class="row">
								<?php $workspan = (($skills && $skills_label) || $year || $customer) ? 9 : 12 ?>
					            <div class="work-description span<?php echo $workspan ?>">
                                    <h3><?php yit_work_the('title') ?></h3>
					                <?php echo yit_addp(yit_work_get('content')); ?>
								</div>
				                <?php if( ($skills && $skills_label) || $year || $customer ): ?>
                                    <div class="work-skillsdate span3">
                                    	<h4><?php _e('Project Details', 'yit') ?></h4>
                                        <?php if( ! empty( $skills ) && ! empty( $skills_label ) ): ?><p class="categories paragraph-links"><span class="meta-label"><?php echo $skills_label ?>:</span> <?php echo $skills ?></p><?php endif ?>
                                        <?php if( ! empty( $customer ) ): ?><p class="customer"><span class="meta-label"><?php echo _e('Customer', 'yit') ?>:</span> <?php echo $customer; ?> <?php if ( ! empty( $website ) || ! empty( $website_url ) ) : ?>- <a href="<?php echo esc_url( $website_url ) ?>"><?php echo empty( $website ) ? $website_url : $website; ?></a><?php endif ?></p><?php endif ?>
                                        <?php if( ! empty( $year ) ): ?><p class="workdate"><span class="meta-label"><?php echo _e('Year', 'yit') ?>:</span> <?php echo $year; ?></p><?php endif ?>
                                    </div>
                                <?php endif ?>
					            
					            <div class="clear"></div>
							</div>
							<!-- START SMALL LAYOUT -->	
						<?php endif ?>		
						<div class="clear"></div>

                        <?php do_action( 'yit_before_related_projects' ) ?>
                        <?php do_action( 'yit_before_related_projects_' . $item_id ) ?>

                        <div class="clear"></div>

						<?php if( yit_work_get('display_related') ): $i=0; ?>
						<h3><?php echo yit_portfolio_get_setting( 'other_projects_label', $current_portfolio ) ?></h3>
						<div class="portfolio-full-description-related-projects row">
							<?php $portfolios = yit_portfolio_get_setting( 'items', $current_portfolio ); unset( $portfolios[$item_selected] ); ?>
							<?php $portfolios = yit_portfolio_get_setting('detail_nitems', $current_portfolio ) ? array_slice($portfolios, 0, yit_portfolio_get_setting('detail_nitems', $current_portfolio ), true) : $portfolios; ?>
							<?php foreach( $portfolios as $item_id => $item ): ?>
								<?php $post_permalink = yit_work_permalink( $item_id ); ?>
								<div class="<?php if( (++$i % 6 == 0) ): ?>related_project_last <?php endif ?>related_project span3">
								    
								    <?php
								    $item['item_id'] = $item_id;
								    yit_get_model('portfolio')->_current_item = $item;   
								    
                                    $video_url = yit_work_get( 'video_url' );
                                    $image_url = yit_work_get( 'image_url' );
								    
                                	$class = '';
                                    if ( ! empty( $video_url ) ) {
                                    	
    									list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
    						            if( $video_type == 'youtube' ) {
    						                $video_url = 'http://www.youtube.com/embed/' . $video_id . '?width=640&height=480&iframe=true';
    						            } else if( $video_type == 'vimeo') {
    						                $video_url = 'http://player.vimeo.com/video/' . $video_id;
    						            }
    									
                                        $thumb = $video_url;
                                        //$class = 'video';
                                    } else {
                                        $thumb = $image_url;
                                        //$class = 'img';
                                    }
                                          
                                    $both = 0;      
                            		$lightbox = yit_work_get( 'event_lightbox' );
                            		$details  = yit_work_get( 'event_details' );
                            		$title    = yit_work_get( 'event_title' );
                            		if( $lightbox && $details ) {
                            			$both  = 1;
                            			$class = $video_url ? 'video' : 'img';
                            		} elseif( $lightbox ) {
                            			$class = $video_url ? 'video' : 'img';
                            		} elseif( $details ) {
                            			$class = 'project';
                            		} elseif( $title /* && yit_work_get( 'title' ) */) {
                            			$class = 'onlytitle';
                            		}
                                    ?>
								    
								    <div class="related_img">
									  	<div class="picture_overlay">
									  		<?php yit_image( "id=$item_id&size=thumb_portfolio_fulldesc_related" );//echo wp_get_attachment_image( $item_id, 'thumb_portfolio_fulldesc_related' ); ?>
									  	
									  		<?php if ( $lightbox || $details || $title ) : ?>   
									  		<div class="overlay">
									  			<div>
									  				<?php if( $lightbox || $details ): ?>
									  				<p>
														<?php if( $lightbox ): ?><a href="<?php echo $thumb ?>" rel="lightbox" class="ch-info-lightbox<?php if($video_url): ?>-video<?php endif ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a><?php endif ?>
														<?php if( $details ): ?><a href="<?php echo $post_permalink ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/project.png' ?>" alt="" /></a><?php endif ?>
													</p>
									  				<?php endif ?>
													<?php if( $title ): ?> 
														<p class="title"><?php yit_work_the('title') ?></p>
														<p class="subtitle"><?php yit_work_the('subtitle') ?></p>
													<?php endif ?>
									  			</div>
									  		</div>
									  		<?php endif ?>
									    </div>  
                                    </div>
								</div>
							<?php endforeach ?>	
						</div>
						
						<?php endif ?>
						</div>