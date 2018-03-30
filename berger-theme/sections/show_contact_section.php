<?php

$contact_email      = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-map-contact-email' );
$contact_address    = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-map-contact-address' );
$contact_phone      = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-map-contact-phone' );
$show_contact       = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-page-map-toggle-contact-info' ) ? '' : 'class="contact-hide"';
/**
 * Created by Clapat.
 * Date: 10/02/15
 * Time: 6:44 AM
 */
?>


                    <!-- Contact Info -->
                    <div id="contact-info" <?php echo $show_contact; ?>>


                        <div class="one_third text-align-center">

                            <div class="hidden-box">
                                <div class="header-box"><i class="fa fa-paper-plane fa-2x"></i></div>
                                <div class="content-box"><h6><?php echo $contact_email; ?></h6></div>
                                <div class="footer-box"><p class="monospace"><?php _e('EMAIL', THEME_LANGUAGE_DOMAIN); ?></p></div>
                            </div>

                        </div>

                        <div class="one_third text-align-center">

                            <div class="hidden-box">
                                <div class="header-box"><i class="fa fa-map-marker fa-2x"></i></div>
                                <div class="content-box"><h6><?php echo $contact_address; ?></h6></div>
                                <div class="footer-box"><p class="monospace"><?php _e('ADDRESS', THEME_LANGUAGE_DOMAIN); ?></p></div>
                            </div>

                        </div>

                        <div class="one_third last text-align-center">

                            <div class="hidden-box">
                                <div class="header-box"><i class="fa fa-phone fa-2x"></i></div>
                                <div class="content-box"><h6><?php echo $contact_phone; ?></h6></div>
                                <div class="footer-box"><p class="monospace"><?php _e('PHONE', THEME_LANGUAGE_DOMAIN); ?></p></div>
                            </div>

                        </div>

                    </div>
                    <!--/Contact Info -->