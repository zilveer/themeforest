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
	
wp_enqueue_script( 'black-and-white' );

$args = array(
    'post_type' => 'services',
    'posts_per_page' => $items,
);

$services = new WP_Query( $args );
$sidebar_layout = yit_get_sidebar_layout();

if( $items_per_row == 2 || $items_per_row == 3 || $items_per_row == 4 || $items_per_row == 6 ) $items_span = 12 / $items_per_row;
else $items_span = 3;

if( $services->have_posts() ) :
    global $wp_query, $post, $more;
	if($services_style == "bandw") :
	//if(true) :
	?>
		<div class="section services margin-top margin-bottom section-services-bandw">
			<?php if( !empty( $title ) ) { yit_string( '<h3 class="title">', yit_decode_title($title), '</h3>' ); } ?>
	    	<?php if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); } ?>
			<div class="services-row row group">
				<?php while( $services->have_posts() ) : $services->the_post() ?>
				<div class="span<?php echo $items_span; ?> service-wrapper">
					<div class="service group">
						<div class="image-wrapper">
							<a href="<?php the_permalink() ?>" class="bwWrapper"><?php echo has_post_thumbnail() ? yit_image( 'size=section_services', false ) : yit_image( 'src=' . YIT_CORE_ASSETS_URL . '/images/no-featured-175.jpg&title=' . __( '(this post does not have a featured image)', 'yit' ) . '&alt=no featured image', false ) ?></a>
						</div>
					<?php if( $show_title == "1" || $show_title == 'yes' ): ?><h4><a href="<?php the_permalink() ?>"><?php echo yit_decode_title(get_the_title()); ?></a></h4><?php endif ?>
					<?php if( $show_excerpt == "1" || $show_excerpt == 'yes' ): ?>
						<?php echo yit_content( 'content', $excerpt_length ); ?>
						<?php if( $show_services_button == "1" || $show_services_button == "yes" ) : ?>
                            <div class="read-more"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo $services_button_text ?></a></div> 
						<?php endif ?>
					<?php endif ?>
					</div>
				</div>
				<?php endwhile ?>
			</div><!-- end row -->
		</div>
    <?php else : ?>
    	<div class="section ch-grid services margin-top margin-bottom section-services-circle">
			<?php if( !empty( $title ) ) { yit_string( '<h3 class="title">', $title, '</h3>' ); } ?>
	    	<?php if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); } ?>
			<div class="services-row row group">   <!-- qui va bene messo row, sta subito prima gli span, gli elementi reali che devono essere incolonnati. -->
				<?php while( $services->have_posts() ) : $services->the_post() ?>
				    <div class="span<?php echo $items_span; ?>">
				    	<div class="circle-services">
					    	<?php if (has_post_thumbnail()):
								//$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'section_services' );
								$image_id = get_post_thumbnail_id( get_the_ID() );
								$image[0] = yit_image( "id=$image_id&size=section_services&output=url", false );
							else:
								$image[0] = YIT_CORE_ASSETS_URL . '/images/no-featured-175.jpg';
							endif ?>
					        <div class="ch-item <?php if($show_detail_hover == 'yes' || $show_detail_hover == '1'  || $show_title_hover == 'yes' || $show_title_hover == '1'): ?>no-empty<?php endif ?>" style="background-image: url(<?php echo $image[0] ?>);">
					            <div class="ch-info">
					            	<a href="<?php the_permalink() ?>"><img src="<?php echo YIT_IMAGES_URL . '/project_empty.png'; ?>" alt="" width="175" height="175" /></a>								
					                <?php if($show_detail_hover == 'yes' || $show_detail_hover == '1'): ?> 
					                	<p class="related_project"><a href="<?php the_permalink() ?>"><img src="<?php echo YIT_IMAGES_URL . '/icons/project.png'; ?>" alt="project" /></a></p>
					                <?php endif ?>
					                <?php if($show_title_hover == 'yes' || $show_title_hover == '1'): ?>
					                	<p><a href="<?php the_permalink() ?>"><?php the_title() ?></a></p>
					                <?php endif ?>
					            </div>
					        </div>
					    </div>
					    <?php if( $show_title == "1" || $show_title == 'yes' ): ?><h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4><?php endif ?>
						<?php if( $show_excerpt == "1" || $show_excerpt == 'yes' ): ?><?php echo yit_content( 'content', $excerpt_length ) ?><?php endif ?>
				    </div>
				<?php endwhile ?>
			</div>
		</div>
    <?php
	endif;
endif;
wp_reset_query();