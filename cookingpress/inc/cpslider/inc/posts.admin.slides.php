<?php

// action - CREATE new slider
if ( array_key_exists( 'action', $_GET ) && 'save_slides' == $_GET['action'] && array_key_exists( '_wpnonce', $_REQUEST ) ) {

    if ( wp_verify_nonce( $_REQUEST['_wpnonce'], 'posts' ) ) {

        if (  ! empty( $_POST['slider_name'] ) ) {

            if(isset($_POST['cats']) && !empty($_POST['cats'])) { $cats = $_POST['cats'];} else { $cats = '';}
            if(isset($_POST['tags']) && !empty($_POST['tags'])) { $tags = $_POST['tags'];} else { $tags = '';}
            // add the new slide group
            //check if slider with that name exists
            $slidersettings = array(
                'slidername' => $_POST['slider_name'],
                'slidertype' => 'posts',
                'posts_type' => $_POST['posts_type'],
                'posts_order' => $_POST['posts_order'],
                'posts_number' => $_POST['posts_number'],
                'cats' =>  $cats,
                'tags' => $tags,
                'arrowsNav' => $_POST['arrowsNav'],
                'fadeinLoadedSlide' => $_POST['fadeinLoadedSlide'],
                'keyboardNavEnabled' => $_POST['keyboardNavEnabled'],
                'imageScaleMode' => $_POST['imageScaleMode'],
                'slidesOrientation' => $_POST['slidesOrientation'],
                'transitionType' => $_POST['transitionType'],
                'transitionSpeed' => $_POST['transitionSpeed'],
                'delay' => $_POST['delay']
                );
            update_option( 'cp_slider_'.$_POST['slider_name'], $slidersettings );
        }
    }
}

$current_slider = get_option( 'cp_slider_'.$_GET['slider']);
if($current_slider) {
    $selectedcats = $current_slider['cats'];
    $selectedtags = $current_slider['tags'];
} else {
    $selectedcats =  array();
    $selectedtags =  array();
}
?>

<form  name="new-slider-form" id="new-slider-form" method="post" action="admin.php?page=cp-slider&slider=<?php echo esc_attr($_GET['slider']); ?>&action=save_slides">
    <p>This slider will displayed featured images from selected posts:</p>
    <h2>Slider content settings</h2>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Posts:</th>
            <td>
                <select name="posts_type" id="posts_type">
                    <option <?php selected( $current_slider['posts_type'], 'latest' ); ?> value="latest">Latest</option>
                    <option <?php selected( $current_slider['posts_type'], 'random' ); ?> value="random">Random</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Number of posts</th>
            <td>
                <select name="posts_number" id="posts_number">
                    <?php for ($i=0; $i < 20; $i++) { ?>
                    <option <?php selected( $current_slider['posts_number'], $i ); ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>

                </select>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Order posts by</th>
            <td>
                <?php
                $orderby = array(
                    'none' => 'none' ,
                    'ID' => 'ID' ,
                    'author' => 'author' ,
                    'title' => 'title' ,
                    'name' => 'name' ,
                    'date' => 'date' ,
                    'modified' => 'modified' ,
                    'comment_count' => 'comment_count' ,
                    );
                    ?>
                    <select name="posts_order" id="posts_order">
                        <?php foreach ($orderby as $key => $value) { ?>
                        <option <?php selected( $current_slider['posts_order'], $key ); ?> value="<?php echo esc_attr($key); ?>"><?php echo $value; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Specify categories</th>
                <td>
                    <select id="cpsliderselect" multiple="multiple" name="cats[]" title="Click to select categories for slider">
                        <?php
                        $args = array(
                          'hide_empty' => '0',
                          );
                        $categories = get_categories($args);
                        if ($categories) {
                            foreach($categories as $category) {
                                if ($category->count > 0) { ?>
                                <option <?php if (is_array($selectedcats) && in_array( $category->term_id, $selectedcats)) { echo "selected "; } ?> value="<?php echo esc_attr($category->term_id); ?>"><?php echo $category->name; ?></option>
                                <?php }
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top" class="cpslider_tags_sel">
                <th scope="row">Specify tags</th>
                <td>
                    <select id="cpsliderselecttags" multiple="multiple" name="tags[]" title="Click to select categories for slider">
                        <?php

                        $categories = get_tags();
                        if ($categories) {
                            foreach($categories as $tag) {
                                if ($tag->count > 1) { ?>
                                <option <?php if (is_array($selectedtags) && in_array( $tag->term_id, $selectedtags)) { echo "selected "; } ?> value="<?php echo esc_attr($tag->term_id); ?>"><?php echo $tag->name; ?></option>
                                <?php }
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th></th>
                <td>
                    <?php submit_button(); ?>
                </td>
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
        <?php wp_nonce_field( 'posts' ); ?>
        <input type="hidden" name="slider_name" value="<?php echo $_GET['slider']; ?>">
    </table>
</form>