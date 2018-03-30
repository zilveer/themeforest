<?php
/*  ----------------------------------------------------------------------------
    Taxonomy gallery category
 */

get_header();

global $wp_query;
global $taxonomy;
global $fave_taxonomy_id;
global $fave_taxonomy_name;
global $fave_sidebar;
global $fave_cat_pagination;
global $column_one;
global $column_two;
global $css_classes;
global $fave_container;
global $stick_sidebar;

$taxonomy = $wp_query->get_queried_object();

if( $ft_option['sticky_sidebar'] != 0 ) {
    $stick_sidebar = 'magzilla_sticky';
}

$fave_taxonomy_id = $taxonomy->term_id;
$fave_taxonomy_name = $taxonomy->name;

$fave_sidebar = 'gallery-sidebar';
$fave_cat_pagination = 'numeric';
    

$column_one = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
$column_two = "col-lg-4 col-md-4 col-sm-4 col-xs-12";
$css_classes = "col-lg-6 col-md-6 col-sm-6 col-xs-6";

$img_width = '370'; $img_height = '277';



?>

<div class="<?php echo $fave_container; ?>">
		
	<div class="row">
        
        <div class="<?php echo $column_one; ?>">
            <main class="site-main" role="main">
                <div class="archive archive-1 post-archive main-box-for-load-more ">
                    <div class="module-top clearfix">
                        <?php get_template_part( 'inc/taxonomy','head' ); ?>
                    </div><!-- .module-top -->      
                    
                    
                    <div class="row">
                        <div class="fave-loop-wrap">
                            <div class="fave-post">
                            <?php while ( have_posts() ): the_post(); ?>
                            
                                <div class="<?php echo $css_classes; ?>">
                                    <div class="thumb big-thumb">
                                        <a href="<?php echo esc_url( get_permalink() ); ?>"></a>
                                        <div class="thumb-content">
                                            <h2 class="gallery-title-small"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
                                            <ul class="list-inline post-meta hidden-xs hidden-sm hidden-md">
                                                <?php get_template_part( 'inc/gallery', 'meta' ); ?>
                                            </ul><!-- .post-meta -->
                                        </div>
                                        <div class="slide-image-wrap">
                                            <div class="post-type-icon"><i class="fa fa-picture-o"></i></div>
                                            <img class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), $img_width, $img_height, true, true, true ); ?>" alt="<?php the_title(); ?>">
                                        </div><!-- slide-image-wrap -->
                                    </div><!-- thumb -->
                                </div><!-- col-lg-4 col-md-4 col-sm-6 col-xs-6 -->
                                
                            <?php endwhile; ?>
                            </div>
                        </div>

                    </div><!-- row --> 

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <?php get_template_part( 'inc/pagination/'.$fave_cat_pagination ); ?>
                        </div>
                    </div>
                    
                </div><!-- archive post-archive -->
            </main><!-- site-main -->
        </div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->

        
        <div class="<?php echo $column_two.' '.$stick_sidebar; ?>">
            <?php get_sidebar(); ?>
        </div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
        

    </div><!-- .row -->

</div> <!-- End Container -->


<?php get_footer(); ?>