<?php
/*Portfolio Search Template*/
global $mango_settings,$mango_layout_columns, $post;
$mango_layout_columns = mango_page_columns();
$portfolio_template = true;
$mango_class_name = mango_class_name ();
get_header();
$portfolio_settings = mango_portfolio_settings();
$containerClass = mango_main_container_class();

?>
    <div class="<?php echo esc_attr($containerClass); ?> main">
        <div class="row">
            <div class="<?php echo esc_attr($mango_class_name); ?>">
                    <?php if(have_posts()){ ?>
						<ul id="portfolio-filter" class="text-center">
							<li class="active"><a href="#" data-filter="*"><?php _e("All","mango") ?></a></li>
								<?php $categories = get_terms( "portfolio-category", 'orderby=count' ); //&hide_empty=0
								//print_r($categories);
									//if ( $categories && ! is_wp_error( $categories ) ) {
										foreach ( $categories as $category ) { ?>
											<li><a href="#" data-filter=".category-<?php echo esc_attr($category->term_id); ?>" ><?php echo esc_html($category->name); ?></a></li>
								<?php 	}
									//} ?>
						</ul>
						<div class="row portfolio-row">
							<div id="portfolio-item-container" class="max-col-<?php echo esc_attr($portfolio_settings['cols']); ?> popup-gallery" <?php echo ($portfolio_settings['page_style']=='grid')? 'data-layoutmode="fitRows"' : ""; ?>>
								<?php while(have_posts()){
									the_post();
									get_template_part("templates/portfolio-".$portfolio_settings['style']);
								}?>
							</div>
						</div>
<?php 				}else{
							get_template_part("content-none");
					} ?>
<?php wp_reset_postdata(); ?>
            </div><!-- End .col-md-* -->
            <div class="md-margin2x clearfix visible-sm visible-xs"></div><!-- space -->
                <?php  get_sidebar() ?>
        </div><!-- End .row -->
    </div><!-- End .container -->
    <div class="lg-margin hidden-xs hidden-sm"></div><!-- space -->
    </section><!-- End #content -->
<?php get_footer() ?>