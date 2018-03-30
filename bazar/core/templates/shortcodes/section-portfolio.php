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

$var['posts_per_page'] = -1;
yit_get_model( 'portfolio' )->shortcode_atts = $var;
yit_set_portfolio_loop( $portfolio );

$sidebar_layout = yit_get_sidebar_layout();
$postsPerRow = ( $sidebar_layout != 'sidebar-no') ? 3 : 4;
$sp_span_class = "span" . (( $sidebar_layout != 'sidebar-no') ? '3' : '3');
$sp_span_class_max = "span" . ($sidebar_layout != 'sidebar-no' ? '9' : '12');
$thumbSize   = ( $sidebar_layout != 'sidebar-no') ? 'section_portfolio_sidebar' : 'section_portfolio';
$i = 0;
$item_selected = 0;

?>
<div class="section portfolio"><!-- section blog wrapper -->

	<?php if( !empty( $title ) ) { yit_string( '<h3 class="title">', $title, '</h3>' ); } ?>
	<?php if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); } ?>

    
	<?php if( ! yit_is_portfolio_empty() ): ?>
		
		<?php if( $show_featured == "1" || $show_featured == 'yes' ): ?>
		<?php while( yit_have_works() ) : ?>
			<?php if( yit_work_get( 'is_sticky' ) ): ?><!-- sticky portfolio -->
			<div class="row">
				<div <?php post_class( 'work group portfolio-sticky portfolio-full-description' ) ?>>
					<?php
						$item_selected = $image_id  = yit_work_get( 'item_id' );
			    		$image_id  = yit_work_get( 'item_id' );
						$video_url = yit_work_get( 'video_url' );
						
						$show_categories = $show_categories == 1 || $show_categories == "yes";
						$terms = yit_work_get( 'terms' );
						$categories = yit_work_get('categories');
						$str_categories = '';
						if( !empty($terms) ) foreach( $terms as $name){ $str_categories .= "<a href='". yit_term_link($name) ."'>{$categories[$name]}</a>, "; }
						
						
						$show_title_hover = $show_title_hover == 1 || $show_title_hover == "yes";
						$lightbox = $show_lightbox_hover == "1" || $show_lightbox_hover == "yes";
						$detail   = $show_detail_hover == "1" || $show_detail_hover == "yes";
						$both     = $detail && $lightbox;

						$post_permalink = yit_work_permalink( $image_id );
						$class = "";
						if( $both ) {
							if( $video_url ) {
								list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
								if( $video_type == 'youtube' ) {
									$image_permalink = 'http://www.youtube.com/v/' . $video_id . '?width=640&height=480&iframe=true';
								} else if( $video_type == 'vimeo') {
									$image_permalink = 'http://player.vimeo.com/video/' . $video_id;
								}
							} else {
								$image_permalink = yit_work_get( 'image_url' );
							}
							$class = $video_url ? 'video' : 'img';
						} elseif( $lightbox ) {
							if( $video_url ) {
								$class = "related_video";
								list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
								if( $video_type == 'youtube' ) {
									$image_permalink = 'http://www.youtube.com/v/' . $video_id . '?width=640&height=480&iframe=true';
								} else if( $video_type == 'vimeo') {
									$image_permalink = 'http://player.vimeo.com/video/' . $video_id;
								}
							} else {
								$class = "related_proj";
								$image_permalink = yit_work_get( 'image_url' );
							}
						} elseif( $detail ) { 
							$class = "related_detail";
						} elseif( $show_title_hover ) {
							$class = "related_title";
						}

			    	?>
				
					<?php if ( ! empty( $image_id ) ) : ?>
						<div class="work-thumbnail <?php echo "span" . ($sidebar_layout != 'sidebar-no' ? '4' : '6'); ?>">
							<div class="thumb-wrapper">
								<div class="related_img">
						        	<div class="picture_overlay"><?php yit_image( "id=$image_id&size=$thumbSize" );//echo wp_get_attachment_image( $image_id, $thumbSize ); ?>
										<?php if ( $lightbox || $detail || $show_title_hover ) : ?>   
								  			<div class="overlay">
									  			<div>
									  				<?php if( $lightbox || $detail ): ?>
									  				<p>
														<?php if( $lightbox ): ?><a href="<?php echo $image_permalink ?>" rel="lightbox" class="ch-info-lightbox<?php if($video_url): ?>-video<?php endif ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a><?php endif ?>
														<?php if( $detail ): ?><a href="<?php echo $post_permalink ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/project.png' ?>" alt="" /></a><?php endif ?>
													</p>
									  				<?php endif ?>
													<?php if( $show_title_hover ): ?> 
														<p class="title"><?php yit_work_the('title') ?></p>
														<p class="subtitle"><?php yit_work_the('subtitle') ?></p>
													<?php endif ?>
									  			</div>
									  		</div><!-- end overlay -->
							        </div>
								</div>
								<?php endif ?>
							</div><!-- end thumb wrapper -->
						</div><!-- end work-thumbnail -->
					<?php endif ?>
					<div class="<?php echo "span" . ($sidebar_layout != 'sidebar-no' ? '5' : '6'); ?>">
						<div class="work-description">
							<h2><a href="<?php echo $post_permalink; ?>"><?php yit_work_the('title') ?></a></h2>
					
							<?php if( !empty($terms) && ($show_categories==1 || $show_categories == "yes") ): ?>
							<p class="work-categories">in: <?php echo substr($str_categories, 0, strlen($str_categories)-2) ?></p>
							<?php endif ?>
					
							<?php echo yit_content( yit_work_get( 'content' ), $featured_excerpt_length ); ?>
			                <?php if( $show_readmore == 1 || $show_readmore  == 'yes' ) :  ?>
								<a href="<?php echo $post_permalink; ?>" class="read-more"><?php echo $readmore_text ?></a>
							<?php endif ?>
					
						</div><!-- end work-description -->
					</div>
				</div>
			</div><!-- span wrapper -->
			<?php break; ?><!-- end sticky portfolio -->
			<?php endif; ?>
		<?php endwhile ?>
		<?php endif ?>


		<div class="portfolio-projects row">
			<?php
				/*$var['posts_per_page'] = $items;
				yit_get_model( 'portfolio' )->shortcode_atts = $var;
				yit_debug($var);
				yit_set_portfolio_loop( $portfolio );*/
			?>
			<?php yit_set_portfolio_loop( $portfolio ); ?>
		    <?php while( yit_have_works() ) : if( yit_work_get( 'item_id' ) != $item_selected ): ?>
		    	<?php
		    		$image_id  = yit_work_get( 'item_id' );
					$video_url = yit_work_get( 'video_url' );
		    		
					$show_categories = $show_categories == 1 || $show_categories == "yes";
					$terms = yit_work_get( 'terms' );
					$categories = yit_work_get('categories');
					$str_categories = '';
					if( !empty($terms) ) foreach( $terms as $name){ $str_categories .= "<a href='". yit_term_link($name) ."'>{$categories[$name]}</a>, "; }
					
					$show_title_hover = $show_title_hover == 1 || $show_title_hover == "yes";
					$lightbox = $show_lightbox_hover == "1" || $show_lightbox_hover == "yes";
					$detail   = $show_detail_hover == "1" || $show_detail_hover == "yes";
					$both     = $detail && $lightbox;

					$post_permalink = yit_work_permalink( $image_id );
					$class = "";
					if( $both ) {
						if( $video_url ) {
							list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
							if( $video_type == 'youtube' ) {
								$image_permalink = 'http://www.youtube.com/v/' . $video_id . '?width=640&height=480&iframe=true';
							} else if( $video_type == 'vimeo') {
								$image_permalink = 'http://player.vimeo.com/video/' . $video_id;
							}
						} else {
							$image_permalink = yit_work_get( 'image_url' );
						}
						$class = $video_url ? 'video' : 'img';
					} elseif( $lightbox ) {
						if( $video_url ) {
							$class = "related_video";
							list( $video_type, $video_id ) = explode( ':', yit_video_type_by_url( $video_url ) );
							if( $video_type == 'youtube' ) {
								$image_permalink = 'http://www.youtube.com/v/' . $video_id . '?width=640&height=480&iframe=true';
							} else if( $video_type == 'vimeo') {
								$image_permalink = 'http://player.vimeo.com/video/' . $video_id;
							}
						} else {
							$class = "related_proj";
							$image_permalink = yit_work_get( 'image_url' );
						}
					} elseif( $detail ) { 
						$class = "related_detail";
					} elseif( $show_title_hover ) {
						$class = "related_title";
					}
					
		    	?>
		
				<?php
				
				?>
				<div class="<?php if( ($i++ % $postsPerRow == 0) ): ?>work_first <?php endif ?>work <?php echo $sp_span_class; ?>">
					<div class="related_img">
					  	<div class="picture_overlay">
					  		<?php yit_image( "id=$image_id&size=thumb_portfolio_fulldesc_related" );//echo wp_get_attachment_image( $image_id, 'thumb_portfolio_fulldesc_related' ); ?>

					  		<?php if ( $lightbox || $detail || $show_title_hover ) : ?>   
					  		<div class="overlay">
					  			<div>
					  				<?php if( $lightbox || $detail ): ?>
					  				<p>
										<?php if( $lightbox ): ?><a href="<?php echo $image_permalink ?>" rel="lightbox" class="ch-info-lightbox<?php if($video_url): ?>-video<?php endif ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/' .  ($video_url  ? 'play.png' : 'zoom.png') ?>" alt="<?php _e('Open Lightbox', 'yit') ?>" /></a><?php endif ?>
										<?php if( $detail ): ?><a href="<?php echo $post_permalink ?>"><img src="<?php echo get_template_directory_uri() . '/images/icons/project.png' ?>" alt="" /></a><?php endif ?>
									</p>
					  				<?php endif ?>
									<?php if( $show_title_hover ): ?> 
										<p class="title"><?php yit_work_the('title') ?></p>
										<p class="subtitle"><?php yit_work_the('subtitle') ?></p>
									<?php endif ?>
					  			</div>
					  		</div>
					  		<?php endif ?>
					    </div>  
				    </div>
					<div class="work-description">
						<?php if( $show_title == "1" || $show_title == 'yes' ): ?><h4><a href="<?php echo $post_permalink ?>"><?php yit_work_the('title') ?></a></h4><?php endif ?>
						<?php if( $show_excerpt == "1" || $show_excerpt == 'yes' ): ?><?php echo yit_content( yit_work_get( 'content' ), $excerpt_length, '', '[...]') ?><?php endif ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if( $i == $items ) break; ?>
			<?php endwhile ?>
		</div>
	<?php endif ?>
</div><!-- end section blog wrapper -->
<div class="clear"></div>
