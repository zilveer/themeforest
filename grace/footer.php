<?php $themeOptions = of_get_all_options(); ?>

<?php
$site_layout = tb_default($themeOptions['site_layout'], 'wide');

if ($site_layout == 'wide') {
?>

</div></div></div>
<!-- /CONTENT AREA - #wrap/ -->

<?php st_before_footer('wide');?>

<?php st_footer('wide');?>

<?php st_after_footer('wide');?>

<?php	
} else {
?>

</div><!--/#contentArea -->

<?php st_before_footer();?>

<?php st_footer();?>

<?php st_after_footer();?>


</div>
<!-- /CONTENT AREA - #wrap/ -->
<?php } ?>

<?php wp_footer();?>

</body>
</html>
