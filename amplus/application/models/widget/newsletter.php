<?php

class BFIWidgetNewsletterModel extends BFIWidgetModel implements iBFIWidget {
    
    // DO NOT USE __construct SINCE IT WILL CAUSE ERRORS
    function BFIWidgetNewsletterModel() {
        $this->label = 'Newsletter Signup';
        $this->description = 'A MailChimp newsletter subscription signup form';
        $this->args = array(
            'before' => '',
            'after' => '',
            );
        $this->translatableArgs = array(
            'before' => 'Optional text before the signup form',
            'after' => 'Optional small text after the signup form',
            );
        parent::__construct();
    }
    
    public function render($args) {
        echo "<div class='newsletter'>";
        if ($args['before']) echo "<p>{$args['before']}</p>";
        echo do_shortcode("[newsletterform]");
        if ($args['after']) echo "<small class='mailchimp'>{$args['after']}</small>";
        echo "</div>";
    }
    
    public function displayForm($args) {
        ?>
        <p><em>Newsletters are handled by MailChimp. Head over to the theme settings under <?php echo BFI_THEMENAME ?> > MailChimp to set your newsletter up and for more information.</em></p>
        
        <p>
            <label for="<?php echo $this->get_field_id('before'); ?>"><?php _e('Optional text before the signup form', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('before'); ?>" name="<?php echo $this->get_field_name('before'); ?>" type="text" value="<?php echo $args['before']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('after'); ?>"><?php _e('Optional small text after the signup form', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('after'); ?>" name="<?php echo $this->get_field_name('after'); ?>" type="text" value="<?php echo $args['after']; ?>" />
            </label>
        </p>
        <?php
    }
}