<div class="td-footer-container td-container td-footer-template-10">
    <?php
    $tds_footer_top_title = td_util::get_option('tds_footer_top_title');
    // the footer top ad spot
    echo td_global_blocks::get_instance('td_block_ad_box')->render(array('spot_id' => 'footer_top', 'spot_title' => $tds_footer_top_title));

    //footer content
    td_global::vc_set_custom_column_number(3);
    dynamic_sidebar('Footer 1');
    ?>

    <div class="footer-social-wrap td-social-style2 td-footer-full">
        <?php
            if(td_util::get_option('tds_footer_social') != 'no') {

                //get the socials set by user
                $td_get_social_network = td_util::get_option('td_social_networks');

                if(!empty($td_get_social_network)) {
                    foreach($td_get_social_network as $social_id => $social_link) {
                        if(!empty($social_link) && !empty($social_id)) {
                            echo td_social_icons::get_icon($social_link, $social_id, true, true);
                        }
                    }
                }
            }
        ?>
    </div>
</div>