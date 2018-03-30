<?php
/**
 * VideoTube List Videos Shortcode
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;

if( !class_exists('Mars_ShortcodeListVideos') ){
	class Mars_ShortcodeListVideos {
		function __construct() {
			add_action('init', array($this,'add_shortcode'));
		}
		function add_shortcode(){
			add_shortcode('videotube', array($this,'videotube'));
		}
		/**
		 * Display the video, filted by the condition
		 * @param array $attr
		 * @param string $content
		 */
		function videotube( $attr, $content ) {
			ob_start();
			wp_reset_postdata();wp_reset_query();
			extract(shortcode_atts(array(
				'title'	=>	'',
				'cat'	=>	'', // video category
				'post_category'	=>	'', // regular post category
				'tag'	=>	'', // video tag.
				'post_tags'	=>	'', // regular post tag.
				'date'		=>	'',
				'today'		=>	'',
				'thisweek'	=>	'',
				'orderby'	=>	'ID',
				'order'	=>	'DESC',
				'show'	=>	get_option('posts_per_page'),
				'ids'	=>	'',
				'id'	=>	'pagebuilder' . rand(1000, 9999),
				'author'	=>	'',
				'rows'	=>	1,
				'columns'	=>	3,
				'navigation'	=>	'off',
				'sort'	=>	'off',
				'thumbnail_size'	=>	'video-featured',
				'type'	=>	'main',
				'carousel'	=>	'off',
				'autoplay'	=>	'off',
				'el_class'	=>	'',
				'post_type'	=>	'video',
				'icon'	=>	'fa-play',
				'excerpt'	=>	'off'
			), $attr));			

			if( is_front_page() ){
				$paged = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
			}
			else{
				$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			}
			
			$title = isset( $attr['title'] ) ? trim( $attr['title'] ) : null;
			$cat = !empty( $attr['cat'] ) ? explode(',', $attr['cat'] )  : null;
			$post_category = !empty( $attr['post_category'] ) ? explode(',', $attr['post_category'] )  : null;
			$tag = !empty( $attr['tag'] ) ? explode(',', $attr['tag'] )  : null;
			$post_tags = !empty( $attr['post_tags'] ) ? explode(',', $attr['post_tags'] )  : null;
			$ids = !empty( $attr['ids'] ) ? explode(',', $attr['ids'] )  : null;
			$author__in = !empty( $attr['author'] ) ? explode(',', $attr['author'] )  : null;
			$class_columns = ( 12%$columns == 0 ) ? 12/$columns : 4;
			$post_query = array(
				'post_type'	=> $post_type,
				'showposts'	=>	$show,
				'post_status'	=>	'publish',
				'order'	=>	$order,
				'no_found_rows'	=>	true
			);
			if( $type == 'main' ){
				$post_query['paged']	=	$paged;
				$post_query['no_found_rows'] = false;
			}
			
			if( $post_type == 'video' ){
				// check the video category.
				if( !empty( $cat ) && is_array( $cat ) ){
					$post_query['tax_query'] = array(
						array(
							'taxonomy' => 'categories',
							'field' => 'id',
							'terms' => $cat,
							'operator' => 'IN'	
						)
					);					
				}
				// check the video tag.
				if( !empty( $tag ) && is_array( $tag ) ){
					$post_query['tax_query'] = array(
						array(
							'taxonomy' => 'video_tag',
							'field' => 'id',
							'terms' => $tag
						)
					);						
				}
			}
			
			if( $post_type == 'post' ){
				// check the regular category
				if( !empty( $post_category ) ){
					$post_query['category__in'] = $post_category;
				}
				if( !empty( $post_tags ) ){
					$post_query['tag_slug__in'] = $post_tags;
				}
			}
						
			if( !empty( $author__in ) ){
				$post_query['author__in'] = $author__in;
			}
			if( $post_type == 'video' && $orderby == 'views' ){
				$post_query['meta_key'] = 'count_viewed';
				$post_query['orderby']	=	'meta_value_num';
			}
			elseif ( $post_type == 'video' && $orderby == 'likes' ){
				$post_query['meta_key'] = 'like_key';
				$post_query['orderby']	=	'meta_value_num';				
			}			
			else{
				$post_query['orderby'] = $orderby;
			}
						
			### Custom Video ID
			if( $ids && is_array( $ids ) ){
				unset( $post_query['tax_query'] );
				unset( $post_query['author__in'] );
				$post_query['post__in']	=	$ids;
			}
			
			if( !empty( $date ) ){
				$dateime = explode("-", $date);
				$post_query['date_query'] = array(
					array(
						'year'  => isset( $dateime[0] ) ? $dateime[0] : null,
						'month' => isset( $dateime[1] ) ? $dateime[1] : null,
						'day'   => isset( $dateime[2] ) ? $dateime[2] : null,
					)
				);
			}
			
			if( !empty( $today ) ){
				$is_today = getdate();
				$post_query['date_query'][]	= array(
					'year'  => $is_today['year'],
					'month' => $is_today['mon'],
					'day'   => $is_today['mday']
				);
			}
			if( !empty( $thisweek ) ){
				$post_query['date_query'][]	= 	array(
					'year' => date( 'Y' ),
					'week' => date( 'W' )
				);
			}
			
			$post_query	=	apply_filters( 'mars_sc_videotube_args' , $post_query, $id );
			
			$hover_image = '';
			$wpquery = new WP_Query( $post_query );
			if( $wpquery->have_posts() ):
				if( $type == 'widget' && $carousel == 'on' ):
					?>
		          		<div id="<?php print $id;?>" class="carousel slide video-section page-builder<?php print $id;?> <?php print $el_class;?>" data-ride="carousel">
		                    <div class="section-header">
		                    	<?php if( !empty( $title ) ):?>
		                        	<h3 class="widget-title"><?php if( $icon != 'none'):?><i class="fa <?php print $icon;?>"></i><?php endif;?> <?php print $title;?></h3>
		                        <?php endif;?>
					            <?php if( $show > $columns*$rows ):?>
						            <ol class="carousel-indicators section-nav">
						            	<li data-target="#<?php print $id;?>" data-slide-to="0" class="bullet active"></li>
						                <?php 
						                	$c = 0;
						                	for ($j = 1; $j < $wpquery->post_count; $j++) {
			                					if ( $j % ($columns*$rows) == 0 && $j < $show ){
							                    	$c++;
							                    	print '<li data-target="#'.$id.'" data-slide-to="'.$c.'" class="bullet"></li> '; 
							                    }
						                	}
						                ?>				          
						            </ol>
					            <?php endif;?>
		                    </div>
		                    
		                    <div class="latest-wrapper">
		                    	<div class="row">
			                     <div class="carousel-inner">
			                       	<?php
			                       	if( $wpquery->have_posts() ) : 
			                       		$i =0;
				                       	while ( $wpquery->have_posts() ) : $wpquery->the_post();
				                       	$i++;
				                       	?>
				                       	<?php if( $i == 1 ):?>
				                       		<div class="item active">
				                       	<?php endif;?>	
				                       		<div id="video-<?php the_ID();?>" class="col-sm-<?php print $class_columns;?> col-xs-6 item responsive-height post video-<?php print get_the_ID();?>">
				                                <div class="item-img">
													<?php 
														if(has_post_thumbnail()){
															print '<a title="'.get_the_title().'" href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null, $thumbnail_size , array('class'=>'img-responsive')) .'</a>';
														}
													?>
													<a href="<?php echo get_permalink(get_the_ID()); ?>"><?php if( $post_type == 'video' ):?><div class="img-hover"></div><?php endif;?></a>
												</div>
	                                            <h3><a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
												<?php do_action( 'mars_video_meta' );?>
												<?php 
												if( $post_type == 'post' ){
													print '
													<div class="post-header">
														<span class="post-meta">
															<i class="fa fa-clock-o"></i> '.get_the_date('', get_the_ID()).'
														</span>
													</div>
													';
												}
												?>
												<?php 
													if( isset( $excerpt ) && $excerpt == 'on' ){
														print '<div class="post-excerpt">';
															the_excerpt();
														print '</div>';
													}
												?>
		                                     </div> 
					                    <?php
					                    if ( $i % ($columns * $rows) == 0 && $i < $show ){
					                    	?></div><div class="item"><?php 
					                    }
				                       	endwhile;
				                      ?></div><?php 
			                       	endif;
			                       	?> 
			                        </div>
		                         </div>
		                    </div>
		                 </div>   
						<?php if( $autoplay == 'on' ):?>
							<script>
								(function($) {
								  "use strict";
								  	jQuery(document).ready(function() {
									  try {
										  jQuery('#<?php print $id;?>').carousel({
												 pause: false
											});
										  }
										  catch (e) {
											 console.log('Main Video carousel is not working');
										 }
									 })
								})(jQuery);
							</script>
						<?php endif;?>
					<?php 
				else:
					if( !empty( $title ) ):
						?>
							<div class="section-header">
								<h3 class="widget-title"><?php if( $icon != 'none'):?><i class="fa <?php print $icon;?>"></i><?php endif;?> <?php print $title;?></h3>
							</div>
						<?php 
					endif;		
					// default
					?>
					<div id="<?php print esc_attr( $id );?>" class="row columns-<?php print $columns;?> video-section meta-maxwidth-230 <?php print $el_class;?>"> 
						<?php while ( $wpquery->have_posts() ): $wpquery->the_post(); ?>
							<div class="col-sm-<?php print $class_columns;?> col-xs-6 item responsive-height post">
								<div class="item-img">
									<?php 
									if(has_post_thumbnail()):
										?><a title="<?php print get_the_title();?>" href="<?php print get_permalink( get_the_ID() );?>"><?php print get_the_post_thumbnail(null, trim( $thumbnail_size ) , array('class'=>'img-responsive')) ?></a><?php 
									endif;
									$hover_image = ( $post_type == 'video' ) ? '<div class="img-hover"></div>' : null;
									?>
									<a href="<?php print get_permalink( get_the_ID() );?>"><?php print $hover_image;?></a>
								</div>
							<?php 
							if( $post_type == 'video' ):
								?><h3><a href="<?php print get_permalink( get_the_ID() );?>"><?php print get_the_title( get_the_ID() );?></a></h3><?php 
								do_action('mars_video_meta');
							endif;
							if( $post_type == 'post' ):
								?>
									<div class="post-header">
										<h3><a title="<?php print get_the_title( get_the_ID() );?>" href="<?php print get_permalink( get_the_ID() );?>"><?php print get_the_title( get_the_ID() );?></a></h3>
										<span class="post-meta">
											<i class="fa fa-clock-o"></i> <?php print get_the_date('', get_the_ID());?>
										</span>
									</div>
							<?php endif;?>
								<?php 
									if( isset( $excerpt ) && $excerpt == 'on' ){
										print '<div class="post-excerpt">';
											the_excerpt();
										print '</div>';
									}
								?>
							</div>
						<?php endwhile;?>
					</div>
				<?php endif;?>
				<?php 
				// display the navigation
				if( $navigation == 'on' && $type == 'main' ):
					do_action( 'mars_pagination', $wpquery );
				endif;
			else:
				?><div class="alert alert-info"><?php _e('Oops...nothing.','mars');?></div><?php 
			endif;
			wp_reset_postdata();wp_reset_query();
			return ob_get_clean();
		}
	}
	new Mars_ShortcodeListVideos();
}