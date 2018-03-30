<?php                             
require_once 'delete_panel.php';

function yiw_delete_images() {
    global $wpdb;

    $count = array( 'success' => 0, 'error' => 0 );
    $uploads = wp_upload_dir();
    $uploads_dir = $uploads['basedir'];
    foreach ( scandir($uploads_dir) as $yfolder ) {
        if ( ! ( is_dir( "$uploads_dir/$yfolder" ) && ! in_array( $yfolder, array( '.', '..' ) ) ) ) continue;

        $yfolder = basename( $yfolder );
        foreach ( scandir("$uploads_dir/$yfolder") as $mfolder ) {
            if ( ! ( is_dir( "$uploads_dir/$yfolder/$mfolder" ) && ! in_array( $mfolder, array( '.', '..' ) ) ) ) continue;

            $mfolder = basename( $mfolder );
            $images = (array)glob("$uploads_dir/$yfolder/$mfolder/*-*x*.*");
            foreach ( $images as $image ) {
                $filename = basename( $image );
                if ( ! preg_match( '/([0-9]{1,4})x([0-9]{1,4}).(jpg|jpeg|png|gif)/', $filename ) ) continue;

                if ( unlink( $image ) ) {
                    $count['success']++;
                } else {
                    $count['error']++;
                }
            }
        }
    }

    if( $count['error'] == 0 ) {
        echo( sprintf( __( '%s images deleted!', 'yiw' ), $count['success'] ) );
    } else {
        echo( sprintf( __( 'Error. Unable to delete the images!', 'yiw' ) ) );
    }
}
    

?>