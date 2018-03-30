<?php get_header( 'basic' ); ?>
		
			<div id="grve-content" class="grve-error-404 clearfix">
				<div class="grve-content-wrapper">
					<div id="grve-main-content">
						<div class="grve-main-content-wrapper clearfix">

							<div class="grve-section grve-fullheight grve-feature-header grve-feature-footer">
								<div class="grve-container">
									<div class="grve-row">
										<div class="grve-column-1">

											<div class="grve-align-center">

												<div id="grve-content-area">
												<?php
													$blade_grve_404_search_box = blade_grve_option('page_404_search');
													$blade_grve_404_home_button = blade_grve_option('page_404_home_button');
													echo do_shortcode( blade_grve_option( 'page_404_content' ) );
												?>
												</div>

												<br/>

												<?php if ( $blade_grve_404_search_box ) { ?>
												<div class="grve-widget">
													<?php get_search_form(); ?>
												</div>
												<br/>
												<?php } ?>

												<?php if ( $blade_grve_404_home_button ) { ?>
												<div class="grve-element">
													<a class="grve-btn grve-btn-medium grve-round grve-bg-primary-1 grve-bg-hover-black" target="_self" href="<?php echo esc_url( home_url( '/' ) ); ?>">
														<span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
													</a>
												</div>
												<?php } ?>

											</div>

										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

<?php get_footer( 'basic' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
