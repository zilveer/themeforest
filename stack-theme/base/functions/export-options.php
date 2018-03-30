<?php

header('Content-disposition: attachment; filename=backup_'.date("Y_m_d_H_i_s").'.txt');
header('Content-type: application/txt');

echo base64_encode( serialize( get_option( THEME_SLUG . '_options' ) ) );

?>