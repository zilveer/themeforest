<?php get_header(); ?>

<?php $col = (is_product()) ? 12 : 8; ?>

<section id="main" class="container">

    <div class="subtitle">
        <div class="row">
            <div class="col-xs-6 col-sm-6">
               <h2> <?php if ( !is_product() ) {
                    single_cat_title( '', true );
                } else {
                    the_title();
                } ?>
                </h2>
            </div>    
            <div class="col-xs-6 col-sm-6">
                <?php themeum_breadcrumbs(); ?>
            </div>
        </div>
    </div>

	<div class="row">
        <div id="content" class="col-md-8" role="main">

            <div class="site-content">
                <?php woocommerce_content(); ?>
            </div>
        </div> <!-- #content -->

        <div id="sidebar" class="col-md-4" role="complementary">
            <aside class="widget-area">
                <?php dynamic_sidebar('shop');?>
            </aside>
        </div> <!-- #sidebar -->
    </div> <!-- .row -->
</section>

<?php get_footer(); ?>