<?php 

	$canon_options_frame = get_option('canon_options_frame'); 

?>


						<ul class="inline-list language_menu">
							<?php 

								for ($i = 0; $i < count($canon_options_frame['language_menu']); $i++) {
									$active_string = ($canon_options_frame['language_menu'][$i][2] == get_locale()) ? 'class="active"' : '';
									printf('<li %s><a href="%s"><img src="%s/img/flags/%s.png"></a></li>', esc_attr($active_string), esc_url($canon_options_frame['language_menu'][$i][1]), esc_url(get_template_directory_uri()), esc_attr( $canon_options_frame['language_menu'][$i][0]) );
								}

							?>
						</ul>
