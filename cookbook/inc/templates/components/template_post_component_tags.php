<?php
								
	$cmb_post_show_tags = get_post_meta( $post->ID, 'cmb_post_show_tags', true);

	// DEFAULTS
	if (empty($cmb_post_show_tags)) { $cmb_post_show_tags = "checked"; }

							
?>	

			<?php
				
				// TAGS
				$tag_array = get_the_tags();
				if ($cmb_post_show_tags == "checked" && $tag_array) {

					echo '<ul class="post-tag-cloud">';

					foreach ($tag_array as $key => $value) {
						printf('<li><a href="%s">%s</a></li>'
							, esc_url(get_tag_link($value->term_id))
							, esc_attr($value->name)
						);
					}

					echo '</ul>';

				}
			
			?>