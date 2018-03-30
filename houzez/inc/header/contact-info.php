<?php if( houzez_option('hd2_contact_info') != '0' || houzez_option('hd2_address_info') != '0' || houzez_option('hd2_timing_info') != '0' ){ ?>

<?php
   $contact_icon = houzez_option('hd2_contact_icon');
   $contact_phone = houzez_option('hd2_contact_phone');
   $contact_email = houzez_option('hd2_contact_email');

   $address_icon = houzez_option('hd2_address_icon');
   $address_line1 = houzez_option('hd2_address_line1');
   $address_line2 = houzez_option('hd2_address_line2');

   $timing_icon = houzez_option('hd2_timing_icon');
   $timing_hours = houzez_option('hd2_timing_hours');
   $timing_days = houzez_option('hd2_timing_days');

    $allowed_html = array(
        'i' => array(
            'class' => array()
        )
    );
?>
<div class="header-contact">

    <?php if( houzez_option('hd2_timing_info') != '0' ){ ?>
        <div class="contact-block pull-right">
            <div class="media">
                <?php if( !empty($timing_icon) ){ ?>
                    <div class="media-left">
                        <?php echo wp_kses( $timing_icon, $allowed_html ); ?>
                    </div>
                <?php } ?>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo esc_attr( $timing_hours ); ?></h4>
                    <p><?php echo esc_attr( $timing_days ); ?></p>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if( houzez_option('hd2_address_info') != '0' ){ ?>
    <div class="contact-block pull-right">
        <div class="media">
            <?php if( !empty($address_icon) ){ ?>
                <div class="media-left">
                    <?php echo wp_kses( $address_icon, $allowed_html ); ?>
                </div>
            <?php } ?>
            <div class="media-body">
                <h4 class="media-heading"><?php echo esc_attr( $address_line1 ); ?></h4>
                <p><?php echo esc_attr( $address_line2 ); ?></p>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if( houzez_option('hd2_contact_info') != '0' ){ ?>
        <div class="contact-block pull-right">
            <div class="media">
                <?php if( !empty($contact_icon) ){ ?>
                    <div class="media-left">
                        <?php echo wp_kses( $contact_icon, $allowed_html ); ?>
                    </div>
                <?php } ?>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo esc_attr( $contact_phone ); ?></h4>
                    <p><?php echo esc_attr( $contact_email ); ?></p>
                </div>
            </div>
        </div>
    <?php } ?>

</div>

<?php } ?>