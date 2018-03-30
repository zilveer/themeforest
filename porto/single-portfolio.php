<?php get_header() ?>

<?php
wp_reset_postdata();

global $porto_settings, $porto_layout;

$options = array();
$options['themeConfig'] = true;
$options['lg'] = $porto_settings['portfolio-related-cols'];
if ($porto_layout == 'wide-left-sidebar' || $porto_layout == 'wide-right-sidebar' || $porto_layout == 'left-sidebar' || $porto_layout == 'right-sidebar')
    $options['lg']--;
if ($options['lg'] < 2)
    $options['lg'] = 2;
$options['md'] = $porto_settings['portfolio-related-cols'] - 1;
if ($options['md'] < 2)
    $options['md'] = 2;
$options['sm'] = $porto_settings['portfolio-related-cols'] - 2;
if ($options['sm'] < 1)
    $options['sm'] = 1;
$options = json_encode($options);

// check portfolio ajax modal
if (porto_is_ajax() && isset($_POST['ajax_action']) && $_POST['ajax_action'] == 'portfolio_ajax_modal') {
    $porto_settings['portfolio-zoom'] = false;
}
?>

    <div id="content" role="main" class="<?php if ($porto_layout === 'wide-left-sidebar' || $porto_layout === 'wide-right-sidebar') echo 'm-t-lg m-b-xl m-r-md m-l-md' ?>">

        <?php if (have_posts()) : the_post();
            $portfolio_layout = get_post_meta($post->ID, 'portfolio_layout', true);
            $portfolio_layout = ($portfolio_layout == 'default' || !$portfolio_layout) ? $porto_settings['portfolio-content-layout'] : $portfolio_layout;
            ?>

            <?php get_template_part('content', 'portfolio-'.$portfolio_layout); ?>

            <?php if ($porto_layout === 'widewidth') echo '<div class="container m-b-xl">' ?>

            <?php if ($portfolio_layout !== 'carousel' && $portfolio_layout !== 'medias') : ?>

                <?php
                if ($porto_settings['portfolio-related']) :
                    $related_portfolios = porto_get_related_portfolios($post->ID);
                    if ($related_portfolios->have_posts()) : ?>
                        <hr class="tall"/>
                        <div class="related-portfolios <?php echo $porto_settings['portfolio-related-style'] ?>">
                            <h4 class="sub-title"><?php echo __('Related <strong>Work</strong>', 'porto'); ?></h4>
                            <div class="row">
                                <div class="portfolio-carousel porto-carousel owl-carousel show-nav-title" data-plugin-options="<?php echo esc_attr($options) ?>">
                                    <?php
                                    while ($related_portfolios->have_posts()) {
                                        $related_portfolios->the_post();

                                        get_template_part('content', 'portfolio-item');
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif;
                endif;

            endif;

            if ($porto_layout === 'widewidth') echo '</div>';

        endif; ?>

    </div>

<?php get_footer() ?>