<?php

class BFIWidgetStreetviewModel extends BFIWidgetModel implements iBFIWidget {
    
    // DO NOT USE __construct SINCE IT WILL CAUSE ERRORS
    function BFIWidgetStreetviewModel() {
        $this->label = 'StreetView';
        $this->description = 'A Google StreetView panorama';
        $this->args = array(
            'height' => '200',
            'lat' => '0.0',
            'lon' => '0.0',
            'heading' => '0.0',
            'pitch' => '0.0',
            'zoom' => '1',
            );
        parent::__construct();
    }
    
    public function render($args) {
        echo do_shortcode("[streetview height='{$args['height']}' lat='{$args['lat']}' lon='{$args['lon']}' heading='{$args['heading']}' pitch='{$args['pitch']}' zoom='{$args['zoom']}' controls='false' style='margin-bottom: 0'/]");
    }
    
    public function displayForm($args) {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height (pixels)', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $args['height']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('lat'); ?>"><?php _e('Latitude', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('lat'); ?>" name="<?php echo $this->get_field_name('lat'); ?>" type="text" value="<?php echo $args['lat']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('lon'); ?>"><?php _e('Longitude', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('lon'); ?>" name="<?php echo $this->get_field_name('lon'); ?>" type="text" value="<?php echo $args['lon']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('heading'); ?>"><?php _e('Heading (0.0 - 360.0)', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('heading'); ?>" name="<?php echo $this->get_field_name('heading'); ?>" type="text" value="<?php echo $args['heading']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('pitch'); ?>"><?php _e('Pitch (90.0 - -90.0)', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('pitch'); ?>" name="<?php echo $this->get_field_name('pitch'); ?>" type="text" value="<?php echo $args['pitch']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom (1-20)', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" type="text" value="<?php echo $args['zoom']; ?>" />
            </label>
        </p>
        <?php
    }
}