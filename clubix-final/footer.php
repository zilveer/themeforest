<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $clx_data;

$col_class = 'col-sm-3';
if(isset($clx_data)) { $col_class = 'col-sm-'.(12 / $clx_data['footer-columns']); }
?>

<!-- ================================================== -->
<!-- =============== START FOOTER ================ -->
<!-- ================================================== -->
<section class="footer">
    <section class="top">
        <div class="container">
            <div class="row">

                <?php if(isset($clx_data) && $clx_data['footer-desc']): ?>
                <div class="<?= $col_class; ?>">

                    <div class="widget">
                        <div class="textwidget">
                            <p>
                                <img src="<?= $clx_data['logo']['url']; ?>" alt="<?php bloginfo('name'); ?>">
                            </p>

                            <?= $clx_data['footer-desc-text']; ?>

                        </div>
                    </div>

                </div>
                <?php endif; ?>

                <?php get_sidebar('footer-sidebar'); ?>

            </div>
        </div>
    </section>
    <section class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <a data-easing="easeInOutQuint" data-scroll="" data-speed="600" data-url="false" href="body" class="back-to-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
                <div class="col-sm-10">
                    <div class="footer-info">
                        <!-- SOCIAL MEDIA LIST -->
                        <nav class="social-list clearfix">
                            <ul>
                                <?php if(isset($clx_data)){
                                    foreach($clx_data['social'] as $icon) {
                                        echo do_shortcode($icon);
                                    }
                                } ?>
                            </ul>
                        </nav>
                        <div class="info">
                            <?php if(isset($clx_data)) { echo $clx_data['copyright']; } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<!-- ================================================== -->
<!-- =============== END FOOTER ================ -->
<!-- ================================================== -->


<?php wp_footer(); ?>
</body>
</html>