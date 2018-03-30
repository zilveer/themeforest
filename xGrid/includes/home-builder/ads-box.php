<?php if($GLOBALS['v']['ad_type'] == 'code') { ?>
    <div class="home-ads">
        <?php echo stripslashes($GLOBALS['v']['ad_code']); ?>
    </div>
<?php } else { ?>
    <div class="home-ads">
        <a href="<?php echo $GLOBALS['v']['ad_link']; ?>" title="<?php echo $GLOBALS['v']['ad_alt']; ?>" target="_blank"><img src="<?php echo $GLOBALS['v']['ad_img']; ?>" alt="<?php echo $GLOBALS['v']['ad_alt']; ?>" /></a>
    </div>
<?php } ?>