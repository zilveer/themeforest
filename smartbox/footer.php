
            </div>
        </div>
        <footer id="footer" role="contentinfo" class="<?php echo oxy_get_option('skin'); ?>">
            <div class="wrapper wrapper-transparent">
                <div class="container-fluid">
                    <div class="row-fluid">
            <?php   $columns = oxy_get_option('footer_columns');
                    $span = 'span'.(12/$columns); ?>
                        <div class="<?php echo $span; ?> text-left"><?php dynamic_sidebar("footer-left"); ?></div>
                            <?php
                        if( $columns == 3){ ?>
                            <div class="<?php echo $span; ?>"><?php dynamic_sidebar("footer-middle"); ?></div><?php
                        }
                        else if ( $columns == 4){ ?>
                            <div class="<?php echo $span; ?>"><?php dynamic_sidebar("footer-middle-left"); ?></div>
                            <div class="<?php echo $span; ?>"><?php dynamic_sidebar("footer-middle-right"); ?></div><?php
                        }?>
                        <div class="<?php echo $span; ?> text-right"><?php dynamic_sidebar("footer-right"); ?></div>
                    </div>
                </div>
            </div>
        </footer>


        <script type="text/javascript">
            //<![CDATA[
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '<?php echo oxy_get_option( 'google_anal' ) ?>']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
            //]]>
        </script>
        <div id="fb-root"></div>
        <?php wp_footer(); ?>
    </body>
</html>