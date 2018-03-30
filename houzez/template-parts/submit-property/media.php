<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 18/01/16
 * Time: 5:44 PM
 */
?>
<div class="account-block">
    <div class="add-title-tab">
        <h3><?php esc_html_e( 'Property media', 'houzez' ); ?></h3>
        <div class="add-expand"></div>
    </div>
    <div class="add-tab-content">
        <div class="add-tab-row">
            <div class="property-media">
                <div class="media-gallery">
                    <div class="row">
                        <div id="property-thumbs-container">
                         </div>
                    </div>
                </div>
                <div id="drag-and-drop" class="media-drag-drop">
                    <h4><i class="fa fa-cloud-upload"></i><?php esc_html_e( 'Drag and drop images here', 'houzez' ); ?></h4>
                    <h4><?php esc_html_e( 'or', 'houzez' ); ?></h4>
                    <a id="select-images" href="javascript:;" class="btn btn-primary"><?php esc_html_e( 'Select Images', 'houzez' ); ?></a>
                </div>
                <div id="plupload-container"></div>
                <div id="errors-log"></div>
            </div>


            <!--<div id="property-thumbs-container"></div>
            <div id="drag-and-drop">
                <div class="drag-drop-msg"><i
                        class="fa fa-cloud-upload"></i>&nbsp;&nbsp;<?php /*esc_html_e('Drag and drop images here', 'houzez'); */?>
                </div>
                <div class="drag-or"><?php /*esc_html_e('or', 'houzez'); */?></div>
                <div class="drag-btn">
                    <a id="select-images" class="real-btn" href="javascript:;"><?php /*esc_html_e('Select Images', 'houzez'); */?></a>
                </div>
            </div>
            <div class="field-description">
                <?php /*esc_html_e('* An image should have minimum width of 770px and minimum height of 386px.', 'houzez'); */?>
                <br/>
                <?php /*esc_html_e('* You can mark an image as featured by clicking the star icon, Otherwise first image will be considered featured image.', 'houzez'); */?>
                <br/>
            </div>
            <div id="plupload-container"></div>
            <div id="errors-log"></div>-->

        </div>

    </div>
</div>
