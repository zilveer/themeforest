<?php

class BFIWidgetMapModel extends BFIWidgetModel implements iBFIWidget {
    
    // DO NOT USE __construct SINCE IT WILL CAUSE ERRORS
    function BFIWidgetMapModel() {
        $this->label = 'Map';
        $this->description = 'A Google Map';
        $this->args = array(
            'height' => '200',
            'lat' => '0.0',
            'lon' => '0.0',
            'zoom' => '8',
            'type' => 'roadmap',
            'drawmarker' => 'false',
            );
        parent::__construct();
    }
    
    public function render($args) {
        echo do_shortcode("[map class='map' height='{$args['height']}' lat='{$args['lat']}' lon='{$args['lon']}' zoom='{$args['zoom']}' type='{$args['type']}' drawmarker='{$args['drawmarker']}' controls='false' style='margin-bottom: 0'/]");
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
            <label for="<?php echo $this->get_field_id('zoom'); ?>"><?php _e('Zoom (1-20)', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" type="text" value="<?php echo $args['zoom']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Map type', BFI_I18NDOMAIN) ?>:</label>
            <select name="<?php echo $this->get_field_name('type')?>">
                <option value="roadmap" <?php echo $args['type'] == 'roadmap' ? 'selected' : ''?>><?php _e('Roadmap', BFI_I18NDOMAIN) ?></option>
                <option value="satellite" <?php echo $args['type'] == 'satellite' ? 'selected' : ''?>><?php _e('Satellite', BFI_I18NDOMAIN) ?></option>
                <option value="hybrid" <?php echo $args['type'] == 'hybrid' ? 'selected' : ''?>><?php _e('Hybrid', BFI_I18NDOMAIN) ?></option>
                <option value="terrain" <?php echo $args['type'] == 'terrain' ? 'selected' : ''?>><?php _e('Terrian', BFI_I18NDOMAIN) ?></option>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('drawmarker'); ?>"><?php _e('Draw marker in center?', BFI_I18NDOMAIN); ?>:
            <select name="<?php echo $this->get_field_name('drawmarker')?>">
                <option value="true" <?php echo $args['drawmarker'] == "true" ? "selected" : "" ?>>Yes</option>
                <option value="false" <?php echo $args['drawmarker'] == "false" ? "selected" : "" ?>>No</option>
            </select>
            </label>
        </p>
        <?php
    }
}
