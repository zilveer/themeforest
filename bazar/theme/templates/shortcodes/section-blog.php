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

global $more;

remove_action( 'the_content_more_link', 'yit_simple_read_more_classes' );

$sticky_shown = false;
$sidebar_layout = yit_get_sidebar_layout() ?>
<div class="row">
    <!-- START SECTION BLOG -->
    <div class="section blog margin-bottom span<?php echo $sidebar_layout == 'sidebar-no' ? 12 : 9 ?>">
        <?php
        //Separated code for a better organization of the code
        if( !empty( $title ) ) { yit_string( '<h2 class="title">', yit_decode_title( $title ), '</h2>' ); }
	    if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); }
        ?>
            
        <div class="row">
            <?php
            //Sticky posts loop args
            if( $show_featured == '1' || $show_featured == 'yes' ) {
                $args_sticky = array(
                    'post_type' => 'post',
                    'post__in' => get_option( 'sticky_posts' ),
                    'posts_per_page' => 1
                );
                
                if( isset( $category ) && !empty( $category ) ) {
                	$args_sticky['category_name'] = $category;
                }
                
                $sticky = new WP_Query( $args_sticky );
                
                if( $sticky->have_posts() ) : $sticky->the_post();
                    $has_post_thumbnail = has_post_thumbnail() && ( $show_featured == '1' || $show_featured == 'yes' );

                    if( is_sticky( get_the_ID() ) ) :
                        $sticky_shown = true;
                        
                        if( !is_single() )
                            { $more = 0; }
                        ?>
                        <div <?php post_class( 'hentry-post span6 sticky' ) ?>>
                            <div class="row">
                                <?php if( $has_post_thumbnail ) : ?>
                                <div class="thumbnail span3">
                                    <?php the_post_thumbnail() ?>
                                    
                                    <?php if( $show_date == '1' || $show_date == 'yes' ) : ?>
                                    <div class="date span1">
                                        <p><span class="month"><?php echo get_the_date( 'M' ) ?></span><span class="day"><?php echo get_the_date( 'd' ) ?></span></p>
                                    </div>
                                    <?php endif ?>
                                </div>
                                <?php elseif( $show_date == '1' || $show_date == 'yes' ) : ?>
                                <div class="date span1">
                                    <p><span class="month"><?php echo get_the_date( 'M' ) ?></span><span class="day"><?php echo get_the_date( 'd' ) ?></span></p>
                                </div>
                                <?php endif ?>
                                
                                <div class="the-content span<?php echo $has_post_thumbnail ? 3 : ( ( $show_date == '1' || $show_date == 'yes' ) ? 5 : 6 ) ?>">
                                    <?php if( $show_title == '1' || $show_title == 'yes' ) { the_title( '<h4><a href="' . get_permalink() . '" title="' . get_the_title() . '">', '</a></h4>' ); } ?>
                                    
                                    <?php
        			                if( $show_excerpt == '1' || $show_excerpt == 'yes' ) {
        			                    if( $show_readmore == '1' || $show_readmore  == 'yes' )
        			                        { the_content( $readmore_text ); }
        			                    else
        			                        { echo yit_content( 'content', $excerpt_length ); }
        			                }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    endif;
                endif;
                
                wp_reset_query();
            }
            
            //Normal posts loop args
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => ( $sticky_shown ? $items - 1 : $items ),
                'post__not_in' => ( $sticky_shown ? get_option( 'sticky_posts' ) : array()),
            );
            if( isset( $category ) && !empty( $category ) ) {
            	$args['category_name'] = $category;
            }
            
            $posts = new WP_Query( $args );
            
            if( $posts->have_posts() ) :
                while( $posts->have_posts() ) : $posts->the_post();
                    ?>
                    <div <?php post_class( 'hentry-post span3' ) ?>>
                        <?php if( ( $show_featured == '1' || $show_featured == 'yes' ) ) : $has_post_thumbnail = has_post_thumbnail(); ?>
                            <?php if( $has_post_thumbnail ): ?>
                                <div class="thumbnail">
                                    <?php the_post_thumbnail() ?>
                                </div>
                            <?php endif;
                        endif; ?>
                        <div class="row">

                            <?php if( $show_date == '1' || $show_date == 'yes' ) : ?>
                                <div class="date span1">
                                    <p><span class="month"><?php echo get_the_date( 'M' ) ?></span><span class="day"><?php echo get_the_date( 'd' ) ?></span></p>
                                </div>
                            <?php endif ?>
                            
                            <?php if( ( $show_title == '1' || $show_title == 'yes' ) || ( $show_author == '1' || $show_author == 'yes' ) || ( $show_comments == '1' || $show_comments == 'yes' ) ) : ?>
                                <div class="meta span2">
                                    <?php if( $show_title == '1' || $show_title == 'yes' ) : ?>
                                        <?php the_title( '<h4><a href="' . get_permalink() . '" title="' . get_the_title() . '">', '</a></h4>' ) ?>
                                    <?php endif ?>
                                    
                                    <?php if( $show_author == '1' || $show_author == 'yes' ) : ?>
                                        <p class="author"><?php printf( __( 'by <strong>%s</strong>', 'yit' ), get_the_author() ) ?></p>
                                    <?php endif ?>
                                    
                                    <?php if( $show_comments == '1' || $show_comments == 'yes' ) : ?>
                                        <p class="comments"><?php comments_popup_link( __( '<strong>Comments:</strong> 0', 'yit' ), __( '<strong>Comments:</strong> 1', 'yit' ), __( '<strong>Comments:</strong> %', 'yit' ) ); ?></p>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
    <!-- END SECTION BLOG -->
    <div class="clear"></div>
    <?php wp_reset_query() ?>
</div>
<?php add_action( 'the_content_more_link', 'yit_simple_read_more_classes' ) ?>