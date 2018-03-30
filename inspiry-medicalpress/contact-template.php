<?php
/*
 *  Template Name: Contact Template
 */

/* Include Header */
get_header();

/* Include Banner */
get_template_part('template-parts/banner');

?>
    <div class="page-top clearfix">
        <div class="container">
            <div class="row">
                <div class="<?php bc_all('12'); ?>">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <nav class="bread-crumb">
                        <?php theme_breadcrumb(); ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-page clearfix">
        <div class="container">
            <div class="row">
                <?php
                if (have_posts()):
                    while (have_posts()):
                        the_post();
                        $content = get_the_content();
                        if (!empty($content)) {
                            ?>
                            <div class="<?php bc_all('12'); ?>">
                                <div class="blog-page-single clearfix">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(' clearfix'); ?>>
                                        <div class="full-width-contents">
                                            <div class="entry-content">
                                                <?php
                                                /* output page contents */
                                                the_content();
                                                ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        <?php
                        }
                    endwhile;
                endif;

                global $theme_options;

                if ($theme_options['display_contact_form']) {
                    ?>
                    <div class="<?php bc('5', '5', '6', '') ?>">
                        <form id="contact_form" class="contact-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post">
                            <div class="row">

                                <div class="col-sm-12">
                                    <input type="text" name="name" id="name" class="required" placeholder="<?php _e('Full Name', 'framework'); ?>" title="<?php _e('* Please provide your name', 'framework'); ?>">
                                </div>

                                <div class="col-sm-12">
                                    <input type="text" name="email" id="email" class="required email" placeholder="<?php _e('Email Address', 'framework'); ?>" title="<?php _e('* Please provide a valid email address', 'framework'); ?>">
                                </div>

                                <div class="col-sm-12">
                                    <input type="text" name="number" id="number" placeholder="<?php _e('Phone Number', 'framework'); ?>">
                                </div>

                                <div class="col-sm-12">
                                    <input type="hidden" name="action" value="send_message"/>
                                    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('send_message_nonce'); ?>"/>
                                    <textarea name="message" id="message" class="required" cols="30" rows="5" placeholder="<?php _e('Message', 'framework'); ?>" title="<?php _e('* Please provide your message', 'framework'); ?>"></textarea>
                                </div>

                                <?php
                                if( $theme_options['display_contact_recaptcha'] ){
                                    ?>
                                    <div class="col-sm-12">
                                        <?php
                                        /* Display recaptcha if enabled and configured from theme options */
                                        get_template_part('recaptcha/custom-recaptcha');
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="<?php bc_all('12'); ?>">
                                    <input id="contact-form-submit" type="submit" value="<?php _e('SUBMIT', 'framework'); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" id="contact-loader" alt="Loading...">
                                    <div id="error-container"></div>
                                    <div id="response-container"></div>
                                </div>

                            </div>
                        </form>
                    </div>
                <?php
                }

                if ($theme_options['display_contact_details']) {
                    ?>
                    <div class="<?php bc('6', '6', '6', '');
                    if ($theme_options['display_contact_form']) {
                        echo ' col-lg-offset-1 col-md-offset-1';
                    } ?>">
                        <div class="contact-sidebar clearfix">
                            <article class="address-area clearfix">
                                <?php
                                if (!empty($theme_options['contact_details_title'])) {
                                    echo '<h2><span>' . $theme_options['contact_details_title'] . '</span></h2>';
                                }
                                ?>
                                <div class="row">
                                    <?php
                                    if (!empty($theme_options['contact_address'])) {
                                        ?>
                                        <div class="<?php bc('6', '6', '12', ''); ?>">
                                            <address><?php echo $theme_options['contact_address']; ?></address>
                                        </div>
                                    <?php
                                    }

                                    if ((!empty($theme_options['contact_phone'])) || (!empty($theme_options['contact_fax']))) {
                                        ?>
                                        <div class="<?php bc('6', '6', '12', ''); ?>">
                                            <?php
                                            if (!empty($theme_options['contact_phone'])) {
                                                ?><p>
                                                <strong><?php _e('Phone :', 'framework'); ?></strong><?php echo $theme_options['contact_phone']; ?>
                                                </p><?php
                                            }
                                            if (!empty($theme_options['contact_fax'])) {
                                                ?><p>
                                                <strong><?php _e('Fax :', 'framework'); ?></strong><?php echo $theme_options['contact_fax']; ?>
                                                </p><?php
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </article>
                            <?php
                            if ($theme_options['display_social_icons']) {
                                ?>
                                <article class="social-icon clearfix">
                                    <h5><span><?php _e('Social :', 'framework'); ?></span></h5>
                                    <ul class="clearfix">
                                        <?php
                                        if (!empty($theme_options['twitter_url'])) {
                                            echo '<li class="twitter-icon"><a target="_blank" href="' . $theme_options['twitter_url'] . '"><i class="fa fa-twitter"></i></a></li>';
                                        }

                                        if (!empty($theme_options['facebook_url'])) {
                                            echo '<li class="facebook-icon"><a target="_blank" href="' . $theme_options['facebook_url'] . '"><i class="fa fa-facebook"></i></a></li>';
                                        }

                                        if (!empty($theme_options['google_url'])) {
                                            echo '<li class="google-icon"><a target="_blank" href="' . $theme_options['google_url'] . '"><i class="fa fa-google-plus"></i></a></li>';
                                        }

                                        if (!empty($theme_options['linkedin_url'])) {
                                            echo '<li class="linkedin-icon"><a target="_blank" href="' . $theme_options['linkedin_url'] . '"><i class="fa fa-linkedin"></i></a></li>';
                                        }

                                        if (!empty($theme_options['instagram_url'])) {
                                            echo '<li class="instagram-icon"><a target="_blank" href="' . $theme_options['instagram_url'] . '"><i class="fa fa-instagram"></i></a></li>';
                                        }

                                        if (!empty($theme_options['youtube_url'])) {
                                            echo '<li class="youtube-icon"><a target="_blank" href="' . $theme_options['youtube_url'] . '"><i class="fa fa-youtube"></i></a></li>';
                                        }

                                        if (!empty($theme_options['skype_username'])) {
                                            echo '<li class="skype-icon"><a target="_blank" href="skype:' . $theme_options['skype_username'] . '?add"><i class="fa fa-skype"></i></a></li>';
                                        }

                                        if (!empty($theme_options['rss_url'])) {
                                            echo '<li class="rss-icon"><a target="_blank" href="' . $theme_options['rss_url'] . '"><i class="fa fa-rss"></i></a></li>';
                                        }
                                        ?>
                                    </ul>
                                </article>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <?php
        if ($theme_options['display_google_map']) {
            ?>
            <div class="container">
                <div class="row">
                    <div class="<?php bc_all('12'); ?>">
                        <div class="map-wrapper">
                            <?php
                            if (!empty($theme_options['google_map_title'])) {
                                ?><h5><?php echo $theme_options['google_map_title']; ?></h5><?php
                            }
                            ?>
                            <div id="map-canvas"></div>
                            <?php /* Contact map related JavaScript code reside in functions.php in function named generate_dynamic_javascript */ ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>

<?php
get_footer();
?>