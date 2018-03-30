<!-- 960 Container -->
<div class="container">

	<!-- Royalslider -->
	<div class="sixteen columns">
		<section class="slider">
			<div id="home-slider" class="royalSlider rsDefault">
				
					<?php
					if ( function_exists( 'ot_get_option' ) ) {
						$slides = ot_get_option( 'mainslider', array() );
						if (!empty( $slides ) ) {
							$i = 0;
							foreach( $slides as $slide ) {
								$slideurl = $slide['slider_url'];
								if(!empty($slideurl)){
									echo '<div><a href="'.$slideurl.'"><img class="rsImg" src="' . $slide['slider_image_upload'] . '" alt="' . $slide['title'] . '" />';
								} else {
									echo '<div><img class="rsImg" src="' . $slide['slider_image_upload'] . '" alt="' . $slide['title'] . '" />';
								}

								$i++;
									if( $slide['slider_empty'] != "yes" ) {
											if (function_exists('icl_register_string')) {
												icl_register_string('Royal slider title'.$i,'flextitle'.$i, $slide['title']);
												icl_register_string('Royal slider content'.$i,'flexcontent'.$i, $slide['slider_description']);
											}
										echo '<div class="slide-caption">';
										if (function_exists('icl_register_string')) {
											if(!empty($slide['title'])) echo '<h3>' . icl_t('Royal slider title'.$i,'flextitle'.$i, $slide['title']) . '</h3>';
											if(!empty($slide['slider_description'])) echo '<p>' . do_shortcode(icl_t('Royal slider content'.$i,'flexcontent'.$i, $slide['slider_description'])) . '</p>';
										} else {
											if(!empty($slide['title'])) echo '<h3>'.  $slide['title'] .'</h3>';
											if(!empty($slide['slider_description'])) echo '<p>'. do_shortcode($slide['slider_description']) . '</p>';
										}
										echo '</div>';
									}
								if(!empty($slideurl)) {
									echo '</a></div>';
								} else {
									echo '</div>';
								}
							}
						}
					}
					?>
					<!-- Slide -->
				
			</div>
		</section>
	</div>
	<!-- Royalslider / End -->

</div>
<!-- 960 Container / End -->
