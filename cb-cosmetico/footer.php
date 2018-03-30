<?php
require(get_template_directory().'/inc/cb-general-options.php');
require(get_template_directory().'/inc/cb-page-options.php');
if( ($full_slider=='yes'&&($slider_home==''||$slider_home=='none')&&( is_front_page()||is_home()||$full_slider_where=='yes' ) )||$slider_home=='full'){}else { ?>
<a href="#" class="scrollup">Scroll up</a>
<div class="cl"></div>


<?php if($show_midb=='everywhere'){
	if(is_active_sidebar('middle-bar')){?>
<div class="bg_mid_alpha">
	<div class="wrapper_p">
		<ul><?php dynamic_sidebar('middlebar');  ?>
		</ul>
	</div>
	<!-- wrapper #end -->
</div>
		<?php }  ?>
		<?php }
		if($show_midb=='home'){
			if(is_front_page()||is_home()){
				if(is_active_sidebar('middle-bar')){?>
<div class="bg_mid_alpha">
	<div class="wrapper_p">
		<ul>
		
		
		<?php dynamic_sidebar('middlebar');  ?>
		</ul>
	</div>
	<!-- wrapper #end -->
</div>
		<?php }  ?>
		<?php }
		}
}
?>

<?php if(is_active_sidebar('footer-hidden')) { ?>

<div id="footer_hidden" style="margin-bottom: 0px;">
	<ul>
	<?php dynamic_sidebar('footer-hidden'); ?>
	</ul>
</div>

	<?php } ?>


<div class="footer"
<?php $footer_background=get_option('cb5_footer_background'); if($footer_background!=''){ echo 'style="background:'.$footer_background.';"';}?>>
	<div class="wrapper_p">

		<div class="foot_bg" <?php if($footer_background!=''){?>
			style="background: none;" <?php } ?>>
			<?php if(!is_active_sidebar('footer-1')&&!is_active_sidebar('footer-2')&&!is_active_sidebar('footer-3')&&!is_active_sidebar('footer-4')){?>
			<h3>
				<br />Configure this area in Appearance->Widgets
			</h3>
			<?php } ?>

			<div class="col4 mb">
				<ul>
				<?php dynamic_sidebar('footer-1'); ?>
				</ul>
			</div>
			<div class="col4 mb">
				<ul>
				<?php dynamic_sidebar('footer-2'); ?>
				</ul>
			</div>
			<div class="col4 mb">
				<ul>
				<?php dynamic_sidebar('footer-3'); ?>
				</ul>
			</div>
			<div class="col4 mb" style="margin-right: 0px;">
				<ul>
				<?php dynamic_sidebar('footer-4'); ?>
				</ul>
			</div>
			<div class="cl"></div>
		</div>
		<div class="cl"></div>
	</div>
	<!-- foot_bg #end -->
</div>
<!-- wrapper #end -->
</div>
<!-- footer #end -->

				<?php if(is_active_sidebar('footer-lower')){ ?>
<div class="footer-lower">
	<div class="wrapper_p">
		<div class="pb0">
			<ul>
			<?php dynamic_sidebar('footer-lower');?>
			</ul>
		</div>
	</div>
	<div class="cl"></div>
</div>
			<?php } ?>

<!-- bg #end -->

			<?php if (get_option('cb5_google_analytics')!='') {
				$ana = get_option('cb5_google_analytics'); ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $ana; ?>']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
				<?php }
				wp_footer(); ?>
</body>
</html>
