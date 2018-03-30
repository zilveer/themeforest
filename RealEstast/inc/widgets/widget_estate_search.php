<?php

class PGL_Widget_Estate_Search extends WP_Widget
{
    function __construct()
    {
        $widget_options = array(
            'classname' => 'searchbox',
            'description' => __('Estate search', PGL)
        );
        parent::__construct('estate_search', __('PixelGeekLab Estate search', PGL), $widget_options);
    }

    function form($instance)
    {
        global $pgl_options;
        $instance = wp_parse_args($instance, array('core_fields' => array()));
        ?>
        <h3><?php _e('Select fields to search:', PGL); ?></h3>
        <?php

        $searchable_core_fields = array('type' => 1, 'location' => 1) + $pgl_options->option('estate_searchable_fields', array());

        if (!empty($searchable_core_fields)) {
            ?>
            <h4><?php _e('Core fields:', PGL); ?></h4>
            <?php
            foreach ($searchable_core_fields as $core_field => $check) {
                ?>
                <label for="<?php echo $this->get_field_id('core_field_' . $core_field); ?>">
                    <input id="<?php echo $this->get_field_id('core_field_' . $core_field); ?>" type="checkbox"
                           name="<?php echo $this->get_field_name('core_fields'); ?>[]"
                           value="<?php echo $core_field ?>" <?php if (in_array($core_field, $instance['core_fields'])) echo 'checked'; ?> />
                    &nbsp; <?php echo strtoupper($core_field); ?>
                </label><br>
            <?php
            }
            ?>
        <?php
        }

        do_action('estate/widget/estate_search_form', $this, $instance);
    }

    function update($new_instance, $old_instance)
    {
        $old_instance['core_fields'] = $new_instance['core_fields'];
        $old_instance = apply_filters('estate/widget/estate_search_update', $old_instance, $new_instance);
        return $old_instance;
    }


