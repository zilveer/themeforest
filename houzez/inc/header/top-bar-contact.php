<?php
$top_bar_phone = houzez_option('top_bar_phone');
$top_bar_email = houzez_option('top_bar_email');

if( !empty( $top_bar_phone ) ) {
    echo '<li class="top-bar-phone"><a href="tel:'.$top_bar_phone.'"><i class="fa fa-phone"></i> <span>'.$top_bar_phone.'</span></a></li>';
}
if( !empty( $top_bar_email ) ) {
    echo '<li class="top-bar-contact"><a href="mailto:'.$top_bar_email.'"><i class="fa fa-envelope-o"></i>  <span>'.$top_bar_email.'</span></a></li>';
}
?>