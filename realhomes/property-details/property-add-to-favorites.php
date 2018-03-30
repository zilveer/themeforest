<?php

$fav_button = get_option('theme_enable_fav_button');

// if enabled in theme options
if( $fav_button == "true" ) {
    ?>
    <!-- Add to favorite -->
    <span class="add-to-fav">
        <?php
        if( is_user_logged_in() ){
            $user_id = get_current_user_id();
            $property_id = get_the_ID();
            if ( is_added_to_favorite( $user_id, $property_id ) ) {
                ?>
                <div id="fav_output" class="show"><i class="fa fa-star-o dim"></i>&nbsp;<span id="fav_target" class="dim"><?php _e('Added to Favorites','framework'); ?></span></div>
                <?php
            } else {
                ?>
                <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="add-to-favorite-form">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                    <input type="hidden" name="property_id" value="<?php echo $property_id; ?>" />
                    <input type="hidden" name="action" value="add_to_favorite" />
                </form>
                <div id="fav_output"><i class="fa fa-star-o dim"></i>&nbsp;<span id="fav_target" class="dim"></span></div>
                <a id="add-to-favorite" href="#"><i class="fa fa-star-o"></i>&nbsp;<?php _e('Add to Favorites','framework'); ?></a>
            <?php
            }
        } else {
            ?><a href="#login-modal" data-toggle="modal"><i class="fa fa-star-o"></i>&nbsp;<?php _e('Add to Favorites','framework'); ?></a><?php
        }
        ?>
    </span>
    <?php
}
?>