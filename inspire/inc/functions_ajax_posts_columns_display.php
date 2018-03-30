<?php

			for ($i = 0; $i < count($results_query); $i++) { 

				$result_cmb_comp_feat_img = get_post_meta($results_query[$i]->ID, 'cmb_comp_feat_img', true);
				$result_cmb_comp_media = get_post_meta($results_query[$i]->ID, 'cmb_comp_media', true);
				$result_cmb_comp_title = get_post_meta($results_query[$i]->ID, 'cmb_comp_title', true);
				$result_cmb_comp_excerpt = get_post_meta($results_query[$i]->ID, 'cmb_comp_excerpt', true);
				$result_cmb_comp_meta = get_post_meta($results_query[$i]->ID, 'cmb_comp_meta', true);
				$result_cmb_comp_quote = get_post_meta($results_query[$i]->ID, 'cmb_comp_quote', true);
				$result_cmb_comp_feat_img_lightbox = get_post_meta($results_query[$i]->ID, 'cmb_comp_feat_img_lightbox', true);
				$result_cmb_comp_media_link = get_post_meta($results_query[$i]->ID, 'cmb_comp_media_link', true);
				$result_cmb_excerpt = get_post_meta($results_query[$i]->ID, 'cmb_excerpt', true);

				$result_cmb_exist = get_post_meta($results_query[$i]->ID, 'cmb_exist', true);

				//defaults
				if (empty($result_cmb_exist)) {
					$result_cmb_comp_feat_img = "checked";
					$result_cmb_comp_title = "checked";
					$result_cmb_comp_excerpt = "checked";
					$result_cmb_comp_meta = "checked";
				} 

			?> 
					<div class="item column<?php echo $columns; ?>" data-post_ID="<?php echo $results_query[$i]->ID; ?>" data-nonce="<?php echo wp_create_nonce('like_post'); ?>">

						<div class="item-thumb">
						<?php
							//FEATURED IMAGE
							if (has_post_thumbnail($results_query[$i]->ID) && $result_cmb_comp_feat_img == "checked") {
								if ($result_cmb_comp_feat_img_lightbox == "checked") {
									$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($results_query[$i]->ID),"full");
									echo get_the_post_thumbnail($results_query[$i]->ID, array($featured_img_width,9999));	
									printf('<a href="%s"><span class="zoom"></span></a>', esc_url($post_thumbnail_src[0]));	
								} else {
									printf("<a href='%s'>%s</a>",  esc_url(get_permalink($results_query[$i]->ID)),get_the_post_thumbnail($results_query[$i]->ID, array($featured_img_width,9999)));
								}
							}
						?>
							
						</div>

							<?php 
								//MEDIA
								if ($result_cmb_comp_media == "checked") {
								?>
									<div class="item-media">
										<?php echo $result_cmb_comp_media_link; ?>
									</div>
								<?php
								}
							?>

							<?php 
								//TITLE
								if ($result_cmb_comp_title == "checked") {
								?>
									<div class="item-title<?php if ($result_cmb_comp_title=='checked' && $result_cmb_comp_excerpt=='checked') echo " double" ?>">
										<h2 <?php if($result_cmb_comp_quote == "checked") echo "class='quote_header'"; ?>><a href="<?php echo get_permalink($results_query[$i]->ID); ?>"><?php echo $results_query[$i]->post_title; ?></a></h2>
									</div>
								<?php
								}
							?>
							<?php 
								//EXCERPT
								if ($result_cmb_comp_excerpt == "checked") {

									if ($result_cmb_comp_quote == "checked") {
									?>
										<div class="item-excerpt quote">
											<a href="<?php echo get_permalink($results_query[$i]->ID); ?>"><blockquote> <?php if (!empty($result_cmb_excerpt)) {echo do_shortcode($result_cmb_excerpt);} else {echo mb_make_excerpt($results_query[$i]->post_content, $default_excerpt_len, true);} ?> </blockquote></a>
										</div>
									<?php		
									} else {
									?>
										<div class="item-excerpt">
											<a href="<?php echo get_permalink($results_query[$i]->ID); ?>"><p><?php if (!empty($result_cmb_excerpt)) {echo do_shortcode($result_cmb_excerpt);} else {echo mb_make_excerpt($results_query[$i]->post_content, $default_excerpt_len, true);} ?></p></a>
										</div>
									<?php
									}
								}
							?>
							
						<?php 
							//META
							if ($result_cmb_comp_meta == "checked") {
								$likes = get_post_meta($results_query[$i]->ID, 'inspire_likes', true);
								if (empty($likes)) $likes = 0;
							?>
								<div class="meta">
									<span class="heart<?php if (mb_is_value_in_delim_string($like_string,$results_query[$i]->ID,",")) echo " liked"; ?>"><?php echo $likes; ?></span>
									<span class="date"><?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_query[$i]->post_date));?></span>
									<a href="<?php echo get_permalink($results_query[$i]->ID); ?>/#comments"><span class="comment"><?php echo $results_query[$i]->comment_count; ?></span></a>
								</div>
							<?php
							}
						?>

					</div>

			<?php
			}

