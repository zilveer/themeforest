<?php if (is_shop()) {
    $pageTitle = woocommerce_page_title(false);
} elseif (is_product_category()) {
    $pageTitle = woocommerce_page_title(false);
} elseif (is_product_tag()) {
    $pageTitle = woocommerce_page_title(false);
} else {
    $pageTitle = ct_get_single_post_title('page');
} ?>

</div>

<?php if (is_product()): ?>
<section class="<?php echo $classes?>">
    <?php else: ?>
    <section class="<?php echo $classes?>">
        <div class="container">
            <?php endif; ?>


            <?php if (is_product()): ?>
                <div class="container">
                <?php woocommerce_content(); ?>
                </div>
            <?php else: ?>

            <?php // with sidebar ?>
            <?php if (1): ?>
                <div class="row">
                    <div class="span9">
                        <?php woocommerce_content(); ?>
                    </div>
                    <div class="span3 ct-js-sidebar">
                        <div class="row">
                            <?php get_template_part('templates/sidebar-woocommerce') ?>
                        </div>
                    </div>
                </div>
                <!--row_end!-->
                <?php // no sidebar?>
            <?php else: ?>
                <div class="row">
                    <div class="span12">
                        <?php woocommerce_content(); ?>
                    </div>
                </div>
                <!--row_end!-->
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </section>
    <div class="container">
