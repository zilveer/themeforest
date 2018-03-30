<?php
class SupremaQodefPopupOpener extends SupremaQodefWidget {
    public function __construct() {
        parent::__construct(
            'qode_popup_opener', // Base ID
            'Select Pop-up Opener' // Name
        );

        $this->setParams();
    }

    protected function setParams() {

        $this->params = array(
            array(
                'name'			=> 'popup_opener_text',
                'type'			=> 'textfield',
                'title'			=> 'Pop-up Opener Text',
                'description'	=> 'Enter text for pop-up opener'
            ),
            array(
                'name'			=> 'popup_opener_color',
                'type'			=> 'textfield',
                'title'			=> 'Pop-up Opener Color',
                'description'	=> 'Define color for pop-up opener'
            )
        );

    }


    public function widget($args, $instance) {

        $popup_styles = array();
        $popup_text = '';

        if ( !empty($instance['popup_opener_color']) ) {
            $popup_styles[] = 'color: ' . $instance['popup_opener_color'];
        }
        if ( !empty($instance['popup_opener_text']) ) {
            $popup_text .= $instance['popup_opener_text'];
        }
        ?>
        <a class="qodef-popup-opener" <?php suprema_qodef_inline_style($popup_styles) ?> href="javascript:void(0)">
            <span class="qodef-popup-opener-icon icon_mail_alt"></span><span class="qodef-popup-opener-text"><?php echo esc_html($popup_text); ?></span>
        </a>

    <?php }

}