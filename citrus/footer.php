    </div>
                	
	<?php 
	global $dt_allowed_html_tags;
	$dttheme_options = get_option(IAMD_THEME_SETTINGS); $dttheme_general = $dttheme_options['general'];
	?>
   	<?php if(!empty($dttheme_general['show-footer'])): ?>     
    <!--footer starts-->     
    <footer>
        <div class="copyright">
            <!--container starts-->
            <div class="container">
                <?php
                if( !empty($dttheme_general['show-copyrighttext']) ):
                    echo '<p>';
                    echo wp_kses(stripslashes($dttheme_general['copyright-text']), $dt_allowed_html_tags);
                    echo '</p>'; 
                endif;
                ?>
            </div>
            <!--container ends-->
        </div>
    </footer>
    <!--footer ends-->
    <?php endif;?>
        
</div><!-- **Wrapper - End** -->


<?php
if (is_singular() AND comments_open())
	wp_enqueue_script( 'comment-reply');


if(dttheme_option('integration', 'enable-body-code') != '') echo '<script type="text/javascript">'.wp_kses(stripslashes(dttheme_option('integration', 'body-code')), $dt_allowed_html_tags).'</script>';
wp_footer(); 
?>
</body>
</html>