<?php
namespace IDX\Widgets;

class Impress_Carousel_Widget extends \WP_Widget
{
    /**
     * Register widget with WordPress.
     */
    public function __construct(\IDX\Idx_Api $idx_api)
    {

        $this->idx_api = $idx_api;

        parent::__construct(
            'impress_carousel', // Base ID
            'HOUZEZ: IMPress Property Carousel', // Name
            array(
                'description' => 'Displays a carousel of properties',
                'classname' => 'houzez-impress-carousel-widget',
            )
        );
    }

    public $idx_api;
    public $defaults = array(
        'title' => 'Properties',
        'properties' => 'featured',
        'saved_link_id' => '',
        'display' => 1,
        'max' => 10,
        'order' => 'high-low',
        'autoplay' => 1,
        'geoip' => '',
        'geoip-location' => '',
        //'styles' => 1,
        'new_window' => 0,
    );

    /**
     * Returns the markup for the listings
     *
     * @param array $instance Previously saved values from database.
     * @return string $output html markup for front end display
     */
    public function body($instance)
    {
        if (empty($instance)) {
            $instance = $this->defaults;
        }

        $prev_link = apply_filters('idx_listing_carousel_prev_link', $idx_listing_carousel_prev_link_text = "<i class='fa fa-angle-left'></i>" );
        $next_link = apply_filters('idx_listing_carousel_next_link', $idx_listing_carousel_next_link_text = "<i class='fa fa-angle-right'></i>" );


        if (($instance['properties']) == 'savedlinks') {
            $properties = $this->idx_api->saved_link_properties($instance['saved_link_id']);
        } else {
            $properties = $this->idx_api->client_properties($instance['properties']);
        }
        //If no properties or an error, load message
        if (empty($properties) || (isset($properties) && $properties === 'No results returned') || gettype($properties) === 'object') {
            return 'No properties found';
        }

        if ($instance['autoplay']) {
            $autoplay = 'autoplay: true,';
        } else {
            $autoplay = '';
        }

        $display = $instance['display'];

        if (!isset($instance['new_window'])) {
            $instance['new_window'] = 0;
        }

        if( is_rtl() ) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }

        $target = $this->target($instance['new_window']);

        if( $display <= 1 ) {
            echo '
            <script>
            jQuery(function( $ ){
                $(".houzez-impress-listing-carousel").owlCarousel({
                    rtl: ' . $rtl . ',
                    dots: true,
                    items: 1,
                    smartSpeed: 700,
                    slideBy: 1,
                    nav: true,
                    autoHeight : true,
                    navText : ["' . $prev_link . '", "' . $next_link . '"],
                    ' . $autoplay . '
                });
            });
            </script>';
        } else {
            echo '
            <script>
            jQuery(function( $ ){
                $(".houzez-impress-listing-carousel").owlCarousel({
                    rtl: ' . $rtl . ',
                    dots: true,
                    items: '.$display.',
                    smartSpeed: 700,

                    nav: true,
                    autoHeight : true,
                    navText : ["' . $prev_link . '", "' . $next_link . '"],
                    ' . $autoplay . '
                });
            });
            </script>';
        }

        //Force type of array.
        $properties = json_encode($properties);
        $properties = json_decode($properties, true);

        // sort low to high
        usort($properties, array($this, 'price_cmp'));

        if ('high-low' == $instance['order']) {
            $properties = array_reverse($properties);
        }

        $max = $instance['max'];

        $total = count($properties);
        $count = 0;

        $output = '';

        $output .= '<div class="widget-body">';
        $output .= '<div class="houzez-impress-listing-carousel slide-animated">';

        foreach ($properties as $prop) {
            if (!empty($max) && $count == $max) {
                return $output;
            }

            $prop_image_url = (isset($prop['image']['0']['url'])) ? $prop['image']['0']['url'] : '//mlsphotos.idxbroker.com/defaultNoPhoto/noPhotoFull.png';
            $count++;

            //Add Disclaimer when applicable.
            if(isset($prop['disclaimer']) && !empty($prop['disclaimer'])) {
                foreach($prop['disclaimer'] as $disclaimer) {
                    if(in_array('widget', $disclaimer)) {
                        $disclaimer_text = $disclaimer['text'];
                        $disclaimer_logo = $disclaimer['logoURL'];
                    }
                }
            }
            //Add Courtesy when applicable.
            if(isset($prop['courtesy']) && !empty($prop['courtesy'])) {
                foreach($prop['courtesy'] as $courtesy) {
                    if(in_array('widget', $courtesy)) {
                        $courtesy_text = $courtesy['text'];
                    }
                }
            }

            $prop = $this->set_missing_core_fields($prop);

            $listing_price = $prop['listingPrice'];
            $listing_permalink = $this->idx_api->details_url() . '/' . $prop['detailsURL'];
            $listing_alt = htmlspecialchars($prop['remarksConcat']);
            $listing_street = $prop['streetNumber'].' '.$prop['streetName'].' '.$prop['streetDirection'].' '.$prop['unitNumber'];
            $listing_city = $prop['cityName'];
            $listing_state = $prop['state'];

            $output .= '<div>
                <div class="figure-block">
                    <figure class="item-thumb">
                        <a href="'.$listing_permalink.'" target="'.$target.'" class="hover-effect">
                            <img class="" src="'.$prop_image_url.'" alt="'.$listing_alt.'" title="'.$listing_street.' '.$listing_city.' '.$listing_state.'" />
                        </a>
                        <figcaption class="thumb-caption">
                            <div class="cap-price">'.$listing_price.'</div>
                            <div class="impress-street">'.$listing_street.' '.$listing_city.' '.$listing_state.'</div>
                            <div class="impress-beds-baths-sqft">
                                '.$this->hide_empty_fields('beds', 'Beds', $prop['bedrooms']).'
                                '.$this->hide_empty_fields('baths', 'Baths', $prop['totalBaths']).'
                                '.$this->hide_empty_fields('sqft', 'SqFt', number_format($prop['sqFt'])).'
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>';


        }// End Foreach

