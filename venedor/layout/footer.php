
<?php
global $venedor_settings, $venedor_design;
?>

<?php 
$cols = 0; 
for ($i = 1; $i <= 4; $i++) {
    if ( is_active_sidebar( 'content-bottom-'. $i ) ) 
        $cols++;
}
if (is_404()) $cols = 0;
if ($cols) : ?>
<div class="sidebar content-bottom-wrapper"><!-- content bottom wrapper -->
    <?php
    $md = 'col-md-'. (12 / $cols);
    $sm = ($cols >= 3) ? ' col-sm-4' : ' col-sm-'. (12 / $cols);
    ?>
    <div class="container">
        <div class="row">
        <?php
        $cols = 0;
        for ($i = 1; $i <= 4; $i++) {
            if ( is_active_sidebar( 'content-bottom-'. $i ) ) {
                $cols++;
                ?>
                <div class="<?php echo $md ?><?php if ($cols < 4) echo $sm; else echo ' col-last col-sm-12' ?>"><!-- content bottom widget <?php echo $i ?> -->
                    <?php dynamic_sidebar( 'content-bottom-'. $i ); ?>
                </div><!-- end content bottom widget <?php echo $i ?> -->
                <?php
            }
        }
        ?>
        </div>
    </div>
</div><!-- end content bottom wrapper -->
<?php endif; ?>

<div class="footer-wrapper"><!-- footer wrapper -->
    <?php if ( is_active_sidebar( 'footer-top' ) ) : ?>
    <div class="footer-top">
        <div class="container">
            <?php dynamic_sidebar( 'footer-top' ); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php 
    $cols = 0; 
    for ($i = 1; $i <= 4; $i++) {
        if ( is_active_sidebar( 'footer-column-'. $i ) ) 
            $cols++;
    }
    if ($cols) : 
        $md = 'col-md-'. (12 / $cols);
        $sm = ($cols >= 3) ? ' col-sm-4' : ' col-sm-'. (12 / $cols);
    ?>
    <div class="footer"><!-- footer widget area -->
        <div class="container">
            <div class="row">
            <?php
            $cols = 0;
            for ($i = 1; $i <= 4; $i++) {
                if ( is_active_sidebar( 'footer-column-'. $i ) ) {
                    $cols++;
                    ?>
                    <div class="<?php echo $md ?><?php if ($cols < 4) echo $sm; else echo ' col-last col-sm-12' ?>"><!-- footer widget <?php echo $i ?> -->
                        <?php dynamic_sidebar( 'footer-column-'. $i ); ?>
                    </div><!-- end footer widget <?php echo $i ?> -->
                    <?php
                }
            }
            ?>
            </div>
        </div>
    </div><!-- end footer widget area -->
    <?php endif; ?>
    
    <div class="footer-bottom"><!-- social links & copyright -->
        <div class="container">
            <div class="social-links left">

                <?php if ($venedor_settings['footer-social-facebook']) : ?>
                <a target="_blank" class="social-link facebook" href="<?php echo $venedor_settings['footer-social-facebook'] ?>" title="<?php _e('Facebook', 'venedor') ?>" data-toggle="tooltip"><span class="fa fa-facebook"></span></a>
                <?php endif; ?>

                <?php if ($venedor_settings['footer-social-twitter']) : ?>
                <a target="_blank" class="social-link twitter" href="<?php echo $venedor_settings['footer-social-twitter'] ?>" title="<?php _e('Twitter', 'venedor') ?>" data-toggle="tooltip"><span class="fa fa-twitter"></span></a>
                <?php endif; ?>

                <?php if ($venedor_settings['footer-social-rss']) : ?>
                <a target="_blank" class="social-link rss" href="<?php echo $venedor_settings['footer-social-rss'] ?>" title="<?php _e('RSS', 'venedor') ?>" data-toggle="tooltip"><span class="fa fa-rss"></span></a>
                <?php endif; ?>

                <?php if ($venedor_settings['footer-social-pinterest']) : ?>
                <a target="_blank" class="social-link pinterest" href="<?php echo $venedor_settings['footer-social-pinterest'] ?>" title="<?php _e('Pinterest', 'venedor') ?>" data-toggle="tooltip"><span class="fa fa-pinterest"></span></a>
                <?php endif; ?>

                <?php if ($venedor_settings['footer-social-youtube']) : ?>
                <a target="_blank" class="social-link youtube" href="<?php echo $venedor_settings['footer-social-youtube'] ?>" title="<?php _e('Youtube', 'venedor') ?>" data-toggle="tooltip"><span class="fa fa-youtube"></span></a>
                <?php endif; ?>

                <?php if ($venedor_settings['footer-social-instagram']) : ?>
                <a target="_blank" class="social-link instagram" href="<?php echo $venedor_settings['footer-social-instagram'] ?>" title="<?php _e('Instagram', 'venedor') ?>" data-toggle="tooltip"><span class="fa fa-instagram"></span></a>
                <?php endif; ?>

                <?php if ($venedor_settings['footer-social-skype']) : ?>
                <a target="_blank" class="social-link skype" href="<?php echo $venedor_settings['footer-social-skype'] ?>" title="<?php _e('Skype', 'venedor') ?>" data-toggle="tooltip"><span class="fa fa-skype"></span></a>
                <?php endif; ?>

                <?php if ($venedor_settings['footer-social-linkedin']) : ?>
                <a target="_blank" class="social-link linkedin" href="<?php echo $venedor_settings['footer-social-linkedin'] ?>" title="<?php _e('LinkedIn', 'venedor') ?>" data-toggle="tooltip"><span class="fa fa-linkedin"></span></a>
                <?php endif; ?>

                <?php if ($venedor_settings['footer-social-googleplus']) : ?>
                <a target="_blank" class="social-link googleplus" href="<?php echo $venedor_settings['footer-social-googleplus'] ?>" title="<?php _e('Google Plus', 'venedor') ?>" data-toggle="tooltip"><span class="fa fa-google-plus"></span></a>
                <?php endif; ?>
            </div>
            <div class="copyright right">
                <?php echo __($venedor_settings['footer-copyright']) ?>
            </div>
        </div>
    </div><!-- social links & copyright -->
</div><!-- end footer wrapper -->

<!-- The Gallery as lightbox dialog -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-start-slideshow="true" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<?php if (isset($venedor_settings['js-code'])) : ?>
<script type="text/javascript">
<?php echo $venedor_settings['js-code']; ?>
</script>
<?php endif; ?>
