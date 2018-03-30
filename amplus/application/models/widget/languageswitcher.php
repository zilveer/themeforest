<?php

class BFIWidgetLanguageSwitcherModel extends BFIWidgetModel implements iBFIWidget {

    // DO NOT USE __construct SINCE IT WILL CAUSE ERRORS
    function BFIWidgetLanguageSwitcherModel() {
        $this->label = 'Language Switcher';
        $this->description = 'A set of clickable flags used for switching between different translations';
        // $this->args = array(
        //     'text' => '',
        //     );
        parent::__construct();
    }

    public function render($args) {
        //if ($args['text']) echo "<div class='language-label'>{$args['text']}</div>";
        echo do_shortcode("[language_switcher]");
    }

    public function displayForm($args) {
        ?>
        <p>
            <em>This widget displays a set of flags which correspond to the available languages set in the admin panel <strong><?php echo BFI_THEMENAME ?> > Language</strong>. There is also a language switcher which is displayed right before your site's navigation which can be turned off in the <strong>Language</strong> admin panel.<br><br>You can also use the shortcode <strong>[language_switcher]</strong> as an alternative.</em>
        </p>
        <?php
        /*
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Some text before the language flags', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $args['text']; ?>" />
            </label>
        </p>
        */
    }
}