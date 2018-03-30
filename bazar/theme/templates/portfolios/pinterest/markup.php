<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$portfolio_type = yit_work_get( 'portfolio_type' );  
?>

<script>
jQuery(document).ready(function($){
	$('.sidebar').remove();
	
	if( !$('#primary').hasClass('sidebar-no') ) {
		$('#primary').removeClass().addClass('sidebar-no');
		$('.content').removeClass('span9').addClass('span12');
	}
	
});
</script>
 				<div class="row">
 		            <ul id="portfolio" class="<?php echo $portfolio_type; ?> pinterest thumbnails">         
                        <?php
                            $i = 1;
        
                            while ( yit_have_works() ) :
								$classes = "work span3";
                                
                                
                                $video_url = yit_work_get( 'video_url' );
                                $image_url = yit_work_get( 'image_url' );
                                $image_id  = yit_work_get( 'item_id' );
                                //list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, "thumb_portfolio_pinterest" );
                                
                                $post_permalink = yit_work_permalink( $image_id ); 
                        ?>     
        
                        <li <?php yit_work_class( $classes ) ?>><div class="thumbnail">
                            <?php 
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
								
								
								$both = 0; $class = '';
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



								$customer = yit_work_get('customer');
                        		$skills_label = yit_work_get('skills_label');
								$skills = yit_work_get('skills');
								$skills_label = isset( $skills_label ) && ! empty( $skills_label ) ? $skills_label : __('Skills', 'yit');
						        $skills = isset( $skills ) && ! empty( $skills ) ? $skills : '';
						        $website = yit_work_get('website_name');
                        		$website_url = yit_work_get('website_url');
                        		$year = yit_work_get('year');
                        		$categories = yit_work_get('terms');

                            ?>
        
                            <?php if ( ! empty( $image_url ) ) : ?>
							  	<div class="picture_overlay">
							  		<?php yit_image( "id=$image_id&size=thumb_portfolio_pinterest" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_pinterest' ); ?>
							  	
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
                            <?php endif ?>  
        
                            <h4><a href="<?php echo $post_permalink ?>"><?php yit_work_the( 'title' ) ?></a></h4>
                            
                            <?php if( yit_work_get('enable_excerpt') ): ?>
	                            <?php echo yit_content( yit_work_get( 'content' ), yit_work_get( 'excerpt_length' ) ) ?>
                            <?php endif ?>
                            
						    <?php if( ($skills && $skills_label) || $year || $customer ): ?>
                            <div class="work-skillsdate">
                                 <?php if( ! empty( $skills ) && ! empty( $skills_label ) ): ?><p class="categories paragraph-links"><span class="meta-label"><?php echo $skills_label ?>:</span> <?php echo $skills ?></p><?php endif ?>
                                 <?php if( ! empty( $customer ) ): ?><p class="customer"><span class="meta-label"><?php echo _e('Customer', 'yit') ?>:</span> <?php echo $customer; ?> <?php if ( ! empty( $website ) || ! empty( $website_url ) ) : ?>- <a href="<?php echo esc_url( $website_url ) ?>"><?php echo empty( $website ) ? $website_url : $website; ?></a><?php endif ?></p><?php endif ?>
                                 <?php if( ! empty( $year ) ): ?><p class="workdate"><span class="meta-label"><?php echo _e('Year', 'yit') ?>:</span> <?php echo $year; ?></p><?php endif ?>
                            </div>
                            <?php endif ?>                            
                        </div></li>       
                        <?php $i++; endwhile ?>        
                    </ul>
                    <?php yit_portfolio_pagination() ?>
               </div>


<script type="text/javascript">
jQuery(document).ready(function($){
	var container = $('#portfolio');
	container.imagesLoaded( function(){
		container.masonry({
		  itemSelector: '.span3'
		});
	});
	
	$(window).resize(function(){
		$('#portfolio').masonry({
		  itemSelector: '.span3'
		});
	})
});
</script>