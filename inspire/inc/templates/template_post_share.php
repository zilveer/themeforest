					<?php 
						$inspire_options_post = get_option('inspire_options_post');

					?>

					<div class="post-share">
						
						<div id="share_control" class="closed">
							<img src="<?php echo get_template_directory_uri(); ?>/images/share-plus.png" alt="" />
						</div>
						<div id="share_window" data-browser_size="<?php echo $inspire_options_post['post_style'] ?>">
							<ul class="share_buttons">
								<li>
									<iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>
										&amp;send=false
										&amp;layout=button_count
										&amp;width=130
										&amp;show_faces=false
										&amp;font=tahoma
										&amp;colorscheme=light
										&amp;action=like
										&amp;height=21" 

										scrolling="no" 
										frameborder="0" 
										style="border:none; overflow:hidden; width:130px; height:21px;" 
										allowTransparency="true">
									</iframe>
								</li>
								<li>
									<a href="https://twitter.com/share" 
										class="twitter-share-button" 
										data-url="<?php the_permalink(); ?>" 
										data-text="Check out this article: <?php the_title(); ?> (<?php the_permalink(); ?>)" 
										data-dnt="true"
									>Tweet</a>

									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


								</li>
								<li>
									<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>
									&media=<?php $pin_img_src =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array($featured_img_width,9999)); echo $pin_img_src[0];  ?>
									&description=<?php echo urlencode(get_the_title()); ?>" 
									class="pin-it-button" 
									count-layout="horizontal">
										<img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" />
									</a>
									<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
								</li>

								<li>
									<div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php the_permalink(); ?>"></div>

									<script type="text/javascript">
									  (function() {
									    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
									    po.src = 'https://apis.google.com/js/plusone.js';
									    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
									  })();
									</script>
								</li>
							</ul>

						</div>
						
					</div>
					
