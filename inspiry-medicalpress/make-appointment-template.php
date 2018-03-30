<?php
/*
 *  Template Name: Appointment Template
 */

get_header();
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

<div class="appoint-page clearfix">
    <div class="container">

        <div class="row">
            <div class="<?php bc_all('10') ?> col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                <?php
                if (have_posts()):
                    while (have_posts()):
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(' clearfix'); ?>>
                            <div class="entry-content">
                                <?php
                                /* output page contents */
                                the_content();
                                ?>
                            </div>
                        </article>
                        <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>


        <div class="row">
            <div class="<?php bc_all('10') ?> col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                <div class="appoint-section clearfix">
                    <div class="top-icon"><img src="<?php echo get_template_directory_uri(); ?>/images/appoint-form-top.png" alt=""/></div>
                    <form id="appointment_form_main" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post">

                        <div class="row">
                            <div class="<?php bc('6','6','12',''); ?>">
                                <input type="text" name="name" id="app-name" class="required" placeholder="<?php _e('Name', 'framework'); ?>" title="<?php _e('* Please provide your name', 'framework'); ?>"/>
                            </div>
                            <div class="<?php bc('6','6','12',''); ?>">
                                <input type="text" name="number" id="app-number" placeholder="<?php _e('Phone Number', 'framework'); ?>" title="<?php _e('* Please provide your phone number.', 'framework'); ?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="<?php bc('6','6','12',''); ?>">
                                <input type="email" name="email" id="app-email" class="required email" placeholder="<?php _e('Email Address', 'framework'); ?>" title="<?php _e('* Please provide a valid email address', 'framework'); ?>"/>
                            </div>
                            <div class="<?php bc('6','6','12',''); ?>">
                                <input type="text" name="date" id="datepicker" placeholder="<?php _e('Appointment Date', 'framework'); ?>"/  title="<?php _e('* Please provide appointment date', 'framework'); ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class=" <?php bc_all('12'); ?>">
                                <textarea name="message" id="app-message" class="required" cols="50" rows="1" placeholder="<?php _e('Message', 'framework'); ?>" title="<?php _e('* Please provide your message', 'framework'); ?>"></textarea>
                                <input type="hidden" name="action" value="make_appointment">
                                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('request_appointment_nonce'); ?>" />
                            </div>
                        </div>

                        <?php
                        if( $theme_options['display_appointment_recaptcha'] ){
                            ?>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <input type="hidden" name="recaptcha" value="true" />
                                    <?php
                                    /* Display recaptcha if enabled and configured from theme options */
                                    get_template_part('recaptcha/custom-recaptcha');
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" name="Submit" class="btn" value="<?php _e('Submit Request', 'framework'); ?>"/>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/loader.gif" id="appointment-loader" alt="<?php _e('Loading...', 'framework'); ?>">
                            </div>

                            <div class="col-sm-12">
                                <div id="message-sent"></div>
                                <div id="error-container"></div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
