<?php


class PexetoCustomizeHeadingControl extends WP_Customize_Control{
	public $type = 'heading';

	public function render_content() {
        ?>
        <h4 class="pexeto-control-heading"><?php echo esc_html( $this->label ); ?></h4>
        <?php
    }
}