<?php
if ( file_exists( '../../../../../wp-load.php' ) ) {
    require_once( '../../../../../wp-load.php' );
} else {
    if ( file_exists( '../../../../../../wp-load.php' ) ) {
        require_once( '../../../../../../wp-load.php' );
    }
}

header("Content-type: text/css; charset=utf-8");

?>

@media only screen and (min-width: 480px) and (max-width: 768px){
	<?php do_action('suprema_qodef_style_dynamic_responsive_480_768'); ?>
}

@media only screen and (max-width: 480px){
	<?php do_action('suprema_qodef_style_dynamic_responsive_480'); ?>
}