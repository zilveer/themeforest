<?php global $smof_data;
$dreamer_contact_details_title_one = $smof_data['contact_details_title_one'];
$dreamer_contact_details_image_one = $smof_data['contact_details_image_one'];
$dreamer_contact_details_address_one = $smof_data['contact_details_address_one'];
$dreamer_contact_details_email_one = $smof_data['contact_details_email_one'];
$dreamer_contact_details_phone_one = $smof_data['contact_details_phone_one'];
$dreamer_contact_details_title_two = $smof_data['contact_details_title_two'];
$dreamer_contact_details_email_two = $smof_data['contact_details_email_two'];
$dreamer_contact_details_phone_two = $smof_data['contact_details_phone_two'];
$dreamer_contact_details_image_two = $smof_data['contact_details_image_two'];
$dreamer_contact_details_address_two = $smof_data['contact_details_address_two'];
$dreamer_contact_details_title_three = $smof_data['contact_details_title_three'];
$dreamer_contact_details_image_three = $smof_data['contact_details_image_three'];
$dreamer_contact_details_address_three = $smof_data['contact_details_address_three'];
$dreamer_contact_details_email_three = $smof_data['contact_details_email_three'];
$dreamer_contact_phone_three = $smof_data['phone_three'];
?>

	<!-- Contact Page -->
    <div class="page-container pattern-1" id="contact">
    <div class="row">
    <div class="twelve columns contact">
        <div id="contact-slider">

        	<!-- Contact Details -->
            <div class="contact-details" data-thumb="images/contact-details.png">
                <div class="four columns first-column mobile-three-one contact-margin">
                    <h3 class="contact-title"><?php echo $dreamer_contact_details_title_one; ?></h3>
                    <div class="contact-image hide-for-760">
                        <div class="contact-divider-top"></div>
                        <img src="<?php echo $dreamer_contact_details_image_one ?>" alt="Place Image">
                        <div class="contact-divider-bottom"></div>
                    </div>
                    <p class="contact-text">
                    <?php echo $dreamer_contact_details_address_one; ?>
                    </p>
                    <p class="contact-text"><span>EMAIL:</span>
                    <?php echo $dreamer_contact_details_email_one; ?>
                    </p>
                    <p class="contact-text"><span>PHONE:</span>
                    <?php echo $dreamer_contact_details_phone_one; ?>
                    </p>
                </div>
                <div class="four columns middle-column mobile-three-one contact-margin">
                    <h3 class="contact-title"><?php echo $dreamer_contact_details_title_two; ?></h3>
                    <div class="contact-image hide-for-760">
                        <div class="contact-divider-top"></div>
                        <img src="<?php echo $dreamer_contact_details_image_two; ?>" alt="Place Image">
                        <div class="contact-divider-bottom"></div>
                    </div>
                    <p class="contact-text">
                    <?php echo $dreamer_contact_details_address_two; ?></p>
                    <p class="contact-text"><span>EMAIL:</span>
                    <?php echo $dreamer_contact_details_email_two; ?>
                    </p>
                    <p class="contact-text"><span>PHONE:</span>
                    <?php echo $dreamer_contact_details_phone_two; ?>
                    </p>
                </div>
                <div class="four columns last-column mobile-three-one contact-margin">
                    <h3 class="contact-title"><?php echo $dreamer_contact_details_title_three; ?></h3>
                    <div class="contact-image hide-for-760">
                        <div class="contact-divider-top"></div>
                        <img src="<?php echo $dreamer_contact_details_image_three; ?>" alt="Place Image">
                        <div class="contact-divider-bottom"></div>
                    </div>
                    <p class="contact-text">
                    <?php echo $dreamer_contact_details_address_three; ?>
                    </p>
                    <p class="contact-text"><span>EMAIL:</span>
                    <?php echo $dreamer_contact_details_email_three; ?>
                    </p>
                    <p class="contact-text"><span>PHONE:</span>
                    <?php echo $dreamer_contact_phone_three; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php wp_reset_query(); ?>
