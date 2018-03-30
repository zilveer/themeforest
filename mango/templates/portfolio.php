<?php
/*
 * Template Name: Portfolio
 */

global $mango_settings,$mango_layout_columns, $post;
$mango_layout_columns = mango_page_columns();
$portfolio_template = true;
$mango_class_name = mango_class_name ();
get_header();

$portfolio_settings = mango_portfolio_settings();

if($portfolio_settings['full-width']=='yes'){
    $mango_class_name = "col-md-12";
}
$args = array( 'posts_per_page' => '-1', 'post_type' => 'portfolio' );
$wp_query = new WP_Query( $args );
$mango_continer = mango_main_container_class() ;
?>
    <div class="<?php echo esc_attr($mango_continer); ?> main">
                <div class="row">
                    <div class="<?php echo esc_attr($mango_class_name); ?>">
                    <?php if($wp_query->have_posts()){ ?>
                    <ul id="portfolio-filter" class="text-center">
                        <li class="active"><a href="#" data-filter="*"><?php _e("All","mango") ?></a></li>
                        <?php $categories = get_terms( "portfolio-category", 'orderby=count' ); //&hide_empty=0
                        if ( $categories && ! is_wp_error( $categories ) ) {
                            foreach ( $categories as $category ) { ?>
                                <li><a href="#" data-filter=".category-<?php echo esc_attr($category->term_id); ?>" ><?php echo esc_attr($category->name); ?></a></li>
                            <?php }
                        } ?>
                    </ul>
    <?php if($portfolio_settings['full-width']=='yes'){ ?>
                    </div>
                </div>
    </div>
        <?php if($portfolio_settings['style'] !='simple'){?>
            <div class="container-fluid">
        <?php } ?>
    <?php } ?>
    <?php if( !($portfolio_settings['full-width']=='yes' && $portfolio_settings['style'] =='simple')){ $div_close = true; ?>
        <div class="row portfolio-row">
    <?php  } ?>
                            <div id="portfolio-item-container" class="max-col-<?php echo esc_attr($portfolio_settings['cols']); ?> popup-gallery" <?php echo ($portfolio_settings['page_style']=='grid')? 'data-layoutmode="fitRows"' : ""; ?>>
                                <?php while($wp_query->have_posts()){
                                    $wp_query->the_post();
                                    get_template_part("templates/portfolio",$portfolio_settings['style']);
                                }?>
                            </div>
    <?php if(isset($div_close) && $div_close==true){ ?>
        </div>
    <?php } ?>
                    <?php }else{
                        get_template_part("content-none");
                    } ?>
                    <?php wp_reset_postdata(); ?>
                <?php
                    if($portfolio_settings['full-width']!='yes'){ ?>
                      </div><!-- End .col-md-* -->
                     <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
                       <?php get_sidebar(); ?>
                    </div><!-- End .row -->
                    <?php }?>
    <?php if(isset($div_close) && $div_close==true){ ?>
        </div>
    <?php } ?>

        <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->

    </section><!-- End #content -->
<?php get_footer() ?>