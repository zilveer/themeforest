<?php
global $qode_options;

$enable_navigation = true;
if (isset($qode_options['portfolio_hide_pagination']) && $qode_options['portfolio_hide_pagination'] == "yes"){
    $enable_navigation = false;
}

$navigation_through_category = false;
if (isset($qode_options['portfolio_navigation_through_same_category']) && $qode_options['portfolio_navigation_through_same_category'] == "yes")
    $navigation_through_category = true;
?>

<?php

$icon_navigation_class = "fa fa-angle-";

if (isset($qode_options['portfolio_single_navigation_arrows_type']) && $qode_options['portfolio_single_navigation_arrows_type'] != '') {
    $icon_navigation_class = $qode_options['portfolio_single_navigation_arrows_type'];
}

$direction_nav_classes = qode_horizontal_slider_icon_classes($icon_navigation_class);


$back_to_button_code = '<i class="fa fa-th"></i>';

if ($qode_options['portfolio_back_to_button_choice'] == 'icon'){
    if (isset($qode_options['portfolio_back_to_button_icon']) && $qode_options['portfolio_back_to_button_icon'] != '') {
        $back_to_button = $qode_options['portfolio_back_to_button_icon'];
        $back_to_button_code = '<span class="' . $back_to_button . '"></span>';
    }
}
elseif ($qode_options['portfolio_back_to_button_choice'] == 'custom_icon') {
    if (isset($qode_options['portfolio_back_to_button_custom_icon']) && $qode_options['portfolio_back_to_button_custom_icon'] != '') {
        $back_to_button_code = '<span class="portfolio_single_nav_custom"></span>';
    }
}


?>

<?php if($enable_navigation){ ?>
    <div class="portfolio_navigation">
        <div class="portfolio_navigation_inner">
            <?php if(get_previous_post() != ""){ ?>
                <div class="portfolio_prev">
                    <?php
                    if($navigation_through_category){
                        previous_post_link('%link','<span class="' .$direction_nav_classes['left_icon_class']. '"></span>', true,'','portfolio_category');
                    } else {
                        previous_post_link('%link','<span class="' .$direction_nav_classes['left_icon_class']. '"></span>');
                    }
                    ?>
                </div> <!-- close div.portfolio_prev -->
            <?php } ?>
            <?php if(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true) != "") { ?>
                <div class="portfolio_button">
                    <a href="<?php echo esc_url(get_permalink(get_post_meta(get_the_ID(), "qode_choose-portfolio-list-page", true))); ?>"><?php echo wp_kses($back_to_button_code,array(
                        'span' => array("class" => true),
                        'i' => array("class"=> true)
                    ));?></a>
                </div> <!-- close div.portfolio_button -->
            <?php } ?>
            <?php if(get_next_post() != ""){ ?>
                <div class="portfolio_next">
                    <?php
                    if($navigation_through_category){
                        next_post_link('%link','<span class="' .$direction_nav_classes['right_icon_class']. '"></span>', true,'','portfolio_category');
                    } else {
                        next_post_link('%link','<span class="' .$direction_nav_classes['right_icon_class']. '"></span>');
                    }
                    ?>
                </div> <!-- close div.portfolio_next -->
            <?php } ?>
        </div>
    </div> <!-- close div.portfolio_navigation -->
<?php } ?>	