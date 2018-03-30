<?php global $mango_settings, $post,$address, $contact_info,$contact_msg, $show_icons ;   ?>
<div class="row">
	<?php if($mango_settings['mango_show_maps']==1){ ?>
    <div class="col-sm-8">
    <?php the_content(); ?>
    </div><!-- End .col-sm-8 -->
    <div class="xs-margin visible-xs"></div><!-- space -->
    <div class="col-sm-4">
        <?php echo wpautop($contact_msg); ?> 
        <?php if($show_icons){ ?>
        <?php mango_add_social_share(); } ?>
    </div><!-- End .col-sm-4 -->
<?php } else{ ?>
	    <div class="col-sm-8">
        <?php the_content(); ?>
    </div><!-- End .col-sm-8 -->
    <div class="xs-margin visible-xs"></div><!-- space -->
    <div class="col-sm-4">
        <?php //echo wpautop($contact_msg); ?> 
        <?php if($show_icons){
            mango_add_social_share();
        } ?>
    </div><!-- End .col-sm-4 -->
<?php } ?>
</div><!-- End .row -->
<div class="lg-margin visible-xs"></div><!-- space -->