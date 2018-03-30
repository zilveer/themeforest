<?php if(strpos($_SERVER['HTTP_USER_AGENT'],"iPhone")) : ?>
<div id="sc_up">
	<a href="#" class="scrollup">Scroll up</a>
</div>
<div class="cl"></div>
</div>
<div class="footer"
<?php $footer_background=get_option('cb_footer_background'); if($footer_background!=''){ echo 'style="background:'.$footer_background.';"';}?>>
	<div class="wrapper_p">
		<div class="foot_bg" <?php if($footer_background!=''){?>
			style="background: none;" <?php } ?>>

			<?php if(!is_active_sidebar('footer-1')&&!is_active_sidebar('footer-2')&&!is_active_sidebar('footer-3')){?>
			<h3>Configure this area in Appearance->Widgets</h3>
			<?php } ?>

			<div class="col3" style="margin-bottom: 0px;">
				<ul>
				<?php dynamic_sidebar('footer-1'); ?>
				</ul>
			</div>

			<div class="col3" style="margin-bottom: 0px;">
				<ul>
				<?php dynamic_sidebar('footer-2'); ?>
				</ul>
			</div>

			<div class="col3r" style="margin-right: 0px; margin-bottom: 0px;">
				<ul>
				<?php dynamic_sidebar('footer-3'); ?>
				</ul>
			</div>

		</div>
		<!-- foot_bg #end -->
	</div>
	<!-- wrapper #end -->
</div>
<!-- footer #end -->

</div>
<!-- bg #end -->
				<?php else : ?>
<a href="#" class="scrollup">Scroll up</a>
<div class="cl"></div>

<div class="bg_mid_alpha">
	<div class="wrapper_p">
		<a href="#" class="scroll_top"
			title="<?php _e('scroll to top','cb-cosmetico'); ?>"></a>
			<?php if(is_active_sidebar('middle-bar')){?>
		<ul>
		<?php dynamic_sidebar('middlebar');  ?>
		</ul>
		<?php }  ?>
	</div>
	<!-- wrapper #end -->
</div>

<div class="footer"
<?php $footer_background=get_option('cb_footer_background'); if($footer_background!=''){ echo 'style="background:'.$footer_background.';"';}?>>
	<div class="wrapper_p">

		<div class="foot_bg" <?php if($footer_background!=''){?>
			style="background: none;" <?php } ?>>

			<?php if(!is_active_sidebar('footer-1')&&!is_active_sidebar('footer-2')&&!is_active_sidebar('footer-3')){?>
			<h3>Configure this area in Appearance->Widgets</h3>
			<?php } ?>

			<div class="col3" style="margin-bottom: 0px;">
				<ul>
				<?php dynamic_sidebar('footer-1'); ?>
				</ul>
			</div>
			<div class="col3" style="margin-bottom: 0px;">
				<ul>
				<?php dynamic_sidebar('footer-2'); ?>
				</ul>
			</div>
			<div class="col3r" style="margin-right: 0px; margin-bottom: 0px;">
				<ul>
				<?php dynamic_sidebar('footer-3'); ?>
				</ul>

			</div>
			<div class="cl"></div>
		</div>
		<!-- foot_bg #end -->
	</div>
	<!-- wrapper #end -->
</div>
<!-- footer #end -->

				<?php $social_foot=get_option('cb_social_foot'); if(is_active_sidebar('footer-lower')||$social_foot=='yes'){ ?>
<div class="footer-lower">
	<div class="wrapper_p">
		<div class="f70">
			<div class="pb0">
			<?php if(is_active_sidebar('footer-lower')){?>
				<ul class="inline-block">
				<?php dynamic_sidebar('footer-lower');?>
				</ul>
				&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<?php } ?>
				<?php $show_footer=get_option('cb_show_footer'); if($show_footer=='yes') { ?>
				<?php _e('Proudly powered by <a href="http://wordpress.org" target="_blank">Wordpress</a>','cb-cosmetico'); ?>
				<?php } ?>
			</div>
		</div>
		<div class="f30">
			<div class="socials_f">
				<ul style="float: right">
				<?php $fb=get_option('cb_social_fb'); $tw=get_option('cb_social_tw'); $in=get_option('cb_social_in'); $yt=get_option('cb_social_yt'); $vi=get_option('cb_social_vi'); $rss=get_option('cb_social_rss');
				if($social_foot=='yes') {
					if($fb!='') echo '<li class="w16"><a class="fb" href="'.$fb.'" target="_blank"></a></li>'; if($tw!='') echo '<li class="w16"><a class="tw" href="'.$tw.'" target="_blank"></a></li>'; if($in!='') echo '<li class="w16"><a class="in" href="'.$in.'" target="_blank"></a></li>'; if($yt!='') echo '<li class="w16"><a class="yt" href="'.$yt.'" target="_blank"></a></li>'; if($vi!='') echo '<li class="w16"><a class="vi" href="'.$vi.'" target="_blank"></a></li>'; if($rss!='') echo '<li class="w16"><a class="rss" href="'.$rss.'" target="_blank"></a></li>';
				} ?>
				</ul>
				<div class="cl"></div>
			</div>
			<div class="cl"></div>
		</div>
	</div>
	<div class="cl"></div>
</div>
				<?php } ?>

</div>
<!-- bg #end -->

				<?php endif; ?>
				<?php if (get_option('cb_google_analytics')!='') {
					$ana = get_option('cb_google_analytics'); ?>
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