        $output .= '</div>';
        $output .= '</div>';
        $output .= '';

        return $output;
    }

    //Hide fields that have no data to avoid fields such as 0 Baths from displaying
    public function hide_empty_fields($field, $display_name, $value)
    {
        if ($value <= 0) {
            return '';
        } else {
            return "<span class=\"impress-$field\">$value $display_name</span> ";
        }
    }

    public function target($new_window)
    {
        if (!empty($new_window)) {
            //if enabled, open links in new tab/window
            return '_blank';
        } else {
            return '_self';
        }
    }

    public function set_missing_core_fields($prop)
    {
        $name_values = array(
            'image',
            'remarksConcat',
            'detailsURL',
            'streetNumber',
            'streetName',
            'streetDirection',
            'unitNumber',
            'cityName',
            'state',
        );
        $number_values = array(
            'listingPrice',
            'bedrooms',
            'totalBaths',
            'sqFt',
        );
        foreach ($name_values as $field) {
            if (empty($prop[$field])) {
                $prop[$field] = '';
            }
        }
        foreach ($number_values as $field) {
            if (empty($prop[$field])) {
                $prop[$field] = 0;
            }
        }
        return $prop;

    }

    /**
     * Compares the price fields of two arrays
     *
     * @param array $a
     * @param array $b
     * @return int
     */
    public function price_cmp($a, $b)
    {

        $a = $this->clean_price($a['listingPrice']);
        $b = $this->clean_price($b['listingPrice']);

        if ($a == $b) {
            return 0;
        }

        return ($a < $b) ? -1 : 1;
    }

    /**
     * Removes the "$" and "," from the price field
     *
     * @param string $price
     * @return mixed $price the cleaned price
     */
    public function clean_price($price)
    {

        $patterns = array(
            '/\$/',
            '/,/',
        );

        $price = preg_replace($patterns, '', $price);

        return $price;
    }

    /**
     * Echos saved link names wrapped in option tags
     *
     * This is just a helper to keep the html clean
     *
     * @param var $instance
     */
    public static function saved_link_options($instance, $idx_api)
    {
        $saved_links = $idx_api->idx_api_get_savedlinks();

        if (!is_array($saved_links)) {
            return;
        }

        $output = '';

        foreach ($saved_links as $saved_link) {

            // display the link name if no link title has been assigned
            $link_text = empty($saved_link->linkTitle) ? $saved_link->linkName : $saved_link->linkTitle;

            $output .= '<option ' . selected($instance['saved_link_id'], $saved_link->id, 0) . ' value="' . $saved_link->id . '">' . $link_text . '</option>';

        }
        return $output;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        extract($args);

        if (empty($instance)) {
            $instance = $this->defaults;
        }
        $title = apply_filters('widget_title', $instance['title'] );

        echo $before_widget;

        if (!empty($instance['geoip']) && function_exists('turnkey_dashboard_setup')) {
            $geoip_before = '[geoip-content ' . $instance['geoip'] . '="' . $instance['geoip-location'] . '"]';
            $geoip_after = '[/geoip-content]';
            echo do_shortcode($geoip_before . $before_title . $title . $after_title . $this->body($instance) . $geoip_after);
        } else {
            if (!empty($title)) {
                echo $before_title . $title . $after_title;
            }

            echo $this->body($instance);
        }

        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['properties'] = strip_tags($new_instance['properties']);
        $instance['saved_link_id'] = (int) ($new_instance['saved_link_id']);
        $instance['display'] = (int) ($new_instance['display']);
        $instance['max'] = (int) ($new_instance['max']);
        $instance['order'] = strip_tags($new_instance['order']);
        $instance['autoplay'] = strip_tags($new_instance['autoplay']);
        //$instance['styles'] = strip_tags($new_instance['styles']);
        $instance['new_window'] = strip_tags($new_instance['new_window']);
        $instance['geoip'] = strip_tags($new_instance['geoip']);
        $instance['geoip-location'] = strip_tags($new_instance['geoip-location']);

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {

        $idx_api = $this->idx_api;

        $defaults = $this->defaults;

        $instance = wp_parse_args((array) $instance, $defaults);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php esc_attr_e($instance['title']);?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('properties');?>"><?php _e('Properties to Display:', 'houzez');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('properties');?>" name="<?php echo $this->get_field_name('properties')?>">
                <option <?php selected($instance['properties'], 'featured');?> value="featured"><?php _e('Featured', 'houzez');?></option>
                <option <?php selected($instance['properties'], 'soldpending');?> value="soldpending"><?php _e('Sold/Pending', 'houzez');?></option>
                <option <?php selected($instance['properties'], 'supplemental');?> value="supplemental"><?php _e('Supplemental', 'houzez');?></option>
                <option <?php selected($instance['properties'], 'historical');?> value="historical"><?php _e('Historical', 'houzez');?></option>
                <?php //Only allow Saved Links if Equity is active ?>
                <?php if (function_exists('equity')) {?>
                <option <?php selected($instance['properties'], 'savedlinks');?> value="savedlinks"><?php _e('Use Saved Link', 'houzez');?></option>
                <?php }?>
            </select>
        </p>

        <?php if (function_exists('equity')) {?>
         <p>
            <label for="<?php echo $this->get_field_id('saved_link_id');?>">Choose a saved link (if selected above):</label>
            <select class="widefat" id="<?php echo $this->get_field_id('saved_link_id');?>" name="<?php echo $this->get_field_name('saved_link_id')?>">
                <?=$this->saved_link_options($instance, $this->idx_api);?>
            </select>
        </p>
        <?php }?>

        <p>
            <label for="<?php echo $this->get_field_id('display');?>"><?php _e('Listings to show without scrolling:', 'houzez');?></label>
            <input class="widefat" type="number" id="<?php echo $this->get_field_id('display');?>" name="<?php echo $this->get_field_name('display')?>" value="<?php esc_attr_e($instance['display']);?>" size="3">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('max');?>"><?php _e('Max number of listings to show:');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('max');?>" name="<?php echo $this->get_field_name('max');?>" type="number" value="<?php esc_attr_e($instance['max']);?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('order');?>"><?php _e('Sort order:', 'houzez');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('order');?>" name="<?php echo $this->get_field_name('order')?>">
                <option <?php selected($instance['order'], 'high-low');?> value="high-low"><?php _e('Highest to Lowest Price', 'houzez');?></option>
                <option <?php selected($instance['order'], 'low-high');?> value="low-high"><?php _e('Lowest to Highest Price', 'houzez');?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('autoplay');?>"><?php _e('Autoplay?', 'houzez');?></label>
            <input type="checkbox" id="<?php echo $this->get_field_id('autoplay');?>" name="<?php echo $this->get_field_name('autoplay')?>" value="1" <?php checked($instance['autoplay'], true);?>>
        </p>

        <!--<p>
            <label for="<?php /*echo $this->get_field_id('styles');*/?>"><?php /*_e('Default Styling?', 'houzez');*/?></label>
            <input type="checkbox" id="<?php /*echo $this->get_field_id('styles');*/?>" name="<?php /*echo $this->get_field_name('styles')*/?>" value="1" <?php /*checked($instance['styles'], true);*/?>>
        </p>-->

        <p>
            <label for="<?php echo $this->get_field_id('new_window');?>"><?php _e('Open Listings in a New Window?', 'houzez');?></label>
            <input type="checkbox" id="<?php echo $this->get_field_id('new_window');?>" name="<?php echo $this->get_field_name('new_window')?>" value="1" <?php checked($instance['new_window'], true);?>>
        </p>

        <?php if (function_exists('turnkey_dashboard_setup')) {?>
        <p>
            <label for="<?php echo $this->get_field_id('geoip');?>"><?php _e('Only show content for (optional):', 'houzez');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('geoip');?>" name="<?php echo $this->get_field_name('geoip')?>">
                <option <?php selected($instance['geoip'], '');?> value=""><?php _e('All', 'houzez');?></option>
                <option <?php selected($instance['geoip'], 'region');?> value="region"><?php _e('State', 'houzez');?></option>
                <option <?php selected($instance['geoip'], 'city');?> value="city"><?php _e('City', 'houzez');?></option>
                <option <?php selected($instance['geoip'], 'postalcode');?> value="postalcode"><?php _e('Postal Code', 'houzez');?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('geoip-location');?>"><?php _e('Enter location to show for: <br /><em> Values can be comma separated.<br />For State, use 2 letter abbreviation.</em>');?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('geoip-location');?>" name="<?php echo $this->get_field_name('geoip-location');?>" type="text" value="<?php esc_attr_e($instance['geoip-location']);?>" />
        </p>

        <?php }
    }
}
