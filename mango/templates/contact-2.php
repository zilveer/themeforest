<?php global $mango_settings, $post,$address, $contact_info,$contact_msg, $show_icons ;   ?>
<div class="row">
    <div class="col-sm-4">
        <?php echo wpautop($contact_msg); ?>
        <?php if($address){ ?>
            <div class="address-box">
                <?php echo wpautop($address); ?>
            </div>
        <?php } ?> 
        <?php if($contact_info){ ?>
            <div class="address-box">
                <?php echo wpautop($contact_info); ?>
            </div>
        <?php } ?>
        <?php if($show_icons){ ?>
            <?php mango_add_social_share() ?>
        <?php } ?>

    </div><!-- End .col-sm-4 -->

    <div class="xlg-margin visible-xs"></div><!-- space -->

    <div class="col-sm-8">
       <?php the_content(); ?>
    </div><!-- End .col-sm-8 -->
</div><!-- End .row -->
<div class="md-margin"></div><!-- space -->