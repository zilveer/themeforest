<?php
global $jaw_data;
$arrows_in_header = array('blog_carousel', 'blog_carousel_vertical', 'woo_carousel', 'woo_carousel_vertical', 'woo_carousel_small', 'woo_carousel_small_vertical');
$styles_text = '';
$styles_line = '';
$styles_back = '';
if (jaw_template_get_var('text_color', '') != '') {
    $styles_text = 'color:' . jaw_template_get_var('text_color', '') . '; border-bottom-color:' . jaw_template_get_var('text_color', '') . ';';
}
if (jaw_template_get_var('line_color', '') != '') {
    $styles_line = 'border-bottom-color:' . jaw_template_get_var('line_color', '') . ';';
    $styles_back = 'background-color:' . jaw_template_get_var('line_color', '') . ';';
}
?>

<div class="row section-header <?php echo jaw_template_get_var('bar_type', 'box'); ?>">

    <?php if (jaw_template_get_var('bar_type', 'box') == 'line') { ?>
        <div class="section-line" style="<?php echo $styles_line; ?>">
            <?php if (in_array(jaw_template_get_var('element_type', ''), $arrows_in_header) || jaw_template_get_var('bar_sort', '0') == '1') { ?>
                <h3></h3>
            <?php } ?>
        <?php } else if (jaw_template_get_var('bar_type', 'box') == 'box') { ?>
            <div class="section-box box" style="<?php echo $styles_line; ?>">
                <h<?php echo jaw_template_get_var('bar_h', '3'); ?> class="section-name" style="<?php echo $styles_text . $styles_back; ?>" >

                    <?php echo jaw_template_get_var('box_title', ''); ?>
                </h<?php echo jaw_template_get_var('bar_h', '3'); ?>>   
            <?php } else if (jaw_template_get_var('bar_type', 'box') == 'big') { ?>
                <div class="section-big-wrapper" style="<?php echo $styles_line; ?>"> 
                <h<?php echo jaw_template_get_var('bar_h', '3'); ?> class="section-big" style="<?php echo $styles_text; ?>" >
                        <?php echo jaw_template_get_var('box_title', ''); ?>
                </h<?php echo jaw_template_get_var('bar_h', '3'); ?>>
                <?php } else if (jaw_template_get_var('bar_type', 'box') == 'woo') { ?>     
                    <div class="section-woo-wrapper">
                        <h<?php echo jaw_template_get_var('bar_h', '3'); ?> class="section-woo">
                            <?php echo jaw_template_get_var('box_title', ''); ?>
                        </h<?php echo jaw_template_get_var('bar_h', '3'); ?>>
                    <?php } else if (jaw_template_get_var('bar_type', 'box') == 'space') { ?>     
                        <div class="section-without-space">
                        <?php } else if (jaw_template_get_var('bar_type', 'box') == 'like_divider') { ?>     
                            <div class="section-divider-wrapper" style="<?php echo $styles_line; ?>"> 
                                <span class="divider-text"><span class="divider-center-text" style="<?php echo $styles_text; ?>">
                                        <?php echo jaw_template_get_var('box_title', ''); ?>
                                    </span></span>
                            <?php } else { ?>   
                                <?php if (in_array(jaw_template_get_var('element_type', ''), $arrows_in_header) || jaw_template_get_var('bar_sort', '0') == '1' || jaw_template_get_var('woo_bar_sort', '0') == '1') { ?>
                                    <div class="section-box-none">       
                                    <?php } else { ?>
                                        <div>
                                        <?php } ?>   
                                    <?php } ?>

                                    <?php if (jaw_template_get_var('bar_sort', '0') == '1') { ?>
                                        <ul class="items-sortby-list">
                                            <li><?php _e('Sort: ', 'jawtemplates'); ?></li>
                                            <li><a href="#date" ><?php _e('Date', 'jawtemplates'); ?></a></li>
                                            <li><a href="#name" ><?php _e('Name', 'jawtemplates'); ?></a></li>
                                            <li><a href="#rating" ><?php _e('Rating', 'jawtemplates'); ?></a></li>
                                            <li><a href="#popular" ><?php _e('Popular', 'jawtemplates'); ?></a></li>
                                            <?php if (jwOpt::get_option('custom_sort1', '0') == '1') { ?>
                                                <li><a href="#custom1" ><?php echo jwOpt::get_option('custom_sort1_name', ''); ?></a></li>
                                            <?php } ?>
                                            <?php if (jwOpt::get_option('custom_sort2', '0') == '1') { ?>
                                                '<li><a href="#custom2" ><?php echo jwOpt::get_option('custom_sort2_name', ''); ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                    <?php
                                    if (jaw_template_get_var('bar_filter', '0') == '1') {
                                        $args = array(
                                            'type' => 'jaw-portfolio',
                                            'orderby' => 'name',
                                            'order' => 'ASC',
                                            'hide_empty' => 1,
                                            'taxonomy' => 'jaw-portfolio-category'
                                        );
                                        $categories_list = get_categories($args);
                                        ?>
                                        <ul class="items-filter-list">
                                            <li><?php _e('Filter: ', 'jawtemplates'); ?></li>

                                            <li><a href="#" data-filter='*'><?php _e('All', 'jawtemplates'); ?></a></li>
                                            <?php foreach ($categories_list as $cl) {
                                                if (isset($cl->slug) && isset($cl->name)) {
                                                    ?>
                                                    <li><a href ="#" data-filter="<?php echo '.' . $cl->slug; ?>"><?php echo $cl->name; ?></a></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    <?php } ?>


                                        <?php if (jaw_template_get_var('woo_bar_sort', '0') == '1' && class_exists('WooCommerce')) { ?>
                                        <div class="woo-orderby">
                                        <?php woocommerce_catalog_ordering(); ?>
                                        </div>
                                        <div class="clear"></div>
<?php } ?>

                                </div> 

                            </div>
