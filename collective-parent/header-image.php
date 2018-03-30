<?php
global $header_image;

if ( !empty($header_image) ) { ?>
    <div class="header_img">
        <img src="<?php echo $header_image; ?>" width="960" alt="header image">
    </div>
<?php } ?>