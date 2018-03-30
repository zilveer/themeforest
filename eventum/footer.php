<!-- start footer -->
    <?php global $themeum_options; ?>
    <footer id="footer" class="footer-wrap">
        <div class="footer-wrap-inner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <a class="footer-logo" href="<?php echo site_url(); ?>">
                            <?php
                                if (isset($themeum_options['footer-logo'])){
                                    if($themeum_options['logo-text-en']) { ?>
                                        <h1><?php echo esc_html($themeum_options['logo-text']); ?></h1>
                                    <?php 
                                    }else{
                                        if(!empty($themeum_options['footer-logo'])) {
                                        ?>
                                            <img class="eventum-logo" src="<?php echo esc_url($themeum_options['footer-logo']['url']); ?>" alt="" title="">
                                        <?php
                                        }else{
                                            echo esc_html(get_bloginfo('name'));
                                        }
                                    }
                               }else{
                                    echo esc_html(get_bloginfo('name'));
                               }
                            ?>
                        </a>

                        <?php if(isset($themeum_options['copyright-text'])){ ?>   
                            <span class="copyright">
                                <?php echo balanceTags($themeum_options['copyright-text']); ?>
                            </span>
                        <?php } ?> 

                        <ul class="social-icons">
                            <?php if(isset($themeum_options['wp-facebook'])){ if( $themeum_options['wp-facebook'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-facebook'] ); ?>"><i class="fa fa-facebook"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-twitter'])){ if( $themeum_options['wp-twitter'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-twitter'] ); ?>"><i class="fa fa-twitter"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-google-plus'])){ if( $themeum_options['wp-google-plus'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-google-plus'] ); ?>"><i class="fa fa-google-plus"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-pinterest'])){ if( $themeum_options['wp-pinterest'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-pinterest'] ); ?>"><i class="fa fa-pinterest"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-youtube'])){ if( $themeum_options['wp-youtube'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-youtube'] ); ?>"><i class="fa fa-youtube"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-linkedin'])){ if( $themeum_options['wp-linkedin'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-linkedin'] ); ?>"><i class="fa fa-linkedin"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-dribbble'])){ if( $themeum_options['wp-dribbble'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-dribbble'] ); ?>"><i class="fa fa-dribbble"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-behance'])){ if( $themeum_options['wp-behance'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-behance'] ); ?>"><i class="fa fa-behance"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-flickr'])){ if( $themeum_options['wp-flickr'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-flickr'] ); ?>"><i class="fa fa-flickr"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-vk'])){ if( $themeum_options['wp-vk'] != '' ){ ?><li><a target="_blank" href="<?php echo esc_url( $themeum_options['wp-vk'] ); ?>"><i class="fa fa-vk"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-skype'])){ if( $themeum_options['wp-skype'] != '' ){ ?><li><a href="skype:<?php echo esc_url( $themeum_options['wp-skype'] ); ?>?chat"><i class="fa fa-skype"></i></a></li><?php } } ?>
                            <?php if(isset($themeum_options['wp-instagram'])){ if( $themeum_options['wp-instagram'] != '' ){ ?><li><a href="<?php echo esc_url( $themeum_options['wp-instagram'] ); ?>"><i class="fa fa-instagram"></i></a></li><?php } } ?>
                        </ul>

                    </div> <!-- end row -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end footer-wrap-inner -->
    </footer>
</div> <!-- #page -->

<?php if( isset($themeum_options['preloader_en']) && $themeum_options['preloader_en']==1 ) { ?>   
    <!-- =========================
       Preloader
    ============================== -->
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            "use strict";
            new QueryLoader2(document.querySelector("body"), {
                barColor: "#4bb463",
                backgroundColor: "#fff",
                percentage: true,
                barHeight: 2,
                minimumTime: 200,
                fadeOutTime: 1000
            });
        });
    </script>
<?php } ?> 

<?php wp_footer(); ?>
</body>
</html>