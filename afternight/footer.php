<?php
    $footer_background_color = '';
    
?>
        <!-- footer -->
        <footer id="colophon" role="contentinfo" data-role="footer" data-position="fixed" data-fullscreen="true">
            <?php
                $template = LBTemplate::figure_out_template();

                if (!isset($template)){
                    $temp_events = get_option('single_layout');
                    $template = LBTemplate::get_template_by_id( $temp_events['template']);
           // var_dump($template );
                }
                $template -> render_footer();
            ?>
        </footer>
        <!-- eof footer-->

    </div>
    
    
    <div class="overlay">&nbsp;</div>
    <?php //if(is_singular()){ ?>
        <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
        <script type="text/javascript">
            (function() {
                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
            })();
        </script>
    <?php //} ?>
    <script type="text/javascript">

        var cookies_prefix = "<?php echo ZIP_NAME; ?>";  
        var themeurl = "<?php echo get_template_directory_uri(); ?>";
        jQuery( function(){
            jQuery( '.demo-tooltip' ).tour();
        });

    </script>
    <?php
        /*collect views stats*/
        
        if(is_single()){  
            post::get_post_views($post -> ID);
        }
    ?>
    <?php 
        
        echo options::get_value('general' , 'tracking_code');
        wp_footer();
    ?>
    </body> 
</html>