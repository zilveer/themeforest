<?php $eet_option = eet_get_global_options(); ?>
<div class="clearfix"></div>
</div>
<div style="height:150px;"></div>
    <div id="mainmenuwrapper">
        <div id="mainmenu">
            
            <div id="mainmenumenu"><?php wp_nav_menu( array( 'theme_location' => 'header_menu', 'menu_class' => 'foot_menu_nav',  'depth' => 2) ); ?></div>
            <div id="mainmenusocial">
            <?php if ($eet_option['eetcnt_socttwitter'] != '' ){
            ?>
            <a href="https://twitter.com/#!/<?php echo $eet_option['eetcnt_socttwitter']; ?>" target="_BLANK"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="Twitter" class="socnetico"/> </a>
            <?php }; ?>
            
            <?php if ($eet_option['eetcnt_socfb'] != '' ){
            ?>
            <a href="<?php echo $eet_option['eetcnt_socfb']; ?>" target="_BLANK"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt="Facebook" class="socnetico"/> </a>
            <?php }; ?>
            
            <?php if ($eet_option['eetcnt_socrss'] == 'Yes' ){
            ?>
            <a href="<?php echo get_bloginfo('rss_url'); ?>" target="_BLANK"><img src="<?php echo get_template_directory_uri(); ?>/images/rss.png" alt="RSS Feed" class="socnetico"/> </a>
            <?php }; ?>    
            
            </div>
        </div>
    </div>
<div class="arrowchecker" style="display: none;"></div>
<div class="colbno" style="display: none;"><?php echo $eet_option['eetcnt_butcolor']; ?></div>
<div class="colbho" style="display: none;"><?php echo $eet_option['eetcnt_butcolorho']; ?></div>

<style type="text/css">
.readmore, .readmoreinner, #submitC, #contactsubmit {
    background-color: #<?php echo $eet_option['eetcnt_butcolor']; ?>;
}
</style>
<?php wp_footer(); ?>
</body>
</html>