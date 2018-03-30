							<div class="frame">
								<div class="title-wrap">
									<div class="title-meta"></div>
								</div>
								
								<div class="post-content">
									<?php if (!is_single() && of_get_option('of_excerptset')=="1") { ?>
										<?php the_excerpt(); ?>
									<?php } else { ?>
										<?php the_content( __('Read more...', 'cr') ); ?>
										
										<?php if(is_single()) { ?>
											<div class="pagelink">
												<?php wp_link_pages(); ?>
											</div>
										<?php } ?>
									<?php } ?>
								</div>
							</div><!-- frame -->