	<?php
	$cc_footer3_title   	= convert_smart_quotes(get_option('cc_footer3_title'));
	$cc_footer_address  	= convert_smart_quotes(get_option('cc_footer_address'));
	$cc_footer_phone  		= convert_smart_quotes(get_option('cc_footer_phone'));
	$cc_footer_cellphone  	= convert_smart_quotes(get_option('cc_footer_cellphone'));
	$cc_footer_fax  		= convert_smart_quotes(get_option('cc_footer_fax'));
	$cc_footer_email  		= convert_smart_quotes(get_option('cc_footer_email'));
	$cc_footer_contacttext  = convert_smart_quotes(get_option('cc_footer_contacttext'));
	$cc_footer_text  		= convert_smart_quotes(get_option('cc_footer_text'));
	$cc_ga_code  			= convert_smart_quotes(get_option('cc_ga_code'));
	
				
	?>
	<div id="wrapfooter">
		<div id="footer">
			<?php
			if ( ! dynamic_sidebar( 'footer-box-1' ) ) : ?>		
				<div class="boxfooter">
					<h4>Widget Area</h4>
					<p class="warningfooterwidget">Put your widget here</p>
				</div>
			<?php endif; ?>
			<?php
			if ( ! dynamic_sidebar( 'footer-box-2' ) ) : ?>		
				<div class="boxfooter">
					<h4>Widget Area</h4>
					<p class="warningfooterwidget">Put your widget here</p>
				</div>
			<?php endif; ?>
			<div class="boxfooter last">
				<h4><?php echo $cc_footer3_title ?></h4>
				<div id="boxcontact">
					<ul id="listcontact">
						<?php
						if ( get_option('cc_footer_address') <> '' ) : ?>
							<li id="iconoffice"><?php echo $cc_footer_address ?></li>
						<?php endif; ?>
						<?php
						if ( (get_option('cc_footer_phone') <> '') || (get_option('cc_footer_fax') <> '') || (get_option('cc_footer_cellphone') <> '') ) : ?>
						<li id="iconphone">
							<p>
								<?php
								if ( get_option('cc_footer_phone') <> '' ) : ?>
									<strong>Phone:</strong> <span><?php echo $cc_footer_phone?></span><br />
								<?php endif; ?>
								<?php
								if ( get_option('cc_footer_fax') <> '' ) : ?>
									<strong>Fax:</strong> <span><?php echo $cc_footer_fax?></span><br />
								<?php endif; ?>
								<?php
								if ( get_option('cc_footer_cellphone') <> '' ) : ?>
									<strong>Cellphone:</strong> <span><?php echo $cc_footer_cellphone?></span><br />
								<?php endif; ?>
							</p>
						</li>
						<?php endif; ?>
						<?php
						if ( get_option('cc_footer_email') <> '' ) : ?>
							<li id="iconemail"><?php echo $cc_footer_email?></li>
						<?php endif; ?>
					</ul>
					<?php
					if ( get_option('cc_footer_contacturl') <> '' ) : ?>
						<a href="<?php echo get_option('cc_footer_contacturl');?>" class="butmore"><?php echo $cc_footer_contacttext ?></a>
					<?php endif; ?>
				</div>
				<ul id="menusocial">
					<?php
					if ( get_option('cc_footer_facebook') <> '' ) : ?>
						<li><a href="<?php echo get_option('cc_footer_facebook');?>" class="replace" id="menufacebook"><span></span>Facebook</a></li>
					<?php endif; ?>
					<?php
					if ( get_option('cc_footer_linkedin') <> '' ) : ?>
						<li><a href="<?php echo get_option('cc_footer_linkedin');?>" class="replace" id="menulinkedin"><span></span>Linkedin</a></li>
					<?php endif; ?>
					<?php
					if ( get_option('cc_footer_twitter') <> '' ) : ?>
						<li><a href="<?php echo get_option('cc_footer_twitter');?>" class="replace" id="menutwitter"><span></span>Twitter</a></li>
					<?php endif; ?>
					<?php
					if ( get_option('cc_footer_flickr') <> '' ) : ?>
						<li><a href="<?php echo get_option('cc_footer_flickr');?>" class="replace" id="menuflickr"><span></span>Flickr</a></li>
					<?php endif; ?>
					<?php
					if ( get_option('cc_footer_plurk') <> '' ) : ?>
						<li><a href="<?php echo get_option('cc_footer_plurk');?>" class="replace" id="menuplurk"><span></span>Plurk</a></li>
					<?php endif; ?>
					<?php
					if ( get_option('cc_footer_delicious') <> '' ) : ?>
						<li><a href="<?php echo get_option('cc_footer_delicious');?>" class="replace" id="menudelicious"><span></span>Delicious</a></li>
					<?php endif; ?>
					<?php
					if ( get_option('cc_footer_digg') <> '' ) : ?>
						<li><a href="<?php echo get_option('cc_footer_digg');?>" class="replace" id="menudigg"><span></span>Digg</a></li>
					<?php endif; ?>
					<?php
					if ( get_option('cc_footer_youtube') <> '' ) : ?>
						<li><a href="<?php echo get_option('cc_footer_youtube');?>" class="replace" id="menuyoutube"><span></span>Youtube</a></li>
					<?php endif; ?>
				</ul>
				<div class="clear"></div>
				<a href="#" id="linktotop">Back to top</a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="footerbottom">
		<?php wp_nav_menu( array( 'theme_location' => 'footer-navigation', 'menu_id' => 'menufooter') ); ?>
		<h6><?php echo $cc_footer_text?></h6>	
	</div>
</div>
<?php
	wp_footer();
	echo $cc_ga_code;
?>
</body>
</html>