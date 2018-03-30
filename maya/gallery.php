<?php
/**
 * @package WordPress
 * @subpackage Impero
 * @since Impero 1.0
 */

/*
Template Name: Gallery
*/                  

$post_type = 'yiw_gallery';  
$portfolio_type = 'filterable';

// enqueue necessary scripts
wp_enqueue_script( 'jquery-quicksand',  get_template_directory_uri()."/js/jquery.quicksand.js", array('jquery'));
   
// add body class
add_filter( 'body_class', create_function( '$classes', '$classes[] = "portfolio-' . $portfolio_type . '"; return $classes;' ) ); 


get_header();

$layout_type = yiw_layout_page();

$cat_params = Array(
    'hide_empty'    =>  FALSE,
    'title_li'      =>  ''
);

$cats = get_terms( 'category-photo', $cat_params );
$_active_title = get_post_meta( $post->ID, '_show_title_page', true );
?>  

        <div id="primary" class="layout-<?php echo $layout_type ?>">   
            <div class="inner group">

                <?php if( get_post_meta( get_the_ID(), '_slogan_page', true ) ): ?>            
                <div id="slogan">
                    <h2><?php echo get_post_meta( get_the_ID(), '_slogan_page', true ); ?></h2>
                    <h3><?php echo get_post_meta( get_the_ID(), '_subslogan_page', true ); ?></h3>
                </div>    
                <?php elseif ( is_tax() ) : ?>
                <div id="slogan">
                    <h2><?php echo ucfirst( get_query_var('term' )); ?> category</h2>
                </div>
                <?php endif; ?>
                
                <?php do_action( 'yiw_before_gallery' ) ?>
                
                <!-- FILTERS -->
                <div class="gallery-filters">
                    <?php if ( $_active_title == 'yes' || !$_active_title ) the_title( '<h1>', '</h1>' ) ?>
                    <?php if ( yiw_get_option('gallery_show_filters') ) : ?>
                    <ul class="filters gallery-categories">
                        <li class="segment-1 first"><a data-value="all" href="#"><?php _e('All', 'yiw') ?></a></li><?php  
                        foreach( $cats as $cat )
                        {
                            if( $cat->count > 0 ) :
                                ?><li class="segment-<?php echo $cat->term_id ?>"><a href="#" data-value="<?php echo strtolower(preg_replace('/\s+/', '-', $cat->slug)) ?>"><?php echo $cat->name ?></a></li><?php
                            else :
                                ?><li><?php echo $cat->name ?></li><?php
                            endif;
                        }
                    ?></ul>
                    <?php endif ?>
                </div>
                <!-- END FILTERS -->
    
                <!-- START CONTENT -->
                <div id="content" class="group">
                    <div id="portfolio-gallery" class="internal_page_items internal_page_gallery">
                        <ul class="gallery-wrap image-grid group">
                        <?php    
                        
                        $args = array(
                            'post_type'      => $post_type,
                            'posts_per_page' => -1
                        );                   
                        
                        if ( is_tax() )   
                           $args = wp_parse_args( $args, $wp_query->query ); 
                        
                        $gallery = new WP_Query( $args );   
                        
                        $postsPerRow = (yiw_layout_page() != 'sidebar-no') ? 3 : 4;
                        $i = 0;
                        
                        while( $gallery->have_posts() ) : $gallery->the_post(); ?>
                        
                            <?php 
                                $classes = "";
                                $terms = get_the_terms( get_the_ID(), sanitize_title( 'category-photo' ) );                         
                                
                                if(!empty($terms)) {
                                    foreach( $terms as $index=>$term) {
                                        $classes .= " segment-".$index;
                                    }
                                }
                    
                            ?>
                        
                            <?php $isFirstInRow = ( ++$i==1 | ($i % $postsPerRow) == 1 ) ? 1 : 0; ?>
                            <?php $isLastInRow = ( ($i % $postsPerRow) == 0 ) ? 1 : 0; ?>
                    
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
                            <li data-id="id-<?php echo $i; ?>" class="<?php if(!empty($terms)) foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->slug)) . ' '; }  ?>">
                            
                                <div class="internal_page_item internal_page_item_gallery">
                                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'thumb_gallery', array( 'class' => 'picture' ) ) ?></a>
                                    <div class="overlay">                            
                                        <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                                        <p><?php echo yiw_excerpt( 12, '', false ) ?></p>
                                        <div class="controls">
                                            <a class="icon-zoom" href="<?php echo $image[0] ?>" rel="prettyPhoto" title="<?php the_title() ?>">Zoom</a>
                                            <?php if ( yiw_get_option( 'gallery_details_icon' ) ) : ?>
                        					<a class="icon-more" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php _e( 'View More', 'yiw' ) ?></a>
                        					<?php endif ?>
                    					</div>
                                    </div>
                                </div>
                                
                            </li>
                        <?php 
                            endwhile; 
                            wp_reset_query(); 
                        ?>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    
                </div>
                <!-- END CONTENT -->
    
                <?php if($layout_type != 'sidebar-no') get_sidebar() ?>   

                <!-- START EXTRA CONTENT -->
                <?php get_template_part( 'extra-content' ) ?>      
                <!-- END EXTRA CONTENT -->    
            </div>
        </div>

<?php get_footer() ?>