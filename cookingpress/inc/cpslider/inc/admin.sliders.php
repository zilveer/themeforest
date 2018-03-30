<?php


// action - CREATE new slider
if ( array_key_exists( 'action', $_GET ) && 'new_slider' == $_GET['action'] && array_key_exists( '_wpnonce', $_REQUEST ) ) {
    if ( wp_verify_nonce( $_REQUEST['_wpnonce'], 'new_slider' ) ) {

        if (  ! empty( $_POST['slider_name'] ) ) {
            // add the new slide group
            //check if slider with that name exists
            $current_sliders = get_option( 'cp_sliders');
            $exist = false;
            if(!empty($current_sliders)){
                foreach( $current_sliders as $key => $sliders ) {
                    if ( $sliders->name ==  $_POST['slider_name'] ) {
                        $exist = true;
                        break;
                    }
                }
            }
            if($exist == false) {
                $new_slider = new CPSliders( $_POST['slider_name'], $_POST['slider_type'] );
                $new_slider->save();
                $messages[] = '<div id="message" class="updated"><p>' . __('New slider ', 'chow') . '<strong>' . $_POST['slider_name'] . '</strong>' . __(' has been successfully created', 'chow') . '</p></div>';
            } else {
                 $messages[] = '<div id="message" class="error fade"><p>' . __('There is already slider named', 'chow') . '<strong> ' . $_POST['slider_name'] . '</strong></p></div>';
            }
        }
    }
}


// action - REMOVE slider
if ( array_key_exists( 'action', $_GET ) && 'remove' == $_GET['action'] && array_key_exists( 'slider', $_GET )  ) {

    if ( wp_verify_nonce( $_REQUEST['_wpnonce'], 'remove_slider' ) ) {

        if (  ! empty( $_GET['slider'] ) ) {

            // add the new slide group
            $new_slider = new CPSliders( $_GET['slider'] );
            $new_slider->delete();
            $messages[] = '<div id="message" class="updated"><p>' . __('Slider ', 'chow') . '<strong>' . $_GET['slider'] . '</strong>' . __(' has been successfully removed', 'chow') . '</p></div>';
        } else {
            $messages[] = '<div id="message" class="error"><p>' . __('We have some kind of error, please try again ', 'chow') . '<strong></p></div>';
        }
    }
}


// action - EDIT slider
if ( array_key_exists( 'slider', $_GET ) ) {
    CP_Slider::print_slides_page();
    return;
}

//display admin notices & messages
if(!empty($messages)) foreach($messages as $message) { echo $message; }

?>

<div class="wrap">

    <div id="icon-options-general" class="icon32"><br /></div><h2><?php _e( 'Sliders', 'purethemes' );?></h2>

    <?php
    $sliderstable = new CPSliders_Sliders_Table();
    $sliderstable->prepare_items();
    $sliderstable->display(); ?>
<br/><hr>
    <form  name="new-slider-form" id="new-slider-form" method="post" action="admin.php?page=cp-slider&action=new_slider">
        <h3 id="new-slider-header"><?php _e( 'Add New Slider', 'purethemes' ); ?></h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Name</th>
                <td><input type="text" name="slider_name" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Type</th>
                <td>
                    <select name="slider_type" id="slider_type">
                        <option value="posts">Latest/Random posts Slider</option>
                        <option value="postssel">Selected Posts Slider</option>
                        <!-- <option value="custom">Custom Slider</option> for next update-->
                    </select>
                </td>
            </tr>
            <?php wp_nonce_field( 'new_slider' );?>
        </table>

        <?php submit_button('Add slider'); ?>

    </form>


</div>
