<?php
//require('inc/cb-theme/cb-theme-options.php');
$cb_footer_options = cb_get_footer_options($post->ID);
if (($cb_footer_options['full_slider'] == 'yes' && ($cb_footer_options['home_slider'] == '' || $cb_footer_options['home_slider'] == 'none') && (is_front_page() || is_home() || $cb_footer_options['full_slider_where'] == 'yes')) || $cb_footer_options['home_slider'] == 'full') {
} else {
    ?>
    <a href="#" class="scrollup">Scroll up</a>
    <div class="cl"></div>


    <?php if ($cb_footer_options['show_above_footer'] == 'everywhere') {
        if (is_active_sidebar('above-footer')) {
            ?>
            <div class="above-footer">
            <div class="wrapme">
                <ul><?php dynamic_sidebar('above-footer'); ?></ul>
            </div>
            <!-- wrapper #end --></div><?php } ?>
    <?php
    }
    if ($cb_footer_options['show_above_footer'] == 'home') {
        if (is_front_page() || is_home()) {
            if (is_active_sidebar('above-footer')) {
                ?>
                <div class="above-footer">
                <div class="wrapme">
                    <ul><?php dynamic_sidebar('above-footer'); ?></ul>
                </div>
                <!-- wrapper #end --></div><?php } ?>
        <?php
        }
    }
}
?>

<section class="section-footer"  <?php if ($cb_footer_options['footer_background'] != '') {
        echo 'style="background:' . $cb_footer_options['footer_background'] . ';"';
    } ?>>
    <?php if ($cb_footer_options['footer_logo'] == 'yes'){
        if($cb_footer_options['footer_upload_logo'] !='')
            $footer_logo  =  $cb_footer_options['footer_upload_logo'];
        else
            $footer_logo  =  $cb_footer_options['upload_logo'];
        ?>
        <div class="footer-logo-holder">

            <a href="<?php echo esc_url(home_url()); ?>/"><img src="<?php echo $footer_logo;?>" alt="logo"/></a>
        </div>
    <?php } ?>
    
    
    
    
    
        <div class="container">
    <div class="wrapme">
            <?php $foot_op = cb_get_foot_options();
            $fcols = '1';
            if ($foot_op['fcols'] == '1') $fcols = '1'; else $fcols = $foot_op['fcols'];
            ?>
            <?php if ($fcols == '1' || $fcols == '2' || $fcols == '3' || $fcols == '4') { ?>
                <div class="footer-column col<?php echo $fcols;
                if ($fcols == '1') echo ' mr0'; ?> mb0">
                <ul><?php dynamic_sidebar('footer-1'); ?></ul></div><?php } ?>
            <?php if ($fcols == '2' || $fcols == '3' || $fcols == '4') { ?>
                <div class="footer-column col<?php echo $fcols;
                if ($fcols == '2') echo ' mr0'; ?> mb0">
                <ul><?php dynamic_sidebar('footer-2'); ?></ul></div><?php } ?>
            <?php if ($fcols == '3' || $fcols == '4') { ?>
                <div class="footer-column col<?php echo $fcols;
                if ($fcols == '3') echo ' mr0'; ?> mb0">
                <ul><?php dynamic_sidebar('footer-3'); ?></ul></div><?php } ?>
            <?php if ($fcols == '4') { ?>
                <div class="footer-column col<?php echo $fcols;
                echo ' mr0'; ?> mb0">
                <ul><?php dynamic_sidebar('footer-4'); ?></ul></div><?php } ?>

            <div class="cl"></div>
    </div>
    
    </div>
    
    
    <div class="footer-payment-icons">
         <?php if (is_active_sidebar('footer-bottom')) { ?>
           <ul><?php dynamic_sidebar('footer-bottom'); ?></ul>
           <?php }
           ?>
    </div>
    
</section>

</div><!-- bg #end -->

<?php $ana = get_option('cb5_google_analytics');
if ($ana != '') { ?>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php echo $ana; ?>']);
        _gaq.push(['_trackPageview']);
        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
<?php
}
wp_footer(); 
?>
</body>
</html>