<?php 
/**
 * Footer template - this file content is displayed on every page after the main content.
 * It contains a widgetized footer and a copyrights section at the bottom.
 */
?>

    <?php 
    $copyright_class='';
    if(get_opt('_widgetized_footer')!='off'){?>
     <div id="footer-container">
    <div id="footer-line"></div>
    <div id="footer" class="center">
      <div class="columns-wrapper">

<?php 
print_footer_sidebar('footer-first', false);
print_footer_sidebar('footer-second', false);
print_footer_sidebar('footer-third', false);
print_footer_sidebar('footer-fourth', true);
?>
</div>
</div>
</div>
<?php } else{
$copyright_class='class="top-border"';
}?>

<div id="copyrights" <?php echo $copyright_class; ?>>
<h5 class="center">&copy; Copyright <?php bloginfo('name'); ?> -
Theme by <a href="http://themeforest.net/user/pexeto">Pexeto</a></h5>
</div>
<!-- FOOTER ENDS -->
</div>

<?php wp_footer(); 
echo(get_opt('_analytics')); ?>
</body>
</html>
