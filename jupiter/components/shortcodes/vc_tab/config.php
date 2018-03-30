<?php
/**
 *  Shortcode defaults and user settings
 * ============================================================== */

extract(shortcode_atts($this->predefined_atts, $atts));

Mk_Static_Files::addAssets('vc_tab');