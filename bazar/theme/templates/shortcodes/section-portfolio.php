<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $yit_portfolio_index;
if ( ! isset( $yit_portfolio_index )  ) $yit_portfolio_index = 0;

$var['posts_per_page'] = (!is_null( $items )) ? $items : -1;

yit_get_model( 'portfolio' )->shortcode_atts = $var;
yit_set_portfolio_loop( $portfolio );

$sidebar_layout = yit_get_sidebar_layout();


?>
<div id="section-portfolio-<?php echo $yit_portfolio_index ?>" class="section portfolio"><!-- section blog wrapper -->
    
	<?php if( ! yit_is_portfolio_empty() ): ?>
	
		<?php if( $portfolio_style == "slider" ) : ?>
            
            <?php if( !empty( $title ) ) { yit_string( '<h2 class="title section-portfolio-title">', yit_decode_title($title), '</h2>' ); } ?>            
            <?php if( !empty( $description ) ) { yit_string( '<p class="description section-portfolio-description">', $description, '</p>' ); } ?>
            
			<div class="portfolio-projects section-portfolio-slider margin-bottom">
				<a class="prev span1" href="#"><img src="<?php echo get_template_directory_uri() . '/theme/assets/images/section-video-left.png' ?>" /></a>
				<div  class="section-portfolio-carousel span<?php echo $sidebar_layout != 'sidebar-no' ? '7' : '10' ?>">
					<ul class="section-portfolio-slides">
						<?php while( yit_have_works() ) : ?>
							<?php
								$image_id  = yit_work_get( 'item_id' );
								$video_url = yit_work_get( 'video_url' );
								
                                if( $video_url ) {
                                    $class = "related_video";
                                    list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
                                    if( $video_type == 'youtube' ) {
                                        $image_permalink = 'http://www.youtube.com/embed/' . $video_id . '?width=640&height=480&iframe=true';
                                    } else if( $video_type == 'vimeo') {
                                        $image_permalink = 'http://player.vimeo.com/video/' . $video_id;
                                    }
                                } else {
                                    $class = "related_proj";
                                    $image_permalink = yit_work_get( 'image_url' );
                                }
							?>
							<li class="work span2">
                                <a href="<?php echo $image_permalink ?>" rel="lightbox" class="ch-info-lightbox<?php if($video_url): ?>-video<?php endif ?>">
                                    <div class="play">
                                        <img src="<?php echo get_template_directory_uri() . '/theme/assets/images/section-video-play.png' ?>" />
                                    </div>
                                    <div class="img">
                                        <?php echo wp_get_attachment_image( $image_id, 'section_video' ); ?>
                                    </div>
                                    <div class="over">
                                        <?php //if( $lightbox ): ?>
                                        <img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play-2.png' : 'zoom-2.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" />
                                        <?php //endif ?>
                                    </div>
								</a>
								<p class="title"><?php yit_work_the('title') ?></p>
							</li> 
						<?php endwhile ?>
					</ul>
				</div>
				<a class="next span1" href="#"><img src="<?php echo get_template_directory_uri() . '/theme/assets/images/section-video-right.png' ?>" /></a>
				<div class="clear"></div>
			</div>
			<?php
				wp_enqueue_script( 'caroufredsel' );
				wp_enqueue_script( 'touch-swipe' );
				wp_enqueue_script( 'mousewheel' );
			?>
			<script type="text/javascript">
			
				jQuery(function($)
				{
					jQuery(function($)
					{
						var carouFredSel = null;
						var carouFredSelOptions = {
	                            auto: false,
                                prev: '#section-portfolio-<?php echo $yit_portfolio_index ?> .prev',
                                next: '#section-portfolio-<?php echo $yit_portfolio_index ?> .next',
                                swipe: {
	                                onTouch: true
	                            },
	                            scroll : {
	                                items     : 1
	                            } 
	                    };

                        $('#section-portfolio-<?php echo $yit_portfolio_index ?> .section-portfolio-slides').imagesLoaded(function(){
                            carouFredSel = $('#section-portfolio-<?php echo $yit_portfolio_index ?> .section-portfolio-slides').carouFredSel(carouFredSelOptions);
                        });
	                    
	                    $(window).resize(function(){
	                    	carouFredSel.trigger('destroy', false).carouFredSel(carouFredSelOptions);
	                    });
	            	});
						
				});

			</script>
			
		
		<?php else: ?>
			<?php 
				wp_enqueue_script( 'caroufredsel' );
				wp_enqueue_script( 'touch-swipe' );
				wp_enqueue_script( 'mousewheel' );
				wp_enqueue_script( 'jquery-yit_portfolio_thumbs', 'js/jquery.yit_portfolio_thumbs.js' );
			?>
            <?php if( !empty( $title ) ) { yit_string( '<h2 class="title section-portfolio-title">', yit_decode_title($title), '</h2>' ); } ?>
			<?php if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); } ?>
			<div class="portfolio-projects section-portfolio-classic margin-bottom row">
				<!-- portfolio image/slider -->
				<div class="work-thumbnail span<?php echo $sidebar_layout != 'sidebar-no' ? '5' : '7' ?>">
					<div class="work-loading"><img class="work-loading" src="<?php echo YIT_THEME_TEMPLATES_URL . '/portfolios/thumbs/images/loading_660.gif' ?>" alt="loading..." /></div>
				</div>

				<!-- portfolio content -->
				<div class="work-content span<?php echo $sidebar_layout != 'sidebar-no' ? '4' : '5' ?>">
					<div class="content"></div>
					<div class="work-meta"></div>
				</div>

				<div class="clear"></div>

				<!-- portfolio thumbnails -->
				<div class="work-projects span<?php echo $sidebar_layout != 'sidebar-no' ? '9' : '12' ?>">
					<div class="row">
						<ul>
						<?php $works = array(); ?>
						<?php while ( yit_have_works() ) :  ?>
							<?php
								$image_id  = yit_work_get( 'item_id' );
								$works[$image_id] = yit_get_model('portfolio')->_current_item;
								$works[$image_id]['categories'] = yit_work_get('categories');
								$works[$image_id]['post_permalink'] = yit_work_permalink( $image_id );
							?>
							<li class="span<?php echo $sidebar_layout != 'sidebar-no' ? '1' : '2' ?>">
								<a href="<?php echo $works[$image_id]['post_permalink'] ?>" data-item="<?php echo $image_id ?>" class="img">
									<?php echo wp_get_attachment_image( $image_id, 'section_portfolio_thumb' ); ?>
								</a>
							</li>
						<?php endwhile ?>
						</ul>
				        <div class="clear"></div>
					</div>
				        <div class="nav">
				            <a class="prev" href="#"></a>
				            <a class="next" href="#"></a>
				        </div>
				</div>


				<script type="text/javascript" charset="utf-8">
				jQuery(document).ready(function($){
					var works = '<?php echo addslashes(json_encode( $works )) ?>';
					$('.section-portfolio-classic').yit_portfolio_thumbs({
						json: works,
						url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
						overlay: <?php echo $show_lightbox_hover == 'yes' ? 1 : 0 ?>,
						pagination: false,
						slider: {
							auto: false,
							prev: '.section-portfolio-classic .prev',
							next: '.section-portfolio-classic .next',
							swipe: {
								onTouch: true
							},
							scroll : {
								items     : 1,
								duration  :	500
							} 
						},
						type : 'section'
					});
				});
				</script>
			</div>			
		<?php endif // portfolio_style ?>
		
	<?php endif ?>
</div><!-- end section blog wrapper -->
<div class="clear"></div>
<?php $yit_portfolio_index++ ?>