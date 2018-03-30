<?php global $mango_settings, $post,$address, $contact_info,$contact_msg, $show_icons ;   ?>
<div class="row">
        <div class="col-sm-6">
			<?php if($mango_settings['mango_show_maps']==1){ ?>
        <div id="map" class="map3"></div><!-- End #map -->
			<?php } else{ ?>
		<div id=""></div><!-- End #map -->
			<?php } ?>
            <?php mango_add_social_share() ?>
        </div><!-- End .col-sm-6 -->
        <div class="xlg-margin visible-xs"></div><!-- space -->
        <div class="col-sm-6">
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
            <div class="xs-margin half"></div><!-- space -->
           <?php the_content(); ?>
        </div><!-- End .col-md-6 -->
    </div><!-- End .row -->
<div class="xlg-margin hidden-xs"></div><!-- space -->
<div class="md-margin visible-xs"></div><!-- space -->