    function widget($args, $instance)
    {
        global $pgl_options;
        extract($args);
        /**
         * @var string $before_widget
         * @var string $after_widget
         */

        $type_search_enable = in_array('type', $instance['core_fields']) ? TRUE : FALSE;
        $location_search_enable = in_array('location', $instance['core_fields']) ? TRUE : FALSE;

        echo $before_widget;
        $purpose = isset($_GET['purpose']) && $_GET['purpose'] ? trim($_GET['purpose']) : 'sale';


        if ($type_search_enable) {
            $terms_1 = get_terms('estate-type'); //search by category
            $term1_html = '';
            if (!empty($terms_1)) {
                $s_term = isset($_GET['term']) ? $_GET['term'] : '';
                foreach ($terms_1 as $term) {
                    $term1_html .= '<option value="' . $term->slug . '" ' . ($term->slug == $s_term ? 'selected' : '') . '>' . $term->name . '</option>';
                }
            }
        }

        if ($location_search_enable) {
            $term_2 = get_terms('estate-location'); //search by location
            $term2_html = '';
            if (!empty($term_2)) {
                $s_term = isset($_GET['location']) ? $_GET['location'] : '';
                foreach ($term_2 as $term) {
                    $term2_html .= '<option value="' . $term->slug . '" ' . ($term->slug == $s_term ? 'selected' : '') . '>' . $term->name . '</option>';
                }
            }
        }
        $sType = $pgl_options->option('estate_system_type');
        ?>
            <div class="find tabberlive">
                <div class="widget-search">
                    <ul class="nav nav-tabs tabbernav">
                        <?php if($sType == 'both' || $sType == 'sale'):?>
                            <li<?php if($purpose == 'sale' || $sType == 'sale'):?> class="active"<?php endif;?>>
                                <a href="#sale" data-toggle="tab">
                                    <?php _e('For sale', PGL); ?>
                                </a>
                            </li>
                        <?php endif;?>
                        <?php if($sType == 'both' || $sType == 'rental'):?>
                            <li<?php if($purpose == 'rent' || $sType == 'rental'):?> class="active"<?php endif;?>>
                                <a href="#rent" data-toggle="tab">
                                    <?php _e('For rent', PGL); ?>
                                </a>
                            </li>
                        <?php elseif($sType=='showcase'):?>
	                        <li class="active">
		                        <a href="#showcase" data-toggle="tab">
			                        <?php _e('Search for estate', PGL); ?>
		                        </a>
	                        </li>
                        <?php endif;?>
                    </ul>
                    <div class="tab-content">
                        <?php
                        if ($sType == 'both' || $sType == 'sale'):?>
                            <div class="tab-pane<?php if($purpose == 'sale' || $sType == 'sale'):?> active<?php endif;?>" id="sale">
                                <div class="row">
                                    <form action="<?php echo get_home_url(); ?>">
                                        <input type="hidden" name="purpose" value="sale"/>
                                        <input type="hidden" name="s"/>
                                        <input type="hidden" name="search" value="1"/>
                                        <input type="hidden" name="post_type" value="estate"/>
                                        <?php
                                        $sale_html_array = array();

                                        //$sale_html_array[] = '<input type="text" class="keywordfind form-control" placeholder="'.__('Sale search keyword…', PGL).'" name="s" value="' . (isset($_GET['s']) ? $_GET['s'] : '') . '"/>';

                                        //price field - Sale price
                                        $sale_price_value = $pgl_options->option('estate_searchable_field_sale_price');
                                        if (!empty($sale_price_value)) {
                                            $prices = explode(';', $sale_price_value);
                                            $html_price_from = $html_price_to = '';
                                            $price_from = isset($_GET['price_from']) ? $_GET['price_from'] : '';
                                            foreach ($prices as $price) {
                                                if ($price) {
                                                    $html_price_from .= '<option value="' . ($price) . '" ' . ($price == $price_from ? 'selected' : '') . '>' . PGL_Addon_Estate::format_price($price) . '</option>';
                                                }
                                            }
                                            $sale_html_array[] =
                                                '<select name="price_from" id="price_from" class="form-control">
                                                    <option value="" selected>' . __('Price from', PGL) . '</option>
                                                    ' . $html_price_from . '
                                                </select>';
                                        }

                                        // Core fields display
                                        $searchable_core_fields = array_flip($instance['core_fields']);

                                        $sale_html_array = array_merge($sale_html_array, PGL_Addon_Estate::display_default_search_fields($searchable_core_fields, FALSE, 12, FALSE));

                                        $sale_html_array = apply_filters('estate/search_field/after_default_fields_listing', $sale_html_array, 'widget');

                                        if ($type_search_enable && !empty($term1_html)) {
                                            $sale_html_array[] =
                                                '<select name="type" id="term1" class="form-control">
                                                    <option value="">' . __('Select type', PGL) . '</option>
                                                    ' . $term1_html . '
                                                </select>';
                                        }

                                        if ($type_search_enable && !empty($term2_html)) {
                                            $sale_html_array[] =
                                                '<select name="location" id="term2" class="form-control">
                                                    <option value="">' . __('Select location', PGL) . '</option>
                                                    ' . $term2_html . '
                                                </select>';
                                        }

                                        $sale_html_array[] =
                                            '<button class="search" type="submit" id="searchsubmit">'.__('Search', PGL).'</button>';
                                        $len = count($sale_html_array);
                                        foreach ($sale_html_array as $key => $html_part) {
                                            if ($key == 0 || ($key == $len - 1) || ($key == $len - 2 && $key % 2 == 1)) {
                                                echo '<div class="clearfix"></div><div class="col-md-12 col-sm-12">' . $html_part . '</div>';
                                                continue;
                                            }
                                            echo '<div class="col-md-6 col-sm-12">' . $html_part . '</div>';
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        <?php endif;?>
                        <?php if ($sType == 'both' || $sType == 'rental'):?>
                            <div class="tab-pane<?php if($purpose == 'rent' || $sType == 'rental'):?> active<?php endif;?>" id="rent">
                                <div class="row">
                                <form action="<?php echo get_home_url(); ?>">
                                    <input type="hidden" name="purpose" value="rent"/>
                                    <input type="hidden" name="s"/>
                                    <input type="hidden" name="search" value="1"/>
                                    <input type="hidden" name="post_type" value="estate"/>
                                    <?php
                                    $sale_html_array = array();

                                    //$sale_html_array[] = '<input type="text" class="keywordfind form-control" placeholder="'.__('Rental search keyword…', PGL).'" name="s" value="' . (isset($_GET['s']) ? $_GET['s'] : '') . '"/>';

                                    //price field - Sale price
                                    $sale_price_value = $pgl_options->option('estate_searchable_field_rent_price');
                                    if (!empty($sale_price_value)) {
                                        $prices = explode(';', $sale_price_value);
                                        $html_price_from = $html_price_to = '';
                                        $price_from = isset($_GET['price_from']) ? $_GET['price_from'] : '';
                                        foreach ($prices as $price) {
                                            if ($price) {
                                                $html_price_from .= '<option value="' . ($price) . '" ' . ($price == $price_from ? 'selected' : '') . '>' . PGL_Addon_Estate::format_price($price) . '</option>';
                                            }
                                        }
                                        $sale_html_array[] =
                                            '<select name="price_from" id="price_from" class="form-control">
                                                <option value="" selected>' . __('Price from', PGL) . '</option>
                                                ' . $html_price_from . '
                                            </select>';
                                    }

                                    // Core fields display
                                    $searchable_core_fields = array_flip($instance['core_fields']);

                                    $sale_html_array = array_merge($sale_html_array, PGL_Addon_Estate::display_default_search_fields($searchable_core_fields, FALSE, 12, FALSE));

                                    $sale_html_array = apply_filters('estate/search_field/after_default_fields_listing', $sale_html_array, 'widget');

                                    if ($type_search_enable && !empty($term1_html)) {
                                        $sale_html_array[] =
                                            '<select name="type" id="term1" class="form-control">
                                                <option value="">' . __('Select type', PGL) . '</option>
                                                ' . $term1_html . '
                                            </select>';
                                    }

                                    if ($type_search_enable && !empty($term2_html)) {
                                        $sale_html_array[] =
                                            '<select name="location" id="term2" class="form-control">
                                                <option value="">' . __('Select location', PGL) . '</option>
                                                ' . $term2_html . '
                                            </select>';
                                    }

                                    $sale_html_array[] =
                                        '<button class="search" type="submit" id="searchsubmit">'.__('Search', PGL).'</button>';
                                    $len = count($sale_html_array);
                                    foreach ($sale_html_array as $key => $html_part) {
                                        if ($key == 0 || ($key == $len - 1) || ($key == $len - 2 && $key % 2 == 1)) {
                                            echo '<div class="clearfix"></div><div class="col-md-12 col-sm-12">' . $html_part . '</div>';
                                            continue;
                                        }
                                        echo '<div class="col-md-6 col-sm-12">' . $html_part . '</div>';
                                    }

                                    ?>
                                </form>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($sType == 'showcase'):?>
                            <div class="tab-pane active">
                                <div class="row">
                                    <form action="<?php echo get_home_url(); ?>">
                                    <input type="hidden" name="s" />
                                    <input type="hidden" name="search" value="1"/>
                                    <input type="hidden" name="post_type" value="estate"/>
                                    <?php
                                    $sale_html_array = array();

                                    //$sale_html_array[] = '<input type="text" class="keywordfind form-control" placeholder="'.__('Estate search keyword…',PGL).'" name="s" value="' . (isset($_GET['s']) ? $_GET['s'] : '') . '"/>';

                                    // Core fields display
                                    $searchable_core_fields = array_flip($instance['core_fields']);

                                    $sale_html_array = array_merge($sale_html_array, PGL_Addon_Estate::display_default_search_fields($searchable_core_fields, FALSE, 12, FALSE));

                                    $sale_html_array = apply_filters('estate/search_field/after_default_fields_listing', $sale_html_array, 'widget');

                                    if ($type_search_enable && !empty($term1_html)) {
                                        $sale_html_array[] =
                                            '<select name="type" id="term1" class="form-control">
                                                <option value="">' . __('Select type', PGL) . '</option>
                                                ' . $term1_html . '
                                            </select>';
                                    }

                                    if ($type_search_enable && !empty($term2_html)) {
                                        $sale_html_array[] =
                                            '<select name="location" id="term2" class="form-control">
                                                <option value="">' . __('Select location', PGL) . '</option>
                                                ' . $term2_html . '
                                            </select>';
                                    }

                                    $sale_html_array[] =
                                        '<button class="search" type="submit" id="searchsubmit">'.__('Search', PGL).'</button>';
                                    $len = count($sale_html_array);
                                    foreach ($sale_html_array as $key => $html_part) {
                                        if ($key == 0 || ($key == $len - 1) || ($key == $len - 2 && $key % 2 == 1)) {
                                            echo '<div class="clearfix"></div><div class="col-md-12 col-sm-12">' . $html_part . '</div>';
                                            continue;
                                        }
                                        echo '<div class="col-md-6 col-sm-12">' . $html_part . '</div>';
                                    }
                                    ?>
                                </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        echo $after_widget;
    }
}