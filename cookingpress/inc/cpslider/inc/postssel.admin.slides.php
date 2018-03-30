<?php

// action - CREATE new slider
if ( array_key_exists( 'action', $_GET ) && 'save_slides' == $_GET['action'] && array_key_exists( '_wpnonce', $_REQUEST ) ) {

    if ( wp_verify_nonce( $_REQUEST['_wpnonce'], 'postssel' ) ) {

        if (  ! empty( $_POST['slider_name'] ) ) {
            // add the new slide group
            //check if slider with that name exists
            $slides = array(
                'posts' => $_POST['posts'],
                'slidername' => $_POST['slider_name'],
                'slidertype' => 'postssel',
                'arrowsNav' => $_POST['arrowsNav'],
                'fadeinLoadedSlide' => $_POST['fadeinLoadedSlide'],
                'keyboardNavEnabled' => $_POST['keyboardNavEnabled'],
                'imageScaleMode' => $_POST['imageScaleMode'],
                'slidesOrientation' => $_POST['slidesOrientation'],
                'transitionType' => $_POST['transitionType'],
                'transitionSpeed' => $_POST['transitionSpeed'],
                'delay' => $_POST['delay']
                );
            update_option( 'cp_slider_'.$_POST['slider_name'], $slides );
        }
    }
} ?>

<?php
    $current_slider = get_option( 'cp_slider_'.$_GET['slider'], $default = false );

    if($current_slider) {
        $selectedposts = $current_slider['posts'];
    } else {
        $selectedposts =  array();
    }
?>

<form  name="new-slider-form" id="new-slider-form" method="post" action="admin.php?page=cp-slider&slider=<?php echo $_GET['slider']; ?>&action=save_slides">
    <p>This slider will displayed featured images from selected posts:</p>
<table class="form-table">
    <tr valign="top">
        <select id="cpsliderselect" multiple="multiple" name="posts[]" title="Click to select posts">
            <?php
            $args = array(
                'numberposts' => -1,
                'post_type'  => 'post',
                'meta_key'    => '_thumbnail_id',
                'post__not_in' => $selectedposts
            );
            $posts = get_posts($args);
            foreach ($selectedposts as $key) {
                $selpost = get_post( $key)?>
                <option selected="selected" value="<?php echo $selpost->ID; ?>"><?php echo $selpost->post_title; ?></option>
            <?php }
            foreach( $posts as $post ) : setup_postdata($post); ?>
                <option <?php if (in_array( $post->ID, $selectedposts)) { echo "selected "; } ?> value="<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></option>
        <?php endforeach; ?>
        </select>
    </tr>
    <tr valign="top">
        <?php submit_button(); ?>
    </tr>

<?php wp_nonce_field( 'postssel' ); ?>
<input type="hidden" name="slider_name" value="<?php echo $_GET['slider']; ?>">

    </table>


        <h2>Slider visual settings</h2>
        <table class="form-table">
         <tr valign="top">
            <th scope="row">Arrows navigation</th>
            <td>
                <select name="arrowsNav" id="arrowsNav">
                    <option <?php selected( $current_slider['arrowsNav'], 'true' ); ?> value="true">True</option>
                    <option <?php selected( $current_slider['arrowsNav'], 'false' ); ?> value="false">False</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Fades in slide after it's loaded</th>
            <td>
                <select name="fadeinLoadedSlide" id="fadeinLoadedSlide">
                    <option <?php selected( $current_slider['fadeinLoadedSlide'], 'true' ); ?> value="true">True</option>
                    <option <?php selected( $current_slider['fadeinLoadedSlide'], 'false' ); ?> value="false">False</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Navigate slider with keyboard left and right arrows.</th>
            <td>
                <select name="keyboardNavEnabled" id="keyboardNavEnabled">
                    <option <?php selected( $current_slider['keyboardNavEnabled'], 'true' ); ?> value="true">True</option>
                    <option <?php selected( $current_slider['keyboardNavEnabled'], 'false' ); ?> value="false">False</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Scale mode for images. "fill", "fit", "fit-if-smaller" or "none".</th>
            <td>
                <select name="imageScaleMode" id="imageScaleMode">
                    <option <?php selected( $current_slider['imageScaleMode'], 'fill' ); ?> value="fill">fill</option>
                    <option <?php selected( $current_slider['imageScaleMode'], 'fit-if-smaller' ); ?> value="fit-if-smaller">fit-if-smaller</option>
                    <option <?php selected( $current_slider['imageScaleMode'], 'fit' ); ?> value="fit">fit</option>
                    <option <?php selected( $current_slider['imageScaleMode'], 'none' ); ?> value="none">none</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Slides scrolling 'vertical' or 'horizontal'.</th>
            <td>
                <select name="slidesOrientation" id="slidesOrientation">
                    <option <?php selected( $current_slider['slidesOrientation'], 'horizontal' ); ?> value="horizontal">horizontal</option>
                    <option <?php selected( $current_slider['slidesOrientation'], 'vertical' ); ?> value="vertical">vertical</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">How slides change.</th>
            <td>
                <select name="transitionType" id="transitionType">
                    <option <?php selected( $current_slider['transitionType'], 'move' ); ?> value="move">move</option>
                    <option <?php selected( $current_slider['transitionType'], 'fade' ); ?> value="fade">fade</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Slider transition speed, in ms.</th>
            <td>
                <input type="text" name="transitionSpeed" value="<?php if( !empty($current_slider['transitionSpeed'])) {
                    echo $current_slider['transitionSpeed'];
                } else {
                    echo '600';
                } ?>">
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Slider autoplay delay between slides, in ms.</th>
            <td>
                <input type="text" name="delay" value="<?php if( !empty($current_slider['delay'])) {
                    echo $current_slider['delay'];
                } else {
                    echo '3000';
                } ?>">
            </td>
        </tr>
        <tr valign="top">
            <th></th>
            <td>
                <?php submit_button(); ?>
            </td>
        </tr>

    </table>
</form>
