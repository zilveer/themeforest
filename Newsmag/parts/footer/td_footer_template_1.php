<div class="td-footer-container td-container">

    <div class="td-pb-row">
        <div class="td-pb-span12">
            <?php
            $tds_footer_top_title = td_util::get_option('tds_footer_top_title');
            // ad spot
            echo td_global_blocks::get_instance('td_block_ad_box')->render(array('spot_id' => 'footer_top', 'spot_title' => $tds_footer_top_title));
            ?>
        </div>
    </div>

    <div class="td-pb-row">
        <div class="td-pb-span4">
            <?php locate_template('parts/footer/td_footer_extra.php', true); ?>
        </div>

        <div class="td-pb-span4">
            <?php
            td_global::vc_set_custom_column_number(1);
            echo td_global_blocks::get_instance('td_block_7')->render(array(
                'custom_title' => __td('EVEN MORE NEWS'),
                'border_top' => 'no_border_top',
                'limit' => 3
            ));
            ?>
        </div>

        <div class="td-pb-span4">
            <?php
            td_global::vc_set_custom_column_number(1);
            echo td_global_blocks::get_instance('td_block_popular_categories')->render(array(
                'number' => 5,
                'custom_title' => __td('POPULAR CATEGORY')
            ));
            ?>
        </div>
    </div>
</div>