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

<div id="portfolio" class="portfolio-<?php echo $portfolio_type ?>">
<?php while ( yit_have_works() ) :  
      	$video_url = yit_work_get( 'video_url' );
        $image_url = yit_work_get( 'image_url' );
        $image_id  = yit_work_get( 'item_id' );
                                
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
		$skills_label = isset( $skills_label ) && ! empty( $skills_label ) ? $skills_label : __('Skills', 'yit');
        $skills = isset( $skills ) && ! empty( $skills ) ? $skills : '';
		$website = yit_work_get('website_name');
		$website_url = yit_work_get('website_url');
		$year = yit_work_get('year');
		$categories = yit_work_get('terms');
		
		$read_more_text = yit_work_get( 'read_more_text' );
?>     
		
		<div <?php post_class( 'work row group' ) ?>>
			<?php if ( ! empty( $image_url ) ) : ?>
                <div class="work-thumbnail span7">                                                                                                                           
				  	<div class="<?php if ( !$lightbox && !$details && !$title ) : ?>picture_overlay_empty <?php endif ?>picture_overlay">
				  		<?php yit_image( "id=$image_id&size=thumb_portfolio_bigimage" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_bigimage' ); ?>
				  	
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
			<?php endif ?>
			
            <div class="work-description span5 group">
                <h3><?php yit_work_the( 'title' ) ?></h3>
                <?php echo yit_content( yit_work_get( 'content' ), yit_work_get( 'excerpt_length' ) ) ?>
                <div class="clear"></div>
                
                <?php if ( ! empty( $read_more_text ) ) echo yit_sc_more_link( "<a class='read-more' href='{$post_permalink}'>" . $read_more_text . "</a>", yit_work_get( 'read_more_text' ), $post_permalink ) ?>
                            
                <?php if( ($skills && $skills_label) || $year || $customer ): ?>
                    <div class="work-skillsdate span5">
                        <?php if( ! empty( $skills ) && ! empty( $skills_label ) ): ?><p class="categories paragraph-links"><span class="meta-label"><?php echo $skills_label  ?>:</span> <?php echo $skills ?></p><?php endif ?>
                        <?php if( ! empty( $customer ) ): ?><p class="customer"><span class="meta-label"><?php echo _e('Customer', 'yit') ?>:</span> <?php echo $customer; ?> <?php if ( ! empty( $website ) || ! empty( $website_url ) ) : ?>- <a href="<?php echo esc_url( $website_url ) ?>"><?php echo empty( $website ) ? $website_url : $website; ?></a><?php endif ?></p><?php endif ?>
                        <?php if( ! empty( $year ) ): ?><p class="workdate"><span class="meta-label"><?php echo _e('Year', 'yit') ?>:</span> <?php echo $year; ?></p><?php endif ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="clear"></div>
		</div>

<?php endwhile ?>

<?php yit_portfolio_pagination() ?>

</div>
<div class="clear"></div>