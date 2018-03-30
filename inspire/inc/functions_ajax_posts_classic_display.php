<?php

			for ($i = 0; $i < count($results_query); $i++) { 

				$likes = get_post_meta($results_query[$i]->ID, 'inspire_likes', true);
				if (empty($likes)) $likes = 0;

				$result_cmb_excerpt = get_post_meta($results_query[$i]->ID, 'cmb_excerpt', true);
				if (empty($result_cmb_excerpt)) $result_cmb_excerpt = mb_make_excerpt($results_query[$i]->post_content, $default_excerpt_len, true);

				$result_cmb_comp_media_link_blog = get_post_meta($results_query[$i]->ID, 'cmb_comp_media_link_blog', true);
				$result_cmb_comp_feat_img_lightbox = get_post_meta($results_query[$i]->ID, 'cmb_comp_feat_img_lightbox', true);

			?> 

			<div class="item archive" data-post_ID="<?php echo $results_query[$i]->ID; ?>" data-nonce="<?php echo wp_create_nonce('like_post'); ?>">
				
				<div class="item-thumb">
				<?php 
					if (!empty($result_cmb_comp_media_link_blog)) {
						echo "<div class='media_link_blog'>" . $result_cmb_comp_media_link_blog . "</div>";
					} else {
						if (has_post_thumbnail($results_query[$i]->ID)) { 

							if ($result_cmb_comp_feat_img_lightbox == "checked") {
								$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($results_query[$i]->ID),"full");
								echo get_the_post_thumbnail($results_query[$i]->ID, 'archive_classic_img');	
								printf('<a href="%s"><span class="zoom"></span></a>', esc_url($post_thumbnail_src[0]));	
							} else {
								printf("<a href='%s'>%s</a>",  esc_url(get_permalink($results_query[$i]->ID)),get_the_post_thumbnail($results_query[$i]->ID, 'archive_classic_img'));
							}

						} else {
							printf("<a href='%s'><img src='%s/images/archivepic.jpg'></a>", esc_url(get_permalink($results_query[$i]->ID)), esc_url(get_template_directory_uri()));
						}
					}

				?>
				</div>
				
				<div class="item-descrip">
				
					<div class="item-title">
					
						<h2><a href="<?php echo get_permalink($results_query[$i]->ID); ?>"><?php echo $results_query[$i]->post_title ?></a></h2>
					
					</div>

					<div class="item-meta">
						<span class="archive-meta"><?php _e('by', 'loc_inspire'); ?> <?php echo get_userdata($results_query[$i]->post_author)->display_name; ?> - <?php echo mb_localize_datetime(format_datetime_str(get_option('date_format'), $results_query[$i]->post_date));?></span>
						<span class="heart<?php if (mb_is_value_in_delim_string($like_string,$results_query[$i]->ID,",")) echo " liked"; ?>"><?php echo $likes; ?></span>
						<a href="<?php echo get_permalink($results_query[$i]->ID); ?>/#comments"><span class="comment"><?php echo $results_query[$i]->comment_count; ?></span></a>
					</div>
					
					<div class="item-excerpt">
						<p><?php echo do_shortcode($result_cmb_excerpt); ?></p>
					</div>

					<div class="item-footer">
						<a href="<?php echo get_permalink($results_query[$i]->ID); ?>" class="readmore"><?php _e('Read More', 'loc_inspire'); ?></a>
					</div>
				</div>
				
			</div>

			<?php
			}

