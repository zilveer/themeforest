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
				<?php /*
				<?php $cats = yit_work_get('categories'); ?>
				<div class="row">
					<div class="span12">
						<ul class="filters">
							<li><a class="active" href="<?php echo add_query_arg('cat', '') ?>" data-option-value="*">All</a></li>
							<?php if(!empty($cats)): ?>
								<?php foreach( $cats as $cat => $name ): ?>
									<?php if( yit_work_items_in_category($cat) ): ?>
									<li>|| <a href="<?php echo add_query_arg('cat', $cat) ?>" data-option-value=".<?php echo $cat ?>"><?php echo $name ?></a></li>
									<?php endif ?>
								<?php endforeach ?>
							<?php endif ?>
						</ul>
					</div>
				</div>
				 * 
				 */?>

 				<div class="row">
 		            <ul id="portfolio" class="<?php echo $portfolio_type; ?> detail thumbnails">         
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
                                $thumbnail_url = yit_image( "id=$image_id&size=thumb_portfolio_4cols&output=url", false );
                                
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
                        		$skills_label = yit_work_get('skills_label');
								$skills = yit_work_get('skills');
								$skills_label = isset( $skills_label ) && ! empty( $skills_label ) ? $skills_label : __('Skills', 'yit');
						        $skills = isset( $skills ) && ! empty( $skills ) ? $skills : '';
						        $website = yit_work_get('website_name');
                        		$website_url = yit_work_get('website_url');
                        		$year = yit_work_get('year');
                        		$categories = yit_work_get('terms');
								
								$extra_images = yit_work_get('extra-images');

                            ?>
							 
							<div class="ch-item<?php if ( $lightbox || $details || $title ) : ?> ch-item-hover<?php endif ?>" style="background: url('<?php echo $thumbnail_url ?>') no-repeat center;">
								<?php if ( $lightbox || $details || $title ) : ?>   
								<div class="ch-info">
									<?php if( $lightbox || $details ): $title_class = ''; ?>
									<div class="ch-info-icons">
										<?php if( $lightbox ): ?><a href="<?php echo $thumb ?>" rel="lightbox" class="ch-info-lightbox<?php if($video_url): ?>-video<?php endif ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a><?php endif ?>
										<?php if( $details ): ?><a href="<?php echo $post_permalink ?>" <?php if(yit_work_get('open_slide')): ?>class="open_slide"<?php endif ?>><img src="<?php echo get_template_directory_uri() . '/images/icons/project.png' ?>" alt="" /></a><?php endif ?>
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
							
							<?php if(yit_work_get('open_slide')): ?>
							<div class="slide_detail" style="background-color: <?php echo yit_work_get('background-color') ?>;">
								<div class="container portfolio-full-description">
									<div class="slide_close">[x] <?php _e('Close','yit') ?></div>
	                                <div <?php post_class( 'work group row' ) ?>>
										<?php if ( ! empty( $image_url ) || ! empty( $video_url ) ) : ?>
							                <div class="work-thumbnail span6">
							                    <div class="thumb-wrapper">
	    											<?php if( $video_url ): ?>
	    						                        <?php list( $type, $id ) = explode( ':', yit_video_type_by_url( $video_url ) ); ?>
	    						                        <div class="post_video <?php echo $type ?>">
	    						                            <?php echo do_shortcode( "[$type video_id=\"$id\" width=\"100%\" height=\"100%\"]" ); ?>
	    						                        </div>
	    											<?php else: ?>  
	    						                        <?php if ( empty( $extra_images ) ) : ?>   
	    	                                                <a class="thumb"><?php yit_image( "id=$image_id&size=thumb_portfolio_fulldesc" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc' ); ?></a>
	    	                                            <?php else : array_unshift( $extra_images, $image_id ); ?>
	    	                                                <div class="extra-images-slider">
	    	                                                    <ul class="slides">
	    	                                                        <?php foreach ( $extra_images as $image_id ) : ?>
	    	                                                        <li><?php yit_image( "id=$image_id&size=thumb_portfolio_fulldesc" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc' ); ?></li>
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
								</div>
							</div>
							<?php endif ?>
                        </li>       
                        <?php if( ($i++ % 4) == 0 ) echo '<hr />' ; endwhile ?>
                        <hr />
                    </ul>
                    <?php yit_portfolio_pagination() ?>
               </div>

<?php if( yit_work_get('open_slide') ): ?>
<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function($){
	
	function isMobile() {
		return navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i) || ( navigator.userAgent.match(/Android/i) && navigator.userAgent.match(/Mobile/i) );
	}
	
	
	if( !isMobile() ) {

		$('.open_slide').live('click', function(e){
			e.preventDefault();
			
			var li_parent = $(this).parents('li');
			var div = li_parent.find('.slide_detail');
			if(!div.is(':visible')) {
				$('.ch-item').removeClass('ch-item-opened');
				li_parent.find('.ch-item').addClass('ch-item-opened');
				
				var slide_opened = $('.slide_detail:visible').length;
				var same_row     = slide_opened && parseInt( $('.slide_detail:visible').parents('li').index() / 5 ) == parseInt( $(this).parents('li').index() / 5 );
				
				var animation = function(div, li_parent, same_row) {
					$.Deferred(function(def) {
						def.pipe(function(){
							return $('ul#portfolio hr, .slide_detail').slideUp(500);
						}).pipe(function(){
							var offset_y = li_parent.data('isotope-item-position') ? 
											li_parent.data('isotope-item-position').y + li_parent.offset().top : 
											li_parent.offset().top;
	
							return $.scrollTo(offset_y - 40, same_row ? 1 : 500, {'axis':'y'} );
						}).pipe(function(){
						    return setTimeout(function() {
								var offset_x = li_parent.data('isotope-item-position') ? 
												li_parent.data('isotope-item-position').x + li_parent.offset().left : 
												li_parent.offset().left;
	
								div.css({
									left: -offset_x + $('#wrapper').offset().left,
									width: $('#wrapper').width()
								}).slideDown(500);
								$( li_parent ).nextAll('hr:first').slideDown(500,function(){
									//recalculate left offset once the slide is opened
									var offset_x = li_parent.data('isotope-item-position') ? 
													li_parent.data('isotope-item-position').x + li_parent.offset().left : 
													li_parent.offset().left;
									div.css({
										left: -offset_x + $('#wrapper').offset().left,
										width: $('#wrapper').width()
									});
								});
						    }, same_row ? 500 : 1000);
						});
					}).resolve();
				};
				animation( div, li_parent, same_row );
			} else {
				div.find('.slide_close').click();
			}
		});
		
		$('.slide_close').click(function(){
			$('.ch-item').removeClass('ch-item-opened');
			$(this).parents('.slide_detail').slideUp('slow');
			$('ul#portfolio hr').slideUp('slow');
		});
		
		$(window).resize(function(){
			if( !YIT_Browser.isIE8() ) {
				$('.ch-item').removeClass('ch-item-opened');
				$('.slide_detail').slideUp('slow');
				$('ul#portfolio hr').slideUp('slow');
			}
		});
	
		
	}
});
</script>
<?php endif ?>
