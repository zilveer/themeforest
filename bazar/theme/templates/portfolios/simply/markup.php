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

<div class="portfolio-<?php echo $portfolio_type ?>">
<?php while ( yit_have_works() ) :  
      	$video_url = yit_work_get( 'video_url' );
        $image_url = yit_work_get( 'image_url' );
        $image_id  = yit_work_get( 'item_id' );
        //list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, 'thumb_portfolio_bigimage' );
                                
        $post_permalink = yit_work_permalink( $image_id );
		
		
        
        if ( ! empty( $video_url ) ) {
                                	
			list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
			if( $video_type == 'youtube' ) {
				$video_url = 'http://www.youtube.com/embed/' . $video_id . '?width=640&height=480&iframe=true';
			} else if( $video_type == 'vimeo') {
				$video_url = 'http://player.vimeo.com/video/' . $video_id;
			}
									
            $thumb = $video_url;
        } else {
            $thumb = $image_url;
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
		$skills_label = isset( $skills_label ) && ! empty( $skills_label ) ? $skills_label : __('Project Info', 'yit');
        $skills = isset( $skills ) && ! empty( $skills ) ? $skills : '';
		$website = yit_work_get('website_name');
		$website_url = yit_work_get('website_url');
		$year = yit_work_get('year');
		
		$categories = yit_work_get('categories');
		$terms = yit_work_get('terms');
		$terms_plain = ""; 
		
		if( $terms ) {
			foreach( $terms as $term ) {
				$terms_plain .= $categories[$term] . ', ';
			}
			$terms_plain = substr($terms_plain, 0, strlen( $terms_plain ) - 2);
		}
		
		$extra_images = yit_work_get('extra-images');
		
		$image_position = yit_work_get('image-position');
		$background_color = yit_work_get('background-container');
		$background_image = yit_work_get('background-image-container');
		$background_image_position = yit_work_get('background-image-container-position');
		$background_image_repeat = yit_work_get('background-image-container-repeat');
		
?>     
		<div class="work-container" style="background: <?php echo $background_color ? $background_color : "transparent" ?><?php if($background_image): ?> url(<?php echo $background_image ?>) <?php echo $background_image_position . " " . $background_image_repeat ?><?php endif ?>">
			<div class="container">
				<div <?php post_class( 'work row group image-' . $image_position ) ?>>
					<?php if( $image_position == 'left' || $image_position == 'right' ): ?>
						<div class="work-thumbnail span<?php echo $video_url ? 6 : 8 ?>" style="float: <?php echo $image_position ?>">
    						<?php if( $video_url ): ?>
								<!--<div class="post_video <?php echo $video_type ?>">-->
                                    <div class="simply-shadow"></div>
    						    	<?php echo do_shortcode( "[$video_type video_id=\"$video_id\" width=\"100%\" height=\"100%\"]" ); ?>
    						    <!--</div>-->
    						<?php else: ?> 
    							<?php if ( !empty( $extra_images ) ) : array_unshift( $extra_images, $image_id ); ?> 
    	                        	<div class="extra-images-slider">
    	                            	<ul class="slides">
    	                                	<?php foreach ( $extra_images as $image_id ) : ?>
    	                                    	<li><?php yit_image( "id=$image_id&size=thumb_portfolio_simply" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_simply' ); ?></li>
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
    							<?php else: ?>
									<?php yit_image( "id=$image_id&size=thumb_portfolio_simply" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_simply' ); ?>
								<?php endif ?>
							<?php endif ?>
						</div>

						<div class="work-description span<?php echo $video_url ? 6 : 4 ?>" style="float: <?php echo $image_position ?>">
			                <h1><?php yit_work_the( 'title' ) ?></h1>
							<?php yit_work_the('content'); ?>			                            
							
			                <?php if( ($skills && $skills_label) || $year || $customer || $terms_plain ): ?>
			                    <div class="work-skillsdate span4">
					                <h4><?php echo yit_work_get('project-label'); ?></h4>
			                        <?php if( ! empty( $skills ) && ! empty( $skills_label ) ): ?><p class="categories paragraph-links"><span class="meta-label"><?php echo $skills_label  ?>:</span> <?php echo $skills ?></p><?php endif ?>
			                        <?php if( ! empty( $customer ) ): ?><p class="customer"><span class="meta-label"><?php echo _e('Customer', 'yit') ?>:</span> <?php echo $customer; ?></p><?php endif ?>
			                        <?php if( ! empty( $terms_plain ) ): ?><p class="categories"><span class="meta-label"><?php echo _e('Categories', 'yit') ?>:</span> <?php echo $terms_plain; ?></p><?php endif ?>	
                                    
					            <?php if( ! empty( $website ) || ! empty( $website_url ) ): ?><p class="website"><span class="meta-label"><?php echo _e('URL', 'yit') ?>:</span> <a href="<?php echo esc_url( $website_url ) ?>"><?php echo empty( $website ) ? $website_url : $website; ?></a></p><?php endif ?>	
			                        <?php if( ! empty( $year ) ): ?><p class="workdate"><span class="meta-label"><?php echo _e('Date', 'yit') ?>:</span> <?php echo $year; ?></p><?php endif ?>
			                    </div>
			                <?php endif ?>
						</div>
					<?php else: ?>
						<div class="work-thumbnail span12">
    						<?php if( $video_url ): ?>
								<!--<div class="post_video <?php echo $video_type ?>">-->
    						    	<?php echo do_shortcode( "[$video_type video_id=\"$video_id\" width=\"100%\" height=\"100%\"]" ); ?>
    						    <!--</div>-->
							<?php else: ?>
    							<?php if ( !empty( $extra_images ) ) : array_unshift( $extra_images, $image_id ); ?> 
    	                        	<div class="extra-images-slider">
    	                            	<ul class="slides">
    	                                	<?php foreach ( $extra_images as $image_id ) : ?>
    	                                    	<li><?php yit_image( "id=$image_id" );//echo wp_get_attachment_image( $image_id, 'full' ); ?></li>
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
    							<?php else: ?>
									<?php yit_image( "id=$image_id" );//echo wp_get_attachment_image( $image_id, 'full' ); ?>
								<?php endif ?>
							<?php endif ?>
						</div>

						<div class="work-description span8" style="float: <?php echo $image_position ?>">
			                <h1><?php yit_work_the( 'title' ) ?></h1>
							<?php yit_work_the('content'); ?>			                            
			            </div>            

			            <?php if( ($skills && $skills_label) || $year || $customer || $terms_plain  ): ?>
				            <div class="work-skillsdate span4">
				                <h4><?php echo yit_work_get('project-label'); ?></h4>
					            <?php if( ! empty( $skills ) && ! empty( $skills_label ) ): ?><p class="categories paragraph-links"><span class="meta-label"><?php echo $skills_label  ?>:</span> <?php echo $skills ?></p><?php endif ?>
					            <?php if( ! empty( $customer ) ): ?><p class="customer"><span class="meta-label"><?php echo _e('Customer', 'yit') ?>:</span> <?php echo $customer; ?></p><?php endif ?>
		                        <?php if( ! empty( $terms_plain ) ): ?><p class="categories"><span class="meta-label"><?php echo _e('Categories', 'yit') ?>:</span> <?php echo $terms_plain; ?></p><?php endif ?>
                                
					            <?php if( ! empty( $website ) || ! empty( $website_url ) ): ?><p class="website"><span class="meta-label"><?php echo _e('URL', 'yit') ?>:</span> <a href="<?php echo esc_url( $website_url ) ?>"><?php echo empty( $website ) ? $website_url : $website; ?></a></p><?php endif ?>
								<?php if( ! empty( $year ) ): ?><p class="workdate"><span class="meta-label"><?php echo _e('Date', 'yit') ?>:</span> <?php echo $year; ?></p><?php endif ?>
				            </div>
			            <?php endif ?>
					<?php endif ?>
				</div>
			</div>
		</div>
			

<?php endwhile ?>

<?php yit_portfolio_pagination() ?>

</div>
<div class="clear"></div>