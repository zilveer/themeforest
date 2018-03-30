<?php

// action - CREATE new slider
if ( array_key_exists( 'action', $_GET ) && 'save_slides' == $_GET['action'] && array_key_exists( '_wpnonce', $_REQUEST ) ) {

    if ( wp_verify_nonce( $_REQUEST['_wpnonce'], 'custom' ) ) {
      //  echo '<pre>'; print_r($_POST); echo '</pre>';
        if (  ! empty( $_POST['slider_name'] ) ) {
            // add the new slide group
            //check if slider with that name exists
            $slides = array(
                'slides' => $_POST['slide'],
                'slidername' => $_POST['slider_name'],
                'slidertype' => 'custom',
                'arrowsNav' => $_POST['arrowsNav'],
                'fadeinLoadedSlide' => $_POST['fadeinLoadedSlide'],
                'keyboardNavEnabled' => $_POST['keyboardNavEnabled'],
                'imageScaleMode' => $_POST['imageScaleMode'],
                'slidesOrientation' => $_POST['slidesOrientation'],
                'transitionType' => $_POST['transitionType'],
                'transitionSpeed' => $_POST['transitionSpeed']
                );
            update_option( 'cp_slider_'.$_POST['slider_name'], $slides );
        }
    }
} ?>

<?php
$current_slider = get_option( 'cp_slider_'.$_GET['slider'], $default = false );
?>

<form  name="new-slider-form" id="new-slider-form" method="post" action="admin.php?page=cp-slider&slider=<?php echo mysql_real_escape_string($_GET['slider']); ?>&action=save_slides">
    <p><?php _e('This slider will displayed featured images from selected posts:','chow') ?></p>

    <div id="cpslides-cont">
        <ul>
            <?php if($current_slider){
                $slidescounter = 0;
                foreach ($current_slider['slides'] as $slide) { ?>
                <li data-counter='<?php echo esc_attr($slidescounter); ?>' class="toClone">
                    <div class="cpSlideThumb">
                        <img src="<?php echo CP_Slider::get_cpslide_thumb($slide['slider_image']);  ?>" alt="">
                       <a class="edit-slide" href="#">edit</a>
                       <a href="#">remove</a>
                   </div>
                   <div class="cpSlideOptions">
                    <p>
                        <input class="upload_image" type="text" size="36" data-name="slider_image" name="slide[<?php echo esc_attr($slidescounter); ?>][slider_image]" value="<?php echo esc_attr($slide['slider_image']); ?>" />
                    </p>
                    <p><input type="text" data-name="video" name="slide[<?php echo esc_attr($slidescounter); ?>][video]" class="video_url" placeholder="Video URL" value="<?php echo esc_attr($slide['video']); ?>"></p>
                    <p><textarea data-name="html_content" name="slide[<?php echo esc_attr($slidescounter); ?>][html_content]" class="html_content" cols="30" rows="10"><?php echo $slide['html_content']; ?></textarea></p>
                    <p>
                        <select data-name="captionstyle" name="slide[<?php echo esc_attr($slidescounter); ?>][captionstyle]" class="captionstyle">
                            <option value="style1" <?php selected( $slide['captionstyle'], 'style1') ?>>style1</option>
                            <option  value="style2" <?php selected( $slide['captionstyle'], 'style2') ?>>style2</option>
                        </select>
                    </p>
                </div>
            </li>
            <?php
            $slidescounter++;
        } //eof foreach ?>

        <?php } else { ?>
        <li data-counter='0' class="toClone">
            <div class="cpSlideThumb" style="">
                <a href="#">edit</a>
                <a href="#">remove</a>
            </div>
            <div class="cpSlideOptions">
                <p>
                    <input class="upload_image" type="text" size="36" data-name="slider_image" name="slide[0][slider_image]" value="http://" />
                </p>
                <p>
                    <input type="text" data-name="video" name="slide[0][video]" class="video_url" placeholder="Video URL">
                </p>
                <p>
                    <textarea data-name="html_content" name="slide[0][html_content]" class="html_content" cols="30" rows="10"></textarea>
                </p>
                <p>
                    <select data-name="captionstyle" name="slide[0][captionstyle]" class="captionstyle">
                        <option value="style1">style1</option>
                        <option  value="style2">style1</option>
                    </select>
                </p>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
<a href="#" id="add_slide" class="button">Create Slide</a>
<table class="form-table">
    <tr valign="top">
        <?php submit_button(); ?>
    </tr>
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
    <th scope="row">Can be 'vertical' or 'horizontal'.</th>
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
    <th></th>
    <td>
        <?php wp_nonce_field( 'custom' ); ?>
        <input type="hidden" name="slider_name" value="<?php echo esc_attr($_GET['slider']); ?>">
        <?php submit_button(); ?>
    </td>
</tr>

</table>
</form>
