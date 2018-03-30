<?php
//@todo verifica daca ai ad daca nu pune clasa

$td_ad_array = td_util::get_option('td_ads');
$td_no_ad_class = '';

if(!empty($td_ad_array['header'])) {
    if (empty($td_ad_array['header']['ad_code'])) {
        $td_no_ad_class = ' td-ad';
    } else {

        if (empty($td_ad_array['header']['disable_m'])) {
            $td_no_ad_class .= ' td-ad-m';
        }


        if (empty($td_ad_array['header']['disable_tp'])) {
            $td_no_ad_class .= ' td-ad-tp';
        }

        if (empty($td_ad_array['header']['disable_p'])) {
            $td_no_ad_class .= ' td-ad-p';
        }
    }
}
?>

<div class="td-header-ad-wrap <?php echo $td_no_ad_class;?>">
    <?php
    $tds_header_ad_title = td_util::get_option('tds_header_ad_title');

    // show the header ad spot
    echo td_global_blocks::get_instance('td_block_ad_box')->render(array('spot_id' => 'header', 'spot_title' => $tds_header_ad_title)); ?>


</div>