<div class="listing-slider">
    <span class="format-icon gallery"></span>
    <ul class="slides">
        <?php
        if( is_page_template('template-home.php') ){
            list_gallery_images( 'gallery-two-column-image' );
        }else{
            list_gallery_images();
        }
        ?>
    </ul>
</div>