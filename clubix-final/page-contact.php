<?php
/*
 * Template Name: Contact Page
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

wp_enqueue_script('googleMap', THEMEROOT . '/assets/js/google-map.js', array(), '1.0', true);

global $clx_data;

?>
<!-- ================================================== -->
<!-- =============== START HEADER ================ -->
<!-- ================================================== -->
<?php get_header(); ?>
<!-- ================================================== -->
<!-- =============== END HEADER ================ -->
<!-- ================================================== -->

<!-- ================================================== -->
<!-- =============== START BREADCRUMB ================ -->
<!-- ================================================== -->
<div class="container">
    <div class="row">
        <div class="breadcrumb-container clearfix">
            <!-- BREADCRUMB TITLE -->
            <h1>
                <?php the_title(); ?>
            </h1>
            <!-- BREADCRUMB -->
            <?= zen_breadcrumbs(); ?>
        </div>
    </div>
</div>
<!-- ================================================== -->
<!-- =============== END BREADCRUMB ================ -->
<!-- ================================================== -->
<!-- ================================================== -->
<!-- =============== START CONTENT-CONTAINER ================ -->
<!-- ================================================== -->
<div class="container">
<div class="row">
<div class="content-container">
<div class="content-container-inner clearfix">
<div class="col-sm-8">
    <div class="container-row">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact-container">

                        <?php if(isset($clx_data) && $clx_data['contact-address'] != '') {echo clx_get_google_maps($clx_data['contact-address']);} ?>

                        <?php if ( have_posts() ) : ?>

                            <?php while ( have_posts() ) : the_post(); ?>

                                <p><?=
                                /* Get the content template */
                                    get_the_content();
                                ?></p>

                            <?php endwhile; ?>

                        <?php else : ?>

                            <?php
                            /* Get the none-content template (error) */
                            get_template_part( 'content', 'none' );
                            ?>

                        <?php endif; ?>

                    <hr>
                    <ul class="list-inline">
                        <?php if(isset($clx_data)): ?>
                            <?php if($clx_data['contact-address'] != ''): ?>
                            <li>
                                <i class="fa fa-map-marker"></i>
                                <?= $clx_data['contact-address']; ?>
                            </li>
                            <?php endif; ?>
                            <?php if($clx_data['contact-email'] != ''): ?>
                            <li>
                                <i class="fa fa-envelope-o"></i>
                                <?= $clx_data['contact-email']; ?>
                            </li>
                            <?php endif; ?>
                            <?php if($clx_data['contact-tel'] != ''): ?>
                            <li>
                                <i class="fa fa-mobile-phone"></i>
                                <?= $clx_data['contact-tel']; ?>
                            </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="comment-respond">
                    <?php echo do_shortcode('[contact-form-7 id="5240" title="Contact form 1"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4">

    <?php get_sidebar('main-sidebar'); ?>

</div>
</div>
</div>
</div>
</div>
<!-- ================================================== -->
<!-- =============== END CONTENT-CONTAINER ================ -->
<!-- ================================================== -->
<!-- ================================================== -->
<!-- =============== START FOOTER ================ -->
<!-- ================================================== -->
<?php get_footer(); ?>
<!-- ================================================== -->
<!-- =============== END FOOTER ================ -->
<!-- ================================================== -->