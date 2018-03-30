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
$ss_span_class = "span2"; 
$sb_span_class_max = "span" . ($sidebar_layout != 'sidebar-no' ? 9 : 12);
$i = 0;

if( $services->have_posts() ) :
    global $wp_query, $post, $more;
    ?>
    	<div class="<?php if($i % $postsPerRow) == 0 : ?>service_first <?php endif ?>section services">
	    	<?php if( !empty( $title ) ) { yit_string( '<h3 class="title">', $title, '</h3>' ); } ?>
	    	<?php if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); } ?>
	    		<?php while( $services->have_posts() ) : $services->the_post() ?>
				<div class="<?php echo $ss_span_class ?>">
					<div class="related_project">
						<a title="<?php if($show_title_hover == 'yes' || $show_title_hover == '1'): ?><?php the_title() ?><?php endif ?>" href="<?php the_permalink() ?>" class="related_img<?php if($show_detail_hover == 'yes' || $show_detail_hover == '1' ): ?> related_detail<?php elseif($show_title_hover == 'yes' || $show_title_hover == '1' ): ?> related_title<?php endif ?>">
							<?php echo has_post_thumbnail() ? yit_image( "size=thumb_portfolio_fulldesc_related", false ) : '<img src="' . YIT_CORE_ASSETS_URL . '/images/no-featured-175.jpg" title="' . __( '(this post does not have a featured image)', 'yit' ) . '" alt="" />' ?>
						</a>
						<?php if( $show_title == "1" || $show_title == 'yes' ): ?><h4 class="related_title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4><?php endif ?>
						<?php if( $show_excerpt == "1" || $show_excerpt == 'yes' ): ?><?php echo yit_content( 'content', $excerpt_length ) ?><?php endif ?>
					</div>
				</div>
			<?php $i++; endwhile ?>
	    </div>
	<!-- </div> -->
    <?php
endif;

wp_reset_query();