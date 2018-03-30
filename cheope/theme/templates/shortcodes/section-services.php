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

$args = array(
    'post_type' => 'services',
    'posts_per_page' => $items,
);

$services = new WP_Query( $args );
$postsPerRow = (yit_get_sidebar_layout() != 'sidebar-no') ? 4 : 6;
$sidebar_layout = yit_get_sidebar_layout();
$ss_span_class = "span". ($sidebar_layout != 'sidebar-no' ? 2 : 2);   // che è sta riga??
$sb_span_class_max = "span" . ($sidebar_layout != 'sidebar-no' ? 9 : 12);
$i = 0;

if( $services->have_posts() ) :
    global $wp_query, $post, $more;
	?>
	<!-- <div class="row">	questo row messo qua non ha tanto senso, quello che deve essere incolonnato sono i servizi, non anche i titoli -->		
		<div class="section ch-grid">
			<?php if( !empty( $title ) ) { yit_string( '<h3 class="title">', $title, '</h3>' ); } ?>
	    	<?php if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); } ?>
			<div class="services-row row group">   <!-- qui va bene messo row, sta subito prima gli span, gli elementi reali che devono essere incolonnati. -->
				<?php while( $services->have_posts() ) : $services->the_post() ?>
				    <div class="span2 <?php echo ( ($i % $postsPerRow == 0) ? "service_first" : ""); ?>">
				    	<div class="circle-services">
					    	<?php if (has_post_thumbnail()):
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'section_services' );			
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
				<?php $i++; endwhile ?>
			</div>
		</div><!-- end row -->
	<!-- </div> -->
    <?php
endif;

wp_reset_query();