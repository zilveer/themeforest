<li class="top-bar-social">
    <?php if( houzez_option('hs-facebook') != '' ){ ?>
        <a target="_blank" class="btn-facebook" href="<?php echo esc_url(houzez_option('hs-facebook')); ?>"><i class="fa fa-facebook-square"></i></a>
    <?php } ?>

    <?php if( houzez_option('hs-twitter') != '' ){ ?>
        <a target="_blank" class="btn-twitter" href="<?php echo esc_url(houzez_option('hs-twitter')); ?>"><i class="fa fa-twitter-square"></i></a>
    <?php } ?>

    <?php if( houzez_option('hs-linkedin') != '' ){ ?>
        <a target="_blank" class="btn-linkedin" href="<?php echo esc_url(houzez_option('hs-linkedin')); ?>"><i class="fa fa-linkedin-square"></i></a>
    <?php } ?>

    <?php if( houzez_option('hs-googleplus') != '' ){ ?>
        <a target="_blank" class="btn-google-plus" href="<?php echo esc_url(houzez_option('hs-googleplus')); ?>"><i class="fa fa-google-plus-square"></i></a>
    <?php } ?>

    <?php if( houzez_option('hs-instagram') != '' ){ ?>
        <a target="_blank" class="btn-instagram" href="<?php echo esc_url(houzez_option('hs-instagram')); ?>"><i class="fa fa-instagram"></i></a>
    <?php } ?>
</li>