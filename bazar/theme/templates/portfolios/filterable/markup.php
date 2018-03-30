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
				<?php $cats = yit_work_get('categories'); ?>
				<div class="row">
					<div class="span12">
						<ul class="filters">
							<li class="all"><a class="active all" href="<?php echo esc_url( add_query_arg('cat', '') ) ?>" data-option-value="*"><div class="prepend"></div><?php _e('All Categories', 'yit') ?></a></li>
							<?php if(!empty($cats)): ?>
								<?php foreach( $cats as $cat => $name ): ?>
									<?php if( yit_work_items_in_category($cat) ): ?>
									<li><a href="<?php echo esc_url( add_query_arg('cat', $cat) ) ?>" data-option-value=".<?php echo $cat ?>"><?php echo $name ?></a></li>
									<?php endif ?>
								<?php endforeach ?>
							<?php endif ?>
						</ul>
					</div>
				</div>

 				<div class="row">
 		            <ul id="portfolio" class="<?php echo $portfolio_type; ?> filterable thumbnails">         
                        <?php
                            $i = 1;
        
                            while ( yit_have_works() ) :

								$columns = yit_work_get('columns');
								$classes = "filterable_item span3";
								
								$terms = yit_work_get('terms');
								if(!empty($terms)) {
									foreach($terms as $term) {
										$classes .= " {$term} ";
									}
								}
                                
                                if($i % 4 == 1) {
                                    $classes .= ' first';
                                }
                                
                                $video_url = yit_work_get( 'video_url' );
                                $image_url = yit_work_get( 'image_url' );
                                $image_id  = yit_work_get( 'item_id' );
                                
                                $post_permalink = yit_work_permalink( $image_id ); 
                        ?>     
        
                        <li <?php yit_work_class( $classes ) ?>>
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

								$customer = yit_work_get('customer');
                        		$website = yit_work_get('website_name');
                        		$website_url = yit_work_get('website_url');
                        		$year = yit_work_get('year');
                        		$categories = yit_work_get('terms');
								
								$extra_images = yit_work_get('extra-images');

                            ?>
							 
							<div class="ch-item<?php if ( $lightbox || $details || $title ) : ?> ch-item-hover<?php endif ?>" style="background: url('<?php yit_image( "id=$image_id&size=" . apply_filters( 'yit-portfolio-thumb_portfolio_4cols-image-size', 'thumb_portfolio_4cols' ) . "&output=url" ); ?>') no-repeat center;">
								<?php if ( $lightbox || $details || $title ) : ?>   
								<div class="ch-info">
									<?php if( $lightbox || $details ): $title_class = ''; ?>
									<div class="ch-info-icons">
										<?php if( $lightbox ): ?><a href="<?php echo $thumb ?>" rel="lightbox" class="ch-info-lightbox<?php if($video_url): ?>-video<?php endif ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a><?php endif ?>
										<?php if( $details ): ?><a href="<?php echo $post_permalink ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/project.png' ?>" alt="" /></a><?php endif ?>
									</div>
									<?php else: $title_class = ' ch-info-text-noicons'; ?>
									<?php endif ?>
									
									<?php if( $title ): ?> 
									<div class="ch-info-text<?php echo $title_class ?>">
										<p class="title"><?php yit_work_the('title') ?></p>
										<p class="subtitle"><?php yit_work_the('subtitle') ?></p>
									</div>
									<?php endif ?>
								</div>
								<?php endif ?>
							</div>
                        </li>       
                        <?php if( ($i++ % 4) == 0 ) echo '<hr />' ; endwhile ?>
                        <hr />
                    </ul>
                    <?php yit_portfolio_pagination() ?>
               </div>

<?php if( yit_work_get('filter_active') ): ?>
<script type="text/javascript">
jQuery(document).ready(function($){
	//filterable
	var container = $('#portfolio');
	
	container.find('hr').remove();
	container.imagesLoaded( function(){
		container.isotope({
			itemSelector: 'li.filterable_item',
			itemPositionDataEnabled: true
		});
	});
	
	$('.filters li a').click(function(){
		$('.filters li a').removeClass('active');
		$(this).addClass('active');
		
		$('.ch-item').removeClass('ch-item-opened');
		$('.slide_detail').slideUp('slow');
		$('ul#portfolio hr').slideUp('slow');
			
		var selector = $(this).attr('data-option-value');
		
		container.isotope({ filter: selector });
		
		return false;
	}).filter(':first').click();
	
	$('#primary').resize(function(){
		$(window).trigger('sticky');
	})
	
	$(window).resize(function(){
		$('.filters li a.active').click();
	});
});
</script>
<?php endif ?>
