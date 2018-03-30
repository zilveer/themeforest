<?php
/**
 * @package WordPress
 * @subpackage Sheeva
 * @since Impero 1.0
 */

/*
Template Name: Portfolio
*/                                

global $yiw_portfolio;
$yiw_portfolio = yiw_portfolios();
$post_type = yiw_get_portfolio_post_type();
                                              
$portfolio_type = ! get_post_meta( get_the_ID(), 'portfolio_type', true ) ? ( isset( $yiw_portfolio[$post_type]['layout'] ) ? $yiw_portfolio[$post_type]['layout'] : '' ) : get_post_meta( get_the_ID(), 'portfolio_type', true );

$portfolio_types = array( 
                       'no_sidebar' => array('3cols', 'slider', 'big_image'),
                       'sidebar'    => array('full_desc', 'filterable')
                   );       
                                                   
// enqueue necessary scripts
if ( $portfolio_type == 'filterable' )
    wp_enqueue_script( 'jquery-quicksand',  get_template_directory_uri()."/js/jquery.quicksand.js", array('jquery'));

get_header();                                    

$layout_type = ( in_array($portfolio_type, $portfolio_types['no_sidebar']) ) ? 'sidebar-no' : yiw_layout_page();  

if( $portfolio_type == 'full_desc' ) {
    get_template_part( 'single', 'portfolio' );
    die;
}       

$cat_params = Array(
    'hide_empty'    =>  FALSE,
    'title_li'      =>  ''
);

$cats = get_terms( $yiw_portfolio[$post_type]['tax'], $cat_params );
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
                               
                <?php if ( $portfolio_type == 'filterable' ) : ?>
                <!-- FILTERS -->
                <div class="gallery-filters">
                    <?php if ( $_active_title == 'yes' || !$_active_title ) the_title( '<h1>', '</h1>' ) ?>
                    <?php if ( yiw_get_option('portfolio_show_filters') ) : ?>
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
                <?php endif ?>
    
                <!-- START CONTENT -->
                <div id="content" class="group">
                    <?php if ( ! is_tax() && $portfolio_type != 'filterable' ) get_template_part( 'loop', 'page' ); ?>
                    <?php if ( ! empty( $portfolio_type ) ) get_template_part( 'portfolio', $portfolio_type ); ?>
                </div>
                <!-- END CONTENT -->
    
                <?php if($layout_type != 'sidebar-no') get_sidebar() ?>
    
                <!-- START EXTRA CONTENT -->
                <?php get_template_part( 'extra-content' ) ?>      
                <!-- END EXTRA CONTENT -->            
            </div>
        </div>

<?php get_footer() ?>