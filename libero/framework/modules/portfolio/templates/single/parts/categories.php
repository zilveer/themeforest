<?php if(libero_mikado_options()->getOptionValue('portfolio_single_hide_categories') !== 'yes') : ?>

    <?php
    $categories   = wp_get_post_terms(get_the_ID(), 'portfolio-category');
    $categy_names = array();

    if(is_array($categories) && count($categories)) :
        foreach($categories as $category) {
            $categy_names[] = $category->name;
        }

        ?>
        <div class="mkd-portfolio-info-item mkd-portfolio-categories">
            <h6 class="mkd-info-title"><?php esc_html_e('Category:', 'libero'); ?></h6>

            <p>
                <?php echo esc_html(implode(', ', $categy_names)); ?>
            </p>
        </div>
    <?php endif; ?>

<?php endif; ?>