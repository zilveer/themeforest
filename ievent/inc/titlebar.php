<?php 

global $ievent_data;

if((get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true )) and (get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) !='select_title_bar') and (!is_search())):?>
			<?php if(
			(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'flexslider') or 
			(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'flexslider-images')):?>
            
            	<?php
					$flex_set='';				
				
					if(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'flexslider-images'):
						$flex_set='yes';
					else:
						$flex_set='no';
					endif;
								
					$images_url='';
					$start_day='';
					$month='';
					$end_day='';
					$month_year='';
					
					$start_date = 	get_post_meta( get_the_ID(), 'jx_ievent_event_start_date', true );
					$end_date 	= 	get_post_meta( get_the_ID(), 'jx_ievent_event_end_date', true );
					$pre_title	=	get_post_meta( get_the_ID(), 'jx_ievent_event_pretitle', true );
					$title		=	get_post_meta( get_the_ID(), 'jx_ievent_event_title', true );
					$location	=	get_post_meta( get_the_ID(), 'jx_ievent_event_location', true );
													
					//Start Date
					if($start_date):
					$get_start_day = explode('-',$start_date);					
					$start_day = $get_start_day[0];
					endif;
					
					
					//End Date
					if($end_date):
					$get_end_day = explode('-',$end_date);					
					$end_day = $get_end_day[0];
					
					
					//month
					$month = $get_end_day[1];
					
					//month_year		
					$month_year = $get_end_day[1].' '.$get_end_day[2];
					endif;
				
					
					if(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) != 'flexslider-images'):
					
					$images = rwmb_meta( 'jx_ievent_bg_image', 'type=image_advanced' );
					
					foreach ( $images as $image ){
						$images_url=$image['full_url'];
					}	
					endif;
				?>

                <div class="jx-ievent-main-slider">
                	
                    
                    <div class="jx-ievent-parallax-fullwidth" style="background:url('<?php echo esc_url($images_url); ?>');">
                    <?php if ($ievent_data['check_event_infobar']):?>
						<?php if (get_post_meta( get_the_ID(), 'jx_ievent_home_info_box', true )):?>
                            <div class="jx-ievent-slider-bottom-info">
                                <div class="container">
                                    
                                            <?php echo do_shortcode('[info_bar title_1="'.esc_html__('Date','ievent').'" description_1="'.esc_attr($ievent_data['info_event_date']).'" title_2="'.esc_html__('Location','ievent').'" description_2="'.esc_attr($ievent_data['info_event_location']).'" title_3="'.esc_html__('Tickets','ievent').'" description_3="'.esc_attr($ievent_data['info_event_tickets']).'" title_4="'.esc_html__('Speakers','ievent').'" description_4="'.esc_attr($ievent_data['info_event_speakers']).'"][/info_bar]');?>			
                                        
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="flexslider">
                        <ul class="slides">
                            
                            <?php
								  $show_slidedate='';
								  $flex_content='';
								  $flex_bg='';
								  $images_url_2='';
								  
								  $args = array('post_type' => 'flexslider','post_status'=>'publish','posts_per_page'=>'10'); 
								  $loop = new WP_Query( $args ); 		
								  while ( $loop->have_posts() ) : $loop->the_post(); 
								  
								  
								  $images_2 = rwmb_meta( 'jx_ievent_bg_image', 'type=image_advanced' );
									
									if($images_2):
										foreach ( $images_2 as $image_2 ){
											$images_url_2=$image_2['full_url'];
										}
									endif;	
												  
								  if ($images_url_2):
								  $flex_bg='style="background:url('.esc_url($images_url_2).');"';
								  endif;
								  
								  
								  if ($ievent_data['checkbox_show_sliderdate']):
									$show_slidedate='<div class="jx-ievent-right-vertical-border">
											<div class="jx-ievent-date">
												<div class="jx-ievent-slider-day">'.esc_attr($start_day).'</div>
												<div class="jx-ievent-slider-month jx-ievent-uppercase">'.esc_attr($month).'</div>
											</div>
										</div>';
									else:
									$show_slidedate='<div class="jx-ievent-right-vertical-border hide">
											<div class="jx-ievent-date">
												<div class="jx-ievent-slider-day">'.esc_attr($start_day).'</div>
												<div class="jx-ievent-slider-month jx-ievent-uppercase">'.esc_attr($month).'</div>
											</div>
										</div>';
									endif;
							   
								   ?>
                
                                <?php								
								if(get_post_meta( get_the_ID(), 'jx_ievent_title_bar_content', true ) == 'title-box'):
																
								$flex_content='<div class="jx-ievent-slider-content jx-ievent-title-box">
                                    <div class="container">'.do_shortcode('[event_box start_date="'.esc_attr($start_day).'" end_date="'.esc_attr($end_day).'" month="'.esc_attr($month_year).'" pretitle="'.$pre_title.'" title="'.$title.'" location="'.$location.'"][/event_box]').'
                                    </div>
                                    '.$show_slidedate.'
                                </div>
								<!-- EOF Page Title bar -->';
								
								elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar_content', true ) == 'title-box-2'):								
								
								$flex_content='<div class="jx-ievent-slider-content jx-ievent-title-box-2">
                                    <div class="container">
									
									<div class="jx-ievent-event-box-a">
										<div class="pre-title">'.esc_html__('UpComing Events','ievent').'</div>
										<div class="title">'.$title.'</div>
										<div class="location">'.$start_date.' '.$location.'</div>
									</div>

                                    </div>
                                    '.$show_slidedate.'
                                </div>
								<!-- EOF Page Title bar -->';								
							
								elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar_content', true ) == 'count-down'):
								

					
								$flex_content='<div class="jx-ievent-slider-content jx-ievent-countdown-box">
                                    <div class="container">'.do_shortcode('[event_counter start_date="'.esc_attr($start_day).'" end_date="'.esc_attr($end_day).'" month="'.esc_attr($month_year).'" pretitle="'.$pre_title.'" title="'.$title.'"][/event_counter]').'           
                                    </div>
                                    '.$show_slidedate.'
                                </div>
								<!-- EOF Page Title bar -->   ';
								
								elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar_content', true ) == 'register-form'):
								
									$flex_content='<div class="jx-ievent-slider-content jx-ievent-register-box">
										<div class="container">'.do_shortcode('[event_form type="1" start_date="'.esc_attr($start_day).'" end_date="'.esc_attr($end_day).'" month="'.esc_attr($month_year).'" pretitle="'.$pre_title.'" title="'.$title.'" '.get_post_meta( get_the_ID(), 'jx_ievent_form_select', true ).'][/event_form]').'            
										</div>
										 '.$show_slidedate.'
									</div>
									<!-- EOF Page Title bar --> ';
								
								
								elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar_content', true ) == 'register-form-2'):							

								
									$flex_content='<div class="jx-ievent-slider-content jx-ievent-register-box">
										<div class="container">'.do_shortcode('[event_form type="2" start_date="'.esc_attr($start_day).'" end_date="'.esc_attr($end_day).'" month="'.esc_attr($month_year).'" pretitle="'.$pre_title.'" title="'.$title.'" '.get_post_meta( get_the_ID(), 'jx_ievent_form_select', true ).'][/event_form]').'            
										</div>
										 '.$show_slidedate.'
									</div>
									<!-- EOF Page Title bar --> ';
								
								elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar_content', true ) == 'video'):
								
								$flex_content='<div class="jx-ievent-slider-content jx-ievent-video-box">
                                    <div class="container">'.do_shortcode('[event_play pretitle="'.$pre_title.'" title="'.$title.'" location="'.$location.'" video_link="'.get_post_meta( get_the_ID(), 'jx_ievent_video_link', true ).'"][/event_play]').'
            
                                    </div>
                                     '.$show_slidedate.'
                                </div>
								<!-- EOF Page Title bar -->';						
								
								endif;?>                            
                             
                             <?php							 
							  if($flex_set=='yes'):?>
								<?php echo '<li '.$flex_bg.'>'.$flex_content.'</li>'; ?>
                             <?php else: ?>
                            	<?php echo '<li>'.$flex_content.'</li>'; ?>
                             <?php endif;?>
                         
                          <?php endwhile; ?>
 
                            
                        </ul>
                    </div>
                    <!-- EOF Slexslider -->
                </div>
                
                </div>
                
            
			<?php elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'titlebar'): ?>
                
                <?php 
				
					$images_1 = rwmb_meta( 'jx_ievent_bg_image', 'type=image_advanced' );
					
					foreach ( $images_1 as $image_1 ){
						$images_url_1=$image_1['full_url'];
					}	
					
				?>
                
                <div id="home" class="jx-ievent-page-titlebar">
                    <div class="page-titlebar-bg parallax-no" style="background:url(<?php echo esc_url($images_url_1); ?>); background-position:<?php echo get_post_meta(get_the_ID(),'jx_ievent_bg_image_pos',true); ?>"></div>
                    <!-- Background Image -->                    
                        <div class="container">
                        <?php if(get_post_meta( get_the_ID(), 'jx_ievent_breadcrumbs', true )): ?>
                        <div class="jx-ievent-page-titlebar-items">
                            <div class="sixteen columns left">
                                <div class="jx-ievent-breadcrumb"><?php breadcrumbs(); ?></div>
                            </div>  
                            <!-- Page Title-->                           
                        </div>
                    	<?php endif;?>
                    </div>
                </div>
                <!-- EOF Page Title bar -->

			
			<?php elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'revolutionslider'): ?>
                <div class="jx-ievent-main-slider">
                    
					<?php if ($ievent_data['check_event_infobar']):?>							
							
								<?php if (get_post_meta( get_the_ID(), 'jx_ievent_home_info_box', true )):?>
									<?php echo do_shortcode('[info_bar title_1="'.esc_html__('Date','ievent').'" description_1="'.esc_attr($ievent_data['info_event_date']).'" title_2="'.esc_html__('Location','ievent').'" description_2="'.esc_attr($ievent_data['info_event_location']).'" title_3="'.esc_html__('Tickets','ievent').'" description_3="'.esc_attr($ievent_data['info_event_tickets']).'" title_4="'.esc_html__('Speakers','ievent').'" description_4="'.esc_attr($ievent_data['info_event_speakers']).'"][/info_bar]');?>			
								<?php endif; ?>
                            <?php endif; ?>
                    
					<?php if(class_exists('RevSlider')){ 
                   		
						 if(get_post_meta( get_the_ID(), 'jx_ievent_revolutionslider', true )):
						 	putRevSlider(get_post_meta( get_the_ID(), 'jx_ievent_revolutionslider', true ));
                     	 endif;
							 
					 } ?>
                </div>
                <!-- EOF Page Title bar -->
            
			<?php elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'count-down'): ?>
                 <?php
				
					$start_date = 	get_post_meta( get_the_ID(), 'jx_ievent_event_start_date', true );
					$end_date 	= 	get_post_meta( get_the_ID(), 'jx_ievent_event_end_date', true );
					$pre_title	=	get_post_meta( get_the_ID(), 'jx_ievent_event_pretitle', true );
					$title		=	get_post_meta( get_the_ID(), 'jx_ievent_event_title', true );
					$location	=	get_post_meta( get_the_ID(), 'jx_ievent_event_location', true );
					
					//Start Date
					$get_start_day = explode('-',$start_date);					
					$start_day = $get_start_day[0];
					
					//End Date
					$get_end_day = explode('-',$end_date);					
					$end_day = $get_end_day[0];
					
					//month
					$month = $get_end_day[1];
					
					//month_year		
					$month_year = $get_end_day[1].' '.$get_end_day[2];
				
					$images_2 = rwmb_meta( 'jx_ievent_bg_image', 'type=image_advanced' );
					
					foreach ( $images_2 as $image_2 ){
						$images_url_2=$image_2['full_url'];
					}	
				
				?>
                
                <div class="jx-ievent-main-slider jx-ievent-parallax-fullwidth">
                	<div class="parallax-no bg-pos-center" style="background:url('<?php echo esc_url($images_url_2); ?>');"></div>
                    
                    <?php if ($ievent_data['check_event_infobar']):?>
						<?php if (get_post_meta( get_the_ID(), 'jx_ievent_home_info_box', true )):?>
                            <div class="jx-ievent-slider-bottom-info">
                                <div class="container">
                                    
                                            <?php echo do_shortcode('[info_bar title_1="'.esc_html__('Date','ievent').'" description_1="'.esc_attr($ievent_data['info_event_date']).'" title_2="'.esc_html__('Location','ievent').'" description_2="'.esc_attr($ievent_data['info_event_location']).'" title_3="'.esc_html__('Tickets','ievent').'" description_3="'.esc_attr($ievent_data['info_event_tickets']).'" title_4="'.esc_html__('Speakers','ievent').'" description_4="'.esc_attr($ievent_data['info_event_speakers']).'"][/info_bar]');?>				
                                        
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="jx-ievent-slider-content">
                        <div class="container">
                        	<?php echo do_shortcode('[event_counter start_date="'.$start_day.'" end_date="'.$end_day.'" month="'.$month_year.'" pretitle="'.$pre_title.'" title="'.$title.'"][/event_counter]');?>

                        </div>
                        <div class="jx-ievent-right-vertical-border no-slider">
                            <div class="jx-ievent-date">
                                <div class="jx-ievent-slider-day"><?php echo esc_attr($start_day); ?></div>
                                <div class="jx-ievent-slider-month jx-ievent-uppercase"><?php echo esc_attr($month); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- EOF Page Title bar -->
            <?php elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'register-form'): ?>
                <?php
				
					$start_date = 	get_post_meta( get_the_ID(), 'jx_ievent_event_start_date', true );
					$end_date 	= 	get_post_meta( get_the_ID(), 'jx_ievent_event_end_date', true );
					$pre_title	=	get_post_meta( get_the_ID(), 'jx_ievent_event_pretitle', true );
					$title		=	get_post_meta( get_the_ID(), 'jx_ievent_event_title', true );
					$location	=	get_post_meta( get_the_ID(), 'jx_ievent_event_location', true );
					
					//Start Date
					$get_start_day = explode('-',$start_date);					
					$start_day = $get_start_day[0];
					
					//End Date
					$get_end_day = explode('-',$end_date);					
					$end_day = $get_end_day[0];
					
					//month
					$month = $get_end_day[1];
					
					//month_year		
					$month_year = $get_end_day[1].' '.$get_end_day[2];
				
					$images_3 = rwmb_meta( 'jx_ievent_bg_image', 'type=image_advanced' );
					
					foreach ( $images_3 as $image_3 ){
						$images_url_3=$image_3['full_url'];
					}	
				
				?>
                
                <div class="jx-ievent-main-slider jx-ievent-parallax-fullwidth">
                	<div class="parallax-no" style="background:url('<?php echo esc_url($images_url_3); ?>');"></div>
                    
                    <?php if ($ievent_data['check_event_infobar']):?>
						<?php if (get_post_meta( get_the_ID(), 'jx_ievent_home_info_box', true )):?>
                            <div class="jx-ievent-slider-bottom-info">
                                <div class="container">
                                    
                                            <?php echo do_shortcode('[info_bar title_1="'.esc_html__('Date','ievent').'" description_1="'.esc_attr($ievent_data['info_event_date']).'" title_2="'.esc_html__('Location','ievent').'" description_2="'.esc_attr($ievent_data['info_event_location']).'" title_3="'.esc_html__('Tickets','ievent').'" description_3="'.esc_attr($ievent_data['info_event_tickets']).'" title_4="'.esc_html__('Speakers','ievent').'" description_4="'.esc_attr($ievent_data['info_event_speakers']).'"][/info_bar]');?>				
                                        
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="jx-ievent-slider-content">
                        <div class="container">
                        	<?php echo do_shortcode('[event_form type="1" start_date="'.esc_attr($start_day).'" end_date="'.esc_attr($end_day).'" month="'.esc_attr($month_year).'" pretitle="'.$pre_title.'" title="'.$title.'"][/event_form]');?>

                        </div>
                        <div class="jx-ievent-right-vertical-border no-slider">
                            <div class="jx-ievent-date">
                                <div class="jx-ievent-slider-day"><?php echo esc_attr($start_day); ?></div>
                                <div class="jx-ievent-slider-month jx-ievent-uppercase"><?php echo esc_attr($month); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- EOF Page Title bar -->
               
            <?php elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'register-form-2'): ?>
                
                
                <?php
				
					$start_date = 	get_post_meta( get_the_ID(), 'jx_ievent_event_start_date', true );
					$end_date 	= 	get_post_meta( get_the_ID(), 'jx_ievent_event_end_date', true );
					$pre_title	=	get_post_meta( get_the_ID(), 'jx_ievent_event_pretitle', true );
					$title		=	get_post_meta( get_the_ID(), 'jx_ievent_event_title', true );
					$location	=	get_post_meta( get_the_ID(), 'jx_ievent_event_location', true );
					
					//Start Date
					$get_start_day = explode('-',$start_date);					
					$start_day = $get_start_day[0];
					
					//End Date
					$get_end_day = explode('-',$end_date);					
					$end_day = $get_end_day[0];
					
					//month
					$month = $get_end_day[1];
					
					//month_year		
					$month_year = $get_end_day[1].' '.$get_end_day[2];
				
					$images_4 = rwmb_meta( 'jx_ievent_bg_image', 'type=image_advanced' );
					
					foreach ( $images_4 as $image_4 ){
						$images_url_4=$image_4['full_url'];
					}	
				
				?>
                
                <div class="jx-ievent-main-slider jx-ievent-parallax-fullwidth">
                	<div class="parallax-no" style="background:url('<?php echo esc_url($images_url_4); ?>');"></div>
                    
                    <?php if ($ievent_data['check_event_infobar']):?>
						<?php if (get_post_meta( get_the_ID(), 'jx_ievent_home_info_box', true )):?>
                            <div class="jx-ievent-slider-bottom-info">
                                <div class="container">
                                    
                                            <?php echo do_shortcode('[info_bar title_1="'.esc_html__('Date','ievent').'" description_1="'.esc_attr($ievent_data['info_event_date']).'" title_2="'.esc_html__('Location','ievent').'" description_2="'.esc_attr($ievent_data['info_event_location']).'" title_3="'.esc_html__('Tickets','ievent').'" description_3="'.esc_attr($ievent_data['info_event_tickets']).'" title_4="'.esc_html__('Speakers','ievent').'" description_4="'.esc_attr($ievent_data['info_event_speakers']).'"][/info_bar]');?>				
                                        
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="jx-ievent-slider-content">
                        <div class="container">
                        	<?php echo do_shortcode('[event_form type="2" start_date="'.esc_attr($start_day).'" end_date="'.esc_attr($end_day).'" month="'.esc_attr($month_year).'" pretitle="'.$pre_title.'" title="'.$title.'"][/event_form]');?>

                        </div>
                        <div class="jx-ievent-right-vertical-border no-slider">
                            <div class="jx-ievent-date">
                                <div class="jx-ievent-slider-day"><?php echo esc_attr($start_day); ?></div>
                                <div class="jx-ievent-slider-month jx-ievent-uppercase"><?php echo esc_attr($month); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- EOF Page Title bar -->
            <?php elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'video'): ?>
                <?php
				
					$start_date = 	get_post_meta( get_the_ID(), 'jx_ievent_event_start_date', true );
					$end_date 	= 	get_post_meta( get_the_ID(), 'jx_ievent_event_end_date', true );
					$pre_title	=	get_post_meta( get_the_ID(), 'jx_ievent_event_pretitle', true );
					$title		=	get_post_meta( get_the_ID(), 'jx_ievent_event_title', true );
					$location	=	get_post_meta( get_the_ID(), 'jx_ievent_event_location', true );
					
			
					//Start Date
					$get_start_day = explode('-',$start_date);					
					$start_day = $get_start_day[0];
					
					//End Date
					$get_end_day = explode('-',$end_date);					
					$end_day = $get_end_day[0];
					
					//month
					$month = $get_end_day[1];
					
					//month_year		
					$month_year = $get_end_day[1].' '.$get_end_day[2];
				
					$images_5 = rwmb_meta( 'jx_ievent_bg_image', 'type=image_advanced' );
					
					foreach ( $images_5 as $image_5 ){
						$images_url_5=$image_5['full_url'];
					}	
				
				?>
                
                <div class="jx-ievent-main-slider jx-ievent-parallax-fullwidth">
                	<div class="parallax-no" style="background:url('<?php echo esc_url($images_url_5); ?>');"></div>
                    
                    <?php if ($ievent_data['check_event_infobar']):?>
						<?php if (get_post_meta( get_the_ID(), 'jx_ievent_home_info_box', true )):?>
                            <div class="jx-ievent-slider-bottom-info">
                                <div class="container">
                                    
                                            <?php echo do_shortcode('[info_bar title_1="'.esc_html__('Date','ievent').'" description_1="'.esc_attr($ievent_data['info_event_date']).'" title_2="'.esc_html__('Location','ievent').'" description_2="'.esc_attr($ievent_data['info_event_location']).'" title_3="'.esc_html__('Tickets','ievent').'" description_3="'.esc_attr($ievent_data['info_event_tickets']).'" title_4="'.esc_html__('Speakers','ievent').'" description_4="'.esc_attr($ievent_data['info_event_speakers']).'"][/info_bar]');?>				
                                        
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="jx-ievent-slider-content">
                        <div class="container">
                        	<?php echo do_shortcode('[event_play pretitle="'.$pre_title.'" title="'.$title.'" location="'.$location.'" video_link="'.get_post_meta( get_the_ID(), 'jx_ievent_video_link', true ).'"][/event_play]');?>

                        </div>
                        <div class="jx-ievent-right-vertical-border no-slider">
                            <div class="jx-ievent-date">
                                <div class="jx-ievent-slider-day"><?php echo esc_attr($start_day); ?></div>
                                <div class="jx-ievent-slider-month jx-ievent-uppercase"><?php echo esc_attr($month); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- EOF Page Title bar -->
            <?php elseif(get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true ) == 'title-box'): ?>
                
                <?php
				
					$start_date = 	get_post_meta( get_the_ID(), 'jx_ievent_event_start_date', true );
					$end_date 	= 	get_post_meta( get_the_ID(), 'jx_ievent_event_end_date', true );
					$pre_title	=	get_post_meta( get_the_ID(), 'jx_ievent_event_pretitle', true );
					$title		=	get_post_meta( get_the_ID(), 'jx_ievent_event_title', true );
					$location	=	get_post_meta( get_the_ID(), 'jx_ievent_event_location', true );
					//Start Date
					$get_start_day = explode('-',$start_date);					
					$start_day = $get_start_day[0];
					
					//End Date
					$get_end_day = explode('-',$end_date);					
					$end_day = $get_end_day[0];
					
					//month
					$month = $get_end_day[1];
					
					//month_year		
					$month_year = $get_end_day[1].' '.$get_end_day[2];
				
					$images_6 = rwmb_meta( 'jx_ievent_bg_image', 'type=image_advanced' );
					
					foreach ( $images_6 as $image_6 ){
						$images_url_6=$image_6['full_url'];
					}	
				
				?>
                
                <div class="jx-ievent-main-slider jx-ievent-parallax-fullwidth">
                	<div class="parallax-no" style="background:url('<?php echo esc_url($images_url_6); ?>');"></div>
                    
                    <?php if ($ievent_data['check_event_infobar']):?>
						<?php if (get_post_meta( get_the_ID(), 'jx_ievent_home_info_box', true )):?>
                            <div class="jx-ievent-slider-bottom-info">
                                <div class="container">
                                    
                                            <?php echo do_shortcode('[info_bar title_1="'.esc_html__('Date','ievent').'" description_1="'.esc_attr($ievent_data['info_event_date']).'" title_2="'.esc_html__('Location','ievent').'" description_2="'.esc_attr($ievent_data['info_event_location']).'" title_3="'.esc_html__('Tickets','ievent').'" description_3="'.esc_attr($ievent_data['info_event_tickets']).'" title_4="'.esc_html__('Speakers','ievent').'" description_4="'.esc_attr($ievent_data['info_event_speakers']).'"][/info_bar]');?>				
                                        
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <div class="jx-ievent-slider-content">
                        <div class="container">
                            <?php echo do_shortcode('[event_box start_date="'.esc_attr($start_day).'" end_date="'.esc_attr($end_day).'" month="'.esc_attr($month_year).'" pretitle="'.$pre_title.'" title="'.$title.'" location="'.$location.'"][/event_box]'); ?>
                        </div>
                        <div class="jx-ievent-right-vertical-border no-slider">
                            <div class="jx-ievent-date">
                                <div class="jx-ievent-slider-day"><?php echo esc_attr($start_day); ?></div>
                                <div class="jx-ievent-slider-month jx-ievent-uppercase"><?php echo esc_attr($month); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- EOF Page Title bar -->
            <?php endif; ?>
        
		<?php elseif (is_home() or is_front_page() or is_single() or is_archive() or is_search() or is_404() or (($ievent_data['header_bg_image']!='') and (get_post_meta( get_the_ID(), 'jx_ievent_title_bar', true )== 'select_title_bar'))):?>
				
                
                
                
                <div id="home" class="jx-ievent-page-titlebar">
                    <div class="page-titlebar-bg parallax-no" style="background:url(<?php echo esc_url($ievent_data['header_bg_image']); ?>); background-position:<?php echo esc_attr($ievent_data['header_bg_image_pos']); ?>"></div>
                    <!-- Background Image -->                    
                    <div class="container">
                        <?php if(get_post_meta( get_the_ID(), 'jx_ievent_breadcrumbs', true )): ?>
                        <div class="jx-ievent-page-titlebar-items">
                            <div class="sixteen columns left">
                                <div class="jx-ievent-breadcrumb"><?php breadcrumbs(); ?></div>
                            </div>  
                            <!-- Page Title-->                           
                        </div>
                    	<?php endif;?>
                    </div>
                </div>
                <!-- EOF Page Title bar -->		
		
		
		<?php endif; ?>