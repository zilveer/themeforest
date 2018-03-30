<div class='mkd-product-slider-holder clearfix'>
    <div class='mkd-product-slider <?php echo esc_attr($additional_classes) ?>' <?php echo esc_html($data_attribute) ?>>

    <?php echo do_shortcode('['.$product_type.' ' . implode(' ', $product_slider_param_array) . ']'); ?>

    <?php if ($enable_navigation === 'yes') {
        $random_number = rand();
        ?>
        <ul class="caroufredsel-direction-nav">
            <li>
                <a id="caroufredsel-prev-<?php echo esc_attr($random_number); ?>" class="caroufredsel-prev" href="#">
                    <span class="icon icon-arrows-left"></span>
                </a>
            </li>
            <li>
                <a id="caroufredsel-next-<?php echo esc_attr($random_number); ?>" class="caroufredsel-next" href="#">
                    <span class="icon icon-arrows-right"></span>
                </a>
            </li>
        </ul>

    <?php } ?>

    <?php if ($pager_navigation === "yes") { ?>
        <div id="mkd-product-slider-pager-<?php echo esc_attr($random_number); ?>" class="mkd-product-slider-pager"></div>
    <?php } ?>
    </div>
</div>