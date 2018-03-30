<!-- Contact Page -->
<div class="page-container pattern-1" id="contact">

	<div class="row">
        
    	<div class="twelve columns contact">
            <div id="contact-slider">

                    <!-- Contact Details -->
                    <div class="contact-details" data-thumb="<?php echo get_template_directory_uri(); ?>/images/contact-details.png">
                        <div class="four columns first-column mobile-three-one contact-margin">
                            <h3 class="contact-title"><?php global $smof_data; $dreamer_contact_details_title_one = $smof_data['contact_details_title_one']; echo $dreamer_contact_details_title_one ?></h3>
                            <div class="contact-image hide-for-760">
                                <div class="contact-divider-top"></div>
                                <img src="<?php global $smof_data; $dreamer_contact_details_image_one = $smof_data['contact_details_image_one']; echo $dreamer_contact_details_image_one ?>" alt="San Francisco">
                                <div class="contact-divider-bottom"></div>
                            </div>
                            <p class="contact-text"><?php global $smof_data; $dreamer_contact_details_address_one = $smof_data['contact_details_address_one']; echo $dreamer_contact_details_address_one ?></p><p class="contact-text"><span>EMAIL:</span> <?php global $smof_data; $dreamer_contact_details_email_one = $smof_data['contact_details_email_one']; echo $dreamer_contact_details_email_one ?></p><p class="contact-text"><span>PHONE:</span> <?php global $smof_data; $dreamer_contact_details_phone_one = $smof_data['contact_details_phone_one']; echo $dreamer_contact_details_phone_one ?></p>
                        </div>
                        <div class="four columns middle-column mobile-three-one contact-margin">
                            <h3 class="contact-title"><?php global $smof_data; $dreamer_contact_details_title_two = $smof_data['contact_details_title_two']; echo $dreamer_contact_details_title_two ?></h3>
                            <div class="contact-image hide-for-760">
                                <div class="contact-divider-top"></div>
                                <img src="<?php global $smof_data; $dreamer_contact_details_image_two = $smof_data['contact_details_image_two']; echo $dreamer_contact_details_image_two ?>" alt="Los Angeles">
                                <div class="contact-divider-bottom"></div>
                            </div>
                            <p class="contact-text"><?php global $smof_data; $dreamer_contact_details_address_two = $smof_data['contact_details_address_two']; echo $dreamer_contact_details_address_two ?></p><p class="contact-text"><span>EMAIL:</span> <?php global $smof_data; $dreamer_contact_details_email_two = $smof_data['contact_details_email_two']; echo $dreamer_contact_details_email_two ?></p><p class="contact-text"><span>PHONE:</span> <?php global $smof_data; $dreamer_contact_details_phone_two = $smof_data['contact_details_phone_two']; echo $dreamer_contact_details_phone_two ?></p>
                        </div>
                        <div class="four columns last-column mobile-three-one contact-margin">
                            <h3 class="contact-title"><?php global $smof_data; $dreamer_contact_details_title_three = $smof_data['contact_details_title_three']; echo $dreamer_contact_details_title_three ?></h3>
                            <div class="contact-image hide-for-760">
                                <div class="contact-divider-top"></div>
                                <img src="<?php global $smof_data; $dreamer_contact_details_image_three = $smof_data['contact_details_image_three']; echo $dreamer_contact_details_image_three ?>" alt="London">
                                <div class="contact-divider-bottom"></div>
                            </div>
                            <p class="contact-text"><?php global $smof_data; $dreamer_contact_details_address_three = $smof_data['contact_details_address_three']; echo $dreamer_contact_details_address_three ?></p><p class="contact-text"><span>EMAIL:</span> <?php global $smof_data; $dreamer_contact_details_email_three = $smof_data['contact_details_email_three']; echo $dreamer_contact_details_email_three ?></p><p class="contact-text"><span>PHONE:</span> <?php global $smof_data; $dreamer_contact_phone_three = $smof_data['phone_three']; echo $dreamer_contact_phone_three ?></p>
                        </div>
                    </div>


                    <div class="contact-form" data-thumb="<?php echo get_template_directory_uri(); ?>/images/contact-form.png">
                        
                        <div class="done"><b style="color:#e44d26;">THANK YOU!</b><br> We have received your message.</div>
                        
                        <form method="post" action="contact-form.php">
                            <div class="twelve columns contact-form-div">
                                <div class="eight columns mobile-four-760">
                                    <div class="six columns first-column mobile-two-670">
                                        <div class="row collapse">
                                            <div class="two mobile-one columns">
                                                <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_one = $smof_data['form_icon_one']; echo $dreamer_contact_form_icon_one ?>" alt="Contact Name"></span>
                                            </div>
                                            <div class="ten mobile-three columns">
                                                <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_one = $smof_data['placeholder_one']; echo $dreamer_placeholder_one ?> *" name="name" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="six columns middle-column mobile-two-670">
                                        <div class="row collapse">
                                            <div class="two mobile-one columns">
                                                <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_two = $smof_data['form_icon_two']; echo $dreamer_contact_form_icon_two ?>" alt="Contact Email"></span>
                                            </div>
                                            <div class="ten mobile-three columns">
                                                <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_two = $smof_data['placeholder_two']; echo $dreamer_placeholder_two ?> *" name="email" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="six columns first-column mobile-two-670">
                                        <div class="row collapse">
                                            <div class="two mobile-one columns">
                                                <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_three = $smof_data['form_icon_three']; echo $dreamer_contact_form_icon_three ?>" alt="Phone Number"></span>
                                            </div>
                                            <div class="ten mobile-three columns">
                                                <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_three = $smof_data['placeholder_three']; echo $dreamer_placeholder_three ?>" name="phonenumber" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="six columns middle-column mobile-two-670">
                                        <div class="row collapse">
                                            <div class="two mobile-one columns">
                                                <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_four = $smof_data['form_icon_four']; echo $dreamer_contact_form_icon_four ?>" alt="Website"></span>
                                            </div>
                                            <div class="ten mobile-three columns">
                                                <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_four = $smof_data['placeholder_four']; echo $dreamer_placeholder_four ?>" name="website" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="six columns first-column mobile-two-670">
                                        <div class="row collapse">
                                            <div class="two mobile-one columns">
                                                <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_five = $smof_data['form_icon_five']; echo $dreamer_contact_form_icon_five ?>" alt="Project Budget"></span>
                                            </div>
                                            <div class="ten mobile-three columns">
                                                <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_five = $smof_data['placeholder_five']; echo $dreamer_placeholder_five ?>" name="projectbudget" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="six columns middle-column mobile-two-670">
                                        <div class="row collapse">
                                            <div class="two mobile-one columns">
                                                <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_six = $smof_data['form_icon_six']; echo $dreamer_contact_form_icon_six ?>" alt="Timeframe"></span>
                                            </div>
                                            <div class="ten mobile-three columns">
                                                <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_six = $smof_data['placeholder_six']; echo $dreamer_placeholder_six ?>" name="timeframe" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="six columns first-column mobile-two-670">
                                        <div class="row collapse">
                                            <div class="two mobile-one columns">
                                                <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_seven = $smof_data['form_icon_seven']; echo $dreamer_contact_form_icon_seven ?>" alt="You're interested in?"></span>
                                            </div>
                                            <div class="ten mobile-three columns">
                                                <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_seven = $smof_data['placeholder_seven']; echo $dreamer_placeholder_seven ?>" name="youreinterestedin" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="six columns middle-column mobile-two-670">
                                        <div class="row collapse">
                                            <div class="two mobile-one columns">
                                                <span class="prefix"><img src="<?php global $smof_data; $dreamer_contact_form_icon_eight = $smof_data['form_icon_eight']; echo $dreamer_contact_form_icon_eight ?>" alt="How did you hear about us?"></span>
                                            </div>
                                            <div class="ten mobile-three columns">
                                                <input type="text" placeholder="<?php global $smof_data; $dreamer_placeholder_eight = $smof_data['placeholder_eight']; echo $dreamer_placeholder_eight ?>" name="howdidyouhearaboutus" id="subject" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="four columns last-column mobile-four-760">
                                    <textarea placeholder="<?php global $smof_data; $dreamer_placeholder_nine = $smof_data['placeholder_nine']; echo $dreamer_placeholder_nine ?> *" name="comment"></textarea>
                                </div>
                                <div class="twelve columns submit-760">
                                    <input type="submit" class="button radius secondary submit-wide" value="Send Message" id="submit"/>
                                </div>
                            </div>
                        </form>
                    </div>
            
            </div>
        </div>

    </div>

</div>


<?php wp_reset_query(); ?>