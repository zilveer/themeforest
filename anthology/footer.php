<div id="footer-container">
<div class="hr"></div>
<div id="footer-line"></div>
<div id="footer" class="center">
<div id="footer-columns">
<?php 
print_footer_sidebar('footer-first', false);
print_footer_sidebar('footer-second', false);
print_footer_sidebar('footer-third', false);
print_footer_sidebar('footer-fourth', true);
?>
</div>
</div>
</div>

<div id="copyrights">
<h5 class="center">&copy; Copyright <?php bloginfo('name'); ?> -
Designed by <a href="http://themeforest.net/user/pexeto">Pexeto</a></h5>
</div>
<!-- FOOTER ENDS -->
</div>
<?php 
global $pexeto_scripts;
$scripts=get_scripts($pexeto_scripts);
if($scripts && $scripts!=''){
	foreach ($scripts as $script){?>
		<script type="text/javascript" src="<?php echo $script; ?>"></script> 
<?php }
}?>
<?php wp_footer(); 
echo(get_opt('_analytics')); ?>
</body>
</html>
