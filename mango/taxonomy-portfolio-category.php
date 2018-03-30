<?php
/**
Portfolio Category Page
 */
global $mango_settings,$mango_layout_columns, $post;
$mango_layout_columns = mango_page_columns();$mango_continer = mango_main_container_class();
$mango_class_name = mango_class_name ();
get_header();
$portfolio_settings = mango_portfolio_settings();
?>
    <div class="<?php echo esc_attr($mango_continer); ?>main">
                <div class="row">
                    <div class="<?php echo esc_attr($mango_class_name); ?>">
                   <?php  mango_taxonomy_banner(); ?>
                    <?php if(have_posts()){ ?>
    <div class="row portfolio-row">
        <div id="portfolio-item-container" class="max-col-<?php echo esc_attr($portfolio_settings['cols']); ?> popup-gallery" <?php echo ($portfolio_settings['page_style']=='grid')? 'data-layoutmode="fitRows"' : ""; ?>>
            <?php while(have_posts()){
                the_post();
                get_template_part("templates/portfolio",$portfolio_settings['style']);
            }?>
        </div>
    </div>
<?php }else{ 
    get_template_part("content-none");
} ?>                    <?php wp_reset_postdata(); ?>
                    </div><!-- End .col-md-* -->

                    <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
                <?php  get_sidebar() ?>
                </div><!-- End .row -->
            </div><!-- End .container -->
        <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->
    </section><!-- End #content -->
<?php get_footer() ?>