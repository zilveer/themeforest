<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
<?php while( have_posts() ) : the_post();?>
    <?php
    list($imgurl, $width, $height) = wp_get_attachment_image_src( get_the_ID(), 'full');
    $alt = trim(strip_tags( get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true) ));
    if(empty($alt))
        $alt = trim(strip_tags( get_the_title() ))
    ?>
           <img src="<?php echo $imgurl ?>" alt="<?php echo $alt ?>" />
<?php endwhile;?>
        </div>
    </div>
</div>