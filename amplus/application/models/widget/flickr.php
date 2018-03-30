<?php

class BFIWidgetFlickrModel extends BFIWidgetModel implements iBFIWidget {
    
    // DO NOT USE __construct SINCE IT WILL CAUSE ERRORS
    function BFIWidgetFlickrModel() {
        $this->label = 'Flickr (uses Flickr Photostream)';
        $this->description = 'A set of photos from a Flickr account';
        $this->args = array(
            'id' => '',
            'height' => '50',
            'num' => '7',
            );
        parent::__construct();
    }
    
    public function render($args) {
        $group = '';
        $args['id'] = $args['id'] ? $args['id'] : '';
        $args['height'] = $args['height'] ? (int)$args['height'] : '40';
        $args['num'] = $args['num'] ? (int)$args['num'] : '10';
        
        echo do_shortcode("[flickrps user_id='{$args['id']}' images_height='{$args['height']}' max_num_photos='{$args['num']}' no_pages='true' captions='false' justify_last_row='true']");
    }
    
    public function displayForm($args) {
        ?>
        <p>
            This widget uses the awesome <a href="http://wordpress.org/extend/plugins/flickr-photostream/"><strong>Flickr Photostream</strong> plugin by <strong>Miro Mannino</strong></a>. 
        </p>

        <?php if (!is_plugin_active('flickr-photostream/flickr-photostream.php')) { ?>
        <p>
            <strong style='color: red'><?php _e('Please activate the Flickr Photostream plugin first!', BFI_I18NDOMAIN) ?></strong>
        </p>
        <?php } ?>

        <?php if (!get_option('$flickr_photostream_APIKey')) { ?>
        <p>
            <strong style='color: red'><?php _e('Please input your Flickr API key in Flickr Photostream\'s settings first!', BFI_I18NDOMAIN) ?></strong>
        </p>
        <?php } ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('id') ?>"><?php _e( 'Flickr ID', BFI_I18NDOMAIN ); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('id') ?>" name="<?php echo $this->get_field_name('id') ?>" type="text" value="<?php echo $args['id'] ?>" />
            </label>
            <em>You can get your Flickr ID from: <a href="http://idgettr.com/">idgettr.com</a>
            </em>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('num') ?>"><?php _e('Number of photos to show', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('num') ?>" name="<?php echo $this->get_field_name('num') ?>" type="text" value="<?php echo $args['num']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('height') ?>"><?php _e('Height of each image', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('height') ?>" name="<?php echo $this->get_field_name('height') ?>" type="text" value="<?php echo $args['height'] ?>" />
            </label>
        </p>
        <?php
    }
}