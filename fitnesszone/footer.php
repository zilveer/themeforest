		<?php global $dt_allowed_html_tags; ?>
        <!-- footer starts here -->
        <footer id="footer">
            <div class="footer-widgets-wrapper">
				<?php if(dt_theme_option('general','show-footer') != ''): ?>
                    <div class="container">
                        <?php dt_theme_show_footer_widgetarea(dt_theme_option('general','footer-columns')); ?>
                    </div>
                <?php endif; ?>
                <?php if(dt_theme_option('general','footer-bottom-bar') != "true"): ?>
                    <div class="social-media-container">
                        <div class="social-media">
                            <div class="container">
                                <div class="dt-sc-contact-info dt-phone">
                                    <p><i class="fa fa-phone"></i> <span><?php echo wp_kses(dt_theme_option('general', 'bottom-phoneno-content'), $dt_allowed_html_tags); ?></span> </p>
                                </div><?php
								if(dt_theme_option('general','show-sociables') != ''):
									#Listing social icons...
									$dt_theme_options = get_option(IAMD_THEME_SETTINGS);
									if(is_array($dt_theme_options['social'])): ?>
										<ul class="dt-sc-social-icons"><?php
											#Perform elements...
											foreach($dt_theme_options['social'] as $social):
												$link = esc_url($social['link']);
												$icon = esc_attr($social['icon']);
												echo "<li class='".substr($icon, 3)."'>";
												echo "<a class='fa {$icon}' href='{$link}'></a>";
												echo "</li>";
											endforeach; ?>
										</ul><?php
									endif;
								endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="copyright">
                <div class="container"><?php
					#Footer Menu...
					wp_nav_menu( array('theme_location' => 'secondary-menu', 'container'  => false, 'menu_class' => 'footer-links', 'fallback_cb' => 'dt_theme_footer_navigation')); ?>

                    <?php if(dt_theme_option('general','show-copyrighttext') != ''): ?>
	                    <p><?php echo wp_kses(stripslashes(dt_theme_option('general','copyright-text')), $dt_allowed_html_tags); ?></p>
					<?php endif; ?>
                </div>
            </div>
        </footer><!-- footer ends here -->

	</div><!-- **Inner Wrapper - End** -->
</div><!-- **Wrapper - End** -->
<?php if(dt_theme_option('integration', 'enable-body-code') != '') echo '<script type="text/javascript">'.wp_kses(stripslashes(dt_theme_option('integration', 'body-code')), $dt_allowed_html_tags).'</script>';
wp_footer(); ?>
</body>
</html>