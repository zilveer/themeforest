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
 		            <ul id="portfolio" class="<?php echo $portfolio_type; ?> columns thumbnails">         
                        <?php
                            $i = 1;
        
                            while ( yit_have_works() ) :
								/*
                                if($i % 3 == 0) {
                                    $classes = 'last group';
                                } elseif($i % 3 == 1) {
                                    $classes = 'first';
                                } else {
                                    $classes = '';
                                }
								
								$classes .= " one-third";
								*/
								$columns = yit_work_get('columns') ? yit_work_get('columns') : 3;
								$classes = "work span" . 12 / $columns;
                                
                                if($i % $columns == 1) {
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
        
                            <?php if ( ! empty( $image_url ) ) : ?>
							  	<div class="picture_overlay">
							  		<?php yit_image( "id=$image_id&size=thumb_portfolio_{$columns}cols" );//echo wp_get_attachment_image( $image_id, "thumb_portfolio_{$columns}cols" ); ?>
							  	
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
                            
                			<?php if(yit_work_get( 'read_more_text' ) != '') echo yit_sc_more_link( "<a class='read-more' href='{$post_permalink}'>" . yit_work_get( 'read_more_text' ) . "</a>", yit_work_get( 'read_more_text' ), $post_permalink ) ?>
                        </li>       
                        <?php $i++; endwhile ?>        
                    </ul>
                    <?php yit_portfolio_pagination() ?>
               </div>
