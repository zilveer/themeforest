<?php
//require_once( dirname(__FILE__) .'/base-functions.php' );

define('WP_USE_THEMES', false);
require(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'/wp-blog-header.php');

header('Content-disposition: attachment; filename=backup_'.date("Y_m_d_H_i_s").'.txt');
header('Content-type: application/txt');
echo base64_encode( serialize( get_option( THEME_SLUG . '_options' ) ) );