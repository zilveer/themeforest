<?php
global $post;

$additional_details = get_post_meta( $post->ID, 'REAL_HOMES_additional_details', true );

if ( ! empty ( $additional_details ) ) {
    $additional_details = array_filter( $additional_details ); // remove empty values
}

if ( ! empty ( $additional_details ) ) {    // re-check

    $additional_details_title = get_option ( 'theme_additional_details_title' );
    if( ! empty ( $additional_details_title ) ){
        echo '<h4 class="additional-title">'.$additional_details_title.'</h4>';
    }

    echo '<ul class="additional-details clearfix">';
    foreach ( $additional_details as $title => $value ) {
        ?>
        <li>
            <strong><?php echo $title; ?>:</strong>
            <span><?php echo $value; ?></span>
        </li>
        <?php
    }
    echo '</ul>';

} else {
    // support for old approach
    $detail_titles = get_post_meta($post->ID,'REAL_HOMES_detail_titles',true);

    if( ! empty ( $detail_titles ) ) {

        $detail_values = get_post_meta($post->ID,'REAL_HOMES_detail_values',true);

        if( ! empty ( $detail_values ) ) {

            $details = array_combine ( $detail_titles, $detail_values );

            $additional_details_title = get_option ( 'theme_additional_details_title' );
            if( ! empty ( $additional_details_title ) ){
                echo '<h4 class="additional-title">'.$additional_details_title.'</h4>';
            }

            echo '<ul class="additional-details clearfix">';
            foreach ( $details as $title => $value ){
                ?>
                <li>
                    <strong><?php echo $title; ?>:</strong>
                    <span><?php echo $value; ?></span>
                </li>
                <?php
            }
            echo '</ul>';

        }

    }

}

?>